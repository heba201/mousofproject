@extends('front.layout')
@push('style')
    <style>
.subjecttitle {


 }
/* Style The Dropdown Button */
.dropbtn {
  background-color: #4CAF50;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content (Hidden by Default) */
.dropdown-content {
  display: none;
   position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index:999;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;

}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #f1f1f1}

/* Show the dropdown menu on hover */
.dropdown:hover .dropdown-content {
  display: block;

}

/* Change the background color of the dropdown button when the dropdown content is shown */
.dropdown:hover .dropbtn {
  background-color: #3e8e41;
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
                            <div class="dropdown">
                                <button class="dropbtn">سور القرآن الكريم</button>
                                <div class="dropdown-content">
                                    @foreach ($surahs as $surah)
                                  <a href="#">{{$surah['name']}}</a>
                                  @endforeach
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
