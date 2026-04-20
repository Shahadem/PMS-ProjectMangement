<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - Project Overview</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
</head>
<body class="login-page">
    <div class="login-container">
        <div class="login-box">
            <div class="login-logo">
                <div class="avatar-lg">IZ</div>
                <h2>Welcome Back</h2>
                <p>Please enter your details to sign in</p>
            </div>

            @if (session('status'))
                <div style="margin-bottom: 16px; padding: 12px; border-radius: 10px; background: #EBF8FF; color: #2B6CB0; font-size: 14px;">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div style="margin-bottom: 16px; padding: 12px; border-radius: 10px; background: #FFF5F5; color: #C53030; font-size: 14px;">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-icon">
                        <i class="fa-regular fa-envelope"></i>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Enter your email"
                            autocomplete="email"
                            required
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-icon">
                        <i class="fa-solid fa-lock"></i>
                        <input
                            type="password"
                            id="password"
                            name="password"
                            placeholder="••••••••"
                            autocomplete="current-password"
                            required
                        >
                    </div>
                </div>

                <div class="login-options">
                    <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        Remember me
                    </label>
                    <a href="{{ route('forgotpassword.index') }}">Forgot Password?</a>
                </div>

                <button type="submit" class="btn-login">Log In</button>
            </form>

            <p class="signup-text">Don't have an account? <a href="{{ route('register.index') }}">Create one</a></p>
        </div>
    </div>
</body>
</html>