<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use App\Models\UserInfo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//$users = User::get();
		//phân trang
		$users = User::paginate(15);
		//$users = User::simplePaginate(15);
		//dd($users);
		//
		//$list = Todo::get();
		//dd($list);
		return view('backend.users.index')->with([
			'users' => $users,
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('backend.users.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$validatedData = $request->validate([
			'name' => ['required', 'min:10', 'max:255'],
			'email' => ['required', 'email'],
			'password' => ['required'],
		]);

		$name = $request->get('name');
		$email = $request->get('email');
		$password = $request->get('password');
		//dd($name);

		$user = new User();
		$user->name = $request->get('name');
		// $user->slug = \Illuminate\Support\Str::slug($request->get('name'));
		//      $category->category_id = $request->get('category_id');
		//      $category->origin_price = $request->get('origin_price');
		//      $category->sale_price = $request->get('sale_price');
		$user->email = $request->get('email');
		$user->password = bcrypt($request->password);
//      $category->user_id = Auth::user()->id;
		//dd($user);
		$user->save();

		return redirect()->route('backend.user.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		// $user = User::find($id);
		// $userInfo = $user->userInfo;
		// dd($userInfo);

		$userInfo = UserInfo::find($id);
		$user = $userInfo->user;
		dd($user);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$item = User::find($id);

		//dd($item);
		// $password = $item->password;
		// $pas2 = bcrypt($password);
		// dd($pas2);
		return view('backend.users.edit')->with('item', $item);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		// Nhận dữ liệu từ $request
		$name = $request->get('name');
		$email = $request->get('email');
		// Tìm todo tương ứng với id
		$user = User::find($id);
		//Cập nhật dữ liệu mới
		$user->name = $name;
		$user->email = $email;

		$user->save();
		//Chuyển hướng đến trang danh sách
		return redirect()->route('backend.user.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		// Xoá với id tương ứng
		User::destroy($id);
		// Chuyển hướng về trang danh sách
		return redirect()->route('backend.user.index');
	}
}
