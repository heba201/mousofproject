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
                                <li class="breadcrumb-item"><a href=""> معاني الأسماء </a>
                                </li>
                                <li class="breadcrumb-item active">  معني اسم
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
                                    <h4 class="card-title" id="basic-layout-form">  معني اسم </h4>
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

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات الاسم </h4>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">الاسم </label>
                                                                    <input type="text" value="{{$namemeaning->name}}" id="name"
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
                                                                    <label for="projectinput2">أصل الاسم</label>
                                                                    <select name="nameorigin_id" class="select2 form-control" id="selectId1" disabled>
                                                                        <optgroup label="أصل الاسم">
                                                                            @foreach ($namesorigins as $nameorigin)
                                                                            <option value="{{$nameorigin->id}}" {{$namemeaning->nameorigin_id==$nameorigin->id ? 'selected' : ''}}>{{$nameorigin->name_origin}}</option>
                                                                            @endforeach
                                                                        </optgroup>
                                                                    </select>
                                                                    @error('nameorigin_id')
                                                                    <span class="text-danger"> {{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput2">نوع الاسم</label>
                                                                    <select name="name_type" class="select2 form-control" id="selectId2" disabled>
                                                                        <optgroup label="نوع الاسم">

                                                                            <option value="0" {{$namemeaning->name_type==0 ? 'selected' : ''}}>مذكر</option>
                                                                            <option value="1" {{$namemeaning->name_type==1 ? 'selected' : ''}}>مؤنث</option>

                                                                        </optgroup>
                                                                    </select>
                                                                    @error('name_type')
                                                                    <span class="text-danger"> {{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> معني  الاسم  </label>
                                                                    <textarea type="text"  id="name_meaning"
                                                                           class="form-control" readonly
                                                                           placeholder=" "
                                                                           name="name_meaning">{{$namemeaning->name_meaning}}</textarea>
                                                                    @error("name_meaning")
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