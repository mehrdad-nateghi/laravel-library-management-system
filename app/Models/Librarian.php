<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Librarian extends Model
{
    use HasFactory;
	use SoftDeletes;

	protected $hidden = ['user_id'];

	protected $with = ['user'];

	/**
	 * @return BelongsTo
	 */
	public function user(): BelongsTo
	{
		return $this->belongsTo(User::class);
	}

	public function borrowedBooks(): HasMany
	{
		return $this->hasMany(BorrowedBooks::class);
	}

	public function shifts()
	{
		return $this->hasMany(Shift::class);
	}
}
