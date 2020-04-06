<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    public function detail()
    {
    	return $this->hasMany(TransaksiDetail::Class, 'id_transaksi');
    }
}
