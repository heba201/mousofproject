@extends('front.layout')
@push('style')
<style>
    .ar{
        float: right;
    }
    .side{
        float: left;
    }
.feature-text{
padding:50px;
border: 2px solid #ddd;
background: white;
border-radius: 6px;
margin-bottom: 30px;
transition: all 0.3s ease-in-out;
}
.feature-text h4{
    margin: 40px 0px;
}

.feature-text:hover{
    border-top:  6px solid #d82a4e;
    padding-top: 45px;
    box-shadow: 0 5px 15px rgba(0, 0, 0,0.1);
}
.feature-text .img{
    height: 60px;
    background-repeat: no-repeat;
    background-position: 50%;
}

.feature-text img{
     margin-bottom: 20px;
     border:2px solid #ddd;
     border-radius:50%;

}
.sidebar{
padding:50px;
background: white;
border-radius: 6px;
margin-bottom: 30px;
transition: all 0.3s ease-in-out;
}
.sidebar h4{
    margin: 40px 0px;
}

 .sidebar:hover{
    border-top:  6px solid #d82a4e;
    padding-top: 45px;
    box-shadow: 0 5px 15px rgba(0, 0, 0,0.1);
}

    </style>
@endpush
@section('content')

     <!-- articles area -->
     <section class="feature">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="heading text-center">
                        <h3><b>مقالات</b></h3>
                        <br><br>
                    </div>
                </div>

                <div class="col-md-9 col-sm-6" style="background: #d82a4e;padding-top:30px;height:1%;width:1%;overflow: hidden;">
              <!-- article -->
              @if($articles->isEmpty())
              <h5 style="color:#fff;" class="text-center"> عفوا لا يوجد مقالات </h5>
                  @endif
                  @if($articles)
              @foreach($articles as $article)
            <div class="col-md-4 col-sm-6 ar">
                <div class="feature-text text-center">
                    <img src="{{asset('assets/'.$article->article_photo)}}" class="img" width="400" height="100">
                    <h6>{{$article->article_title}}</h6>
                        <p>{{ Str::limit($article->article_details, 60)}}</p>
                            <a href="{{route('article',$article->id)}}" class="site-btn readmore">قراءة المزيد</a>
                    </div>

            </div>
            @endforeach
             <!-- article end -->
             <div style="margin-top:10px">
                {{$articles->links("pagination::bootstrap-4")}}
                </div>
                @endif
                </div>
        <!-- sidebar -->
            <div class="col-md-3 col-sm-6 ">
                <div class="text-right sidebar">
                    <div class="sb-widget-item">
                        <h4 class="sb-w-title">تصنيفات</h4>
                        <ul>
                            @foreach ($articlecategories as $cat)
                            <li><a href="{{route('articlecategory',$cat->id)}}">{{$cat->article_category}}</a></li>
                            @endforeach

                        </ul>
                    </div>
                    <div class="sb-widget-item">
                        <h4 class="sb-w-title">أرشيف</h4>
                        <ul>
                            <?php
                            $i=count($articlesall);
                            for ($i=0; $i <count($articlesall) ; $i++) {
                                $catd[$i]=$articlesall[$i]->created_at->todatestring();
                            }
                            $articldates = array_unique($catd);
                            ?>
                            @foreach ($articldates as $d)
                          <li><a href="{{route('articlesbydate',$d)}}"> {{$d}} </a></li>
                                @endforeach
                        </ul>
                    </div>
                    <div class="sb-widget-item">
                        <div class="add">
                            <a href="#"><img src="img/add.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- sidebar end -->
        </div>
        </div>
        </div>
        </div>
        </section>
        <!-- feature end -->

@endsection
