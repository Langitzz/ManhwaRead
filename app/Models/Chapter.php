<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'manhwa_id',
    'nomor_chapter',
    'judul_chapter',
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
}