<?php

namespace App\Http\Requests;

use App\Rules\BookCanBorrow;
use App\Rules\ReaderCanBorrow;
use Illuminate\Foundation\Http\FormRequest;

class StoreBorrowingRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules()
	{
		return [
			'card_number'  => ['bail','required','numeric','exists:readers,card_number', new ReaderCanBorrow],
			'book_id'      => ['bail','required','numeric','exists:books,id', new BookCanBorrow],
			'period_start' => ['bail','required','date','after_or_equal:today'],
			'period_end'   => ['bail','required','date','after_or_equal:period_start'], // or after:period_start
		];
	}
}
