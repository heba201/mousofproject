@extends('front.layout')
@push('style')
<style>
    .mordfatmodad .add h5{
      border:2px solid #fff;
      border-radius: 5px;
      color: #404348;
      background: #fff
    }


.moradfat{
    background:#edf4f6;

}
.moradfat p{
    margin-bottom: 10px;
}
.moradfat p,.moradfat span{
    color:#404348;

}
.moradfat p i{
color: #d82a4e;
font-size:15px;

}
.moradfat span i{
    margin-left: 5px;
color: #d82a4e;
font-size:15px;
}
.sentence{
border:2px solid #fff;
border-radius:5px;
background:#edf4f6;
}
.sentence p{
    color:#404348;
    margin-top:10px;
    margin-bottom: 10px;
}
</style>
@endpush
@section('content')

@include('front.searchbar1');

<section class="contact-page spad pb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="contact-form-warp mordfatmodad">
                    <div class="section-title text-white text-centr add" style="text-align: center">

                        <h5> <i class="fas fa-exclamation-triangle" style="color: #d82a4e"></i>
                       لا يوجد نتائج للبحث عن كلمة <span  style="color: #d82a4e">{{$searchword}} </span>
                    </h5>
                    </div>
                </div>
            </div>
            @include('front.moradfat.sidebar')
        </div>
    </div>
</section>
<!-- Page end -->
@endsection
