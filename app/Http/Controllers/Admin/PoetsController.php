<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PoetRequest;
use App\Models\Poet;
use Auth;
use DB;
class PoetsController extends Controller
{
    public function index()
    {

        $poets = Poet::selection()->get();

        return view('admin.poets.index', compact('poets'));
    }
    public function create()
    {
        return view('admin.poets.create');
    }

    public function store(PoetRequest $request)
    {


       try {

        if(getold('App\Models\Poet','poet_name',$request->poet_name)){
            return redirect()->route('admin.poets')->with(['error' => 'هذا الشاعر تم اضافته من قبل']);
            }
            if(isset($_POST["poet_works"]) && is_array($_POST["poet_works"])){
                $poet_works= implode(", ", $_POST["poet_works"]);
            }
            else{
                $poet_works=$request->poet_works;
            }


            $poet = Poet::create([
                'poet_name' => $request->poet_name,
                'poet_era' => $request->poet_era,
                'admin_id' =>Auth::user()->id,
                'poet_cv'  =>$request->poet_cv,
                'poet_works'=> $poet_works
            ]);
            return redirect()->route('admin.poets')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
            return redirect()->route('admin.poets')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id)
    {
        try {

            $poet= Poet::Selection()->find($id);
            $poetworks=explode(",",  $poet->poet_works);
            if (!$poet)
                return redirect()->route('admin.poets')->with(['error' => 'هذا الشاعر غير  موجود او ربما يكون محذوف ']);

            return view('admin.poets.edit', compact('poet','poetworks'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.poets')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function update(PoetRequest $request ,$id)
    {

        try {

            $poet= Poet::Selection()->find($id);
            if(getresult('App\Models\Poet','poet_name',$request->poet_name,'id',$id)){
                return redirect()->route('admin.poets')->with(['error' => 'هذا الشاعر تم اضافته من قبل']);
            }
            if (! $poet){
                return redirect()->route('admin.poets')->with(['error' => 'هذا الشاعر غير موجود او ربما يكون محذوف ']);
            }
            if(isset($_POST["poet_works"]) && is_array($_POST["poet_works"])){
                $poet_works= implode(", ", $_POST["poet_works"]);
            }
            else{
                $poet_works=$request->poet_works;
            }

              if ($poet) {
                $poet::where('id', $id)
                ->update([
                    'poet_name' => $request->poet_name,
                    'poet_era' => $request->poet_era,
                    'admin_id' =>Auth::user()->id,
                    'poet_cv'  =>$request->poet_cv,
                    'poet_works'=> $poet_works
                ]);
              }
            return redirect()->route('admin.poets')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {

            return redirect()->route('admin.poets')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function destroy($id)
    {
        // if there is abyaat by this poet it will not deletd
        try {
            $poet= Poet::Selection()->find($id);
            if (!$poet){
                return redirect()->route('admin.poets')->with(['error' => 'هذا الشاعر غير موجود ']);
            }

            $abyaat=$poet->abyaat();

            if ($abyaat) {
                $abyaat->delete();
                return redirect()->route('admin.poets')->with(['error' => 'لا يمكن حذف هذا الشاعر ']);

            }
            $poet->delete();
            return redirect()->route('admin.poets')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            //return $ex;
            return redirect()->route('admin.poets')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
