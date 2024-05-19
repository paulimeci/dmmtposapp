@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script>


    <div class="page-content">
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

                            <a href="{{ route('shto.produkt') }}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fas fa-plus-circle"> Shto Product </i></a> <br>  <br>

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
                                        <td> {{ $key+1}} </td>
                                        <td> {{ $item->name }} </td>
                                        <td> {{ $item->unit->name }} </td>
                                        <td> {{ $item->quantity }} </td>
                                        <td> {{ $item->category->name }} </td>
                                        <td>
                                            <a href="{{ route('edit.produkt',$item->id) }}" class="btn btn-info sm" title="Edit Data">  <i class="fas fa-edit"></i> </a>

                                            <a href="{{ route('fshij.produkt',$item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete">  <i class="fas fa-trash-alt"></i> </a>
                                        </td>

                                    </tr>
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

@endsection
