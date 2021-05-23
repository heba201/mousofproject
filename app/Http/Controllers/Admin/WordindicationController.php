<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\WordindicationRequest;
use App\Models\Wordindication;
use Auth;
use DB;

class WordindicationController extends Controller
{
    public function index()
    {

        $wordindications = Wordindication::selection()->get();

        return view('admin.word_indication.index', compact('wordindications'));
    }

    public function create()
    {
        return view('admin.word_indication.create');
    }

    public function store(WordindicationRequest $request)
    {

        //return $request;
       try {

          if(getold('App\Models\Wordindication','word_indication',$request->word_indication)){
          return redirect()->route('admin.wordindication')->with(['error' => 'هذه الدلالة تم اضافته من قبل']);
          }
          $word_indication = Wordindication::create([
                'word_indication' => $request->word_indication,
                'admin_id' =>Auth::user()->id
            ]);
            return redirect()->route('admin.wordindication')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.wordindication')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id)
    {
        try {

            $word_indication = Wordindication::Selection()->find($id);
            if (!$word_indication)
                return redirect()->route('admin.wordindication')->with(['error' => 'هذه الدلالة غير موجودة او ربما تكون محذوفة ']);

            return view('admin.word_indication.edit',compact('word_indication'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.wordindication')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }



    public function update($id, WordindicationRequest $request)
    {

        try {


            if(getresult('App\Models\Wordindication','word_indication',$request->word_indication,'id',$id))
            {
                return redirect()->route('admin.wordindication')->with(['error' => 'هذه الدلالة تم اضافته من قبل']);
            }

            $word_indication = Wordindication::Selection()->find($id);
                if (!$word_indication)
                return redirect()->route('admin.wordindication')->with(['error' => 'هذه الدلالة غير موجودة او ربما تكون محذوفة ']);
              if ($word_indication) {
                $word_indication::where('id', $id)
                ->update([
                    'word_indication' => $request->word_indication,
                    'admin_id' =>Auth::user()->id
                ]);
              }

            return redirect()->route('admin.wordindication')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.wordindication')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function show($id)
    {
        $word_indication = Wordindication::Selection()->find($id);
        if (!$word_indication)
        return redirect()->route('admin.wordindication')->with(['error' => 'هذه الدلالة غير موجودة او ربما تكون محذوفة ']);
        return view('admin.word_indication.show',compact('word_indication'));
    }

    public function destroy($id)
    {

        try {
            $word_indication = Wordindication::Selection()->find($id);
            $words = $word_indication->words();

            if (!$word_indication)
            return redirect()->route('admin.wordindication')->with(['error' => 'هذه الدلالة غير موجودة او ربما تكون محذوفة ']);
            if ($words->count()>0) {
                return redirect()->route('admin.wordindication')->with(['error' => 'لا يمكن حذف هذه الدلالة']);
            }

            $word_indication->delete();
            return redirect()->route('admin.wordindication')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.wordindication')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
