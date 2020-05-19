{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'RoyalBOT - Home')

@section('content_header')

    <h2>Words Black List</h2>
@stop

@section('content')

    <div class="row">

        <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Your Black List</h4>
                        <div class="input-group flex-nowrap">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="addon-wrapping">ADD WORD</span>
                            </div>
                            <input type="text" id="inputWord" name="words" class="form-control" placeholder="Example: idiot,bitch,slut" aria-describedby="addon-wrapping">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" id="btnAddWord" onclick="addWord()" type="button" >Submit</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                <table class="table table-striped" id="wordstable">
                    <thead>
                    <tr>
                        <th class="text-center">Word</th>
                        <th class="text-center">Action</th>
                    </tr>
                    </thead>
                    <tbody id="bodyTable">
                    @foreach($blw as $bl)
                        <tr>
                            <td>{{$bl->word}}</td>
                            <td align="center">
                                <a onclick="removeWord('{{$bl->word}}')" class="btn btn-default btn-block"><i class="fas fa-trash-alt"></i> Remove</a>
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

@stop

@section('js')
    <script>
        console.log('Hi!');

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
            $('#wordstable').DataTable({
                "paging": true,
                "lengthChange": true,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
            });

        });

        function removeWord(wordSelect) {
            console.log("ENTREI"+wordSelect);
            $.ajax({
                url: "{{route('removeWordBlist')}}",
                type: "post",
                data: {wordSelect: wordSelect},
                success: function (data) {
                    console.log(data);
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }

        function addWord() {

            var arrayWord = $("#inputWord").val();
            $("#inputWord").prop('disabled', true);
            $.ajax({
                url: "{{route('addWordBlist')}}",
                type: "post",
                data: { arrayWord: arrayWord },
                success: function (data) {
                    console.log(data);
                    data.forEach(function(item) {
                        console.log(item);
                        $('#bodyTable').append('<tr><td>'+item+'</td><td> <a onclick="" class="btn btn-default btn-block"><i class="fas fa-trash-alt"></i> Remove</a></td></tr>');
                    });
                    $("#inputWord").prop('disabled', false);
                },
                error: function (data) {
                    console.log(data);
                    $("#inputWord").prop('disabled', false);
                }
            });

        }

    </script>
@stop

