<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    protected $table = 'transaksi_detail';

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::Class, 'id_transaksi');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::Class, 'id_produk');
    }
}
