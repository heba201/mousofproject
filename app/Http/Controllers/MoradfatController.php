<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Moradfat;
use App\Models\Word;
use App\Models\Bayt;
use App\Models\Mojjam;
use App\Models\Meaning;
use App\Models\Sentence;
use DB;

class MoradfatController extends Controller
{
    public function index()
    {
        $word=Word::inRandomOrder()->selection()->get()->first();
        $wordssame=Word::where('word','LIKE','%'.$word->word.'%')->selection()->get();
       $moradfat=Moradfat::with('word')->where('word_id','=',$wordssame[0]->id)->selection()->get();
     /*  $moradfatget  =new Moradfat();

       foreach (  $wordssame as $wordsame) {
           $wordm=Moradfat::with('word')->where('word_id','=',$wordsame->id)->selection()->get();
        if ($wordm->count()>0) {
            $wordmoradf=Moradfat::with('word')->where('word_id','=',$wordsame->id)->selection()->get();

           $moradfatget=Moradfat::create([
            'word_id'=>$wordmoradf->word_id,
            'moradf'=>$wordmoradf->moradf,
            'modad' =>$wordmoradf->modad
           ]);
       }
    }
    $moradfat=$moradfatget->selection()->get(); */
       $mojjams = Mojjam::selection()->get();
        $abyaat=Bayt::with('word','poet')->where('word_id','=',$word->id)->selection()->get();
        return view('front.moradfat.moradfat',compact('wordssame','moradfat','abyaat','wordssame','word','mojjams'));

    }
     public function moradfatword($word)
    {

       try{
        $getword=Word::where('word','LIKE','%'.$word.'%')->selection()->first();
        $moradfat=Moradfat::with('word')->where('word_id','=',$getword->id)->selection()->get();
        $wordssame=Word::where('word','LIKE','%'.$getword->word.'%')->selection()->get();
        $mojjams = Mojjam::selection()->get();
        $abyaat=Bayt::with('word','poet')->where('word_id','=',$getword->id)->selection()->get();
        if ($moradfat->count()==0) {
            return redirect()->route('moradfat');
                   }

        return view('front.moradfat.moradfatword',compact('wordssame','moradfat','abyaat','wordssame','getword','mojjams'));
        }
       catch(\Exception $ex){

            return redirect()->route('moradfat');
        }
    }

    public function  moradfatsearch(Request $request){

        try{
        if ($request->has('search')) {
            $filteredsearch=filter_var($request->search,FILTER_SANITIZE_STRING);
            $word=Word::where('word','LIKE','%'.$filteredsearch.'%')->selection()->first();
            $wordssame=Word::where('word','LIKE','%'.$word->word.'%')->selection()->get();
            $moradfat=Moradfat::with('word')->where('word_id','=',$word->id)->selection()->get();
            $abyaat=Bayt::with('word','poet')->where('word_id','=',$word->id)->selection()->get();
            if (!$moradfat) {
                return redirect()->route('moradfat');
             }
             $mojjams = Mojjam::selection()->get();
       return view('front.moradfat.moradfatsearch',compact('wordssame','moradfat','abyaat','wordssame','word','mojjams'));

    }
}catch(\Exception $ex){

       return redirect()->route('moradfat');
   }
}

public function moradfatmojjam($id,$searchword){

     try {
    $word =Word::with('meanings')->where('word', 'LIKE', '%'.$searchword. '%')->selection()->first();
       $wordmeaning=Meaning::where('word_id',$word->id)->where('mojjam_id',$id)->selection()->get()->first();
       if(!$wordmeaning){
        return redirect()->route('moradfat');
       }
       $mojjam=Mojjam::where('id',$id)->selection()->get()->first();
       $similarwords=Word::with('meanings')->where('word', 'LIKE','%' . $searchword .'%')->where('id','!=',$word->id)->selection()->limit(3)->get();
       $words_meanings_othermojjams=Meaning::with('word','mojjam')->where('word_id',$word->id)->where('mojjam_id','!=',$id)->selection()->get();
       $sentences=Sentence::with('word')->where('word_id',$word->id)->selection()->get();
       return view('front.wordsearch',compact('word','mojjam','wordmeaning','similarwords','words_meanings_othermojjams','sentences'));
     } catch(\Exception $ex){

        return redirect()->route('moradfat');
    }

}

}
