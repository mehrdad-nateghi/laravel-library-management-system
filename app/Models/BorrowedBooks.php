<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowedBooks extends Model
{
    use HasFactory;

	protected $fillable = ['period_start', 'period_end', 'return_date', 'status'];

	public function librarian()
	{
		$this->belongsTo(Librarian::class);
	}

	public function reader()
	{
		$this->belongsTo(Reader::class);
	}
}
