<?php

namespace App\Rules;

use App\Models\Book;
use Illuminate\Contracts\Validation\InvokableRule;

class BookCanBorrow implements InvokableRule
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
		/* @var Book $book */
		$book          = Book::query()->find($value);
		$existBorrowed = $book->existBorrowed();

		if($existBorrowed){
			$fail('validation.book_id')->translate();
		}
	}
}
