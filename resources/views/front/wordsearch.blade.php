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
@include('front.searchbar')
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
                            (اسم)
                            @elseif ($word->word_type==1 )
                            (فعل)
                            @elseif ($word->word_type==2 )
                            (مصطلح)
                            @else
                            (كلمة مركبة)
                            @endif
                        </span>
                        في
                                {{$mojjam->mojjam_name}}
                    </h5>
                    </div>
                            <!-- word fields section  -->
                            <div class="section-title text-white text-right moradfat">
                            <p style="text-align:center"><span style="font-size:20px;"> {{$word->word}}</span> : <span style="color:#d82a4e;font-size:20px; " >{{$wordmeaning->word_meaning}}</span></p>

                            <p><i class="fas fa-arrow-alt-circle-left"></i><span style="font-size:20px;margin-left:15px;"> جذر الكلمة</span>    <span style="color:#d82a4e;font-size:20px;margin-right:15px">{{$word->word_gzer}}</span></p>
                            <p><i class="fas fa-arrow-alt-circle-left"></i> <span style="font-size:20px;margin-left:15px;">نوع الجذر </span>    <span style="color:#d82a4e;font-size:20px;margin-right:15px">{{$word->gzer_type}}</span></p>
                            <p><i class="fas fa-arrow-alt-circle-left"></i> <span style="font-size:20px;margin-left:15px;">وزن الجذر </span>    <span style="color:#d82a4e;font-size:20px;margin-right:15px">{{$word->gzer_weight}}</span></p>
                            <p><i class="fas fa-arrow-alt-circle-left"></i> <span style="font-size:20px;margin-left:15px;">المصدر &nbsp; &nbsp;</span><span style="color:#d82a4e;font-size:20px;margin-right:15px">{{$word->word_source}}</span></p>
                            <p style="margin-bottom: 10px"><i class="fas fa-arrow-alt-circle-left"></i><span style="font-size: 20px;margin-left:15px;" > الدلالة&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;</span> <span style="color:#d82a4e;font-size:20px;">{{$word->word_indication}}</span></p>
                            <?php
                            $word_derivatives=explode(",",$word->word_derivatives);
                            $other_word_properties=explode(",",$word->other_word_properties);

                            ?>
                            @if($word->word_derivatives !=null)
                            <span> <i class="fas fa-arrow-alt-circle-down"></i><strong style="font-size:20px">مشتقات الكلمة</strong></span>
                            @foreach ( $word_derivatives as $word_deriv)
                                <p><span style="color:#d82a4e;font-size:20px;">{{$word_deriv}}</span></p>
                            @endforeach

                                @endif
                                @if($word->other_word_properties !=null)
                            <span> <i class="fas fa-arrow-alt-circle-down"></i><strong style="font-size:20px">خصائص الكلمة</strong></span>
                            @foreach ( $other_word_properties as $word_prop)
                            <p><span style="color:#d82a4e;font-size:20px;">{{$word_prop}}</span></p>
                            @endforeach
                            @endif
                        <hr style="background: #d82a4e">
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
  $relatedwords = App\Models\Word::where('id','!=',$wordsid)->where('word', 'LIKE','%'.$text.'%')->selection()->get();
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
