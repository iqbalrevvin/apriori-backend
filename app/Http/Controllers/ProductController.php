<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProductController extends Controller
{
    public function index()
    {
    	$product = DB::table('produk')->get();

    	$response = [
    		'status' => 'success',
    		'message' => 'Successfully displayed product',
    		'amount_data' => $product->count(),
    		'data' => $product
    	];

    	return response($response, 201);
    }
}
