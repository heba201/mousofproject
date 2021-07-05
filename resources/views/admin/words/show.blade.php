@extends('layouts.admin')

@section('content')
<style>
    .switchery{
        background-color: green;
    }
    </style>
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="">الكلمات </a>
                                </li>
                                <li class="breadcrumb-item active">  كلمة
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">  كلمة <a href="#">  {{$word[0]->word->word}} </a> </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form">
                                            @csrf

                                            <!-- tab -->

                                            <ul class="nav nav-tabs">
                                                @isset($word)
                                                    @foreach($word   as $index =>  $wmojjam)
                                                        <li class="nav-item">
                                                            <a class="nav-link @if($index ==  0) active @endif  " id="homeLable-tab"  data-toggle="tab"
                                                               href="#homeLable{{$index}}" aria-controls="homeLable"
                                                                aria-expanded="{{$index ==  0 ? 'true' : 'false'}}">
                                                                {{$wmojjam ->mojjam->mojjam_name}}</a>
                                                        </li>
                                                    @endforeach
                                                @endisset
                                            </ul>

                                            <div class="tab-content px-1 pt-1">

                                                @isset($word)
                                                    @foreach($word    as $index =>  $wmojjam)

                                                    <div role="tabpanel" class="tab-pane  @if($index ==  0) active  @endif  " id="homeLable{{$index}}"
                                                    aria-labelledby="homeLable-tab"
                                                    aria-expanded="{{$index ==  0 ? 'true' : 'false'}}">

                                                    <form class="form"
                                                          action="#"
                                                          method="POST"
                                                          enctype="multipart/form-data">
                                                        @csrf
                                                        <input name="id" value="{{$wmojjam -> id}}" type="hidden">
                                                        <div class="form-body">

                                                            <h4 class="form-section"><i class="ft-home"></i> بيانات الكلمة </h4>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <?php
                                                                         $mojjamarrangetypes=App\Models\MojjamArrangetype::selection()->get();
                                                                         $mojjammethods=App\Models\MojjamMethod::selection()->get();

                                                                    ?>
                                                                    <div class="form-group">
                                                                        <label for="projectinput{{$index}}">  نوع ترتيب المعجم </label>
                                                                        @foreach ($mojjamarrangetypes as $mojjamarrangetype)
                                                                        @endforeach
                                                                        <?php
                                                                        $mojjamarrangetype_id=$wmojjam->mojjam->mojjamarrangetype_id;
                                                                        $mojjamarrangetype=App\Models\MojjamArrangetype::where('id',$mojjamarrangetype_id)->selection()->first();
                                                                        ?>
                                                                        @if( $mojjamarrangetype)
                                                                        <input type="text" value="{{ $mojjamarrangetype->mojjam_arrangetype}}" id="mojjamarrangetype_id"
                                                                        class="form-control" readonly
                                                                        placeholder="  "
                                                                        name="mojjamarrangetype_id">
                                                                        @else
                                                                        <input type="text" value="" id="mojjamarrangetype_id"
                                                                        class="form-control" readonly
                                                                        placeholder="  "
                                                                        name="mojjamarrangetype_id">
                                                                        @endif
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="projectinput{{$index}}">منهج المعجم</label>
                                                                        @foreach ($mojjammethods as $mojjammethod)
                                                                        @endforeach
                                                                        <input type="text" value="{{$wmojjam->mojjam->mojjammethod_id==$mojjammethod->id ? $mojjammethod->mojjam_method : '' }}" id="mojjammethod_id"
                                                                               class="form-control" readonly
                                                                               placeholder="  "
                                                                               name="mojjammethod_id">
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="projectinput{{$index}}">  الكلمة </label>
                                                                        <input type="text" value="{{$wmojjam->word->word}}" id="word"
                                                                               class="form-control" readonly
                                                                               placeholder="  "
                                                                               name="word">
                                                                        @error("word")
                                                                        <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <?php
                                                                        $word_meanings=App\Models\Meaning::where('word_id',$wmojjam->word_id)->where('mojjam_id',$wmojjam->mojjam_id)->Selection()->get();
                                                                    ?>
                                                                    <div class="form-group">
                                                                        <label for="projectinput{{$index}}">   معني الكلمة  </label>
                                                                        @foreach($word_meanings as $word_meaning)
                                                                        <textarea type="text" value="" id="word_meaning[]" style="margin-bottom: 10px;"
                                                                               class="form-control" readonly
                                                                               placeholder="  "
                                                                               name="word_meaning[]">{{$word_meaning->word_meaning}}</textarea>
                                                                               @endforeach
                                                                        @error("word_meaning.*")
                                                                        <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput{{$index}}">نوع الكلمة</label>
                                                                    <?php
                                                                    if($wmojjam->word_type==0){
                                                                        $word_type='اسم';
                                                                    }elseif($wmojjam->word_type==1){
                                                                        $word_type='فعل';
                                                                    }else{
                                                                        $word_type='حرف';
                                                                    }
                                                                    ?>
                                                                    <input type="text" value="{{$word_type}}" id="word_type"
                                                                               class="form-control" readonly
                                                                               placeholder="  "
                                                                               name="word_type">

                                                                    @error('word_type')
                                                                    <span class="text-danger"> {{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput{{$index}}">  جذر الكلمة </label>
                                                                                @foreach ($words_gazer as $word_gazer)
                                                                                @endforeach
                                                                    <?php
                                                                    $wordgazer_id=$wmojjam->word_gzer;
                                                                    $word_gazer=App\Models\Wordgazer::where('id',$wordgazer_id)->selection()->first();
                                                                    ?>
                                                                    @if($word_gazer)
                                                                    <input type="text" value="{{$word_gazer->word_gazer}}" id="word_gazer"
                                                                    class="form-control" readonly
                                                                    placeholder="  "
                                                                    name="word_gazer">
                                                                    @endif
                                                                    @error("word_gzer")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput{{$index}}">  نوع الجذر </label>
                                                                           @foreach ($gazer_types as $gazer_type)
                                                                           @endforeach
                                                               <?php
                                                               $gazertype_id=$wmojjam->gzer_type;
                                                               $gazer_type=App\Models\Gazertype::where('id',$gazertype_id)->selection()->first();
                                                               ?>
                                                               @if($gazer_type)
                                                               <input type="text" value="{{$gazer_type->gazer_type}}" id="gazer_type"
                                                               class="form-control" readonly
                                                               placeholder="  "
                                                               name="gazer_type">
                                                               @endif

                                                                    @error("gzer_type")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput{{$index}}">  وزن الجذر </label>
                                                                           @foreach ($gazer_weights as $gazer_weight)
                                                                           @endforeach
                                                               <?php
                                                               $gazerweight_id=$wmojjam->gzer_weight;
                                                               $gazer_weight=App\Models\Gazerweight::where('id',$gazerweight_id)->selection()->first();
                                                               ?>
                                                               @if($gazer_weight)
                                                               <input type="text" value="{{$gazer_weight->	gazer_weight}}" id="gzer_weight"
                                                               class="form-control" readonly
                                                               placeholder="  "
                                                               name="gzer_weight">
                                                               @endif

                                                                    @error("gzer_weight")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput{{$index}}">  دلالة الوزن </label>

                                                                           @foreach ($weight_indications as $weight_indication)
                                                                           @endforeach
                                                               <?php
                                                               $weightindication_id=$wmojjam->weight_indication;
                                                               $weight_indication=App\Models\Weightindication::where('id',$weightindication_id)->selection()->first();
                                                               ?>
                                                               @if($weight_indication)
                                                               <input type="text" value="{{$weight_indication->	weight_indication}}" id="weight_indication"
                                                               class="form-control" readonly
                                                               placeholder="  "
                                                               name="weight_indication">
                                                               @endif
                                                                    @error("weight_indication")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                                @if($wmojjam->word_type==1)
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput{{$index}}">الزمن</label>
                                                                               @foreach ($times as $time)
                                                                               @endforeach
                                                                   <?php
                                                                   $time_id=$wmojjam->time;
                                                                   $time=App\Models\Time::where('id',$time_id)->selection()->first();
                                                                   ?>
                                                                   @if($time)
                                                                   <input type="text" value="{{$time->	time}}" id="time"
                                                                   class="form-control" readonly
                                                                   placeholder="  "
                                                                   name="time">
                                                                   @endif


                                                                    @error("time")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            @endif


                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput{{$index}}">  المصدر  </label>
                                                                               @foreach ($sources as $source)
                                                                               @endforeach
                                                                   <?php
                                                                   $source_id=$wmojjam->word_source;
                                                                   $source=App\Models\Source::where('id',$source_id)->selection()->first();
                                                                   ?>
                                                                   @if($source)
                                                                   <input type="text" value="{{$source-> source}}" id="word_source"
                                                                   class="form-control" readonly
                                                                   placeholder="  "
                                                                   name="word_source">
                                                                   @endif

                                                                    @error("word_source")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput{{$index}}">   دلالة أصلية علي  </label>
                                                                        @foreach ($word_indications as $word_indication)
                                                                        @endforeach
                                                                        <?php
                                                                        $wordindication_id=$wmojjam->word_indication;
                                                                        $word_indication=App\Models\Wordindication::where('id',$wordindication_id)->selection()->first();
                                                                        ?>
                                                                        @if($word_indication)
                                                                        <input type="text" value="{{$word_indication->word_indication}}" id="word_indication"
                                                                        class="form-control" readonly
                                                                        placeholder="  "
                                                                        name="word_indication">
                                                                        @endif
                                                                    @error("word_indication")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <?php
                                                            $word_count_id=$wmojjam->word_count_id;

                                                            $word_count=App\Models\Wordcount::where('id',$word_count_id)->selection()->first();
                                                            ?>
                                                            @if( $word_count_id)
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput{{$index}}">العدد</label>
                                                                    <input type="text" value="{{$word_count->word_count}}"  id="word_count"
                                                                    class="form-control" readonly
                                                                    placeholder="  "
                                                                    name="word_count">

                                                                </div>
                                                            </div>
                                                            @endif
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput{{$index}}">مشتقات الكلمة</label>
                                                                    <?php
                                                                      $word_derivatives=explode(",",$wmojjam-> word_derivatives);
                                                                    ?>
                                                                    @foreach ($word_derivatives as $word_deriv)
                                                                    <input type="text" value="{{$word_deriv}}"  id="word_deriv"
                                                                    class="form-control" readonly
                                                                    placeholder="  " style="margin-bottom: 10px"
                                                                    name="word_deriv">
                                                                    @endforeach
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput{{$index}}">خصائص أخري للكلمة</label>
                                                                    <?php
                                                                    $other_word_properties=explode(",",$wmojjam->other_word_properties);
                                                                  ?>
                                                                    @foreach ($other_word_properties as $word_pro)
                                                                    <input type="text" value="{{$word_pro}}"  id="word_pro"
                                                                    class="form-control" readonly
                                                                    placeholder="  " style="margin-bottom: 10px"
                                                                    name="word_pro">
                                                                    @endforeach
                                                                </div>
                                                            </div>


                                                            </div>

                                                        </div>


                                                        <div class="form-actions">
                                                            <button type="button" class="btn btn-warning mr-1"
                                                                    onclick="history.back();">
                                                                <i class="ft-x"></i> تراجع
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>

                                                    @endforeach
                                                @endisset

                                            </div>


                                            <!-- tab end -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@endsection
