<h2>Notifikasi Kelayakan Fondasi</h2>

@forelse($notifications as $notif)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
        <strong>{{ $notif->data['title'] }}</strong><br>
        {{ $notif->data['message'] }}<br>
        Status: <b>{{ $notif->data['status'] }}</b>
    </div>
@empty
    <p>Tidak ada notifikasi.</p>
@endforelse