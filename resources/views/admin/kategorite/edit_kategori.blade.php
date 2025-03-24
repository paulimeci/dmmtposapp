@extends('admin.admin_master')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Edit Kategori </h4><br><br>



                            <form method="post" action="{{ route('kategorite.update') }}" id="myForm" >
                                @csrf

                                <input type="hidden" name="id" value="{{ $kategorite->id }}">
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Emri i kategorise </label>
                                    <div class="form-group col-sm-10">
                                        <input name="emri" value="{{ $kategorite->name }}" class="form-control" type="text">
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Parent Kategori </label>
                                    <div class="form-group col-sm-10">
                                        <select id="parent_id" name="parent_id" class="form-select select2" aria-label="Default select example">
                                            <option value="{{$kategorite->parent_id}}" selected="">Procesi ame</option>
                                            <option value="0">Root</option>
                                            @foreach($kategorite_list as $kl)
                                                <option value="{{ $kl->id }}">{{ $kl->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <!-- end row -->


                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Perditeso kategorine">
                            </form>



                        </div>
                    </div>
                </div> <!-- end col -->
            </div>



        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function (){
            $('#myForm').validate({
                rules: {
                    name: {
                        required : true,
                    },

                },
                messages :{
                    name: {
                        required : 'Please Enter Your Name',
                    },

                },
                errorElement : 'span',
                errorPlacement: function (error,element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight : function(element, errorClass, validClass){
                    $(element).addClass('is-invalid');
                },
                unhighlight : function(element, errorClass, validClass){
                    $(element).removeClass('is-invalid');
                },
            });
        });

    </script>



@endsection
