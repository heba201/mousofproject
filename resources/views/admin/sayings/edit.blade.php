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
                                <li class="breadcrumb-item"><a href="">    أقوال مأثورة   </a>
                                </li>
                                <li class="breadcrumb-item active"> تعديل قول مأثور
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
                                    <h4 class="card-title" id="basic-layout-form">  تعديل  قول مأثور</h4>
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
                                        <form class="form" action="{{route('admin.sayings.updatesaying',$saying->id)}}"
                                              method="POST" enctype="multipart/form-data">
                                              <input type="hidden" name="id" value="{{$saying -> id}}">
                                              {{ csrf_field() }}
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> تعديل قول مأثور  </h4>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="text-center">
                                                                        <img
                                                                            src="{{ asset('assets/').'/'. $saying  ->saying_photo}}"
                                                                            class="rounded-circle"  height="100" alt="صورة القول المأثور  ">
                                                                    </div>
                                                                </div>
                                                                </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">    القول المأثور  </label>
                                                                    <textarea type="text"  id="saying"
                                                                           class="form-control"
                                                                           placeholder=""
                                                                           name="saying">{{$saying->saying}}</textarea>
                                                                           @error("saying")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput2">القائل</label>
                                                                    <select name="character_id" class="select2 form-control" id="selectId">
                                                                        <optgroup label="قائل الحكمة / المثل">
                                                                            @foreach ($characters as $character)
                                                                            <option value="{{$character->id}}" {{$saying->character_id==$character->id ? 'selected' : ' '}}>{{$character->character_name}}</option>
                                                                            @endforeach
                                                                        </optgroup>
                                                                    </select>
                                                                    @error('character_id')
                                                                    <span class="text-danger"> {{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput2">موضوع القول المأثور</label>
                                                                    <select name="saying_subject" class="select2 form-control" id="selectId">
                                                                        <optgroup label="موضوع القول المأثور">
                                                                            @foreach ($wisdomSayingsubjects as $wisdomSayingsub)
                                                                            <option value="{{$wisdomSayingsub->id}}" {{$saying->wisdomsayingsubject_id==$wisdomSayingsub->id ? 'selected' : ' '}}>{{$wisdomSayingsub->subject}}</option>
                                                                            @endforeach
                                                                        </optgroup>
                                                                    </select>
                                                                    @error('saying_subject')
                                                                    <span class="text-danger"> {{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">   صورة القول المأثور  </label>
                                                                    <input type="file" value="" id="saying_photo"
                                                                           class="form-control"
                                                                           placeholder=" "
                                                                           name="saying_photo">
                                                                    @error("saying_photo")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-5">
                                                                    <div class="form-group">
                                                                        <label for="projectinput1">الوسوم</label>
                                                                        @foreach($sayingtags as $sayingtag)
                                                                        <input type="text" value="{{$sayingtag}}" id="saying_tag[]"
                                                                            class="form-control" style="margin-bottom: 10px;"
                                                                            placeholder=" "
                                                                            name="saying_tag[]">
                                                                            @endforeach
                                                                               @error("saying.*")
                                                                        <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-1">
                                                                    <a href="javascript:void(0)"  class="btn btn-primary" id="addtag_button" style="margin-top: 25px;"><i class="fas fa-plus"></i></a>
                                                                    </div>
                                                                    <div class="col-md-1">
                                                                        <a href="javascript:void(0)"  class="btn btn-danger" id="removetag_button" style="margin-top: 25px;margin-left:10px"><i class="fas fa-minus"></i></a>
                                                                        </div>
                                                                </div>
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


            $('#addtag_button').click(function(){
            $('.field-wrapper2').append(
                '<div class="col-md-4" id="GFG_DIV"><input type="text" value="" id="saying_tag[]" class="form-control" placeholder=" " name="saying_tag[]" style="margin-bottom:15px"></div>'
             );
            })
             $("#removetag_button").on("click", function() {
    $('.field-wrapper2').children().last().remove();
            });
      });
 </script>
@endsection
