<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'dokumentasis';

    protected $fillable = ['keterangan','gambar_penyerahan','pdf_laporan', 'user_id', 'status'];
	
}
