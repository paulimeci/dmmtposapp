@extends('admin.admin_master')
@section('admin')


    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Kategorite</h4>



                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <a href="{{route('shto.kategori')}}" class="btn btn-dark btn-rounded waves-effect waves-light" style="float:right;"><i class="fas fa-plus-circle"> Shto Procese </i></a> <br>  <br>

                            <h4 class="card-title">Te dhenat </h4>


                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th width="5%">Sl</th>
                                    <th>Name</th>
                                    <th width="10%">Kategoria ame</th>
                                    <th>Statusi</th>
                                    <th width="10%">Action</th>
                                    <th width="10%">Status</th>

                                </thead>


                                <tbody>

                                @foreach($kategorite as $key => $item)
                                    <form method="post" action="">
                                        @csrf
                                        <tr>
                                            <td> {{ $key+1 }} </td>
                                            <td> {{ $item->name }} </td>

                                            <td>
                                                @if ($item->parent_id)
                                                    {{ $item->kategoria_ame->name }}
                                                @else
                                                    Root
                                                @endif
                                            </td>

                                            @if($item->status === 1)
                                                <td>Active</td>
                                            @elseif($item->status === 0)
                                                <td>Innative</td>
                                            @else
                                                <td></td>
                                            @endif

                                            <td>
                                                <a href="{{route('edit.kategori',$item->id)}}" class="btn btn-info sm" title="Edit Data"><i class="fas fa-edit"></i></a>
                                                <a href="{{route('fshij.kategori',$item->id)}}" class="btn btn-danger sm" title="Delete Data" id="delete"><i class="fas fa-trash-alt"></i></a>

                                            </td>
                                            <td>
                                                @if($item->status==1)
                                                    <button type="submit" class="btn btn-success sm" title="Dissativate" id="change" name="caktivizo">  <i class="ri-eye-off-line" ></i> </button>
                                                @else
                                                    <button type="submit" class="btn btn-danger sm" title="Activate" id="change">  <i class="fas fa-eye"></i> </a> </button>
                                                @endif
                                            </td>
                                        </tr>
                                    </form>
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
