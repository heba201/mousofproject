@extends('front.layout')
@section('content')
<!-- search section -->
@include('front.namesmeanings.searchbar')
<!-- search section end -->

<section class="contact-page pb-0 newbottom" style="padding-top: 115px">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="contact-form-warp namesmeanings">
                    <div class="section-title text-white text-right add" style="text-align: center">


                        <h5 style="border: 2px solid #fff;border-radius:5px">معني اسم {{$namesmeanings->name}} </h5>

                        <p>اسم علم   {{$namesmeanings->name_type==0? 'مذكر' : 'مؤنث'}} </p>
                        <p style="margin-bottom:15px"> {{$namesmeanings->name_meaning}}</p>
                        <span >أصل الاسم : <strong style="background: #788"> {{$namesmeanings->nameorigin->name_origin}} </strong>  </span>
                    </div>

                </div>
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
@include('front.moradfat.sidebar')
        </div>
    </div>
</section>
<!-- Page end -->


<!-- more searched names -->
<section class="contact-page spad pb-0" style="border-radius: 5px;margin-top:-50px">
    <div class="container">
        <div class="row">
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

<!-- origin names -->
<section class="contact-page pb-0" style="border-radius: 5px;margin-top:20px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8" >
                <div class="contact-form-warp originsec">

                    <div class="section-title text-white text-right originname" style="text-align: center">
                        <h5 >أصول الأسماء</h5>
                        @foreach ($namesorigins as $nameorigin)
                        <a href="{{route('namesmeanings.namesmeanings_origin',$nameorigin->id)}}"><span style="margin-right:15px;margin-top:30px;"><strong> {{$nameorigin->name_origin}}</strong></span></a>
                        @endforeach

                    </div>
                </div>
            </div>

        </div>

    </div>
</section>
<!-- origin names end -->






@endsection
