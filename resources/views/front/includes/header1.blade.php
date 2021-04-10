
    <style>
        .main-menu ul li{

        }
    .main-menu ul li a{
       color: #474747;
       font-size: 17px;
       margin-left: 7px;
    }

    .inbtn{
        background: #474747;
    }
        </style>
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
                    @if(Auth::check())

                <a href="#" class="site-btn header-btn inbtn">مرحبا {{Auth::user()->name}}</a>
                    <a href="{{route('logout')}}" class="site-btn header-btn">تسجيل خروج</a>
                   @else
					<a href="{{route('userlogin')}}" class="site-btn header-btn">تسجيل دخول</a>
                    <a href="{{route('register')}}" class="site-btn header-btn inbtn">اشتراك</a>
                    @endif
                </div>
			<div class="row">
					<nav class="main-menu">
                        <?php
                $mojjam=App\Models\Mojjam::inRandomOrder()->get()->first();
                        ?>
						<ul>
							<li><a href="{{route('home')}}">الرئيسية</a></li>
                            <li><a href="{{route('getwordmaningmojjam',$mojjam->id)}}">المعاجم</a>
                            </li>
                            <li><a href="#">كلمات القرآن</a></li>
                            <li><a href="{{route('moradfat')}}">مرادفات وأضداد</a></li>
                            <li><a href="{{route('namesmeanings')}}">معاني الأسماء</a></li>
                            <li><a href="{{route('fawaed')}}">فوائد لغوية</a></li>
							<li><a href="{{route('articles')}}">مقالات</a></li>
							<li><a href="{{route('wisdoms')}}">حكم وأمثال</a></li>
                            <li><a href="{{route('sayings')}}">أقوال مأثورة</a></li>
                            <li><a href="{{route('expression',$mojjam->id)}}">مصطلحات</a></li>
                            <li><a href="{{route('composedword',$mojjam->id)}}">كلمات مركبة</a></li>
							<li><a href="#">سؤال وجواب</a></li>
							<li><a href="#">مرئيات وسمعيات</a></li>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</header>
	<!-- Header section end -->

    <!-- Hero section -->
	<section class="hero-section set-bg" data-setbg="{{asset('assets/img/bgnew.jpg')}}">
    </section>
	<!-- Hero section end -->


