<!-- search section -->
<?php
use App\Models\Mojjam;
$mojjams = Mojjam::selection()->get();

?>
<section class="search-section ss-other-page" dir="ltr">
    <div class="container">
        <div class="search-warp">

            <div class="row">
                <div class="col-lg-10 offset-lg-1">
                    <!-- search form -->

                    <form class="course-search-form" method="POST" action="{{route('wordsearch')}}">
                        {{ csrf_field() }}
                        <input type="text" placeholder="ابحث عن  كلمة أو جملة"  style="text-align: right" name="search">
                        <button class="site-btn" style="background: #404348">بحث</button>
                        <select name="mojjam_id" style="background:#778888;color:#fff;text-align:center;font-size:16px;font-weight:bold" dir="rtl">
                            @foreach ($mojjams as $mojjam)
                            <option value="{{$mojjam->id}}">{{$mojjam->mojjam_name}}</option>
                            @endforeach
                        </select>

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- search section end -->
