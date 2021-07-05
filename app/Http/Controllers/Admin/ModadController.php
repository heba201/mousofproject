<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ModadRequest;
use App\Models\Word;
use App\Models\Mojjam;
use App\Models\Wordname;
use App\Models\Modad;
use DB;
use Auth;
use Redirect;


class ModadController extends Controller
{

    public function index()
    {

        $modads = Modad::with('word','mojjam')->selection()->get();

        return view('admin.modad.index',compact('modads'));
    }





    public function create($id,$mojjamid)
    {

        $word=Wordname::Selection()->find($id);
        $mojjam=Mojjam::Selection()->find($mojjamid);
        if (!$mojjam){
            return redirect()->route('admin.mojjams')->with(['error' => 'هذا المعجم غير موجود ']);
        }

        if (!$word){
            return redirect()->route('admin.mojjams')->with(['error' => 'هذه الكلمة غير موجودة ']);
        }
        return view('admin.modad.create',compact('word','mojjam'));
    }


    public function store(ModadRequest $request, $id,$mojjam_id){
        try{
        $word=Wordname::Selection()->find($id);
        $mojjam=Mojjam::Selection()->find($mojjam_id);
        if (!$mojjam){
            return redirect()->route('admin.mojjams')->with(['error' => 'هذا المعجم غير موجود ']);
        }

        if (!$word){
            return redirect()->route('admin.mojjams')->with(['error' => 'هذه الكلمة غير موجودة ']);
        }
        $count=count($_POST["modad"]);
        if(isset($_POST["modad"])){
            for($i=0;$i<$count;$i++){
         $modadexist=Modad::where('word_id',$id)->where('mojjam_id',$mojjam_id)->where('modad',$_POST["modad"][$i])->selection()->first();
           if($modadexist){
         if($modadexist->modad == $_POST["modad"][$i]){
                return redirect()->route('admin.modad.create',['id'=>$id,'mojjamid'=>$mojjam->id])->with(['error' => 'هذا المضاد تم إضافته من قبل ']);
            }
            }
          }
        }
    for($i=0;$i<$count;$i++){
        $modad = Modad::create([
            'word_id' =>$word->id,
              'modad'   => $_POST["modad"][$i],
              'mojjam_id' =>$mojjam_id,
                'admin_id' =>Auth::user()->id
            ]);
        }

            return redirect()->route('admin.mojjams.showwords',$mojjam_id)->with(['success' => 'تم الحفظ بنجاح']);
        }
        catch (\Exception $ex){
            return $ex;
            return redirect()->route('admin.mojjams.showwords',$mojjam_id)->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    // update modad .....
    public function update(ModadRequest $request ,$id,$mojjam_id)
    {

        try {


            $modads= Modad::with('word')->where('word_id',$id)->where('mojjam_id',$mojjam_id)->Selection()->get();
            $mojjam = Mojjam::find($id);
            if (!$modads){
                return redirect()->route('admin.mojjams.showwords',$request->mojjam_id)->with(['error' => 'هذه الأضداد غير موجودة او ربما تكون محذوفة ']);
            }

            // update moradfs ...
            $i=0;
            foreach ($modads as $modad) {
                $modad::where('id',$modad->id)
                ->update([
                    'modad'=>$_POST['modad'][$i]
                ]);
                $i++;
          }
            return redirect()->route('admin.mojjams.showwords',$request->mojjam_id)->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.mojjams.showwords',$request->mojjam_id)->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
}



public function destroy($id)
{

    try {
        $modad = Modad::find($id);
        if (!$modad){
            return redirect()->route('admin.modad')->with(['error' => 'هذا المضاد غير موجود او ربما يكون محذوف ']);
        }

        $modad->delete();
        return redirect()->route('admin.modad')->with(['success' => 'تم الحذف بنجاح']);

    } catch (\Exception $ex) {
       // return $ex;
        return redirect()->route('admin.modad')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    }
}

}
