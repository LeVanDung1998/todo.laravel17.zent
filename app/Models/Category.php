<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class Category extends Model {
	protected $table = 'categories';
	protected $fillable = ['name', 'slug', 'parent_id', 'depth'];
	// public function products() {
	// 	return $this->hasMany(Product::class);
	// }
	public function product() {
		return $this->hasMany('App\Models\Product', 'category_id');
	}
}
