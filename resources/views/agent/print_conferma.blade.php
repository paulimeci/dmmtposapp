@extends('agent.user_master')
@section('admin')
\    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row justify-content-center">
                                <div class="col-xl-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <a href="{{ route('printo.faturen', $maxInvoiceNo) }}">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-truncate font-size-14 mb-2">Printo Faturen</p>
                                                        <h4 class="mb-2">Printo Faturen</h4>
                                                        <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>Printo faturen dhe procedo ne nje tjeter shitje</p>
                                                    </div>
                                                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-primary rounded-3">
                            <i class="ri-shopping-cart-2-line font-size-24"></i>
                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div><!-- end cardbody -->
                                    </div><!-- end card -->
                                </div><!-- end col -->
                                <div class="col-xl-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <a href="{{ route('bej.shitje') }}">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-truncate font-size-14 mb-2">Shitje tjeter</p>
                                                        <h4 class="mb-2">Bej tjeter shitje</h4>
                                                        <p class="text-muted mb-0"><span class="text-danger fw-bold font-size-12 me-2"><i class="ri-arrow-right-down-line me-1 align-middle"></i>Vazhdo pa printuar (fatura eshte ruajtur ne sistem)</p>
                                                    </div>
                                                    <div class="avatar-sm">
                        <span class="avatar-title bg-light text-success rounded-3">
                            <i class="mdi mdi-currency-usd font-size-24"></i>
                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div><!-- end cardbody -->
                                    </div><!-- end card -->
                                </div><!-- end col -->



                            </div><!-- end row -->


                            </div><!-- end row -->
                        </div>
    </div>
    </div>
    </div>
    </div>

@endsection
