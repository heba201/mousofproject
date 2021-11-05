<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MojjamRequest;
use App\Models\Mojjam;
use App\Models\MojjamAuthor;
use App\Models\MojjamSpecialty;
use App\Models\MojjamArrangetype;
use App\Models\MojjamMethod;
use App\Models\Language;
use App\Models\Word;
use App\Models\Wordname;
use App\Models\Wordgazer;
use Auth;
use DB;
class mojjamsController extends Controller
{

    public function index()
    {

        $mojjams = Mojjam::selection()->get();

        return view('admin.mojjams.index', compact('mojjams'));
    }
    public function create()
    {
        $mojjamsauthors = MojjamAuthor::selection()->get();
        $languages = Language::selection()->get();
        $mojjamspecialties =MojjamSpecialty::selection()->get();
        $mojjamarrangetypes=MojjamArrangetype::selection()->get();
        $mojjammethods=MojjamMethod::selection()->get();
        return view('admin.mojjams.create',compact('mojjamsauthors','languages','mojjamspecialties','mojjamarrangetypes','mojjammethods'));
    }

    public function store(MojjamRequest $request)
    {

        //return $request;
       try {

          if(getold('App\Models\Mojjam','mojjam_name',$request->name)){
          return redirect()->route('admin.mojjams')->with(['error' => 'هذا المعجم تم اضافته من قبل']);
          }

          if ($request->input('example') !="") {
            $example=$request->example;
        }

             else{
                    $example='لا يوجد مثال';
                }

                if(isset($_POST['hasgazer'])){
                    $hasgazer=1;
                }else{
                    $hasgazer=0;
                }

          $mojjam = Mojjam::create([
                'mojjam_name' => $request->name,
                'admin_id' =>Auth::user()->id,
                'author_id' => $request->author_id,
                'language_id' => $request->language_id,
                'mojjamarrangetype_id' =>$request->mojjamarrangetype_id,
                'mojjammethod_id' =>$request->mojjammethod_id,
                'example' =>$example,
                'mojjamspecialty_id' => $request->mojjamspecialty_id,
                'hasgazer' => $hasgazer
            ]);
            return redirect()->route('admin.mojjams')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.mojjams')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id)
    {
        try {

            $mojjam= Mojjam::Selection()->find($id);
            $mojjamsauthors = MojjamAuthor::selection()->get();
            $languages = Language::selection()->get();
            $mojjamspecialties =MojjamSpecialty::selection()->get();
            $mojjamarrangetypes=MojjamArrangetype::selection()->get();
            $mojjammethods=MojjamMethod::selection()->get();
            if (!$mojjam)
                return redirect()->route('admin.mojjams')->with(['error' => 'هذا المعجم غير موجود او ربما يكون محذوفا ']);

            return view('admin.mojjams.edit', compact('mojjam','mojjamsauthors','languages','mojjamspecialties','mojjamarrangetypes','mojjammethods'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.mojjams')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function update($id, MojjamRequest $request)
    {

        try {

                if(getresult('App\Models\Mojjam','mojjam_name',$request->name,'id',$id)){
                    return redirect()->route('admin.mojjams')->with(['error' => 'هذا المعجم تم اضافته من قبل']);
                }

            $mojjam = mojjam::Selection()->find($id);
            if (!$mojjam){
                return redirect()->route('admin.mojjams')->with(['error' => 'هذاالمعجم غير موجود او ربما يكون محذوفا ']);
            }
            if ($request->input('example') !="") {
                $example=$request->example;
            }
                    else{
                        if($mojjam->example !=null){
                            $example=$mojjam->example;
                            }
                        else{
                        $example='لا يوجد مثال';
                    }
                }
                if(isset($_POST['hasgazer'])){
                    $hasgazer=1;
                }else{
                    $hasgazer=0;
                }

              if ($mojjam) {
                $mojjam::where('id', $id)
                ->update([
                    'mojjam_name' => $request->name,
                    'admin_id'=> Auth::user()->id,
                    'author_id' => $request->author_id,
                    'language_id' => $request->language_id,
                    'mojjamarrangetype_id' =>$request->mojjamarrangetype_id,
                    'mojjammethod_id' =>$request->mojjammethod_id,
                    'example' =>$example,
                    'mojjamspecialty_id' => $request->mojjamspecialty_id,
                    'hasgazer' => $hasgazer
                ]);
              }

            return redirect()->route('admin.mojjams')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.mojjams')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function show($id)
    {
        $mojjamsauthors = MojjamAuthor::selection()->get();
        $languages = Language::selection()->get();
        $mojjamspecialties =MojjamSpecialty::selection()->get();
        $mojjamarrangetypes=MojjamArrangetype::selection()->get();
        $mojjammethods=MojjamMethod::selection()->get();
        $mojjam = mojjam::Selection()->find($id);
        if (!$mojjam)
            return redirect()->route('admin.mojjams')->with(['error' => 'هذاالمعجم غير موجود او ربما يكون محذوفا ']);
        return view('admin.mojjams.show',compact('mojjam','languages','mojjamsauthors','mojjamspecialties','mojjamarrangetypes','mojjammethods'));
    }


    public function showwords($id)
    {
        $mojjam = Mojjam::Selection()->find($id);
        if (!$mojjam)
            return redirect()->route('admin.mojjams')->with(['error' => 'هذاالمعجم غير موجود او ربما يكون محذوفا ']);

            $mojjamwordsexist=$mojjam->words();
            $mojjamwords=Word::Selection()->where('mojjam_id','=',$id)->get();
            if($mojjamwordsexist->count()>0){

            return view('admin.mojjams.showwords',compact('mojjam','mojjamwords'));
            }
    }

    public function showgzor($id)
    {
        $mojjam = Mojjam::Selection()->find($id);
        if (!$mojjam)
            return redirect()->route('admin.mojjams')->with(['error' => 'هذاالمعجم غير موجود او ربما يكون محذوفا ']);

            $mojjamgazrexist=$mojjam->gzor()->selection()->get();

            if($mojjamgazrexist->count()>0){

            return view('admin.mojjams.showgzor',compact('mojjam','mojjamgazrexist'));
            }
    }



    public function destroy($id)
    {

        try {
            $mojjam = Mojjam::find($id);
            $meanings = $mojjam->mojjammeanings();
            $words = $mojjam->words();
            if (!$mojjam){
                return redirect()->route('admin.mojjams')->with(['error' => 'هذا المعجم غير موجود ']);
            }
            if ($meanings->count()>0 || $words->count()>0) {
                return redirect()->route('admin.mojjams')->with(['error' => 'لا يمكن حذف هذا المعجم']);
            }

            $mojjam->delete();
            return redirect()->route('admin.mojjams')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.mojjams')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
