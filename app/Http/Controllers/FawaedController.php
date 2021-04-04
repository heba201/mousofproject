<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faedasubject;
use App\Models\Faeda;
use DB;


class FawaedController extends Controller
{
    public function index()
    {
        $faedasubjects=Faedasubject::with('fawed')->inRandomOrder()->selection()->paginate(3);

        //print_r($fawaed);
        return view('front.fawaed.fawaed',compact('faedasubjects'));
    }

    public function faedasearch(Request $request)
    {
        try{
        if(isset($_POST['search'])){
            $filteredsearch=filter_var($request->search,FILTER_SANITIZE_STRING);
            $faedasearch = Faeda::with('fawedsubject')->where('faeda', 'LIKE', '%'.$filteredsearch.'%')->selection()->get()->first();
           $faedatexts=explode(",", $faedasearch->faeda);
           if (!$faedasearch) {
                return redirect()->route('fawaed');
            }
            $faedasubjects=Faedasubject::with('fawed')->where('id','=',$faedasearch->faeda_subject_id)->get()->first();
            return view('front.fawaed.fawaedsearch',compact('faedasubjects','filteredsearch'));
        }
        } catch(\Exception $ex){
            return redirect()->route('fawaed');
        }
    }
}
