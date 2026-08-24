<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'judul',
    'slug',
    'penulis',
    'ilustrator',
    'tahun_terbit',
    'sinopsis',
    'cover',
    'status',
])]
class Manhwa extends Model
{
    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class);
    }
}
