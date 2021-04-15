<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\MojjamSpecialtyRequest;
use App\Models\MojjamSpecialty;
use Auth;
use DB;

class mojjamspecialtiesController extends Controller
{
    public function index()
    {


        $mojjamspecialties =MojjamSpecialty::selection()->get();

        return view('admin.mojjamspecialties.index', compact('mojjamspecialties'));
    }

    public function create()
    {

        return view('admin.mojjamspecialties.create');
    }


    public function store(MojjamSpecialtyRequest $request)
    {

        //return $request;
       try {

          if(getold('App\Models\MojjamSpecialty','mojjam_specialty',$request->mojjam_specialty)){
          return redirect()->route('admin.mojjamspecialties')->with(['error' => 'هذا التخصص تم اضافته من قبل']);
          }
          $mojjamspecialty = MojjamSpecialty::create([
                'mojjam_specialty' => $request->mojjam_specialty,
                'admin_id' =>Auth::user()->id,
            ]);
            return redirect()->route('admin.mojjamspecialties')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.mojjamspecialties')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id)
    {
        try {

            $mojjamSpecialty= MojjamSpecialty::Selection()->find($id);
            if (!$mojjamSpecialty)
                return redirect()->route('admin.mojjamspecialties')->with(['error' => 'هذا التخصص غير موجود او ربما يكون محذوفا ']);

            return view('admin.mojjamspecialties.edit', compact('mojjamSpecialty'));

        } catch (\Exception $exception) {
            return redirect()->route('admin.mojjamspecialties')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
        public function update($id, MojjamSpecialtyRequest $request)
        {

            try {
                    $mojjamSpecialty= MojjamSpecialty::Selection()->find($id);
                    if (!$mojjamSpecialty)
                    return redirect()->route('admin.mojjamspecialties')->with(['error' => 'هذا التخصص غير موجود او ربما يكون محذوفا ']);
                    if(getresult('App\Models\MojjamSpecialty','mojjam_specialty',$request->mojjam_specialty,'id',$id)){
                        return redirect()->route('admin.mojjamspecialties')->with(['error' => 'هذا التخصص تم اضافته من قبل']);
                    }
                    if ($mojjamSpecialty) {
                    $mojjamSpecialty::where('id', $id)
                    ->update([
                'mojjam_specialty' => $request->mojjam_specialty,
                'admin_id' =>Auth::user()->id,
                    ]);
                  }
                return redirect()->route('admin.mojjamspecialties')->with(['success' => 'تم التحديث بنجاح']);
            } catch (\Exception $exception) {
                return $exception;
                return redirect()->route('admin.mojjamspecialties')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
            }

        }

        public function destroy($id)
        {

            try {
                $mojjamSpecialty= MojjamSpecialty::Selection()->find($id);
                $mojjams =  $mojjamSpecialty->mojjams();
                if (!$mojjamSpecialty)
                    return redirect()->route('admin.mojjamspecialties')->with(['error' => 'هذا التخصص غير موجود او ربما يكون محذوفا ']);
                if ($mojjams->count()>0) {
                    return redirect()->route('admin.mojjamspecialties')->with(['error' => 'لا يمكن حذف هذا التخصص']);
                }

                $mojjamSpecialty->delete();
                return redirect()->route('admin.mojjamspecialties')->with(['success' => 'تم الحذف بنجاح']);

            } catch (\Exception $ex) {
               return $ex;
                return redirect()->route('admin.mojjamspecialties')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
            }
        }
    }

