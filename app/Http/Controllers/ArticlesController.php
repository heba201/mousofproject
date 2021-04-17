<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Articlecategory;
use DB;

class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::selection()->paginate(10);
        $articlecategories=Articlecategory::selection()->get();
        $articlesall = Article::selection()->limit(5)->get();
        return view('front.articles.articles',compact('articles','articlecategories','articlesall'));
    }
    public function articleshow($id){

            try {
                $article = Article::Selection()->find($id);
                if (!$article)
                return redirect()->route('home')->with(['error' => 'هذا المقال غير موجود او ربما يكون محذوف ']);


                $articlecategories=Articlecategory::selection()->get();
                $articlesall = Article::selection()->limit(5)->get();
                return view('front.articles.articledetails',compact('article','articlecategories','articlesall'));
            }

         catch (\Exception $exception) {
            return redirect()->route('home')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }

    }

    public function articlesbycategory($id)
    {
        try {
        $articles = Article::selection()->where('article_category',$id)->paginate(10);

        $articlecategories=Articlecategory::selection()->get();
        $articlesall = Article::selection()->limit(5)->get();
       // if($articles->count==0)
       // return redirect()->route('articles');
        return view('front.articles.articles',compact('articles','articlecategories','articlesall'));
        }

        catch (\Exception $exception) {
            return $exception;
            return redirect()->route('articles');

        }

    }

    public function articlesbydate($date)
    {
        try {
        $articles = Article::selection()->whereDate('created_at', '=',$date)->paginate(10);

        $articlecategories=Articlecategory::selection()->get();
        $articlesall = Article::selection()->limit(5)->get();
       // if($articles->count==0)
       // return redirect()->route('articles');
        return view('front.articles.articles',compact('articles','articlecategories','articlesall'));
        }

        catch (\Exception $exception) {
            return $exception;
            return redirect()->route('articles');

        }

    }
}

