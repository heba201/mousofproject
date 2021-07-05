<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\WordgazerRequest;
use App\Models\Wordgazer;
use App\Models\Mojjam;
use App\Models\Word;
use Auth;
use DB;

class WordgazerController extends Controller
{
    public function index()
    {

        $words_gazer = Wordgazer::selection()->get();

        return view('admin.word_gazer.index', compact('words_gazer'));
    }

    public function create($id)
    {
        $mojjam = Mojjam::Selection()->find($id);
        if (!$mojjam)
        return redirect()->route('admin.mojjams')->with(['error' => 'هذاالمعجم غير موجود او ربما يكون محذوفا ']);
        return view('admin.word_gazer.create',compact('mojjam'));
    }

    public function store(WordgazerRequest $request)
    {

        //return $request;
       try {
           $gazermojjam=Wordgazer::where('mojjam_id',$request->mojjam_id)->where('word_gazer',$request->gazer)->selection()->get()->first();
          print_r($gazermojjam);
           if($gazermojjam){
          return redirect()->route('admin.wordgazer.create',$gazermojjam->mojjam_id)->with(['error' => 'هذا الجذر تم اضافته من قبل']);
          }
          $word_gazer = Wordgazer::create([
                'word_gazer' => $request->gazer,
                'mojjam_id' => $request->mojjam_id,
                'admin_id' =>Auth::user()->id
            ]);
            return redirect()->route('admin.mojjams.showgzor',$request->mojjam_id)->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.mojjams.showgzor',$request->mojjam_id)->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id,$mojjam_id)
    {
        try {

            $word_gazer= Wordgazer::Selection()->find($id);
            $mojjam = Mojjam::Selection()->find($mojjam_id);
            if (!$word_gazer)
                return redirect()->route('admin.mojjams.showgzor',$mojjam->id)->with(['error' => 'هذا الجذر غير موجود او ربما يكون محذوفا ']);

            return view('admin.word_gazer.edit',compact('word_gazer','mojjam'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.mojjams.showgzor',$mojjam->id)->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }



    public function update($id,$mojjam_id ,WordgazerRequest $request)
    {

        try {


            if(getresult('App\Models\Wordgazer','word_gazer',$request->gazer,'id',$id))
            {
                return redirect()->route('admin.wordgazer')->with(['error' => 'هذا الجذر تم اضافته من قبل']);
                }

                $word_gazer= Wordgazer::Selection()->find($id);
                $mojjam = Mojjam::Selection()->find($mojjam_id);
                if (!$word_gazer)
                return redirect()->route('admin.mojjams.showgzor',$mojjam->id)->with(['error' => 'هذا الجذر غير موجود او ربما يكون محذوفا ']);
              if ($word_gazer) {
                $word_gazer::where('id', $id)
                ->update([
                    'word_gazer' => $request->gazer,
                    'mojjam_id' => $mojjam->id,
                    'admin_id' =>Auth::user()->id
                ]);
              }

            return redirect()->route('admin.mojjams.showgzor',$mojjam->id)->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin..mojjams.showgzor',$mojjam->id)->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function show($id,$mojjam_id)
    {
        $word_gazer= Wordgazer::Selection()->find($id);
        $mojjam= Mojjam::Selection()->find($mojjam_id);
        if (!$word_gazer)
                return redirect()->route('admin.mojjams.showgzor',$mojjam->id)->with(['error' => 'هذا الجذر غير موجود او ربما يكون محذوفا ']);
        return view('admin.word_gazer.show',compact('word_gazer','mojjam'));
    }

    public function destroy($id,$mojjam_id)
    {

        try {
            $word_gazer= Wordgazer::where('id',$id)->where('mojjam_id',$mojjam_id)->selection()->first();
            $mojjam= Mojjam::Selection()->find($mojjam_id);
            $wordgazerexist=Word::where('mojjam_id',$mojjam_id)->where('word_gzer',$id)->selection()->get();
            if (!$word_gazer)
                return redirect()->route('admin.mojjams.showgzor',$mojjam->id)->with(['error' => 'هذا الجذر غير موجود او ربما يكون محذوفا ']);
            if ($wordgazerexist->count()>0) {
                return redirect()->route('admin.mojjams.showgzor',$mojjam->id)->with(['error' => 'لا يمكن حذف هذا الجذر']);
            }

            $word_gazer->delete();
            return redirect()->route('admin.mojjams.showgzor',$mojjam->id)->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.mojjams.showgzor',$mojjam->id)->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
