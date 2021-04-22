<style>

    .footer-newslatter input[type=email]
    {
        margin-left: 30px;
    }

.widget-item ul.contact-list li:after {
	position: absolute;
	content: "";
	width: 8px;
	height: 8px;
	right:-15px;
	top: 6px;
	border-radius: 50%;
	background: #d82a4e;
}
.footer-newslatter .site-btn {
    margin-right: -25px !important;
}
    </style>

<!-- footer section -->
<footer class="footer-section spad pb-0" >
    <div class="footer-top" dir="rtl">
        <div class="footer-warp" style="text-align: right">
            <div class="row">
                <div class="widget-item">
                    <h4>النشرة البريدية</h4>
                    <form class="footer-newslatter" style="text-align: right">
                        <input type="email" placeholder="البريد الالكتروني">
                        <button class="site-btn">اشترك</button>

                    </form>
                </div>
                <div class="widget-item">
                    <?php
            $mojjams =App\Models\Mojjam::selection()->get();
                    ?>
                    <h4>المعاجم العربية</h4>
                    <ul>
                    @foreach($mojjams as $mojjam)
                    <li><a href="{{route('getwordmaningmojjam',$mojjam->id)}}">{{$mojjam->mojjam_name}}</a></li>
                    @endforeach
                    </ul>
                </div>
                <div class="widget-item">
                    <h4>روابط تهمك </h4>
                    <ul>
                        <li><a href="{{route('namesmeanings')}}">معاني الأسماء</a></li>
                        <li><a href="{{route('sayings')}}">أقوال مأثورة</a></li>
                        <li><a href="#">قصص القران</a></li>
                        <li><a href="#"></a>كلمات القران</li>
                        <li><a href="#">الصحابة والتابعين</a></li>
                    </ul>
                </div>
                <div class="widget-item">
                    <h4></h4>
                    <ul>
                        <li><a href="{{route('articles')}}">مقالات</a></li>
                        <li><a href="">سؤال وجواب</a></li>
                        <li><a href="">العاب لغوية</a></li>
                        <li><a href="{{route('fawaed')}}">فوائد لغوية</a></li>
                        <li><a href="#">الشروط والأحكام</a></li>
                        <li><a href="#">سياسة الخصوصية</a></li>
                    </ul>
                </div>

                <div class="widget-item" dir="rtl">
                    <h4>معلومات الاتصال</h4>
                    <ul class="contact-list" dir="rtl">
                        <li dir="rtl">المدينة الشارع والمنطقة</li>
                        <li dir="rtl">+53 345 7953 32453</li>
                        <li dir="rtl">yourmail@gmail.com</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer section end -->
