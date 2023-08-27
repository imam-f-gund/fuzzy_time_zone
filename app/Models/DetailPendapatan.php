<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPendapatan extends Model
{
    use HasFactory;
    protected $table = 'detail_pendapatans';

    protected $fillable = [
        'pendapatan_id',
        'ukuran',
        'warna',
        'jenis_kaos', 
        'penjualan',  
        'pendapatan',
    ];

    public function pendapatan()
    {
        return $this->belongsTo(Pendapatan::class);
    }
}
