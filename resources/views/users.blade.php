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
        <a href="{{ route('settings.index') }}" style="text-decoration: none;">
                 <div class="profile-circle">
                    <div class="profile-avatar">IZ</div>
                </div>
            </a>
            <div class="username">Iskandar</div>
             <nav class="nav-links">
             <a href="{{ route('dashboard.index') }}" class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i>Dashboard</a>
             <a href="{{ route('timeline.index') }}" class="nav-item {{ request()->is('timeline*') ? 'active' : '' }}"><i class="fas fa-clock"></i>Timeline</a>
             <a href="{{ route('projects.index') }}" class="nav-item {{ request()->is('projects*') ? 'active' : '' }}"><i class="fas fa-folder"></i>Projects</a>
             <a href="{{ route('users.index') }}" class="nav-item {{ request()->is('users*') ? 'active' : '' }}"><i class="fas fa-users"></i>Users</a>
             <a href="{{route('settings.index') }}" class="nav-item {{ request()->is('settings*') ? 'active' : '' }}"><i class="fas fa-cog"></i>Settings</a>
             </nav>
            <a href="/" class="logout">Log Out</a>
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
                    <button class="btn-create" onclick="openCreateModal()">
                        <i class="fas fa-plus-circle"></i> Create
                    </button>
                </div>
            </header>
 
        <div class="users-layout-wrapper">
            
            <nav class="users-sub-nav">
                <a href="/users" class="sub-link active">Admins</a>
                <a href="/usersindex" class="sub-link">Users</a>
                <a href="/rolesindex" class="sub-link">Roles</a>
            </nav>

            <section class="users-table-content">
                <div class="content-header">
                    <h2 class="admin-title">Admins</h2>
                    <button class="btn-add-user">+ Add New User</button>
                </div>
                
                <p class="admin-list-label">Admin List</p>

                <div class="table-responsive">
                    <table class="custom-table">
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
                                <td>US001</td>
                                <td>
                                    <strong>Iskandar Zulkarnain</strong><br>
                                    <small>Last login 2 minutes ago</small>
                                </td>
                                <td>iskandar@gmail.com<br>017-7853 5385</td>
                                <td><span class="badge-blue">AKS - Team 2</span></td>
                                <td><i class="fas fa-user-shield"></i> Admin</td>
                                <td><a href="#">View Projects</a></td>
                                <td><i class="fas fa-ellipsis-h"></i></td>
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
<div class="p-modal-fixed-overlay" id="createProjectModal">
    <div class="p-modal-container">
        <div class="p-modal-top">
            <h3>Add New User</h3>
            <span class="p-close-btn" onclick="closeCreateModal()">&times;</span>
        </div>

        <form>
            {{-- Full Name --}}
            <div class="p-field-item" style="margin-bottom: 16px;">
                <label>Full Name</label>
                <input type="text" placeholder="Iskandar Zulkarnain" class="p-main-input" style="width:100%; box-sizing:border-box;">
            </div>

            {{-- User ID + Assign Role --}}
            <div style="display: flex; gap: 16px; margin-bottom: 16px;">
                <div class="p-field-item" style="flex: 1;">
                    <label>User ID</label>
                    <input type="text" placeholder="" class="p-main-input" style="width:100%; box-sizing:border-box;">
                </div>
                <div class="p-field-item" style="flex: 1;">
                    <label>Assign Role</label>
                    <div style="position: relative;">
                        <i class="fas fa-user-circle" style="position:absolute; left:10px; top:50%; transform:translateY(-50%); color:#a0aec0; font-size:16px;"></i>
                        <select class="p-main-input" style="width:100%; padding-left:32px; box-sizing:border-box; appearance:none;">
                            <option>Admin</option>
                            <option selected>Contributor</option>
                            <option>Guest</option>
                        </select>
                        <i class="fas fa-chevron-down" style="position:absolute; right:10px; top:50%; transform:translateY(-50%); color:#a0aec0; font-size:11px; pointer-events:none;"></i>
                    </div>
                </div>
            </div>

            {{-- Mac Address --}}
            <div class="p-field-item" style="margin-bottom: 16px;">
                <label>Mac Address</label>
                <input type="text" placeholder="" class="p-main-input" style="width:100%; box-sizing:border-box;">
            </div>

            {{-- Email + Contact Number --}}
            <div style="display: flex; gap: 16px; margin-bottom: 16px;">
                <div class="p-field-item" style="flex: 1;">
                    <label>Email</label>
                    <input type="email" placeholder="" class="p-main-input" style="width:100%; box-sizing:border-box;">
                </div>
                <div class="p-field-item" style="flex: 1;">
                    <label>Contact Number</label>
                    <input type="text" placeholder="" class="p-main-input" style="width:100%; box-sizing:border-box;">
                </div>
            </div>

            {{-- Footer --}}
            <div class="p-modal-footer" style="display:flex; justify-content:flex-end; gap:10px; margin-top:24px;">
                <button type="button" class="p-btn-cancel" onclick="closeCreateModal()" 
                    style="padding:10px 24px; border:1px solid #eee; background:#fff; cursor:pointer; border-radius:8px; font-size:14px;">Cancel</button>
                <button type="submit" class="p-btn-blue" 
                    style="padding:10px 24px; background:#3498db; color:#fff; border:none; cursor:pointer; border-radius:8px; font-size:14px; font-weight:600;">Add User(s)</button>
            </div>
        </form>
    </div>
</div>
<script>
    function toggleModal() {
        const modal = document.getElementById('addUserModal');
        if (modal.style.display === "flex") {
            modal.style.display = "none";
        } else {
            modal.style.display = "flex";
        }
    }

    // Sambungkan fungsi ke butang Create
    document.querySelector('.btn-add-user').addEventListener('click', toggleModal);
    document.querySelector('.add-user-link').addEventListener('click', toggleModal);

    function showSection(sectionId, element) {
    // 1. Sembunyikan semua seksyen kandungan
    const sections = document.querySelectorAll('.content-section');
    sections.forEach(section => {
        section.style.display = 'none';
    });

    // 2. Paparkan seksyen yang dipilih
    document.getElementById(sectionId).style.display = 'block';

    // 3. Buang kelas 'active' dari semua butang navigasi
    const navItems = document.querySelectorAll('.sub-nav-item');
    navItems.forEach(item => {
        item.classList.remove('active');
    });

    // 4. Tambah kelas 'active' pada butang yang diklik
    element.classList.add('active');
}
 // Pastikan nama fungsi ni sepadan dengan onclick kat butang Create tadi
    function openCreateModal() {
        var modal = document.getElementById('createProjectModal');
        if (modal) {
            modal.style.display = 'flex';
        }
    }

    function closeCreateModal() {
        var modal = document.getElementById('createProjectModal');
        if (modal) {
            modal.style.display = 'none';
        }
    }

    // Tutup bila klik luar kotak
    window.onclick = function(event) {
        var modal = document.getElementById('createProjectModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    function updateDateDisplay(input) {
        const dateValue = input.value;
        if (dateValue) {
            document.getElementById('date-display').innerText = dateValue;
        }
    }
</script>
</body>
</html>
