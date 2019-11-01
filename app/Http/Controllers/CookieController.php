<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CookieController extends Controller {
	public function set() {

		Cookie::queue('user_id', 1);
		return response('Hello')->cookie('giohang', '1', 10);

	}

	public function get(Request $request) {
		$user_id = $request->cookie('user_id');
		$value = $request->cookie('giohang');
		echo $value;
		echo $user_id;
	}
}
