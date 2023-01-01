<?php

namespace App\Rules;

use App\Models\Reader;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\InvokableRule;

class ReaderCanBorrow implements InvokableRule
{
	/**
	 * Run the validation rule.
	 *
	 * @param string $attribute
	 * @param mixed $value
	 * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
	 * @return void
	 */
	public function __invoke($attribute,$value,$fail): void
	{
		/* @var Reader $reader */
		$reader = Reader::query()->where('card_number', 'like' ,"%{$value}%")->first();

		if(!empty($reader) && $reader->existDelay()){
			$fail('validation.custom.reader.exists_delay')->translate();
		}
	}
}
