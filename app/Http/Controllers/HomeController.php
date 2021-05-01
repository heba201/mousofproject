<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Character;
use App\Models\Article;
use App\Models\Lesson;
use App\Models\Saying;
use App\Models\Faeda;
use App\Models\Wisdom;
use App\Models\Sentence;
use App\Models\Meaning;
use App\Models\Word;
use App\Models\Wordname;
use App\Models\Mojjam;
use App\Models\Wordindication;

class HomeController extends Controller
{
    public function index()
    {
        try{
        $characters = Character::selection()->limit(2)->get();
        $articles = Article::selection()->limit(2)->get();
        $lessons = Lesson::selection()->limit(3)->get();
        $sayings =Saying::with('character')->selection()->limit(2)->get();
        $fawaed =Faeda::with('fawedsubject')->selection()->limit(2)->get();
        $wisdomtoday = Wisdom::inRandomOrder()->first();
        //get random meaning
       // $wordmeaning=Meaning::where('word_id',$word->id)->where('mojjam_id',$mojjam->id)->selection()->get()->first();
       //$word =Word::with('meanings')->inRandomOrder()->selection()->first();
       $wordmeaning=Meaning::inRandomOrder()->selection()->get()->first();
        $word =Wordname::with('meanings')->where('id',$wordmeaning->word_id)->selection()->first();
        $mojjam=Mojjam::where('id',$wordmeaning->mojjam_id)->selection()->first();
        $similarwords=Wordname::with('meanings')->where('word', 'like',"%" . $word->word ."%")->where('id','!=',$word->id)->selection()->limit(3)->get();
        $words_meanings_othermojjams=Meaning::with('word','mojjam')->where('word_id',$word->id)->where('mojjam_id','!=',$mojjam->id)->selection()->get();
        $sentences=Sentence::with('word')->where('word_id',$word->id)->selection()->get();
        $word_indications=Wordindication::selection()->get();
      /*  if (!$wordmeaning) {
          return redirect()->route('home');
        } */
        $wordcount=Word::count();
        $wordtoday=Word::inRandomOrder()->whereIn('word_type',['0','1'])->first();
        $wordname=Wordname::where('id',$wordtoday->word_id)->selection()->first();
        $meanings=Meaning::where('word_id','=',$wordtoday->word_id)->selection()->get();
        //print_r($meanings);
        //$wordsgroup=$wordtoday::where('word','=',$wordtoday->word)->selection()->get();
        $wordsgroup=$wordname::where('word','=',$wordname->word)->selection()->get();
        return view('index2',compact('characters','articles','lessons','sayings','fawaed','wisdomtoday','wordtoday','meanings','wordsgroup'
    ,'word','word_indications','mojjam','wordmeaning','similarwords','words_meanings_othermojjams','sentences'));
        }catch(\Exception $ex){
            return redirect()->route('home');
        }
}

    public function wordsearch(Request $request){
        try {
        if(isset($_POST['search'])){
        $filteredsearch=filter_var($request->search,FILTER_SANITIZE_STRING);
          $word =Wordname::with('meanings')->where('word', 'like', "%".$filteredsearch. "%")->selection()->first();
          if (!$word) {
            $searchword=$request->search;
            return view('indexnoresult',compact('searchword'));
          }
          $word_indications=Wordindication::selection()->get();
          $mojjam_id=$request->mojjam_id;
           $wordmeaning=Meaning::where('word_id',$word->id)->where('mojjam_id',$mojjam_id)->selection()->get()->first();

           $mojjam=Mojjam::where('id',$mojjam_id)->selection()->get()->first();
           $similarwords=Wordname::with('meanings')->where('word', 'like',"%" . $filteredsearch ."%")->where('id','!=',$word->id)->selection()->limit(3)->get();
            //$relatedwords=Word::where('word', 'like', "%".$filteredsearch."%")->get();
          $words_meanings_othermojjams=Meaning::with('word','mojjam')->where('word_id',$word->id)->where('mojjam_id','!=',$mojjam_id)->selection()->get();
           $sentences=Sentence::with('word')->where('word_id',$word->id)->selection()->get();
             return view('front.wordsearch',compact('word','word_indications','mojjam','wordmeaning','similarwords','words_meanings_othermojjams','sentences'));
        }
    }
       catch(\Exception $ex){
           return $ex;
            return redirect()->route('home');
        }

    }

