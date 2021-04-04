@extends('front.layout')
@section('content')
<!-- search section -->
<section class="search-section" style="margin-top:-150px">
    <div class="container">
        <div class="search-warp">
            <div class="row" style="text-align: center">
                <div class="col-md-10 offset-md-1">
                    <!-- search form -->
                    <form class="course-search-form">
                        <input type="text" class="last-m" placeholder="ابحث عن حكمة">


                        <button class="site-btn">بحث</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- search section end -->

<!-- Page -->
<section class="contact-page spad pb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="contact-form-warp" style="text-align: right">
                    @foreach($wisdoms as $wisdom)
                    <div class="section-title text-white text-right">

                        <h4>{{$wisdom->character->character_name}} <img src="{{asset('assets/'.$wisdom->character->character_photo)}}" alt="alt text" style="float: right" height="75" width="75"  class="rounded-circle"></h4>
                        <p style="padding-top:10px;font-size:20px;margin-right:40px">{{$wisdom->wisdom}}</p>
                        <p style="margin-right: 35px;margin-top:15px">الوسوم :

                        </p>
                        @if(!($loop->last))
                        <hr style="background-color: #fff">
                        @endif
                    </div>
                    @endforeach
                    {{--$wisdoms->links()--}}

                </div>
                <div style="margin-top:10px">
                {{$wisdoms->links("pagination::bootstrap-4")}}
                </div>
            </div>

            <div class="col-lg-4">
                <div class="contact-info-area">
                    <div class="section-title text-left p-0">
                        <h2>Contact Info</h2>
                        <p>Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendi sse cursus faucibus finibus.</p>
                    </div>
                    <div class="phone-number">
                        <span>Direct Line</span>
                        <h2>+53 345 7953 32453</h2>
                    </div>
                    <ul class="contact-list">
                        <li>1481 Creekside Lane <br>Avila Beach, CA 931</li>
                        <li>+53 345 7953 32453</li>
                        <li>yourmail@gmail.com</li>
                    </ul>
                    <div class="social-links">
                        <a href="#"><i class="fa fa-pinterest"></i></a>
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-dribbble"></i></a>
                        <a href="#"><i class="fa fa-behance"></i></a>
                        <a href="#"><i class="fa fa-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page end -->




@endsection
