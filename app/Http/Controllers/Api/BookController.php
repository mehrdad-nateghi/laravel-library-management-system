<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Interfaces\ResponseInterface;
use App\Models\Book;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
	/**
	 * @param Book $model
	 * @param ResponseInterface $responseInterface
	 */
	public function __construct(public Book $model,public ResponseInterface $responseInterface){}

	public function index(Request $request): mixed
	{
		try {
			$book = $this->model->all();
			$request->merge([
				'data' => $book,
				'view' => 'book.index',
			]);
		} catch (Exception $exception) {
			throw new $exception;
		}

		return $this->responseInterface->respond($request);
	}


	/**
	 * @param StoreBookRequest $request
	 * @return mixed
	 * @throws Exception
	 */
	public function store(StoreBookRequest $request): mixed
	{
		try {
			DB::beginTransaction();
			$book = $this->model->create($request->validated());
			$request->merge([
				'data' => $book,
			]);
			DB::commit();
		} catch (Exception $exception) {
			DB::rollBack();
			throw new $exception;
		}

		return $this->responseInterface->respond($request);
	}

	public function update(UpdateBookRequest $request, Book $book): mixed
	{
		try {
			DB::beginTransaction();
			$book->update($request->validated());
			$request->merge([
				'data' => $book->refresh(),
			]);
			DB::commit();
		} catch (Exception $exception) {
			DB::rollBack();
			throw new $exception;
		}

		return $this->responseInterface->respond($request);
	}

	public function destroy(Request $request, Book $book): mixed
	{
		try {
			DB::beginTransaction();
			$book->delete();
			$request->merge([
				'data' => $book->refresh(),
			]);
			DB::commit();
		} catch (Exception $exception) {
			DB::rollBack();
			throw new $exception;
		}

		return $this->responseInterface->respond($request);
	}
}
