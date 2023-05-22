<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bencana extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'bencanas';

    protected $fillable = ['nama_bencana','deskripsi_bencana'];
	
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function poskos()
    {
        return $this->hasMany('App\Models\Posko', 'bencana_id', 'id');
    }
    
}
