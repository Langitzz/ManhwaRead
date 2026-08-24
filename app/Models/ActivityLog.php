<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'aktivitas', 'detail'])]
class ActivityLog extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function catat(string $aktivitas, ?string $detail = null): void
    {
        static::create([
            'user_id' => auth()->id(),
            'aktivitas' => $aktivitas,
            'detail' => $detail,
        ]);
    }
}