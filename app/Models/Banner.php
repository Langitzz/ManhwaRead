<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['judul', 'gambar', 'link_url', 'urutan', 'status'])]
class Banner extends Model
{
    protected function casts(): array
    {
        return [
            'status' => 'boolean',
        ];
    }
}