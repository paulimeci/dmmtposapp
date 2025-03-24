<div>
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Purchase All</h4>



                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <a href="{{route('shto.blerjet')}}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fas fa-plus-circle"> Add Purchase </i></a> <br>  <br>

                            <h4 class="card-title">Te gjitha blerjet </h4>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nr Fature</th>
                                    <th>Date</th>
                                    <th>Furnitori</th>
                                    <th>Total Cmimi Blerjes</th>
                                    <th>ViewMore</th>

                                </thead>


                                <tbody>

                                {{--
                                                                @dd($blerjet)
                                --}}
                                @foreach($blerjet as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $item->nr_fature }}</td>
                                        <td>{{ date('d-m-Y', strtotime($item->date)) }}</td>
                                        <td>{{ $item->furnitori->name }}</td>
                                        <td>{{ $item->total_cmimi_blerjes }}</td>
                                        <td>
                                            <button
                                            type="button"
                                            data-bs-toggle="modal"
                                            data-bs-target="#viewCardModal"
                                            wire:click="viewMore({{ $item->nr_fature }})"
                                            ></button>
                                        </td>
                                    </tr>
                                @endforeach

                                </tbody>
                            </table>
                            <div class="modal fade bd-example-modal-xl" id="viewCardModal"
                                 tabindex="-1"
                                 aria-labelledby="viewCardModalLabel"
                                 aria-hidden="true"
                                 wire:ignore.self
                            >
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <div class="modal-content">
                                        <!-- Modal Header -->

                                        @php
                                            $firstItem = count($lista_blerjes) > 0 ? $lista_blerjes[0] : null; // Define $firstItem outside the @if block
                                        @endphp

                                        @if ($firstItem)
                                            <p><strong>Nr Fature:</strong> {{ $firstItem['nr_fature'] }}</p>
                                            <p><strong>Data:</strong> {{ date('d-m-Y', strtotime($firstItem['date'])) }}</p>
                                            <p><strong>Furnitori:</strong> {{ $firstItem['furnitori']['name'] }}</p>
                                            <p><strong>Kategoria:</strong> {{ $firstItem['kategoria']['name'] }}</p>
                                        @else
                                            <p>No details found.</p>
                                        @endif
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Produkti</th>
                                                <th>Sasia blere</th>
                                                <th>Cmimi i blere</th>
                                                <th>Totali</th>
                                            </tr>
                                            </thead>
                                        <tbody>
                                        @php
                                        $totali=0;
                                        @endphp
                                        @foreach($lista_blerjes as $key=>$lb)

                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$lb->produkti->name}}</td>
                                                <td>{{$lb->sasia}}</td>
                                                <td>{{$lb->cmimi_blerjes}}</td>
                                                <td>{{$lb->sasia * $lb->cmimi_blerjes}}</td>
                                            </tr>
                                            @php $totali += $lb->sasia * $lb->cmimi_blerjes;@endphp
                                        @endforeach
                                        </tbody>
                                        </table>
                                        <p>Totali i fatures eshte: {{$totali}}</p>
                                        <div class="modal-footer">
                                            <button
                                                type="button"
                                                class="btn btn-warning icon-btn b-r-4"
                                                data-bs-toggle="modal"
                                                onclick="{{ $firstItem ? "window.open('" . route('shkarko_faturen', $firstItem['nr_fature']) . "', '_blank')" : "alert('No invoice data available');" }}"
                                        {{ !$firstItem ? 'disabled' : '' }} <!-- Disable the button if $firstItem is null -->
                                            >
                                            <i class="ti ti-download"></i>
                                            </button>

                                            <button
                                                type="button"
                                                class="btn btn-danger icon-btn b-r-4"
                                                data-bs-dismiss="modal"
                                            >  X
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->



        </div> <!-- container-fluid -->
    </div>
</div>
