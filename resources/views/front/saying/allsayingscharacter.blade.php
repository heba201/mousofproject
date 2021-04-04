@extends('front.layout')

@section('content')
<!-- search section -->
@include('front.saying.searchbar')
<!-- search section end -->


<!-- Page -->
<section class="contact-page spad pb-0">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-title text-center">
                    <img src="{{asset('assets/'.$sayings[0]->character->character_photo)}}" alt="alt text" height="150" width="150"  class="rounded-circle">
                    <h4>{{$sayings[0]->character->character_name}}
                        </h4>
                        <p>{{$sayings[0]->character->about_character}}</p>
                    </div>
            </div>
            <div class="col-lg-8">
                <div class="contact-form-warp" style="text-align: right">
                    @foreach($sayings as $saying)
                    <div class="section-title text-white text-right">

                        <a href="{{route('allsayingcharacter',$saying->character->id)}}"><h4>{{$saying->character->character_name}} <img src="{{asset('assets/'.$saying->character->character_photo)}}" alt="alt text" style="float: right" height="75" width="75"  class="rounded-circle"></h4></a>
                        <p style="padding-top:10px;font-size:20px;margin-right:40px">{{$saying->saying}}</p>
                        <p style="margin-right: 35px;margin-top:15px">الوسوم :
                            <?php
                            $sayingtags=explode(",",$saying->saying_tag);
                            ?>
                            @foreach ($sayingtags as $sayingtag)
                           <a href="{{route('sayingtag',$sayingtag)}}"><span style="margin-right:10px;">  {{$sayingtag}} </span></a>
                            @endforeach
                        </p>
                        @if(!($loop->last))
                        <hr style="background-color: #fff">
                        @endif
                    </div>
                    @endforeach
                </div>
                <div style="margin-top:10px">
                    {{$sayings->links("pagination::bootstrap-4")}}
                    </div>
            </div>

            <div class="col-lg-4">
                <div class="contact-info-area" dir="rtl">
                    <div class="section-title text-center p-0 wordbox">
                        <h3>كلمة اليوم</h3>
                        <p dir="rtl">
                            {{$wordtoday->word}} {{$wordtoday->word_type==0 ?'(اسم)' :'(فعل)'}}
                        </p>
                        <p>
                            {{--$wordtodaymeaning->word_meaning--}}
                        </p>
                        @foreach ($wordgroupmeaning as $m)
                        <p>
                            {{$m->word_meaning}}
                            </p>
                        @endforeach
                    </div>
                    <div class="phone-number text-center wisdombox">
                        <h3>حكمة اليوم</h3>
                        <p>{{$wisdomtoday->wisdom}}</p>
                        <span>{{$wisdomtoday->character->character_name}} </span>
                    </div>
                    <div class="phone-number text-center fawedbox">
                        <h3>فائدة لغوية</h3>
                        <span>{{$faedatoday->fawedsubject->faeda_subject}} </span>
                        <?php
                        $faedatodaytexts=explode(",",$faedatoday->faeda);
                        ?>
                        <p>{{$faedatodaytexts[0]}}</p>
                    </div>
                </div>
            </div>
        </div>
 <!-- character sec -->
 <div class="col-md-8 chsec">
    <div class="col-md-12 text-right">
        <h5>أقوال حسب القائل</h5>
    </div>
    @foreach($characters as $character)
        <div class="col-md-3 chsccontent">
            <div class="text-right chlink">
                <p><img src="{{asset('assets/'.$character->character_photo)}}" alt="alt text" height="75" width="75"  class="rounded-circle">
                </p>
                <a href="{{route('allsayingcharacter',$character->id)}}"><h6>{{$character->character_name}}</h6></a>
            </div>
        </div>
        @endforeach
      </div>
        <!-- subject sec -->

        <div class="col-md-8 chsec">
            <div class="col-md-12 text-right">
                <h5>أقوال حسب الموضوع</h5>
            </div>
            @foreach($wisdomSayingsubjects as $sayingsubject)
                <div class="col-md-3 chsccontent">
                    <div class="text-right sublink">
                        <a href="{{route('sayingsubject',$sayingsubject->id)}}"><h6>{{$sayingsubject->subject}}</h6></a>
                    </div>
                </div>
                @endforeach
              </div>
    </div>
</section>
<!-- Page end -->
@endsection
