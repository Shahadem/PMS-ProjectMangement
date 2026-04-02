<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Iskandar Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
</head>
<style>
      /* ─── CONTENT AREA ─── */
  .content-area {
    flex: 1;
    padding: 32px 40px;
    background:;
    overflow-y: auto;
  }
 
  /* ─── 2FA CARD ─── */
  .twofa-card {
    background: #fff;
    border: 0px solid #e8e8ef;
    border-radius: 14px;
    padding: 32px 36px 28px;
    max-width: 580px;
  }
 
  /* Back header */
  .card-header {
    display: flex; align-items: center; gap: 10px;
    margin-bottom: 24px;
    padding-bottom: 18px;
    border-bottom: 0px solid #f0f0f5;
  }
 
  .back-btn {
    width: 30px; height: 30px;
    background: none; border: none; cursor: pointer;
    border-radius: 7px; color: #555;
    display: flex; align-items: center; justify-content: center;
    transition: background 0.15s;
    flex-shrink: 0;
  }
  .back-btn:hover { background: #f3f3f7; }
  .back-btn svg { width: 17px; height: 17px; }
 
  .card-header h2 {
    font-size: 15px; font-weight: 700; color: #18181b;
    letter-spacing: -0.2px;
  }
 
  /* Intro block */
  .intro-block { margin-bottom: 22px; }
  .intro-block .intro-label {
    font-size: 13.5px; font-weight: 700; color: #18181b; margin-bottom: 3px;
  }
  .intro-block .intro-desc { font-size: 12.5px; color: #6b7280; line-height: 1.5; }
 
  /* Step rows */
  .step { margin-bottom: 22px; }
  .step:last-child { margin-bottom: 0; }
 
  .step-title {
    font-size: 13px; font-weight: 700; color: #18181b; margin-bottom: 4px;
  }
  .step-desc { font-size: 12.5px; color: #6b7280; line-height: 1.5; }
 
  /* QR section */
  .qr-section { margin-top: 12px; }

  .qrimage {
    width: 106px;
    height: 104px;
    top: 372px;
    left: 349px;
  }
 
  .qr-img-box {
    width: 100px; height: 100px;
    border: 0px solid #dde1ea; border-radius: 8px;
    overflow: hidden; background: #fff;
    display: flex; align-items: center; justify-content: center;
    margin-bottom: 12px;
  }
 
  .qr-img-box svg { width: 86px; height: 86px; }
 
  .manual-label {
    font-size: 12px; color: #6b7280; margin-bottom: 7px;
  }
 
  .manual-key-box {
    background: #ede8f7;
    border-radius: 0px;
    padding: 11px 16px;
    display: inline-block;
    min-width: 240px;
  }
  .manual-key-box span {
    font-family: 'inheritan';
    font-size: 16px; font-weight: 700;
    color: #626262; letter-spacing: 1.5px;
  }
 
  /* OTP input */
  .otp-input {
    margin-top: 10px;
    width: 100%; max-width: 280px;
    height: 42px;
    border: 1.5px solid #dde1ea;
    border-radius: 8px;
    padding: 0 13px;
    font-size: 13.5px;
    font-family: inherit;
    color: #18181b; background: #fafafa; outline: none;
    transition: border-color 0.15s, background 0.15s;
  }
  .otp-input::placeholder { color: #b5b5c3; }
  .otp-input:focus { border-color: #4d7cf6; background: #fff; }
 
  /* Footer */
  .card-footer {
    display: flex; align-items: center; justify-content: flex-end;
    gap: 50px;
    margin-top: 28px;
    padding-top: 18px;
    border-top: 0px solid #f0f0f5;
  }
 
  .btn-cancel {
    background: none; 
    border: none;
    font-family: inherit; 
    font-size: 13.5px; 
    font-weight: 500;
    color: #6b7280; 
    cursor: pointer;
    padding: 9px 12px; 
    border-radius: 8px; 
    transition: color 0.15s;
}

  .btn-cancel:hover { color: #18181b; }
 
  .btn-verify {
    width: 147px;
    background: #2A9FFF; border: none;
    border-radius: 7.99px; padding: 11px 30px;
    font-family: inherit; font-size: 13.5px; font-weight: 700;
    color: #fff; cursor: pointer;
    box-shadow: 0 3px 10px rgba(77,124,246,0.28);
    transition: background 0.15s, transform 0.1s;
  }
  .btn-verify:hover { background: #3a6ae8; }
  .btn-verify:active { transform: scale(0.98); }
</style>
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

    <!-- Content -->
    <div class="content-area">
 
      <div class="twofa-card">
 
        <!-- Card Header -->
        <div class="card-header">
          <button class="back-btn" aria-label="Back">
            <a href="/security">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.3"
                 stroke-linecap="round" stroke-linejoin="round">
              <polyline points="15 18 9 12 15 6"/>
            </svg>
            </a>
          </button>
          <h2>Set Two-Factor authentication</h2>
        </div>
 
        <!-- Intro -->
        <div class="intro-block">
          <p class="intro-label">Mobile app authenticator setup</p>
          <p class="intro-desc">Use a mobile app like Google Authenticator to generate verification codes.</p>
        </div>
 
        <!-- Step 1 -->
        <div class="step">
          <p class="step-title">1. Download App</p>
          <p class="step-desc">Use a mobile app like Google Authenticator to generate verification codes.</p>
        </div>
 
        <!-- Step 2 -->
        <div class="step">
          <p class="step-title">2. Scan QR code</p>
          <p class="step-desc">Scan this QR code using the app.</p>
 
          <div class="qr-section">
            <!-- QR Code SVG -->
              <img class="qrimage" src="{{ asset('css/image/qrcode.png') }}" alt="">
            <p class="manual-label">Can't scan QR code? Enter the code manually in the app.</p>
            <div class="manual-key-box">
            <center>
              <span>NZUK-7MP2-H6HJ-APLV</span>
            </center>
            </div>
          </div>
        </div>
 
        <!-- Step 3 -->
        <div class="step">
          <p class="step-title">3. Finish setup</p>
          <p class="step-desc">Enter the verification code generated by your app.</p>
          <input class="otp-input" type="text" inputmode="numeric" placeholder="Enter OTP"
                 maxlength="6" autocomplete="one-time-code">
        </div>
 
        <!-- Footer -->
        <div class="card-footer">
          <button class="btn-cancel">Cancel</button>
          <button class="btn-verify">Verify</button>
        </div>

        </div><!-- /twofa-card -->
 
    </div><!-- /content-area -->