<?php
namespace App\Interfaces;

use Illuminate\Http\Request;

interface ResponseInterface
{
	public function respond(Request $request): mixed;
}