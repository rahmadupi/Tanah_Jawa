<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $table = 'article';
    protected $primaryKey = 'index';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'index',
        'judul',
        'gambar',
        'deskripsi',
        'konten',
        'url',
    ];
}
