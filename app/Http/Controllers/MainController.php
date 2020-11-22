<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Good;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public static function name_if_auth() {
        if (Auth::check()) {
            return User::all()->where('id', Auth::id())->first()->value('name');
        } else { return ''; }
    }

    public function index() {
        return view('home');
    }

    public function catalog() {
        return view('catalog');
    }

    public function login() {
        return view('mylogin')->with('e', null);
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
                return redirect('dashboard');
            }
            else {
                $e = 'email не подтверждён';
                return redirect('login');
            }
        } else {
            $e = 'пароль неверный';
            return redirect('login');
    }
    }

    public function logout () {
        Auth::logout();
        return redirect('/');
    }

    public function dashboard() {
        //$goods = Good::all()->take(3);
        $goods = DB::table('goods')->simplePaginate(10);
        if (Auth::check()) {
            return view('dashboard')->with('goods', $goods);
        } else {
            return redirect('login');
        }
    }

    /* Goods */
    public function new_good () {
        return view('goods.new_good');
    }
 
    public function create_good (Request $request) { // POSTing
        $name = $request->input('name');
        $code = strtolower(str_replace(' ', '-', str_replace([".", "'"],'', $name)));
        $price = $request->input('price');

        $path = $request->file('image')->store('uploads', 'public');
        //uploads/LwyemzeSuZaqcHZOW8by2rWIJSAqEcy1ta06NJCx.png
        //dd($path);
        $size = '2560x1440'; //TODO: upload image and get it width and height

        $path_prefix = '/storage/';
        $dt = date('Ymd-his'); // TODO: get local time

        $image = $path_prefix.$dt.$name.$size;
        //$a_new_good = new Good;

        /*        $a_new_good->name = $name;
                $a_new_good->code = $code;
                $a_new_good->image = $image;
                $a_new_good->price = $price;*/

/*        $a_new_good->save([
            'name' => $name,
            'code' => $code,
            'image' => $image,
            'price' => $price,
        ]);

        $good_id = $a_new_good->id;
        return redirect('goods.edit_good')->with('good_id', $good_id);*/
        //return view('home')->with('path', $path); // testing
     }
 
    public function edit_good (Request $request) {
        $good_id = substr($request->path(),strripos($request->path(), '/') + 1);
        return view('goods.edit_good')->with('good_id', $good_id);
    }
}
