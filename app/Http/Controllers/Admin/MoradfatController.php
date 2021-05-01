<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MoradfatRequest;
use App\Models\Moradfat;
use App\Models\Word;
use App\Models\Wordname;
use DB;
use Auth;

class MoradfatController extends Controller
{
    public function index()
    {

        $moradfat = Moradfat::with('word')->selection()->get();

        return view('admin.moradfat.index',compact('moradfat'));
    }
    public function create($id)
    {

        $word=Word::Selection()->find($id);
        if (!$word){
            return redirect()->route('admin.words')->with(['error' => 'هذه الكلمة غير موجودة ']);
        }
        return view('admin.moradfat.create',compact('word'));
    }

    public function store(MoradfatRequest $request, $id){
        try{
        $word=Wordname::Selection()->find($id);
        if (!$word){
            return redirect()->route('admin.words')->with(['error' => 'هذه الكلمة غير موجودة ']);
        }

        if(isset($_POST["moradf"]) && is_array($_POST["moradf"])){
            $moradf= implode(", ", $_POST["moradf"]);
        }
        else{
            $moradf=$request->moradf;
        }
        if(isset($_POST["modad"]) && is_array($_POST["modad"])){
            $modad= implode(", ", $_POST["modad"]);
        }
        else{
            $modad=$request->modad;
        }
        $moradfat = Moradfat::create([
            'word_id' =>$word->id,
              'moradf'   => $moradf,
              'modad'   => $modad,
                'admin_id' =>Auth::user()->id
            ]);
            return redirect()->route('admin.words')->with(['success' => 'تم الحفظ بنجاح']);
        }
        catch (\Exception $ex){
            return $ex;
            return redirect()->route('admin.words')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function edit($id)
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

    public function update(MoradfatRequest $request , $id)
    {

        try {
            $moradfrow= Moradfat::with('word')->Selection()->find($id);
            if (!$moradfrow){
                return redirect()->route('admin.moradfat')->with(['error' => 'هذه المرادفات غير موجودة او ربما تكون محذوفة ']);
            }
              if ($moradfrow) {
                if(isset($_POST["moradf"]) && is_array($_POST["moradf"])){
                    $moradf= implode(", ", $_POST["moradf"]);
                }
                else{
                    $moradf=$request->moradf;
                }
                if(isset($_POST["modad"]) && is_array($_POST["modad"])){
                    $modad= implode(", ", $_POST["modad"]);
                }
                else{
                    $modad=$request->modad;
                }

                $moradfrow::where('id', $id)
                ->update([
                    'word_id' => $moradfrow->word_id,
                    'moradf'   => $moradf,
                    'modad'   => $modad,
                    'admin_id' =>Auth::user()->id
                ]);
              }
            return redirect()->route('admin.moradfat')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.moradfat')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
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
