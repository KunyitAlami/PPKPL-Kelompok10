<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Notifikasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans p-6">

<div class="max-w-3xl mx-auto">

    <!-- Header -->
    <h2 class="text-xl font-bold mb-6">
        Notifikasi Kelayakan Fondasi
    </h2>

    <!-- List Notifikasi -->
    @forelse($notifications as $notif)
        <div class="bg-white border rounded-xl shadow-sm p-4 mb-4">

            <!-- Title -->
            <h3 class="font-semibold text-gray-800 mb-1">
                {{ $notif->data['title'] }}
            </h3>

            <!-- Message -->
            <p class="text-gray-600 text-sm mb-2">
                {{ $notif->data['message'] }}
            </p>

            <!-- Status -->
            @php
                $status = strtolower($notif->data['status']);
                $color = match($status) {
                    'layak' => 'bg-green-100 text-green-700',
                    'tidak layak' => 'bg-red-100 text-red-700',
                    default => 'bg-gray-100 text-gray-600'
                };
            @endphp

            <span class="inline-block px-2 py-1 text-xs rounded-lg {{ $color }}">
                {{ $notif->data['status'] }}
            </span>

        </div>
    @empty
        <div class="text-center text-gray-500 bg-white border rounded-xl p-6">
            Tidak ada notifikasi.
        </div>
    @endforelse

</div>

</body>
</html>