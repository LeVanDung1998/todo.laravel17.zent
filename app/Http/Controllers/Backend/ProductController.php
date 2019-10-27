<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
//use App\Http\Requests\StoreProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		//$products = Product::paginate(15);
		$products = Product::with('category')->orderBy('id', 'desc')->paginate(15);
		//dd($products);
		return view('backend.products.index')->with([
			'products' => $products,
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$categories = Category::get();
		return view('backend.products.create')->with([
			'categories' => $categories,
		]);
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		// lưu file
		// Storage::disk('public')->put('test.txt', 'hoan');
		// Storage::put('test.txt', 'hoan');

		// lấy file
		//$contents = Storage::get('test.txt');
		//$contents = Storage::disk('local')->get('test.txt');
		//dd($contents);

		//check file tồn tại
		//$exists = Storage::disk('local')->exists('test.txt');
		//dd($exists);

		//tải file
		//return Storage::download('test.txt');
		//return Storage::download('test.txt', $name, $headers);

		//lấy url
		// $url = Storage::url('test.txt');
		// dd($url);

		//coppy move file
		// Storage::copy('test.txt', 'new/file1.txt');
		//Storage::move('new/file1.txt', 'new/file3.txt');
		//dd(1);

		// $validatedData = $request->validate([
		//  'name' => 'required|min:10|max:255',
		//  'origin_price' => 'required|numeric',
		//  'sale_price' => 'required|numeric',
		//
		// ]);

		// if ($request->hasFile('images')) {
		//  //dd('co file');
		//  //$file = $request->file('image');
		//  // Lưu vào trong thư mục storage ng dùng k truy câp k xem đc từ web
		//  //$path = $file->store('images');
		//  // cachs 2 ng dùng có thể xem
		//  //$file = $request->file('image');
		//  //$name = $file->getClientOriginalName();
		//  //$file->move('image_2', $name);
		//  $images = $request->file('images');
		//  foreach ($images as $image) {
		//      $name = $file->getClientOriginalName();
		//      $file->move('image_10', $name);
		//      //$image->store('image');
		//  }
		//  dd(2);
		// } else {
		//  dd('khong co file');
		// }

		// validate với form
		$images = $request->image;

		$rules = [
			'image.*' => 'max:2000|image',
			'image' => 'required',
		];

		$messages = [
			'image.required' => ':attribute không được bỏ trống.',
			'image.*.max' => ':attribute không được quá 2MB.',
			'image.*.image' => ':attribute không đúng định dạng',
		];

		// $validator = Validator::make($request->all(),
		//  [
		//      'name' => 'required|min:10|max:255',
		//      'origin_price' => 'required|numeric',
		//      'sale_price' => 'required|numeric',
		//  ],
		//  [
		//      'required' => ':attribute không được để trống',
		//      'min' => ':attribute không được nhỏ hơn :min',
		//      'max' => ':attribute không được lớn hơn :max',
		//  ],
		//  [
		//      'name' => 'Tên sản phẩm',
		//      'origin_price' => 'Giá gốc',
		//      'sale_price' => 'Giá bán',
		//  ]
		// );
		// if ($validator->errors()) {
		//  return back()
		//      ->withErrors($validator)
		//      ->withInput();
		// }

		// validate  mặc định

		$validatedData = $request->validate([
			'name' => ['required', 'min:5', 'max:255'],
			'origin_price' => ['required', 'numeric'],
			'sale_price' => ['required', 'numeric'],
		]);

		// $info_images = [];
		// if ($request->hasFile('images')) {
		//  $images = $request->file('images');
		//  foreach ($images as $key => $image) {
		//      // $id = $key;
		//      //$username = $key;
		//      //$namefile = $id . '.png'; // đặt tên cho mỗi ảnh theo key
		//      $namefile = $image->getClientOriginalName();
		//      $url = 'storage/' . $namefile;
		//      Storage::disk('public')->putFileAs('products', $image, $namefile);

		//      $info_images[] = [
		//          'url' => $url,
		//          'name' => $namefile,
		//      ];

		//      //$image= new Image();
		//  }
		//  //dd(2);
		// } else {
		//  dd('khong co file');
		// }
		//
		if ($request->hasFile('images')) {
			$attributes = [];
			foreach ($images as $key => $value) {
				$name_image = $value->getClientOriginalName();
				$attribute['image.' . $key] = $name_image;
			}
		} else {
			$attributes = [
				'image' => 'Ảnh',
			];
		}

		$validator = Validator::make($request->all(), $rules, $messages, $attributes);
		if ($validator->fails()) {
			return back()
				->withErrors($validator)
				->withInput();
		}

		$path_images = [];

		foreach ($images as $image) {
			//$img = new Image();
			$type_image = $image->getClientOriginalExtension();
			$name_image = $image->getClientOriginalName();
			$time = time();
			// $img->path = $image['url'];
			// $img->product_id = $product->id;
			// $img->save();
			$path = $image->storeAS('public/products', $name_image . '_' . $time . '.' . $type_image);
			$path_images = $path;
		}

		$product = new Product();
		$product->name = $request->get('name');
		$product->slug = \Illuminate\Support\Str::slug($request->get('name'));
		$product->category_id = $request->get('category_id');
		$product->origin_price = $request->get('origin_price');
		$product->sale_price = $request->get('sale_price');
		$product->content = $request->get('content');
		$product->status = $request->get('status');
		$product->user_id = Auth::user()->id;
		$product->save();

		// foreach ($info_images as $image) {
		// 	$img = new Image();
		// 	$img->name = $image['name'];
		// 	$img->path = $image['url'];
		// 	$img->product_id = $product->id;
		// 	$img->save();
		// }

		return redirect()->route('backend.product.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$item = Product::find($id);
		//$products = Product::find($id);
		//dd($product->category->name);
		//dd($products->user->name);
		return view('backend.products.show')->with('item', $item);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		// Lấy dữ liệu với $id
		$item = Product::find($id);

		//dd($item);
		// Gọi đến view edit
		return view('backend.products.edit')->with('item', $item);
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
		$origin_price = $request->get('origin_price');
		$sale_price = $request->get('sale_price');
		$content = $request->get('content');
		$status = $request->get('status');

		// Tìm todo tương ứng với id
		$product = Product::find($id);
		//Cập nhật dữ liệu mới
		$product->name = $name;
		$product->slug = $slug;
		$product->origin_price = $origin_price;
		$product->sale_price = $sale_price;
		$product->content = $content;
		$product->status = $status;
		// Lưu dữ liệu
		$product->save();
		//Chuyển hướng đến trang danh sách
		return redirect()->route('backend.product.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		// Xoá với id tương ứng
		Product::destroy($id);
		// Chuyển hướng về trang danh sách
		return redirect()->route('backend.product.index');
	}
}
