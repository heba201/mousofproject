<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SayingRequest;
use App\Http\Requests\SayingeditRequest;
use App\Models\Saying;
use App\Models\Character;
use App\Models\WisdomSayingsubject;
use Auth;
use DB;
use Str;
class sayingsController extends Controller
{

    public function index()
    {
        $sayings=Saying::with('character','saysubject')->selection()->get();
        return view('admin.sayings.index', compact('sayings'));
    }

    public function addsaying($id)
    {

        $character=Character::Selection()->find($id);
        $wisdomSayingsubjects=WisdomSayingsubject::selection()->get();
        return view('admin.sayings.create', compact('character','wisdomSayingsubjects'));
    }

    public function createforcharacter(SayingRequest $request,$id)
    {
        $character=Character::Selection()->find($id);

        try{
            if (!$character)
            return redirect()->route('admin.characters')->with(['error' => 'هذه الشخصية غير موجودة او ربما تكون محذوفة ']);
            if (isset($_POST["saying"]) && is_array($_POST["saying"])) {
                foreach( $request->saying as $key=>$val)
                {
                    if(getold('App\Models\Saying','saying',$request->saying)){
                        return redirect()->route('admin.characters')->with(['error' => 'هذا القول تم اضافته من قبل']);
                        }
                }
            }

            $filePath = "";
        if ($request->has('saying_photo')) {
            $filePath = uploadImage('sayings', $request->saying_photo);
        }

        if(isset($_POST["saying_tag"]) && is_array($_POST["saying_tag"])){
            $sayingtag= implode(", ", $_POST["saying_tag"]);
        }
        else{
            $sayingtag=$request->saying_tag;
        }
            if (isset($_POST["saying"]) && is_array($_POST["saying"])) {
            foreach( $request->saying as $key=>$val)
            {
                $saying = Saying::create(['saying' => $val,
                                             'character_id' =>$character->id,
                                             'admin_id' => Auth::user()->id,
                                               'wisdomsayingsubject_id'=>$request->saying_subject,
                                               'saying_photo'=>$filePath,
                                               'saying_tag' => $sayingtag
                                             ]);
             }
             return redirect()->route('admin.characters')->with(['success' => 'تم الحفظ بنجاح']);
        }
    }
        catch(\Exception $ex)
        {
           return  $ex;
            return redirect()->route('admin.characters')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

}
        public function editsaying($id)
        {
            try {

                $saying= Saying::Selection()->find($id);
                $sayingtags=explode(",",$saying->saying_tag);
                $characters = Character::selection()->get();
                $wisdomSayingsubjects=WisdomSayingsubject::selection()->get();
                if (!$saying)
                    return redirect()->route('admin.sayings')->with(['error' => 'هذه القول غير موجود او ربما يكون محذوف ']);

                return view('admin.sayings.edit', compact('saying','characters','wisdomSayingsubjects','sayingtags'));

            } catch (\Exception $exception) {
                return redirect()->route('admin.sayings')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
            }
        }

        public function updatesaying($id,SayingeditRequest $request)
        {
            try {

                $saying= Saying::Selection()->find($id);
                if(getresult('App\Models\Saying','saying',$request->saying,'id',$id)){
                    return redirect()->route('admin.sayings')->with(['error' => 'هذه القول تم اضافته من قبل']);
                }
                if (!$saying){
                    return redirect()->route('admin.sayings')->with(['error' => 'هذا القول غير موجود او ربما يكون محذوف ']);
                }
                DB::beginTransaction();
                //photo
                if ($request->has('saying_photo') ) {
                    $filePath = uploadImage('sayings', $request->saying_photo);
                    $saying::where('id', $id)
                    ->update([
                        'saying_photo' => $filePath,
                    ]);
                }
                $data = $request->except('_token', 'id', 'saying_photo','saying_tag','saying_subject','character_id');

                if(isset($_POST["saying_tag"]) && is_array($_POST["saying_tag"])){
                    $sayingtag= implode(", ", $_POST["saying_tag"]);
                }
                else{
                    $sayingtag=$request->saying_tag;
                }
                $data['saying_tag']=$sayingtag;
                $data['wisdomsayingsubject_id']=$request->saying_subject;
                $data['character_id']=$request->character_id;
                $data['admin_id']=Auth::user()->id;
                $saying::where('id', $id)
                ->update(
                    $data
                );
                DB::commit();
                  return redirect()->route('admin.sayings')->with(['success' => 'تم التحديث بنجاح']);
                } catch (\Exception $exception) {
                    return $exception;
                    DB::rollback();
                    return redirect()->route('admin.sayings')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
                }
        }

        public function destroy($id)
        {

            try {
                $saying= Saying::Selection()->find($id);
                if (!$saying){
                    return redirect()->route('admin.sayings')->with(['error' => 'هذا القول غير موجود او ربما يكون محذوف ']);
                }
                $image = Str::after($saying->saying_photo, 'assets/');
                //$image = base_path('assets/' . $image);
                $image='assets/' . $image;
                unlink($image); //delete photo from folder
                $saying->delete();
                return redirect()->route('admin.sayings')->with(['success' => 'تم الحذف بنجاح']);

            } catch (\Exception $ex) {
             return $ex;
                return redirect()->route('admin.sayings')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
            }
        }
}
