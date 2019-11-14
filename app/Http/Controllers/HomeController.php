<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller {
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index() {

		//cache với mảng
		//$put = Cache::put('name', ['a' => 1, 'b' => 2], 60 * 4);
		//
		//cache với số
		//Cache::put('age', 25, 15);

		//cache với string
		//$put = Cache::put('name', 'Dung', 60 * 4);

		//
		//$name = Cache::get('name');

		//cache với 1 đối tượng
		// $cate = Category::find(1);
		// Cache::put('cate', $cate, 10);
		// $name = Cache::get('cate');

		//cache với nhiều đối tượng
		// $cate = Category::get();
		// Cache::put('cate', $cate, 10);
		// $name = Cache::get('cate');
		// dd($name);
		// Cache::add('view_count', '0', 60 * 1);
		// $view_count = Cache::increment('view_count');
		// dd($view_count);

		$value = Cache::remember('categories', 1, function () {
			return DB::table('categories')->get();
			//return $value = Category::get();
		});

		//top sp trong ngay
		$top_product = Cache::remember('top_product', 60, function () {
			return $product = Product::limit(5)->take(5)->get();
		});

		dd($top_product);
		//Cache::forget('top_product');

		return view('home');
	}

	public function getCache() {
		if (Cache::has('cate')) {
			$categories = Cache::get('cate');
		} else {
			$categories = Category::get();
		}

		dd($categories);
	}
}
