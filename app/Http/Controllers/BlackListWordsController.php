<?php

namespace App\Http\Controllers;

use App\Models\WordsBlackList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BlackListWordsController extends Controller
{
    function index(){
        $blw = WordsBlackList::where('idUser',Auth::user()->id)->get();
        return view('blacklist/words',['blw' => $blw]);
    }

    function removeWordBlist(Request $request){
        $idUser = Auth::user()->id;
        if(WordsBlackList::where('word',$request->wordSelect)->where('idUser',$idUser)->delete()) {
            return 'success';
        }

    }

    function addWordBlackList(Request $request){
        $idUser = Auth::user()->id;
        $array = explode(',', $request->arrayWord);
        foreach ($array as $element) {
            $wordBl = new WordsBlackList();
            $wordBl->idUser = $idUser;
            $wordBl->word = $element;
            $wordBl->save();
        }
        return $array;
    }

    function getWordBlist(){
     $word = WordsBlackList::select('word')->where('idUser',Auth::user()->id)->get();
     $array = array();
     foreach ($word as $element){
         $array[] = $element->word;
     }

     return $array;

    }
}
