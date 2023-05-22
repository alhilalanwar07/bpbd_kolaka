<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posko extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'poskos';

    protected $fillable = ['nama_posko','nama_petugas','alamat_posko','no_hp','latitude','longitude','jumlah_pengungsi','status_posko','bencana_id','kecamatan_id','user_id'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bencana()
    {
        return $this->hasOne('App\Models\Bencana', 'id', 'bencana_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function kebutuhanPoskos()
    {
        return $this->hasMany('App\Models\KebutuhanPosko', 'posko_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function kecamatan()
    {
        return $this->hasOne('App\Models\Kecamatan', 'id', 'kecamatan_id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_id');
    }
    
}
