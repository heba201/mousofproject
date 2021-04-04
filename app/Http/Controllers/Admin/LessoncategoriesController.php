<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LessoncategoryRequest;
use App\Models\Lessoncategory;
use Auth;

class LessoncategoriesController extends Controller
{
    public function index()
    {

        $lessoncategories = Lessoncategory::selection()->get();

        return view('admin.lessoncategories.index', compact('lessoncategories'));
    }
    public function create()
    {
        return view('admin.lessoncategories.create');
    }

    public function store(LessoncategoryRequest $request)
    {

        //return $request;
       try {

        if(getold('App\Models\Lessoncategory','lesson_category',$request->lesson_category)){
            return redirect()->route('admin.lessoncategories')->with(['error' => 'هذا التصنيف تم اضافته من قبل']);
            }
            $lessoncategory = Lessoncategory::create([
                'lesson_category' => $request->lesson_category,
                'admin_id' =>Auth::user()->id,
            ]);
            return redirect()->route('admin.lessoncategories')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
            return redirect()->route('admin.lessoncategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id)
    {
        try {

            $lessoncategory= Lessoncategory::Selection()->find($id);
            if (!$lessoncategory)
                return redirect()->route('admin.lessoncategories')->with(['error' => 'هذا التصنيف  غير موجود او ربما يكون محذوفا ']);

            return view('admin.lessoncategories.edit', compact('lessoncategory'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.lessoncategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function update($id, LessoncategoryRequest $request)
    {

        try {

            $lessoncategory=  Lessoncategory::Selection()->find($id);

            if(getresult('App\Models\Lessoncategory','lesson_category',$request->lesson_category,'id',$id)){
                return redirect()->route('admin.lessoncategories')->with(['error' => 'هذا التصنيف تم اضافته من قبل']);
            }
            if (!$lessoncategory){
                return redirect()->route('admin.lessoncategories')->with(['error' => 'هذاالتصنيف غير موجود او ربما يكون محذوفا ']);
            }
              if ($lessoncategory) {
                $lessoncategory::where('id', $id)
                ->update([
                'lesson_category' => $request->lesson_category,
                'admin_id' =>Auth::user()->id,
                ]);
              }
            return redirect()->route('admin.lessoncategories')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.lessoncategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }
    public function show($id)
    {
        try {

            $lessoncategory= Lessoncategory::Selection()->find($id);
            if (!$lessoncategory)
                return redirect()->route('admin.lessoncategories')->with(['error' => 'هذا التصنيف  غير موجود او ربما يكون محذوفا ']);

            return view('admin.lessoncategories.show', compact('lessoncategory'));

        } catch (\Exception $exception) {

            return redirect()->route('admin.lessoncategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function destroy($id)
    {
     //if there is lessons in this  category no delete
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
