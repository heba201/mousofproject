<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ArticlecategoryRequest;
use App\Models\Articlecategory;
use Auth;

class ArticlecategoriesController extends Controller
{
    public function index()
    {

        $articlecategories = Articlecategory::selection()->get();

        return view('admin.articlecategories.index', compact('articlecategories'));
    }
    public function create()
    {
        return view('admin.articlecategories.create');
    }

    public function store(ArticlecategoryRequest $request)
    {


       try {

        if(getold('App\Models\Articlecategory','article_category',$request->article_category)){
            return redirect()->route('admin.articlecategories')->with(['error' => 'هذا التصنيف تم اضافته من قبل']);
            }
            $articlecategory = Articlecategory::create([
                'article_category' => $request->article_category,
                'admin_id' =>Auth::user()->id,
            ]);
            return redirect()->route('admin.articlecategories')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
            return redirect()->route('admin.articlecategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id)
    {
        try {

            $articlecategory= Articlecategory::Selection()->find($id);
            if (!$articlecategory)
                return redirect()->route('admin.articlecategories')->with(['error' => 'هذا التصنيف غير موجود او ربما يكون محذوفا ']);

            return view('admin.articlecategories.edit', compact('articlecategory'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.articlecategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function update($id, ArticlecategoryRequest $request)
    {

        try {

            $articlecategory= Articlecategory::Selection()->find($id);
            if(getresult('App\Models\Articlecategory','article_category',$request->article_category,'id',$id)){
                return redirect()->route('admin.articlecategories')->with(['error' => 'هذا التصنيف تم اضافته من قبل']);
            }
            if (!$articlecategory){
                return redirect()->route('admin.articlecategories')->with(['error' => 'هذاالتصنيف غير موجود او ربما يكون محذوفا ']);
            }
              if ($articlecategory) {
                $articlecategory::where('id', $id)
                ->update([
                'article_category' => $request->article_category,
                'admin_id' =>Auth::user()->id,
                ]);
              }
            return redirect()->route('admin.articlecategories')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return redirect()->route('admin.articlecategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function show($id)
    {
        try {

            $articlecategory= Articlecategory::Selection()->find($id);

            if (!$articlecategory)
                return redirect()->route('admin.articlecategories')->with(['error' => 'هذا التصنيف غير موجود او ربما يكون محذوف ']);

            return view('admin.articlecategories.show', compact('articlecategory'));

        } catch (\Exception $exception) {
          return $exception;
            return redirect()->route('admin.articlecategories')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function destroy($id)
    {
     //if there is artices in this  category no delete
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
