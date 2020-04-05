<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class TransactionController extends Controller
{
    public function index()
    {
    	$transaction = DB::table('transaksi')
    						->join('transaksi_detail', 'transaksi.id', 'transaksi_detail.id_transaksi')
    						->get();
    	// // dd($transaction);
    	// $transaction_loop = DB::table('transaksi')->get();
    	// $detail = [];
    	// foreach ($transaction_loop as $transaction_loop) {
    	// 	$transaksi_id = $transaction_loop->id;
    	// 	$no_transaksi = $transaction_loop->transaksi_no;
    	// 	$transaksi_detail = DB::table('transaksi_detail')
    	// 							->where('id_transaksi', $transaksi_id)
    	// 							->get();
    	// 	foreach ($transaksi_detail as $transaksi_detail) {
    	// 		$id_transaksi_detail = $transaksi_detail->id;
    	// 		$detail[$no_transaksi][$id_transaksi_detail] = $transaksi_detail->detail_transaksi_harga;
    	// 	}
    	// }

    	$transactions = DB::table('transaksi')->get();
    	$transaction_detail_arr = [];

    	foreach ($transactions as $transaction) {
    		$transaction_id 		= $transaction->id;
    		$no_transaction 		= $transaction->transaksi_no;
    		$transaction_details 	= $this->getTransactionDetail($transaction_id);
    		foreach ($transaction_details as $transaction_detail) {
    			$transaction_detail_id = $transaction_detail->id;
    			$transaction_detail_arr[$no_transaction]['transaction_detail'][$transaction_detail_id] = $this->productName($transaction_detail->id_produk);
    		}
    	}

    	$response = [
    		'status' => 'success',
    		'message' => 'Successfully displayed transaction',
    		'data' => $transaction_detail_arr
    	];

    	return response($response, 201);
    }


    private function getTransactionDetail($transaction_id){
    	$transaction_detail = DB::table('transaksi_detail')
    								->where('id_transaksi', $transaction_id)
    								->get();
    	return $transaction_detail; 
    }

    private function productName($product_id){
    	$product = DB::table('produk')->where('id', $product_id)->first();
    	$name = $product->produk_name;
    	return $name;
    }

    public function iterasi1()
    {
    	echo 'test';
    }
}
