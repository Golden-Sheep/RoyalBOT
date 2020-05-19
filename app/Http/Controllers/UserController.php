<?php

namespace App\Http\Controllers;

use Facebook\Exceptions\FacebookResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{



    public function index()
    {
    return view('/user/home');

    }

    public function searchLiveIdAutomatic(){
        if(Auth::user()->fb_page_id == null){
            return 'PAGE ID NOT FOUND, GO TO PROFILE AND ENTER YOUR PAGE CODE ';
        }
    return Auth::user()->fb_page_id;
    }

    public function viewSettings(){
        return view('user/settings',['userInfo' => Auth::user()]);
    }

    public function viewChangePassword(){
        return view('user/changePassword');
    }

    public function updatePassword(Request $request){
        $user = Auth::user();

        if($request->oldPass == $user->password){
            $user->password = $request->newPass;

            if($user->save()){
                \Session::flash('status','success');
                \Session::flash('msg', 'Your password has been changed!');
                return view('user/changePassword');
            }
            \Session::flash('status','danger');
            \Session::flash('msg', 'Error - Try again later');
            return view('user/changePassword');

        }

        \Session::flash('msg','Your current password is incorrect');
        \Session::flash('status','danger');
        return view('user/changePassword');

    }

    public function updateSettigs(Request $request){
        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->fb_page_id = $request->fbPageId;
        $user->update();

        \Session::flash('msg', 'Success!');
        return view('user/settings',['userInfo' => Auth::user()]);

    }
}
