<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
//use App\User;
class MainController extends Controller
{
    public function index() {
        $isadm = 0;
        return view('home')->with('isadm', $isadm);
        return 'main controller says hello<br><a href="/catalog">Каталог</a>';
    }

    public function catalog() {
        $ctrlt = 'Route - controller - view';
        $isadm = 0;
        return view('catalog')->with('ctrl', $ctrlt)->with('isadm', $isadm);

    }

    public function admin() {
        $isadm = 0;
        return view('admin')->with('isadm', $isadm);
    }

    public function prelogin() {
        $isadm = 0;
        return view('prelogin')->with('isadm', $isadm);
    }

//    public function login() {
//        $isadm = 0;
//        return view('admin')->with('isadm', $isadm);
//    }

    public function dologin(Request $request) {
        $name = $request->input('login');
        $pass = $request->input('password');
        $db_searched_pass = User::first()->where('name', $name)->value('password');
        //dd($is_correct_pass);
        $isadm = Hash::check($pass, $db_searched_pass) ? 1 : 0;
        return view('admin')->with('isadm', $isadm)->with('name', $name);
    }
}
