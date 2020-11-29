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
use Illuminate\Support;

class MainController extends Controller
{
    public static function name_if_auth() {
        if (Auth::check()) {
            return App\Models\User::all()->where('id', Auth::id())->first()->value('name');
        } else { return ''; }
    }

    public static function update_props_logic($del_list, $new_code, $new_name) {
        // deleting
        if ( $del_list['data'] != null) {
            $current_model = null;
            if ( $del_list['type'] == 'mat' ) {
                $current_model = app(Material::class);
            } elseif ( $del_list['type'] == 'size' ) {
                $current_model = app(Size::class);
            } else return;

            foreach ($del_list['data'] as $item) {
                //dd($item);
                $current_data = $current_model::where('id', $item);
                //dd($current_data);
                if ($current_data->get('code')->first() != $new_code['data']
                    && $current_data->get('name')->first() != $new_name['data']) {
                        DB::table($current_model->getTable())->where('id', $item)->delete();
                }
            }
        }

        $current_model = null;

        if ( ($new_name['type'] == 'mat' && $new_name['data'] != '') ||
            ($new_code['type'] == 'mat' && $new_code['data'] != '') ) {
            $current_model = app(Material::class);
        }
        elseif ( ($new_name['type'] == 'size' && $new_name['data'] != '') ||
            ($new_code['type'] == 'size' && $new_code['data'] != '') ) {
            $current_model = app(Size::class);
        }

        if ($current_model == null) return;

        $search_by_name = $current_model->whereRaw("BINARY `name`= ?", [$new_name['data']])->first();
        $search_by_code = $current_model->whereRaw("BINARY `code`= ?", [$new_code['data']])->first();

        $update_code = $search_by_code == null && $search_by_name != null;
        $update_name = $search_by_code != null && $search_by_name == null;
        $insert = $search_by_code == null && $search_by_name == null;


        if ( $insert ) {
            $m = new $current_model;
            $m->code = $new_code['data'];
            $m->name = $new_name['data'];
            $m->save();
        } elseif ( $update_code ) {
            $search_by_name->update(['code' => $new_code['data']]);
        } elseif ( $update_name ) {
            $search_by_code->update(['name' => $new_name['data']]);
        }
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
        } else return redirect('login');
    }

    /* Goods */

    public function new_good (Request $request) {
        $image_path = $request->session()->pull('image_path', 'default') ?? '';
        $materials = Material::all();
        $sizes = Size::all();
        return view('goods.new_good')->with('image_path', $image_path)
            ->with('materials', $materials)->with('sizes', $sizes);
    }

    public function show_good (Request $request) {
        $good_id = substr($request->path(),strripos($request->path(), '/') + 1);
        $good = Good::where('id', $good_id)->first();
        return view('goods.show_good', ['good' => $good]);
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
        return redirect()->route('good.edit', ['good_id' => $new_good->id]);
    }

    public function edit_good ($good_id) { // shows 'edit good' page
        if (Auth::check()) {
            $good = Good::where('id', $good_id)->first();
            return view('goods.edit_good')->with('good', $good);
        } else return redirect('login');
    }

    public function update_good ($good_id) { // POST, good editing
        $good = Good::where('id', $good_id)->first();
        // updating...
        return view('goods.edit_good')->with('good', $good);
    }

    public function delete_good ($good_id) { // POST
        // pop-up 'are you sure you want to delete {good_id}?' with real posting form'n'button
        dd($good_id);
        dd(sprintf("are you sure you want to delete good_id %s?", $good_id));
    }

    /* Properties */

    public function edit_props () { // 'props'
        if (Auth::check()) {
            return view('properties')
                ->with('materials', Material::all())->with('sizes', Size::all());
        } else return redirect('login');
    }

    public function update_props (Request $request) { // POST
        $maters_to_del = ['type' => 'mat', 'data' => $request->input('materials')]; // data is array
        $sizes_to_del = ['type' => 'size', 'data' => $request->input('sizes')]; // data is array
        $mater_new_name = ['type' => 'mat', 'data' => $request->input('material-name') ?? ''];
        $size_new_name = ['type' => 'size', 'data' => $request->input('size-name') ?? ''];
        $mater_new_code = ['type' => 'mat', 'data' => Support\Str::slug(str_replace(['!',',','.','-','/','\\'],'_',
            $request->input('material-code')),"_","ru")];
        $size_new_code = ['type' => 'size', 'data' => Support\Str::slug(str_replace(['!',',','.','-','/','\\'],'_',
            $request->input('size-code')),"_","ru")];
        MainController::update_props_logic($maters_to_del, $mater_new_code, $mater_new_name);
        MainController::update_props_logic($sizes_to_del, $size_new_code, $size_new_name);

        return redirect()->route('props');
    }
}
