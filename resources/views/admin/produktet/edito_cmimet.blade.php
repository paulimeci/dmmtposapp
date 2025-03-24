@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Lista e produktetve</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="filterFushata">Filtro fushaten:</label>
                                    <select id="filterFushata" class="form-control">
                                        <option value="">All</option>
                                        @foreach($kategorite as $category)
                                            <option value="{{ $category->name }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div id="result-table">

                                        <table id="filtered_table" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Produkti</th>
                                                <th>Kategoria</th>
                                                <th>Sasia</th>
                                                <th>Cmimi</th>
                                                <th>Veprimi</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($produktet as $index => $item)
                                                <tr>
                                                    <form method="POST" action="{{route('perditeso.cmimin')}}">
                                                        @csrf
                                                    <input type="hidden" name="id" value="{{$item->id}}">
                                                    <td>{{ $index + 1 }}</td>
<td>
                                                        <input type="text" name="emri" step="any" value="{{ $item->name}}">

                                                    </td>                                                    <td>{{ $item->category->name }}</td>
                                                    <td>
                                                        <input type="number" name="quantity" step="any" value="{{ $item->quantity ?? 0}}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="price" step="any" value="{{ $item->cmimi->price ?? 0 }}">
                                                    </td>
                                                    <td>
                                                        <button type="submit" class="btn btn-outline-info btn-sm">Perditeso</button>
                                                    </td>
                                    </form>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            var table = $('#filtered_table').DataTable({
                dom: '<"dt-buttons"B>lfrtip',
                buttons: [
                    { extend: 'csv', className: 'btn btn-primary' },
                    { extend: 'excel', className: 'btn btn-success' },
                    { extend: 'pdf', className: 'btn btn-danger' },
                    { extend: 'print', className: 'btn btn-info' },
                    { extend: 'copy', className: 'btn btn-warning' },
                ],
                tableClass: 'datatables-users1',
            });

            // Add event listener to the filter dropdown
            $('#filterFushata').on('change', function () {
                var filterValue = $(this).val();

                // Apply the filter to the DataTable
                table.columns(2).search(filterValue).draw(); // Assuming Kategoria is the third column (index 2)
            });
        });
    </script>
@endsection
