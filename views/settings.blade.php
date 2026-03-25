<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - My Account</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="wrapper">
        <aside class="sidebar">
            <div class="profile-circle">
                <div class="profile-avatar">IZ</div>
            </div>
            <div class="username">Iskandar</div>
            <nav class="nav-links">
                <a href="{{ route('dashboard.index') }}" class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>Dashboard
                </a>
                <a href="{{ route('timeline.index') }}" class="nav-item {{ request()->is('timeline*') ? 'active' : '' }}">
                    <i class="fas fa-history"></i>Timeline
                </a>
                <a href="{{ route('projects.index') }}" class="nav-item {{ request()->is('projects*') ? 'active' : '' }}">
                    <i class="fas fa-folder"></i>Projects
                </a>
                <a href="{{ route('users.index')}}" class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
                    <i class="fas fa-users"></i>Users
                </a>
                <a href="{{route('settings.index') }}" class="nav-item {{ request()->is('settings*') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i>Settings
                </a>
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

            <div class="settings-flex-row">
            <nav class="settings-sub-nav">
                <a href="{{ route('settings.index') }}" class="sub-nav-item active">My Profile</a>
                <a href="{{ route('security.index') }}" class="sub-nav-item">Security</a>
                <a href="{{ route('password.index') }}" class="sub-nav-item">Password</a>
                <a href="{{ route('deleteaccount.index') }}" class="sub-nav-item">Account</a>    
            </nav>

            <section class="profile-form-section">
                <h2 class="section-heading">My Profile</h2>
                    
                <div class="profile-card-top">
                    <div class="large-avatar">IZ</div>
                        <div class="user-meta">
                            <h3>Iskandar Zulkarnain <i class="fas fa-pencil-alt edit-pen"></i></h3>
                            <p>Senior Art Director</p>
                        </div>
                    </div>

                <form class="profile-grid-form">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Full Name</label>
                                <input type="text" value="Iskandar Zulkarnain" disabled>
                            </div>
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" value="Senior Art Director" disabled>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Phone Number</label>
                                <input type="text" placeholder="">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="save-btn">Save</button>
                        </div>
                    </form>
                </section>
            </div>
        </main>
    </div>
</body>
</html>