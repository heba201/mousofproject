<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\WeightindicationRequest;
use App\Models\Weightindication;
use Auth;
use DB;

class WeightindicationController extends Controller
{
    public function index()
    {

        $weight_indications = Weightindication::selection()->get();

        return view('admin.weight_indication.index', compact('weight_indications'));
    }

    public function create()
    {
        return view('admin.weight_indication.create');
    }

    public function store(WeightindicationRequest $request)
    {

        //return $request;
       try {

          if(getold('App\Models\Weightindication','weight_indication',$request->weight_indication)){
          return redirect()->route('admin.weightindication')->with(['error' => 'دلالة الوزن تم اضافتها من قبل']);
          }
          $weight_indication = Weightindication::create([
                'weight_indication' => $request->weight_indication,
                'admin_id' =>Auth::user()->id
            ]);
            return redirect()->route('admin.weightindication')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.weightindication')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id)
    {
        try {

            $weight_indication = Weightindication::Selection()->find($id);
            if (!$weight_indication)
                return redirect()->route('admin.weightindication')->with(['error' => 'دلالة الوزن غير موجودة او ربما تكون محذوفة ']);

            return view('admin.weight_indication.edit',compact('weight_indication'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.weightindication')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function update($id, WeightindicationRequest $request)
    {

        try {


            if(getresult('App\Models\Weightindication','weight_indication',$request->weight_indication,'id',$id))
            {
                return redirect()->route('admin.weightindication')->with(['error' => 'دلالة الوزن تم اضافتها من قبل']);
            }

            $weight_indication = Weightindication::Selection()->find($id);
                if (!$weight_indication)
                return redirect()->route('admin.weightindication')->with(['error' => 'دلالة الوزن غير موجودة او ربما تكون محذوفة ']);
              if ($weight_indication) {
                $weight_indication::where('id', $id)
                ->update([
                    'weight_indication' => $request->weight_indication,
                    'admin_id' =>Auth::user()->id
                ]);
              }

            return redirect()->route('admin.weightindication')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.weightindication')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function show($id)
    {
        $weight_indication = Weightindication::Selection()->find($id);
        if (!$weight_indication)
        return redirect()->route('admin.weightindication')->with(['error' => 'دلالة الوزن غير موجودة او ربما تكون محذوفة ']);
        return view('admin.weight_indication.show',compact('weight_indication'));
    }

    public function destroy($id)
    {

        try {
            $weight_indication = Weightindication::Selection()->find($id);
            $words = $weight_indication->words();

            if (!$weight_indication)
            return redirect()->route('admin.weightindication')->with(['error' => 'دلالة الوزن غير موجودة او ربما تكون محذوفة ']);
            if ($words->count()>0) {
                return redirect()->route('admin.weightindication')->with(['error' => 'لا يمكن حذف دلالة الوزن']);
            }

            $weight_indication->delete();
            return redirect()->route('admin.weightindication')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.weightindication')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
