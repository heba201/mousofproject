<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LessonRequest;
use App\Models\Lesson;
use App\Models\Lessoncategory;
use Auth;
use DB;

class LessonsController extends Controller
{
    public function index()
    {

        $lessons = Lesson::selection()->get();

        return view('admin.lessons.index', compact('lessons'));
    }
    public function create()

    {
        $lessoncategories=Lessoncategory::selection()->get();
        return view('admin.lessons.create',compact('lessoncategories'));
    }

    public function store(LessonRequest $request)
    {

        //return $request;
       try {
        if(getold('App\Models\Lesson','lesson_title',$request->lesson_title)){
            return redirect()->route('admin.lessons')->with(['error' => 'هذا الدرس  تم اضافته من قبل']);
            }

        $filePath = "";
        if ($request->has('lesson_photo')) {
            $filePath = uploadImage('lessons', $request->lesson_photo);
        }
            $lesson = Lesson::create([
                'lessoncategory_id' => $request->lessoncategory_id,
                'lesson_title' => $request->lesson_title,
                'lesson_details' => $request->lesson_details,
                'lesson_photo' => $filePath,
                'admin_id' =>Auth::user()->id,
            ]);
            return redirect()->route('admin.lessons')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
            return $ex;
        return redirect()->route('admin.lessons')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id)
    {
        try {
            $lessoncategories=Lessoncategory::selection()->get();
            $lesson = Lesson::Selection()->find($id);
            if (!$lesson)
                return redirect()->route('admin.lessons')->with(['error' => 'هذا الدرس غير موجود او ربما يكون محذوف ']);

            return view('admin.lessons.edit', compact('lesson','lessoncategories'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.lessons')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function update($id, LessonRequest $request)
    {

        try {

            $lesson = Lesson::Selection()->find($id);
            if(getresult('App\Models\Lesson','lesson_title',$request->lesson_title,'id',$id)){
                return redirect()->route('admin.lessons')->with(['error' => 'هذا الدرس تم اضافته من قبل']);
            }

            if (!$lesson)
                return redirect()->route('admin.lessons')->with(['error' => 'هذا الدرس غير موجود او ربما يكون محذوف ']);
                DB::beginTransaction();
                //photo
                if ($request->has('lesson_photo') ) {
                     $filePath = uploadImage('lessons', $request->lesson_photo);
                     $lesson::where('id', $id)
                        ->update([
                            'lesson_photo' => $filePath,
                        ]);
                }
                $data = $request->except('_token', 'id', 'lesson_photo');
                $data['admin_id']=Auth::user()->id;
                $lesson::where('id', $id)
                ->update(
                    $data
                );
                DB::commit();
            return redirect()->route('admin.lessons')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->route('admin.lessons')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }
    public function destroy($id)
    {

        try {

            $lesson = Lesson::Selection()->find($id);
            if (!$lesson)
            return redirect()->route('admin.lessons')->with(['error' => 'هذا الدرس غير موجود او ربما يكون محذوف ']);

            $lesson->delete();
            return redirect()->route('admin.lessons')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            //return $ex;
            return redirect()->route('admin.lessons')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
