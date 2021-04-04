<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Articlecategory;


class ArticlesController extends Controller
{
    public function index()
    {
        $articles = Article::selection()->paginate(PAGINATION_COUNT);
        $articlecategories=Articlecategory::selection()->get();
        return view('front.articles.art2',compact('articles','articlecategories'));
    }
    public function articleshow($id){

            try {
                $article = Article::Selection()->find($id);
                if (!$article)
                return redirect()->route('home')->with(['error' => 'هذا المقال غير موجود او ربما يكون محذوف ']);


                $articlecategories=Articlecategory::selection()->get();
                return view('front.articles.articledetails',compact('article','articlecategories'));
            }

         catch (\Exception $exception) {
            return redirect()->route('home')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }

    }
}

