<?php
namespace App\Http\Controllers\Fontend;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slide;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller {
	public function index() {
		$categories = Cache::remember('categories', 10, function () {
			return Category::get();
		});
		//$categories = Category::get(); //lấy tất cả category
		$products5 = Product::with('images')->WHERE('sale_price', '<', 20000)->limit(8)->get(); //sản phảm có số lượng từ thấp->cao và có giá là nhỏ hơn 15000

		$products4 = Product::with('images')->OrderBy('sale_price', 'ASC')->WHERE('sale_price', '<', 15000)->limit(8)->get(); //sản phảm có số lượng từ thấp->cao và có giá là nhỏ hơn 15000
		$products3 = Product::with('images')->OrderBy('sale_price', 'ASC')->WHERE('sale_price', '<', 15000)->limit(3)->get(); //sản phảm có số lượng từ thấp->cao và có giá là nhỏ hơn 15000
		$products1 = Product::with('images')->OrderBy('created_at', 'DESC')->limit(20)->get(); //sản phẩm có ngày tạo mới nhất
		$products2 = Product::with('images')->OrderBy('origin_price', 'DESC')->limit(10)->get(); //sản phẩm có giá cao nhất
		$products = Product::with('images')->OrderBy('view_count', 'DESC')->limit(8)->get(); //sắp xếp sản phẩm từ view cao->thấp
		$slides = Slide::get();
		//dd($slides);

		return view('fontend.index')->with([
			'products' => $products,
			'categories' => $categories,
			'products1' => $products1,
			'products2' => $products2,
			'products3' => $products3,
			'products4' => $products4,
			'products5' => $products5,
			// 'images_5' => $images_5,
			'slides' => $slides,
		]);
	}
	public function product($slug) {
		$product = Product::with('images')->where('slug', $slug)->first();
		$images = $product->images;
		// dd($images);
		// foreach ($images as $image) {
		//  dd($image);
		// }
		$categories = Category::get();
		return view('fontend.product.product')->with([
			'categories' => $categories,
			'product' => $product,
			'images' => $images,
		]);
	}

	public function category($id) {
		//$product = Product::get();
		$categories = Category::get(); //
		// $categories = Cache::remember('categories', 10, function () {
		//  return Category::get();
		// }); //
		$product10 = Category::with('product')->find($id);
		$product_cate = $product10->product;
		// foreach ($images as $image) {
		//  dd($image);
		// }

		//dd($product_cate);
		return view('fontend.category.index')->with([
			'product_cate' => $product_cate,
			'categories' => $categories,
		]);
	}
}
