<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\User;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller {
	public function index() {
		$product = Product::get()->count();
		$users = User::get()->count();
		$products = Product::orderBy('id', 'desc')->limit(4)->get();

		//dd($products);
		if (Gate::allows('view_dashbroad')) {

			return view('backend.dashboard')->with([
				'product' => $product,
				'products' => $products,
				'users' => $users,
			]);

		} else {
			dd('bạn k có quyền');
		}
		//return view('backend.dashboard');
	}
}
