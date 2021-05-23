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
<!-- search section -->
@include('front.searchbar1')
<!-- search section end -->

<section class="contact-page spad pb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="contact-form-warp mordfatmodad">
                    <div class="section-title text-white text-right add" style="text-align: center">

                        <h5>
                             معني كلمة {{$word->word}}

                                <span style="color:#d82a4e;">
                            @if ($word->word_type==0 )
                            (إسم)
                            @elseif ($word->word_type==1 )
                            (فعل)
                            @elseif ($word->word_type==2 )
                            (حرف)
                            @endif
                        </span>
                        في
                                {{$mojjam->mojjam_name}}
                    </h5>
                    </div>
                            <!-- word fields section  -->
                            <div class="section-title text-white text-right moradfat">
                            <p style="text-align:center"><span style="font-size:20px;"> {{$word->word}}</span> : <span style="color:#d82a4e;font-size:20px; " >{{$wordmeaning->word_meaning}}</span></p>

                            <p><i class="fas fa-arrow-alt-circle-left"></i><span style="font-size:20px;margin-left:15px;"> جذر الكلمة</span>    <span style="color:#d82a4e;font-size:20px;margin-right:15px">

                                <?php
                                $word_info=App\Models\Word::where('word_id',$word->id)->selection()->first();
                                $word_gzer_id=$word_info->word_gzer;
                                $gzer_type_id=$word_info->gzer_type;
                                $gzer_weight_id=$word_info->gzer_weight;
                                $weight_indication_id=$word_info->weight_indication;
                                $word_source_id=$word_info->word_source;
                                $word_time_id=$word_info->time;
                                $word_gazer=App\Models\Wordgazer::where('id',$word_gzer_id)->selection()->first();
                                $gzer_type =App\Models\Gazertype::where('id',$gzer_type_id)->selection()->first();
                                $gzer_weight =App\Models\Gazerweight::where('id',$gzer_weight_id)->selection()->first();
                                $weight_indication= App\Models\Weightindication::where('id',$weight_indication_id)->selection()->first();
                                $source=App\Models\Source::where('id',$word_source_id)->selection()->first();
                                $time=App\Models\Time::where('id',$word_time_id)->selection()->first();

                                ?>
                            {{$word_gazer->word_gazer}}
                            </span></p>
                            <p><i class="fas fa-arrow-alt-circle-left"></i> <span style="font-size:20px;margin-left:15px;">نوع الجذر </span>    <span style="color:#d82a4e;font-size:20px;margin-right:15px">
                                {{$gzer_type->gazer_type}}

                            </span></p>
                            <p><i class="fas fa-arrow-alt-circle-left"></i> <span style="font-size:20px;margin-left:15px;">وزن الجذر </span>    <span style="color:#d82a4e;font-size:20px;margin-right:15px">
                                {{$gzer_weight->gazer_weight}}</span></p>
                            <p><i class="fas fa-arrow-alt-circle-left"></i> <span style="font-size:20px;margin-left:15px;"> دلالة الوزن   </span>    <span style="color:#d82a4e;font-size:20px;margin-right:15px">
                                {{$weight_indication->weight_indication}}</span></p>

                            <p><i class="fas fa-arrow-alt-circle-left"></i> <span style="font-size:20px;margin-left:15px;"> الزمن </span>
                                <span style="color:#d82a4e;font-size:20px;margin-right:15px">
                                    {{$time->time}}

                                </span></p>

                            <p><i class="fas fa-arrow-alt-circle-left"></i> <span style="font-size:20px;margin-left:15px;">المصدر &nbsp; &nbsp;</span><span style="color:#d82a4e;font-size:20px;margin-right:15px">

                                {{$source->source}}
                            </span></p>
                            <p style="margin-bottom: 10px"><i class="fas fa-arrow-alt-circle-left"></i><span style="font-size: 20px;margin-left:15px;" > دلالة أصلية علي &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span> <span style="color:#d82a4e;font-size:20px;">
                                <?php
                                $word_info=App\Models\Word::where('word_id',$word->id)->selection()->first();
                                    $word_indication_id=$word_info->word_indication;
                                    $word_indication=App\Models\Wordindication::where('id',$word_indication_id)->selection()->first();
                                    ?>
                                @foreach ($word_indications as $wordindication)
                                @if($word_indication_id==$wordindication->id)
                                {{$wordindication->word_indication}}
                                @endif
                                @endforeach
                            </span></p>
                            <?php
                             $word_info=App\Models\Word::where('word_id',$word->id)->selection()->first();

                            $word_derivatives=explode(",",$word_info->word_derivatives);
                            $other_word_properties=explode(",",$word_info->other_word_properties);

                            ?>
                            @if($word_info->word_derivatives !=null)
                            <span> <i class="fas fa-arrow-alt-circle-down"></i><strong style="font-size:20px">مشتقات الكلمة</strong></span>
                            @foreach ( $word_derivatives as $word_deriv)
                                <p><span style="color:#d82a4e;font-size:20px;">{{$word_deriv}}</span></p>
                            @endforeach

                                @endif
                                @if($word_info->other_word_properties !=null)
                            <span> <i class="fas fa-arrow-alt-circle-down"></i><strong style="font-size:20px">خصائص الكلمة</strong></span>
                            @foreach ( $other_word_properties as $word_prop)
                            <p><span style="color:#d82a4e;font-size:20px;">{{$word_prop}}</span></p>
                            @endforeach
                            @endif

                        @foreach ($similarwords as $similarword)
                        <?php

                        $word_meaning=App\Models\Meaning::where('word_id','=',$similarword->id)->where('mojjam_id','=',$mojjam->id)->selection()->get()->first();
                        ?>
                        <p><span style="font-size:18px;">{{$similarword->word}} : </span><span style="color:#d82a4e;font-size:18px;">&nbsp;{{$word_meaning->word_meaning}}</span>
                        </p>
                        @endforeach
                        </div>

                            <!-- word fields section end  -->

                            <!-- word meaning in other mojjams section  -->
                            @foreach($words_meanings_othermojjams as $word_meaning)
                            <div class="section-title text-white text-right modad" style="background: #edf4f6">
                            <h5 style="border:2px solid #d82a4e">تعريف ومعني <span style="color: #d82a4e">{{$word_meaning->word->word}} </span>
                            في
                                {{$word_meaning->mojjam->mojjam_name}}
                            </h5>
                                <p><span style="font-size: 18px;color:#404348">{{$word_meaning->word->word}} : </span><span style="font-size: 18px;color:#d82a4e">{{$word_meaning->word_meaning}}</span></p>
                                @foreach ($similarwords as $similarword)
                                <?php

                                $word_meaning_other=App\Models\Meaning::with('word','mojjam')->where('word_id','=',$similarword->id)->where('mojjam_id','=',$word_meaning->mojjam_id)->selection()->get()->first();
                                ?>
                                <p><span style="font-size: 18px;color:#404348">{{$word_meaning_other->word->word}} : </span><span style="font-size: 18px;color:#d82a4e">{{$word_meaning_other->word_meaning}}</span>
                                </p>
                                @endforeach

                                </div>
                                @endforeach
                            </div>

                            <!-- word meaning in other mojjams section end  -->
                </div>
                @include('front.moradfat.sidebar')
            </div>
        </div>
    </div>
