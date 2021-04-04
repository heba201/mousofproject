<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wisdom;
use App\Models\WisdomSayingsubject;
use App\Models\Character;
class WisdomsController extends Controller
{
    public function index()
    {
        $wisdoms = Wisdom::with('wisdomsubject','character')->inRandomOrder()->selection()->paginate(5);
        //$wisdoms=Wisdom::inRandomOrder()->get();
        $wisdomSayingsubjects=WisdomSayingsubject::inRandomOrder()->selection()->limit(10)->get();
        $characters=Character::inRandomOrder()->selection()->limit(10)->get();
       // return view('front.wisdoms.wisdoms',compact('wisdoms','wisdomSayingsubjects','characters'));
       return view('front.wisdoms.wisdoms',compact('wisdoms','wisdomSayingsubjects','characters'));

    }


public function wisdomsubject($id)
    {
        $wisdoms = Wisdom::where('wisdomsayingsubject_id',$id)->inRandomOrder()->selection()->paginate(5);
        if (!$wisdoms) {
            return redirect()->route('wisdoms')->with(['error' => 'لا توجد نتائج للبحث برجاء المحاولة في وقت لاحق']);
        }
        $wisdomSayingsubjects=WisdomSayingsubject::inRandomOrder()->selection()->limit(10)->get();
        $characters=Character::inRandomOrder()->selection()->limit(10)->get();
        return view('front.wisdoms.wisdomssubject',compact('wisdoms','wisdomSayingsubjects','characters'));
    }
    public function wisdomcharacter($id){
        $wisdoms = Wisdom::where('character_id',$id)->inRandomOrder()->selection()->paginate(5);
        $wisdomSayingsubjects=WisdomSayingsubject::inRandomOrder()->selection()->limit(10)->get();
        $characters=Character::inRandomOrder()->selection()->limit(10)->get();
        //$wisdomtags=explode(",",$wisdoms[0]->wisdom_tag);
        if ($wisdoms->count() ==0) {
            return redirect()->route('wisdoms');
        }
       // return view('front.wisdoms.wisdomscharacter',compact('wisdoms','wisdomSayingsubjects','characters'));
        return view('front.wisdoms.wisdomscharacter',compact('wisdoms','wisdomSayingsubjects','characters'));
    }

    public function wisdomtag($tag){
        $wisdoms = Wisdom::with('character')->where('wisdom_tag', 'LIKE', '%'.$tag.'%')->inRandomOrder()->selection()->paginate(5);
        $wisdomSayingsubjects=WisdomSayingsubject::inRandomOrder()->selection()->limit(10)->get();
        $characters=Character::inRandomOrder()->selection()->limit(10)->get();
        //$wisdomtags=explode(",",$wisdoms->wisdom_tag);
        if ($wisdoms->count() ==0) {
            return redirect()->route('wisdoms');
        }
       // return view('front.wisdoms.wisdomscharacter',compact('wisdoms','wisdomSayingsubjects','characters'));
        return view('front.wisdoms.wisdomstag',compact('wisdoms','wisdomSayingsubjects','characters'));
    }

    public function  wisdomsearch(Request $request){

        try {
        if ($request->has('search')) {
            $filteredsearch=filter_var($request->search,FILTER_SANITIZE_STRING);
            $wisdoms = Wisdom::with('character')->where('wisdom', 'LIKE', '%'.$filteredsearch.'%')->inRandomOrder()->selection()->paginate(5);
            $wisdomSayingsubjects=WisdomSayingsubject::inRandomOrder()->selection()->limit(10)->get();
            $characters=Character::inRandomOrder()->selection()->limit(10)->get();
            if ($wisdoms->count() ==0) {
                return redirect()->route('wisdoms');
            }
            return view('front.wisdoms.wisdomscharacter',compact('wisdoms','wisdomSayingsubjects','characters'));
        }
        } catch(\Exception $ex){
        return redirect()->route('wisdoms');
    }
    }
    public function  allwisdomcharacter($id){
        $wisdoms = Wisdom::with('character')->where('character_id',$id)->inRandomOrder()->selection()->paginate(5);
        $wisdomSayingsubjects=WisdomSayingsubject::inRandomOrder()->selection()->limit(10)->get();
        $characters=Character::inRandomOrder()->selection()->limit(10)->get();
        if ($wisdoms->count() ==0) {
            return redirect()->route('wisdoms');
        }
        return view('front.wisdoms.allwisdomscharacter',compact('wisdoms','wisdomSayingsubjects','characters'));

    }
}
