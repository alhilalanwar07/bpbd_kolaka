<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'kecamatans';

    protected $fillable = ['kode_kecamatan','nama_kecamatan','luas_wilayah','jumlah_penduduk'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function poskos()
    {
        return $this->hasMany('App\Models\Posko', 'kecamatan_id', 'id');
    }
    
}
