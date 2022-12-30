<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class LibrarianSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		User::factory(5)->create([
			'name' => 'Librarian ' . fake()->unixTime(),
		])->each(function ($user) {
			$user->librarian()->create();
		});
	}
}
