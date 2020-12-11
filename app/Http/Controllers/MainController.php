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
use Illuminate\Support\Facades\Validator;

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

    public function validate_good_by_column_name($given_key) {
        return Validator::make($given_key, [ array_key_first($given_key) =>
            ['required', function ($attribute, $value, $fail) {
                    if (Good::whereRaw("BINARY `".$attribute."` = ?", [$value])->first() != null) {
                        $fail("[".$value."] ".__('validation.unique', [], Support\Facades\App::getLocale()));
                    } else return true;
                },
            ],
        ]);
    }

    public function index(Request $request) {
        $path = $request->session()->pull('path', 'default');
        return view('home')->with('path', $path != 'default' ? $path : null);
    }

    public function catalog($goods = null) { // GET
        if ($goods == null) {$goods = Good::OrderBy('id')->simplePaginate(10);}
        return view('catalog', [
            'goods' => $goods,
            'materials' => Material::all(),
            'sizes' => Size::all(),
            'attached_materials' => \App\Models\Material::has('goods')->pluck('id')->toArray(),
            'attached_sizes' => \App\Models\Size::has('goods')->pluck('id')->toArray(), // array of ids
        ]);
    }

    /**
     * @param $bundle array named array (request from client).
     * @return Support\Collection collection of Good models.
     */
    public function get_filtered(array $bundle): Support\Collection
    {
        $goods_with_sizes = [];
        $goods_with_mtrls = [];
        $goods = [];
        if ( array_key_exists('razmer', $bundle) ) {
            $sizes = Size::whereIn('code', $bundle['razmer'])->get();
            foreach ($sizes as $size) { array_push($goods_with_sizes, $size->goods()->get()); }
            $goods_with_sizes = $goods_with_sizes != [] ? collect($goods_with_sizes)->flatten()->unique('id')
                : Good::with('sizes')->get();
            $goods = collect($goods_with_sizes)->flatten()->unique('id');
        }

        if ( array_key_exists('tkan', $bundle) ) {
            $mtrls = Material::whereIn('code', $bundle['tkan'])->get();
            foreach ($mtrls as $mtrl) { array_push($goods_with_mtrls, $mtrl->goods()->get()); }
            $goods_with_mtrls = collect($goods_with_mtrls)->flatten()->unique('id');

            if ($goods != []) {
                $intersected = array_intersect($goods->pluck('id')->values()->toArray(),
                    $goods_with_mtrls->pluck('id')->values()->toArray());
                $goods = collect($goods_with_mtrls)->whereIn('id', $intersected);
            }
            else $goods = collect($goods_with_mtrls)->flatten()->unique('id');
        }

        if ( (array_key_exists('priceFrom', $bundle) || array_key_exists('priceTo', $bundle)) ) {
            $goods = $goods != [] ? $goods : Good::with('sizes')->with('materials')->get();
            $goods_with_prices = collect( $goods->whereBetween('price', [
                    array_key_exists('priceFrom', $bundle) ? $bundle['priceFrom'][0] : '0',
                    array_key_exists('priceTo', $bundle) ? $bundle['priceTo'][0] : '2000'
                ]) );
            $goods = collect($goods_with_prices)->flatten()->unique('id');
        }
        //$goods = collect($goods)->flatten()->unique('id');
        return $goods;
    }

    public function filter_catalog(Request $request) { // POST
        $bundle = $request->all();
        $goods_to_display = [];

        $materials = Material::all();
        $sizes = Size::all();
        $attached_materials = \App\Models\Material::has('goods')->pluck('id')->toArray();
        $attached_sizes = \App\Models\Size::has('goods')->pluck('id')->toArray();

        if (!array_key_exists('razmer', $bundle) && !array_key_exists('tkan', $bundle)
            && !array_key_exists('priceFrom', $bundle) && !array_key_exists('priceTo', $bundle)) {
            return redirect()->route('catalog', ['goods' => Good::get()->all()]);
        }
        else {
            $goods_to_display = Good::WhereIn('id', $this->get_filtered($bundle)->pluck('id'))->simplePaginate(6);
        }

        if ($goods_to_display == []) {
            $goods_to_display = Good::simplePaginate(10);        /* show all, nothing to hide */
        }

        return view('catalog', [
            'goods' => $goods_to_display,
            'materials' => $materials,
            'sizes' => $sizes,
            'attached_materials' => $attached_materials,
            'attached_sizes' => $attached_sizes,
        ]);
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
        $goods = Good::orderBy('id', 'desc')->simplePaginate(10);
        if (Auth::check()) {
            return view('dashboard')->with('goods', $goods);
        } else return redirect('login');
    }

    /* Goods */

    public function new_good (Request $request) {
        $materials = Material::all();
        $sizes = Size::all();
        return view('goods.new_good')
            ->with('materials', $materials)->with('sizes', $sizes);
    }

    public function show_good (Request $request) {
        $good_id = substr($request->path(),strripos($request->path(), '/') + 1);
        $good = Good::where('id', $good_id)->first();
        return view('goods.show_good', ['good' => $good]);
    }

    public function do_create_update_good(Request $request, $good_id = null) {
        $good = $good_id != null ? Good::where('id', $good_id)->first() : new Good;
        $is_create = $good_id == null;
        $dt = date('Ymd-his');
        $request->validate([
            'image' => 'image|file', 'price' => 'required|integer|min:96'
        ]);
        $good_price = $request->input('price');
        $loaded_file = null;
        $file_temp = $_FILES['image']['tmp_name'];
        if ($file_temp == '') {
            //$request->validate([ 'image' => 'required' ]);
        } // if image should be required


        $given_name = $request->input('name');
        $name_validator = $this->validate_good_by_column_name(['name' => $given_name]);
        if ($name_validator->fails() && $given_name != $good->name) { // name is_not_unique || is_empty
            return back()->with('good_id', !$is_create ? $good->id : '')->withErrors($name_validator);
        }

        $code = $this->sanitize_name($request->input('name'));
        if ($request->input('code') != '') {
            $code = $this->sanitize_name($request->input('code'));
        }

        $given_code_validator = $this->validate_good_by_column_name(['code' => $code]);
        if ($given_code_validator->fails() && ($code == '' || $code != $good->code)) {
            // try set from 'name'input or from uploaded filename
            $code = $file_temp != '' ? $loaded_file : $this->sanitize_name($request->input('name'));
            $code_validator = $this->validate_good_by_column_name(['code' => $code]);
            if ($code_validator->fails() && ($code == '' || $code != $good->code)) {
                return back()->with('good_id', !$is_create ? $good->id : '')->withErrors($code_validator);
            }
        }

        $good->name = $given_name;
        $good->code = $code;
        $good->price = $good_price;

        if ($file_temp) { // file is loaded successfully
            $dimensions = getimagesize($file_temp)[0].'x'.getimagesize($file_temp)[1];
            $loaded_file = $this->sanitize_name($_FILES['image']['name']);
            $file_mime = str_replace('/', '.',
                substr(getimagesize($file_temp)['mime'], strrpos($file_temp, '/') + 1));
        }

        if (isset($dimensions) && $dimensions != null) {
            $good_image = $dt.$code.$dimensions.$file_mime;
            if (!$is_create && $good->image != '') { $this->delete_image($good->id); }
            $image_path = $request->file('image')->storeAs('uploads', $good_image, ['disk' => 'public']);
            $good->image = 'storage/'.$image_path;
        }
        $good->save();

        // relationships
        //sync() : only the values from the given array will exist in the intermediate table
        $good->materials()->sync($request->input('materials'));
        $good->sizes()->sync($request->input('sizes'));

        return redirect()->route('good.edit', ['good_id' => $good->id]);
    }

    public function edit_good (Request $request, $good_id) { // shows 'edit good' page
        if (Auth::check()) {
            if (!isset($good_id) || $good_id == null) {
                $good_id = substr($request->path(),strripos($request->path(), '/') + 1);
            }
            $vars = $this->get_props_for_good($good_id);
            return view('goods.edit_good', $vars);
        } else return redirect('login');
    }

    public function create_good (Request $request) { // POST
        return $this->do_create_update_good($request);
    }

    public function update_good (Request $request, $good_id) { // POST, good editing
        return $this->do_create_update_good($request, $good_id);
    }

    public function delete_image ($good_id) { // storage disk
        $good = Good::where('id', $good_id)->first();
        $path = str_replace('storage/', '', $good->image);
        Storage::disk('public')->delete($path);
        $good->image = '';
        $good->save();
    }

    public function delete_good ($good_id) { // POST
        $good = Good::where('id', $good_id)->first();
        $this->delete_image($good->id);
        // relationships
        $good->materials()->detach();
        $good->sizes()->detach();
        $good->delete();
        return redirect()->route('dashboard');
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
        $this->update_props_logic($maters_to_del, $mater_new_code, $mater_new_name);
        $this->update_props_logic($sizes_to_del, $size_new_code, $size_new_name);

        return redirect()->route('props');
    }

    public function sanitize_name($input_val) {
        $locale = Support\Facades\App::getLocale();
        $translit_id = "Any-Latin; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();";
        if ($locale == 'ru') {
            $translit_id = 'Russian-Latin/BGN; NFD; [:Nonspacing Mark:] Remove; NFC; [:Punctuation:] Remove; Lower();';
        }
        $transliterator = \Transliterator::create($translit_id);
        return strtolower(str_replace(' ','-',str_replace([".","'","ʹ"],'',
            $transliterator->transliterate($input_val))));
    }

    public function get_props_for_good($good_id) {
        $good = Good::where('id', $good_id)->first();
        $materials = Material::all();
        $sizes = Size::all();
        $good_size_ids = $good->sizes()->pluck('id')->toArray();
        $good_material_ids = $good->materials()->pluck('id')->toArray();
        return ['good' => $good, 'materials' => $materials, 'sizes' => $sizes,
            'good_size_ids' => $good_size_ids, 'good_material_ids' => $good_material_ids];
    }
}
