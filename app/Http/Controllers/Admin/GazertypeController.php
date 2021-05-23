<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GazertypeRequest;
use App\Models\Gazertype;
use Auth;
use DB;

class GazertypeController extends Controller
{
    public function index()
    {

        $gazer_types = Gazertype::selection()->get();

        return view('admin.gazer_type.index', compact('gazer_types'));
    }

    public function create()
    {
        return view('admin.gazer_type.create');
    }

    public function store(GazertypeRequest $request)
    {

        //return $request;
       try {

          if(getold('App\Models\Gazertype','gazer_type',$request->gazer_type)){
          return redirect()->route('admin.gazertype')->with(['error' => ' نوع الجذر تم اضافته من قبل ']);
          }
          $gazer_type = Gazertype::create([
                'gazer_type' => $request->gazer_type,
                'admin_id' =>Auth::user()->id
            ]);
            return redirect()->route('admin.gazertype')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.gazertype')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id)
    {
        try {

            $gazer_type= Gazertype::Selection()->find($id);
            if (!$gazer_type)
                return redirect()->route('admin.gazertype')->with(['error' => 'نوع الجذر غير موجود او ربما يكون محذوفا ']);

            return view('admin.gazer_type.edit',compact('gazer_type'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.gazertype')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function update($id, GazertypeRequest $request)
    {

        try {


            if(getresult('App\Models\Gazertype','gazer_type',$request->gazer_type,'id',$id)){
                return redirect()->route('admin.gazertype')->with(['error' => ' نوع الجذر تم اضافته من قبل ']);
            }

            $gazer_type= Gazertype::Selection()->find($id);
            if (!$gazer_type)
            return redirect()->route('admin.gazertype')->with(['error' => 'نوع الجذر غير موجود او ربما يكون محذوفا ']);
              if ($gazer_type) {
                $gazer_type::where('id', $id)
                ->update([
                    'gazer_type' => $request->gazer_type,
                    'admin_id' =>Auth::user()->id
                ]);
              }

            return redirect()->route('admin.gazertype')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.gazertype')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function show($id)
    {
        $gazer_type= Gazertype::Selection()->find($id);
        if (!$gazer_type)
            return redirect()->route('admin.gazertype')->with(['error' => 'نوع الجذر غير موجود او ربما يكون محذوفا ']);
        return view('admin.gazer_type.show',compact('gazer_type'));
    }

    public function destroy($id)
    {

        try {
            $gazer_type= Gazertype::Selection()->find($id);
            $words = $gazer_type->words();

            if (!$gazer_type)
            return redirect()->route('admin.gazertype')->with(['error' => 'نوع الجذر غير موجود او ربما يكون محذوفا ']);
            if ($words->count()>0) {
                return redirect()->route('admin.gazertype')->with(['error' => ' لا يمكن حذف نوع  الجذر هذا']);
            }

            $gazer_type->delete();
            return redirect()->route('admin.gazertype')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.gazertype')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
