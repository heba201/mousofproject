<div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">

            <li class="nav-item active"><a href="{{route('admin.dashboard')}}"><i class="la la-mouse-pointer"></i><span
                        class="menu-title" data-i18n="nav.add_on_drag_drop.main">الرئيسية </span></a>
            </li>


            <li class="nav-item open">
                <a href=""><i class="fas fa-globe-asia"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> لغات المعاجم</span>
                    <span
                        class="badge badge badge-secondary badge-pill float-right mr-2">{{App\Models\Language::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.languages')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    @if( Auth::user()->role_id==2)
                    <li><a class="menu-item" href="{{route('admin.languages.create')}}" data-i18n="nav.dash.crypto">إضافة
                            لغة جديدة  </a>
                    </li>
                    @endif
                </ul>
            </li>




            <li class="nav-item open">
                <a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main"> مؤلفي المعاجم</span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\MojjamAuthor::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.mojjamsauthors')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    @if( Auth::user()->role_id==2)
                    <li><a class="menu-item" href="{{route('admin.mojjamsauthors.create')}}" data-i18n="nav.dash.crypto">إضافة
                            مؤلف </a>
                    </li>
                    @endif
                </ul>
            </li>


                <li class="nav-item open">
                    <a href=""><i class="fas fa-book-open"></i>
                        <span class="menu-title" data-i18n="nav.dash.main">المعاجم</span>
                        <span
                            class="badge badge badge-primary badge-pill float-right mr-2">{{App\Models\Mojjam::count()}}</span>
                    </a>
                    <ul class="menu-content">
                        <li class="active"><a class="menu-item" href="{{route('admin.mojjams')}}"
                                            data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                        </li>
                        <li class="active"><a class="menu-item" href="{{route('admin.mojjamspecialties')}}"
                            data-i18n="nav.dash.ecommerce">تخصصات المعاجم</a>
                        </li>
                        @if( Auth::user()->role_id==2)
                        <li><a class="menu-item" href="{{route('admin.mojjamspecialties.create')}}" data-i18n="nav.dash.crypto">إضافة
                            تخصص  للمعجم </a>

                        </li>
                        @endif
                        <li class="active"><a class="menu-item" href="{{route('admin.mojjamarrangetypes')}}"
                            data-i18n="nav.dash.ecommerce">  أنواع ترتيب المعجم </a>
                        </li>
                        @if( Auth::user()->role_id==2)
                        <li class="active"><a class="menu-item" href="{{route('admin.mojjamarrangetypes.create')}}"
                            data-i18n="nav.dash.ecommerce">  إضافة نوع ترتيب للمعجم </a>
                        </li>
                        @endif

                        <li class="active"><a class="menu-item" href="{{route('admin.mojjammethods')}}"
                            data-i18n="nav.dash.ecommerce"> مناهج المعجم </a>
                        </li>
                        @if( Auth::user()->role_id==2)
                        <li class="active"><a class="menu-item" href="{{route('admin.mojjammethods.create')}}"
                            data-i18n="nav.dash.ecommerce"> إضافة منهج للمعجم </a>
                        </li>
                        <li><a class="menu-item" href="{{route('admin.mojjams.create')}}" data-i18n="nav.dash.crypto">إضافة
                            معجم  جديد </a>
                        </li>
                        @endif
                    </ul>
                </li>




{{--
                <li class="nav-item"><a href=""><i class="fas fa-folder-open"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">جذور الكلمات</span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\Wordgazer::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.wordgazer')}}"
                                        data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    @if( Auth::user()->role_id==2)

                    <li><a class="menu-item" href="{{route('admin.wordgazer.create',1)}}" data-i18n="nav.dash.crypto">إضافة
                        جذر </a>
                </li>

                    @endif
                </ul>
            </li> --}}


            <li class="nav-item"><a href=""><i class="fas fa-folder-open"></i>
                <span class="menu-title" data-i18n="nav.dash.main"> أنواع جذور الكلمات</span>
                <span
                    class="badge badge badge-success badge-pill float-right mr-2">{{App\Models\Gazertype::count()}}</span>
            </a>
            <ul class="menu-content">
                <li class="active"><a class="menu-item" href="{{route('admin.gazertype')}}"
                                    data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                </li>
                @if( Auth::user()->role_id==2)

                <li><a class="menu-item" href="{{route('admin.gazertype.create')}}" data-i18n="nav.dash.crypto">إضافة
                نوع جذر </a>
            </li>


                @endif
            </ul>
        </li>


        <li class="nav-item"><a href=""><i class="fas fa-folder-open"></i>
            <span class="menu-title" data-i18n="nav.dash.main"> أوزان  جذور الكلمات</span>
            <span
                class="badge badge badge-secondary badge-pill float-right mr-2">{{App\Models\Gazerweight::count()}}</span>
        </a>
        <ul class="menu-content">
            <li class="active"><a class="menu-item" href="{{route('admin.gazerweight')}}"
                                data-i18n="nav.dash.ecommerce"> عرض الكل </a>
            </li>
            @if( Auth::user()->role_id==2)

            <li><a class="menu-item" href="{{route('admin.gazerweight.create')}}" data-i18n="nav.dash.crypto">إضافة
            وزن جذر </a>
        </li>


            @endif
        </ul>
    </li>


    <li class="nav-item"><a href=""><i class="fas fa-folder-open"></i>
        <span class="menu-title" data-i18n="nav.dash.main">دلالات أوزان  جذور الكلمات</span>
        <span
            class="badge badge badge-warning badge-pill float-right mr-2">{{App\Models\Weightindication::count()}}</span>
    </a>
    <ul class="menu-content">
        <li class="active"><a class="menu-item" href="{{route('admin.weightindication')}}"
                            data-i18n="nav.dash.ecommerce"> عرض الكل </a>
        </li>
        @if( Auth::user()->role_id==2)

        <li><a class="menu-item" href="{{route('admin.weightindication.create')}}" data-i18n="nav.dash.crypto">إضافة
        دلالة وزن  </a>
    </li>


        @endif
    </ul>
    </li>

    <li class="nav-item"><a href=""><i class="fas fa-folder-open"></i>
        <span class="menu-title" data-i18n="nav.dash.main">   أزمنة الكلمات</span>
        <span
            class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\Time::count()}}</span>
    </a>
    <ul class="menu-content">
        <li class="active"><a class="menu-item" href="{{route('admin.time')}}"
                            data-i18n="nav.dash.ecommerce"> عرض الكل </a>
        </li>
        @if( Auth::user()->role_id==2)

        <li><a class="menu-item" href="{{route('admin.time.create')}}" data-i18n="nav.dash.crypto">إضافة
        زمن  </a>
    </li>


        @endif
    </ul>
    </li>


        <li class="nav-item"><a href=""><i class="fas fa-folder-open"></i>
            <span class="menu-title" data-i18n="nav.dash.main">   مصادر الكلمات</span>
            <span
                class="badge badge badge-success badge-pill float-right mr-2">{{App\Models\Source::count()}}</span>
        </a>
        <ul class="menu-content">
            <li class="active"><a class="menu-item" href="{{route('admin.source')}}"
                                data-i18n="nav.dash.ecommerce"> عرض الكل </a>
            </li>
            @if( Auth::user()->role_id==2)

            <li><a class="menu-item" href="{{route('admin.source.create')}}" data-i18n="nav.dash.crypto">إضافة
            مصدر للكلمة  </a>
        </li>


            @endif
        </ul>
        </li>

        <li class="nav-item"><a href=""><i class="fas fa-folder-open"></i>
            <span class="menu-title" data-i18n="nav.dash.main">   الدلالات الأصلية للكلمات</span>
            <span
                class="badge badge badge-primary badge-pill float-right mr-2">{{App\Models\Wordindication::count()}}</span>
        </a>
        <ul class="menu-content">
            <li class="active"><a class="menu-item" href="{{route('admin.wordindication')}}"
                                data-i18n="nav.dash.ecommerce"> عرض الكل </a>
            </li>
            @if( Auth::user()->role_id==2)

            <li><a class="menu-item" href="{{route('admin.wordindication.create')}}" data-i18n="nav.dash.crypto">إضافة
            دلالة أصلية  للكلمة  </a>
        </li>


            @endif
        </ul>
        </li>


            <li class="nav-item"><a href=""><i class="fas fa-file-word"></i>
                <span class="menu-title" data-i18n="nav.dash.main">الكلمات</span>
                <span
                    class="badge badge badge-warning badge-pill float-right mr-2">{{App\Models\Word::count()}}</span>
            </a>
            <ul class="menu-content">
                <li class="active"><a class="menu-item" href="{{route('admin.words')}}"
                                      data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                </li>
                {{-- @if( Auth::user()->role_id==2)

                <li><a class="menu-item" href="{{route('admin.words.create',1)}}" data-i18n="nav.dash.crypto">إضافة
                        كلمة </a>
                </li>
                @endif --}}
            </ul>
        </li>

            <li class="nav-item  open ">
                <a href=""><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">المعاني</span>
                    <span
                        class="badge badge badge-success badge-pill float-right mr-2">{{App\Models\Meaning::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.meanings')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  open ">
                <a href=""><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">مرادفات</span>
                    <span
                        class="badge badge badge-light badge-pill float-right mr-2">{{App\Models\Moradfat::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.moradfat')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item  open ">
                <a href=""><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">أضداد</span>
                    <span
                        class="badge badge badge-light badge-pill float-right mr-2">{{App\Models\Modad::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.modad')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                </ul>
            </li>
            

            <li class="nav-item  open ">
                <a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الشعراء</span>
                    <span
                        class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\Poet::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.poets')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    @if( Auth::user()->role_id==2)
                    <li><a class="menu-item" href="{{route('admin.poets.create')}}" data-i18n="nav.dash.crypto">إضافة
                        شاعر </a>
                </li>
                @endif
                </ul>
            </li>

            <li class="nav-item  open ">
                <a href=""><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الأبيات الشعرية</span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{App\Models\Bayt::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.abyaat')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item  open ">
                <a href=""><i class="la la-home"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الجمل السياقية</span>
                    <span
                        class="badge badge badge-secondary badge-pill float-right mr-2">{{App\Models\Sentence::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.sentences')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item"><a href=""><i class="la la-home"></i>
                <span class="menu-title" data-i18n="nav.dash.main">الفوائد اللغوية</span>
                <span
                    class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\Faeda::count()}}</span>
            </a>
            <ul class="menu-content">
                <li class="active"><a class="menu-item" href="#"
                                      data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                </li>
                <li><a class="menu-item" href="{{route('admin.fawaed')}}" data-i18n="nav.dash.crypto">كل
                      الفوائد اللغوية   </a>
         </li>
         @if( Auth::user()->role_id==2)
         <li><a class="menu-item" href="{{route('admin.fawaed.create')}}" data-i18n="nav.dash.crypto">إضافة
                 فائدة لغوية جديدة</a>
        </li>
        @endif
                <li><a class="menu-item" href="{{route('admin.fawaedsubjects')}}" data-i18n="nav.dash.crypto">كل
                    موضوعات  الفوائد اللغوية   </a>
         </li>
         @if( Auth::user()->role_id==2)
         <li><a class="menu-item" href="{{route('admin.fawaedsubjects.create')}}" data-i18n="nav.dash.crypto">إضافة
                     موضوعات الفوائد اللغوية   </a>
          </li>
          @endif
            </ul>
        </li>

            <li class="nav-item"><a href=""><i class="fas fa-quote-right"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الحكم والأمثال</span>
                    <span
                        class="badge badge badge-danger badge-pill float-right mr-2">{{App\Models\Wisdom::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.wisdoms')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    <li><a class="menu-item" href="{{route('admin.wisdomsayingsubjects')}}" data-i18n="nav.dash.crypto">كل
                        مواضيع الحكم والأمثال   </a>
             </li>
             @if( Auth::user()->role_id==2)
                    <li><a class="menu-item" href="{{route('admin.wisdomsayingsubjects.create')}}" data-i18n="nav.dash.crypto">إضافة
                         مواضيع الحكم والأمثال   </a>
              </li>

                    <li><a class="menu-item" href="{{route('admin.wisdoms.create')}}" data-i18n="nav.dash.crypto">إضافة
                              حكمة أو مثل  </a>
                    </li>
                    @endif
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="la la-group"></i>
                    <span class="menu-title" data-i18n="nav.dash.main">الشخصيات</span>
                    <span
                        class="badge badge badge-warning badge-pill float-right mr-2">{{App\Models\Character::count()}}</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a class="menu-item" href="{{route('admin.characters')}}"
                                          data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                    </li>
                    @if( Auth::user()->role_id==2)
                    <li><a class="menu-item" href="{{route('admin.characters.create')}}" data-i18n="nav.dash.crypto">إضافة
                           شخصية جديدة</a>
                    </li>
                    @endif
                </ul>
            </li>

            <li class="nav-item"><a href=""><i class="fas fa-quote-right"></i>
                <span class="menu-title" data-i18n="nav.dash.main">الأقوال المأثورة</span>
                <span
                    class="badge badge badge-primary badge-pill float-right mr-2">{{App\Models\Saying::count()}}</span>
            </a>
            <ul class="menu-content">
                <li class="active"><a class="menu-item" href="{{route('admin.sayings')}}"
                                      data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                </li>
            </ul>
        </li>

            <li class="nav-item"><a href=""><i class="la la-home"></i>
                <span class="menu-title" data-i18n="nav.dash.main">أصول الأسماء</span>
                <span
                    class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\Nameorigin::count()}}</span>
            </a>
            <ul class="menu-content">
                <li class="active"><a class="menu-item" href="{{route('admin.namesorigins')}}"
                                      data-i18n="nav.dash.ecommerce"> عرض كل أصول الأسماء </a>
                </li>
                @if( Auth::user()->role_id==2)
                <li><a class="menu-item" href="{{route('admin.namesorigins.create')}}" data-i18n="nav.dash.crypto">إضافة
                       أصل اسم</a>
                </li>
                @endif
            </ul>
        </li>
            <li class="nav-item"><a href=""><i class="la la-home"></i>
                <span class="menu-title" data-i18n="nav.dash.main">معاني الأسماء</span>
                <span
                    class="badge badge badge-success badge-pill float-right mr-2">{{App\Models\Namemeaning::count()}}</span>
            </a>
            <ul class="menu-content">
                <li class="active"><a class="menu-item" href="{{route('admin.namesmeanings')}}"
                                      data-i18n="nav.dash.ecommerce"> عرض كل معاني الأسماء </a>
                </li>
                @if( Auth::user()->role_id==2)
                <li><a class="menu-item" href="{{route('admin.namesmeanings.create')}}" data-i18n="nav.dash.crypto">إضافة
                       معني اسم</a>
                </li>
                @endif
            </ul>
        </li>




            <li class="nav-item"><a href=""><i class="fas fa-layer-group"></i>
                <span class="menu-title" data-i18n="nav.dash.main">تصنيفات المقالات</span>
                <span
                    class="badge badge badge-dark badge-pill float-right mr-2">{{App\Models\Articlecategory::count()}}</span>
            </a>
            <ul class="menu-content">
                <li class="active"><a class="menu-item" href="{{route('admin.articlecategories')}}"
                                      data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                </li>
                @if( Auth::user()->role_id==2)
                <li><a class="menu-item" href="{{route('admin.articlecategories.create')}}" data-i18n="nav.dash.crypto">إضافة
                        تصنيف جديد</a>
                </li>
                @endif
            </ul>
        </li>
            <li class="nav-item"><a href=""><i class="far fa-newspaper"></i>
                <span class="menu-title" data-i18n="nav.dash.main">المقالات</span>
                <span
                    class="badge badge badge-light badge-pill float-right mr-2">{{App\Models\Article::count()}}</span>
            </a>
            <ul class="menu-content">
                <li class="active"><a class="menu-item" href="{{route('admin.articles')}}"
                                      data-i18n="nav.dash.ecommerce"> عرض الكل </a>
                </li>
                @if( Auth::user()->role_id==2)
                <li><a class="menu-item" href="{{route('admin.articles.create')}}" data-i18n="nav.dash.crypto">إضافة
                        مقال جديد</a>
                </li>
                @endif
            </ul>
        </li>
        <li class="nav-item"><a href=""><i class="fas fa-layer-group"></i>
            <span class="menu-title" data-i18n="nav.dash.main">تصنيفات الدروس</span>
            <span
                class="badge badge badge-info badge-pill float-right mr-2">{{App\Models\Lessoncategory::count()}}</span>
        </a>
        <ul class="menu-content">
            <li class="active"><a class="menu-item" href="{{route('admin.lessoncategories')}}"
                                  data-i18n="nav.dash.ecommerce"> عرض الكل </a>
            </li>
            @if( Auth::user()->role_id==2)
            <li><a class="menu-item" href="{{route('admin.lessoncategories.create')}}" data-i18n="nav.dash.crypto">إضافة
                    تصنيف جديد</a>
            </li>
            @endif
        </ul>
    </li>
    <li class="nav-item"><a href=""><i class="fas fa-sticky-note"></i>
        <span class="menu-title" data-i18n="nav.dash.main"> الدروس</span>
        <span
            class="badge badge badge-success badge-pill float-right mr-2">{{App\Models\Lesson::count()}}</span>
    </a>
    <ul class="menu-content">
        <li class="active"><a class="menu-item" href="{{route('admin.lessons')}}"
                              data-i18n="nav.dash.ecommerce"> عرض الكل </a>
        </li>
        @if( Auth::user()->role_id==2)
        <li><a class="menu-item" href="{{route('admin.lessons.create')}}" data-i18n="nav.dash.crypto">إضافة
                درس جديد</a>
        </li>
        @endif
    </ul>
</li>
@if( Auth::user()->role_id==2)
<li class="nav-item"><a href=""><i class="fas fa-tasks"></i>
    <span class="menu-title" data-i18n="nav.dash.main"> إدارة الموقع</span>
    <span
        class="badge badge badge-warning badge-pill float-right mr-2">{{App\Models\Admin::count()}}</span>
</a>
<ul class="menu-content">
    <li class="active"><a class="menu-item" href="{{route('admin.adminmanagement')}}"
                          data-i18n="nav.dash.ecommerce"> عرض المستخدمين </a>
    </li>
    <li><a class="menu-item" href="{{route('admin.adminmanagement.create')}}" data-i18n="nav.dash.crypto">إضافة
            مستخدم جديد</a>
    </li>
    <li><a class="menu-item" href="{{route('admin.adminmanagement.adminroles')}}" data-i18n="nav.dash.crypto">
         صلاحيات المستخدمين</a>
</li>
</ul>
</li>
@endif
        </ul>
    </div>
</div>
