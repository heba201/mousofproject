@extends('front.layout')
@section('content')
<!-- search section -->
@include('front.fawaed.searchbar')
<!-- search section end -->

<!-- Page -->
<section class="contact-page spad pb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="contact-form-warp sub">
                    <div class="section-title text-white text-right subjecttitle" >
                        <h5>فوائد لغوية</h5>
                    </div>
                    @foreach ($faedasubjects as $faedasubject)
                    <div class="col-lg-12 fawaedsubject">
                       <h3>{{$faedasubject->faeda_subject}}</h3>
                        <ul class="contact-list">
							<?php
                            $fawaed= $faedasubject->fawed()->selection()->get();

                            ?>
                            @foreach ($fawaed as $faeda)
                            <?php
                            $fadatxt=explode(",",$faeda->faeda);
                            ?>
                            @foreach ($fadatxt as $txt)
                            <li>{{$txt}}</li>
                            @endforeach
                            @endforeach
						</ul>
                        <p class="text-left" style="color:#404348;">فقه اللغة للثعالبي</p>
                    </div>
                    @endforeach

                </div>
                <div style="margin-top:10px">
                    {{$faedasubjects->links("pagination::bootstrap-4")}}
                    </div>
            </div>
            <!-- sidebar -->
         @include('front.fawaed.sidebar')
            <!-- sidebar end -->
        </div>
    </div>
</section>
<!-- Page end -->













@endsection
