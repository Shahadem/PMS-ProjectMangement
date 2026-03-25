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
                <a href="{{ route('usersindex.index') }}" class="sub-link active">Users</a>
                <a href="{{ route('rolesindex.index') }}" class="sub-link ">Roles</a>
                <a href="{{ route('permissionmodule.index') }}" class="sub-link ">Permission Module</a>
            </nav>

            <section class="users-table-content">
                <div class="users-container">
    <div class="user-management-header">
        <h2 class="sub-title">User Management</h2>
        <a href="#" class="btn-add-user">+ Add New User</a>
    </div>

    <p class="section-label">Other Users</p>

    <table class="users-table">
        <thead>
            <tr>
                <th><input type="checkbox"></th>
                <th>ID</th>
                <th>Name</th>
                <th>Contact</th>
                <th>Group</th>
                <th>Role</th>
                <th>Projects Assigned</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
    <tr>
        <td><input type="checkbox"></td>
        <td class="text-muted">US001</td>
        <td>
            <div class="user-info">
                <strong>Iskandar Zulkarnain</strong>
                <span>Last login 2 minutes ago</span>
            </div>
        </td>
        <td class="text-contact">iskandar@gmail.com<br>017 - 7853 5385</td>
        <td><span class="badge badge-pink">Project Team 1</span></td>
        <td class="role-cell">
            <div class="role-selector" onclick="toggleRoleDropdown(this)">
                <i class="far fa-user"></i> Contributor <i class="fas fa-pencil-alt edit-sm"></i>
            </div>
            <div class="role-dropdown">
                <div class="role-item">
                    <strong>Admin</strong>
                    <p>Can manage account settings and edit</p>
                </div>
                <div class="role-item active">
                    <strong>Contributor</strong>
                    <p>Can view/edit project and tasks</p>
                </div>
                <div class="role-item">
                    <strong>Guest</strong>
                    <p>Can only view and comment</p>
                </div>
            </div>
        </td>
        <td><a href="#" class="view-link">View Projects <i class="fas fa-pencil-alt edit-sm"></i></a></td>
        <td class="text-muted">...</td>
    </tr>

    <tr class="row-selected">
        <td><input type="checkbox" checked></td>
        <td class="text-muted">US001</td>
        <td>
            <div class="user-info">
                <strong>Iskandar Zulkarnain</strong>
                <span>Last login 2 minutes ago</span>
            </div>
        </td>
        <td class="text-contact">iskandar@gmail.com<br>017 - 7853 5385</td>
        <td><span class="badge badge-blue">Project Team 2</span></td>
        <td class="role-cell"> 
            <div class="role-selector" onclick="toggleRoleDropdown(this)">
                <i class="far fa-user"></i> Contributor <i class="fas fa-pencil-alt edit-sm"></i>
            </div>
            <div class="role-dropdown">
                <div class="role-item">
                    <strong>Admin</strong>
                    <p>Can manage account settings and edit</p>
                </div>
                <div class="role-item active">
                    <strong>Contributor</strong>
                    <p>Can view/edit project and tasks</p>
                </div>
                <div class="role-item">
                    <strong>Guest</strong>
                    <p>Can only view and comment</p>
                </div>
            </div>
        </td>
        <td><a href="#" class="view-link">View Projects <i class="fas fa-pencil-alt edit-sm"></i></a></td>
        <td class="text-muted">...</td>
    </tr>
</tbody>
    </table>
</div>
            </section>
        </div>
    </main>
</div>
    <div id="addUserModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Add New User</h2>
            <span class="close-modal" onclick="toggleModal()">&times;</span>
        </div>
        <form action="#" method="POST">
            <div class="form-row">
                <div class="form-group full-width">
                    <label>Full Name</label>
                    <input type="text" placeholder="Iskandar Zulkarnain">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>User ID</label>
                    <input type="text" placeholder="Enter ID">
                </div>
                <div class="form-group">
                    <label>Assign Role</label>
                    <select>
                        <option>Admin</option>
                        <option selected>Contributor</option>
                        <option>Guest</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group full-width">
                    <label>Mac Address</label>
                    <input type="text" placeholder="Enter Mac Address">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" placeholder="Enter Email">
                </div>
                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="text" placeholder="Enter Number">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-cancel" onclick="toggleModal()">Cancel</button>
                <button type="submit" class="btn-submit">Add User(s)</button>
            </div>
        </form>
    </div>
</div>
<script>
    function toggleRoleDropdown(element) {
    // Tutup mana-mana dropdown lain yang tengah terbuka
    document.querySelectorAll('.role-selector').forEach(sel => {
        if (sel !== element) sel.classList.remove('active');
    });

    // Toggle (buka/tutup) dropdown yang diklik
    element.classList.toggle('active');

    // Halang klik ini daripada 'terlepas' ke window.onclick
    event.stopPropagation();
}

// Tutup dropdown kalau user klik kat luar (mana-mana kawasan lain)
window.onclick = function(event) {
    if (!event.target.closest('.role-selector')) {
        document.querySelectorAll('.role-selector').forEach(sel => {
            sel.classList.remove('active');
        });
    }
};

</script>
</body>
</html>
