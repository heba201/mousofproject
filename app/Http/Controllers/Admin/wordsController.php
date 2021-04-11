<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\WordRequest;
use App\Http\Requests\WordFirstupdate;
use App\Http\Requests\otherWordPropertiesRequest;
use App\Models\Word;
use App\Models\Mojjam;
use App\Models\Meaning;
use App\Models\Sentence;
use App\Models\Wordindication;
use Validator;
use DB;
use Auth;

class wordsController extends Controller
{
    //
    public function index()
    {

        $words = Word::selection()->get();
        $sentences = Sentence::selection()->get();
        return view('admin.words.index', compact('words','sentences'));
    }
    public function create()
    {
       $word_indications=Wordindication::selection()->get();
        return view('admin.words.create',compact('word_indications'));
    }

    public function store(WordRequest $request)
    {

        //return $request;
       try {
        if(getold('App\Models\Word','word',$request->word)){
            return redirect()->route('admin.words')->with(['error' => 'هذه الكلمة تم اضافتها من قبل']);
            }
            $word = Word::create([
            'word' => $request->word,
              'word_type'   => $request->word_type,
              'word_gzer'   => $request->word_gzer,
               'gzer_type'  => $request->gzer_type,
               'gzer_weight'  => $request->gzer_weight,
              'word_source'   => $request->word_source,
               'word_indication'  => $request->word_indication,
                'weight_indication' => $request->weight_indication,
                'time' => $request->time,
                'word_derivatives'=> 'n',
                'other_word_properties' => 'n',
                'admin_id' =>Auth::user()->id,
            ]);
            $word_id= $word ->id;
       /*     if ($request->word_type==2 || $request->word_type==3) {
                return redirect()->route('admin.words.thirdedit',$word_id)->with(['success' => 'تم الحفظ بنجاح']);
            } */
            //return redirect()->route('admin.words.seccreate')->with(['success' => 'تم الحفظ بنجاح']);
            return redirect()->route('admin.words.seccreate',$word_id)->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {

            return redirect()->route('admin.words')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
   }

    }
    public function seccreate($id)
    {
        $word=Word::Selection()->find($id);
        $mojjams = Mojjam::selection()->get();
        try{
            if (!$word)
            return redirect()->route('admin.words')->with(['error' => 'هذه الكلمة غير موجودة او ربما تكون محذوفة ']);
            return view('admin.words.create_word_2',compact('word','mojjams'));

        }catch(\Exception $exception){

            return redirect()->route('admin.words')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function firstupdate(Request $request,$id)
    {
        try {

            $word = Word::Selection()->find($id);

            if (!$word){
                return redirect()->route('admin.words')->with(['error' => 'هذه الكلمة غير موجودة او ربما تكون محذوفة ']);
            }
            if (isset($_POST["word_meaning"]) && is_array($_POST["word_meaning"])) {
                foreach( $request->word_meaning as $key=>$val){
                    $meaningword = Meaning::create(['word_meaning' => $request->word_meaning[$key],
                                                 'mojjam_id'  => $_POST['mojjam_id'][$key],
                                                 'word_id' =>$word->id,
                                                 'admin_id' => Auth::user()->id
                                                 ]);
                 }
            }

            if ($request->has('word_derivatives')) {
                if(isset($_POST["word_derivatives"]) && is_array($_POST["word_derivatives"])){
                    $word_derivatives= implode(", ", $_POST["word_derivatives"]);
                }
                else{
                    $word_derivatives=$request->word_derivatives;
                }

                $word::where('id', $id)
            ->update([
                'word_derivatives'=> $word_derivatives
            ]);
            }
              return redirect()->route('admin.words.thirdedit',$word->id)->with(['success' => 'تم الحفظ بنجاح']);
            } catch (\Exception $exception) {


            return redirect()->route('admin.words')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
    public function edit($id)
    {
        try {

            $word= Word::Selection()->find($id);
            $word_indications=Wordindication::selection()->get();
            if (!$word)
            return redirect()->route('admin.words')->with(['error' => 'هذه اكلمة غير موجودة او ربما تكون محذوفة ']);

            return view('admin.words.edit', compact('word','word_indications'));

        } catch (\Exception $exception) {

            return redirect()->route('admin.words')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function update($id,WordRequest  $request)
    {

        try {

            $word= Word::Selection()->find($id);
            if(getresult('App\Models\Word','word',$request->word,'id',$id)){
                return redirect()->route('admin.words')->with(['error' => 'هذه الكلمة تم اضافتها من قبل']);
            }
            if (!$word){
                return redirect()->route('admin.words')->with(['error' => 'هذه اكلمة غير موجودة او ربما تكون محذوفة ']);
            }
              if ($word) {
                $word::where('id', $id)
                ->update([
                    'word' => $request->word,
                    'word_type'   => $request->word_type,
                    'word_gzer'   => $request->word_gzer,
                     'gzer_type'  => $request->gzer_type,
                     'gzer_weight'  => $request->gzer_weight,
                    'word_source'   => $request->word_source,
                     'word_indication'  => $request->word_indication,
                      'weight_indication' => $request->weight_indication,
                      'time' => $request->time,
                      'admin_id' =>Auth::user()->id,
                ]);
              }
              $word_id= $word ->id;
              if ($request->word_type==2||$request->word_type==3) {
                return redirect()->route('admin.words.finaledit',$word_id)->with(['success' => 'تم التحديث بنجاح']);
            }
            return redirect()->route('admin.words.secedit',$word_id)->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {

            return redirect()->route('admin.words')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }
    public function secedit($id)
    {
        $word=Word::Selection()->find($id);
        $word_derivatives= explode(", ",$word->word_derivatives);
        $meanings=Meaning::where('word_id','=',$word->id);

        try{
            if (!$word)
            return redirect()->route('admin.words')->with(['error' => 'هذه الكلمة غير موجودة او ربما تكون محذوفة ']);
            return view('admin.words.edit_word_2',compact('word','word_derivatives','meanings'));

        }catch(\Exception $exception){

            return redirect()->route('admin.words')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function secupdate(Request $request,$id)
    {
        try {

            $word = Word::Selection()->find($id);
           // $meaning=Meaning::where('word_id','=',$word->id);
            if (!$word){
                return redirect()->route('admin.words')->with(['error' => 'هذه الكلمة غير موجودة او ربما تكون محذوفة ']);
            }

           if ($request->has('word_derivatives')) {
            if(isset($_POST["word_derivatives"]) && is_array($_POST["word_derivatives"])){
                $word_derivatives= implode(", ", $_POST["word_derivatives"]);
	        }
            else{
                $word_derivatives=$request->word_derivatives;
            }
          //  DB::beginTransaction();

            $word::where('id', $id)
            ->update([
                'word_derivatives'=> $word_derivatives,
            ]);
            }
          /*  if ($request->has('word_meaning')) {
                if(isset($_POST["word_meaning"]) && is_array($_POST["word_meaning"])){
                    if($meaning){
                    foreach($_POST['word_meaning'] as $key => $value)
                    {
                        $meaning::where('word_id',$word->id)
                        ->update([
                            'word_meaning' =>$_POST['word_meaning'][$key],
                            'mojjam_id' =>$_POST['mojjam_id'][$key],
                            'admin_id'=> Auth::user()->id
                            ]);
                    }
                }
                }
            }*/
           // DB::commit();
              return redirect()->route('admin.words.finaledit',$word->id)->with(['success' => 'تم التحديث بنجاح']);
            } catch (\Exception $exception) {
              //  DB::rollback();


            return redirect()->route('admin.words')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
     public function thirdedit($id){
        $word=Word::Selection()->find($id);
        if (!$word){
            return redirect()->route('admin.words')->with(['error' => 'هذه الكلمة غير موجودة ']);
        }
        return view('admin.words.third_wordedit',compact('word'));
     }

     public function thirdupdate(otherWordPropertiesRequest $request,$id){
         try{
        $word=Word::Selection()->find($id);
        if (!$word){
            return redirect()->route('admin.words')->with(['error' => 'هذه الكلمة غير موجودة ']);
        }
        if ($request->has('other_word_properties')) {
            if(isset($_POST["other_word_properties"]) && is_array($_POST["other_word_properties"])){
                $other_word_properties= implode(", ", $_POST["other_word_properties"]);
            }
            else{
                $other_word_properties=$request->other_word_properties;
            }

            $word::where('id', $id)
        ->update([
            'other_word_properties'=> $other_word_properties
        ]);
         if ($request->has('moradfaat')){
            return redirect()->route('admin.moradfat.create',$word->id)->with(['success' => 'تم الحفظ بنجاح']);
        }
        }
        return redirect()->route('admin.words')->with(['success' => 'تم الحفظ بنجاح']);

    } catch (\Exception $exception){

        return redirect()->route('admin.words')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    }
     }

    public function finaledit($id){
                try{
                $word=Word::Selection()->find($id);
                if (!$word){
                    return redirect()->route('admin.words')->with(['error' => 'هذه الكلمة غير موجودة ']);
                }
                $other_word_properties=explode(",",$word->other_word_properties);
                return view('admin.words.final_edit_word',compact('word','other_word_properties'));
            }catch (\Exception $exception){

                return redirect()->route('admin.words')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
            }

            }

            public function finalupdate(otherWordPropertiesRequest $request,$id){
                try{
                $word=Word::Selection()->find($id);
                if (!$word){
                    return redirect()->route('admin.words')->with(['error' => 'هذه الكلمة غير موجودة ']);
                }
                if ($request->has('other_word_properties')) {
                    if(isset($_POST["other_word_properties"]) && is_array($_POST["other_word_properties"])){
                        $other_word_properties= implode(", ", $_POST["other_word_properties"]);
                    }
                    else{
                        $other_word_properties=$request->other_word_properties;
                    }
                    $word::where('id', $id)
                    ->update([
                        'other_word_properties'=> $other_word_properties
                    ]);
                }
                if ($request->has('moradfaat')){
                    return redirect()->route('admin.moradfat.create',$word->id)->with(['success' => 'تم الحفظ بنجاح']);
                }
                return redirect()->route('admin.words')->with(['success' => 'تم التحديث بنجاح']);;
            }catch (\Exception $exception){

                return redirect()->route('admin.words')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
            }

            }

    public function destroy($id)
    {

        try {
            $word=Word::Selection()->find($id);
            if (!$word){
                return redirect()->route('admin.words')->with(['error' => 'هذه الكلمة غير موجودة ']);
            }
            $sentences = $word->sentences();
            $meanings=$word->meanings();
            $moradfat=$word->moradfat();
            $abyaat=$word->abyaat();
            if ($sentences->count()>0) {
                $sentences->delete();
            }
            if ($meanings->count()>0) {
                $meanings->delete();
            }
            if ($moradfat->count()>0) {
                $moradfat->delete();
            }
            if ($abyaat->count()>0) {
                $abyaat->delete();
            }

            $word->delete();
            return redirect()->route('admin.words')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
           // return $ex;
            return redirect()->route('admin.words')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
