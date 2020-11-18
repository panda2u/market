<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catalog;
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

    public function login() {
        $isadm = 0;
        return view('admin')->with('isadm', $isadm);
    }

    public function dologin(Request $request) {
        $isadm = 0;
        $name = $request->input('login');
        $pass = $request->input('password');

        if ($name == 'panda2u' && $pass != '') {
            $isadm = 1;
            return view('admin')->with('isadm', $isadm)->with('name', $name); // представление с формой
        }

        return view('admin')->with('isadm', $isadm);
    }
}
