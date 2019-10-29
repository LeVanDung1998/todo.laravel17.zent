<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class DashboardController extends Controller {
	public function index() {
		if (Gate::allows('view_dashbroad')) {

			return view('backend.dashboard');

		} else {
			dd('bạn k có quyền');
		}
		//return view('backend.dashboard');
	}
}
