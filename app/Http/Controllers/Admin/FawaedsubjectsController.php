<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\FaedasubjectRequest;
use App\Models\Faedasubject;
use App\Models\Faeda;
use Auth;

class FawaedsubjectsController extends Controller
{
    public function index()
    {

        $fawaedsubjects = Faedasubject::selection()->get();

        return view('admin.fawedsubjects.index', compact('fawaedsubjects'));
    }

    public function create()
    {
        return view('admin.fawedsubjects.create');
    }

    public function store(FaedasubjectRequest $request)
    {

       try {

        if(getold('App\Models\Faedasubject','faeda_subject',$request->faeda_subject)){
            return redirect()->route('admin.fawaedsubjects')->with(['error' => 'هذا الموضوع تم اضافته من قبل']);
            }
            $fawaedsubject = Faedasubject::create([
                'faeda_subject' => $request->faeda_subject,
                'admin_id' =>Auth::user()->id,
            ]);
            return redirect()->route('admin.fawaedsubjects')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.fawaedsubjects')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id)
    {
        try {

            $fawaedsubject= Faedasubject::Selection()->find($id);
            if (!$fawaedsubject)
                return redirect()->route('admin.fawaedsubjects')->with(['error' => 'هذا الموضوع غير موجود او ربما يكون محذوفا ']);

            return view('admin.fawedsubjects.edit', compact('fawaedsubject'));

        } catch (\Exception $exception) {

            return redirect()->route('admin.fawaedsubjects')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function update($id, FaedasubjectRequest $request)
    {

        try {

            $fawaedsubject= Faedasubject::Selection()->find($id);
            if(getresult('App\Models\Faedasubject','faeda_subject',$request->faeda_subject,'id',$id)){
                return redirect()->route('admin.fawaedsubjects')->with(['error' => 'هذا الموضوع تم اضافته من قبل']);
            }
            if (!$fawaedsubject){
                return redirect()->route('admin.fawaedsubjects')->with(['error' => 'هذا الموضوع غير موجود او ربما يكون محذوفا ']);
            }
              if ($fawaedsubject) {
                $fawaedsubject::where('id', $id)
                ->update([
                'faeda_subject' => $request->faeda_subject,
                'admin_id' =>Auth::user()->id,
                ]);
              }
            return redirect()->route('admin.fawaedsubjects')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return redirect()->route('admin.fawaedsubjects')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function show($id)
    {
        try {

            $fawaedsubject= Faedasubject::Selection()->find($id);

            if (!$fawaedsubject)
                return redirect()->route('admin.fawaedsubjects')->with(['error' => 'هذا الموضوع غير موجود او ربما يكون محذوفا ']);

            return view('admin.fawedsubjects.show', compact('fawaedsubject'));

            return view('admin.articles.show', compact('article','articlecategories'));

        } catch (\Exception $exception) {

            return redirect()->route('admin.fawaedsubjects')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function destroy($id)
    {
     //if there is fawed in this  subject no delete
        try {
            $fawaedsubject = Faedasubject::find($id);
            $fawaed = $fawaedsubject->fawed();
            if (!$fawaedsubject){
                return redirect()->route('admin.fawaedsubjects')->with(['error' => 'هذا الموضوع غير موجود ']);
            }
            if (isset($fawaed) && $fawaed->count() > 0) {
                return redirect()->route('admin.fawaedsubjects')->with(['error' => 'لأ يمكن حذف هذا الموضوع  ']);
            }

            $fawaedsubject->delete();

            return redirect()->route('admin.fawaedsubjects')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {

            return redirect()->route('admin.fawaedsubjects')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
