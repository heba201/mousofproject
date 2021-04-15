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
                                <li class="breadcrumb-item"><a href=""> الشعراء </a>
                                </li>
                                <li class="breadcrumb-item active">  شاعر
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
                                    <h4 class="card-title" id="basic-layout-form">  شاعر </h4>
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

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات الشاعر </h4>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1"> اسم الشاعر </label>
                                                                    <input type="text" value="{{$poet->poet_name}}" id="poet_name"
                                                                           class="form-control"
                                                                           placeholder="  " readonly
                                                                           name="poet_name">
                                                                    @error("poet_name")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">   عصر الشاعر  </label>
                                                                    <input type="text" value="{{$poet->poet_era}}" id="poet_era"
                                                                           class="form-control"
                                                                           placeholder=" " readonly
                                                                           name="poet_era">
                                                                    @error("poet_era")
                                                                    <span class="text-danger">{{$message}}</span>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="projectinput1">   السيرة الذاتية  </label>
                                                                        <textarea type="text" value="" id="poet_cv"
                                                                               class="form-control" readonly
                                                                               placeholder=" "
                                                                               name="poet_cv">{{$poet->poet_cv}}</textarea>
                                                                        @error("poet_cv")
                                                                        <span class="text-danger">{{$message}}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>

                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">الأعمال</label>
                                                                    @foreach($poetworks as $poetwork)
                                                                    <textarea type="text" value="" id="poet_works[]"
                                                                           class="form-control" style="margin-bottom: 10px;"
                                                                           placeholder=" " readonly
                                                                           name="poet_works[]">{{$poetwork}}</textarea>
                                                                           @endforeach
                                                                    @error("poet_works.*")
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

