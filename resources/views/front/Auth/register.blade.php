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
.contact-form .reg{
width:70%;
}

  </style>
@endpush
@section('content')
<!-- Page -->
<section class="contact-page spad pb-0" style="margin-bottom: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-10" style="margin:auto">
                <div class="contact-form-warp">
                    <div class="section-title text-white text-center">

                        <h4>اشتراك</h4>
                    </div>
                    <form class="contact-form newform" style="text-align:center" method="POST" action="{{route('registeruser')}}">
                        {{ csrf_field() }}
                        <input type="text" placeholder="الاسم" name="name">
                        @error("name")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <input type="text" placeholder="البريد الالكتروني" name="email">
                        @error("email")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <input type="password" placeholder="كلمة السر" name="password">
                        @error("password")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <input type="password" placeholder="تأكيد كلمة السر" name="passwordconfirm">
                        @error("passwordconfirm")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <button class="site-btn reg">اشتراك</button>
                    </form>

                </div>
            </div>

        </div>

    </div>
</section>
<!-- Page end -->






@endsection
