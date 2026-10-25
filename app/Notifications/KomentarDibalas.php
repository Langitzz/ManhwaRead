<?php

namespace App\Notifications;

use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Str;

class KomentarDibalas extends Notification
{
    use Queueable;

    public function __construct(
        public Comment $balasan,
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $balasan = $this->balasan->loadMissing(['user', 'manhwa', 'chapter']);
        $manhwa = $balasan->manhwa;
        $chapter = $balasan->chapter;

        $urlDasar = $chapter
            ? route('chapter.read', [$manhwa->slug, $chapter->nomor_chapter])
            : route('manhwa.detail', $manhwa->slug);

        return [
            'pembalas' => $balasan->user->name ?? 'User',
            'isi' => Str::limit($balasan->isi, 80),
            'manhwa_judul' => $manhwa->judul,
            'url' => $urlDasar . '#komentar-' . $balasan->id,
        ];
    }
}