<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginuserRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;

class LoginController extends Controller
{
    public function userlogin(){

        return view('front.Auth.login');
    }

    public function postLogin(LoginuserRequest   $request)
    {

         //validation

        //check , store , update

        if (auth()->guard('web')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")])) {
           // notify()->success('تم الدخول بنجاح  ');
            return redirect() -> route('home');
        }
       // notify()->error('خطا في البيانات  برجاء المجاولة مجدا ');
        return redirect()->back()->with(['error' =>'هناك خطأ بالبيانات']);

    }
    public function register()
    {
        return view('front.Auth.register');
    }

    public function registeruser(RegisterRequest  $request)
    {
        try{
        $filteredusername=filter_var($request->name,FILTER_SANITIZE_STRING) ;
        $password=bcrypt($request->password);
        $filteredemail=filter_var($_POST['email'],FILTER_SANITIZE_EMAIL) ;

        $user = User::create([
            'name' => $filteredusername,
            'email' => $filteredemail,
            'password' => $password,

        ]);
        return redirect()->route('userlogin')->with(['success' => ' تم اشتراكك بنجاح برجاء تسجيل الدخول']);
        }
        catch (\Exception $ex) {
            return redirect()->route('home')->with(['error' => 'حدث خطا ما برجاء المحاوله لاحقا']);
     }
    }
}
