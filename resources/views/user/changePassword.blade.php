{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'RoyalBOT - Home')

@section('content_header')


@stop

@section('content')

    <div class="row">

        <div class="col-md-12">
            @if (session('msg'))
                <div class="alert alert-{{session('status')}}" role="alert">
                    {{ session('msg') }}
                </div>
            @endif
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-lock"> </i>  Change Password</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="/account/changePassword/save">
                    {{ csrf_field() }}
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="forOldPass">Your Password</label>
                            <input type="password" required class="form-control"name="oldPass" placeholder="Enter current password">
                        </div>

                        <div class="form-group">
                            <label for="forNewPass">New Password</label>
                            <input type="password" id="password" required class="form-control"name="newPass" placeholder="Enter new password">
                        </div>

                        <div class="form-group">
                            <label for="forNewPass2">Confirm your new password</label>
                            <input type="password" id="confirm_password" required class="form-control"  name="newPass2" placeholder="Enter new password">
                        </div>
                        <span id='message'></span>



                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" id="btnSubmit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--END ROW -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');

        $('#password, #confirm_password').on('keyup', function () {
            if ($('#password').val() === $('#confirm_password').val()) {
                $("#btnSubmit").prop('disabled', false);
                $('#message').html('Matching').css('color', 'green');

            } else {
                $('#message').html('Not Matching').css('color', 'red');
                $("#btnSubmit").prop('disabled', true);
            }
        });
    </script>
@stop

