<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KebutuhanPosko extends Model
{
	use HasFactory;

    public $timestamps = true;

    protected $table = 'kebutuhan_poskos';

    protected $fillable = ['posko_id','barang_id','jumlah_kebutuhan','jenis_kebutuhan','status_kebutuhan', 'satuan_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function barang()
    {
        return $this->hasOne('App\Models\Barang', 'id', 'barang_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function posko()
    {
        return $this->hasOne('App\Models\Posko', 'id', 'posko_id');
    }

}
