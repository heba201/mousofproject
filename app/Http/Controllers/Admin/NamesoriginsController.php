<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\NameoriginRequest ;
use App\Models\Nameorigin;
use Auth;
use DB;

class NamesoriginsController extends Controller
{
    public function index()
    {

        $namesorigins = Nameorigin::selection()->get();

        return view('admin.namesorigins.index', compact('namesorigins'));
    }

    public function create()
    {
        return view('admin.namesorigins.create');
    }

    public function store(NameoriginRequest $request)
    {

       try {

          if(getold('App\Models\Nameorigin','name_origin',$request->name_origin)){
          return redirect()->route('admin.namesorigins')->with(['error' => 'هذا اصل الاسم  تم اضافته من قبل']);
          }
          $name_origin = Nameorigin::create([
                'name_origin' => $request->name_origin,
                'admin_id' =>Auth::user()->id,
            ]);
            return redirect()->route('admin.namesorigins')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.namesorigins')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id)
    {
        try {

            $name_origin= Nameorigin::Selection()->find($id);
            if (!$name_origin)
                return redirect()->route('admin.namesorigins')->with(['error' => ' اصل الاسم هذا غير موجود او ربما يكون محذوفا ']);

            return view('admin.namesorigins.edit', compact('name_origin'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.namesorigins')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function update($id, NameoriginRequest $request)
    {

        try {

                if(getresult('App\Models\Nameorigin','name_origin',$request->name_origin,'id',$id)){
                    return redirect()->route('admin.namesorigins')->with(['error' => 'هذا اصل الاسم تم اضافته من قبل']);
                }

                $name_origin = Nameorigin::Selection()->find($id);
            if (!$name_origin){
                return redirect()->route('admin.namesorigins')->with(['error' => 'اصل الاسم هذا غير موجود او ربما يكون محذوفا ']);
            }
              if ($name_origin) {
                $name_origin::where('id', $id)
                ->update([
                    'name_origin' => $request->name_origin,
                    'admin_id'=> Auth::user()->id
                ]);
              }
            return redirect()->route('admin.namesorigins')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.namesorigins')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function destroy($id)
    {
      // if this name origin is in names meanings no delete
        try {
            $name_origin= Nameorigin::Selection()->find($id);
            $namemeanings = $name_origin->namemeanings();

            if (!$name_origin){
                return redirect()->route('admin.namesorigins')->with(['error' => ' اصل الاسم هذا  غير موجود   ']);
            }
            if ($meanings->count()>0) {
                return redirect()->route('admin.namesorigins')->with(['error' => 'لا يمكن حذف  اصل الاسم ']);
            }

            $name_origin>delete();
            return redirect()->route('admin.namesorigins')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
           // return $ex;
            return redirect()->route('admin.namesorigins')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
