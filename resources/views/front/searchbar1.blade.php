<style>
/*.search-warp{
    background:#bbbcc0;
    border: 2px solid #d82a4e;
    border-radius: 5px;
}*/

</style>
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

                    <form class="course-search-form" method="POST" action="{{route('wordsearch')}}" >
                        {{ csrf_field() }}
                        <input type="text" placeholder="ابحث عن  كلمة أو جملة"  style="text-align: right" name="search">
                        <button class="site-btn" style="background: #edf4f6;color: #474747">بحث</button>

                        <select class="form-select site-btn" aria-label="Default select example" name="mojjam_id"  dir="rtl" style="background: #edf4f6;color: #474747">
                            @foreach ($mojjams as $mojjam)
                            <option value="{{$mojjam->id}}" dir="rtl">{{$mojjam->mojjam_name}}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- search section end -->
