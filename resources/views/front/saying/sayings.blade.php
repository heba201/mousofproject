@extends('front.layout')

@section('content')

<!-- search section -->
@include('front.saying.searchbar')
<!-- search section end -->


<!-- Page -->
<section class="contact-page spad pb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="contact-form-warp">

                <!-- saying -->
                @if($sayings->count()>0)
                @foreach($sayings as $saying)
                <div class="col-lg-12 col-md-6">
                    <div class="categorie-item con">
                        <div class="ci-thumb set-bg" data-setbg="{{asset('assets/'.$saying->saying_photo)}}"></div>
                        <div class="ci-text text-center">
                            <h5>عن {{$saying->saysubject->subject}}</h5>
                            <p>{{$saying->saying}}</p>
                            <p><span>{{$saying->character->character_name}}</span></p>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
                <!-- saying -->
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
