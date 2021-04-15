<?php

namespace App\Http\Controllers\Admin;
use App\Models\MojjamAuthor;
use App\Http\Requests\MojjamAuthorRequest;
use Auth;
use DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class mojjamsauthorsController extends Controller
{
    public function index()
    {

        $mojjamauthors = MojjamAuthor::selection()->get();

        return view('admin.mojjamsauthors.index', compact('mojjamauthors'));
    }

    public function create()
    {
        return view('admin.mojjamsauthors.create');
    }

    public function store(MojjamAuthorRequest $request)
    {

        //return $request;
       try {

          if(getold('App\Models\MojjamAuthor','author_name',$request->author_name)){
          return redirect()->route('admin.mojjamsauthors')->with(['error' => 'هذا المؤلف تم اضافته من قبل']);
          }
          $mojjamauthor = MojjamAuthor::create([
                'author_name' => $request->author_name,
                'about_author' => $request->about_author,
                'admin_id' =>Auth::user()->id,
            ]);
            return redirect()->route('admin.mojjamsauthors')->with(['success' => 'تم الحفظ بنجاح']);
       }
       catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.mojjamsauthors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }

    }

    public function edit($id)
    {
        try {


            $mojjamauthor= MojjamAuthor::Selection()->find($id);

            if (!$mojjamauthor)
                return redirect()->route('admin.mojjamsauthors')->with(['error' => 'هذا المؤلف غير موجود او ربما يكون محذوفا ']);

            return view('admin.mojjamsauthors.edit', compact('mojjamauthor'));

        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.mojjamsauthors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }

    public function update($id, MojjamAuthorRequest $request)
    {

        try {
                $mojjamauthor= MojjamAuthor::Selection()->find($id);
                if (!$mojjamauthor){
                return redirect()->route('admin.mojjamsauthors')->with(['error' => 'هذاالمؤلف غير موجود او ربما يكون محذوفا ']);
            }

            if(getresult('App\Models\MojjamAuthor','author_name',$request->author_name,'id',$id)){
                return redirect()->route('admin.mojjamsauthors')->with(['error' => 'هذا المؤلف تم اضافته من قبل']);
            }
              if ($mojjamauthor) {
                $mojjamauthor::where('id', $id)
                ->update([
                    'author_name' => $request->author_name,
                    'about_author' => $request->about_author,
                    'admin_id' =>Auth::user()->id,
                ]);
              }
            return redirect()->route('admin.mojjamsauthors')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $exception) {
            return $exception;
            return redirect()->route('admin.mojjamsauthors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }

    }

    public function destroy($id)
    {

        try {
            $mojjamauthor= MojjamAuthor::Selection()->find($id);
            $mojjams = $mojjamauthor->mojjams();

            if (!$mojjamauthor){
                return redirect()->route('admin.mojjamsauthors')->with(['error' => 'هذا المؤلف غير موجود ']);
            }
            if ($mojjams->count()>0) {
                return redirect()->route('admin.mojjamsauthors')->with(['error' => 'لا يمكن حذف هذا المؤلف']);
            }

            $mojjamauthor->delete();
            return redirect()->route('admin.mojjamsauthors')->with(['success' => 'تم الحذف بنجاح']);

        } catch (\Exception $ex) {
           return $ex;
            return redirect()->route('admin.mojjamsauthors')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
        }
    }
}
