{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'RoyalBOT - Home')

@section('content_header')

<h2>Profile</h2>
@stop

@section('content')

    <div class="row">

        <div class="col-md-12">
            @if (session('msg'))
                <div class="alert alert-success" role="alert">
                    {{ session('msg') }}
                </div>
            @endif
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Your data</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form role="form" method="post" action="/account/settings/save">
                {{ csrf_field() }}
                @method('PUT')
                <div class="card-body">
                        <div class="form-group">
                            <label for="forEmail">Email address</label>
                            <input type="email" class="form-control" value='{{$userInfo->email}}' name="email" placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <label for="forName">Name</label>
                            <input type="text" class="form-control" value='{{$userInfo->name}}' name="name" placeholder="Enter your name">
                        </div>

                    <div class="form-group">
                        <label for="forPhone">Phone Number</label>
                        <input type="text" class="form-control" value='{{$userInfo->phone}}' name="phone" placeholder="Enter your name">
                    </div>

                    <div class="form-group">
                        <label for="forIdFace">ID Page Facebook </label>
                        <input type="text" class="form-control" value='{{$userInfo->fb_page_id}}' name="fbPageId" placeholder="Enter your name">
                    </div>



                    </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
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
    </script>
@stop

