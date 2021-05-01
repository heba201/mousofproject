<?php
use App\Models\Meaning;
use App\Models\Word;
use App\Models\Faeda;
use App\Models\Wisdom;

      $wordtoday=Word::with('meanings')->inRandomOrder()->whereIn('word_type',['0','1'])->first();
      $wordname=Wordname::where('id',$wordtoday->word_id)->selection()->first();
      $wordtodaymeaning=Meaning::where('word_id','=',$wordtoday->word_id)->selection()->first();
       //print_r($wordtoday);
       $wordgroups= Wordname::with('meanings')->where('word', 'like', "%".$wordtoday->word. "%")->selection()->limit(3)->get();
       $wordgroupmeaning=Meaning::where('word_id','=',$wordgroups[0]->id)->selection()->get();
       $wisdomtoday = Wisdom::with('character')->inRandomOrder()->first();
       $faedatoday=Faeda::with('fawedsubject')->inRandomOrder()->first();
       ?>

<div class="col-lg-4">
    <div class="contact-info-area" dir="rtl">
        <div class="section-title text-center p-0 wordbox">
            <h3>كلمة اليوم</h3>
            <p dir="rtl">
                {{$wordname->word}} {{$wordtoday->word_type==0 ?'(اسم)' :'(فعل)'}}
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
            <h3>فوائد لغوية</h3>
            <span>{{$faedatoday->fawedsubject->faeda_subject}} </span>
            <?php
            $faedatodaytexts=explode(",",$faedatoday->faeda);
            ?>
            <p>{{$faedatodaytexts[0]}}</p>
        </div>
    </div>
</div>

