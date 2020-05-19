{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'RoyalBOT - Home')

@section('content_header')
    <h1> <i style="color: red;" class="fas fa-signal"></i> Live</h1><br>
    <div class="input-group flex-nowrap">
        <div class="input-group-prepend">
            <span class="input-group-text" id="addon-wrapping">ID LIVE</span>
        </div>
        <input type="text" id="inputLiveId" class="form-control" placeholder="Example: 1157768407888243" aria-describedby="addon-wrapping">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" id="btnAutomaticSearch" onclick="automaticSearch()" type="button" >Automatic Search</button>
            <button class="btn btn-outline-secondary"id="btnSearch" onclick="searchManually()" type="button">Search</button>
        </div>
    </div>
    <div id="infoSearch" style="display: none;">
        <i id="iconSearch" class="fas fa-spinner fa-pulse"></i>
        <a id="textSearch">procurando</a>
    </div>

@stop

@section('content')
    <div class="loader"></div>
    <div class="row">

    <div class="col-md-6">
        <div class="card">
            <div class="card-header">

                <h3 class="card-title"><i class="far fa-fw fa-comments"></i> Comments</h3>

            </div>
            <div class="card-Body">
                <div class="overflow-auto p-3 mb-3 mb-md-0 mr-md-3 bg-light" id="commentsLive"  style="max-width: 100%; max-height: 500px;">

                </div>


            </div>

        </div>
    </div>

        <!--END MD6 -->

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> <i class="far fa-fw fa-star"></i>  Alerts</h3>
                </div>
                <div class="card-Body">
                <h2 align="center">Coming soon</h2>
                </div>

            </div>
        </div>


        <!--END MD6 -->
        <!--END MD6 -->

    </div>
    <!--END ROW -->
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <style>
    .comentario-header{
        display: flex;
    }
    .header-comentario-nome{
        word-break: break-all;
    }
    .header-comentario-foto{
        margin-right: 10px;
        position: relative;
    }

    .comentario-header:hover {
        background-color: #f1f1f1 ;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {background-color: #ddd;}

    .dropdown:hover .dropdown-content {display: block;}


    </style>
@stop

@section('js')
    <script src="https://unpkg.com/piii"></script>
    <script>
        var piii;
        var vetUserBlocked = [];


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        console.log('Hi!');
        var token;
        var tokenPage;
        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));


        window.fbAsyncInit = function() {
            console.log("INIT");
            FB.init({
                appId      : '175637203483353',
                cookie     : true,
                xfbml      : true,
                status      : true,
                version    : 'v6.0'
            });

            FB.login();
            FB.Event.subscribe('auth.login', function(response) {
               token = response.authResponse.accessToken


                FB.api(
                    "1261723433855369?fields=access_token&access_token="+token,
                    function (response) {
                        if (response && !response.error) {
                            tokenPage = response.access_token
                        }
                    }
                );
            });





        };

       function callCommentsRealTime(liveID){
           getBlaskList();
           getBlackListUser();
            console.log("Buscando Comentarios ..."+liveID);
            var source = new EventSource("https://streaming-graph.facebook.com/"+liveID+"/live_comments?access_token="+tokenPage+"&comment_rate=one_per_two_seconds&fields=from{name,id},message");
            source.onmessage = function(event) {
                msg = JSON.parse(event.data);
                console.log(event);
                console.log(msg);
                if(!vetUserBlocked.some(item => item[0] === msg.from.id)) {
                        $("#commentsLive").prepend('<div class="card dropdown">\n' +
                            '                        <div class="card-header comentario-header">\n' +
                            '                            <div class="header-comentario-foto">\n' +
                            '                                <img src="http://graph.facebook.com/' + msg.from.id + '/picture?type=square" style="border-radius: 50%; border:1px solid #777;" width="38" height="38" border="5px">\n' +
                            '                            </div>\n' +
                            '                            <div class="header-comentario-nome"><b>' + msg.from.name + '</b> ' + piii.filter(msg.message) + '</div>\n' +
                            '                        </div>\n' +
                            '                        <div class="dropdown-content">\n' +
                            "                            <a onclick='addUserBlackList(" + msg.from.id + "," + JSON.stringify(msg.message) + ")'>ADD TO BLACKLIST</a>\n" +
                            '                        </div>' +
                            '                    </div>');

                }
            };
        }

        function automaticSearch() {
            $("#inputLiveId").prop('disabled', true);
            $("#btnAutomaticSearch").prop('disabled', true);
            $("#btnSearch").prop('disabled', true);
            $('#infoSearch').show();
            $('#iconSearch').show();
            $('#textSearch').html('Searching ...');

            $.ajax({
                url: "{{route('buscarLiveId')}}",
                type: "get",
                success: function (data) {
                    FB.api('/'+data+'/live_videos', function (response) {
                        if(response.data[0].status == 'LIVE'){
                            $("#inputLiveId").val(response.data[0].id);
                            callCommentsRealTime(response.data[0].id);
                            $('#infoSearch').hide();
                            return;
                        }
                        $('#iconSearch').hide();
                        $('#textSearch').html('Not Found');
                        $("#inputLiveId").prop('disabled', false);
                        $("#btnAutomaticSearch").prop('disabled', false);
                        $("#btnSearch").prop('disabled', false);
                        return;
                    });

                },
                error: function (data) {
                    $('#iconSearch').hide();
                    $('#textSearch').html('Oops, something went wrong, please try again later');
                    $("#inputLiveId").prop('disabled', false);
                    $("#btnAutomaticSearch").prop('disabled', false);
                    $("#btnSearch").prop('disabled', false);
                }
            });

        }


        async function getBlaskList() {
           console.log("Loading BlackList");
            $.ajax({
                url: "{{route('getWordBlist')}}",
                type: "get",
                dataType:"json",
                success: function (data) {

                   var vet = [];
                   vet.push(data);
                   piii = new Piii({
                       filters: [
                           vet
                       ],
                       repeated: true,
                    });
                   console.log("BlackList Load");
                },
                error: function (data) {
                    console.log(data);
                }
            });



        }
        
        function getBlackListUser() {
            console.log("Loading BlackListUser");
            $.ajax({
                url: "{{route('getUserBlackList')}}",
                type: "get",
                success: function (data) {
                    vetUserBlocked.push(data);
                    console.log("BLACKLIST USER LOAD");
                },
                error: function (data) {
                    console.log(data);
                }
            });
        }

       function addUserBlackList(idFB,comment){
        console.log("ADD USER TO BLACKLIST");

           $.ajax({
               url: "{{route('addUserToBlacklist')}}",
               type: "post",
               data: {idFB:idFB, comment:comment},
               success: function (data) {
                console.log(data);
               },
               error: function (data) {
                   console.log(data);
               }
           });

        }

        function searchManually() {
            var idLiveVideo;
            idLiveVideo =  $("#inputLiveId").val();
            if(idLiveVideo === "" || idLiveVideo === null){
                return;
            }

            $("#inputLiveId").prop('disabled', true);
            $("#btnAutomaticSearch").prop('disabled', true);
            $("#btnSearch").prop('disabled', true);
            $('#infoSearch').show();
            $('#iconSearch').show();
            $('#textSearch').html('Searching ...');

            var source = new EventSource("https://streaming-graph.facebook.com/"+idLiveVideo+"/live_comments?access_token="+tokenPage+"&comment_rate=one_per_two_seconds&fields=from{name,id},message");
            console.log(source);
            if(source.onmessage === null){
                $('#iconSearch').hide();
                $('#textSearch').html('Oops, Not found.');
                $("#inputLiveId").prop('disabled', false);
                $("#btnAutomaticSearch").prop('disabled', false);
                $("#btnSearch").prop('disabled', false);
                return;
            }
            callCommentsRealTime(idLiveVideo);
        }



    </script>
@stop

