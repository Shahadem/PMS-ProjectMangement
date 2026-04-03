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
            
            <form action="{{ route('dashboard.index') }}" method="GET">
                <div class="form-group">
                    <label>Email Address</label>
                    <div class="input-icon">
                        <i class=""></i>
                        <input type="email" placeholder="Enter your email" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <div class="input-icon">
                        <i class=""></i>
                        <input type="password" placeholder="••••••••" required>
                    </div>
                </div>

                <div class="login-options">
                    <label><input type="checkbox"> Remember me</label>
                    <a href="/forgotpassword">Forgot Password?</a>
                </div>

                <button type="submit" class="btn-login">Sign In</button>
            </form>
            
            <p class="signup-text">Don't have an account? <a href="{{ route('register.index') }}">Create one</a></p>
        </div>
    </div>
</body>
</html>