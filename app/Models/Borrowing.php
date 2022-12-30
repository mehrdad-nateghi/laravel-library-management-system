<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
	use HasFactory;

	protected $fillable = ['reader_id','librarian_id','book_id','period_start', 'period_end', 'return_date', 'status'];

	public function book()
	{
		return $this->belongsTo(Book::class);
	}

	public function librarian()
	{
		return $this->belongsTo(Librarian::class);
	}

	public function reader()
	{
		return $this->belongsTo(Reader::class);
	}
}
