<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FaedaRequest;
use App\Models\Faedasubject;
use App\Models\Faeda;
use Auth;

class FawaedController extends Controller
{
    public function index()
    {
        $fawaed=Faeda::selection()->get();

        return view('admin.fawed.index', compact('fawaed'));
    }
    public function create()

    {
        $fawaedsubjects = Faedasubject::selection()->get();
        return view('admin.fawed.create',compact('fawaedsubjects'));
    }

    public function store(FaedaRequest $request)
    {

       try {
        $fawaed=Faeda::selection()->get();
                 // for no repeat
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            if (isset($_POST['faeda']))
            {
            foreach($_POST['faeda'] as $key => $value)
            {
                if($fawaed){
                foreach( $fawaed as $faeda){
                if (getold('App\Models\Faeda','faeda',$_POST['faeda'][$key])) {
                    return redirect()->route('admin.fawed')->with(['error' => 'هذه الفائدة تم اضافتها من قبل']);
                }
                }
               }
             }
            }
           }

            if(isset($_POST["faeda"]) && is_array($_POST["faeda"])){
                $faedarow= implode(", ", $_POST["faeda"]);
            }
            else{
                $faedarow=$request->faeda;
            }
            $fawaed = Faeda::create([
                'faeda' => $faedarow,
                'faeda_subject_id' =>$request->faeda_subject_id,
                'admin_id' =>Auth::user()->id,
            ]);
            return redirect()->route('admin.fawaed')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.fawaed')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id)
    {
        try {

            $fawaed= Faeda::Selection()->find($id);
            $faedarow=explode(",", $fawaed->faeda);
            $fawaedsubjects = Faedasubject::selection()->get();
            if (!$fawaed)
                return redirect()->route('admin.fawaed')->with(['error' => 'هذه الفائدة غير موجودة او ربما تكون محذوفة ']);

            return view('admin.fawed.edit', compact('fawaed','faedarow','fawaedsubjects'));

        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.fawaed')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function update($id, FaedaRequest $request)
    {

        try {

            $fawaed= Faeda::Selection()->find($id);
            // for no repeat
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                if (isset($_POST['faeda']))
                {
                foreach($_POST['faeda'] as $key => $value)
                {
                    if($fawaed){
                    foreach( $fawaed as $faeda){
                    if (getresult('App\Models\Faeda','faeda',$_POST['faeda'][$key],'id',$id)) {
                        return redirect()->route('admin.fawed')->with(['error' => 'هذه الفائدة تم اضافتها من قبل']);
                    }
                    }
                   }
                 }
                }
               }
            if (!$fawaed){
                return redirect()->route('admin.fawaed')->with(['error' => 'هذه الفائدة غير موجودة او ربما تكون محذوفة ']);
            }
            if(isset($_POST["faeda"]) && is_array($_POST["faeda"])){
                $faedarow= implode(", ", $_POST["faeda"]);
            }
            else{
                $faedarow=$request->faeda;
            }
              if ($fawaed) {
                $fawaed::where('id', $id)
                ->update([
                    'faeda' => $faedarow,
                    'faeda_subject_id' =>$request->faeda_subject_id,
                    'admin_id' =>Auth::user()->id,
                ]);
              }
            return redirect()->route('admin.fawaed')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return redirect()->route('admin.fawaed')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function show($id)
    {
        try {

            $fawaed= Faeda::Selection()->find($id);
            $fawaedsubjects = Faedasubject::selection()->get();
            $faedarow=explode(",", $fawaed->faeda);
            if (!$fawaed)
                return redirect()->route('admin.fawaed')->with(['error' => 'هذه الفائدة غير موجودة او ربما تكون محذوفة ']);

            return view('admin.fawed.show', compact('fawaed','faedarow','fawaedsubjects'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.fawed.show')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function destroy($id)
    {
     //if there is fawed in this  subject no delete
        try {
            $fawaed= Faeda::Selection()->find($id);
            if (!$fawaed){
                return redirect()->route('admin.fawaed')->with(['error' => 'هذه الفائدة غير موجودة ']);
            }
            $fawaed->delete();

            return redirect()->route('admin.fawaed')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {

            return redirect()->route('admin.fawaed')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
