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
                                <li class="breadcrumb-item"><a href=""> مشتقات  الكلمة  </a>
                                </li>
                                <li class="breadcrumb-item active">  إضافة  مشتقات للكلمة
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
                                    <h4 class="card-title" id="basic-layout-form"><a href="">  {{$mojjam->mojjam_name}}</a> -  إضافة مشتقات للكلمة  </h4>
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
                                        <form class="form" action="{{route('admin.words.addderivatives',['id'=>$word->word_id,'mojjam_id'=>$mojjam->id])}}"
                                              method="POST">
                                              {{ csrf_field() }}

                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i>  الكلمة </h4>
                                                <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">  الكلمة </label>
                                                                    <input type="text" value="{{$word->word->word}}" id="word"
                                                                           class="form-control"
                                                                           placeholder="" readonly
                                                                           name="word">
                                                                    @error("word")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">  المعجم </label>
                                                                    <input type="text" value="{{$mojjam->mojjam_name}}" id="mojjam_name"
                                                                           class="form-control"
                                                                           placeholder="" readonly
                                                                           name="mojjam_name">
                                                                    @error("mojjam_name")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>


                                                            @if($word->word_type==0)
                                                            <div class="col-md-12">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">     العدد  </label>
                                                                           <select name="word_count" class="select2 form-control" id="word_count">
                                                                            <optgroup label="العدد">
                                                                            @foreach ($word_count as $count)
                                                                            <option value="{{$count->id}}">{{$count->word_count}}</option>
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










                                                        </div>


                                                            </div>

                                                            <div class="row">
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">    مشتقة الكلمة </label>
                                                                    <input type="text" value="" id="word_derivatives[]"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           name="word_derivatives[]">
                                                                    @error("word_derivatives.*")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <a href="javascript:void(0)"  class="btn btn-primary" id="addprop_button" style="margin-top: 25px;"><i class="fas fa-plus"></i></a>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <a href="javascript:void(0)"  class="btn btn-danger" id="removeprop_button" style="margin-top: 25px;margin-left:10px"><i class="fas fa-minus"></i></a>
                                                                    </div>
                                                                    <!-- derivative meaning -->

                                                                    <div class="col-md-5">
                                                                        <div class="form-group">
                                                                            <label for="projectinput1">  معني  مشتقة الكلمة </label>
                                                                            <input type="text" value="" id="derivatives_meaning[]"
                                                                                   class="form-control"
                                                                                   placeholder="  "
                                                                                   name="derivatives_meaning[]">
                                                                            @error("derivatives_meaning.*")
                                                                            <span class="text-danger">{{$message}}</span>
                                                                            @enderror
                                                                        </div>

                                                                    </div>
                                                                            <!--der end-->

                                                                </div>
                                                                <!--  -->
    <div class="row field-wrapper" id="name">
   <!-- to append word derivative-->


<!-- to append word derivative end -->


<!-- to append word derivative meaning-->


<!-- to append word derivative meaning end -->
 </div>
                                                                <!-- end -->
                                                        <div class="row field-wrapper2">
                                                        </div>

                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> حفظ
                                                </button>
                                                <button type="button" class="btn btn-warning mr-1"
                                                onclick="history.back();">
                                            <i class="ft-x"></i> تراجع
                                        </button>
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
@section('script')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
      $(document).ready(function(){
        $('#addprop_button').click(function(){
            $('.field-wrapper').append(
                '<div class="col-md-5"><div  id="der" class="form-group"><label for="projectinput1">مشتقة الكلمة</label><input type="text" value="" id="word_derivatives[]"class="form-control" placeholder="  " name="word_derivatives[]"> @error("word_derivatives.*")<span class="text-danger">{{$message}}</span>@enderror</div></div><div id="mean" class="col-md-5" style="margin-right:153px"><div class="form-group"><label for="projectinput1">  معني  مشتقة الكلمة </label><input type="text" value="" id="derivatives_meaning[]" class="form-control" placeholder="  " name="derivatives_meaning[]">  @error("word_derivatives.*")<span class="text-danger">{{$message}}</span>@enderror</div></div>'
);

})
$("#removeprop_button").on("click", function() {
    $('.field-wrapper').children().last().remove();
            });
      });
 </script>
@endsection
