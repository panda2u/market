<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redirect;

class MainController extends Controller
{
    /**
     * @var |null
     */
    private static $name;
    private function name_if_auth() {
        if (Auth::check()) {
            MainController::$name = User::all()->where('id', Auth::id())->first()->value('name');
            return MainController::$name;
        } else { return null; }
    }

    public function index() {
        $name = MainController::name_if_auth();
        return view('home')->with('isauth', $name != null)->with('name', $name ?? '');
    }

    public function catalog() {
        $name = MainController::name_if_auth();
        return view('catalog')->with('isauth', $name != null)->with('name', $name ?? '');
    }

    public function login() {
        $name = MainController::name_if_auth();
        return view('mylogin')->with('isauth', $name != null)->with('name', $name ?? '');
    }

    public function dologin(Request $request) {
        $remember = $request->input('remember');
        $email = $request->input('email');//'admin@fake.com'
        $muser = User::all()->where('email', $email)->first();
        $pass = $request->input('password');
        $db_hashed_pass = $muser->value('password');
        $pass_correct = Hash::check($pass, $db_hashed_pass);
        $is_email_veryfied = $muser->value('email_verified_at') != null;

        //$credentials = $request->only('email', 'password');
        //if (Auth::attempt($credentials)) { // Authentication passed...
        if ($pass_correct) { // Authentication passed...
            $name = $muser->value('name');
            if ($is_email_veryfied) {
                //dd($muser);
                //Auth::login($request->user(), $remember != null); // 'on' for on
                Auth::login($muser, $remember != null); // 'on' for on
                //dd(Auth::check());
                //Redirect::route('dashboard')->with('isadm', 1)->with('name', $name);
                return redirect('dashboard')->with('$isauth', true)->with('name', $name);
    }
            else { echo "email не подтверждён";}
        } else { echo "пароль неверный"; /*dd($muser);*/ }
    }

    public function logout () {
        Auth::logout();
        //dd(Auth::check());

        return redirect('/')->with('$isauth', false)->with('name', '');
    }

    public function dashboard() {
        //dd(Auth::check());
        //dd(Auth::id());
        if (Auth::check()) {
            $name = MainController::name_if_auth();
            return view('dashboard')->with('isauth', $name != null)->with('name', $name ?? '');
        } else {
            return redirect('login')->with('$isauth', false)->with('name', '');
    }

    }

}
