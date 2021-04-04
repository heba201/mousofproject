@extends('front.layout')
@section('content')
<!-- search section -->
@include('front.namesmeanings.searchbar')
<!-- search section end -->

<section class="contact-page spad pb-0 newbottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="contact-form-warp namesmeanings">
                    @foreach($namesmeanings as $namemeaning)
                    <div class="section-title text-white text-right add" style="text-align: center">
                        <h5 style="border:2px solid #fff;border-radius:5px">معني اسم {{$namemeaning->name}} </h5>

                        <p>اسم علم   {{$namemeaning->name_type==0? 'مذكر' : 'مؤنث'}} </p>
                        <p style="margin-bottom:15px"> {{$namemeaning->name_meaning}}</p>
                        <span >أصل الاسم : <strong style="background: #788"> {{$namemeaning->nameorigin->name_origin}} </strong>  </span>
                    </div>
                    @endforeach
                </div>
                <div style="margin-top:10px">
                {{$namesmeanings->links("pagination::bootstrap-4")}}
                </div>
                <!--related names-->
                <div class="contact-form-warp relatednames">

                    <div class="section-title text-white text-right" style="text-align: center">
                        <h5 style="background:#788 ;padding:20px;border:2px solid #fff;border-radius:5px"> أسماء ذات صلة</h5>
                        @foreach ($namessame as $namsame)
                        <a href="{{route('namesmeanings.namesrelated',$namsame->name)}}"><span style="margin-right:15px"><strong> {{$namsame->name}}</strong></span></a>
                        @endforeach

                    </div>
                </div>
                <!--related names end-->
            </div>



@include('front.moradfat.sidebar')
        </div>
    </div>
</section>
<!-- Page end -->

<!-- more searched names -->
<section class="contact-page  pb-0" style="border-radius: 5px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12" >
                <h5 class="text-right" style="margin-bottom: 25px;">روابط أخري</h5>
            </div>
            <div class="col-lg-8" >
                <div class="contact-form-warp searchsec">

                    <div class="section-title text-white text-right searchnames" style="text-align: center">
                        <h5>الأسماء  الأكثر بحثاً</h5>
                        @foreach ($moresearchednames as $name)
                        <a href="{{route('namesmeanings.namesrelated',$name->name)}}"><span style="margin-right:15px"><strong> {{$name->name}}</strong></span></a>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
<!-- more  searched names end -->


<!-- related names -->
<section class="contact-page  pb-0 rn" style="border-radius: 5px;">
    <div class="container">
        <div class="row">


            <div class="col-lg-8" >
                 <!--boys names-->
                 <div class="contact-form-warp boys">
                    <div class="section-title text-white text-right" style="text-align: center">
                        <h5>أسماء أولاد</h5>
                        @foreach ($boysnames as $boyname)
                        <a href="{{route('namesmeanings.namesrelated',$boyname->name)}}"><span style="margin-right:15px"> <strong>{{$boyname->name}}</strong></span></a>

                        @endforeach
                    </div>
                </div>
                    <!-- boys names- end -->

                     <!--girls names-->
                     <div class="contact-form-warp girls">
                        <div class="section-title text-white text-right" style="text-align: center">
                            <h5>أسماء بنات</h5>
                            @foreach ($girlsnames as $girlname)
                            <a href="{{route('namesmeanings.namesrelated',$girlname->name)}}"><span style="margin-right:15px"><strong> {{$girlname->name}}</strong></span></a>

                            @endforeach

                        </div>
                        </div>
                         <!-- girls names- end -->
            </div>

        </div>

    </div>
</section>
<!-- related names end -->
@endsection
