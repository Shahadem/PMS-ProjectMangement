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

   <div class="p-security-container" style="max-width: 620px; margin: 40px auto; text-align: center; padding: 20px; font-family: 'Inter', -apple-system, sans-serif;">
    <div style="width: 72px; height: 72px; background: #EBF8FF; color: #3182CE; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px; font-size: 32px;">
        <i class="fas fa-mobile-alt"></i>
    </div>

    <h2 style="font-size: 26px; font-weight: 800; color: #1A202C; margin-bottom: 8px; letter-spacing: -0.5px;">Set up mobile app authenticator</h2>
    <p style="color: #718096; font-size: 15px; margin-bottom: 32px;">To use a mobile app for 2FA, please follow these steps:</p>

    <div style="text-align: left; background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 16px; padding: 35px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03); margin-bottom: 28px;">
        
        <div style="display: flex; gap: 20px; margin-bottom: 32px;">
            <div style="min-width: 28px; height: 28px; background: #3182CE; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 700;">1</div>
            <div>
                <p style="margin: 0; font-weight: 700; color: #2D3748; font-size: 16px;">Install an authenticator app</p>
                <p style="margin: 4px 0 0; font-size: 14px; color: #718096; line-height: 1.6;">Download Google Authenticator or Authy from the App Store or Play Store.</p>
            </div>
        </div>

        <div style="display: flex; gap: 20px; margin-bottom: 32px;">
            <div style="min-width: 28px; height: 28px; background: #3182CE; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 700;">2</div>
            <div style="flex: 1;">
                <p style="margin: 0; font-weight: 700; color: #2D3748; font-size: 16px; margin-bottom: 16px;">Scan the QR code</p>
                <div style="display: flex; align-items: center; gap: 24px; background: #F8FAFC; padding: 24px; border-radius: 12px; border: 1px solid #EDF2F7;">
                    <div style="width: 130px; height: 130px; background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 10px; display: flex; align-items: center; justify-content: center; padding: 8px;">
                        <i class="fas fa-qrcode" style="font-size: 110px; color: #1A202C;"></i>
                    </div>
                    <div style="flex: 1;">
                        <p style="margin: 0; font-size: 13px; color: #718096; margin-bottom: 10px;">Can't scan the code? Enter this key manually:</p>
                        <div style="background: #FFFFFF; border: 1px solid #E2E8F0; padding: 10px 14px; border-radius: 8px; display: block; text-align: center;">
                            <span style="font-family: 'SFMono-Regular', Consolas, monospace; font-size: 15px; font-weight: 700; color: #3182CE; letter-spacing: 1px;">JBSW Y3DP EHPX S33T</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="display: flex; gap: 20px;">
            <div style="min-width: 28px; height: 28px; background: #3182CE; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 700;">3</div>
            <div style="flex: 1;">
                <p style="margin: 0; font-weight: 700; color: #2D3748; font-size: 16px; margin-bottom: 16px;">Enter verification code</p>
                <div style="display: flex; gap: 8px; align-items: center; margin-top: 4px;">
                    <input type="text" maxlength="1" style="width: 46px; height: 54px; text-align: center; border: 1.5px solid #E2E8F0; border-radius: 10px; font-size: 22px; font-weight: 700; color: #2D3748; outline: none; background: #F9FAFB;" onfocus="this.style.borderColor='#3182CE'; this.style.background='#fff';">
                    <input type="text" maxlength="1" style="width: 46px; height: 54px; text-align: center; border: 1.5px solid #E2E8F0; border-radius: 10px; font-size: 22px; font-weight: 700; color: #2D3748; outline: none; background: #F9FAFB;" onfocus="this.style.borderColor='#3182CE'; this.style.background='#fff';">
                    <input type="text" maxlength="1" style="width: 46px; height: 54px; text-align: center; border: 1.5px solid #E2E8F0; border-radius: 10px; font-size: 22px; font-weight: 700; color: #2D3748; outline: none; background: #F9FAFB;" onfocus="this.style.borderColor='#3182CE'; this.style.background='#fff';">
                    <div style="width: 14px; height: 2px; background: #CBD5E0; margin: 0 4px;"></div>
                    <input type="text" maxlength="1" style="width: 46px; height: 54px; text-align: center; border: 1.5px solid #E2E8F0; border-radius: 10px; font-size: 22px; font-weight: 700; color: #2D3748; outline: none; background: #F9FAFB;" onfocus="this.style.borderColor='#3182CE'; this.style.background='#fff';">
                    <input type="text" maxlength="1" style="width: 46px; height: 54px; text-align: center; border: 1.5px solid #E2E8F0; border-radius: 10px; font-size: 22px; font-weight: 700; color: #2D3748; outline: none; background: #F9FAFB;" onfocus="this.style.borderColor='#3182CE'; this.style.background='#fff';">
                    <input type="text" maxlength="1" style="width: 46px; height: 54px; text-align: center; border: 1.5px solid #E2E8F0; border-radius: 10px; font-size: 22px; font-weight: 700; color: #2D3748; outline: none; background: #F9FAFB;" onfocus="this.style.borderColor='#3182CE'; this.style.background='#fff';">
                </div>
            </div>
        </div>
    </div>

    <div style="display: flex; gap: 15px; padding: 0 5px;">
        <button type="button" style="flex: 1; padding: 15px; background: #FFFFFF; color: #4A5568; border: 1px solid #E2E8F0; border-radius: 12px; font-weight: 700; font-size: 15px; cursor: pointer;">Cancel</button>
        <button type="button" style="flex: 2; padding: 15px; background: #3182CE; color: #FFFFFF; border: none; border-radius: 12px; font-weight: 700; font-size: 15px; cursor: pointer; box-shadow: 0 4px 14px rgba(49, 130, 206, 0.3);">Verify and Activate</button>
    </div>
</div>
</body>