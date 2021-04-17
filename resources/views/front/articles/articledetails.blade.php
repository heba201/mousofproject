@extends('front.layout')
@push('style')
<style>
    .ar{
        float: right;
    }
    .side{
        float: left;
    }
.sidebar{
padding:50px;
border: 2px solid #d82a4e;
background: white;
border-radius: 6px;
margin-bottom: 30px;
transition: all 0.3s ease-in-out;
}
.sidebar h4{
    margin: 40px 0px;
}

.sidebar:hover{
    border-top:  6px solid #d82a4e;
    padding-top: 45px;
    box-shadow: 0 5px 15px rgba(0, 0, 0,0.1);
}
.blog-page p{
    color:#403a3a;
}


.blog-post .blog-metas .blog-meta:before {
	position: absolute;
	content: "";
	width: 2px;
	height: 30px;
	right:0;
	top: calc(50% - 15px);
	background: #d82a4e;
}

.blog-post .blog-metas .blog-meta:last-child::before {
	display: none;
}

    </style>
@endpush
@section('content')
<!-- Page  -->
<section class="blog-page spad pb-0"  style="text-align: right">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <!-- blog post -->
                <div class="blog-post" >
                    <img src="{{asset('assets/'.$article->article_photo)}}" alt="articl-img" width="700" height="300">
                    <h3>{{$article->article_title}}</h3>
                    <div class="blog-metas">
                        <div class="blog-meta author">
                            <div class="post-author set-bg" data-setbg="img/authors/1.jpg"></div>
                            <a href="#">{{$article->admin->name}}</a>
                        </div>
                        <div class="blog-meta">
                            <a href="#">{{$article->articlecategory->article_category}}</a>
                        </div>
                        <div class="blog-meta">
                            <a href="#">{{$article->created_at->todatestring()}}</a>
                        </div>

                    </div>
                    <p>{{$article->article_details}}</p>
                </div>
                <div class="col-md-12 text-center" style="margin-bottom: 15px;">
                    <h4>مشاركة</h4>
                </div>
                <div class="col-md-9 text-center">
                    <div class="sharethis-inline-share-buttons text-center" style="margin-right:150px;margin-bottom:15px;"></div>
                </div>
                <div class="col-md-9">
                    <a class="text-right site-btn" href="{{route('articles')}}" style="background:#d82a4e;margin-top:10px;">المزيد من المقالات</a>

                </div>
            </div>
            <div class="col-lg-3 col-md-5 col-sm-9 sidebar">
                <div class="sb-widget-item">
                </div>
                <div class="sb-widget-item">
                    <h4 class="sb-w-title">تصنيفات</h4>
                    <ul>
                        @foreach ($articlecategories as $cat)
                        <li><a href="{{route('articlecategory',$cat->id)}}">{{$cat->article_category}}</a></li>
                        @endforeach

                    </ul>
                </div>
                <div class="sb-widget-item">
                    <h4 class="sb-w-title">أرشيف</h4>
                    <ul>
                        <?php
                        $i=count($articlesall);
                        for ($i=0; $i <count($articlesall) ; $i++) {
                            $catd[$i]=$articlesall[$i]->created_at->todatestring();
                        }
                        $articldates = array_unique($catd);
                        ?>
                        @foreach ($articldates as $d)
                      <li><a href="{{route('articlesbydate',$d)}}"> {{$d}} </a></li>
                            @endforeach
                    </ul>
                </div>
                <div class="sb-widget-item">
                    <div class="add">
                        <a href="#"><img src="img/add.jpg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page end -->





@endsection
