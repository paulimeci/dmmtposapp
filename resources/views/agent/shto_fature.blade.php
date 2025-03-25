@extends('agent.user_master')
@section('admin')

    <style>
        #dropdown {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 150px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        #dropdown li {
            padding: 12px 16px;
            display: block;
            cursor: pointer;
        }

        #dropdown li:hover {
            background-color: #f1f1f1;
        }

        .full-width-input {
            width: calc(100% - 2px); /* Adjust for border if present */
            border: none;
            border-bottom: 2px solid lightyellow; /* Set border color to light yellow */
            padding: 0;
            margin: 0;
        }

        /* Set the background color of the entire cell */
        td {
            background-color: lightyellow;
            padding: 0;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('shiko.faturat')}}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fas fa-plus-circle"> Shiko faturat </i></a> <br>  <br>

                            <div class="row">
                                <div class="col-md-1">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Nr Fatures</label>
                                        <input class="form-control example-date-input" name="invoice_no" type="text" value="{{ $invoice_no }}" id="invoice_no" readonly style="background-color:#ddd">
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Data</label>
                                        <input class="form-control example-date-input" value="{{ $date }}" name="date" type="date" id="date">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Emri Produktit</label>
                                        <input type="text" class="form-control" id="searchBox" placeholder="Search Product">
                                        <div id="dropdown" style="position: relative;">
                                            <ul id="productList" style="list-style-type: none; padding: 0; margin: 0;"></ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">Stoku</label>
                                        <input class="form-control example-date-input" name="current_stock_qty" type="text" id="current_stock_qty" readonly style="background-color:#ddd">
                                    </div>
                                </div>

                                <div class="col-md-3 align-self-end"> <!-- Align the "Add More" button to the bottom -->
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label" style="margin-top:43px;">  </label>
                                        <i class="btn btn-secondary btn-rounded waves-effect waves-light fas fa-plus-circle addeventmore"> Shto</i>
                                    </div>
                                </div>
                            </div> <!-- // end row  -->


                        </div> <!-- End card-body -->
                        <!--  ---------------------------------- -->

                        <div class="card-body">
                            <form method="post" action="{{route('kryej_shitjen')}}">
                                @csrf
                                <input type="hidden" name="invoice_no" value="{{ $invoice_no }}">
                                <input type="hidden" name="date" value="{{ $date }}">
                                <table class="table-sm table-bordered" width="100%" style="border-color: #ddd;">
                                    <thead>
                                    <tr>
                                        <th>Emri Produktit</th>
                                        <th width="25%">Sasia</th>
                                        <th width="25%">Cmimi</th>
                                        <th width="25%">Totali</th>
                                        <th width="2%">-</th>
                                    </tr>
                                    </thead>

                                    <tbody id="addRow" class="addRow">

                                    </tbody>

                                    <tbody>
                                    <tr>
                                        <td colspan="2">Zbritja  (%)</td>
                                        <td colspan="3">
                                            <input type="number" name="discount_percentage" id="discount_percentage" class="form-control estimated_amount" value="0" placeholder="Discount Percentage">
                                        </td>
                                    </tr>

                                    <!-- Modify the Grand Total input field to reflect the discounted total -->
                                    <tr>
                                        <td colspan="2">Shuma totale</td>
                                        <td colspan="3">
                                            <input type="text" name="estimated_amount" value="0" id="estimated_amount" class="form-control estimated_amount" readonly style="background-color: #ddd;">
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                                <br>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <textarea name="description" class="form-control" id="description" placeholder="Shkruani nje pershkrim ketu"></textarea>
                                    </div>
                                </div><br>

                                <br>

                                <br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-info" id="storeButton"> Perfundo shitjen</button>

                                </div>

                            </form>
                        </div> <!-- End card-body -->
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>

    <script id="document-template" type="text/x-handlebars-template">
        <tr class="delete_add_more_item">
            <td>
                <input type="hidden" name="product_id[]" value="@{{ product_id }}">
                <span class="product-name">@{{ product_name }}</span>
            </td>
            <td>
                <input type="number" step="0.01"  class="form-control selling_qty full-width-input" name="selling_qty[]" value="">
            </td>
            <td>
                <!-- Display the default unit price from the database in a hidden input field -->
                <input type="hidden" class="form-control default_unit_price" value="@{{ unit_price }}">
                <!-- Allow users to input their own values for the price -->
                <input type="number" step="0.01" id="doubleNumber"  class="form-control unit_price full-width-input" name="unit_price[]" value="@{{ unit_price }}">
            </td>
            <td>
                <input type="number" step="0.01" id="doubleNumber" class="form-control selling_price full-width-input" name="selling_price[]" value="0" readonly>
            </td>
            <td>
                <!-- Hidden input for cmimi_blerjes -->
                <input type="hidden" name="cmimi_blerjes[]" value="@{{ cmimi_blerjes }}">
                <i class="btn btn-danger btn-sm fas fa-window-close removeeventmore" style="font-size: 12px;"></i>
            </td>
        </tr>
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(document).on("click",".addeventmore", function(){
                var date = $('#date').val();
                var invoice_no = $('#invoice_no').val();
                var product_name = $('#searchBox').val();
                var product_li = $('#productList li:contains("' + product_name + '")');
                var product_id = product_li.data('productId');
                var price = product_li.data('price');
                var cmimi_blerjes = product_li.data('cmimiBlerjes');
                var stockQuantity = product_li.data('quantity'); // Get the stock quantity from the selected product

                // Debugging: Log the retrieved product data
                console.log("Product Price:", price);
                console.log("Product Cmimi Blerjes:", cmimi_blerjes);
                console.log("Stock Quantity:", stockQuantity);

                if(date === ''){
                    $.notify("Date is Required", { globalPosition: 'top right', className:'error' });
                    return false;
                }

                if(product_name === ''){
                    $.notify("Product Field is Required", { globalPosition: 'top right', className:'error' });
                    return false;
                }

                $('#searchBox').val('');
                $('#current_stock_qty').val(''); // Clear the stock quantity field after adding

                var source = $("#document-template").html();
                var template = Handlebars.compile(source);
                var data = {
                    date: date,
                    invoice_no: invoice_no,
                    product_id: product_id,
                    product_name: product_name,
                    unit_price: price,
                    cmimi_blerjes: cmimi_blerjes,
                    quantity: stockQuantity // Pass the stock quantity to the template
                };
                var html = template(data);
                $("#addRow").append(html);
            });

            $(document).on("click",".removeeventmore", function(event){
                $(this).closest(".delete_add_more_item").remove();
                totalAmountPrice();
            });

            $(document).on("input", ".unit_price, .selling_qty", function(){
                var unitPrice = $(this).closest("tr").find(".unit_price").val();
                var qty = $(this).closest("tr").find(".selling_qty").val();
                var total = unitPrice * qty;
                $(this).closest("tr").find(".selling_price").val(total.toFixed(2));
                totalAmountPrice();
            });

            function totalAmountPrice() {
                var sum = 0;
                $(".selling_price").each(function() {
                    var value = $(this).val();
                    if(!isNaN(value) && value.length !== 0) {
                        sum += parseFloat(value);
                    }
                });

                var discountPercentage = parseFloat($("#discount_percentage").val());
                if (!isNaN(discountPercentage) && discountPercentage > 0) {
                    var discountAmount = (sum * discountPercentage) / 100;
                    sum -= discountAmount;
                }

                $("#estimated_amount").val(sum.toFixed(2));
            }

            $(document).on("input", "#discount_percentage", function(){
                totalAmountPrice();
            });

        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            function populateDropdownList(products, filter) {
                var ul = document.getElementById("productList");
                ul.innerHTML = ""; // Clear previous items

                // Filter products based on the search query
                var filteredProducts = products.filter(function(product) {
                    return product.name.toLowerCase().includes(filter.toLowerCase());
                });

                // Populate dropdown with filtered products
                filteredProducts.forEach(function(product) {
                    var li = document.createElement("li");
                    li.textContent = product.name;
                    li.dataset.productId = product.id; // Add product ID
                    li.dataset.price = product.cmimi.price; // Add product price
                    li.dataset.cmimiBlerjes = product.cmimi.cmimi_blerjes; // Add cmimi_blerjes
                    li.dataset.quantity = product.quantity; // Add stock quantity
                    ul.appendChild(li);
                });

                // Event listener for selecting an item from the dropdown
                ul.addEventListener("click", function(e) {
                    var target = e.target;
                    if (target.tagName === "LI") {
                        var selectedProduct = target.textContent;
                        document.getElementById("searchBox").value = selectedProduct;
                        document.getElementById("dropdown").style.display = "none";

                        // Set the stock quantity when a product is selected
                        var stockQuantity = target.dataset.quantity;
                        document.getElementById("current_stock_qty").value = stockQuantity;
                    }
                });
            }

            document.getElementById("searchBox").addEventListener("input", function() {
                var filter = this.value;
                var dropdown = document.getElementById("dropdown");

                // Show/hide dropdown based on input
                if (filter.length > 0) {
                    dropdown.style.display = "block";
                    var products = <?php echo json_encode($produkti); ?>;
                    populateDropdownList(products, filter);
                } else {
                    dropdown.style.display = "none";
                    document.getElementById("current_stock_qty").value = ""; // Clear stock when search is cleared
                }
            });
        });
    </script>

@endsection
