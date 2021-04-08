@extends('front.layout')

@section('content')

@include('front.searchbar');


	<!-- course section -->
	<section class="course-section spad" style="margin-bottom:35px;">
		<div class="container">
		</div>
		<div class="course-warp">
			<ul class="course-filter controls">
				<li class="control active" data-filter="all">الكل</li>
				<li class="control" data-filter=".sayings"> أقوال مأثورة</li>
				<li class="control" data-filter=".sahaba">الصحابة والتابعين</li>
				<li class="control" data-filter=".fawed">فوائد لغوية </li>
				<li class="control" data-filter=".games">ألعاب لغوية</li>
                <li class="control" data-filter=".articles">مقالات</li>
			</ul>
			<div class="row course-items-area">
                @foreach($characters as $character)
                @if($character->character_type==0)
                	<!-- character -->
				<div class="mix col-lg-3 col-md-4 col-sm-6 sahaba">
					<div class="course-item">
						<div class="course-thumb set-bg" data-setbg="{{asset('assets/img/courses/portfolio-1.jpg')}}">

						</div>
						<div class="course-info text-center">
							<div class="course-text">
								<h5>{{$character->character_name}}</h5>
								<p>{{ Str::limit($character->about_character,100)}}</p>

							</div>
							<div class="course-author">
								<div class="ca-pic set-bg" data-setbg="{{asset('assets/img/authors/portfolio-1.jpg')}}"></div>
                                <a href="#" class="site-btn">قراءة المزيد</a>
                            </div>
						</div>
					</div>
				</div>
                @endif
                @endforeach
				<!-- character -->
                @foreach($articles as $article)
                	<!-- articles -->
				<div class="mix col-lg-3 col-md-4 col-sm-6 articles">
					<div class="course-item">
						<div class="course-thumb set-bg" data-setbg="{{asset('assets/'.$article->article_photo)}}">

						</div>
						<div class="course-info text-center">
							<div class="course-text">
								<h5>{{$article->article_title}}</h5>
								<p>{{ Str::limit($article->article_details, 60)}}</p>

							</div>
							<div class="course-author">
								<div class="ca-pic set-bg" data-setbg="{{asset('assets/images/articles/'.$article->article_photo)}}"></div>
                                <a href="#" class="site-btn">قراءة المزيد</a>
                            </div>
						</div>
					</div>
				</div>
              @endforeach
              <!-- sayings -->
              @foreach($sayings as $saying)
				<div class="mix col-lg-3 col-md-4 col-sm-6 sayings">
					<div class="course-item">
						<div class="course-thumb set-bg" data-setbg="{{asset('assets/img/courses/portfolio-1.jpg')}}">

						</div>
						<div class="course-info text-center">
							<div class="course-text">
								<h5>{{Str::limit($saying->saying,30)}}</h5>
							</div>
							<div class="course-author">
								<div class="ca-pic set-bg" data-setbg="{{asset('assets/img/authors/portfolio-1.jpg')}}"></div>
								<p>القائل <span>{{$saying->character->character_name}}</span></p>
                                <a href="#" class="site-btn">قراءة المزيد</a>
                            </div>
						</div>
					</div>
				</div>
                @endforeach
                 <!-- sayings -->
                  <!-- fawaed -->
              @foreach($fawaed  as $faeda)
              <div class="mix col-lg-3 col-md-4 col-sm-6 fawed">
                  <div class="course-item">
                      <div class="course-thumb set-bg" data-setbg="{{asset('assets/img/courses/portfolio-1.jpg')}}">

                      </div>
                      <div class="course-info text-center">
                          <div class="course-text">
                              <h5>{{$faeda->fawedsubject->faeda_subject}}</h5>
                              <p>{{Str::limit($faeda->faeda,30)}}</p>
                          </div>
                          <div class="course-author">
                              <div class="ca-pic set-bg" data-setbg="{{asset('assets/img/authors/portfolio-1.jpg')}}"></div>
                              <p><span>{{$faeda->fawedsubject->faeda_subject}}</span></p>
                              <a href="#" class="site-btn">قراءة المزيد</a>
                          </div>
                      </div>
                  </div>
              </div>
              @endforeach
               <!-- fawaed -->
			</div>
		</div>
	</section>
	<!-- course section end -->

	<!-- wisdom | word section -->
	<section class="signup-section spad" dir="ltr">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6">
					<div class="signup-warp">
						<div class="section-title text-white text-center">
							<h2>حكمة اليوم</h2>
							<p>
                            {{$wisdomtoday->wisdom}}
                            </p>
                            <p>
                            @if( $wisdomtoday->wisdom_type==0)
                            حكمة
                              @else
                                 مثل
                              @endif
                            </p>
						</div>
					</div>
				</div>
                <div class="col-lg-6">
					<div class="signup-warp" style="border-left: 2px solid #fff">
						<div class="section-title text-white text-center">
							<h2>كلمة اليوم</h2>
                            <p> {{$wordtoday->word}}
                                @if($wordtoday->word_type==0)
                                 (اسم)
                                @else
                                 (فعل)
                                @endif
                            </p>
                            @foreach($meanings as $meaning)
                            <p>
                         {{$meaning->word_meaning}}
                            </p>
                            @endforeach
                            @foreach ($wordsgroup as $wordg)
                            <p> {{$wordg->word}}</p>
                            @endforeach
                        	</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- signup section end -->

	<!-- lessons section -->
	<section class="categories-section spad">
		<div class="container">
			<div class="section-title">
				<h2>دروس دينية</h2>
			</div>
			<div class="row" style="text-align: center">
				<!-- lesson -->
                @foreach ($lessons as $lesson)
				<div class="col-lg-4 col-md-6">
					<div class="categorie-item">
						<div class="ci-thumb set-bg" data-setbg="{{asset('assets/'.$lesson->lesson_photo)}}"></div>
						<div class="ci-text">
                            <h5>{{$lesson->lesson_title}}</h5>
							<p>{{ Str::limit($lesson->lesson_details,70)}}</p>
                            <a href="{{route('lesson',$lesson->id)}}" class="site-btn readmore">قراءة المزيد</a>
						</div>
					</div>
				</div>
                @endforeach
				<!-- lesson -->

			</div>
		</div>
	</section>
	<!-- lessons section end -->

<!-- categories section -->
<section class="categories-section spad">
    <div class="container">
        <div class="section-title">
            <h2>سمعيات ومرئيات</h2>
        </div>
        <div class="row" style="text-align: center">
            <!-- categorie -->
            <div class="col-lg-4 col-md-6">
                <div class="categorie-item">
                    <div class="ci-thumb set-bg" data-setbg="{{asset('assets/img/categories/1.jpg')}}"></div>
                    <div class="ci-text">
                        <h5>عنوان الفيديو</h5>
                        <p>تفاصيل الفيديو ...</p>
                    </div>
                </div>
            </div>
            <!-- categorie -->
            <div class="col-lg-4 col-md-6">
                <div class="categorie-item">
                    <div class="ci-thumb set-bg" data-setbg="{{asset('assets/img/categories/1.jpg')}}"></div>
                    <div class="ci-text">
                        <h5>عنوان الفيديو</h5>
                        <p>تفاصيل الفيديو ...</p>
                    </div>
                </div>
            </div>
            <!-- categorie -->
            <div class="col-lg-4 col-md-6">
                <div class="categorie-item">
                    <div class="ci-thumb set-bg" data-setbg="{{asset('assets/img/categories/1.jpg')}}"></div>
                    <div class="ci-text">
                        <h5>عنوان الفيديو</h5>
                        <p>تفاصيل الفيديو ...</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- categories section end -->
@endsection
