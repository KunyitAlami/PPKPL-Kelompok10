<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Sistem Uji Tanah</title>
</head>
<body>
    <div style="max-width: 400px; margin: 50px auto; padding: 20px; border: 1px solid #ccc;">
        <h2>Login Sistem</h2>
        
        @if ($errors->any())
            <div style="color: red; margin-bottom: 15px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ url('/login') }}">
            @csrf
            <div style="margin-bottom: 10px;">
                <label>Email:</label><br>
                <input type="email" name="email" value="{{ old('email') }}" required style="width: 100%;">
            </div>
            <div style="margin-bottom: 10px;">
                <label>Password:</label><br>
                <input type="password" name="password" required style="width: 100%;">
            </div>
            <button type="submit" style="width: 100%; padding: 10px;">Login</button>
        </form>
    </div>
</body>
</html>