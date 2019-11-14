<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {
	protected $table = 'products';
	protected $fillable = ['name', 'slug', 'origin_price', 'sale_price', 'content', 'status', 'user_id', 'category_id'];

	public function category() {
		return $this->belongsTo('App\Models\Category');
	}

	public function user() {
		return $this->belongsTo('App\User');
	}

	public function images() {
		return $this->hasMany('App\Models\Image', 'product_id');
	}

}
