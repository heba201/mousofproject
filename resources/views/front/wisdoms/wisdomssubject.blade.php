@extends('front.layout')
@section('content')

<!-- search section -->
@include('front.wisdoms.searchbar')
<!-- search section end -->


<!-- Page -->
<section class="contact-page spad pb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="contact-form-warp">
	<!-- wisdom -->
    @foreach($wisdoms as $wisdom)
    <div class="col-lg-12 col-md-6">
        <div class="categorie-item con">
            <div class="ci-thumb set-bg" data-setbg="{{asset('assets/'.$wisdom->wisdom_photo)}}"></div>
            <div class="ci-text text-center">
                <h5>عن {{$wisdom->wisdomsubject->subject}}</h5>
                <p>{{$wisdom->wisdom}}</p>

            </div>
        </div>
    </div>
    @endforeach
    <!-- wisdom -->

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
                        <a href="{{route('wisdomsubject',$wisdomsubject->id)}}"><li value={{$wisdomsubject->id}}>{{$wisdomsubject->subject}}</li></a>
                        @endforeach
                    </ul>
                    <div class="phone-number">
                        <span></span>
                        <h5>حكم وأمثال حسب القائل</h5>
                    </div>
                    <ul class="contact-list"  style="text-align:right; list-style:none;">
                        @foreach ($characters as $character)
                        <a href="{{route('wisdomcharacter',$character->id)}}"><li value={{$character->id}}>{{$character->character_name}}
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
