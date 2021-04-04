<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Articlecategory;
use Auth;
use DB;

class ArticlesController extends Controller
{
    public function index()
    {

        $articles = Article::selection()->get();

        return view('admin.articles.index', compact('articles'));
    }
    public function create()

    {
        $articlecategories=Articlecategory::selection()->get();
        return view('admin.articles.create',compact('articlecategories'));
    }

    public function store(ArticleRequest $request)
    {

        //return $request;
       try {
        if(getold('App\Models\Article','article_title',$request->article_title)){
            return redirect()->route('admin.articles')->with(['error' => 'هذا المقال تم اضافته من قبل']);
            }
        $filePath = "";
        if ($request->has('article_photo')) {
            $filePath = uploadImage('articles', $request->article_photo);
        }
            $article = Article::create([
                'article_category' => $request->article_category,
                'article_title' => $request->article_title,
                'article_details' => $request->article_details,
                'article_photo' => $filePath,
                'admin_id' =>Auth::user()->id,
            ]);
            return redirect()->route('admin.articles')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
            return $ex;
        return redirect()->route('admin.articles')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id)
    {
        try {
            $articlecategories=Articlecategory::selection()->get();
            $article = Article::Selection()->find($id);
            if (!$article)
                return redirect()->route('admin.articles')->with(['error' => 'هذا المقال غير موجود او ربما يكون محذوف ']);

            return view('admin.articles.edit', compact('article','articlecategories'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.articles')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function update($id, ArticleRequest $request)
    {

        try {

            $article = Article::Selection()->find($id);
            if(getresult('App\Models\Article','article_title',$request->article_title,'id',$id)){
                return redirect()->route('admin.articles')->with(['error' => 'هذا المقال تم اضافته من قبل']);
            }
            if (!$article)
                return redirect()->route('admin.articles')->with(['error' => 'هذا المقال غير موجود او ربما يكون محذوف ']);
                DB::beginTransaction();
                //photo
                if ($request->has('article_photo') ) {
                     $filePath = uploadImage('articles', $request->article_photo);
                     $article::where('id', $id)
                        ->update([
                            'article_photo' => $filePath,
                        ]);
                }
                $data = $request->except('_token', 'id', 'article_photo');
                $data['admin_id']=Auth::user()->id;
                $article::where('id', $id)
                ->update(
                    $data
                );
                DB::commit();
            return redirect()->route('admin.articles')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->route('admin.articles')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }


    public function show($id)
    {
        try {

            $article = Article::Selection()->find($id);
            $articlecategories=Articlecategory::selection()->get();
            if (!$article)
                return redirect()->route('admin.articles')->with(['error' => 'هذا المقال غير موجود او ربما يكون محذوف ']);

            return view('admin.articles.show', compact('article','articlecategories'));

        } catch (\Exception $exception) {
          return $exception;
            return redirect()->route('admin.articles')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }


    public function destroy($id)
    {

        try {

            $article = Article::Selection()->find($id);
            if (!$article)
                return redirect()->route('admin.articles')->with(['error' => 'هذا المقال غير موجود او ربما يكون محذوف ']);
                $image = Str::after($article->article_photo, 'assets/');
               // $image = base_path('assets/' . $image);
               $image ='assets/' . $image;
                unlink($image); //delete from folder
                $article->delete();
            return redirect()->route('admin.articles')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            //return $ex;
            return redirect()->route('admin.articles')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
