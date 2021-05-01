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
                                <li class="breadcrumb-item"><a href="">    جمل سياقية  </a>
                                </li>
                                <li class="breadcrumb-item active"> إضافة جملة سياقية
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
                                    <h4 class="card-title" id="basic-layout-form">  إضافة جملة سياقية</h4>
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
                                        <form class="form" action="{{route('admin.sentences.createforword',$word->word_id)}}"
                                              method="POST">
                                              {{ csrf_field() }}
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> ادخال جملة سياقية للكلمة  </h4>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">  الكلمة </label>
                                                                    <input type="text" value="{{$word->word->word}}" id="word"
                                                                           class="form-control" readonly
                                                                           placeholder="  "
                                                                           name="word">
                                                                    @error("word")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            </div>
                                                            <div class="row">
                                                            <div class="col-md-5">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">   الجملة السياقية  </label>
                                                                    <textarea type="text" value="" id="word_sentense"
                                                                           class="form-control"
                                                                           placeholder=" "
                                                                           name="word_sentense[]"></textarea>
                                                                           @error("word_sentense.*")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-1">
                                                                <a href="javascript:void(0)"  class="btn btn-primary" id="add_button" style="margin-top: 25px;"><i class="fas fa-plus"></i></a>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <a href="javascript:void(0)"  class="btn btn-danger" id="remove_button" style="margin-top: 25px;margin-left:10px"><i class="fas fa-minus"></i></a>
                                                                    </div>
                                                            </div>
                                                            <div class="row field-wrapper">
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
        $('#add_button').click(function(){
            $('.field-wrapper').append(
                '<div class="col-md-5" id="GFG_DIV"><textarea type="text" value="" id="word_sentense[]" class="form-control" placeholder=" " name="word_sentense[]" style="margin-bottom:15px"></textarea></div>'
             );
})
$("#remove_button").on("click", function() {
    $('.field-wrapper').children().last().remove();
            });
      });
 </script>
@endsection
