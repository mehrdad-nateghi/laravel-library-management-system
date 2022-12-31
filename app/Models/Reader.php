<?php

namespace App\Models;

use Carbon\Carbon;
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

	public function borrowings(): HasMany
	{
		return $this->hasMany(Borrowing::class);
	}

	public function existDelay(): bool
	{
		return $this->borrowings()
			   ->where('period_end','<', Carbon::now()->toDateString())
			   ->whereNull('return_date')
			   ->where('status', 'issued')
			   ->exists();
	}
}
