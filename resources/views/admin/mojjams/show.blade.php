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
                                <li class="breadcrumb-item active">  معجم
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
                                    <h4 class="card-title" id="basic-layout-form">  معجم </h4>
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

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات المعجم </h4>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> اسم المعجم </label>
                                                                    <input type="text" value="{{$mojjam -> mojjam_name}}" id="name"
                                                                           class="form-control" readonly
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
                                                                    <select name="author_id" class="select2 form-control" id="selectId" disabled>
                                                                        <optgroup label="المؤلف">
                                                                            @foreach ($mojjamsauthors as $mojjamauthor)
                                                                            <option value="{{$mojjamauthor->id}}" {{$mojjam->author_id==$mojjamauthor->id ? 'selected':''}}>{{$mojjamauthor->author_name}}</option>
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
                                                                    <select name="mojjamarrangetype_id" class="select2 form-control" id="selectId2" disabled>
                                                                        <optgroup label="نوع ترتيب المعجم">
                                                                     @foreach ($mojjamarrangetypes as $mojjamarrangetype)
                                                                     <option value="{{$mojjamarrangetype->id}}" {{$mojjam->mojjamarrangetype_id==$mojjamarrangetype->id ? 'selected':''}}>{{$mojjamarrangetype->mojjam_arrangetype}}</option>
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
                                                                    <select name="mojjammethod_id" class="select2 form-control" id="selectId3" disabled>
                                                                        <optgroup label=" منهج المعجم">
                                                                     @foreach ($mojjammethods as $mojjammethod)
                                                                     <option value="{{$mojjammethod->id}}" {{$mojjam->mojjammethod_id==$mojjammethod->id ? 'selected':''}}>{{$mojjammethod->mojjam_method}}</option>
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
                                                                           class="form-control" readonly
                                                                           placeholder="  "
                                                                           name="example">{{$mojjam->example}}</textarea>
                                                                    @error("example")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> تخصص المعجم</label>
                                                                    <select name="mojjamspecialty_id" class="select2 form-control" id="selectId4" disabled>
                                                                        <optgroup label=" تخصص المعجم">
                                                                        @foreach ($mojjamspecialties as $mojjamspecialty)
                                                                        <option value="{{$mojjamspecialty->id}}" {{$mojjam->mojjamspecialty_id==$mojjamspecialty->id ? 'selected':''}}>{{$mojjamspecialty->mojjam_specialty}}</option>
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
