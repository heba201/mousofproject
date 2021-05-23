<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SourceRequest;
use App\Models\Source;
use Auth;
use DB;

class SourceController extends Controller
{
    public function index()
    {

        $sources = Source::selection()->get();

        return view('admin.source.index', compact('sources'));
    }

    public function create()
    {
        return view('admin.source.create');
    }

    public function store(SourceRequest $request)
    {

        //return $request;
       try {

          if(getold('App\Models\Source','source',$request->source)){
          return redirect()->route('admin.source')->with(['error' => ' هذا المصدر  تم اضافته من قبل ']);
          }
          $source = Source::create([
                'source' => $request->source,
                'admin_id' =>Auth::user()->id
            ]);
            return redirect()->route('admin.source')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.source')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id)
    {
        try {

            $source = Source::Selection()->find($id);
            if (!$source)
                return redirect()->route('admin.source')->with(['error' => 'هذا المصدر غير موجود او ربما يكون محذوفا ']);

            return view('admin.source.edit',compact('source'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.source')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function update($id, SourceRequest $request)
    {

        try {


            if(getresult('App\Models\Source','source',$request->source,'id',$id)){
                return redirect()->route('admin.source')->with(['error' => ' هذا المصدر  تم اضافته من قبل ']);
            }

            $source = Source::Selection()->find($id);
            if (!$source)
            return redirect()->route('admin.source')->with(['error' => 'هذا المصدر غير موجود او ربما يكون محذوفا ']);
            if ($source) {
                $source::where('id', $id)
                ->update([
                    'source' => $request->source,
                    'admin_id' =>Auth::user()->id
                ]);
              }

            return redirect()->route('admin.source')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.source')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function show($id)
    {
        $source = Source::Selection()->find($id);
        if (!$source)
        return redirect()->route('admin.source')->with(['error' => 'هذا المصدر غير موجود او ربما يكون محذوفا ']);
        return view('admin.source.show',compact('source'));
    }

    public function destroy($id)
    {

        try {
            $source = Source::Selection()->find($id);
            $words = $source->words();

            if (!$source)
            return redirect()->route('admin.source')->with(['error' => 'هذا المصدر غير موجود او ربما يكون محذوفا ']);
            if ($words->count()>0) {
                return redirect()->route('admin.source')->with(['error' => ' لا يمكن حذف   هذا المصدر ']);
            }

            $source->delete();
            return redirect()->route('admin.source')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.source')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
