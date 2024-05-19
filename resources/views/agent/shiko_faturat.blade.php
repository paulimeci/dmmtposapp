@extends('agent.user_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">

                        <!--  ---------------------------------- -->
                        <div class="card-body">
                            <a href="{{route('bej.shitje')}}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fas fa-plus-circle"> Bej shitje </i></a> <br>  <br>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>Nr Fature</th>
                                    <th>Totali</th>
                                    <th>Ora </th>
                                    <th>Data </th>
                                    <th>Pershkrimi</th>
                                    <th>Shuma</th>
                                    <th>Zbritje</th>
                                    <th>Veprimi</th>

                                </tr>
                                </thead>


                                <tbody>
                                @php
                                    $xhiro_ditore=0;
                                    $shitje=0;
                                @endphp

                                @foreach($faturat->sortByDesc('nr_fature') as $key => $item)
                                    <tr>
                                        <td> {{ $item->nr_fature}} </td>
                                        <td>
                                            @php
                                                $difference = $item->total_cmimi;
                                                if ($item->zbritjet !== null) {
                                                    $difference -= ($item->total_cmimi * ($item->zbritjet->shifra / 100));
                                                }

                                            $xhiro_ditore+=$difference;
                                                $shitje++;
                                            @endphp
                                            {{ $difference }}
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($item->date)->format('H:i:s') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->date)->toDateString() }}</td>
                                        <td>{{ $item->pershkrimi }}</td>
                                        <td>{{ $item->total_cmimi }}</td>
                                        <td>{{ $item->zbritjet->shifra ?? 0 }} %</td>

                                        <td>
                                            <a href="{{route('edito.faturen',$item->nr_fature)}}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            <a href="{{route('fshi.faturen',$item->nr_fature)}}" class="btn btn-danger sm" title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i></a>
                                        </td>


                                    </tr>

                                @endforeach

                                </tbody>
                            </table><br>


                        </div> <!-- End card-body -->
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
    <!-- Your Handlebars template -->
    <script id="document-template" type="text/x-handlebars-template">
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            // Initialize DataTable
            var dataTable = $('#datatable').DataTable({
                "paging": true, // Enable pagination
                "pageLength": 10, // Set the number of rows per page
                "lengthMenu": [10, 25, 50, 100], // Customize the page length menu
                "responsive": true, // Enable responsive design
                "order": [[ 0, 'desc' ]] // Order Nr Fature column from greatest to smallest
            });

        });
    </script>
@endsection
