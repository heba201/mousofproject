<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wisdom;
use App\Models\WisdomSayingsubject;
use App\Models\Character;
use App\Models\Saying;
use App\Models\Meaning;
use App\Models\Word;
use App\Models\Faeda;

class SayingsController extends Controller
{
    public function index()
    {
        $characters=Character::inRandomOrder()->selection()->limit(9)->get();
        $wisdomSayingsubjects=WisdomSayingsubject::inRandomOrder()->selection()->limit(9)->get();
        $sayings=Saying::with('character','saysubject')->inRandomOrder()->selection()->paginate(5);
       if ($sayings->count()==0 || $sayings->count()==0 || $characters->count()==0 || $wisdomSayingsubjects->count()==0) {
           return redirect()->route('home');
       }
       $wordtoday=Word::with('meanings')->inRandomOrder()->whereIn('word_type',['0','1'])->first();
       $wordtodaymeaning=Meaning::where('word_id','=',$wordtoday->id)->selection()->first();
       $wordgroups= Word::with('meanings')->where('word', 'LIKE', '%'.$wordtoday->word.'%')->selection()->limit(3)->get();
       $wordgroupmeaning=Meaning::where('word_id','=',$wordgroups[0]->id)->selection()->get();
       $wisdomtoday = Wisdom::with('character')->inRandomOrder()->first();
       $faedatoday=Faeda::with('fawedsubject')->inRandomOrder()->first();
       return view('front.saying.sayings',compact('characters','wisdomSayingsubjects','sayings','wordtoday','wordtodaymeaning','wordgroups','wordgroupmeaning','wisdomtoday','faedatoday'));
    }

     public function allsayingcharacter($id)
    {
        $sayings = Saying::with('character')->where('character_id',$id)->inRandomOrder()->selection()->paginate(5);
        $wisdomSayingsubjects=WisdomSayingsubject::inRandomOrder()->selection()->limit(9)->get();
        $characters=Character::inRandomOrder()->selection()->limit(9)->get();
        $wordtoday=Word::with('meanings')->inRandomOrder()->whereIn('word_type',['0','1'])->first();
        $wordtodaymeaning=Meaning::where('word_id','=',$wordtoday->id)->selection()->first();
        //print_r($wordtoday);
        $wordgroups= Word::with('meanings')->where('word', 'LIKE', '%'.$wordtoday->word.'%')->selection()->limit(3)->get();
        $wordgroupmeaning=Meaning::where('word_id','=',$wordgroups[0]->id)->selection()->get();
        $wisdomtoday = Wisdom::with('character')->inRandomOrder()->first();
        $faedatoday=Faeda::with('fawedsubject')->inRandomOrder()->first();

        if ( $sayings->count() ==0) {
            return redirect()->route('sayings');
        }
        return view('front.saying.allsayingscharacter',compact('sayings','wisdomSayingsubjects','characters','wordtoday','wordtodaymeaning','wordgroups','wordgroupmeaning','wisdomtoday','faedatoday'));
    }

    public function sayingtag($tag){
        $sayings = Saying::with('character')->where('saying_tag', 'LIKE', '%'.$tag.'%')->inRandomOrder()->selection()->paginate(5);
        $wisdomSayingsubjects=WisdomSayingsubject::inRandomOrder()->selection()->limit(10)->get();
        $characters=Character::inRandomOrder()->selection()->limit(10)->get();
        //$wisdomtags=explode(",",$wisdoms->wisdom_tag);
        if ($sayings->count() ==0) {
            return redirect()->route('sayings');
        }
        $wordtoday=Word::with('meanings')->inRandomOrder()->whereIn('word_type',['0','1'])->first();
        $wordtodaymeaning=Meaning::where('word_id','=',$wordtoday->id)->selection()->first();
        //print_r($wordtoday);
        $wordgroups= Word::with('meanings')->where('word', 'LIKE', '%'.$wordtoday->word.'%')->selection()->limit(3)->get();
        $wordgroupmeaning=Meaning::where('word_id','=',$wordgroups[0]->id)->selection()->get();
        $wisdomtoday = Wisdom::with('character')->inRandomOrder()->first();
        $faedatoday=Faeda::with('fawedsubject')->inRandomOrder()->first();
       // return view('front.wisdoms.wisdomscharacter',compact('wisdoms','wisdomSayingsubjects','characters'));
        return view('front.saying.sayingtag',compact('sayings','wisdomSayingsubjects','characters','wordtoday','wordtodaymeaning','wordgroups','wordgroupmeaning','wisdomtoday','faedatoday'));
    }
     public function sayingsubject($id)
    {
        $sayings = Saying::where('wisdomsayingsubject_id',$id)->inRandomOrder()->selection()->paginate(5);
        if (!$sayings) {
            return redirect()->route('sayings');
        }
        $wisdomSayingsubjects=WisdomSayingsubject::inRandomOrder()->selection()->limit(9)->get();
        $characters=Character::inRandomOrder()->selection()->limit(9)->get();
        $wordtoday=Word::with('meanings')->inRandomOrder()->whereIn('word_type',['0','1'])->first();
        $wordtodaymeaning=Meaning::where('word_id','=',$wordtoday->id)->selection()->first();
        //print_r($wordtoday);
        $wordgroups= Word::with('meanings')->where('word', 'LIKE', '%'.$wordtoday->word.'%')->selection()->limit(3)->get();
        $wordgroupmeaning=Meaning::where('word_id','=',$wordgroups[0]->id)->selection()->get();
        $wisdomtoday = Wisdom::with('character')->inRandomOrder()->first();
        $faedatoday=Faeda::with('fawedsubject')->inRandomOrder()->first();

        return view('front.saying.sayingsubject',compact('sayings','wisdomSayingsubjects','characters','wordtoday','wordtodaymeaning','wordgroups','wordgroupmeaning','wisdomtoday','faedatoday'));
    }

    public function  sayingsearch(Request $request){

        if ($request->has('search')) {
            $filteredsearch=filter_var($request->search,FILTER_SANITIZE_STRING);
            $sayings =Saying::with('character')->where('saying', 'LIKE', '%'.$filteredsearch.'%')->inRandomOrder()->selection()->paginate(5);
            $wisdomSayingsubjects=WisdomSayingsubject::inRandomOrder()->selection()->limit(9)->get();
            $characters=Character::inRandomOrder()->selection()->limit(9)->get();
            if ($sayings->count() ==0) {
                return redirect()->route('sayings');
            }
        $wordtoday=Word::with('meanings')->inRandomOrder()->whereIn('word_type',['0','1'])->first();
        $wordtodaymeaning=Meaning::where('word_id','=',$wordtoday->id)->selection()->first();
        //print_r($wordtoday);
        $wordgroups= Word::with('meanings')->where('word', 'LIKE', '%'.$wordtoday->word.'%')->selection()->limit(3)->get();
        $wordgroupmeaning=Meaning::where('word_id','=',$wordgroups[0]->id)->selection()->get();
        $wisdomtoday = Wisdom::with('character')->inRandomOrder()->first();
        $faedatoday=Faeda::with('fawedsubject')->inRandomOrder()->first();
            return view('front.saying.sayingcharacter',compact('sayings','wisdomSayingsubjects','characters','wordtoday','wordtodaymeaning','wordgroups','wordgroupmeaning','wisdomtoday','faedatoday'));
        }
    }
}
