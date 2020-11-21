<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Good;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class MainController extends Controller
{
    private function name_if_auth() {
        if (Auth::check()) {
            return User::all()->where('id', Auth::id())->first()->value('name');
        } else { return null; }
    }

    public function index() {
        $name = MainController::name_if_auth();
        return view('home')->with('isauth', $name != null)->with('name', $name ?? ''); //TODO: remove isauth.
    }

    public function catalog() {
        $name = MainController::name_if_auth();
        return view('catalog')->with('isauth', $name != null)->with('name', $name ?? ''); //TODO: remove isauth.
    }

    public function login() {
        return view('mylogin')->with('name', '')->with('e', null); //TODO: remove $e.
    }

    public function dologin(Request $request) {
        $request->validate([
            'email' => 'required|email','password' => 'required',
        ]);
        $remember = $request->input('remember');
        $email = $request->input('email');//'admin@fake.com'
        $muser = User::all()->where('email', $email)->first();
        $pass = $request->input('password');
        $pass_correct = Hash::check($pass, $muser->value('password'));
        $is_email_veryfied = $muser->value('email_verified_at') != null;

        if ($pass_correct) {
            $name = $muser->value('name');
            if ($is_email_veryfied) {
                Auth::login($muser, $remember != null); // 'on' for on
                return redirect('dashboard')->with('name', $name);
            }
            else {
                $e = 'email не подтверждён';
                return redirect('login')->with('name', '')->with('e', $e); //TODO: remove $e.
            }
        } else {
            $e = 'пароль неверный';
            return redirect('login')->with('name', '')->with('e', $e); //TODO: remove $e.
    }
    }

    public function logout () {
        Auth::logout();
        return redirect('/')->with('name', '');
    }

    public function dashboard() {
            $name = MainController::name_if_auth();
        //$goods = Good::all()->take(3);
        $goods = DB::table('goods')->simplePaginate(10);
        if ($name != null) {
            return view('dashboard')->with('name', $name)->with('goods', $goods);
        } else {
            return redirect('login')->with('name', '');
    }

    }

}
