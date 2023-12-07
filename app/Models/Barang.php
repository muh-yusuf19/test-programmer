<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = ['kodebrg', 'namabrg', 'satuan', 'hargabeli'];

    protected $table = 'tbl_barang';
}
