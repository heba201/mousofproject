<?php

namespace App\Http\Controllers;
use App\Models\Namemeaning;
use App\Models\Nameorigin;
use App\Models\Namesmeanings_search;
use DB;
use Str;

use Illuminate\Http\Request;

class NamesmeaningsController extends Controller
{
    public function index()
    {
        $namesmeanings=Namemeaning::with('nameorigin')->inRandomOrder()->selection()->get()->first();
        $related=  $namesmeanings->name ;
        //$namessame=Namemeaning::whereLike('name',$related)->where('id','!=',$namesmeanings->id)->selection()->get();
        //if(strlen($related) > 3){
        $text = substr($related,0,2);
        //}
        $namesorigins=Nameorigin::inRandomOrder()->selection()->get();
        $namessame = DB::table('names_meanings')->where('name','LIKE' ,$text.'%')->get();//DB table method
        $boysnames=Namemeaning::where('name_type','=',0)->inRandomOrder()->selection()->get();
        $girlsnames=Namemeaning::where('name_type','=',1)->inRandomOrder()->selection()->get();
        $moresearchednames =  DB::table('namesmeanings_search')
        ->select('name', DB::raw("(select max('search_no') from namesmeanings_search)"))
        ->take(10)->get();
        return view('front.namesmeanings.namesmeanings',compact('namesmeanings','namessame','namesorigins','boysnames','girlsnames','moresearchednames'));

    }

    public function namesrelated($name)
    {

        $namesmeanings=Namemeaning::with('nameorigin')->where('name','LIKE' ,'%'.$name.'%')->get()->first();

        $related=  $namesmeanings->name ;
        $text = substr($related,0,2);
        $namessame = DB::table('names_meanings')->where('name','LIKE' ,$text.'%')->get();//DB table method
        $boysnames=Namemeaning::where('name_type','=',0)->inRandomOrder()->selection()->get();
        $girlsnames=Namemeaning::where('name_type','=',1)->inRandomOrder()->selection()->get();
        $moresearchednames =  DB::table('namesmeanings_search')
        ->select('name', DB::raw("(select max('search_no') from namesmeanings_search)"))
        ->take(10)->get();

        if (!$namesmeanings) {
            return redirect()->route('namesmeanings');
        }
        return view('front.namesmeanings.namesmeanings_name',compact('namesmeanings','namessame','boysnames','girlsnames','moresearchednames'));
    }

    public function namesmeanings_origin($id)
    {
        try{
            $namesorigin= Nameorigin::Selection()->find($id);
            if (!$namesorigin) {
                return redirect()->route('namesmeanings');
            }
            $namesmeanings=$namesorigin->namemeanings()->paginate(3);
            $related=  $namesmeanings[0]->name ;
            $text = substr($related,0,2);
            $namessame = DB::table('names_meanings')->where('name','LIKE' ,$text.'%')->get();
            $boysnames=Namemeaning::where('name_type','=',0)->inRandomOrder()->selection()->get();
            $girlsnames=Namemeaning::where('name_type','=',1)->inRandomOrder()->selection()->get();
            $moresearchednames =  DB::table('namesmeanings_search')
            ->select('name', DB::raw("(select max('search_no') from namesmeanings_search)"))
            ->take(10)->get();

            return view('front.namesmeanings.namesmeanings_origin',compact('namesmeanings','namessame','boysnames','girlsnames','moresearchednames'));
        }
        catch(\Exception $ex){

            return redirect()->route('namesmeanings');
        }
    }
    public function namemeaningsearch(Request $request)
    {
        if(isset($_POST['search'])){
        $filteredsearch=filter_var($request->search,FILTER_SANITIZE_STRING);
        $namesmeanings =Namemeaning::with('nameorigin')->where('name', '=', $filteredsearch)->selection()->get()->first();
        $related=  $namesmeanings->name ;
        $text = substr($related,0,2);
        $namessame = DB::table('names_meanings')->where('name','LIKE' ,$text.'%')->get();//DB table method
        $boysnames=Namemeaning::where('name_type','=',0)->inRandomOrder()->selection()->get();
        $girlsnames=Namemeaning::where('name_type','=',1)->inRandomOrder()->selection()->get();
        $moresearchednames =  DB::table('namesmeanings_search')
        ->select('name', DB::raw("(select max('search_no') from namesmeanings_search)"))
        ->take(10)->get();

        $namefound=Namesmeanings_search::where('namemeaning_id','=', $namesmeanings->id)->selection()->get()->first();
        if ($namefound) {
            $no_search=$namefound->search_no + 1;
            $namefound::where('id',$namefound->id)->update([
                'search_no' =>$no_search
            ]);
        }

        if (!$namefound){
        $namemaning_search = Namesmeanings_search::create([
            'name' =>  $namesmeanings->name,
            'namemeaning_id' =>$namesmeanings->id,
            'search_no' =>1,
        ]);
        }
        if (!$namesmeanings) {
            return redirect()->route('namesmeanings');
        }
        return view('front.namesmeanings.namesmeanings_name',compact('namesmeanings','namessame','boysnames','girlsnames','moresearchednames'));
    }
    }
}
