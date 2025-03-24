@extends('agent.user_master')
@section('admin')
    <link rel="shortcut icon" href="{{ asset('baclemd/assets/images/favicon.ico')}}">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('bej.shitje')}}" class="btn btn-dark btn-rounded waves-effect waves-light mb-3"><i class="fas fa-plus-circle"></i> Bej shitje</a>

                            <form action="{{route('shiko.permbledhje.data')}}" method="POST">
                                @csrf
                                <div class="form-group row">
                                    <label for="example-text-input" class="col-md-3 col-form-label">Zgjidhni daten</label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input class="form-control example-date-input" name="start_date" type="date" id="date-input" placeholder="YY-MM-DD">
                                            <div class="input-group-append">
                                                <button type="submit" name="show_results" class="btn btn-primary">Kerko</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <div id="result-table" class="table-responsive">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Totali</th>
                                        <th>Zbritjet</th>
                                        <th>Blerja</th>
                                        <th>Xhiro</th>
                                        <th>Fitimi</th>
                                        <th>Detajet</th>
                                    </tr>
                                    </thead>
                                    <tbody id="pertupare">
                                    @foreach($faturat as $key => $item)
                                        <tr>

                                            <td>{{ $item->dita }}</td>
                                            <td>{{ $item->total_shum_fature }}</td>
                                            <td>{{ $item->total_discount ?? 0 }}</td>
                                            <td>{{ $item->total_blerja_total }}</td>
                                            <td>{{ $item->total_shum_fature - ($item->total_discount ?? 0) }}</td>
                                            <td>{{ $item->total_shum_fature - ($item->total_discount ?? 0)-$item->total_blerja_total }}</td>
                                            <td>
                                                <a href="{{route('shiko.faturat.data',$item->dita)}}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>

                                </table>
                            </div>

                        </div> <!-- End card-body -->
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
    <!-- DataTables -->
@endsection
