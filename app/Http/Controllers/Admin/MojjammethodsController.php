<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MojjammethodRequest;
use App\Models\MojjamMethod;
use Auth;
use DB;

class MojjammethodsController extends Controller
{
    public function index()
    {

        $mojjammethods=MojjamMethod::selection()->get();

        return view('admin.mojjammethods.index', compact('mojjammethods'));
    }

    public function create()
    {

        return view('admin.mojjammethods.create');
    }


    public function store(MojjammethodRequest $request)
    {

        //return $request;
       try {

          if(getold('App\Models\MojjamMethod','mojjam_method',$request->mojjam_method)){
          return redirect()->route('admin.mojjammethods')->with(['error' => '  هذا  المنهج تم اضافته من قبل']);
          }

          $mojjammethod = MojjamMethod::create([
                'mojjam_method' => $request->mojjam_method,
                'admin_id' =>Auth::user()->id
            ]);
            return redirect()->route('admin.mojjammethods')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.mojjammethods')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id)
    {
        try {
            $mojjammethod= MojjamMethod::Selection()->find($id);

            if (!$mojjammethod)
                return redirect()->route('admin.mojjammethods')->with(['error' => '  هذا المنهج غير موجود او ربما يكون محذوفا ']);

            return view('admin.mojjammethods.edit', compact('mojjammethod'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.mojjammethods')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function update($id, MojjammethodRequest $request)
    {

        try {

                if(getresult('App\Models\MojjamMethod','mojjam_method',$request->mojjam_method,'id',$id)){
                    return redirect()->route('admin.mojjammethods')->with(['error' => '  هذا المنهج تم اضافته من قبل']);
                }

            $mojjammethod = MojjamMethod::Selection()->find($id);
            if (!$mojjammethod){
                return redirect()->route('admin.mojjammethods')->with(['error' => '   هذا  المنهج غير موجود او ربما يكون محذوفا ']);
            }
              if ($mojjammethod) {
                $mojjammethod::where('id', $id)
                ->update([
                    'mojjam_method' => $request->mojjam_method,
                    'admin_id'=> Auth::user()->id,
                ]);
              }

            return redirect()->route('admin.mojjammethods')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.mojjammethods')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function show($id)
    {

        $mojjammethod = MojjamMethod::Selection()->find($id);
        if (!$mojjammethod)
            return redirect()->route('admin.mojjammethods')->with(['error' => '  هذا المنهج غير موجود او ربما يكون محذوفا ']);
        return view('admin.mojjammethods.show',compact('mojjammethod'));
    }


    public function destroy($id)
    {

        try {

        $mojjammethod = MojjamMethod::Selection()->find($id);
            $mojjams = $mojjammethod->mojjams();

            if (!$mojjammethod){
                return redirect()->route('admin.mojjammethods')->with(['error' => '  هذا المنهج غير موجود او ربما يكون محذوفا ']);
            }
            if ($mojjams->count()>0) {
                return redirect()->route('admin.mojjammethods')->with(['error' => 'لا يمكن حذف هذا المنهج']);
            }

            $mojjammethod->delete();
            return redirect()->route('admin.mojjammethods')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.mojjammethods')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
