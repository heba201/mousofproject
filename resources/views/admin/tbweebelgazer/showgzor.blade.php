@extends('layouts.admin')

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> جذور معجم </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active">  جذور معجم {{$mojjam->mojjam_name}}

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
                                    <h4 class="card-title">جذور معجم {{$mojjam->mojjam_name}}  -
                                        <a href="{{route('admin.mojjams')}}" class="btn btn-primary"><i class="la la-check-square-o"></i> عودة إلي المعاجم</a>


                                    </h4>

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

                                    <a href="{{route('admin.wordgazer.create',$mojjam ->id)}}" style="margin-right: 10px;"
                                        class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1"> <i class="fas fa-plus-circle" style="color: white"></i> إضافة جذر</a>

                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered scroll-horizontal">
                                            <thead class="">
                                            <tr>
                                                <th>الجذور </th>
                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                                @foreach($mojjamgazrexist as $wordgazer)
                                                    <tr>
                                                           <td> {{$wordgazer->word_gazer}}</td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                 <a href="{{route('admin.wordgazer.show',['id' =>$wordgazer ->id, 'mojjam_id' => $mojjam->id])}}"
                                                                    class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">عرض</a>
                                                                 @if( Auth::user()->role_id==2)
                                                                <a href="{{route('admin.wordgazer.edit',['id' =>$wordgazer ->id, 'mojjam_id' => $mojjam->id])}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>

                                                                <a href="{{route('admin.wordgazer.delete',['id' =>$wordgazer ->id, 'mojjam_id' => $mojjam->id])}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1" onclick="return confirm('هل تريد الحذف?')">حذف</a>
                                                            @endif
                                                                </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
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