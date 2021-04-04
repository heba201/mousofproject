<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use App\Http\Requests\ChangepasswordRequest;
use App\Models\Admin;
use App\Models\role;
use App\Models\Article;
use App\Models\Articlecategory;
use App\Models\Bayt;
use App\Models\Character;
use App\Models\Faeda;
use App\Models\Faedasubject;
use App\Models\Lesson;
use App\Models\Lessoncategory;
use App\Models\Meaning;
use App\Models\Mojjam;
use App\Models\Moradfat;
use App\Models\Namemeaning;
use App\Models\Nameorigin;
use App\Models\Poet;
use App\Models\Saying;
use App\Models\Sentence;
use App\Models\Wisdom;
use App\Models\WisdomSayingsubject;
use App\Models\Word;
use DB;
use Auth;

class AdminmanagementController extends Controller
{
    public function index()
    {

        $admins =Admin::with('role')->selection()->get();

        return view('admin.adminmanagement.index',compact('admins'));
    }
    public function create()
    {
        $roles =role::selection()->get();
        return view('admin.adminmanagement.create',compact('roles'));
    }

    public function store(AdminRequest $request)
    {
        try {


            $admin = Admin::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' =>bcrypt($request->password),
                'role_id' => $request->role_id,
            ]);



            return redirect()->route('admin.adminmanagement')->with(['success' => 'تم الحفظ بنجاح']);

        } catch (\Exception $ex) {
            return $ex;
            return redirect()->route('admin.adminmanagement')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }
    }

    public function edit($id)
    {
        try {

            $admin= Admin::Selection()->find($id);
            $roles =role::selection()->get();
            if (!$admin)
                return redirect()->route('admin.adminmanagement')->with(['error' => ' هذا المستخدم  غير موجود او ربما يكون محذوفا ']);

            return view('admin.adminmanagement.edit', compact('admin','roles'));

        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.adminmanagement')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function update($id, AdminRequest $request)
    {

        try {

                if(getresult('App\Models\Admin','name',$request->name,'id',$id)){
                    return redirect()->route('admin.adminmanagement')->with(['error' => 'هذا الاسم تم اضافته من قبل']);
                }

                $admin= Admin::Selection()->find($id);
                if (!$admin)
                return redirect()->route('admin.adminmanagement')->with(['error' => ' هذا المستخدم  غير موجود او ربما يكون محذوفا ']);

            DB::beginTransaction();
            $data = $request->except('_token', 'id', 'password','passwordconfirm');
            print_r($data);
            if ($request->has('password') && !is_null($request-> password)) {

                $data['password'] = $request->password;
            }
                $admin::where('id', $id)
                ->update([
                    'name'=> $request->name,
                    'email' =>$request->email,
                    'role_id' =>$request->role_id
                ]);
                DB::commit();
            return redirect()->route('admin.adminmanagement')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            DB::rollback();
            return $exception;
            return redirect()->route('admin.adminmanagement')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function adminroles()
           {

            $admins =Admin::with('role')->selection()->get();

            return view('admin.adminmanagement.adminroles',compact('admins'));

           }

           public function supervisor($id)
           {
               try{
            $admin= Admin::Selection()->find($id);
            if (!$admin)
                return redirect()->route('admin.adminmanagement.adminroles')->with(['error' => ' هذا المستخدم  غير موجود او ربما يكون محذوفا ']);
              $admin::where('id',$id)
              ->update([
                'role_id' => 1
            ]);
            return redirect()->route('admin.adminmanagement.adminroles')->with(['success' => 'تم التحديث بنجاح']);

           } catch(\Exception $ex){
            return redirect()->route('admin.adminmanagement.adminroles')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

           }
        }
                public function changepassword()
                {
                    return view('admin.adminmanagement.changepassword');
                }


                public function updatepassword($id,ChangepasswordRequest $request)
                {
                    {
                        try{
                     $admin= Admin::Selection()->find($id);
                     if (!$admin)
                         return redirect()->route('admin.adminmanagement.adminroles')->with(['error' => ' هذا المستخدم  غير موجود او ربما يكون محذوفا ']);
                       $admin::where('id',$id)
                       ->update([
                         'password' =>bcrypt($request->password)
                     ]);
                     return redirect()->route('admin.dashboard')->with(['success' => 'تم تغيير كلمة السر بنجاح']);

                    } catch(\Exception $ex){
                     return redirect()->route('admin.dashboard')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

                    }
                 }
                }
        public function admin($id)
        {
            try{
         $admin= Admin::Selection()->find($id);
         if (!$admin)
             return redirect()->route('admin.adminmanagement.adminroles')->with(['error' => ' هذا المستخدم  غير موجود او ربما يكون محذوفا ']);
           $admin::where('id',$id)
           ->update([
             'role_id' => 2
         ]);
         return redirect()->route('admin.adminmanagement.adminroles')->with(['success' => 'تم التحديث بنجاح']);

        } catch(\Exception $ex){
         return redirect()->route('admin.adminmanagement.adminroles')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);

        }
     }


    public function destroy($id)
    {

        try {
            $admin= Admin::Selection()->find($id);
            if (!$admin){
                return redirect()->route('admin.adminmanagement')->with(['error' => 'هذه المستخدم غير موجود ']);
            }
            $meanings = $admin->meanings();
            $articles = $admin->articles();
            $articlecategories = $admin->articlecategories();
            $abyaat = $admin->abyaat();
            $charactrs = $admin->charactrs();
            $fawaed = $admin->fawaed();
            $fawaedsubjects = $admin->fawaedsubjects();
            $lessons = $admin->lessons();
            $lessoncategories = $admin->lessoncategories();
            $mojjams = $admin->mojjams();
            $moradfat = $admin->moradfat();
            $namemeanings = $admin->namemeanings();
            $nameorigins = $admin->nameorigins();
            $poets = $admin->poets();
            $sayings = $admin->sayings();
            $sentences = $admin->sentences();
            $wisdoms = $admin->wisdoms();
            $wisdomsayingsubjects = $admin->wisdomsayingsubjects();
            $words = $admin->words();

            if ($meanings->count()>0  || $articles->count()>0 || $articlecategories->count()>0 || $abyaat->count()>0 || $charactrs->count()>0
            || $fawaed->count()>0 || $fawaedsubjects->count()>0 || $lessons->count()>0 || $lessoncategories->count()>0 || $mojjams->count()>0
            || $moradfat->count()>0  || $namemeanings->count()>0 || $nameorigins->count()>0 || $poets->count()>0 || $sayings->count()>0
            || $sentences->count()>0 || $wisdoms->count()>0 || $wisdomsayingsubjects->count()>0 || $words->count()>0 ) {


                return redirect()->route('admin.adminmanagement')->with(['error' => 'لا يمكن حذف هذا المستخدم']);

            }

            $admin->delete();
            return redirect()->route('admin.adminmanagement')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
           // return $ex;
            return redirect()->route('admin.adminmanagement')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

}
