<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\WordRequest;
use App\Http\Requests\WordFirstupdate;
use App\Http\Requests\otherWordPropertiesRequest;
use App\Models\Word;
use App\Models\Wordgazer;
use App\Models\Gazertype;
use App\Models\Gazerweight;
use App\Models\Weightindication;
use App\Models\Time;
use App\Models\Source;
use App\Models\Wordname;
use App\Models\Wordcount;
use App\Models\Mojjam;
use App\Models\MojjamArrangetype;
use App\Models\MojjamMethod;
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

       // $words = Word::with('word')->selection()->groupBy('word_id')->get()->toArray() ;;
       $words =DB::table('words')
       ->select('words.*','wordnames.word')
       ->join('wordnames','wordnames.id','=','words.word_id')
       ->get()->keyBy('word');

        $sentences = Sentence::selection()->get();
        return view('admin.words.index', compact('words','sentences'));
    }
    public function create()
    {
       $word_indications=Wordindication::selection()->get();
       $mojjams = Mojjam::selection()->get();
       $words_gazer = Wordgazer::selection()->get();
       $gazer_types =Gazertype::selection()->get();
       $gazer_weights =Gazerweight::selection()->get();
       $weight_indications = Weightindication::selection()->get();
       $times =Time::selection()->get();
       $sources = Source::selection()->get();
       $mojjamarrangetypes=MojjamArrangetype::selection()->get();
       $mojjammethods=MojjamMethod::selection()->get();
        return view('admin.words.create',compact('word_indications','mojjams','words_gazer','gazer_types','gazer_weights','weight_indications','times','sources','mojjamarrangetypes','mojjammethods'));
    }

    public function store(WordRequest $request)
    {

        //return $request;
       try {
        $wordsnames = Wordname::selection()->get();
        $words = Word::selection()->get();
        foreach ($wordsnames as $wordname) {
            if ($request->word==$wordname->word) {
                $word_id=$wordname->id;
            foreach($words as $word){
                if($word->word_id==$word_id && $word->mojjam_id==$request->mojjam_id){
                    return redirect()->route('admin.words')->with(['error' => 'تم ادخال هذه الكلمة من قبل']);
                }
            }
        }
        }

        if(!getold('App\Models\Wordname','word',$request->word)){

            DB::beginTransaction();
            $word_id = Wordname::insertGetId([
                'word' => $request->word,
                'admin_id' =>Auth::user()->id
                ]);
            $word = Word::create([
            'word_id' => $word_id,
            'mojjam_id' => $request->mojjam_id,
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
            DB::commit();
        }
        else{
            $wordname=Wordname::where('word',$request->word)->selection()->first();
            $word_id=$wordname->id;
            $word = Word::create([
                'word_id' => $word_id,
                'mojjam_id' => $request->mojjam_id,
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
                    'word_count_id' => 'n',
                    'admin_id' =>Auth::user()->id,
                ]);
        }
            return redirect()->route('admin.words.seccreate',['id' =>$word_id,'mojjam_id' => $request->mojjam_id])->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
        DB::rollback();
        return $ex;
        return redirect()->route('admin.words')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
   }

    }
    public function seccreate($id,$mojjam_id)
    {
        $word=Word::with('word')->where('word_id',$id)->where('mojjam_id',$mojjam_id)->Selection()->first();
        $mojjam = Mojjam::where('id',$word->mojjam_id)->selection()->first();
        $word_count=Wordcount::Selection()->get();
        try{
            if (!$word)
            return redirect()->route('admin.words')->with(['error' => 'هذه الكلمة غير موجودة او ربما تكون محذوفة ']);
            return view('admin.words.create_word_2',compact('word','mojjam','word_count'));

        }catch(\Exception $exception){
            return redirect()->route('admin.words')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function firstupdate(WordFirstupdate $request,$id,$mojjam_id)
    {
        try {
            $word=Word::with('word')->where('word_id',$id)->where('mojjam_id',$mojjam_id)->Selection()->first();
            if (!$word){
                return redirect()->route('admin.words')->with(['error' => 'هذه الكلمة غير موجودة او ربما تكون محذوفة ']);
            }
            DB::beginTransaction();

        $meaningword = Meaning::create(['word_meaning' => $request->word_meaning,
                                                 'mojjam_id'  => $request->mojjam_id,
                                                 'word_id' =>$word->word_id,
                                                 'admin_id' => Auth::user()->id
                                                 ]);

            if ($request->has('word_derivatives')) {
                if(isset($_POST["word_derivatives"]) && is_array($_POST["word_derivatives"])){
                    $word_derivatives= implode(", ", $_POST["word_derivatives"]);
                }
                else{
                    $word_derivatives=$request->word_derivatives;
                }

                $word::where('word_id', $id)
            ->update([
                'word_derivatives'=> $word_derivatives,
                'word_count_id' =>$request->word_count
            ]);
            }
            DB::commit();
              return redirect()->route('admin.words.thirdedit',['id'=>$id,'mojjam_id'=>$word->mojjam_id])->with(['success' => 'تم الحفظ بنجاح']);
            } catch (\Exception $exception) {
                DB::rollback();
                return $exception;

            return redirect()->route('admin.words')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
    public function edit($id)
    {
        try {

            $word=Word::with('word')->where('word_id',$id)->Selection()->first();
            $mojjams = Word::with('mojjam')->where('word_id',$id)->selection()->get();
            $word_indications=Wordindication::selection()->get();
            $words_gazer = Wordgazer::selection()->get();
            $gazer_types =Gazertype::selection()->get();
            $gazer_weights =Gazerweight::selection()->get();
            $weight_indications = Weightindication::selection()->get();
            $times =Time::selection()->get();
            $sources = Source::selection()->get();
            if (!$word)
            return redirect()->route('admin.words')->with(['error' => 'هذه اكلمة غير موجودة او ربما تكون محذوفة ']);

            return view('admin.words.edit', compact('word','mojjams','word_indications','words_gazer','gazer_types','gazer_weights','weight_indications','times','sources'));

        } catch (\Exception $exception) {

            return redirect()->route('admin.words')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function update($id,WordRequest  $request)
    {

        try {
            $word=Word::with('word')->where('word_id',$id)->where('mojjam_id',$request->mojjam_id)->Selection()->first();
            $wordupdate_id=$word->id;
            $wordnames=Wordname::where('id','!=',$id)->Selection()->get();
            foreach ($wordnames as $wordname) {
                if($wordname->word== $request->word && $word->mojjam_id==$request->mojjam_id){
                    return redirect()->route('admin.words')->with(['error' => 'هذه الكلمة تم اضافتها من قبل']);
                }
            }
            if (!$word){
                return redirect()->route('admin.words')->with(['error' => 'هذه اكلمة غير موجودة او ربما تكون محذوفة ']);
            }
              if ($word) {
                DB::beginTransaction();
                $wordname::where('id', $id)
                ->update([
                    'word'=>$request->word,
                    'admin_id' =>Auth::user()->id
                ]);
                $word::where('id', $wordupdate_id)
                ->update([
                    'word_id' => $id,
                    'mojjam_id' => $request->mojjam_id,
                    'word_type'   => $request->word_type,
                    'word_gzer'   => $request->word_gzer,
                     'gzer_type'  => $request->gazer_type,
                     'gzer_weight'  => $request->gzer_weight,
                    'word_source'   => $request->word_source,
                     'word_indication'  => $request->word_indication,
                      'weight_indication' => $request->weight_indication,
                      'time' => $request->time,
                      'admin_id' =>Auth::user()->id,
                ]);
              }
              $word_id= $word ->word_id;
              if ($request->word_type==3) {
                return redirect()->route('admin.words.finaledit',['id'=>$word_id,'mojjam_id'=>$request->mojjam_id])->with(['success' => 'تم التحديث بنجاح']);
            }
            DB::commit();
            return redirect()->route('admin.words.secedit',['id'=>$word_id,'mojjam_id'=>$request->mojjam_id])->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            DB::rollback();
            return $exception;
            return redirect()->route('admin.words')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }
    public function secedit($id,$mojjam_id)
    {
        $word=Word::with('word')->where('word_id',$id)->where('mojjam_id',$mojjam_id)->Selection()->first();
        $word_derivatives= explode(", ",$word->word_derivatives);
        $meanings=Meaning::where('word_id','=',$word->id);
        $word_count=Wordcount::Selection()->get();
        try{
            if (!$word)
            return redirect()->route('admin.words')->with(['error' => 'هذه الكلمة غير موجودة او ربما تكون محذوفة ']);
            return view('admin.words.edit_word_2',compact('word','word_derivatives','meanings','word_count'));

        }catch(\Exception $exception){

            return redirect()->route('admin.words')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function secupdate(Request $request,$id,$mojjam_id)
    {
        try {

            $word=Word::with('word')->where('word_id',$id)->where('mojjam_id',$mojjam_id)->Selection()->first();
            // $meaning=Meaning::where('word_id','=',$word->id);
            $wordupdate_id=$word->id;
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

            $word::where('id', $wordupdate_id)
            ->update([
                'word_derivatives'=> $word_derivatives,
                'word_count_id' =>$request->word_count
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
              return redirect()->route('admin.words.finaledit',['id'=>$word->word_id,'mojjam_id'=>$word->mojjam_id])->with(['success' => 'تم التحديث بنجاح']);
            } catch (\Exception $exception) {
              //  DB::rollback();


            return redirect()->route('admin.words')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
     public function thirdedit($id,$mojjam_id){
        $word=Word::with('word')->where('word_id',$id)->where('mojjam_id',$mojjam_id)->Selection()->first();
        if (!$word){
            return redirect()->route('admin.words')->with(['error' => 'هذه الكلمة غير موجودة ']);
        }
        return view('admin.words.third_wordedit',compact('word'));
     }

     public function thirdupdate(otherWordPropertiesRequest $request,$id,$mojjam_id){
         try{

            $word=Word::with('word')->where('word_id',$id)->where('mojjam_id',$mojjam_id)->Selection()->first();
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

            $word::where('word_id', $id)
        ->update([
            'other_word_properties'=> $other_word_properties
        ]);
         if ($request->has('moradfaat')){
            return redirect()->route('admin.moradfat.create',$word->word_id)->with(['success' => 'تم الحفظ بنجاح']);
        }
        }
        return redirect()->route('admin.words')->with(['success' => 'تم الحفظ بنجاح']);

    } catch (\Exception $exception){

        return redirect()->route('admin.words')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    }
     }

    public function finaledit($id,$mojjam_id){
                try{
                    $word=Word::with('word')->where('word_id',$id)->where('mojjam_id',$mojjam_id)->Selection()->first();
                    $word_meaning=Meaning::with('mojjam')->where('word_id',$id)->where('mojjam_id',$mojjam_id)->Selection()->first();
                    if (!$word){
                    return redirect()->route('admin.words')->with(['error' => 'هذه الكلمة غير موجودة ']);
                }
                $other_word_properties=explode(",",$word->other_word_properties);
                return view('admin.words.final_edit_word',compact('word','other_word_properties','word_meaning'));
            }
            catch (\Exception $exception){

                return redirect()->route('admin.words')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
            }
            }

            public function finalupdate(otherWordPropertiesRequest $request,$id,$mojjam_id){
                try{
                $wordname=Wordname::where('id',$id)->Selection()->first();
                $word=Word::where('word_id',$wordname->id)->where('mojjam_id',$mojjam_id)->Selection()->first();
                $wordupdate_id=$word->id;
                $wordmeaning=Meaning::where('word_id',$id)->where('mojjam_id',$mojjam_id)->Selection()->first();
                $wordmeaningupdate_id=$wordmeaning->id;
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
                    DB::beginTransaction();
                    $wordmeaning::where('id', $wordmeaningupdate_id)
                    ->update([
                        'word_meaning'=> $request->word_meaning,

                    ]);
                    $word::where('id', $wordupdate_id)
                    ->update([
                        'other_word_properties'=> $other_word_properties
                    ]);
                }
                if ($request->has('moradfaat')){
                    DB::commit();
                    return redirect()->route('admin.moradfat.create',$word->word_id)->with(['success' => 'تم الحفظ بنجاح']);
                }
                DB::commit();
                return redirect()->route('admin.words')->with(['success' => 'تم التحديث بنجاح']);;
            }catch (\Exception $exception){
                DB::rollback();
                return redirect()->route('admin.words')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
            }

            }

        public function show($id)
        {
     $word=Word::with('word','mojjam')->where('word_id',$id)->Selection()->get();
       $word_indications=Wordindication::selection()->get();
      /* foreach($word as $w){
       $other_word_properties=explode(",",$w->other_word_properties);
       } */
      /* foreach($word as $w){
       $word_derivatives=explode(",",$w-> word_derivatives);
       } */
       $word_count=Wordcount::Selection()->get();
       $words_gazer = Wordgazer::selection()->get();
       $gazer_types =Gazertype::selection()->get();
       $gazer_weights =Gazerweight::selection()->get();
       $weight_indications = Weightindication::selection()->get();
       $times =Time::selection()->get();
       $sources = Source::selection()->get();
       if (!$word){
           return redirect()->route('admin.words')->with(['error' => 'هذه الكلمة غير موجودة ']);
       }
        return view('admin.words.show',compact('word','word_indications','word_count','words_gazer','gazer_types','gazer_weights','weight_indications','times','sources'));
        }


    public function destroy($id)
    {

        try {
            $word=Wordname::Selection()->find($id);
            if (!$word){
                return redirect()->route('admin.words')->with(['error' => 'هذه الكلمة غير موجودة ']);
            }
            $sentences = $word->sentences();
            $meanings=$word->meanings();
            $moradfat=$word->moradfat();
            $abyaat=$word->abyaat();
            $words=$word->words();
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
            if ($words->count()>0) {
                $words->delete();
            }

            $word->delete();
            return redirect()->route('admin.words')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
           // return $ex;
            return redirect()->route('admin.words')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
