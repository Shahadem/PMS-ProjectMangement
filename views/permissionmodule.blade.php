<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - Admin Panel</title>
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

             <a href="{{ route('users.index') }}" class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
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
            <div class="header-left"><h1>Users</h1></div>
            </header>

        <div class="users-layout-wrapper">
            
            <nav class="users-sub-nav">
                <a href="{{ route('users.index') }}" class="sub-link ">Admins</a>
                <a href="{{ route('usersindex.index') }}" class="sub-link ">Users</a>
                <a href="{{ route('rolesindex.index') }}" class="sub-link ">Roles</a>
                <a href="{{ route('permissionmodule.index') }}" class="sub-link active">Permission Module</a>
            </nav>

            <section class="users-table-content">
                <div class="users-container">
    <div class="permissions-wrapper">
    <div class="permissions-header">
        <h2 class="section-title">Permission Module</h2>
    </div>

    <div class="permissions-table-container">
        <div class="roles-header-row">
            <div class="col-permission">Permission</div>
            <div class="col-role">Admin</div>
            <div class="col-role">Contributor</div>
            <div class="col-role">Guest</div>
        </div>

        <div class="permission-group">
            <div class="group-banner">User Settings</div>
            @php
                $user_perms = ['View Settings', 'Create New User', 'Edit User Setting', 'Delete User'];
            @endphp
            @foreach($user_perms as $perm)
            <div class="permission-row">
                <div class="col-permission">{{ $perm }}</div>
                <div class="col-role"><input type="checkbox" {{ $loop->first ? 'checked' : '' }}></div>
                <div class="col-role"><input type="checkbox"></div>
                <div class="col-role"><input type="checkbox"></div>
            </div>
            @endforeach
        </div>

        <div class="permission-group">
            <div class="group-banner">Timeline</div>
            @php
                $timeline_perms = ['View', 'Create', 'Edit', 'Delete'];
            @endphp
            @foreach($timeline_perms as $perm)
            <div class="permission-row">
                <div class="col-permission">{{ $perm }}</div>
                <div class="col-role"><input type="checkbox" {{ $loop->first ? 'checked' : '' }}></div>
                <div class="col-role"><input type="checkbox"></div>
                <div class="col-role"><input type="checkbox"></div>
            </div>
            @endforeach
        </div>

        <div class="permission-group">
            <div class="group-banner">Projects</div>
            @php
                $project_perms = ['View Projects', 'Create Projects', 'Edit Projects', 'Comment', 'Delete Projects'];
            @endphp
            @foreach($project_perms as $perm)
            <div class="permission-row">
                <div class="col-permission">{{ $perm }}</div>
                <div class="col-role"><input type="checkbox" {{ $loop->first ? 'checked' : '' }}></div>
                <div class="col-role"><input type="checkbox"></div>
                <div class="col-role"><input type="checkbox"></div>
            </div>
            @endforeach
        </div>
    </div>
</div>
</body>
</html>
