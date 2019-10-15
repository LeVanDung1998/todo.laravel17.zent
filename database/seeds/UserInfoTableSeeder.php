<?php

use Illuminate\Database\Seeder;

class UserInfoTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		\DB::table('user_info')->insert([
			'fullname' => 'levandung',
			'address' => 'thaibinh',
			'user_id' => 8,
			'created_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
			'updated_at' => \Carbon\Carbon::now()->format('Y-m-d H:i:s'),
		]);
	}
}
