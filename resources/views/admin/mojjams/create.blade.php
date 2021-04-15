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
                                <li class="breadcrumb-item"><a href="">المعاجم العربية </a>
                                </li>
                                <li class="breadcrumb-item active"> إضافة معجم
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
                                    <h4 class="card-title" id="basic-layout-form"> إضافة معجم </h4>
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
                                        <form class="form" action="{{route('admin.mojjams.store')}}"
                                              method="POST">
                                              {{ csrf_field() }}

                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات المعجم </h4>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> اسم المعجم </label>
                                                                    <input type="text" value="" id="name"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           name="name">
                                                                    @error("name")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">المؤلف</label>
                                                                    <select name="author_id" class="select2 form-control" id="selectId">
                                                                        <optgroup label="المؤلف">
                                                                            @foreach ($mojjamsauthors as $mojjamauthor)
                                                                            <option value="{{$mojjamauthor->id}}">{{$mojjamauthor->author_name}}</option>
                                                                            @endforeach

                                                                    </select>
                                                                    @error("author_id")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">نوع ترتيب المعجم</label>
                                                                    <select name="mojjamarrangetype_id" class="select2 form-control" id="selectId2">
                                                                        <optgroup label="نوع ترتيب المعجم">
                                                                     @foreach ($mojjamarrangetypes as $mojjamarrangetype)
                                                                     <option value="{{$mojjamarrangetype->id}}">{{$mojjamarrangetype->mojjam_arrangetype}}</option>
                                                                     @endforeach
                                                                    </select>
                                                                    @error("mojjamarrangetype_id")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> منهج المعجم</label>
                                                                    <select name="mojjammethod_id" class="select2 form-control" id="selectId3">
                                                                        <optgroup label=" منهج المعجم">
                                                                     @foreach ($mojjammethods as $mojjammethod)
                                                                     <option value="{{$mojjammethod->id}}">{{$mojjammethod->mojjam_method}}</option>
                                                                     @endforeach

                                                                    </select>
                                                                    @error("mojjammethod_id")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">مثال</label>
                                                                    <textarea type="text" value="" id="example"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           name="example"></textarea>
                                                                    @error("example")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>


                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> تخصص المعجم</label>
                                                                    <select name="mojjamspecialty_id" class="select2 form-control" id="selectId4">
                                                                        <optgroup label=" تخصص المعجم">
                                                                        @foreach ($mojjamspecialties as $mojjamspecialty)
                                                                        <option value="{{$mojjamspecialty->id}}">{{$mojjamspecialty->mojjam_specialty}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error("mojjamspecialty_id")
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
