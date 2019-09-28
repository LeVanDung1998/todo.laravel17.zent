<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class SettingController extends Controller {
	public function index() {
		return 'Setting admin';
	}

	public function show($id) {
		if ($id > 10) {
			$result = 'Lớn hơn 10';

		} else {
			$result = 'Nhỏ hơn hoặc bằng 10';

		}

		return view('welcome')->with(
			['result' => $result,
				'id' => $id,
			]);
		//'result', $result);
	}
}
