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
                                <li class="breadcrumb-item"><a href=""> منهج  المعجم  </a>
                                </li>
                                <li class="breadcrumb-item active"> إضافة منهج  للمعجم
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
                                    <h4 class="card-title" id="basic-layout-form"> إضافة منهج للمعجم </h4>
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
                                        <form class="form" action="{{route('admin.mojjammethods.store')}}"
                                              method="POST">
                                              {{ csrf_field() }}

                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات  منهج المعجم </h4>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="projectinput1">  منهج المعجم </label>
                                                                    <input type="text" value="" id="mojjam_method"
                                                                           class="form-control"
                                                                           placeholder="  "
                                                                           name="mojjam_method">
                                                                    @error("mojjam_method")
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
@section('script')
<script>
function myNewFunction(sel) {
  //alert(sel.options[sel.selectedIndex].text);
  var defaultVal = sel.options[sel.selectedIndex].value;
  var mojjammethod = document.getElementById("mojjammethod_id");
  if(defaultVal==1){
  $('#mojjammethod_id').val("1").change();
  }

  if(defaultVal==3){
  $('#mojjammethod_id').val("2").change();
  }

  if(defaultVal==4){
  $('#mojjammethod_id').val("3").change();
  }

  if(defaultVal==7){
  $('#mojjammethod_id').val("4").change();
  }

  if(defaultVal==8){
  $('#mojjammethod_id').val("5").change();
  }

  if(defaultVal==10){
  $('#mojjammethod_id').val("6").change();
  }
  if(defaultVal==13){
  $('#mojjammethod_id').val("7").change();
  }
}
</script>
@endsection
