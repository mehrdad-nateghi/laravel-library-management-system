<?php
namespace App\Interfaces;

interface BorrowingRepositoryInterface
{
	public function create(array $orderDetails);
}