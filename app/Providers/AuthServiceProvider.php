<?php

namespace App\Providers;
use App\Models\Product;
use App\Policies\ProductPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider {
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */

	protected $policies = [
		//Cách 1
		Product::class => ProductPolicy::class,
		//Cách 2
		//'App\Models\Product' => 'App\Policies\ProductPolicy',
	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */
	// public function boot()
	// {
	//     $this->registerPolicies();

	//     Gate::define('update-product', function ($user, $product){
	//        return $user->id == $product->user_id;
	//     });
	// }
	public function boot() {
		$this->registerPolicies();

		Gate::define('update-product', function ($user, $product) {
			return $user->id == $product->user_id;
		});

		Gate::define('view_dashbroad', function ($user) {
			return $user->is_admin == 1;
		});

		Gate::define('index-product', function ($user) {
			return $user->is_admin == 1;
		});

		Gate::define('create-product', function ($user) {
			return $user->is_admin == 1;
		});
	}

}
