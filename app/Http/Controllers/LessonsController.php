<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lesson;
use App\Models\Lessoncategory;

class LessonsController extends Controller
{
    public function index()
    {
        $lessons = Lesson::selection()->paginate(PAGINATION_COUNT);

        return view('front.lessons.lessons',compact('lessons','lessoncategory'));
    }
    public function lessonshow($id){

            try {
                $lesson = Lesson::Selection()->find($id);
                $lessoncategories=Lessoncategory::selection()->get();
                if (!$lesson)
                return redirect()->route('home')->with(['error' => 'هذا الدرس غير موجود او ربما يكون محذوف ']);
                return view('front.lessons.lessondetails',compact('lesson','lessoncategories'));
            }

         catch (\Exception $exception) {
            return redirect()->route('home')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }

    }
}
