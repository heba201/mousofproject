<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\GazerweightRequest;
use App\Models\Gazerweight;
use Auth;
use DB;

class GazerweightController extends Controller
{
    public function index()
    {

        $gazer_weights = Gazerweight::selection()->get();

        return view('admin.gazer_weight.index', compact('gazer_weights'));
    }

    public function create()
    {
        return view('admin.gazer_weight.create');
    }

    public function store(GazerweightRequest $request)
    {

        //return $request;
       try {

          if(getold('App\Models\Gazerweight','gazer_weight',$request->gazer_weight)){
          return redirect()->route('admin.gazerweight')->with(['error' => ' وزن الجذر تم اضافته من قبل ']);
          }
          $gazer_weight = Gazerweight::create([
                'gazer_weight' => $request->gazer_weight,
                'admin_id' =>Auth::user()->id
            ]);
            return redirect()->route('admin.gazerweight')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.gazerweight')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id)
    {
        try {

            $gazer_weight= Gazerweight::Selection()->find($id);
            if (!$gazer_weight)
                return redirect()->route('admin.gazertype')->with(['error' => 'وزن الجذر غير موجود او ربما يكون محذوفا ']);

            return view('admin.gazer_weight.edit',compact('gazer_weight'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.gazerweight')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function update($id, GazerweightRequest $request)
    {

        try {


            if(getresult('App\Models\Gazerweight','gazer_weight',$request->gazer_weight,'id',$id)){
                return redirect()->route('admin.gazerweight')->with(['error' => ' وزن الجذر تم اضافته من قبل ']);
            }

            $gazer_weight= Gazerweight::Selection()->find($id);
            if (!$gazer_weight)
            return redirect()->route('admin.gazerweight')->with(['error' => 'وزن الجذر غير موجود او ربما يكون محذوفا ']);
            if ($gazer_weight) {
                $gazer_weight::where('id', $id)
                ->update([
                    'gazer_weight' => $request->gazer_weight,
                    'admin_id' =>Auth::user()->id
                ]);
              }

            return redirect()->route('admin.gazerweight')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.gazerweight')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function show($id)
    {
        $gazer_weight= Gazerweight::Selection()->find($id);
        if (!$gazer_weight)
        return redirect()->route('admin.gazerweight')->with(['error' => 'وزن الجذر غير موجود او ربما يكون محذوفا ']);
        return view('admin.gazer_weight.show',compact('gazer_weight'));
    }

    public function destroy($id)
    {

        try {
            $gazer_weight= Gazerweight::Selection()->find($id);
            $words = $gazer_weight->words();

            if (!$gazer_weight)
            return redirect()->route('admin.gazerweight')->with(['error' => 'وزن الجذر غير موجود او ربما يكون محذوفا ']);
            if ($words->count()>0) {
                return redirect()->route('admin.gazerweight')->with(['error' => ' لا يمكن حذف  وزن الجذر هذا']);
            }

            $gazer_weight->delete();
            return redirect()->route('admin.gazerweight')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.gazerweight')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
