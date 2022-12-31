<?php

namespace App\Console\Commands;

use App\Jobs\SendEmailReoprtBestLibrarianJob;
use App\Models\Borrowing;
use App\Models\Librarian;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ReportBestLibrarianOfMonth extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'report:best-librarian';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Report the best Librarian of month';


	public function handle()
	{
		$startOfMonth = Carbon::now()->startOfMonth();
		$endOfMonth   = Carbon::now()->endOfMonth();

		// todo: handle if we have more than one librarian with the same total
		$theBestLibrarian = Borrowing::query()->whereBetween('created_at',[$startOfMonth,$endOfMonth])
									 ->select('librarian_id',DB::raw('count(*) as total'))
									 ->groupBy('librarian_id')
									 ->orderByDesc('total')
									 ->first();

		// librarian
		$librarian = Librarian::find($theBestLibrarian['librarian_id']);

		// send report to admin's email with a job
		$details['email']     = env('mail_admin_address');
		$details['full_name'] = $librarian->user->name;
		$details['total']     = $theBestLibrarian['total'];
		dispatch(new SendEmailReoprtBestLibrarianJob($details));
	}
}
