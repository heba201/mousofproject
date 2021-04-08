<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuraanwordsController extends Controller
{
     public function index()
    {
         // names of surahs
     $urlquraansuhras="http://api.quran-tafseer.com/quran";
     $surahsjson= file_get_contents($urlquraansuhras);
     $surahs=json_decode($surahsjson, true);

       return view ('front.quraanwords.quraanwords',compact('surahs'));
    }
}
