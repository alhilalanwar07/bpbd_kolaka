<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'stoks';

    protected $fillable = ['barang_id','satuan_id','jumlah_masuk','tgl_masuk','harga_satuan','total_harga'];
	
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
    public function satuan()
    {
        return $this->hasOne('App\Models\Satuan', 'id', 'satuan_id');
    }
    
}
