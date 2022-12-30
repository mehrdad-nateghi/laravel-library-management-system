<?php
namespace App\Repositories;

use App\Interfaces\BorrowingRepositoryInterface;
use App\Models\Borrowing;
use App\Models\Reader;
use App\Models\Shift;
use Carbon\Carbon;

class BorrowingRepository implements BorrowingRepositoryInterface{

	protected $model;

	public function __construct(Borrowing $borrowing)
	{
		$this->model = $borrowing;
	}

	public function create(array $payload)
	{
		$payload['librarian_id'] = Shift::where('date', Carbon::now()->toDateString())->orderBy('id', 'desc')->first()->librarian_id;
		$payload['reader_id']    = Reader::where('card_number',$payload['card_number'])->first()->id;
		$payload['status']       = 'issued';

		return $this->model->create($payload);
	}
}