<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\Good;
use App\Models\Size;
use App\Models\Material;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public static function name_if_auth() {
        if (Auth::check()) {
            return App\Models\User::all()->where('id', Auth::id())->first()->value('name');
        } else { return ''; }
    }

    public function index(Request $request) {
        $path = $request->session()->pull('path', 'default');
        return view('home')->with('path', $path != 'default' ? $path : null);
    }

    public function catalog() {
        return view('catalog');
    }

    public function login() {
        return view('mylogin');
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
        $goods = DB::table('goods')->simplePaginate(10);
        if (Auth::check()) {
            return view('dashboard')->with('goods', $goods);
        } else {
            return redirect('login');
        }
    }

    /* Goods */

    public function new_good (Request $request) {
        $image_path = $request->session()->pull('image_path', 'default') ?? '';
        $materials = Material::all();
        $sizes = Size::all();
        //dd($sizes);

        return view('goods.new_good')->with('image_path', $image_path)
            ->with('materials', $materials)->with('sizes', $sizes);
    }

    public function create_good (Request $request) { // POST
        $request->validate([ 'image' => 'image|file', 'price' => 'required|integer' ]);

        $file_temp = $_FILES['image']['tmp_name'];
        if (!$file_temp) {
            $request->validate([ 'image' => 'required' ]);
        }

        $dt = date('Ymd-his');
        $good_price = $request->input('price') ?? 1000;

        $good_name = $request->input('name') ?? $_FILES['image']['name'];

        $file_mime = str_replace('/', '.',
            substr(getimagesize($file_temp)['mime'], strrpos($file_temp, '/') + 1));
        $code = strtolower(str_replace(
            ' ', '-', str_replace(
            [".", "'"],'', $good_name)));
        $dimens = getimagesize($_FILES['image']['tmp_name'])[0].'x'.getimagesize($_FILES['image']['tmp_name'])[1];
        $good_image = $dt.$code.$dimens.$file_mime;
        $image_path = 'storage/'.$request->file('image')->storeAs('uploads', $good_image);// real

        $request->session()->flash('image_path', $image_path);

        $new_good = new Good;

        $new_good->name = $good_name;
        $new_good->code = $code;
        $new_good->image = $image_path;
        $new_good->price = $good_price;
        $new_good->save();

        $new_good->materials()->attach($request->input('materials'));
        $new_good->sizes()->attach($request->input('sizes'));

        return redirect('goods/'.$new_good->id);
    }

    public function edit_good (Request $request) { // shows 'edit good' page

        $good_id = substr($request->path(),strripos($request->path(), '/') + 1);
        $good = Good::where('id', $good_id)->first();
        return view('goods.edit_good')->with('good', $good);
    }

    public function update_good (Request $request) { // POST, good editing
        $good = Good::where('id', substr($request->path(),strripos($request->path(), '/') + 1))->first();
        // updating...
        return view('goods.edit_good')->with('good', $good);
    }

    public function delete_good (Request $request) { // POST
        $good_id = substr($request->path(),strripos($request->path(), '/') + 1);
        // pop-up 'are you sure you want to delete {good_id}?'
        dd(sprintf("are you sure you want to delete good_id %s?", $good_id));
    }

    /* Properties */

    public function edit_props () { // 'props'
        return view('properties')
            ->with('materials', Material::all())->with('sizes', Size::all());
    }

    public function update_props (Request $request) { // POST
        // updating...
        return redirect('props');
    }
}
