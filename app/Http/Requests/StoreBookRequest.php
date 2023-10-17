<?php

namespace App\Http\Requests;

use App\Rules\BookCanBorrow;
use App\Rules\ReaderCanBorrow;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return TRUE;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules()
	{
		return [
			'name'         => ['required','string'],
			'author_id'    => ['bail','required','numeric','exists:authors,id'],
		];
	}
}
