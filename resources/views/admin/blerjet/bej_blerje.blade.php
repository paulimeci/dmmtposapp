@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add Purchase  </h4><br><br>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Date</label>
                                        <input class="form-control example-date-input" name="date" type="date"  id="date">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Purchase No</label>
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
                                        <label for="example-text-input" class="form-label">Category Name </label>
                                        <select name="category_id" id="category_id" class="form-select select2" aria-label="Default select example">
                                            <option selected="">Open this select menu</option>

                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Product Name </label>
                                        <select name="produkt_id" id="produkt_id" class="form-select select2" aria-label="Default select example">
                                            <option selected="">Open this select menu</option>

                                        </select>
                                    </div>
                                </div>


                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label" style="margin-top:43px;">  </label>


                                        <i class="btn btn-secondary btn-rounded waves-effect waves-light fas fa-plus-circle addeventmore"> Add More</i>
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
                                        <th>Category</th>
                                        <th>Product Name </th>
                                        <th>PSC/KG</th>
                                        <th>Unit Price </th>
                                        <th>Description</th>
                                        <th>Total Price</th>
                                        <th>Action</th>

                                    </tr>
                                    </thead>

                                    <tbody id="addRow" class="addRow">

                                    </tbody>

                                    <tbody>
                                    <tr>
                                        <td colspan="5"></td>
                                        <td>
                                            <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control estimated_amount" readonly style="background-color: #ddd;" >
                                        </td>
                                        <td></td>
                                    </tr>

                                    </tbody>
                                </table><br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info" id="storeButton"> Purchase Store</button>

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

            <td>
                <input type="hidden" name="category_id[]" value="@{{category_id}}">
                @{{ category_name }}
            </td>

            <td>
                <input type="hidden" name="produkt_id[]" value="@{{produkt_id}}">
                @{{ produkt_name }}
            </td>

            <td>
                <input type="number" min="1" class="form-control buying_qty text-right" name="buying_qty[]" value="">
            </td>

            <td>
                <input type="number" class="form-control unit_price text-right" name="unit_price[]" value="">
            </td>

            <td>
                <input type="text" class="form-control" name="description[]">
            </td>

            <td>
                <input type="number" class="form-control buying_price text-right" name="buying_price[]" value="0" readonly>
            </td>

            <td>
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





@endsection
