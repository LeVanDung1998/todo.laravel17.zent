<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
//use App\Http\Requests\StoreCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

//use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$categories = Category::paginate(15);
		return view('backend.categories.index')->with([
			'categories' => $categories,
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$categories = Category::get();
		return view('backend.categories.create')->with([
			'categories' => $categories,
		]);
		//return view('backend.categories.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {

		// $validator = Validator::make($request->all(),
		// 	[
		// 		'name' => 'required|min:5|max:255',
		// 		'parent_id' => 'required|numeric',
		// 		'depth' => 'required|numeric',
		// 	],
		// 	[
		// 		'required' => ':attribute không được để trống',
		// 		'min' => ':attribute không được nhỏ hơn :min',
		// 		'max' => ':attribute không được lớn hơn :max',
		// 	],
		// 	[
		// 		'name' => 'Tên danh mục',
		// 		'parent_id' => 'Danh mục cha',
		// 		'depth' => 'Đường dẫn',
		// 	]
		// );
		// if ($validator->errors()) {
		// 	return back()
		// 		->withErrors($validator)
		// 		->withInput();
		// }
		$validatedData = $request->validate([
			'name' => ['required', 'min:10', 'max:255'],
			'parent_id' => ['required', 'numeric'],
			'depth' => ['required', 'numeric'],
		]);

		$name = $request->get('name');
		$parent_id = $request->get('parent_id');
		$depth = $request->get('depth');
		//dd($name);

		$category = new Category();
		$category->name = $request->get('name');
		$category->slug = \Illuminate\Support\Str::slug($request->get('name'));
		//		$category->category_id = $request->get('category_id');
		//		$category->origin_price = $request->get('origin_price');
		//		$category->sale_price = $request->get('sale_price');
		$category->parent_id = $request->get('parent_id');
		$category->depth = $request->get('depth');
//		$category->user_id = Auth::user()->id;
		//dd($category->name);
		$category->save();

		$save = $category->save();

		if ($save) {
			$request->session()->flash('success', 'Tạo danh mục sản phẩm thành công' . '<br>');

		} else {
			$request->session()->flash('fail', 'Tạo danh mục sản phẩm thất bại' . '<br>');
		}

		return redirect()->route('backend.categories.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//$products = Category::find($id)->products()->where('status', 2)->get();
		// $category = Category::find($id);
		// $products = $category->products;
		//dd($products);
		//foreach ($products as $product) {
		//	echo $product->name . "<br>";
		//}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		// Lấy dữ liệu với $id
		$item = Category::find($id);

		//dd($item);
		// Gọi đến view edit
		return view('backend.categories.edit')->with('item', $item);
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
		$slug = $request->get('slug');
		$parent_id = $request->get('parent_id');
		$depth = $request->get('depth');

		// Tìm todo tương ứng với id
		$category = Category::find($id);
		//Cập nhật dữ liệu mới
		$category->name = $name;
		$category->slug = $slug;
		$category->depth = $depth;
		$category->parent_id = $parent_id;
		// Lưu dữ liệu
		$category->save();
		//Chuyển hướng đến trang danh sách

		$save = $category->save();

		if ($save) {
			$request->session()->flash('success_update', 'Cập nhật danh mục sản phẩm thành công' . '<br>');

		} else {
			$request->session()->flash('fail_update', 'Cập nhật danh mục sản phẩm thất bại' . '<br>');
		}
		return redirect()->route('backend.categories.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		// Xoá với id tương ứng
		Category::destroy($id);
		// Chuyển hướng về trang danh sách
		return redirect()->route('backend.categories.index');
	}
}
