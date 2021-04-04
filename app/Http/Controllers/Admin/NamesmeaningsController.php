<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\NamemeaningRequest;
use App\Models\Nameorigin;
use App\Models\Namemeaning;
use Auth;
use DB;

class NamesmeaningsController extends Controller
{
    public function index()
    {

        $namesmeanings = Namemeaning::selection()->get();

        return view('admin.namesmeanings.index', compact('namesmeanings'));
    }


    public function create()
    {
        $namesorigins = Nameorigin::selection()->get();
        return view('admin.namesmeanings.create',compact('namesorigins'));
    }

    public function store(NamemeaningRequest $request)
    {

       try {

          if(getold('App\Models\Namemeaning','name',$request->name)){
          return redirect()->route('admin.namesmeanings')->with(['error' => 'هذا  الاسم  تم اضافته من قبل']);
          }
          $name_meaning = Namemeaning::create([
                'name' => $request->name,
                'name_meaning'=>$request->name_meaning,
                'nameorigin_id'=>$request->nameorigin_id,
                'name_type'=>$request->name_type,
                'admin_id' =>Auth::user()->id,
            ]);
            return redirect()->route('admin.namesmeanings')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.namesmeanings')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id)
    {
        try {

            $namemeaning= Namemeaning::Selection()->find($id);
            $namesorigins = Nameorigin::selection()->get();
            if (!$namemeaning)
                return redirect()->route('admin.namesmeanings')->with(['error' => ' هذا الاسم  غير موجود او ربما يكون محذوفا ']);

            return view('admin.namesmeanings.edit', compact('namemeaning','namesorigins'));

        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.namesmeanings')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function update($id, NamemeaningRequest $request)
    {

        try {

                if(getresult('App\Models\Namemeaning','name',$request->name,'id',$id)){
                    return redirect()->route('admin.namesmeanings')->with(['error' => 'هذا الاسم تم اضافته من قبل']);
                }

                $namemeaning= Namemeaning::Selection()->find($id);
            if (!$namemeaning){
                return redirect()->route('admin.namesmeanings')->with(['error' => 'هذا الاسم  غير موجود او ربما يكون محذوفا ']);
            }
              if ($namemeaning) {
                $namemeaning::where('id', $id)
                ->update([
                'name' => $request->name,
                'name_meaning'=>$request->name_meaning,
                'nameorigin_id'=>$request->nameorigin_id,
                'name_type'=>$request->name_type,
                'admin_id' =>Auth::user()->id,
                ]);
              }
            return redirect()->route('admin.namesmeanings')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.namesmeanings')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function destroy($id)
    {

        try {
            $namemeaning= Namemeaning::Selection()->find($id);

            if (!$namemeaning){
                return redirect()->route('admin.namesmeanings')->with(['error' => ' هذا الاسم غير موجود   ']);
            }

            $namemeaning->delete();
            return redirect()->route('admin.namesmeanings')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
           // return $ex;
            return redirect()->route('admin.namesmeanings')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
