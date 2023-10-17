<?php

namespace App\Services;

use App\Interfaces\ResponseInterface;
use Illuminate\Http\Request;

class ViewResponse implements ResponseInterface
{
	/**
	 * @param Request $request
	 * @return mixed
	 */
	public function respond($response): mixed
	{
		return view($response->view, compact($response->data));
	}
}