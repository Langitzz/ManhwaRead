<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['nama_genre', 'deskripsi', 'status'])]
class Genre extends Model
{
    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }

    public function manhwas(): BelongsToMany
    {
        return $this->belongsToMany(Manhwa::class);
    }
}
