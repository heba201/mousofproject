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
use App\Models\Mojjam;

class HomeController extends Controller
{
    public function index()
    {
        $characters = Character::selection()->limit(2)->get();
        $articles = Article::selection()->limit(2)->get();
        $lessons = Lesson::selection()->limit(3)->get();
        $sayings =Saying::with('character')->selection()->limit(2)->get();
        $fawaed =Faeda::with('fawedsubject')->selection()->limit(2)->get();
        $wisdomtoday = Wisdom::inRandomOrder()->first();
        $wordcount=Word::count();
        $wordtoday=Word::with('meanings')->inRandomOrder()->whereIn('word_type',['0','1'])->first();
        $meanings=Meaning::where('word_id','=',$wordtoday->id)->selection()->get();
        //print_r($meanings);
        $wordsgroup=$wordtoday::where('word','=',$wordtoday->word)->selection()->get();
        return view('index',compact('characters','articles','lessons','sayings','fawaed','wisdomtoday','wordtoday','meanings','wordsgroup'));
    }

    public function wordsearch(Request $request){
        try {
        if(isset($_POST['search'])){
            $filteredsearch=filter_var($request->search,FILTER_SANITIZE_STRING);
          $word =Word::with('meanings')->where('word', 'LIKE', '%'.$filteredsearch. '%')->selection()->first();
           $mojjam_id=$request->mojjam_id;
           $wordmeaning=Meaning::where('word_id',$word->id)->where('mojjam_id',$mojjam_id)->selection()->get()->first();
           $mojjam=Mojjam::where('id',$mojjam_id)->selection()->get()->first();
           $similarwords=Word::with('meanings')->where('word', 'LIKE','%' . $filteredsearch .'%')->where('id','!=',$word->id)->selection()->limit(3)->get();
           $words_meanings_othermojjams=Meaning::with('word','mojjam')->where('word_id',$word->id)->where('mojjam_id','!=',$mojjam_id)->selection()->get();
           $sentences=Sentence::with('word')->where('word_id',$word->id)->selection()->get();
           return view('front.wordsearch',compact('word','mojjam','wordmeaning','similarwords','words_meanings_othermojjams','sentences'));
        }
    }
        catch(\Exception $ex){
            return redirect()->route('home');
        }

    }
    public function wordmojjam($id,$searchword)
    {
       try{
        $word =Word::with('meanings')->where('word', 'LIKE', '%'.$searchword. '%')->selection()->first();
        $wordmeaning=Meaning::where('word_id',$word->id)->where('mojjam_id',$id)->selection()->get()->first();
        $mojjam=Mojjam::where('id',$id)->selection()->get()->first();
        $similarwords=Word::with('meanings')->where('word', 'LIKE','%' . $searchword .'%')->where('id','!=',$word->id)->selection()->limit(3)->get();
        $words_meanings_othermojjams=Meaning::with('word','mojjam')->where('word_id',$word->id)->where('mojjam_id','!=',$id)->selection()->get();
        $sentences=Sentence::with('word')->where('word_id',$word->id)->selection()->get();
        return view('front.wordsearch',compact('word','mojjam','wordmeaning','similarwords','words_meanings_othermojjams','sentences'));

}  catch(\Exception $ex){
    return redirect()->route('home');
}
}

public function getwordmaningmojjam($id){
    try {


       $word=Word::with('meanings')->inRandomOrder()->get()->first();
       $mojjam_id=$id;
       $wordmeaning=Meaning::where('word_id',$word->id)->where('mojjam_id',$mojjam_id)->selection()->get()->first();
       $mojjam=Mojjam::where('id',$mojjam_id)->selection()->get()->first();
       $similarwords=Word::with('meanings')->where('word', 'LIKE','%' . $word .'%')->where('id','!=',$word->id)->selection()->limit(3)->get();
       $words_meanings_othermojjams=Meaning::with('word','mojjam')->where('word_id',$word->id)->where('mojjam_id','!=',$mojjam_id)->selection()->get();
       $sentences=Sentence::with('word')->where('word_id',$word->id)->selection()->get();
      if (!$word ||  !$wordmeaning) {
        return redirect()->route('home');
      }
       return view('front.wordsearch',compact('word','mojjam','wordmeaning','similarwords','words_meanings_othermojjams','sentences'));
}
    catch(\Exception $ex){
        return redirect()->route('home');
    }

}
        public function composedword($id)
        {
            try {
            $word=Word::with('meanings')->where('word_type',3)->inRandomOrder()->get()->first();
            $mojjam_id=$id;
            $wordmeaning=Meaning::where('word_id',$word->id)->where('mojjam_id',$mojjam_id)->selection()->get()->first();
            if (!$wordmeaning) {
                return redirect()->route('home');
            }
            $mojjam=Mojjam::where('id',$mojjam_id)->selection()->get()->first();
            $similarwords=Word::with('meanings')->where('word', 'LIKE','%' . $word .'%')->where('id','!=',$word->id)->selection()->limit(3)->get();
            $words_meanings_othermojjams=Meaning::with('word','mojjam')->where('word_id',$word->id)->where('mojjam_id','!=',$mojjam_id)->selection()->get();
            $sentences=Sentence::with('word')->where('word_id',$word->id)->selection()->get();
            return view('front.wordsearch',compact('word','mojjam','wordmeaning','similarwords','words_meanings_othermojjams','sentences'));
            }
            catch(\Exception $ex){
                return redirect()->route('home');
            }
        }

        public function expression($id)
        {
            try{
            $word=Word::with('meanings')->where('word_type',2)->inRandomOrder()->get()->first();
            $mojjam_id=$id;
            $wordmeaning=Meaning::where('word_id',$word->id)->where('mojjam_id',$mojjam_id)->selection()->get()->first();
            if (!$wordmeaning) {
                return redirect()->route('home');
            }
            $mojjam=Mojjam::where('id',$mojjam_id)->selection()->get()->first();
            $similarwords=Word::with('meanings')->where('word', 'LIKE','%' . $word .'%')->where('id','!=',$word->id)->selection()->limit(3)->get();
            $words_meanings_othermojjams=Meaning::with('word','mojjam')->where('word_id',$word->id)->where('mojjam_id','!=',$mojjam_id)->selection()->get();
            $sentences=Sentence::with('word')->where('word_id',$word->id)->selection()->get();
            return view('front.wordsearch',compact('word','mojjam','wordmeaning','similarwords','words_meanings_othermojjams','sentences'));
            }
            catch(\Exception $ex){
                return redirect()->route('home');
            }
        }
}
