<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBorrowingRequest;
use App\Http\Resources\BorrowingResource;
use App\Interfaces\BorrowingRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use function App\Http\Controllers\apiResource;

class BorrowingController extends Controller
{
	private BorrowingRepositoryInterface $borrowingRepository;

	public function __construct(BorrowingRepositoryInterface $borrowingRepository)
	{
		$this->borrowingRepository = $borrowingRepository;
	}

	/**
	 * Store a newly created resource in storage.
	 * @param StoreBorrowingRequest $request
	 * @return JsonResponse
	 * @throws \Exception
	 */

	public function store(StoreBorrowingRequest $request)
	{
		$validated = $request->validated();

		try {
			DB::beginTransaction();

			$borrowedBook = $this->borrowingRepository->create($validated);

			DB::commit();
		} catch (\Exception $exception) {
			DB::rollBack();
			throw $exception;
		}

		return response()->json(['data' => new BorrowingResource($borrowedBook)],Response::HTTP_CREATED);
	}
}
