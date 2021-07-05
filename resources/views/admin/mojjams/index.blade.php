@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">  المعاجم العربية </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active">  المعاجم العربية

                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"> جميع المعاجم </h4>
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
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered scroll-horizontal">
                                            <thead class="">
                                            <tr>
                                                <th>المعاجم </th>
                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($mojjams)
                                                @foreach($mojjams as $mojjam)
                                                    <tr>
                                                        <td>{{$mojjam -> mojjam_name}}</td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                 <a href="{{route('admin.mojjams.show',$mojjam->id)}}"
                                                                    class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">عرض</a>

                                                                    @if( Auth::user()->role_id==2)
                                                                    <a href="{{route('admin.mojjams.edit',$mojjam ->id)}}"
                                                                        class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>
                                                                        @endif
                                                                   <?php
                                                                    $words=$mojjam->words();
                                                                    $gzor=$mojjam->gzor();
                                                                    ?>
                                                                    @if($words->count()>0)
                                                                    <a href="{{route('admin.mojjams.showwords',$mojjam->id)}}"
                                                                        class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1"> عرض الكلمات</a>

                                                                        @else
                                                                        <a href="{{route('admin.words.create',$mojjam ->id)}}"
                                                                            class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1"> إضافة كلمات</a>

                                                                        @endif

                                                                        <!-- condition for elgzor -->
                                                                        @if($gzor->count()>0)
                                                                        <a href="{{route('admin.mojjams.showgzor',$mojjam->id)}}"
                                                                            class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1"> عرض الجذور</a>

                                                                            @else
                                                                            <a href="{{route('admin.wordgazer.create',$mojjam ->id)}}"
                                                                                class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1"> إضافة جذور</a>

                                                                            @endif

                                                                 @if( Auth::user()->role_id==2)
                                                                <a href="{{route('admin.mojjams.delete',$mojjam ->id)}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1" onclick="return confirm('هل تريد الحذف?')">حذف</a>
                                                            @endif
                                                                </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset


                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
@push('Js')
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    function deleteData(dt){
    if(confirm('Are you sure you want to delete?')){
      $.ajax({
        type:'DELETE',
        url:$(dt).data("url"),
        data:{
         "_token": "{{ csrf_token() }}",

        },
        success: function(response){
          if(response.status){
            location.reload();
          }
        },
        error:function(response){
          console.log(response);
        }
      });
      return false;
    }

  }
  </script>
@endpush
