@extends('layouts.admin')

@section('content')

<script>
  function show_select(){
 var main_select = document.getElementById("word_type");
  var selecttime = document.getElementById("time");
  var desired_box = main_select.options[main_select.selectedIndex].value;
  if(desired_box == 1) {
    selecttime.style.display = '';
  }else{
    selecttime.style.display = 'none';
  }
  }
    </script>
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
                                <li class="breadcrumb-item active"> عرض كلمة حسب معجم
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
                                    <h4 class="card-title" id="basic-layout-form"> عرض كلمة حسب معجم  -<a href="#" > {{$mojjam->mojjam_name}} </a></h4>
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
                                        <form class="form" action="{{route('admin.words.update',['id'=>$word->word_id,'mojjam_id' => $mojjam->id])}}"
                                              method="POST">
                                              {{ csrf_field() }}
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات الكلمة </h4>
                                                        <div class="row">

                                                                <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> المعجم</label>
                                                                           <select name="mojjam_id" class="select2 form-control" id="selectId0" disabled>
                                                                            <option value="{{$mojjam->id}}">{{$mojjam->mojjam_name}}</option>
                                                                        </select>
                                                                    @error("mojjam_id")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">  الكلمة </label>
                                                                    <input type="text" value="{{$word->word->word}}" id="word"
                                                                           class="form-control"
                                                                           placeholder="  " readonly
                                                                           name="word">
                                                                    @error("word")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput2">نوع الكلمة</label>
                                                                    <select name="word_type" class="select2 form-control" id="word_type" onchange="show_select()" disabled>
                                                                        <optgroup label=" نوع الكلمة ">

                                                                                    <option value="0" {{$word->word_type==0 ? 'selected' : ' '}}>إسم</option>
                                                                                    <option value="1" {{$word->word_type==1 ? 'selected' : ' '}}>فعل</option>
                                                                                    <option value="2" {{$word->word_type==2 ? 'selected' : ' '}}>حرف</option>

                                                                        </optgroup>
                                                                    </select>
                                                                    @error('word_type')
                                                                    <span class="text-danger"> {{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">  جذر الكلمة </label>
                                                                    <select name="word_gzer" class="select2 form-control" id="selectId" disabled>
                                                                        <optgroup label=" جذر الكلمة ">
                                                                                @foreach ($words_gazer as $word_gazer)
                                                                                <option value="{{$word_gazer->id}}" {{$word->word_gzer ==$word_gazer->id? 'selected' : ' '}}>{{$word_gazer->word_gazer}}</option>
                                                                                @endforeach
                                                                                </optgroup>
                                                                    </select>
                                                                    @error("word_gzer")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">  نوع الجذر </label>
                                                                    <select name="gazer_type" class="select2 form-control" id="gazer_type" disabled>
                                                                        <optgroup label="نوع الجذر">
                                                                                @foreach ($gazer_types as $gazer_type)
                                                                                <option value="{{$gazer_type->id}}" {{$word->gzer_type ==$gazer_type->id? 'selected' : ' '}}>{{$gazer_type->	gazer_type}}</option>
                                                                                @endforeach
                                                                                </optgroup>
                                                                    </select>
                                                                    @error("gazer_type")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">  وزن الجذر </label>
                                                                    <select name="gzer_weight" class="select2 form-control" id="gzer_weight" disabled>
                                                                        <optgroup label="وزن الجذر">
                                                                                @foreach ($gazer_weights as $gazer_weight)
                                                                                <option value="{{$gazer_weight->id}}" {{$word->gzer_weight ==$gazer_weight->id? 'selected' : ' '}}>{{$gazer_weight->gazer_weight}}</option>
                                                                                @endforeach
                                                                                </optgroup>
                                                                    </select>
                                                                    @error("gzer_weight")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">  دلالة الوزن </label>
                                                                           <select name="weight_indication" class="select2 form-control" id="weight_indication" disabled>
                                                                            <optgroup label="دلالة الوزن ">
                                                                                    @foreach ($weight_indications as $weight_indication)
                                                                                    <option value="{{$weight_indication->id}}" {{$word->weight_indication ==$weight_indication->id? 'selected' : ' '}}>{{$weight_indication-> weight_indication}}</option>
                                                                                    @endforeach
                                                                                    </optgroup>
                                                                        </select>
                                                                    @error("weight_indication")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6" id="time" style="display: none">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">الزمن</label>
                                                                    <select name="time" class="select2 form-control" disabled>
                                                                        <optgroup label="الزمن">
                                                                                @foreach ($times as $time)
                                                                                <option value="{{$time->id}}" {{$word->time==$time->id? 'selected' : ' '}}>{{$time-> time}}</option>
                                                                                @endforeach
                                                                                </optgroup>
                                                                    </select>
                                                                    @error("time")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">  المصدر  </label>
                                                                           <select name="word_source" class="select2 form-control" id="selectId" disabled>
                                                                            <optgroup label="المصدر">
                                                                                @foreach ($sources as $source)
                                                                                <option value="{{$source->id}}" {{$word->word_source==$source->id ? 'selected' : ' '}}>{{$source-> source}}</option>
                                                                                @endforeach
                                                                            </optgroup>
                                                                        </select>
                                                                    @error("word_source")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">   دلالة أصلية علي  </label>
                                                                           <select name="word_indication" class="select2 form-control" id="selectId" disabled>
                                                                            <optgroup label="الدلالة الأصلية">
                                                                            @foreach ($word_indications as $word_indication)
                                                                            <option value="{{$word_indication->id}}" {{$word->word_indication==$word_indication->id ? 'selected' : ' '}}>{{$word_indication->word_indication}}</option>
                                                                            @endforeach
                                                                            </optgroup>
                                                                        </select>
                                                                    @error("word_indication")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>


                                                            <?php
                                                            $word_meanings=App\Models\Meaning::where('word_id',$word->word_id)->where('mojjam_id',$word->mojjam_id)->Selection()->get();
                                                              ?>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput">  معني الكلمة في {{$mojjam->mojjam_name}}  </label>
                                                                    @if($word_meanings)
                                                                    @foreach($word_meanings as $word_meaning)
                                                                    <textarea  id="word_meaning" disabled
                                                                           class="form-control" style="margin-bottom: 10px;"
                                                                           placeholder="  ">{{$word_meaning->word_meaning}}</textarea>
                                                                           @endforeach
                                                                           @endif

                                                                    @error("word_meaning")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
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












                                                            <!-- tab of other properities , derivatives  , moradfaat ,modad -->

                                                                    <!-- tab -->

                                                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                                        <li class="nav-item">
                                                                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"> مشتقات الكلمة</a>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false"> خصائص أخري للكبمة</a>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                          <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">مرادفات الكلمة</a>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#modad" role="tab" aria-controls="modad" aria-selected="false">أضداد الكلمة</a>
                                                                          </li>
                                                                      </ul>
                                                                      <div class="tab-content" id="myTabContent">
                                                                          <!-- word deriv && its meanings , word count -->
                                                                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                                            <br>
                                                                            <form class="form" action="{{route('admin.words.updatederivatives',['id'=>$word->word_id,'mojjam_id' => $mojjam->id])}}" method="POST" enctype="multipart/form-data">
                                                                          @csrf
                                                                          <input name="word_id" value="{{$word ->word_id}}" type="hidden">
                                                                          <input name="mojjam_id" value="{{$mojjam -> id}}" type="hidden">
                                                                          <div class="form-body">
                                                                            <div class="row">

                                                                                @if($word->word_type==0)
                                                                                <div class="col-md-12">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="projectinput1">     العدد  </label>
                                                                                               <select name="word_count" class="select2 form-control" id="word_count" disabled>
                                                                                                <optgroup label="العدد">
                                                                                                @foreach ($word_count as $count)
                                                                                                <option value="{{$count->id}}" {{$count->id==$word->word_count_id ? 'selected': ''}}>{{$count->word_count}}</option>
                                                                                                @endforeach
                                                                                                </optgroup>
                                                                                            </select>
                                                                                        @error("word_count")
                                                                                        <span class="text-danger">{{$message}}</span>
                                                                                        @enderror
                                                                                    </div>
                                                                                </div>
                                                                                </div>
                                                                                @endif
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label for="projectinput">مشتقة الكلمة </label>
                                                                                        <?php
                                                                                        $word_derivatives=explode(",",$word-> word_derivatives);
                                                                                      ?>
                                                                                      @foreach ($word_derivatives as $word_deriv)
                                                                                      <input type="text" value="{{$word_deriv}}"  id="word_derivatives[]"
                                                                                      class="form-control" readonly
                                                                                      placeholder="  " style="margin-bottom: 10px"
                                                                                      name="word_derivatives[]">
                                                                                      @error("word_derivatives.*")
                                                                                      <span class="text-danger">{{$message}}</span>
                                                                                      @enderror
                                                                                      @endforeach

                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-md-6">
                                                                                <div class="form-group">
                                                                                    <label for="projectinput"> معني مشتقة الكلمة  </label>
                                                                                    <?php
                                                                                    $word_derivatives_meaning=explode(",",$word-> derivatives_meaning);
                                                                                  ?>
                                                                                  @foreach ($word_derivatives_meaning as $word_deriv_meaning)
                                                                                  <input type="text" value="{{$word_deriv_meaning}}"  id="derivatives_meaning[]"
                                                                                  class="form-control" readonly
                                                                                  placeholder="  " style="margin-bottom: 10px"
                                                                                  name="derivatives_meaning[]">
                                                                                  @error("derivatives_meaning.*")
                                                                                  <span class="text-danger">{{$message}}</span>
                                                                                  @enderror
                                                                                  @endforeach
                                                                                </div>
                                                                            </div>
                                                                            </div>
                                                                          </div>
                                                                           <!-- here -->
                                                                           <div class="form-actions">

                                                                            <button type="button" class="btn btn-warning mr-1"
                                                                            onclick="history.back();">
                                                                        <i class="ft-x"></i> تراجع
                                                                    </button>
                                                                </form>
                                                                        </div>
                                                                        </div>
                                                                        <!--  other word properities-->
                                                                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                                                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                                                <br>

                                                                                <form class="form" action="{{route('admin.words.updateotherwordprop',['id'=>$word->word_id,'mojjam_id'=>$mojjam->id])}}" method="POST" enctype="multipart/form-data">
                                                                              @csrf
                                                                              <input name="word_id" value="{{$word ->word_id}}" type="hidden">
                                                                              <input name="mojjam_id" value="{{$mojjam -> id}}" type="hidden">
                                                                              <div class="form-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="projectinput">خصائص أخري للكلمة </label>
                                                                                            <?php
                                                                                            $other_word_properties=explode(",",$word-> other_word_properties);
                                                                                          ?>
                                                                                          @foreach ($other_word_properties as $other_word_prop)
                                                                                          <input type="text" value="{{$other_word_prop}}"  id="other_word_properties[]"
                                                                                          class="form-control" readonly
                                                                                          placeholder="  " style="margin-bottom: 10px"
                                                                                          name="other_word_properties[]">
                                                                                          @error("other_word_properties.*")
                                                                                          <span class="text-danger">{{$message}}</span>
                                                                                          @enderror
                                                                                          @endforeach

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                              </div>
                                                                               <!-- here -->
                                                                               <div class="form-actions">

                                                                                <button type="button" class="btn btn-warning mr-1"
                                                                                onclick="history.back();">
                                                                            <i class="ft-x"></i> تراجع
                                                                        </button>
                                                                    </form>
                                                                            </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- moradfaat -->
                                                                        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                                                                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                                                <br>

                                                                                <form class="form" action="{{route('admin.words.updateotherwordprop',['id'=>$word->word_id,'mojjam_id'=>$mojjam->id])}}" method="POST" enctype="multipart/form-data">
                                                                              @csrf
                                                                              <input name="word_id" value="{{$word ->word_id}}" type="hidden">
                                                                              <input name="mojjam_id" value="{{$mojjam -> id}}" type="hidden">
                                                                              <div class="form-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="projectinput">مرادفات  الكلمة </label>
                                                                                            <?php
                                                                                            $wordmoradfs=App\Models\Moradfat::where('word_id',$word ->word_id)->where('mojjam_id',$mojjam->id)->selection()->get();
                                                                                          ?>
                                                                                          @foreach ($wordmoradfs as $wordmoradf)
                                                                                          <input type="text" value="{{$wordmoradf->moradf}}"  id="word_moradf[]"
                                                                                          class="form-control" readonly
                                                                                          placeholder="  " style="margin-bottom: 10px"
                                                                                          name="word_moradf[]">
                                                                                          @error("word_moradf.*")
                                                                                          <span class="text-danger">{{$message}}</span>
                                                                                          @enderror
                                                                                          @endforeach

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                              </div>
                                                                               <!-- here -->
                                                                               <div class="form-actions">

                                                                                <button type="button" class="btn btn-warning mr-1"
                                                                                onclick="history.back();">
                                                                            <i class="ft-x"></i> تراجع
                                                                        </button>
                                                                    </form>
                                                                            </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- moradfaat  end-->

                                                                        <!-- modad tab -->


                                                                        <div class="tab-pane fade" id="modad" role="tabpanel" aria-labelledby="modad-tab">
                                                                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                                                                <br>

                                                                                <form class="form" action="{{route('admin.words.updateotherwordprop',['id'=>$word->word_id,'mojjam_id'=>$mojjam->id])}}" method="POST" enctype="multipart/form-data">
                                                                              @csrf
                                                                              <input name="word_id" value="{{$word ->word_id}}" type="hidden">
                                                                              <input name="mojjam_id" value="{{$mojjam -> id}}" type="hidden">
                                                                              <div class="form-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-6">
                                                                                        <div class="form-group">
                                                                                            <label for="projectinput">أضداد  الكلمة </label>
                                                                                            <?php
                                                                                            $wordmodads=App\Models\Modad::where('word_id',$word ->word_id)->where('mojjam_id',$mojjam->id)->selection()->get();
                                                                                          ?>
                                                                                          @foreach ($wordmodads as $wordmodad)
                                                                                          <input type="text" value="{{$wordmodad->modad}}"  id="word_modad[]"
                                                                                          class="form-control" readonly
                                                                                          placeholder="  " style="margin-bottom: 10px"
                                                                                          name="word_modad[]">
                                                                                          @error("word_modad.*")
                                                                                          <span class="text-danger">{{$message}}</span>
                                                                                          @enderror
                                                                                          @endforeach

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                              </div>
                                                                               <!-- here -->
                                                                               <div class="form-actions">

                                                                                <button type="button" class="btn btn-warning mr-1"
                                                                                onclick="history.back();">
                                                                            <i class="ft-x"></i> تراجع
                                                                        </button>
                                                                    </form>
                                                                            </div>
                                                                            </div>
                                                                        </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- modad tab end -->
                                                                    </div>
                                                                <!-- tab end -->

                                                            <!-- tab of other properities and derivatives end -->
                                                       </div>
                                            </div>
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
