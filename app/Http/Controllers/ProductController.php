<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Produk;

class ProductController extends Controller
{
    public function index()
    {
    	$product = Produk::All();

    	$response = [
    		'status' => 'success',
    		'message' => 'Successfully displayed product',
    		'data' => $product
    	];

    	return response($response, 201);
    }
}