</section>
<!-- Page end -->

<!-- Page -->
@if($sentences->count()>0)
<section class="contact-page spad pb-0 lastsec">
    <div class="container">
        <div class="row">
            <div class="col-lg-8" >
                <div class="contact-form-warp wordsearchsection">
             <!-- word sentences  section  -->

             <div class="section-title text-white text-right  wordsearch">
             <h5>     جمل سياقية ظهرت فيها كلمة
               <span style="color: #d82a4e"> {{$word->word}} </span></h5>
               <div class="section-title text-white text-right sentence">
             @foreach ($sentences as $sentence)
             <p>{{$sentence->word_sentence}}</p>
             @if  ( !$loop->last)
             <hr style="background:#d82a4e">
             @endif
             @endforeach
         </div>
             </div>
             <!-- word sentences section end  -->

                </div>
            </div>

        </div>

    </div>
</section>
@endif
<!-- Page end -->

<!-- related words -->
<?php
foreach($similarwords as $similarword){
    $wordsid['id']=$similarword->id;
 //echo( $similarword->word);
 //$relatedwords =App\Models\Word::where('word', 'LIKE', '%'.$similarword->word .'%')->where('id','!=',$similarword->id)->selection()->get();
    $wordsearch=$similarword->word;
    $text = substr($wordsearch,0,2);
    //echo $text;
  $relatedwords = App\Models\Wordname::where('id','!=',$wordsid)->where('word', 'LIKE','%'.$text.'%')->selection()->get();
}
    ?>
 @if($similarwords->count()>0)
<section class="contact-page spad pb-0 lastsec">
    <div class="container">
        <div class="row">
            <div class="col-lg-8" >
                <div class="contact-form-warp wordsearchsection">
             <div class="section-title text-white text-right wordsearch">
             <h5>  كلمات ذات  صلة</h5>
        @foreach( $similarwords as $relatedword)
            <a href="{{route('wordmojjam',['id'=>$mojjam->id,'searchword'=>$relatedword->word])}}"><strong><span style="color:#fff;margin-right:10px">{{$relatedword->word}}</strong></span>
        </a>
        @endforeach
         </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
<!-- related words end -->
@endsection
