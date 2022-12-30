<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Reader extends Model
{
	use HasFactory;

	protected $fillable = [
		'card_number',
	];

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
}
