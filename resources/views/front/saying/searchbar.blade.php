<!-- search section -->
<section class="search-section ss-other-page" dir="ltr">
    <div class="container">
        <div class="search-warp">

            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <!-- search form -->
                    <form class="course-search-form" method="POST" action="{{route('sayingsearch')}}">
                        {{ csrf_field() }}
                        <input type="text" placeholder="ابحث عن قول مأثور"  style="text-align: right" name="search">

                        <button class="site-btn" style="background: #404348">بحث</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- search section end -->
