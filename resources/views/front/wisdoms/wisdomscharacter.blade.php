@extends('front.layout')
@push('style')
    <style>
.contact-form-warp .chlink a:hover{
text-decoration: underline;
}
.text-white a{
    color: #d82a4e !important;
}
</style>

@endpush
@section('content')
<!-- search section -->
@include('front.wisdoms.searchbar')
<!-- search section end -->

<!-- Page -->
<section class="contact-page spad pb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="contact-form-warp" style="text-align: right">
                    @foreach($wisdoms as $wisdom)
                    <div class="section-title text-white text-right" style="background:#edf4f6;border:1px solid #474747;border-radius:5px;">

                        <a href="{{route('allwisdomcharacter',$wisdom->character->id)}}"><h5 style="color:#474747;padding-top:10px;">{{$wisdom->character->character_name}} <img src="{{asset('assets/'.$wisdom->character->character_photo)}}" alt="alt text" style="float: right;padding-top:10px;" height="75" width="75"  class="rounded-circle"></h5></a>
                        <p style="padding-top:10px;font-size:15px;margin-right:40px;color:#474747">{{$wisdom->wisdom}}</p>
                        <p style="margin-right: 35px;margin-top:15px;color:#474747;margin-bottom:10px;">الوسوم :
                            <?php
                            $wisdomtags=explode(",",$wisdom->wisdom_tag);
                            ?>
                            @foreach ($wisdomtags as $wisdomtag)
                           <a href="{{route('wisdomtag',$wisdomtag)}}"><span style="margin-right:10px;color:#d82a4e">  {{$wisdomtag}} </span></a>
                            @endforeach
                        </p>
                    </div>
                    @endforeach
                </div>
                <div style="margin-top:10px;">
                 {{$wisdoms->links("pagination::bootstrap-4")}}
                </div>
            </div>

            <div class="col-lg-4" style="text-align: right">
                <div class="contact-info-area">

                    <div class="phone-number">
                        <span></span>
                        <h5>حكم وأمثال حسب الموضوع</h5>
                    </div>
                    <ul class="contact-list"  style="text-align:right; list-style:none;">
                        @foreach ($wisdomSayingsubjects as $wisdomsubject)
                        <a href="{{route('wisdomsubject',$wisdomsubject->id)}}"><li value={{$wisdomsubject->id}}>{{$wisdomsubject->subject}}</li></a>                        @endforeach
                    </ul>

                    <div class="phone-number">
                        <span></span>
                        <h5>حكم وأمثال حسب القائل</h5>
                    </div>
                    <ul class="contact-list"  style="text-align:left; list-style:none;">
                        @foreach ($characters as $character)

                        <a href="{{route('wisdomcharacter',$character->id)}}">

                            <li value={{$character->id}}>{{$character->character_name}}
                                <img src="{{asset('assets/'.$character->character_photo)}}" class="rounded-circle" width="50">
                            </li>
                            </a>
                        @endforeach
                    </ul>


                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page end -->
@endsection
