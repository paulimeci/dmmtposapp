<div>
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Product All</h4>



                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <button type="button" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;" data-bs-toggle="modal" data-bs-target="#productModal">
                                <i class="fas fa-plus-circle"></i> Shto Product
                            </button>
                            <br><br>

                            <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="productModalLabel">Add Product</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{ route('product.store') }}" id="myForm">
                                                @csrf
                                                <div class="row mb-3">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">Product Name</label>
                                                    <div class="form-group col-sm-10">
                                                        <input name="name" class="form-control" type="text">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">Furnitoret</label>
                                                    <div class="col-sm-10">
                                                        <select name="furnitori_id" class="form-select" aria-label="Default select example">
                                                            <option selected="">Open this select menu</option>
                                                            @foreach($furnitoret as $fu)
                                                                <option value="{{ $fu->id }}">{{ $fu->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">Unit Name</label>
                                                    <div class="col-sm-10">
                                                        <select name="unit_id" class="form-select" aria-label="Default select example">
                                                            <option selected="">Open this select menu</option>
                                                            @foreach($njesia as $nj)
                                                                <option value="{{ $nj->id }}">{{ $nj->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-sm-2 col-form-label">Category Name</label>
                                                    <div class="col-sm-10">
                                                        <select name="category_id" class="form-select" aria-label="Default select example">
                                                            <option selected="">Open this select menu</option>
                                                            @foreach($kategorite as $cat)
                                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">Sasia produktit</label>
                                                    <div class="form-group col-sm-10">
                                                        <input name="sasia_produktit" class="form-control" type="number" step="any">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">Cmimi i blerjes</label>
                                                    <div class="form-group col-sm-10">
                                                        <input name="cmimi_blerjes" class="form-control" type="number" step="any">
                                                    </div>
                                                </div>
                                                <div class="row mb-3">
                                                    <label for="example-text-input" class="col-sm-2 col-form-label">Cmimi i shitjes</label>
                                                    <div class="form-group col-sm-10">
                                                        <input name="cmimi_produktit" class="form-control" type="number" step="any">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <input type="submit" class="btn btn-info waves-effect waves-light" value="Add Product">
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h4 class="card-title">Product All Data </h4>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>S#</th>
                                    <th>Emri</th>
                                    <th>Njesia</th>
                                    <th>Sasia</th>
                                    <th>Kategoria</th>
                                    <th>Veprimi</th>

                                </thead>


                                <tbody>

                                @foreach($produktet as $key => $item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->unit->name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->category->name }}</td>
                                        <td>
                                            <button class="btn btn-info sm" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $item->id }}" onclick="loadEditForm({{ $item->id }})" title="Edit Data">
                                                <i class="fas fa-edit"></i>
                                            </button>

                                            <a href="{{ route('fshij.produkt', $item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="editProductModal{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="editProductModalLabel{{ $item->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="editProductModalLabel{{ $item->id }}">Edito Produktin</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form method="post" action="{{ route('update.product') }}" id="myForm">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $item->id }}">

                                                        <div class="row mb-3">
                                                            <label for="example-text-input" class="col-sm-2 col-form-label">Emri produktit</label>
                                                            <div class="form-group col-sm-10">
                                                                <input name="name" value="{{ $item->name }}" class="form-control" type="text">
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label class="col-sm-2 col-form-label">Njesia</label>
                                                            <div class="col-sm-10">
                                                                <select name="unit_id" class="form-select">
                                                                    <option selected="" value="{{ $item->njesia_id }}">Open this select menu</option>
                                                                    @foreach($njesia as $uni)
                                                                        <option value="{{ $uni->id }}" {{ $uni->id == $item->njesia_id ? 'selected' : '' }}>
                                                                            {{ $uni->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label class="col-sm-2 col-form-label">Kategoria produktit</label>
                                                            <div class="col-sm-10">
                                                                <select name="category_id" class="form-select">
                                                                    <option value="{{ $item->category_id }}" selected="">Open this select menu</option>
                                                                    @foreach($kategorite as $cat)
                                                                        <option value="{{ $cat->id }}" {{ $cat->id == $item->category_id ? 'selected' : '' }}>
                                                                            {{ $cat->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label class="col-sm-2 col-form-label">Furnitori</label>
                                                            <div class="col-sm-10">
                                                                <select name="furnitori_id" class="form-select">
                                                                    <option value="{{ $item->furnitor_id }}" selected="">Open this select menu</option>
                                                                    @foreach($furnitoret as $fur)
                                                                        <option value="{{ $fur->id }}" {{ $fur->id == $item->furnitor_id ? 'selected' : '' }}>
                                                                            {{ $fur->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-3">
                                                            <label for="example-text-input" class="col-sm-2 col-form-label">Sasia</label>
                                                            <div class="form-group col-sm-10">
                                                                <input name="quantity" value="{{ $item->quantity }}" class="form-control" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="example-text-input" class="col-sm-2 col-form-label">Cmimi i blerjes</label>
                                                            <div class="form-group col-sm-10">
                                                                <input name="cmimi_blerjes" value="{{ $item->cmimi->cmimi_blerjes ?? 'ska'}}" class="form-control" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-3">
                                                            <label for="example-text-input" class="col-sm-2 col-form-label">Cmimi i shitjes</label>
                                                            <div class="form-group col-sm-10">
                                                                <input name="cmimi" value="{{ $item->cmimi->price ?? 'ska'}}" class="form-control" type="text">
                                                            </div>
                                                        </div>

                                                        <input type="submit" class="btn btn-info waves-effect waves-light" value="Perditeso produktin">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
    <script id="document-template" type="text/x-handlebars-template">
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Initialize DataTable
            var dataTable = $('#datatable').DataTable({
                "paging": true, // Enable pagination
                "pageLength": 10, // Set the number of rows per page
                "lengthMenu": [10, 25, 50, 100], // Customize the page length menu
                "responsive": true // Enable responsive design
            });

        });
    </script>
</div>
