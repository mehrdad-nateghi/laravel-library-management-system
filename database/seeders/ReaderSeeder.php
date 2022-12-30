<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Reader;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReaderSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		User::factory(5)->create([
			'name' => 'Reader ' . fake()->unixTime(),
		])->each(function ($user) {
			Reader::factory()->create([
				'user_id' => $user->id
			]);
		});
	}
}
