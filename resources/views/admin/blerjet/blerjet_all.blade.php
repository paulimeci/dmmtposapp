@extends('admin.admin_master')
@section('admin')


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
                                    <th>Sl</th>
                                    <th>Purhase No</th>
                                    <th>Date </th>
                                    <th>Supplier</th>
                                    <th>Category</th>
                                    <th>Qty</th>
                                    <th>Product Name</th>


                                </thead>


                                <tbody>

                                @foreach($blerjet as $key => $item)
                                    <tr>
                                        <td> {{ $key+1}} </td>
                                        <td> {{ $item->nr_fature }} </td>
                                        <td> {{ date('d-m-Y',strtotime($item->date))  }} </td>
                                        <td> {{ $item->furnitori->name }} </td>
                                        <td> {{ $item->kategoria->name }} </td>
                                        <td> {{ $item->cmimi_blerjes }} </td>
                                        <td> {{ $item->produkti->name }} </td>




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


@endsection
