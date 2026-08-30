<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable([
    'manhwa_id',
    'nomor_chapter',
    'judul_chapter',
    'thumbnail',
    'tanggal_rilis',
])]
class Chapter extends Model
{
    protected function casts(): array
    {
        return [
            'tanggal_rilis' => 'date',
        ];
    }

    public function manhwa(): BelongsTo
    {
        return $this->belongsTo(Manhwa::class);
    }

    public function pages(): HasMany
    {
        return $this->hasMany(ChapterPage::class)->orderBy('nomor_halaman');
    }

    public function firstPage(): HasOne
    {
        return $this->hasOne(ChapterPage::class)->orderBy('nomor_halaman');
    }
}