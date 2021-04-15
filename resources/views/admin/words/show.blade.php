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
                                    <h4 class="card-title" id="basic-layout-form">  كلمة </h4>
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
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات الكلمة </h4>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">  الكلمة </label>
                                                                    <input type="text" value="{{$word->word}}" id="word"
                                                                           class="form-control" readonly
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
                                                                    <select name="word_type" class="select2 form-control" id="selectId" disabled>
                                                                        <optgroup label=" نوع الكلمة ">

                                                                                    <option value="0" {{$word->word_type==0 ? "selected" : ""}}>اسم</option>
                                                                                    <option value="1" {{$word->word_type==1 ? "selected" : ""}}>فعل</option>
                                                                                    <option value="2" {{$word->word_type==2 ? "selected" : ""}}>مصطلح</option>
                                                                                    <option value="3" {{$word->word_type==3 ? "selected" : ""}}>كلمة مركبة</option>
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
                                                                           class="form-control" readonly
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
                                                                           placeholder="  " readonly
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
                                                                           placeholder="  " readonly
                                                                           name="weight_indication">
                                                                    @error("weight_indication")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">الزمن</label>
                                                                    <select name="time" class="select2 form-control" id="selectId" disabled>
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
                                                                           <select name="word_source" class="select2 form-control" id="selectId" disabled>
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

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">مشتقات الكلمة</label>
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
                                                                    <label for="projectinput1">خصائص أخري للكلمة</label>
                                                                    @foreach ($other_word_properties as $word_pro)
                                                                    <input type="text" value="{{$word_pro}}"  id="word_pro"
                                                                    class="form-control" readonly
                                                                    placeholder="  " style="margin-bottom: 10px"
                                                                    name="word_pro">
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            </div>


                                                            <div class="form-actions">
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
