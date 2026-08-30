<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'judul',
    'judul_alternatif',
    'slug',
    'penulis',
    'ilustrator',
    'tahun_terbit',
    'sinopsis',
    'cover',
    'status',
    'rating',
    'views',
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

    public function bookmarks(): HasMany
    {
        return $this->hasMany(Bookmark::class);
    }
}