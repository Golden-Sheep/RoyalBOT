{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'RoyalBOT - Home')

@section('content_header')

    <h2>Users BlackList</h2>
@stop

@section('content')

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Your Black List</h4>

                </div>
                <div class="card-body">
                    <table class="table table-striped" id="userstable">
                        <thead>
                        <tr>
                            <th class="text-center">USER</th>
                            <th class="text-center">Comment</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody id="bodyTable">
                        @foreach($blw as $bl)
                            <tr>
                                <td align="center">
                                    <img src="http://graph.facebook.com/{{$bl->idFacebook}}/picture?type=square" style="border-radius: 50%; border:1px solid #777;" width="38" height="38" border="5px">
                                   <b> {{$bl->idFacebook}} </b>
                                </td>
                                <td >{{$bl->comment}}</td>
                                <td align="center">
                                    <a onclick="removeUser('{{$bl->idFacebook}}')" class="btn btn-default btn-block"><i class="fas fa-trash-alt"></i> Remove</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @stop

        @section('css')
            <link rel="stylesheet" href="/css/admin_custom.css">
            <style>
                table {
                    table-layout: fixed;
                    width: 100%;
                }

                table td {
                    word-wrap: break-word;         /* All browsers since IE 5.5+ */
                    overflow-wrap: break-word;     /* Renamed property in CSS3 draft spec */
                }
            </style>
        @stop

        @section('js')
            <script>
                console.log('Hi!')

                $('.table tbody').on('click','.btn',function () {
                    $(this).closest('tr').remove();
                });

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $(document).ready(function(){
                    //     $('.datainput').mask('99/99/9999');
                    //          $('.valortable').mask("#.##0,00", {reverse: true});
                    $('#userstable').DataTable({
                        "paging": true,
                        "lengthChange": true,
                        "searching": true,
                        "ordering": true,
                        "info": true,
                        "autoWidth": true,
                    });

                });


                function removeUser(idFB) {
                    $.ajax({
                        url: "{{route('removeUserBL')}}",
                        type: "post",
                        data: {idFB: idFB},
                        success: function (data) {
                            console.log(data);
                        },
                        error: function (data) {
                            console.log(data);
                        }
                    });
                }


            </script>
@stop

