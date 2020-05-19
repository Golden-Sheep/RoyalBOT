<?php

namespace App\Http\Controllers;

use App\Models\UserBlackList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlackListUserController extends Controller
{

    function index(){
        $blw = UserBlackList::where('idUser',Auth::user()->id)->get();
        return view('blacklist/user',['blw' => $blw]);
    }

    function addUser(Request $request){
        $user = new UserBlackList();

        $user->idFacebook = $request->idFB;
        $user->comment = $request->comment;
        $user->idUser =  Auth::user()->id;

        if(UserBlackList::where('idFacebook',$request->idFB)->where('idUser',Auth::user()->id)->count()>0){
            return "201";
        }

        if($user->save()){
            return "200";
        }

        return "400";



    }

    function remove(Request $request){

        $idUser = Auth::user()->id;
        if(UserBlackList::where('idFacebook',$request->idFB)->where('idUser',$idUser)->delete()) {
            return 'success';
        }

    }

    function getUserBlackList(Request $request){

        $array = array();

        $user = UserBlackList::where('idUser',Auth::user()->id)->get();

        foreach ($user as $element){
            $array[] = $element->idFacebook;
        }

        return $array;
    }

}
