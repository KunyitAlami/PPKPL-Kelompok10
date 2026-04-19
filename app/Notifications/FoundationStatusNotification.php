<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class FoundationStatusNotification extends Notification
{
    use Queueable;

    protected $soilTest;

    public function __construct($soilTest)
    {
        $this->soilTest = $soilTest;
    }

    public function via($notifiable)
    {
        return ['database']; // simpan ke DB
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Status Kelayakan Fondasi',
            'message' => 'Hasil uji tanah Anda telah diverifikasi.',
            'status' => 'Layak', // bisa kamu kembangkan nanti
            'soil_test_id' => $this->soilTest->id,
        ];
    }
}