<?php

namespace App\Http\Requests;

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
			'card_number'  => 'required|exists:readers,card_number',
			'book_id'      => 'required|exists:books,id',
			'period_start' => 'required|after_or_equal:today',
			'period_end'   => 'required|after:period_start',
		];
	}
}
