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
                                <li class="breadcrumb-item active"> تعديل كلمة حسب معجم
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
                                    <h4 class="card-title" id="basic-layout-form"> تعديل كلمة حسب معجم </h4>
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
                                        <form class="form" action="{{route('admin.words.update',$word->word_id)}}"
                                              method="POST">
                                              {{ csrf_field() }}
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات الكلمة </h4>
                                                        <div class="row">

                                                                <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">اختر المعجم</label>
                                                                           <select name="mojjam_id" class="select2 form-control" id="selectId0">
                                                                            <optgroup label=" اختر المعجم">
                                                                            @foreach ($mojjams as $mojjam)
                                                                            <option value="{{$mojjam->mojjam->id}}">{{$mojjam->mojjam->mojjam_name}}</option>
                                                                            @endforeach
                                                                            </optgroup>
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
                                                                           placeholder="  "
                                                                           name="word">
                                                                    @error("word")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput2">نوع الكلمة</label>
                                                                    <select name="word_type" class="select2 form-control" id="selectId">
                                                                        <optgroup label=" نوع الكلمة ">

                                                                                    <option value="0">إسم</option>
                                                                                    <option value="1">فعل</option>
                                                                                    <option value="2">حرف</option>

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
                                                                    <select name="word_gzer" class="select2 form-control" id="selectId">
                                                                        <optgroup label=" جذر الكلمة ">

                                                                         <option value="0" {{$word->word_gzer==0 ? 'selected' : ' '}}>أب</option>
                                                                         <option value="1" {{$word->word_gzer==1 ? 'selected' : ' '}}>أم</option>
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
                                                                    <input type="text" value="{{$word->gzer_type}}"  id="gzer_type"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           name="gzer_type">
                                                                    @error("gzer_type")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">  وزن الجذر </label>
                                                                    <input type="text" value="{{$word->gzer_weight}}" id="gzer_weight"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           name="gzer_weight">
                                                                    @error("gzer_weight")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">  دلالة الوزن </label>
                                                                    <input type="text" value="{{$word->weight_indication}}" id="weight_indication"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           name="weight_indication">
                                                                    @error("weight_indication")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">الزمن</label>
                                                                    <select name="time" class="select2 form-control" id="selectId">
                                                                        <optgroup label="الزمن">
                                                                         <option value="0" {{$word->time==0 ? 'selected' : ' '}}>ماضي</option>
                                                                         <option value="1" {{$word->time==1 ? 'selected' : ' '}}>مستقبل</option>
                                                                         <option value="2" {{$word->time==2 ? 'selected' : ' '}}>حاضر</option>
                                                                         <option value="3" {{$word->time==3 ? 'selected' : ' '}}>امر</option>
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
                                                                           <select name="word_source" class="select2 form-control" id="selectId">
                                                                            <optgroup label="المصدر">
                                                                                <option value="0" {{$word->word_source==0 ? 'selected' : ' '}}>ثلاثية</option>
                                                                                <option value="1" {{$word->word_source==1 ? 'selected' : ' '}}>رباعية</option>
                                                                                <option value="2" {{$word->word_source==2 ? 'selected' : ' '}}>خماسية</option>
                                                                                <option value="3" {{$word->word_source==3 ? 'selected' : ' '}}>سداسية</option>
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
                                                                           <select name="word_indication" class="select2 form-control" id="selectId">
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
                                                            </div>


                                                            <div class="form-actions">
                                                                <button type="submit" class="btn btn-primary">
                                                                    <i class="la la-check-square-o"></i> التالي
                                                                </button>
                                                                <button type="button" class="btn btn-warning mr-1"
                                                                onclick="history.back();">
                                                            <i class="ft-x"></i> تراجع
                                                        </button>
                                                            </div>
                                                        </div>
                                            </div>
                                        </form>
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
