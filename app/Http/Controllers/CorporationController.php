<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Corporation;

/**
 * 会社コントローラ.
 */
class CorporationController extends Controller
{
	/**
	 * 一覧画面表示.
	 */
    public function index()
    {
    	$corporations = Corporation::all();
    	return view('corporations.index')->with('corporations', $corporations);
    }
}
