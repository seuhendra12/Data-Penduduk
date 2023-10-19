<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Penduduk extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    protected function provinsi() {
        return $this->belongsTo(Provinsi::class,'provinsi_id');
    }

    protected function kabupaten() {
        return $this->belongsTo(Kabupaten::class,'kabupaten_id');
    }
}