    public function wordmojjam($id,$searchword)
    {
       try{


        $word =Wordname::with('meanings')->where('word', 'like', "%".$searchword. "%")->selection()->first();
        $word_indications=Wordindication::selection()->get();
        $wordmeaning=Meaning::where('word_id',$word->id)->where('mojjam_id',$id)->selection()->get()->first();
        $searchword=$request->search;
        if (!$wordmeaning) {
            return redirect()->route('home');
          }
        $mojjam=Mojjam::where('id',$id)->selection()->get()->first();
        $similarwords=Word::with('meanings')->where('word', 'like',"%" . $searchword ."%")->where('id','!=',$word->id)->selection()->limit(3)->get();
        $words_meanings_othermojjams=Meaning::with('word','mojjam')->where('word_id',$word->id)->where('mojjam_id','!=',$id)->selection()->get();
        $sentences=Sentence::with('word')->where('word_id',$word->id)->selection()->get();
        return view('front.wordsearch',compact('word','word_indications','mojjam','wordmeaning','similarwords','words_meanings_othermojjams','sentences'));

}  catch(\Exception $ex){
    //return $ex;
    return redirect()->route('home');
}
}

public function getwordmaningmojjam($id){
    try {


       //$word=Word::with('meanings')->inRandomOrder()->get()->first();
       $word_indications=Wordindication::selection()->get();
       $mojjam_id=$id;
       //$wordmeaning=Meaning::where('word_id',$word->id)->where('mojjam_id',$mojjam_id)->selection()->get()->first();
        $wordmeaning=Meaning::inRandomOrder()->where('mojjam_id',$mojjam_id)->selection()->get()->first();
        $word=Word::with('meanings')->where('id',$wordmeaning->word_id)->get()->first();
        if (!$wordmeaning) {
        return redirect()->route('home');
      }
       $mojjam=Mojjam::where('id',$mojjam_id)->selection()->get()->first();
       $similarwords=Wordname::with('meanings')->where('word', 'like',"%" . $word ."%")->where('id','!=',$word->id)->selection()->limit(3)->get();
       $words_meanings_othermojjams=Meaning::with('word','mojjam')->where('word_id',$word->id)->where('mojjam_id','!=',$mojjam_id)->selection()->get();
       $sentences=Sentence::with('word')->where('word_id',$word->id)->selection()->get();
      if (!$word ||  !$wordmeaning) {
        return redirect()->route('home');
      }
       return view('front.wordsearch',compact('word','word_indications','mojjam','wordmeaning','similarwords','words_meanings_othermojjams','sentences'));
}
    catch(\Exception $ex){
        return redirect()->route('home');
    }

}
        public function composedword($id)
        {
            try {
            $word=Word::with('meanings')->where('word_type',3)->inRandomOrder()->get()->first();
            $word_indications=Wordindication::selection()->get();
            $mojjam_id=$id;
            $wordmeaning=Meaning::where('word_id',$word->id)->where('mojjam_id',$mojjam_id)->selection()->get()->first();
            if (!$wordmeaning) {
                return redirect()->route('home');
            }
            $mojjam=Mojjam::where('id',$mojjam_id)->selection()->get()->first();
            $similarwords=Word::with('meanings')->where('word', 'like',"%" . $word ."%")->where('id','!=',$word->id)->selection()->limit(3)->get();
            $words_meanings_othermojjams=Meaning::with('word','mojjam')->where('word_id',$word->id)->where('mojjam_id','!=',$mojjam_id)->selection()->get();
            $sentences=Sentence::with('word')->where('word_id',$word->id)->selection()->get();
            return view('front.wordsearch',compact('word','word_indications','mojjam','wordmeaning','similarwords','words_meanings_othermojjams','sentences'));
            }
            catch(\Exception $ex){
                return redirect()->route('home');
            }
        }

        public function expression($id)
        {
            try{
            $word=Word::with('meanings')->where('word_type',2)->inRandomOrder()->get()->first();
            $word_indications=Wordindication::selection()->get();
            $mojjam_id=$id;
            $wordmeaning=Meaning::where('word_id',$word->id)->where('mojjam_id',$mojjam_id)->selection()->get()->first();
            if (!$wordmeaning) {
                return redirect()->route('home');
            }
            $mojjam=Mojjam::where('id',$mojjam_id)->selection()->get()->first();
            $similarwords=Word::with('meanings')->where('word', 'like',"%" . $word ."%")->where('id','!=',$word->id)->selection()->limit(3)->get();
            $words_meanings_othermojjams=Meaning::with('word','mojjam')->where('word_id',$word->id)->where('mojjam_id','!=',$mojjam_id)->selection()->get();
            $sentences=Sentence::with('word')->where('word_id',$word->id)->selection()->get();
            return view('front.wordsearch',compact('word','word_indications','mojjam','wordmeaning','similarwords','words_meanings_othermojjams','sentences'));
            }
            catch(\Exception $ex){
                return redirect()->route('home');
            }
        }
}
