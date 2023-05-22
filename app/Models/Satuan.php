<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satuan extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'satuans';

    protected $fillable = ['nama_satuan'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function logistiks()
    {
        return $this->hasMany('App\Models\Logistik', 'satuan_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stoks()
    {
        return $this->hasMany('App\Models\Stok', 'satuan_id', 'id');
    }
    
}
