<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\WisdomRequest;
use App\Models\Wisdom;
use App\Models\WisdomSayingsubject;
use App\Models\Character;
use Illuminate\Support\Str;
use Auth;
use DB;

class WisdomsController extends Controller
{
    public function index()
    {

        $wisdoms =Wisdom::selection()->get();
        $wisdomSayingsubjects=WisdomSayingsubject::selection()->get();

        return view('admin.wisdoms.index', compact('wisdoms','wisdomSayingsubjects'));
    }
    public function create()
    {
        $wisdomSayingsubjects=WisdomSayingsubject::selection()->get();
        $characters=Character::selection()->get();
        return view('admin.wisdoms.create',compact('wisdomSayingsubjects','characters'));
    }

    public function store(WisdomRequest $request)
    {

        //return $request;
       try {

        if(getold('App\Models\Wisdom','wisdom',$request->wisdom)){
            return redirect()->route('admin.wisdoms')->with(['error' => 'هذه الحكمة/المثل  تم اضافتها من قبل']);
            }
            $filePath = "";
            if ($request->has('wisdom_photo')) {
                $filePath = uploadImage('wisdoms', $request->wisdom_photo);
            }

            if(isset($_POST["wisdom_tag"]) && is_array($_POST["wisdom_tag"])){
                $wisdomtag= implode(", ", $_POST["wisdom_tag"]);
            }
            else{
                $wisdomtag=$request->wisdom_tag;
            }
        $wisdom = Wisdom::create([
                'wisdom' => $request->wisdom,
                'wisdom_type' => $request->wisdom_type,
                'admin_id' =>Auth::user()->id,
                'wisdomsayingsubject_id'=>$request->wisdom_subject,
                'character_id'=>$request->character_id,
                'wisdom_photo' => $filePath,
                'wisdom_tag' =>$wisdomtag
            ]);
            return redirect()->route('admin.wisdoms')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.wisdoms')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id)
    {
        try {

            $wisdom= Wisdom::Selection()->find($id);
            $wisdomSayingsubjects=WisdomSayingsubject::selection()->get();
            $characters=Character::selection()->get();
            $wisdomtags=explode(",",$wisdom->wisdom_tag);
            if (!$wisdom)
                return redirect()->route('admin.wisdoms')->with(['error' => 'هذه الحكمة غير موجودة او ربما تكون محذوفة ']);

            return view('admin.wisdoms.edit', compact('wisdom','wisdomSayingsubjects','characters','wisdomtags'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.wisdoms')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function update($id, WisdomRequest $request)
    {

        try {

            $wisdom= Wisdom::Selection()->find($id);
            if(getresult('App\Models\Wisdom','wisdom',$request->wisdom,'id',$id)){
                return redirect()->route('admin.wisdoms')->with(['error' => 'هذه الكلمة/المثل تم اضافتها من قبل']);
            }
            if (!$wisdom){
                return redirect()->route('admin.wisdoms')->with(['error' => 'هذه الحكمة غير موجودة او ربما تكون محذوفة ']);
            }
            DB::beginTransaction();
            //photo
            if ($request->has('wisdom_photo') ) {
                $filePath = uploadImage('wisdoms', $request->wisdom_photo);
                $wisdom::where('id', $id)
                ->update([
                    'wisdom_photo' => $filePath,
                ]);
            }
            $data = $request->except('_token', 'id', 'wisdom_photo','wisdom_tag','wisdom_subject');

            if(isset($_POST["wisdom_tag"]) && is_array($_POST["wisdom_tag"])){
                $wisdomtag= implode(", ", $_POST["wisdom_tag"]);
            }
            else{
                $wisdomtag=$request->wisdom_tag;
            }
            $data['wisdom_tag']=$wisdomtag;
            $data['wisdomsayingsubject_id']=$request->wisdom_subject;
            $data['admin_id']=Auth::user()->id;
            $wisdom::where('id', $id)
            ->update(
                $data
            );
            DB::commit();
              return redirect()->route('admin.wisdoms')->with(['success' => 'تم التحديث بنجاح']);
            } catch (\Exception $exception) {
                return $exception;
                DB::rollback();
                return redirect()->route('admin.wisdoms')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
            }

    }
    public function show($id)
    {
        try {

            $wisdom= Wisdom::Selection()->find($id);
            $wisdomSayingsubjects=WisdomSayingsubject::selection()->get();
            $characters=Character::selection()->get();
            $wisdomtags=explode(",",$wisdom->wisdom_tag);
            if (!$wisdom)
                return redirect()->route('admin.wisdoms')->with(['error' => 'هذه الحكمة غير موجودة او ربما تكون محذوفة ']);

            return view('admin.wisdoms.show', compact('wisdom','wisdomSayingsubjects','characters','wisdomtags'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.wisdoms')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
    public function destroy($id)
    {

        try {
            $wisdom= Wisdom::Selection()->find($id);
            if (!$wisdom){
                return redirect()->route('admin.wisdoms')->with(['error' => 'هذه الحكمة غير موجودة او ربما تكون محذوفة ']);
            }
            $image = Str::after($wisdom->wisdom_photo, 'assets/');
            //$image = base_path('assets/' . $image);
            $image='assets/' . $image;
            unlink($image); //delete photo from folder
            $wisdom->delete();
            return redirect()->route('admin.wisdoms')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
         return $ex;
            return redirect()->route('admin.wisdoms')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
