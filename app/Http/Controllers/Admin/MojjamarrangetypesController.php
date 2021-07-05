<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MojjamarrangetypeRequest;
use App\Models\MojjamArrangetype;
use Auth;
use DB;

class MojjamarrangetypesController extends Controller
{
    public function index()
    {

        $mojjamarrangetypes=MojjamArrangetype::selection()->get();

        return view('admin.mojjamarrangetypes.index', compact('mojjamarrangetypes'));
    }


    public function create()
    {

        return view('admin.mojjamarrangetypes.create');
    }

    public function store(MojjamarrangetypeRequest $request)
    {

        //return $request;
       try {

          if(getold('App\Models\MojjamArrangetype','mojjam_arrangetype',$request->mojjam_arrangetype)){
          return redirect()->route('admin.mojjamarrangetypes')->with(['error' => 'نوع الترتيب هذا تم اضافته من قبل']);
          }

          $mojjamarrangetype = MojjamArrangetype::create([
                'mojjam_arrangetype' => $request->mojjam_arrangetype,
                'admin_id' =>Auth::user()->id
            ]);
            return redirect()->route('admin.mojjamarrangetypes')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.mojjamarrangetypes')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }



    public function edit($id)
    {
        try {
            $mojjamarrangetype= MojjamArrangetype::Selection()->find($id);

            if (!$mojjamarrangetype)
                return redirect()->route('admin.mojjamarrangetypes')->with(['error' => 'نوع الترتيب هذا غير موجود او ربما يكون محذوفا ']);

            return view('admin.mojjamarrangetypes.edit', compact('mojjamarrangetype'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.mojjamarrangetypes')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function update($id, MojjamarrangetypeRequest $request)
    {

        try {

                if(getresult('App\Models\MojjamArrangetype','mojjam_arrangetype',$request->mojjam_arrangetype,'id',$id)){
                    return redirect()->route('admin.mojjamarrangetypes')->with(['error' => 'نوع الترتيب هذا تم اضافته من قبل']);
                }

            $mojjamarrangetype = MojjamArrangetype::Selection()->find($id);
            if (!$mojjamarrangetype){
                return redirect()->route('admin.mojjamarrangetypes')->with(['error' => 'نوع الترتيب  هذا غير موجود او ربما يكون محذوفا ']);
            }
              if ($mojjamarrangetype) {
                $mojjamarrangetype::where('id', $id)
                ->update([
                    'mojjam_arrangetype' => $request->mojjam_arrangetype,
                    'admin_id'=> Auth::user()->id,
                ]);
              }

            return redirect()->route('admin.mojjamarrangetypes')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.mojjamarrangetypes')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function show($id)
    {

        $mojjamarrangetype = MojjamArrangetype::Selection()->find($id);
        if (!$mojjamarrangetype)
            return redirect()->route('admin.mojjamarrangetypes')->with(['error' => 'نوع الترتيب هذا غير موجود او ربما يكون محذوفا ']);
        return view('admin.mojjamarrangetypes.show',compact('mojjamarrangetype'));
    }

    public function destroy($id)
    {

        try {
            $mojjamarrangetype = MojjamArrangetype::Selection()->find($id);
            $mojjams = $mojjamarrangetype->mojjams();

            if (!$mojjamarrangetype){
                return redirect()->route('admin.mojjamarrangetypes')->with(['error' => 'نوع الترتيب هذا غير موجود او ربما يكون محذوفا ']);
            }
            if ($mojjams->count()>0) {
                return redirect()->route('admin.mojjamarrangetypes')->with(['error' => 'لا يمكن حذف  نوع الترتيب هذا']);
            }

            $mojjamarrangetype->delete();
            return redirect()->route('admin.mojjamarrangetypes')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.mojjamarrangetypes')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
