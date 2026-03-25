<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Iskandar Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
</head>
<body>
    <div class="wrapper">
        <aside class="sidebar">
            <div class="profile-circle">
                <div class="profile-avatar">IZ</div>
            </div>
            <div class="username">Iskandar</div>
            <nav class="nav-links">
                <a href="{{ route('dashboard.index') }}" class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i>Dashboard</a>
                <a href="{{ route('timeline.index') }}" class="nav-item"><i class="fas fa-history"></i>Timeline</a>
                <a href="{{ route('projects.index') }}" class="nav-item {{ request()->is('projects*') ? 'active' : '' }}"><i class="fas fa-folder"></i>Projects</a>
                <a href="{{ route('users.index')}}" class="nav-item {{ request()->is('users*') ? 'active' : '' }}"><i class="fas fa-users"></i>Users</a>
                <a href="{{ route('settings.index') }}" class="nav-item {{ request()->is('settings*') ? 'active' : '' }}"><i class="fas fa-cog"></i>Settings</a>
            </nav>
            <a href="{{ route('logout.index') }}" class="logout">Log Out</a>
        </aside>

        <main class="main-container">
            <header class="top-header">
                <div class="header-left"><h1>My Account</h1></div>
                <div class="header-right">
                    <i class="far fa-envelope"></i>
                    <i class="far fa-bell"></i>
                    <div class="search-container">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search">
                    </div>
                    <button class="btn-create"><i class="fas fa-plus-circle"></i> Create</button>
                </div>
            </header>

            <div class="settings-layout">
    <nav class="settings-sub-nav">
        <a href="{{ route('settings.index') }}" class="sub-nav-item">My Profile</a>
        <a href="{{ route('security.index') }}" class="sub-nav-item active">Security</a>
        <a href="{{ route('password.index') }}" class="sub-nav-item">Password</a>
        <a href="{{ route('deleteaccount.index') }}" class="sub-nav-item">Account</a>    
    </nav>

    <div class="p-security-container">
    <h2>Set Two-Factor authentication</h2>
    <p class="p-security-desc">
        This platform requires you to protect your account with 2FA. How would you like to receive one-time passwords (OTP)?
    </p>

    <div class="p-2fa-options">
        <label class="p-2fa-card">
            <input type="radio" name="2fa_method" value="app" checked>
            <span class="p-radio-custom"></span>
            <div class="p-2fa-info">
                <strong>Mobile app authenticator</strong>
                <span>Use a mobile app to generate verification codes</span>
            </div>
        </label>

        <label class="p-2fa-card">
            <input type="radio" name="2fa_method" value="email">
            <span class="p-radio-custom"></span>
            <div class="p-2fa-info">
                <strong>Email</strong>
                <span>Receive verification codes via email</span>
            </div>
        </label>
    </div>

    <button type="button" class="p-btn-continue">Continue</button>
</div>
</body>