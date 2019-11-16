<?php

namespace App\Http\Controllers\Fontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CartController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//$item = Cart::add('293ad', 'Product 1', 1, 9.99);
		//dd($item);
		// $item = Cart::add([
		//  ['id' => '293ad', 'name' => 'Product 1', 'qty' => 1, 'price' => 10.00, 'weight' => 0],
		//  ['id' => '4832k', 'name' => 'Product 2', 'qty' => 1, 'price' => 10.00, 'options' => ['size' => 'large'], 'weight' => 0],
		// ]);

		//Cart::add([$product1, $product2]);
		//dd($item);
		$all = Cart::content();
		//dd($all);
		$categories = Cache::remember('categories', 10, function () {
			return Category::get();
		});
		//$categories = Category::get(); //lấy tất cả category
		return view('fontend.cart.index')->with([
			'categories' => $categories,
			'all' => $all,
		]);
		//
	}

	public function add($id) {

		//dd($id);
		$product = Product::with('images')->find($id);
		$images = $product->images;
		//dd($image);
		Cart::add($product->id, $product->name, 1, $product->sale_price, 0, ['image' => $images[0]->path]);
		//dd($product);
		return redirect()->route('fontend.cart.index');

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
