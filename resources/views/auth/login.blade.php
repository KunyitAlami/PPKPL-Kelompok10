<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Uji Tanah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen font-sans">

    <div class="w-full max-w-md bg-white border rounded-xl shadow-sm p-6">

        <!-- Title -->
        <h2 class="text-xl font-bold mb-4 text-center">
            Login Sistem
        </h2>

        <!-- Error -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-600 p-3 rounded-lg mb-4">
                {{ $errors->first() }}
            </div>
        @endif

        <!-- Form -->
        <form method="POST" action="{{ url('/login') }}" class="space-y-4">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required
                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
            </div>

            <!-- Password -->
            <div>
                <label class="block text-sm font-medium mb-1">Password</label>
                <input 
                    type="password" 
                    name="password" 
                    required
                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400"
                >
            </div>

            <!-- Button -->
            <button 
                type="submit"
                class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition"
            >
                Login
            </button>
        </form>

    </div>

</body>
</html>