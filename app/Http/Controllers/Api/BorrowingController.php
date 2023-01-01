<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBorrowingRequest;
use App\Http\Resources\BorrowingResource;
use App\Interfaces\BorrowingRepositoryInterface;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

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
	 * @throws Exception
	 */

	public function store(StoreBorrowingRequest $request): JsonResponse
	{
		$validated = $request->validated();

		try {
			DB::beginTransaction();
			$borrowing = $this->borrowingRepository->create($validated);
			DB::commit();
		} catch (Exception $exception) {
			DB::rollBack();
			throw new $exception;
		}

		return response()->json(['data' => new BorrowingResource($borrowing)],Response::HTTP_CREATED);
	}
}
