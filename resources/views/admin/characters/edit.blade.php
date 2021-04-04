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
                                <li class="breadcrumb-item"><a href=""> الشخصيات </a>
                                </li>
                                <li class="breadcrumb-item active"> إضافة شخصية
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
                                    <h4 class="card-title" id="basic-layout-form"> تعديل شخصية </h4>
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
                                        <form class="form" action="{{route('admin.characters.update',$character->id)}}"
                                              method="POST"   enctype="multipart/form-data">
                                              {{ csrf_field() }}
                                              <input type="hidden" name="id" value="{{$character -> id}}">
                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات الشخصية </h4>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <div class="text-center">
                                                                        <img
                                                                            src="{{ asset('assets/').'/'. $character  -> character_photo}}"
                                                                            class="rounded-circle"  height="100" alt="صورة الشخصية  ">
                                                                    </div>
                                                                </div>
                                                                </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> اسم الشخصية </label>
                                                                    <input type="text" value="{{ $character->character_name}}" id="character_name"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           name="character_name">
                                                                    @error("character_name")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> نبذة عن الشخصية  </label>
                                                                    <textarea type="text"  id="about_character"
                                                                           class="form-control"
                                                                           placeholder=" "
                                                                           name="about_character">{{ $character->about_character}}</textarea>
                                                                    @error("about_character")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput2">نوع الشخصية</label>
                                                                    <select name="character_type" class="select2 form-control" id="selectId">
                                                                        <optgroup label=" نوع الكلمة ">

                                                                                    <option value="0" {{$character->character_type==0 ? 'selected':''}}>الصحابة والتابعين</option>
                                                                                    <option value="1" {{$character->character_type==1 ? 'selected':''}}>عامة</option>
                                                                        </optgroup>
                                                                    </select>
                                                                    @error('character_type')
                                                                    <span class="text-danger"> {{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">   صورة الشخصية  </label>
                                                                    <input type="file" value="" id="character_photo"
                                                                           class="form-control"
                                                                           placeholder=" "
                                                                           name="character_photo">
                                                                    @error("character_photo")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
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
