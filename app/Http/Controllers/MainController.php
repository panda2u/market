<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Catalog;
class MainController extends Controller
{
    public function index() {
        $isadm = 0;
        return view('home')->with('isadm', $isadm);
        return 'main controller says hello<br><a href="/catalog">Котолок</a>';
    }

    public function catalog() {
        $ctrlt = 'Route - controller - view';
        $isadm = 0;
        return view('catalog')->with('ctrl', $ctrlt)->with('isadm', $isadm);

    }

    public function admin() {
        $isadm = 1;
        return view('admin')->with('isadm', $isadm);
    }
}
