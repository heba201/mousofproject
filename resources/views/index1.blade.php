<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
	<title>موصوف</title>
	<meta charset="UTF-8">
	<meta name="description" content="WebUni Education Template">
	<meta name="keywords" content="webuni, education, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->
	<link href="img/favicon.ico" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i,800,800i" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets/css/font-awesome.min.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets/css/owl.carousel.css')}}"/>
	<link rel="stylesheet" href="{{asset('assets/css/style.css')}}"/>



	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
	<!-- Page Preloder -->
	<div id="preloder">
		<div class="loader"></div>
	</div>

	<!-- Header section -->
	<header class="header-section">
		<div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-2">
					<div class="site-logo">
						<img src="{{asset('assets/img/log.png')}}" alt="" style="margin-top: -35px">
					</div>
					<div class="nav-switch">
						<i class="fa fa-bars"></i>
					</div>
				</div>
                <div class="col-lg-10 col-md-10">
					<a href="" class="site-btn header-btn">تسجيل دخول</a>
                    <a href="" class="site-btn header-btn inbtn">دخول الأعضاء</a>
            </div>
			<div class="row">
					<nav class="main-menu">
						<ul>
							<li><a href="index.html">الرئيسية</a></li>
                            <li><a href="index.html">المعاجم</a></li>
                            <li><a href="courses.html">كلمات القراّن</a></li>
                            <li><a href="courses.html">مرادفات وأضداد</a></li>
                            <li><a href="courses.html">معاني الأسماء</a></li>
                            <li><a href="courses.html">فوائد لغوية</a></li>
							<li><a href="#">مقالات</a></li>
							<li><a href="courses.html">حكم وأمثال</a></li>
                            <li><a href="courses.html">أقوال مأثورة</a></li>
                            <li><a href="courses.html">مصطلحات</a></li>
                            <li><a href="courses.html">كلمات مركبة</a></li>
							<li><a href="blog.html">سؤال وجواب</a></li>
							<li><a href="contact.html">مرئيات وسمعيات</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</header>
	<!-- Header section end -->


	<!-- Hero section -->
	<section class="hero-section set-bg" data-setbg="{{asset('assets/img/bg.jpg')}}">
    </section>
	<!-- Hero section end -->

        <!-- search section -->
        <section class="search-section" style="margin-top:-150px">
            <div class="container">
                <div class="search-warp">
                    <div class="row" style="text-align: center">
                        <div class="col-md-10 offset-md-1">
                            <!-- search form -->
                            <form class="course-search-form">
                                <input type="text" class="last-m" placeholder="ابحث عن معاني كلمة في معاجم اللغة العربية">
                                <select>
                                    <option>لسان العرب</option>
                                    <option>الصحاح</option>
                                    <option>المعجم الوجيز</option>
                                </select>

                                <button class="site-btn">بحث</button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- search section end -->


	<!-- course section -->
	<section class="course-section spad">
		<div class="container">
		</div>
		<div class="course-warp">
			<ul class="course-filter controls">
				<li class="control active" data-filter="all">الكل</li>
				<li class="control" data-filter=".finance">حكم وأمثال</li>
				<li class="control" data-filter=".design">الصحابة والتابعين</li>
				<li class="control" data-filter=".web">فوائد لغوية </li>
				<li class="control" data-filter=".photo">ألعاب لغوية</li>
                <li class="control" data-filter=".articles">مقالات</li>
			</ul>
			<div class="row course-items-area">
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
				<!-- course -->
				<div class="mix col-lg-3 col-md-4 col-sm-6 articles">
					<div class="course-item">
						<div class="course-thumb set-bg" data-setbg="{{asset('assets/img/courses/portfolio-1.jpg')}}">

						</div>
						<div class="course-info text-center">
							<div class="course-text">
								<h5>العنوان</h5>
								<p>التفاصيل ...</p>

							</div>
							<div class="course-author">
								<div class="ca-pic set-bg" data-setbg="{{asset('assets/img/authors/portfolio-1.jpg')}}"></div>
                                <p>الكاتب <span>الاسم</span></p>
							</div>
						</div>
					</div>
				</div>
				<!-- course -->
				<div class="mix col-lg-3 col-md-4 col-sm-6 web">
					<div class="course-item">
						<div class="course-thumb set-bg" data-setbg="{{asset('assets/img/courses/portfolio-1.jpg')}}">

						</div>
						<div class="course-info text-center">
							<div class="course-text">
								<h5>العنوان</h5>
								<p>التفاصيل ...</p>

							</div>
							<div class="course-author">
								<div class="ca-pic set-bg" data-setbg="{{asset('assets/img/authors/portfolio-1.jpg')}}"></div>
								<p>الكاتب <span>الاسم</span></p>
							</div>
						</div>
					</div>
				</div>
				<!-- course -->
				<div class="mix col-lg-3 col-md-4 col-sm-6 photo">
					<div class="course-item">
						<div class="course-thumb set-bg" data-setbg="{{asset('assets/img/courses/portfolio-1.jpg')}}">

						</div>
						<div class="course-info text-center">
							<div class="course-text">
								<h5>العنوان</h5>
								<p>التفاصيل ...</p>

							</div>
							<div class="course-author">
								<div class="ca-pic set-bg" data-setbg="{{asset('assets/img/courses/portfolio-1.jpg')}}"></div>
								<p>الكاتب <span>الاسم</span></p>
							</div>
						</div>
					</div>
				</div>
				<!-- course -->
				<div class="mix col-lg-3 col-md-4 col-sm-6 finance">
					<div class="course-item">
						<div class="course-thumb set-bg" data-setbg="{{asset('assets/img/courses/portfolio-1.jpg')}}">

						</div>
						<div class="course-info text-center">
							<div class="course-text">
								<h5>العنوان</h5>
								<p>التفاصيل ...</p>

							</div>
							<div class="course-author">
								<div class="ca-pic set-bg" data-setbg="{{asset('assets/img/authors/portfolio-1.jpg')}}"></div>
								<p>الكاتب <span>الاسم</span></p>
							</div>
						</div>
					</div>
				</div>
				<!-- course -->
				<div class="mix col-lg-3 col-md-4 col-sm-6 design">
					<div class="course-item">
						<div class="course-thumb set-bg" data-setbg="{{asset('assets/img/courses/portfolio-1.jpg')}}">

						</div>
						<div class="course-info text-center">
							<div class="course-text">
								<h5>العنوان</h5>
								<p>التفاصيل ...</p>
							</div>
							<div class="course-author">
								<div class="ca-pic set-bg" data-setbg="{{asset('assets/img/authors/portfolio-1.jpg')}}"></div>
								<p>الكاتب <span>الاسم</span></p>
							</div>
						</div>
					</div>
				</div>
				<!-- course -->
				<div class="mix col-lg-3 col-md-4 col-sm-6 web">
					<div class="course-item">
						<div class="course-thumb set-bg" data-setbg="{{asset('assets/img/courses/portfolio-1.jpg')}}">

						</div>
						<div class="course-info text-center">
							<div class="course-text">
								<h5>العنوان</h5>
								<p>التفاصيل ...</p>
							</div>
							<div class="course-author">
								<div class="ca-pic set-bg" data-setbg="img/authors/7.jpg"></div>
								<p>الكاتب <span>الاسم</span></p>
							</div>
						</div>
					</div>
				</div>
				<!-- course -->
				<div class="mix col-lg-3 col-md-4 col-sm-6 photo">
					<div class="course-item">
						<div class="course-thumb set-bg" data-setbg="{{asset('assets/img/courses/portfolio-1.jpg')}}">

						</div>
						<div class="course-info text-center">
							<div class="course-text">
								<h5>العنوان</h5>
								<p>التفاصيل ...</p>
							</div>
							<div class="course-author">
								<div class="ca-pic set-bg" data-setbg="{{asset('assets/img/authors/portfolio-1.jpg')}}"></div>
								<p>الكاتب <span>الاسم</span></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- course section end -->

	<!-- signup section -->
	<section class="signup-section spad" dir="ltr">
		<div class="container-fluid">
			<div class="row">
				<div class="col-lg-6">
					<div class="signup-warp">
						<div class="section-title text-white text-center">
							<h2>حكمة اليوم</h2>
							<p>عِلْمُ الرجل ولده المخَلَّدُ</p>
                            <p>قول مشهور</p>
						</div>
					</div>
				</div>
                <div class="col-lg-6">
					<div class="signup-warp" style="border-left: 2px solid #fff">
						<div class="section-title text-white text-center">
							<h2>كلمة اليوم</h2>
                            <p>كسف ( فعل)</p>
                               <p>كسف الثَّوب: قطعه</p>
                               <p>كسف الله الشمس أو القمر: حجبهما</p>
                               <p>كسف : خَفَضَ بَصَرَهُ</p>
                        	</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- signup section end -->

	<!-- categories section -->
	<section class="categories-section spad">
		<div class="container">
			<div class="section-title">
				<h2>دروس دينية</h2>
			</div>
			<div class="row" style="text-align: center">
				<!-- categorie -->
				<div class="col-lg-4 col-md-6">
					<div class="categorie-item">
						<div class="ci-thumb set-bg" data-setbg="{{asset('assets/img/categories/6.jpg')}}"></div>
						<div class="ci-text">
							<h5>عنوان الدرس</h5>
							<p>تفاصيل الدرس ....</p>
                            <a href="" class="site-btn">قراءة المزيد</a>
						</div>
					</div>
				</div>
				<!-- categorie -->
				<div class="col-lg-4 col-md-6">
					<div class="categorie-item">
						<div class="ci-thumb set-bg" data-setbg="{{asset('assets/img/categories/6.jpg')}}"></div>
						<div class="ci-text">
                            <h5>عنوان الدرس</h5>
							<p>تفاصيل الدرس ....</p>
                            <a href="" class="site-btn">قراءة المزيد</a>
						</div>
					</div>
				</div>
				<!-- categorie -->
				<div class="col-lg-4 col-md-6">
					<div class="categorie-item">
						<div class="ci-thumb set-bg" data-setbg="{{asset('assets/img/categories/6.jpg')}}"></div>
						<div class="ci-text">
                            <h5>عنوان الدرس</h5>
							<p>تفاصيل الدرس ....</p>
                            <a href="" class="site-btn">قراءة المزيد</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- categories section end -->

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
	<!-- footer section -->
	<footer class="footer-section spad pb-0" >
		<div class="footer-top" dir="rtl">
			<div class="footer-warp">
				<div class="row">
                    <div class="widget-item">
						<h4>النشرة البريدية</h4>
						<form class="footer-newslatter">
							<input type="email" placeholder="البريد الالكتروني">
							<button class="site-btn">اشترك</button>

						</form>
					</div>
					<div class="widget-item">
						<h4>المعاجم العربية</h4>
						<ul>
							<li><a href="">لسان العرب</a></li>
							<li><a href="">أساس البلاغة</a></li>
							<li><a href="">الصحاح</a></li>
							<li><a href="">المصباح المنير</a></li>
							<li><a href="">القاموس المحيط</a></li>
						</ul>
					</div>
					<div class="widget-item">
						<h4>روابط تهمك </h4>
						<ul>
							<li><a href="">معاني الكلمات</a></li>
							<li><a href="">أقوال مأثورة</a></li>
							<li><a href="">قصص القران</a></li>
							<li><a href=""></a>كلمات القران</li>
							<li><a href="">الصحابة والتابعين</a></li>
						</ul>
					</div>
					<div class="widget-item">
						<h4></h4>
						<ul>
                            <li><a href="">مقالات</a></li>
							<li><a href="">سؤال وجواب</a></li>
							<li><a href="">العاب لغوية</a></li>
							<li><a href="">فوائد لغوية</a></li>
							<li><a href="">مصطلحات</a></li>
						</ul>
					</div>

                    <div class="widget-item" dir="rtl">
						<h4>معلومات الاتصال</h4>
						<ul class="contact-list" dir="rtl">
							<li dir="rtl">المدينة الشارع والمنطقة</li>
							<li dir="rtl">+53 345 7953 32453</li>
							<li dir="rtl">yourmail@gmail.com</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="footer-warp">
				<ul class="footer-menu">
					<li><a href="#">الشروط والأحكام</a></li>
					<li><a href="#">اشتراك</a></li>
					<li><a href="#">سياسة الخصوصية</a></li>
				</ul>
				<div class="copyright"><a target="_blank" href="#">EASY SOFTWARE SOLUTIONS</a></div>
			</div>
		</div>
	</footer>
	<!-- footer section end -->


	<!--====== Javascripts & Jquery ======-->
	<script src="{{asset('assets/js/jquery-3.2.1.min.js')}}"></script>
	<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('assets/js/mixitup.min.js')}}"></script>
	<script src="{{asset('assets/js/circle-progress.min.js')}}"></script>
	<script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('assets/js/main.js')}}"></script>
    <link href="http://vjs.zencdn.net/4.12/video-js.css" rel="stylesheet">
</body>
</html>
