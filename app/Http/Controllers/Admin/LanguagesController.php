<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LanguageRequest;
use App\Models\Language;
use Auth;
use DB;
class LanguagesController extends Controller
{
    public function index()
    {

        $languages = Language::selection()->get();

        return view('admin.languages.index', compact('languages'));
    }
    public function create()
    {

        return view('admin.languages.create');
    }

    public function store(LanguageRequest $request)
    {

        //return $request;
       try {

          if(getold('App\Models\Language','language',$request->lang_name)){
          return redirect()->route('admin.languages')->with(['error' => 'هذه اللغة تم اضافتها من قبل']);
          }

          $language = Language::create([
                'language' => $request->lang_name,
                'admin_id' =>Auth::user()->id
            ]);
            return redirect()->route('admin.languages')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.languages')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id)
    {
        try {

            $language= Language::Selection()->find($id);
            if (!$language)
                return redirect()->route('admin.languages')->with(['error' => 'هذه اللغة غير موجودة او ربما تكون محذوفة ']);

            return view('admin.languages.edit', compact('language'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.languages')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function update($id, LanguageRequest $request)
    {

        try {

                if(getresult('App\Models\Language','language',$request->lang_name,'id',$id)){
                    return redirect()->route('admin.languages')->with(['error' => 'هذه اللغة تم اضافتها من قبل']);
                }

                $language= Language::Selection()->find($id);
                if (!$language)
                return redirect()->route('admin.languages')->with(['error' => 'هذه اللغة غير موجودة او ربما تكون محذوفة ']);
              if ($language) {
                $language::where('id', $id)
                ->update([
                'language' => $request->lang_name,
                'admin_id' =>Auth::user()->id
                ]);
              }

            return redirect()->route('admin.languages')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.languages')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function show($id)
    {
        $language= Language::Selection()->find($id);
        if (!$language)
        return redirect()->route('admin.languages')->with(['error' => 'هذه اللغة غير موجودة او ربما تكون محذوفة ']);
        return view('admin.languages.show',compact('language'));
    }

    public function destroy($id)
    {

        try {
            $language= Language::Selection()->find($id);
            $mojjams = $language->mojjams();

            if (!$language)
            return redirect()->route('admin.languages')->with(['error' => 'هذه اللغة غير موجودة او ربما تكون محذوفة ']);
            if ($mojjams->count()>0) {
                return redirect()->route('admin.languages')->with(['error' => 'لا يمكن حذف هذه اللغة']);
            }

            $language->delete();
            return redirect()->route('admin.languages')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.languages')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
