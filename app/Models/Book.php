<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;
	use SoftDeletes;

	protected $fillable = ['name','author_id'];
	protected $with = ['author'];

	protected $hidden = ['author_id'];

	public function author()
	{
		return $this->belongsTo(Author::class);
	}

	public function borrowings(): HasMany
	{
		return $this->hasMany(Borrowing::class);
	}

	public function existBorrowed(): bool
	{
		return $this->borrowings()
					->whereNull('return_date')
					->where('status', 'issued')
					->exists();
	}
}
