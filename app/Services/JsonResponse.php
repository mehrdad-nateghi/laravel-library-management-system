<?php

namespace App\Services;

use App\Interfaces\ResponseInterface;
use Illuminate\Http\Request;

class JsonResponse implements ResponseInterface
{
	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function respond(Request $request): \Illuminate\Http\JsonResponse
	{
		return response()->json($request->data);
	}
}