<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NotifikasiController extends Controller
{
    public function baca(Request $request, string $id)
    {
        $notifikasi = $request->user()->notifications()->findOrFail($id);
        $notifikasi->markAsRead();

        return redirect($notifikasi->data['url'] ?? route('home'));
    }

    public function bacaSemua(Request $request)
    {
        $request->user()->unreadNotifications->markAsRead();

        return back();
    }
}