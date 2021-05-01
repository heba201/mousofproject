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
                                <li class="breadcrumb-item active"> تعديل كلمة
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
                                    <h4 class="card-title" id="basic-layout-form"> تعديل كلمة </h4>
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
                                        <form class="form" action="{{route('admin.words.secupdate',['id'=>$word->word_id,'mojjam_id' =>$word->mojjam_id])}}"
                                              method="POST">
                                              {{ csrf_field() }}

                                            <div class="form-body">

                                                <h2 class="form-section"><i class="ft-home"></i>{{$word->word->word}}</h2>
                                                        <div class="row">
                                                               <div class="col-md-5">
                                                                <div class="form-group">

                                                                    @if($word->word_type==1 || $word->word_type==0)
                                                                    <label for="projectinput1">  مشتقات الكلمة  </label>
                                                                    @foreach ($word_derivatives as $deriv)
                                                                    <input type="text" value="{{$deriv}}" id="word_derivatives"
                                                                           class="form-control"
                                                                           placeholder=" "
                                                                           name="word_derivatives[]" style="margin-bottom:10px">
                                                                           @endforeach
                                                                           @error("word_derivatives.*")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-1">
                                                                <a href="javascript:void(0)"  class="btn btn-primary" id="add_button" style="margin-top:25px"><i class="fas fa-plus"></i></a>
                                                                </div>
                                                                <div class="col-md-1">
                                                                    <a href="javascript:void(0)"  class="btn btn-danger" id="remove_button" style="margin-top:25px"><i class="fas fa-minus"></i></a>
                                                                    </div>
                                                        </div>
                                                            @endif

                                                                <div class="col-md-5">
                                                                    <input type="hidden" value="{{$word->word_id}}" id="word_id"
                                                                    class="form-control"
                                                                    placeholder=" "
                                                                    name="word_id">

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
                '<div class="col-md-5" id="GFG_DIV"><input type="text" value="" id="word_derivatives" class="form-control" placeholder=" " name="word_derivatives[]" style="margin-bottom:15px"> </div>'

             );
})

$("#remove_button").on("click", function() {
    $('.field-wrapper').children().last().remove();
            });
      });
 </script>
@endsection
