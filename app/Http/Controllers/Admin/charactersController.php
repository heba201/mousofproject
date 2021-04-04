<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CharacterRequest;
use App\Models\Character;
use App\Models\Saying;
use App\Models\Wisdom;
use Illuminate\Support\Str;
use Auth;
use DB;


class charactersController extends Controller
{
    public function index()
    {

        $characters = Character::selection()->get();

        return view('admin.characters.index', compact('characters'));
    }
    public function create()
    {
        return view('admin.characters.create');
    }

    public function store(CharacterRequest $request)
    {

        //return $request;
       try {

        if(getold('App\Models\Character','character_name',$request->character_name)){
            return redirect()->route('admin.characters')->with(['error' => 'هذه الشخصية تم اضافتها من قبل']);
            }
            $filePath = "";
            if ($request->has('character_photo')) {
                $filePath = uploadImage('characters', $request->character_photo);
            }
            $character = Character::create([
                'character_name' => $request->character_name,
                'about_character' => $request->about_character,
                'character_type' => $request->character_type,
                'admin_id' =>Auth::user()->id,
                'character_photo' =>$filePath
            ]);
            return redirect()->route('admin.characters')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
            return redirect()->route('admin.characters')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id)
    {
        try {

            $character= Character::Selection()->find($id);
            if (!$character)
                return redirect()->route('admin.characters')->with(['error' => 'هذه الشخصية غير موجودة او ربما تكون محذوفة ']);

            return view('admin.characters.edit', compact('character'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.characters')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function update($id, CharacterRequest $request)
    {

        try {

            $character= Character::Selection()->find($id);
            if(getresult('App\Models\Character','character_name',$request->character_name,'id',$id)){
                return redirect()->route('admin.characters')->with(['error' => 'هذه الشخصية تم اضافتها من قبل']);
            }
            if (!$character){
                return redirect()->route('admin.characters')->with(['error' => 'هذه الشخصية غير موجودة او ربما تكون محذوفة ']);
            }
            DB::beginTransaction();
            //photo
            if ($request->has('character_photo') ) {
                 $filePath = uploadImage('characters', $request->character_photo);
                 $character::where('id', $id)
                    ->update([
                        'character_photo' => $filePath,
                    ]);
            }
            $data = $request->except('_token', 'id', 'character_photo');
            $data['admin_id']=Auth::user()->id;
            $character::where('id', $id)
            ->update(
                $data
            );
            DB::commit();

            return redirect()->route('admin.characters')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            DB::rollback();
            return redirect()->route('admin.characters')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }
    public function show($id)
    {
        try {

            $character= Character::Selection()->find($id);

            if (!$character)
                return redirect()->route('admin.characters')->with(['error' => 'هذه الشخصية غير موجودة او ربما تكون محذوفة ']);

            return view('admin.characters.show', compact('character'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.characters')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
    public function destroy($id)
    {

        try {
            $character= Character::Selection()->find($id);
            if (!$character){
                return redirect()->route('admin.characters')->with(['error' => 'هذه الشخصية غير موجودة ']);
            }
            $saying=Saying::where('character_id', $id);
            $wisdoms=Wisdom::where('character_id', $id);
            if ($saying->count() >0 || $wisdoms->count() >0) {
                return redirect()->route('admin.characters')->with(['error' => 'لا يمكن حذف هذه الشخصية']);
            }
            $image = Str::after($character->character_photo, 'assets/');
            // $image = base_path('assets/' . $image);
            $image ='assets/' . $image;
             unlink($image); //delete from folder
            $character->delete();
            return redirect()->route('admin.characters')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
            //return $ex;
            return redirect()->route('admin.characters')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
