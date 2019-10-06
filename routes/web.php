<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', function () {
	return view('welcome');
});

Route::get('/hello', function () {
	return view('hello');
});

// Route::get('abc', function () {
// 	return 'Lê Văn Dũng';
// });

Route::get('/abc/{year}/{name?}', function ($year, $name = null) {
	if ($name == NUll) {
		echo ('Hello ' . $year);
	} else {
		echo ('Hello ' . $year . ' My name is ' . $name);
	}
	//return 'Lê Văn Dũng';
});

Route::get('dung/{diem}', function ($diem) {
	echo 'Dũng được ' . $diem . ' điểm';
})->where(['diem' => '[a-zA-Z]+']);

Route::get('Router1', ['as' => 'MyRouter', function () {
	return 'Xin chào các bạn';
}]);

Route::get('Router2', function () {
	echo 'Đây là router 2';
})->name('MyRouter2');

Route::get('goiTen', function () {
	return redirect()->route('MyRouter2');
});

Route::group(['prefix' => 'MyGroup'], function () {
	Route::get('User1', function () {
		echo 'user1';
	});

	Route::get('User2', function () {
		echo 'user2';
	});

	Route::get('User3', function () {
		echo 'user3';
	});

});

Route::redirect('form1', 'form');

// Route::get('form', function () {
// 	return view('form');
// });

Route::view('form', 'form');

Route::post('form', function () {
	echo 'vao form';
})->name('post.form');

// Route::prefix('admin')->group(function () {
// 	Route::prefix('user')->group(function () {
// 		Route::get('', function () {
// 			echo 'home user';
// 		});

// 		Route::get('user1', function () {
// 			echo 'home user 1';
// 		});

// 	});
// });

// Route::prefix('admin')->name('admin.')->group(function () {
// 	Route::prefix('lesson')->name('admin.lesson')->group(function () {
// 		Route::prefix('video')->name()->group(function () {
// 			Route::get('', function () {
// 				echo 'admin lesson video';
// 			});
// 			Route::get('3', function () {
// 				echo 'admin lesson video 3';
// 			})->name();

// 		});
// 		Route::get('1', function () {
// 			echo 'admin lesson 1';
// 		})->name('lesson.1');

// 		Route::get('edit', function () {
// 			echo 'admin lesson edit';
// 		})->name('lesson.edit');

// 		Route::get('test', function () {
// 			echo 'admin lesson test';
// 		})->name('lesson.test');

// 	});
// });

// Route::group([
//     'prefix' => 'admin',
//     'name' => 'admin.'
// ], function(){
//     Route::prefix('user')->group(function(){
//         Route::get('/',function(){
//             echo "home";
//         })->name('user.home');
//         Route::get('/edit',function(){
//             echo "edit";
//         })->name('user.edit');
//         Route::get('/add',function(){
//             echo "add";
//         })->name('user.add');
//     });
//     Route::prefix('lesson')->group(function(){
//         Route::get('/video',function(){
//             echo "video";
//         });
//         Route::get('/test',function(){
//             echo "test";
//         });
//         Route::get('/video/3',function(){
//             echo "video3";
//         });
//     });
// });

// Route::group([
//     'prefix'=> 'admin',
//     'post'=> 'admin.',

// ]),function(){
//     Route::prefix('user')->group(function(){
//         Route::get('/',function(){
//             echo "home";
//         })->name('user.home');
//         Route::get('/edit',function(){
//             echo "edit";
//         })->name('user.edit');
//         Route::get('/add',function(){
//             echo "add";
//         })->name('user.add');
//     });

// });

Route::group(['prefix' => 'admin'], function () {

	Route::group(['prefix' => 'category'], function () {
		Route::get('/', function () {
			echo 'admin category';
		});
		Route::group(['prefix' => '13'], function () {
			Route::get('/', function () {
				echo 'admin category 13';
			});
			Route::group(['prefix' => 'post'], function () {
				Route::get('/', function () {
					echo 'admin category 13 post';
				});
				Route::get('45', function () {
					echo 'admin category 13 post 45';
				});
			});
		});
	});

	Route::group(['prefix' => 'post'], function () {
		Route::get('/', function () {
			echo 'admin post';
		});
		Route::get('22', function () {
			echo 'admin post 22';
		});
		Route::group(['prefix' => 'edit'], function () {
			Route::get('/', function () {
				echo 'admin post edit';
			});
			Route::get('3', function () {
				echo 'admin post edit 3';
			});
		});
	});
});

Route::get('greet', function () {
	return view('greeting')->with([
		'name' => 'Lê Văn Dũng',
		'age' => '21',
	]);
});

Route::get('setting', function () {
	return view('admin.setting');
});

Route::get('master', function () {
	return view('master');
});

Route::get('child', function () {
	return view('child');
});

Route::get('todo', function () {
	$list = ['học lara', 'avahd'];
	return view('todo')->with('list', $list);
});

Route::get('add', function () {
	return view('add');
})->name('todo.add');

// Route::get('/', 'HomeController@index');
// Route::get('page/{page?}', 'HomeController@page');
Route::group(['prefix' => 'home'], function () {
	Route::get('/', 'HomeController@index');
	Route::get('/{page?}', 'HomeController@page');
});

// Route::get('/admin/setting', 'Admin\SettingController@index');
// Route::get('/admin/show/{id}', 'Admin\SettingController@show');
// Route::get('/admin/user', 'Admin\UserController@index');

// Route::prefix('admin')->namespace('Admin')->group(function () {
// 	Route::get('setting', 'SettingController@index');
// 	Route::get('show/{id}', 'SettingController@show');
// 	Route::get('user', 'UserController@index');

// });

Route::group([
	'prefix' => 'admin',
	'namespace' => 'Admin',
], function () {
	Route::get('setting', 'SettingController@index');
	Route::get('show/{id}', 'SettingController@show');
	Route::get('user', 'UserController@index');

});

Route::resource('todos', 'TodoController');

Route::resource('users', 'UserController');
