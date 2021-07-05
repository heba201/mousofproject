<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MoradfatRequest;
use App\Models\Moradfat;
use App\Models\Word;
use App\Models\Mojjam;
use App\Models\Wordname;
use DB;
use Auth;
use Redirect;
class MoradfatController extends Controller
{
    public function index()
    {

        $moradfat = Moradfat::with('word','mojjam')->selection()->get();

        return view('admin.moradfat.index',compact('moradfat'));
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
        return view('admin.moradfat.create',compact('word','mojjam'));
    }

    public function store(MoradfatRequest $request, $id,$mojjam_id){
        try{
        $word=Wordname::Selection()->find($id);
        $mojjam=Mojjam::Selection()->find($mojjam_id);
        if (!$mojjam){
            return redirect()->route('admin.mojjams')->with(['error' => 'هذا المعجم غير موجود ']);
        }

        if (!$word){
            return redirect()->route('admin.mojjams')->with(['error' => 'هذه الكلمة غير موجودة ']);
        }
        $count=count($_POST["moradf"]);
        if(isset($_POST["moradf"])){
            for($i=0;$i<$count;$i++){
         $moradfsexist=Moradfat::where('word_id',$id)->where('mojjam_id',$mojjam_id)->where('moradf',$_POST["moradf"][$i])->selection()->first();
           if($moradfsexist){
         if($moradfsexist->moradf == $_POST["moradf"][$i]){
                return redirect()->route('admin.moradfat.create',['id'=>$id,'mojjamid'=>$mojjam->id])->with(['error' => 'هذا المرادف تم إضافته من قبل ']);
            }
            }
          }
        }
    for($i=0;$i<$count;$i++){
        $moradfat = Moradfat::create([
            'word_id' =>$word->id,
              'moradf'   => $_POST["moradf"][$i],
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

    // update moradf by id ---
    public function editby($id)
    {
        try {

            $moradf= Moradfat::with('word')->Selection()->find($id);
            $moradfs=explode(", ",$moradf->moradf);
            $modads=explode(", ",$moradf->modad);
            if (!$moradf)
                return redirect()->route('admin.moradfat')->with(['error' => 'هذه المرادفات غير موجودة او ربما تكون محذوفة ']);

            return view('admin.moradfat.edit', compact('moradf','moradfs','modads'));

        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.moradfat')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function update(MoradfatRequest $request ,$id,$mojjam_id)
    {

        try {


            $moradfs= Moradfat::with('word')->where('word_id',$id)->where('mojjam_id',$mojjam_id)->Selection()->get();
            $mojjam = Mojjam::find($id);
            if (!$moradfs){
                return redirect()->route('admin.mojjams.showwords',$request->mojjam_id)->with(['error' => 'هذه المرادفات غير موجودة او ربما تكون محذوفة ']);
            }

            // update moradfs ...
            $i=0;
            foreach ($moradfs as $moradf) {
                $moradf::where('id',$moradf->id)
                ->update([
                    'moradf'=>$_POST['moradf'][$i]
                ]);
                $i++;
          }
            return redirect()->route('admin.mojjams.showwords',$request->mojjam_id)->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.mojjams.showwords',$request->mojjam_id)->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
}

        public function show($id)
        {
            try {

                $moradf= Moradfat::with('word')->Selection()->find($id);
                $moradfs=explode(", ",$moradf->moradf);
                $modads=explode(", ",$moradf->modad);
                if (!$moradf)
                    return redirect()->route('admin.moradfat')->with(['error' => 'هذه المرادفات غير موجودة او ربما تكون محذوفة ']);

                return view('admin.moradfat.show', compact('moradf','moradfs','modads'));

            } catch (\Exception $exception) {
                return $exception;
                return redirect()->route('admin.moradfat')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
            }
        }


public function destroy($id)
{

    try {
        $moradf = Moradfat::find($id);
        if (!$moradf){
            return redirect()->route('admin.moradfat')->with(['error' => 'هذه المرادفات غير موجودة او ربما تكون محذوفة ']);
        }

        $moradf->delete();
        return redirect()->route('admin.moradfat')->with(['success' => 'تم الحذف بنجاح']);

    } catch (\Exception $ex) {
       // return $ex;
        return redirect()->route('admin.moradfat')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    }
}


}
