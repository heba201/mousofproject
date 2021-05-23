<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TimeRequest;
use App\Models\Time;
use Auth;
use DB;

class TimeController extends Controller
{
    public function index()
    {

        $times = Time::selection()->get();

        return view('admin.time.index', compact('times'));
    }

    public function create()
    {
        return view('admin.time.create');
    }

    public function store(TimeRequest $request)
    {

        //return $request;
       try {

          if(getold('App\Models\Time','time',$request->time)){
          return redirect()->route('admin.time')->with(['error' => ' هذا الزمن  تم اضافته من قبل ']);
          }
          $time = Time::create([
                'time' => $request->time,
                'admin_id' =>Auth::user()->id
            ]);
            return redirect()->route('admin.time')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.time')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id)
    {
        try {

            $time= Time::Selection()->find($id);
            if (!$time)
                return redirect()->route('admin.time')->with(['error' => 'هذا الزمن غير موجود او ربما يكون محذوفا ']);

            return view('admin.time.edit',compact('time'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.time')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function update($id, TimeRequest $request)
    {

        try {


            if(getresult('App\Models\Time','time',$request->time,'id',$id)){
                return redirect()->route('admin.time')->with(['error' => ' هذا الزمن  تم اضافته من قبل ']);
            }

            $time= Time::Selection()->find($id);
            if (!$time)
            return redirect()->route('admin.time')->with(['error' => 'هذا الزمن غير موجود او ربما يكون محذوفا ']);
            if ($time) {
                $time::where('id', $id)
                ->update([
                    'time' => $request->time,
                    'admin_id' =>Auth::user()->id
                ]);
              }

            return redirect()->route('admin.time')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.time')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function show($id)
    {
        $time= Time::Selection()->find($id);
        if (!$time)
        return redirect()->route('admin.time')->with(['error' => 'هذا الزمن غير موجود او ربما يكون محذوفا ']);
        return view('admin.time.show',compact('time'));
    }

    public function destroy($id)
    {

        try {
            $time= Time::Selection()->find($id);
            $words = $time->words();

            if (!$time)
            return redirect()->route('admin.time')->with(['error' => 'هذا الزمن غير موجود او ربما يكون محذوفا ']);
            if ($words->count()>0) {
                return redirect()->route('admin.time')->with(['error' => ' لا يمكن حذف   هذا الزمن ']);
            }

            $time->delete();
            return redirect()->route('admin.time')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.time')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
