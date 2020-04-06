<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Transaksi;
use App\Model\Produk;
use App\Model\TransaksiDetail;

use Phpml\Association\Apriori;
use DB;

class TransactionController extends Controller
{
    public function index()
    {
    
        $transaksi = Transaksi::get();
        $data = [];
        foreach ($transaksi as $list) {
            $id[] = $list->id;
            $check_data = DB::table('transaksi_detail')
                            ->where('id_transaksi', $list->id)
                            ->count();
            if($check_data > 3){
                $detail = DB::table('transaksi_detail')
                        ->join('produk', 'transaksi_detail.id_produk', 'produk.id')
                        ->where('id_transaksi', $list->id)
                        ->select('transaksi_detail.id','produk.produk_name')
                        ->pluck('produk_name')->toArray();
                array_push($data, $detail);
            }
            
        }
        
        $associator = new Apriori($support = 0.0, $confidence = 0.1);
        $samples2 = [
            ['alpha', 'beta', 'epsilon'], ['alpha', 'beta', 'epsilon'],['alpha', 'beta', 'epsilon'], ['alpha', 'beta', 'theta'], ['alpha', 'beta', 'epsilon'], ['alpha', 'beta', 'theta']
        ];
        $samples = $data;
        $labels  = [];
        $associator->train($samples, $labels);

        return $associator->getRules();
        return $samples;
    }
}
