<?php

namespace Database\Seeders;

use App\Models\Librarian;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$librarians          = Librarian::all();

		foreach ($librarians as $key => $librarian) {
			$librarian->shifts()->create([
				'date' => Carbon::now()->addDay($key++)->toDateString()
			]);
		}
    }
}
