<?php

namespace App\Http\Controllers;

class HomeController extends Controller {
	public function index() {
		return 'Home page';
	}

	public function page($page = 1) {
		return "Page $page";
	}
}
