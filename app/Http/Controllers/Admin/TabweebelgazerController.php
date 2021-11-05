<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Word;
use App\Models\Wordindication;
use App\Models\Wordgazer;
use App\Models\Gazertype;
use App\Models\Gazerweight;
use App\Models\Weightindication;
use App\Models\Time;
use App\Models\Source;
use App\Models\Wordname;
use App\Models\Wordcount;
use App\Models\Mojjam;
class TabweebelgazerController extends Controller
{
    public function index($id,$mojjam_id)
    {
        try {
            $word=Word::with('word')->where('word_id',$id)->where('mojjam_id',$mojjam_id)->Selection()->first();
            return view('admin.tbweebelgazer.index', compact('word'));
        }
        catch (\Exception $exception) {
        return redirect()->route('admin.mojjams.showwords',$word->mojjam_id)->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function create($word_id,$mojjam_id)
    {
        $mojjam = Mojjam::Selection()->find($mojjam_id);
        $word=Word::with('word')->where('word_id',$word_id)->where('mojjam_id',$mojjam_id)->Selection()->first();
        $word_indications=Wordindication::selection()->get();
            $words_gazer = $mojjam->gzor()->selection()->get();
            $gazer_types =Gazertype::selection()->get();
            $gazer_weights =Gazerweight::selection()->get();
            $weight_indications = Weightindication::selection()->get();
            $times =Time::selection()->get();
            $sources = Source::selection()->get();
            $word_count=Wordcount::Selection()->get();
        return view('admin.tbweebelgazer.create',compact('mojjam','word','word_indications','words_gazer','gazer_types','gazer_weights','weight_indications','times','sources','word_count'));

    }
}
