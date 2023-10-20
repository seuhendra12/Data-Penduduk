<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provinsi extends Model
{
    use HasFactory, SoftDeletes;
    protected $guarded=[];

    protected function penduduk() {
        return $this->hasMany(Penduduk::class);
    }
}
