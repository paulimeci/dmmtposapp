@extends('agent.user_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/handlebars.js/4.7.7/handlebars.min.js"></script>
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('riprinto.faturen', $allFatura->nr_fature)}}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fas fa-plus-circle"> Riprinto </i></a> <br>  <br>

                            <h4 class="font-size-16"><strong>Fatura nr # {{ $allFatura->nr_fature }}</strong></h4>
                            <h4><img src="{{ asset('backend/assets/images/logo-sm.png') }}" alt="logo" height="18"/> DMMT POS</h4>
                            <hr>
                            <div>
                                <form method="post" action="{{route('update.faturat')}}" id="myForm">
                                    @csrf
                                    <input type="hidden" name="id_fatures" value="{{$allFatura->id}}">
                                    <input type="hidden" name="id_fat_s" value="{{$allFatura->nr_fature}}">
                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Date Fature</label>
                                        <div class="form-group col-sm-10">
                                            <input name="data" value="{{ $allFatura->date ?? '' }}" class="form-control" type="text">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="shitesi" class="col-sm-2 col-form-label">Shitesi</label>
                                        <div class="form-group col-sm-10">
                                            <select name="agent_id" class="form-control" id="shitesi">
                                                <option value="">Select Shitesi</option>
                                                @foreach($agjentet as $agjent)
                                                    <option value="{{ $agjent->id }}" {{ isset($allFatura->agjenti) && $allFatura->agjenti->id == $agjent->id ? 'selected' : '' }}>
                                                        {{ $agjent->username }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="example-text-input" class="col-sm-2 col-form-label">Zbritja%</label>
                                        <div class="form-group col-sm-10">
                                            <input name="zbritja" value="{{ $allFatura->zbritjet->shifra ?? '' }}" class="form-control" type="text">
                                        </div>
                                    </div>

                                    <!-- Add other fields as needed -->

                                    <button type="submit" class="btn btn-primary">Save</button>
                                </form>


                            </div>

                            <div class="table-responsive">
                                <table class="table table-bordered nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>Produkti</th>
                                        <th>Sasia</th>
                                        <th>Cmimi</th>
                                        <th>Totali</th>
                                        <th>Update</th>
                                        <th>Fshij</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $total_sum = '0'; @endphp
                                    @foreach($allFatura->fatura_detajet as $key => $details)
                                        <tr>
                                            <form action="{{ route('edito.produktin.e.shitur') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="id_pro_sh" value="{{ $details->id }}">
                                                <input type="hidden" name="id_produktit" value="{{ $details->produkt_id }}">
                                                <td class="text-left">{{ $details->produkti->name }}</td>
                                                <td class="text-left">
                                                    <input type="text" name="sasia" class="form-control" value="{{ $details->sasia_shitur }}">
                                                </td>
                                                <td class="text-center">
                                                    <input type="text" name="cmimi" class="form-control" value="{{ $details->cmimi_nj }}">
                                                </td>
                                                <td class="text-end">{{ $details->cmimi_total }}</td>

                                                <td>
                                                    <a href="{{ route('delete.prod.sh', $details->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                                <td>
                                                    <button type="submit" class="btn btn-primary">Perditeso</button>
                                                </td>
                                            </form>
                                        </tr>
                                        @php $total_sum += $details->cmimi_total; @endphp
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>


                            <table class="table table-bordered dt-responsive nowrap">
                                    <tr>
                                        <th>Vlera</th>
                                        <th>Skonto</th>
                                        <th>Perfundimi</th>
                                    </tr>
                                    <tr>
                                        <td>{{$total_sum}}</td>
                                        <td>{{((($allFatura->zbritjet ? $allFatura->zbritjet->shifra : 0)/100)*$total_sum) ?? 0}}</td>
                                        <td>{{ $total_sum - (((($allFatura->zbritjet ? $allFatura->zbritjet->shifra : 0)/100)*$total_sum) ?? 0) }}</td>
                                    </tr>
                                </table>

                        </div>
                    </div>
                </div>
            </div>
            </div>
            </div>
    <script id="document-template" type="text/x-handlebars-template"></script>
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
