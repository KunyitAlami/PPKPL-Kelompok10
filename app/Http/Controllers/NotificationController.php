<?php

namespace App\Http\Controllers;

use App\Models\SoilTestModel;
use App\Notifications\FoundationStatusNotification;
use Illuminate\Support\Facades\Notification;

class NotificationController extends Controller
{
    public function send(SoilTestModel $soilTest)
    {
        // ❗ RULE R1
        if ($soilTest->status !== 'Terverifikasi') {
            return back()->with('error', 'Belum terverifikasi!');
        }

        $owner = $soilTest->proyek->pemilik;

        // kirim notifikasi
        $owner->notify(new FoundationStatusNotification($soilTest));

        return back()->with('success', 'Notifikasi berhasil dikirim ke pemilik rumah.');
    }

    public function index()
    {
        $notifications = auth()->user()->notifications;

        return view('notifications.index', compact('notifications'));
    }
}