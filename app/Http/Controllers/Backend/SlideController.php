<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;

class SlideController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$slides = Slide::get();
		//dd($slides);
		return view('backend.slides.index')->with([
			'slides' => $slides,
		]);

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view('backend.slides.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		$path_images = [];
		if ($request->hasFile('image')) {
			$file = $request->file('image');
			// Lưu vào trong thư mục storage
			//$path = $file->store('images');
			$type_image = $file->getClientOriginalExtension();
			$namefile = $file->getClientOriginalName();
			$time = time();
			$path = $file->storeAS('slides', $namefile . '_' . $time . '.' . $type_image);
			$path_images = $path;
		} else {
			dd('khong co file');
		}
		$slide = new Slide();
		//dd($sli)
		$slide->name = $request->get('name');
		$slide->path = $path_images;
		$slide->save();
		return redirect()->route('backend.slide.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		$slides = Slide::find($id);
		//dd($slides);
		return view('backend.slides.show')->with([
			'slides' => $slides,
		]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		// Xoá với id tương ứng
		Slide::destroy($id);
		// Chuyển hướng về trang danh sách
		return redirect()->route('backend.slides.index');
	}
}
