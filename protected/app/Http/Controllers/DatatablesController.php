<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use User;
use App\ContentSlider;
use Datatables;

class DatatablesController extends Controller
{
    /**
	 * Displays datatables front end view
	 *
	 * @return \Illuminate\View\View
	 */
	public function index()
	{
		return view('datatables.index');
	}

	/**
	 * Process datatables ajax request.
	 *
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function anyData()
	{
		return Datatables::of(ContentSlider::query())->make(true);
	}
}
