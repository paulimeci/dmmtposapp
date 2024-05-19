@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <div class="row justify-content-center">
                                <div class="col-xl-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <a href="{{route('shiko.produktet')}}">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-truncate font-size-14 mb-2">Menaxho Produktet</p>
                                                        <h4 class="mb-2">Menaxho Produktet</h4>
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
                                            <a href="{{ route('shiko.blerjet') }}">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-truncate font-size-14 mb-2">Menaxho blerjet</p>
                                                        <h4 class="mb-2">Menaxho blerjet</h4>
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
                                <div class="col-xl-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <a href="{{ route('shiko.furnitor') }}">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-truncate font-size-14 mb-2">Menaxho Furnitoret</p>
                                                        <h4 class="mb-2">Menaxho Furnitoret</h4>
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
                                <div class="col-xl-3 col-md-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <a href="{{ route('bej.shitje') }}">
                                                <div class="d-flex">
                                                    <div class="flex-grow-1">
                                                        <p class="text-truncate font-size-14 mb-2">Bej shitje</p>
                                                        <h4 class="mb-2">Vazhdo si agjent</h4>
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
