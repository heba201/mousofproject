@extends('front.layout')
@push('style')
    <style>
.subjecttitle .select2 .op{
    bottom:100%;
 }
        </style>
@endpush
@section('content')
<!-- search section -->
@include('front.quraanwords.searchbar')
<!-- search section end -->

<!-- Page -->
<section class="contact-page spad pb-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="contact-form-warp sub">
                    <div class="section-title text-white text-right subjecttitle" >
                        <div class="col-md-6" style="margin: auto">
                            <select name="surah_index" class="select2 form-control" id="selectId" dir="rtl"  data-dropup-auto="false">
                                <optgroup label="">
                                    @foreach ($surahs as $surah)
                                    <option value="" class="op">{{$surah['name']}}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                        </div>
                        <div class="navbar">
                            <a href="#home">Home</a>
                            <a href="#news">News</a>
                            <div class="dropdown">
                              <button class="dropbtn">Dropdown
                                <i class="fa fa-caret-down"></i>
                              </button>
                              <div class="dropdown-content">
                                <a href="#">Link 1</a>
                                <a href="#">Link 2</a>
                                <a href="#">Link 3</a>
                              </div>
                            </div>
                          </div>


                    </div>
                    <div class="col-lg-12 fawaedsubject">
                       <h3>كلمات القرآن</h3>
                        <ul class="contact-list">
                            <li>نمنمننممنمنمن</li>
						</ul>
                    </div>
                </div>
            </div>
            <!-- sidebar -->
         @include('front.quraanwords.sidebar')
            <!-- sidebar end -->
        </div>
    </div>
</section>
<!-- Page end -->













@endsection
