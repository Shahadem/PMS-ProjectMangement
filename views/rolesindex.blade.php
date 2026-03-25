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

        <div class="users-layout-wrapper">
            
            <nav class="users-sub-nav">
                <a href="{{ route('users.index') }}" class="sub-link ">Admins</a>
                <a href="{{ route('usersindex.index') }}" class="sub-link ">Users</a>
                <a href="{{ route('rolesindex.index') }}" class="sub-link active">Roles</a>
                <a href="{{ route('permissionmodule.index') }}" class="sub-link ">Permission Module</a>
            </nav>

            <section class="users-table-content">
                <div class="users-container">
    <div class="roles-management-wrapper">
    <div class="roles-header">
        <h2 class="section-title">Roles Management</h2>
    </div>

    <table class="roles-table">
        <thead>
            <tr>
                <th><input type="checkbox"></th>
                <th>ID</th>
                <th>Role Designation</th>
                <th>Created</th>
                <th>Modified</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    <tr>
        <td><input type="checkbox"></td>
        <td class="text-muted">RL001</td>
        <td>
            <div class="role-designation">
                <div class="role-icon-circle"><i class="fas fa-user"></i></div>
                <span>Admin</span>
            </div>
        </td>
        <td class="text-date">23-11-2025 at 10:23PM</td>
        <td class="text-date">23-11-2025 at 10:23PM</td>
        <td class="action-cell">
            <i class="fas fa-ellipsis-h" onclick="toggleActionMenu(event, this)"></i>
            <div class="action-dropdown">
                <a href="#">Modify</a>
                <a href="#">Rename</a>
                <a href="#" class="text-danger"><i class="far fa-trash-alt"></i> Remove Role</a>
            </div>
        </td>
    </tr>
    </tbody>
    </table>
</div>
<script>
function toggleActionMenu(event, element) {
    // 1. Halang klik daripada 'terlepas' ke window.onclick
    event.stopPropagation();

    // 2. Cari bekas (parent) untuk dropdown ini
    const currentCell = element.closest('.action-cell');
    
    // 3. Cari semua action-cell lain dan tutup jika terbuka
    document.querySelectorAll('.action-cell').forEach(cell => {
        if (cell !== currentCell) {
            cell.classList.remove('active-action');
        }
    });

    // 4. Buka atau tutup menu yang diklik sekarang
    currentCell.classList.toggle('active-action');
}

// 5. Tutup semua menu secara automatik jika user klik di luar kawasan table
window.onclick = function(event) {
    if (!event.target.closest('.action-dropdown')) {
        document.querySelectorAll('.action-cell').forEach(cell => {
            cell.classList.remove('active-action');
        });
    }
};
</script>
</body>
</html>
