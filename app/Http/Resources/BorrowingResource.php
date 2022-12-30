<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BorrowingResource extends JsonResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param Request $request
	 * @return array
	 */
	public function toArray($request)
	{
		return [
			'id'           => $this->id,
			'book'         => $this->book,
			'librarian'    => $this->librarian,
			'reader'       => $this->reader,
			'period_start' => $this->period_start,
			'period_end'   => $this->period_end,
			'created_at'   => $this->created_at,
			'updated_at'   => $this->updated_at,
		];
	}
}
