@extends('admin.admin_master')
@section('admin')
<style>
#product_results {
    position: absolute;
    z-index: 1000;
    width: 100%;
    max-height: 200px;
    overflow-y: auto;
    border: 1px solid #ddd;
    background-color: #fff;
}
#product_results a {
    display: block;
    padding: 10px;
    text-decoration: none;
    color: #000;
}
#product_results a:hover {
    background-color: #f8f9fa;
}

     /* Ensure table cells have enough width */
 .numeric-cell {
     min-width: 120px; /* Adjust this value as needed */
     text-align: right; /* Align numbers to the right */
 }

.action-cell {
    min-width: 80px; /* Adjust this value as needed */
    text-align: center; /* Center the action button */
}

/* Make input fields take up the full width of the cell */
.numeric-cell input {
    width: 100%;
    box-sizing: border-box; /* Include padding and border in the width */
}

/* Ensure the table itself is responsive */
table {
    width: 100%;
    table-layout: fixed; /* Prevent table cells from resizing unpredictably */
}
@media (max-width: 767px) {
    .form-control {
        padding: 0.3rem; /* Reduce padding for smaller screens */
        font-size: 12px; /* Further reduce font size for mobile */
    }

    .numeric-cell {
        min-width: 80px; /* Set a minimum width for numeric cells to prevent squeezing */
    }
}
</style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Shto Blerje  </h4><br><br>
                            <livewire:live-shto-produkt-shitja />


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Data</label>
                                        <input class="form-control example-date-input" name="date" type="date"  id="date">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">NrBlerjes</label>
                                        <input class="form-control example-date-input" name="purchase_no" type="text"  id="purchase_no">
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Emri furnitorit </label>
                                        <select id="furnitor_id" name="furnitor_id" class="form-select select2" aria-label="Default select example">
                                            <option selected="">Open this select menu</option>
                                            @foreach($furnitoret as $supp)
                                                <option value="{{ $supp->id }}">{{ $supp->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Kategoria Produktit </label>
                                        <select name="category_id" id="category_id" class="form-select select2" aria-label="Default select example">
                                            <option selected="">Open this select menu</option>

                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Emri produktit </label>
                                        <input type="text" id="search_product" class="form-control" placeholder="Shkruani emrin e produktit këtu...">
                                        <div id="product_results" class="list-group" style="display:none;"></div>
                                    </div>
                                </div>


                            </div> <!-- // end row  -->

                        </div> <!-- End card-body -->
                        <!--  ---------------------------------- -->

                        <div class="card-body">
                            <form method="post" action="{{route('blerjet.store')}}">
                                @csrf
                                <table class="table-sm table-bordered" width="100%" style="border-color: #ddd;">
                                    <thead>
                                    <tr>
                                        <th>Emri produktit </th>
                                        <th>Sasia</th>
                                        <th>Cmimi blerjes </th>
                                        <th>Totali</th>
                                        <th>x</th>

                                    </tr>
                                    </thead>

                                    <tbody id="addRow" class="addRow">

                                    </tbody>

                                    <tbody>
                                    <tr>
                                        <td colspan="2">Totali</td>
                                        <td colspan="3">
                                            <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control estimated_amount" readonly style="background-color: #ddd;" >
                                        </td>
                                    </tr>

                                    </tbody>
                                </table>
                                <br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info" id="storeButton"> Përfundo shtijen</button>
                                </div>

                            </form>
                        </div> <!-- End card-body -->
                    </div>
                </div> <!-- end col -->
            </div>



        </div>
    </div>




<script id="document-template" type="text/x-handlebars-template">
    <tr class="delete_add_more_item" id="delete_add_more_item">
        <input type="hidden" name="date[]" value="@{{date}}">
        <input type="hidden" name="purchase_no[]" value="@{{purchase_no}}">
        <input type="hidden" name="furnitor_id[]" value="@{{furnitor_id}}">
        <input type="hidden" name="category_id[]" value="@{{furnitor_id}}">

        <td>
            <input type="hidden" name="produkt_id[]" value="@{{produkt_id}}">
            @{{ produkt_name }}
        </td>
        <td class="numeric-cell">
            <input type="number" min="1" class="form-control buying_qty text-right" name="buying_qty[]" value="">
        </td>
        <td class="numeric-cell">
            <input type="number" class="form-control unit_price text-right" name="unit_price[]" value="" step="0.01">
        </td>
        <td class="numeric-cell">
            <input type="number" class="form-control buying_price text-right" name="buying_price[]" value="0" readonly>
        </td>
        <td class="action-cell">
            <i class="btn btn-danger btn-sm fas fa-window-close removeeventmore"></i>
        </td>
    </tr>
</script>

<script type="text/javascript">
        $(document).ready(function(){
            $(document).on("click",".addeventmore", function(){
                var date = $('#date').val();
                var purchase_no = $('#purchase_no').val();
                var furnitor_id = $('#furnitor_id').val();
                var category_id  = $('#category_id').val();
                var category_name = $('#category_id').find('option:selected').text();
                var produkt_id = $('#produkt_id').val();
                var produkt_name = $('#produkt_id').find('option:selected').text();


                if(date == ''){
                    $.notify("Date is Required" ,  {globalPosition: 'top right', className:'error' });
                    return false;
                }
                if(purchase_no == ''){
                    $.notify("Purchase No is Required" ,  {globalPosition: 'top right', className:'error' });
                    return false;
                }

                if(furnitor_id == ''){
                    $.notify("Supplier is Required" ,  {globalPosition: 'top right', className:'error' });
                    return false;
                }
                if(category_id == ''){
                    $.notify("Category is Required" ,  {globalPosition: 'top right', className:'error' });
                    return false;
                }
                if(produkt_id == ''){
                    $.notify("Product Field is Required" ,  {globalPosition: 'top right', className:'error' });
                    return false;
                }


                var source = $("#document-template").html();
                var tamplate = Handlebars.compile(source);
                var data = {
                    date:date,
                    purchase_no:purchase_no,
                    furnitor_id:furnitor_id,
                    category_id:category_id,
                    category_name:category_name,
                    produkt_id: produkt_id, // Corrected variable name
                    produkt_name: produkt_name // Corrected variable name

                };
                var html = tamplate(data);
                $("#addRow").append(html);
            });

            $(document).on("click",".removeeventmore",function(event){
                $(this).closest(".delete_add_more_item").remove();
                totalAmountPrice();
            });

            $(document).on('keyup click','.unit_price,.buying_qty', function(){
                var unit_price = $(this).closest("tr").find("input.unit_price").val();
                var qty = $(this).closest("tr").find("input.buying_qty").val();
                var total = unit_price * qty;
                $(this).closest("tr").find("input.buying_price").val(total);
                totalAmountPrice();
            });

            // Calculate sum of amout in invoice

            function totalAmountPrice(){
                var sum = 0;
                $(".buying_price").each(function(){
                    var value = $(this).val();
                    if(!isNaN(value) && value.length != 0){
                        sum += parseFloat(value);
                    }
                });
                $('#estimated_amount').val(sum);
            }

        });


    </script>
<script type="text/javascript">
        $(function(){
            $(document).on('change','#furnitor_id',function(){
                var furnitor_id = $(this).val();
                $.ajax({
                    url:"{{ route('get-category') }}",
                    type: "GET",
                    data:{furnitor_id:furnitor_id},
                    success:function(data){
                        var html = '<option value="">Select Category</option>';
                        $.each(data,function(key,v){
                            html += '<option value=" '+v.category_id+' "> '+v.category.name+'</option>';
                        });
                        $('#category_id').html(html);
                    }
                })
            });
        });

    </script>
<script type="text/javascript">
        $(function(){
            $(document).on('change','#category_id',function(){
                var category_id = $(this).val();
                $.ajax({
                    url:"{{route('get-product')}}",
                    type: "GET",
                    data:{category_id:category_id},
                    success:function(data){
                        var html = '<option value="">Select Category</option>';
                        $.each(data,function(key,v){
                            html += '<option value=" '+v.id+' "> '+v.name+'</option>';
                        });
                        $('#produkt_id').html(html);
                    }
                })
            });
        });

    </script>
<script>
    $(document).ready(function() {
        $('#search_product').on('input', function() {
            var query = $(this).val();
            if (query.length >= 2) { // Start searching after 2 characters
                $.ajax({
                    url: "{{ route('search-product') }}",
                    type: "GET",
                    data: { query: query },
                    success: function(data) {
                        var results = $('#product_results');
                        results.empty();
                        if (data.length > 0) {
                            $.each(data, function(key, product) {
                                results.append('<a href="#" class="list-group-item list-group-item-action" data-id="' + product.id + '">' + product.name + '</a>');
                            });
                            results.show();
                        } else {
                            results.hide();
                        }
                    }
                });
            } else {
                $('#product_results').hide();
            }
        });

        $(document).on('click', '#product_results a', function() {
            var productId = $(this).data('id');
            var productName = $(this).text();
            $('#search_product').val(productName);
            $('#product_results').hide();

            // Add the selected product to the list
            var date = $('#date').val();
            var purchase_no = $('#purchase_no').val();
            var furnitor_id = $('#furnitor_id').val();
            var category_id = $('#category_id').val();
            var category_name = $('#category_id').find('option:selected').text();

            if (date == '') {
                $.notify("Date is Required", { globalPosition: 'top right', className: 'error' });
                return false;
            }
            if (purchase_no == '') {
                $.notify("Purchase No is Required", { globalPosition: 'top right', className: 'error' });
                return false;
            }
            if (furnitor_id == '') {
                $.notify("Supplier is Required", { globalPosition: 'top right', className: 'error' });
                return false;
            }
            if (category_id == '') {
                $.notify("Category is Required", { globalPosition: 'top right', className: 'error' });
                return false;
            }

            var source = $("#document-template").html();
            var template = Handlebars.compile(source);
            var data = {
                date: date,
                purchase_no: purchase_no,
                furnitor_id: furnitor_id,
                category_id: category_id,
                category_name: category_name,
                produkt_id: productId,
                produkt_name: productName
            };
            var html = template(data);
            $("#addRow").append(html);

            // Clear the search box after adding the product
            $('#search_product').val("");
        });
    });
</script>
@endsection
