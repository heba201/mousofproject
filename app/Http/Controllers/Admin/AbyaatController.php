<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BaytRequest;
use App\Models\Bayt;
use App\Models\Poet;
use App\Models\Word;
use DB;
use Auth;

class AbyaatController extends Controller
{

    public function index()
    {

        $abyaat =Bayt::with('poet','word')->selection()->get();
       // $abyaat =Bayt::with('word')->with('poet')->selection()->get();
        //print_r($abyaat);
        return view('admin.abyaat.index',compact('abyaat'));
    }


    public function create($id)
    {

        $word=Word::with('word')->where('word_id',$id)->Selection()->first();
        $poets=Poet::Selection()->get();
        if (!$word){
            return redirect()->route('admin.words')->with(['error' => 'هذه الكلمة غير موجودة ']);
        }
        return view('admin.abyaat.create',compact('word','poets'));
    }

    public function store(BaytRequest $request, $id){
        try{
            $word=Word::with('word')->where('word_id',$id)->Selection()->first();

        if (!$word){
            return redirect()->route('admin.words')->with(['error' => 'هذه الكلمة غير موجودة ']);
        }
        /* no repeat for bayt for the same word*/
        $abyaat=Bayt::with('word')->Selection()->where('word_id','=',$word->word_id)->get();
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['bayt']))
        {
        foreach($_POST['bayt'] as $key => $value)
        {
            if($abyaat){
            foreach( $abyaat as $wordbayt){
            if ($wordbayt->bayt == $_POST['bayt'][$key]) {
                return redirect()->route('admin.words')->with(['error' => 'هذا  البيت تم  اضافته من قبل ']);
            }
            }
        }
         }
        }
    }
        if(isset($_POST["bayt"]) && is_array($_POST["bayt"])){
            $bayt= implode(", ", $_POST["bayt"]);
        }
        else{
            $bayt=$request->bayt;
        }


        $baytow = Bayt::create([
            'word_id' =>$word->word_id,
              'bayt'   => $bayt,
              'poet_id'   =>$request-> poet_id,
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

            $bayt= Bayt::with('word')->Selection()->find($id);
            $abyaat=explode(",",$bayt->bayt);
            $poets=Poet::Selection()->get();
            if (!$bayt)
                return redirect()->route('admin.abyaat')->with(['error' => 'هذا البيت غير موجود او ربما يكون محذوف ']);

            return view('admin.abyaat.edit', compact('bayt','abyaat','poets'));

        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.abyaat')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function update(BaytRequest $request , $id)
    {

        try {
            $bayt= Bayt::with('word')->Selection()->find($id);
            if (!$bayt){
                return redirect()->route('admin.abyaat')->with(['error' => 'هذا البيت غير موجود او ربما يكون محذوف ']);
            }
              if ($bayt) {
                if(isset($_POST["bayt"]) && is_array($_POST["bayt"])){
                    $baytval= implode(", ", $_POST["bayt"]);
                }
                else{
                    $baytval=$request->bayt;
                }



                $bayt::where('id', $id)
                ->update([
                    'word_id' => $bayt->word_id,
                    'bayt'   => $baytval,
                    'poet_id'   => $request->poet_id,
                    'admin_id' =>Auth::user()->id
                ]);
              }
            return redirect()->route('admin.abyaat')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.abyaat')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
}

public function show($id)
{
    try {

        $bayt= Bayt::with('word')->Selection()->find($id);
        $abyaat=explode(",",$bayt->bayt);
        $poets=Poet::Selection()->get();
        if (!$bayt)
            return redirect()->route('admin.abyaat')->with(['error' => 'هذا البيت غير موجود او ربما يكون محذوف ']);

        return view('admin.abyaat.show', compact('bayt','abyaat','poets'));

    } catch (\Exception $exception) {
        return $exception;
        return redirect()->route('admin.abyaat')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    }
}

public function destroy($id)
{

    try {
        $bayt =Bayt::find($id);
        if (!$bayt){
            return redirect()->route('admin.abyaat')->with(['error' => 'هذا البيت غير موجود او ربما يكون محذوف ']);
        }

        $bayt->delete();
        return redirect()->route('admin.abyaat')->with(['success' => 'تم الحذف بنجاح']);

    } catch (\Exception $ex) {
        //return $ex;
        return redirect()->route('admin.abyaat')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    }
}




}
