<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'barangs';

    protected $fillable = ['nama_barang','status_barang', 'stok'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kebutuhanPoskos()
    {
        return $this->hasMany('App\Models\KebutuhanPosko', 'barang_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logistiks()
    {
        return $this->hasMany('App\Models\Logistik', 'barang_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stoks()
    {
        return $this->hasMany('App\Models\Stok', 'barang_id', 'id');
    }
    
}
