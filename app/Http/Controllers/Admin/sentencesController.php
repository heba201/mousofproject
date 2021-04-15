<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SentenceRequest;
use App\Http\Requests\SentenceeditRequest;
use App\Models\Word;
use App\Models\Sentence;
use Auth;
class sentencesController extends Controller
{
    //
     public function index()
    {
        $sentences=Sentence::with('word')->Selection()->get();
        return view('admin.sentences.index', compact('sentences'));
    }
    public function addsentence($id)
    {

        $word=Word::Selection()->find($id);
        return view('admin.sentences.create', compact('word'));
    }

    public function createforword(SentenceRequest $request,$id)
    {
        $word=Word::Selection()->find($id);
        try{
            if (!$word)
            return redirect()->route('admin.words')->with(['error' => 'هذه الكلمة غير موجودة او ربما تكون محذوفة ']);
            /* no repeat for sentence for word*/
            $sentences=Sentence::with('word')->Selection()->where('word_id','=',$word->id)->get();
           // print_r($sentences);
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            if (isset($_POST['word_sentense']))
            {
            foreach($_POST['word_sentense'] as $key => $value)
            {
                if ($sentences) {
                foreach($sentences as $sent){
                if ($sent->word_sentence == $_POST['word_sentense'][$key]) {
                    return redirect()->route('admin.words')->with(['error' => 'هذه الجملة  تم  اضافتها من قبل ']);
                }
            }
                }
             }
            }
        }

            if (isset($_POST["word_sentense"]) && is_array($_POST["word_sentense"])) {
            foreach( $request->word_sentense as $key=>$val)
            {
                $sentence = Sentence::create(['word_sentence' => $_POST["word_sentense"][$key],
                                             'word_id' =>$word->id,
                                             'admin_id' => Auth::user()->id
                                             ]);
             }
             return redirect()->route('admin.words',)->with(['success' => 'تم الحفظ بنجاح']);
        }
    }
        catch(\Exception $ex)
        {
           return  $ex;
            return redirect()->route('admin.words')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

}
public function editsentence($id)
    {
       /* $word = Word::Selection()->find($id);
        $sentences = Sentence::where('word_id', $word->id)
        ->join('words', 'words.id', '=', 'sentences.word_id')
        ->select('word_sentence')->get();
*/
   $sentence=Sentence::with('word')->Selection()->find($id);
    try{

        if (!$sentence){
            return redirect()->route('admin.sentences')->with(['error' => 'هذه الجملة غير موجودة او ربما تكون محذوفة ']);
        }
            if($sentence){
            return view('admin.sentences.edit', compact('sentence'));
            }

    }
    catch(\Exception $exception){
        return $exception;
        return redirect()->route('admin.sentences')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    }
    }

    public function updateforword(SentenceeditRequest $request,$id)
    {
        $sentence=Sentence::Selection()->find($id);

      /*  $sentence = Sentence::select('sentences.*','word')
        ->join('words', 'words.id', '=', 'sentences.word_id')
        ->where('sentences.word_id','=',$id)
        ->get(); */
        try{
            if (!$sentence)
            return redirect()->route('admin.sentences')->with(['error' => 'هذه الجملة غير موجودة او ربما تكون محذوفة ']);
            if ($request->has('word_sentense')) {

                    if(getresult('App\Models\Sentence','word_sentence',$request->word_sentense,'id',$id)){
                        return redirect()->route('admin.sentences')->with(['error' => 'هذه الجملة تم اضافتها من قبل']);
                    }

            }

            $sentence::where('id', $id)->
                update(['word_sentence'=>$request->word_sentense,
                                             'admin_id' => Auth::user()->id
                                             ]);
             return redirect()->route('admin.sentences',)->with(['success' => 'تم الحفظ بنجاح']);

    }
        catch(\Exception $ex)
        {
           return  $ex;
            return redirect()->route('admin.sentences')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

}

        public function show($id)
        {

        $sentence=Sentence::with('word')->Selection()->find($id);
        try{

            if (!$sentence){
                return redirect()->route('admin.sentences')->with(['error' => 'هذه الجملة غير موجودة او ربما تكون محذوفة ']);
            }
                if($sentence){
                return view('admin.sentences.show', compact('sentence'));
                }

        }
        catch(\Exception $exception){
            return $exception;
            return redirect()->route('admin.sentences')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
        }

public function destroy($id)
{

    try {
        $sentence=Sentence::Selection()->find($id);
        if (!$sentence){
            return redirect()->route('admin.sentences')->with(['error' => 'هذه الجملة غير موجودة ']);
        }

        $sentence->delete();
        return redirect()->route('admin.sentences')->with(['success' => 'تم الحذف بنجاح']);

    } catch (\Exception $ex) {
       // return $ex;
        return redirect()->route('admin.sentences')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
    }
}

}
