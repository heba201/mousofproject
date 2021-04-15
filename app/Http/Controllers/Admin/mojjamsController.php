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
        $mojjamspecialties =MojjamSpecialty::selection()->get();
        $mojjamarrangetypes=MojjamArrangetype::selection()->get();
        $mojjammethods=MojjamMethod::selection()->get();
        return view('admin.mojjams.create',compact('mojjamsauthors','mojjamspecialties','mojjamarrangetypes','mojjammethods'));
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
          $mojjam = Mojjam::create([
                'mojjam_name' => $request->name,
                'admin_id' =>Auth::user()->id,
                'author_id' => $request->author_id,
                'mojjamarrangetype_id' =>$request->mojjamarrangetype_id,
                'mojjammethod_id' =>$request->mojjammethod_id,
                'example' =>$example,
                'mojjamspecialty_id' => $request->mojjamspecialty_id
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
            $mojjamspecialties =MojjamSpecialty::selection()->get();
            $mojjamarrangetypes=MojjamArrangetype::selection()->get();
            $mojjammethods=MojjamMethod::selection()->get();
            if (!$mojjam)
                return redirect()->route('admin.mojjams')->with(['error' => 'هذا المعجم غير موجود او ربما يكون محذوفا ']);

            return view('admin.mojjams.edit', compact('mojjam','mojjamsauthors','mojjamspecialties','mojjamarrangetypes','mojjammethods'));

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


              if ($mojjam) {
                $mojjam::where('id', $id)
                ->update([
                    'mojjam_name' => $request->name,
                    'admin_id'=> Auth::user()->id,
                    'author_id' => $request->author_id,
                    'mojjamarrangetype_id' =>$request->mojjamarrangetype_id,
                    'mojjammethod_id' =>$request->mojjammethod_id,
                    'example' =>$example,
                    'mojjamspecialty_id' => $request->mojjamspecialty_id
                ]);
              }

            return redirect()->route('admin.mojjams')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.mojjams')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function destroy($id)
    {

        try {
            $mojjam = Mojjam::find($id);
            $meanings = $mojjam->mojjammeanings();

            if (!$mojjam){
                return redirect()->route('admin.mojjams')->with(['error' => 'هذا المعجم غير موجود ']);
            }
            if ($meanings->count()>0) {
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
