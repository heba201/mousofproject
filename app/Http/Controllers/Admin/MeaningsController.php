<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Meaning;
use App\Models\Word;
use App\Http\Requests\MeaningRequest;
use Auth;

class MeaningsController extends Controller
{
    public function index()
    {


        $words=Word::with('meanings')->get();
        $meanings = Meaning::select('meanings.*','mojjam_name','word')
        ->join('mojjams', 'mojjams.id', '=', 'meanings.mojjam_id')
        ->join('words', 'words.id', '=', 'meanings.word_id')
        ->orderBy('meanings.id','desc')
        ->get();
       return view('admin.meanings.index', compact('meanings'));
    }



    public function edit($id)
    {
        try {
            //$meaning = Meaning::with('word','mojjam')->where('id',$id)->get();
            $meaning = Meaning::select('meanings.*','mojjam_name','word')
            ->join('mojjams', 'mojjams.id', '=', 'meanings.mojjam_id')
            ->join('words', 'words.id', '=', 'meanings.word_id')
            ->orderBy('meanings.id','desc')
            ->where('meanings.id',$id)->get();
            if (!$meaning)
                return redirect()->route('admin.meanings')->with(['error' => 'هذا المعني غير موجود او ربما يكون محذوفا ']);

            return view('admin.meanings.edit', compact('meaning'));

        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.meanings')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function update($id,MeaningRequest $request)
    {

        try {

            $meaning = Meaning::Selection()->find($id);
            if (!$meaning){
                return redirect()->route('admin.meanings')->with(['error' => 'هذالمعني غير موجود او ربما يكون محذوفا ']);
            }
              if ($meaning) {
                $meaning::where('id', $id)
                ->update([
                    'word_meaning' => $request->word_meaning,
                    'admin_id'=> Auth::user()->id
                ]);
              }
            return redirect()->route('admin.meanings')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return redirect()->route('admin.meanings')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }



    public function destroy($id)
    {

        try {
            $meaning = Meaning::Selection()->find($id);
            if (!$meaning){
                return redirect()->route('admin.meanings')->with(['error' => 'هذا المعني غير موجود ']);
            }

            $meaning->delete();
            return redirect()->route('admin.meanings')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {

            return redirect()->route('admin.mojjams')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
