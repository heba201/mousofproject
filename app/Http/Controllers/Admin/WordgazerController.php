<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\WordgazerRequest;
use App\Models\Wordgazer;
use Auth;
use DB;

class WordgazerController extends Controller
{
    public function index()
    {

        $words_gazer = Wordgazer::selection()->get();

        return view('admin.word_gazer.index', compact('words_gazer'));
    }

    public function create()
    {
        return view('admin.word_gazer.create');
    }

    public function store(WordgazerRequest $request)
    {

        //return $request;
       try {

          if(getold('App\Models\Wordgazer','word_gazer',$request->gazer)){
          return redirect()->route('admin.wordgazer')->with(['error' => 'هذا الجذر تم اضافته من قبل']);
          }
          $word_gazer = Wordgazer::create([
                'word_gazer' => $request->gazer,
                'admin_id' =>Auth::user()->id
            ]);
            return redirect()->route('admin.wordgazer')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.wordgazer')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id)
    {
        try {

            $word_gazer= Wordgazer::Selection()->find($id);
            if (!$word_gazer)
                return redirect()->route('admin.wordgazer')->with(['error' => 'هذا الجذر غير موجود او ربما يكون محذوفا ']);

            return view('admin.word_gazer.edit',compact('word_gazer'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.wordgazer')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }



    public function update($id, WordgazerRequest $request)
    {

        try {


            if(getresult('App\Models\Wordgazer','word_gazer',$request->gazer,'id',$id))
            {
                return redirect()->route('admin.wordgazer')->with(['error' => 'هذا الجذر تم اضافته من قبل']);
                }

                $word_gazer= Wordgazer::Selection()->find($id);
                if (!$word_gazer)
                return redirect()->route('admin.wordgazer')->with(['error' => 'هذا الجذر غير موجود او ربما يكون محذوفا ']);
              if ($word_gazer) {
                $word_gazer::where('id', $id)
                ->update([
                    'word_gazer' => $request->gazer,
                    'admin_id' =>Auth::user()->id
                ]);
              }

            return redirect()->route('admin.wordgazer')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.wordgazer')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function show($id)
    {
        $word_gazer= Wordgazer::Selection()->find($id);
        if (!$word_gazer)
                return redirect()->route('admin.wordgazer')->with(['error' => 'هذا الجذر غير موجود او ربما يكون محذوفا ']);
        return view('admin.word_gazer.show',compact('word_gazer'));
    }

    public function destroy($id)
    {

        try {
            $wods_gazer= Wordgazer::Selection()->find($id);
            $words = $wods_gazer->words();

            if (!$wods_gazer)
                return redirect()->route('admin.wordgazer')->with(['error' => 'هذا الجذر غير موجود او ربما يكون محذوفا ']);
            if ($words->count()>0) {
                return redirect()->route('admin.wordgazer')->with(['error' => 'لا يمكن حذف هذا الجذر']);
            }

            $wods_gazer->delete();
            return redirect()->route('admin.wordgazer')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.wordgazer')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
