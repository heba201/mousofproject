@extends('front.layout')
@section('content')
<!-- Page  -->
<section class="blog-page spad pb-0">
    <div class="container">
        <div class="row">
            <!-- course section -->
	<section class="course-section spad">
		<div class="container">
		</div>

			<div class="row course-items-area">

                @foreach($lessons as $lesson)
                	<!-- articles -->
				<div class="mix col-lg-3 col-md-4 col-sm-6  articles">
					<div class="course-item">
						<div class="course-thumb set-bg" data-setbg="{{asset('assets/'.$lesson->lesson_photo)}}">

						</div>
						<div class="course-info text-center">
							<div class="course-text">
								<h5>{{$lesson->lesson_title}}</h5>
								<p>{{ Str::limit($lesson->lesson_details, 60)}}</p>

							</div>
							<div class="course-author">
								<div class="ca-pic set-bg" data-setbg="{{asset('assets/'.$article->article_photo)}}"></div>
                                <a href="{{route('article',$article->id)}}" class="site-btn readmore">قراءة المزيد</a>
                            </div>
						</div>
					</div>
				</div>
              @endforeach
				<!-- articles -->
	<!-- course section end -->
            <div class="col-lg-3 col-md-5 col-sm-9 sidebar" style="text-align: right">
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
                        <li><a href="#">{{$cat->created_at}}</a></li>
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
</div>
</section>
<!-- Page end -->
@endsection
