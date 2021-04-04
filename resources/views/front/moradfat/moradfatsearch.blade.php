@extends('front.layout')
@section('content')
<!-- search section -->
@include('front.moradfat.searchbar')
<!-- search section end -->

<section class="contact-page spad pb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="contact-form-warp mordfatmodad">
                    <div class="section-title text-white text-right add" style="text-align: center">
                        @foreach( $moradfat as   $moradf)

                        <h5 style="background:#788 ;padding:20px;"> مرادفات وأضداد كلمة {{$moradf->word->word}} </h5>
                        @endforeach

                    </div>
                            <!-- moradfat section  -->
                            @foreach( $moradfat as   $moradf)
                            <div class="section-title text-white text-right moradfat">
                            <h5> مرادفات كلمة {{$moradf->word->word}} <span style="color: #d82a4e">({{$moradf->word->word_type==0 ? 'اسم' : 'فعل'}}) </span> : </h5>
                            <p>{{$moradf->moradf}}</p>
                        </div>
                            @endforeach
                            <!-- moradfat section end  -->

                            <!-- modad section  -->
                            @foreach(   $moradfat as   $moradf)
                            <div class="section-title text-white text-right modad">
                            <h5> أضداد كلمة {{$moradf->word->word}} <span style="color: #d82a4e">({{$moradf->word->word_type==0 ? 'اسم' : 'فعل'}}) </span> : </h5>
                            <p>{{$moradf->modad}}</p>
                            </div>
                            @endforeach
                            <!-- modad section end  -->

                              <!-- related words section  -->
                              @if($wordssame->count()>0)

                              <div class="section-title text-white text-right relatedword">
                              <h5> كلمات ذات صلة </h5>
                              @foreach( $wordssame as   $same)
                              <a href="{{route('moradfat.word',$same->word)}}"><span style="margin-left: 10px;"><strong>{{$same->word}}</strong></span></a>
                              @endforeach
                              </div>
                              @endif
                              <!-- related words section end  -->
                               <!-- abyaat section   -->
                               @if($abyaat->count()>0)
                        <div class="section-title text-white text-right abyaat">
                        <h5>   أبيات ظهرت فيها الكلمة {{$moradfat[0]->word->word}} <span style="color: #d82a4e">({{$moradfat[0]->word->word_type==0 ? 'اسم' : 'فعل'}}) </span> : </h5>
                        @foreach ($abyaat as $bayt)
                        <p>
                        {{$bayt->bayt}}
                        </p>
                        <p class="poet">
                            {{$bayt->poet->poet_name}} - {{$bayt->poet->poet_era}}
                        </p>
                        @endforeach

                    </div>
                    @endif
                    <!-- abyaat section end  -->
                </div>
            </div>



@include('front.moradfat.sidebar')
        </div>
    </div>
</section>
<!-- Page end -->

<!-- Page -->
<section class="contact-page spad pb-0 lastsec">
    <div class="container">
        <div class="row">
            <div class="col-lg-8" >
                <div class="contact-form-warp wordsearchsection">
             <!-- word search section  -->

             <div class="section-title text-white text-right wordsearch">
                 <h5>  ابحث عن معني كلمة<span style="color:#d82a4e"> {{$word->word}}</span> </h5>
                    @foreach($mojjams  as $mojjam)
                    <a href="{{route('moradfat.moradfatmojjam',['id'=>$mojjam->id,'searchword'=>$word->word])}}"><p>معني كلمة <span style="color:#37383d">{{$word->word}}</span>
                    في
                    {{$mojjam->mojjam_name}}
                </p> </a>

            @endforeach

         </div>

             <!-- word search section end  -->

                </div>
            </div>

        </div>

    </div>
</section>
<!-- Page end -->












@endsection
