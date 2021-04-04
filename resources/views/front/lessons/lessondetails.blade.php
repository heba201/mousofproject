@extends('front.layout')
@section('content')
<!-- Page  -->
<section class="blog-page spad pb-0"  style="text-align: right">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <!-- blog post -->
                <div class="blog-post" >
                    <img src="{{asset('assets/'.$lesson->lesson_photo)}}" alt="">
                    <h3>{{$lesson->lesson_title}}</h3>
                    <div class="blog-metas">
                        <div class="blog-meta author">
                            <div class="post-author set-bg" data-setbg="img/authors/1.jpg"></div>
                            <a href="#">James Smith</a>
                        </div>
                        <div class="blog-meta">
                            <a href="#">Development</a>
                        </div>
                        <div class="blog-meta">
                            <a href="#">June 12, 2018</a>
                        </div>

                    </div>
                    <p>{{$lesson->lesson_details}}</p>
                </div>

            </div>
            <div class="col-lg-3 col-md-5 col-sm-9 sidebar">
                <div class="sb-widget-item">
                    <form class="search-widget">
                        <input type="text" placeholder="بحث">
                        <button><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="sb-widget-item">
                    <h4 class="sb-w-title">تصنيفات</h4>
                    <ul>
                        @foreach ($lessoncategories as $cat)
                        <li><a href="#">{{$cat->lesson_category}}</a></li>
                        @endforeach

                    </ul>
                </div>
                <div class="sb-widget-item">
                    <h4 class="sb-w-title">أرشيف</h4>
                    <ul>
                        @foreach ($lessoncategories as $cat)
                        <li><a href="#">{{date('M d, Y', strtotime($cat->created_at))}}</a></li>

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
