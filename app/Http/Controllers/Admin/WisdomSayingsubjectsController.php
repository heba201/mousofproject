<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\WisdomsayingsubjectRequest;
use App\Models\WisdomSayingsubject;
use Auth;

class WisdomSayingsubjectsController extends Controller
{
    public function index()
    {

        $wisdomsayingsubjects = WisdomSayingsubject::selection()->get();

        return view('admin.wisdomsayingsubjects.index', compact('wisdomsayingsubjects'));
    }
    public function create()
    {
        return view('admin.wisdomsayingsubjects.create');
    }

    public function store(WisdomsayingsubjectRequest $request)
    {

        //return $request;
       try {

        if(getold('App\Models\WisdomSayingsubject','subject',$request->subject)){
            return redirect()->route('admin.wisdomsayingsubjects')->with(['error' => 'هذا الموضوع تم اضافته من قبل']);
            }
            $wisdomSayingsubject = WisdomSayingsubject::create([
                'subject' => $request->subject,
                'admin_id' =>Auth::user()->id,
            ]);
            return redirect()->route('admin.wisdomsayingsubjects')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
            return redirect()->route('admin.wisdomsayingsubjects')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id)
    {
        try {

            $wisdomSayingsubject= WisdomSayingsubject::Selection()->find($id);
            if (!$wisdomSayingsubject)
                return redirect()->route('admin.wisdomsayingsubjects')->with(['error' => 'هذا الموضوع غير موجود او ربما يكون محذوفا ']);

            return view('admin.wisdomsayingsubjects.edit', compact('wisdomSayingsubject'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.wisdomsayingsubjects')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function update($id, WisdomsayingsubjectRequest $request)
    {

        try {

            $wisdomSayingsubject= WisdomSayingsubject::Selection()->find($id);
            if(getresult('App\Models\WisdomSayingsubject','subject',$request->subject,'id',$id)){
                return redirect()->route('admin.wisdomsayingsubjects')->with(['error' => 'هذا الموضوع تم اضافته من قبل']);
            }
            if (!$wisdomSayingsubject){
                return redirect()->route('admin.wisdomsayingsubjects')->with(['error' => 'هذا الموضوع غير موجود او ربما يكون محذوفا ']);
            }
              if ($wisdomSayingsubject) {
                $wisdomSayingsubject::where('id', $id)
                ->update([
                'subject' => $request->subject,
                'admin_id' =>Auth::user()->id,
                ]);
              }
            return redirect()->route('admin.wisdomsayingsubjects')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return redirect()->route('admin.wisdomsayingsubjects')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function show($id)
    {
        try {

            $wisdomSayingsubject= WisdomSayingsubject::Selection()->find($id);
            if (!$wisdomSayingsubject)
                return redirect()->route('admin.wisdomsayingsubjects')->with(['error' => 'هذا الموضوع غير موجود او ربما يكون محذوفا ']);

            return view('admin.wisdomsayingsubjects.show', compact('wisdomSayingsubject'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.wisdomsayingsubjects')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function destroy($id)
    {
     //if there is sayings or wisdoms in this  subject no delete
        try {
            $mojjam = Mojjam::find($id);
            if (!$mojjam){
                return redirect()->route('admin.articlecategories')->with(['error' => 'هذا المعجم غير موجود ']);
            }

            $mojjam->delete();
            return redirect()->route('admin.articlecategories')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
           // return $ex;
            return redirect()->route('admin.articlecategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
