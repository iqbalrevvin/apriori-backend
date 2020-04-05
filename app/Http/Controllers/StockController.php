<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class StockController extends Controller
{
    public function index()
    {
    	$stock = DB::table('stok')->get();

    	$response = [
    		'status' => 'success',
    		'message' => 'Successfully displayed stock',
    		'amount_data' => $stock->count(),
    		'data' => $stock
    	];

    	return response($response, 201);
    }
}
