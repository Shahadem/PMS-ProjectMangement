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
                    <button class="btn-create" onclick="openCreateModal()">
                        <i class="fas fa-plus-circle"></i> Create
                    </button>
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
<div class="p-modal-fixed-overlay" id="createProjectModal">
        <div class="p-modal-container">
            <div class="p-modal-top">
                <h3>Create New Project</h3>
                <span class="p-close-btn" onclick="closeCreateModal()">&times;</span>
            </div>

            <form>
                <div class="p-form-grid-top">
                    <div class="p-field-item">
                        <label>Project Name</label>
                        <input type="text" placeholder="Enter project name" class="p-main-input">
                    </div>
                    <div class="p-field-item">
                        <label>Tags</label>
                        <select class="p-main-input">
                            <option>Normal</option>
                            <option>Urgent</option>
                        </select>
                    </div>
                    <div class="p-field-item">
                        <label>Add Roles</label>
                        <div class="p-role-stack">
                            <span class="p-circle p-gray"></span>
                            <span class="p-circle p-blue"></span>
                            <span class="role-circle-iz new-count-style">+2</span>
                            <div class="p-circle-add"><i class="fas fa-plus"></i></div>
                        </div>
                    </div>
                    <div class="p-field-item">
                        <label>Set Timeline</label>
                        <div class="p-timeline-box-custom">
                            <i class="fas fa-calendar p-cal-icon"></i>
                            <input type="date" class="p-hidden-date-actual" onchange="updateDateDisplay(this)">
                            <span class="p-date-placeholder" id="date-display">13/08/2026</span>
                            <i class="fas fa-chevron-down p-chev-icon"></i>
                        </div>
                    </div>
                </div>

                <div class="p-task-section">
                    <label class="p-add-task-label">Add Existing Tasks <i class="fas fa-plus"></i></label>
                    <div class="p-task-scroll-box">
                        <p>SH001 Task 1</p>
                        <p>SH001 Task 2</p>
                    </div>
                </div>

                <div class="p-modal-footer" style="display: flex; justify-content: flex-end; gap: 10px; margin-top: 20px;">
                    <button type="button" class="p-btn-cancel" onclick="closeCreateModal()" style="padding: 8px 20px; border: 1px solid #eee; background: #fff; cursor: pointer; border-radius: 6px;">Cancel</button>
                    <button type="submit" class="p-btn-blue" style="padding: 8px 30px; background: #3498db; color: #fff; border: none; cursor: pointer; border-radius: 6px;">Create</button>
                </div>
            </form>
        </div>
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
