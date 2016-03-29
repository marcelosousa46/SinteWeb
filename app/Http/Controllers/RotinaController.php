<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class RotinaController extends Controller
{
	public function index()
	{
		$rotinas = Rotinas::all();
		return $rotinas;
	}
}
