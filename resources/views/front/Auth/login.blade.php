@extends('front.layout')
@push('style')
  <style>
.newform input[type=text],
.newform input[type=email],
.newform input[type=password]
{
	height:57px;
	width:100%;
	padding: 0 20px;
	margin-bottom: 27px;
	float: left;;
	border: none;
	font-size: 14px;
	font-weight: 500;
	background: #edf4f6;
    margin-right: 10px;
}
.contact-form{
    min-height: 100px;
    overflow: hidden;
}
.contact-form .site-btn{
width:70%;
margin-bottom: 15px;
}
.contact-form .reg ,.contact-form .pass{
width:30%;
background: #788;
}
.contact-form .reg{
    margin-left: 10px;
}
@media only screen and (min-width: 683px) and (max-width: 770px) {
    .contact-form .pass,.contact-form .reg{
    width:70%;
    margin-left: 0px;
}

}


@media only screen and (max-width: 479px) {
.contact-form .pass,.contact-form .reg{
    width:70%;
    margin-left: 0px;
}
}
@media only screen and (max-width:679px) {
.contact-form .pass,.contact-form .reg{
    width:70%;
    margin-left: 0px;
}
}
  </style>
@endpush
@section('content')

@include('admin.includes.alerts.success')
@include('admin.includes.alerts.errors')
<!-- Page -->
<section class="contact-page spad pb-0" style="margin-bottom: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-10" style="margin:auto">
                <div class="contact-form-warp">
                    <div class="section-title text-white text-center">

                        <h4>تسجيل الدخول</h4>
                    </div>
                    <form class="contact-form newform" style="text-align:center" method="POST" action="{{route('postLogin')}}">
                        {{ csrf_field() }}
                        <input type="text" placeholder="البريد الالكتروني" name="email">
                        @error("email")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <input type="password" placeholder="كلمة السر" name="password">
                        @error("password")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <button class="site-btn">تسجيل دخول</button>
                        <a href="" class="site-btn reg">اشتراك</a>
                        <a href="" class="site-btn pass">نسيت كلمة السر</a>
                    </form>

                </div>
            </div>

        </div>

    </div>
</section>
<!-- Page end -->






@endsection
