<?php

namespace App\Http\Controllers;

class SessionController extends Controller {
	public function set() {
		session([
			'user_id' => '111',
			'name' => 'hoan',
		]);

		session()->put('age', 20);
	}

	public function get() {
		$user_id = session()->get('user_id');
		$name = session()->get('name');
		$age = session()->get('age');
		$phone = session()->get('phone', '123456');

		if (session()->has('age')) {
			echo 'có' . '<br>';
		} else {
			echo 'không' . '<br>';
		}

		if (session()->exists('users')) {
			echo 'có' . '<br>';
		} else {
			echo 'không' . '<br>';
		}

		echo 'Name:' . $name . '<br>';
		echo 'user_id:' . $user_id . '<br>';
		echo 'phone:' . $phone . '<br>';
		echo 'age:' . $age;
		//dd($value);
	}

	public function get2() {
		$value = session()->pull('name');
		$name = session()->get('name');
		dd($name);
	}
}
