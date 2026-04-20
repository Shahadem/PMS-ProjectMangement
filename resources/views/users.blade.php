<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - Admin Panel</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<style>
    thead {
    background-color: #f8fafc; /* Warna kelabu kebiruan sangat cair seperti dalam gambar */
}

thead th {
    padding: 12px 15px;
    text-align: left;
    color: #718096; /* Warna teks kelabu gelap sedikit */
    font-size: 13px;
    font-weight: 600;
    text-transform: capitalize;
    border-bottom: 1px solid #edf2f7;
}

.users-table-content {
    overflow: visible;
}

.admin-table-wrapper {
    position: relative;
    overflow-x: auto;
    overflow-y: visible;
}

.action-cell {
    position: relative;
}

.dots-dropdown {
    z-index: 10000;
    min-width: 220px;
}
</style>
<body>
    <div class="wrapper">
    <aside class="sidebar">
        <a href="{{ route('settings.index') }}" style="text-decoration: none;">
                 <div class="profile-circle">
                    @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}"
                            style="width:100%;height:100%;border-radius:50%;object-fit:cover;">
                        @else
                            {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                        @endif
                </div>
            </a>
            <div class="username">{{ explode(' ', Auth::user()->name)[0] }}</div>
             <nav class="nav-links">
             <a href="{{ route('dashboard') }}" class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i>Dashboard</a>
             <a href="{{ route('timeline.index') }}" class="nav-item {{ request()->is('timeline*') ? 'active' : '' }}"><i class="fas fa-clock"></i>Timeline</a>
             <a href="{{ route('projects.index') }}" class="nav-item {{ request()->is('projects*') ? 'active' : '' }}"><i class="fas fa-folder"></i>Projects</a>
             <a href="{{ route('users.index') }}" class="nav-item {{ request()->is('users*') ? 'active' : '' }}"><i class="fas fa-users"></i>Users</a>
             <a href="{{route('settings.index') }}" class="nav-item {{ request()->is('settings*') ? 'active' : '' }}"><i class="fas fa-cog"></i>Settings</a>
             </nav>
            <a href="{{ route('logout') }}" class="logout">Log Out</a>
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
                    <button class="btn-create" onclick="toggleModal()">
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
                    <button class="btn-add-user" type="button">+ Add New User</button>
                </div>

                <div class="breadcrumb">Admin list</div>

                <div class="admin-table-wrapper">
                    <table class="user-list-table">
        <thead style="background-color: #f8fafc; border-bottom: 1px solid #edf2f7;">
            <tr>
                <th style="padding: 12px 15px; color: #718096; text-align: left;"><input type="checkbox"></th>
                <th style="padding: 12px 15px; color: #718096; text-align: left; font-size: 11px; font-weight: 600;">ID</th>
                <th style="padding: 12px 15px; color: #718096; text-align: left; font-size: 11px; font-weight: 600;">Name</th>
                <th style="padding: 12px 15px; color: #718096; text-align: left; font-size: 11px; font-weight: 600;">Contact</th>
                <th style="padding: 12px 15px; color: #718096; text-align: left; font-size: 11px; font-weight: 600;">Group</th>
                <th style="padding: 12px 15px; color: #718096; text-align: left; font-size: 11px; font-weight: 600;">Role</th>
                <th style="padding: 12px 15px; color: #718096; text-align: left; font-size: 11px; font-weight: 600;">Projects Assigned</th>
                <th style="padding: 12px 15px; color: #718096; text-align: left; font-size: 11px; font-weight: 600;">Actions</th>
            </tr>
        </thead>

        <tbody id="userTableBody">
            <tr style="border-bottom: 1px solid #edf2f7;">
                <td style="padding: 12px 15px; vertical-align: middle;"><input type="checkbox"></td>
                <td style="padding: 12px 15px; vertical-align: middle; color: #4a5568; font-size: 13px;">US001</td>
                <td style="padding: 12px 15px; vertical-align: middle;">
                    <div style="display: flex; flex-direction: column;">
                        <strong style="color: #2d3748; font-size: 14px;">Iskandar Zulkarnain</strong>
                        <small style="color: #a0aec0; font-size: 11px;">Last login just now</small>
                    </div>
                </td>
                <td style="padding: 12px 15px; vertical-align: middle;">
                    <div style="display: flex; flex-direction: column;">
                        <span style="color: #4a5568; font-size: 13px;">Iskandar@gmail.com</span>
                        <small style="color: #a0aec0; font-size: 11px;">017-7853 5385</small>
                    </div>
                </td>
                <td style="padding: 12px 15px; vertical-align: middle;">
                    <span class="badge-blue" style="background-color: #ebf8ff; color: #3182ce; padding: 4px 8px; border-radius: 6px; font-size: 11px; font-weight: 500;">AKS - Team 2</span>
                </td>
                <td style="padding: 12px 15px; vertical-align: middle; color: #4a5568; font-size: 13px;">
                    <i class="fas fa-user-shield" style="margin-right: 5px;"></i> Admin
                </td>
                <td style="padding: 12px 15px; vertical-align: middle;">
                    <a href="#" style="color: #4299e1; text-decoration: none; font-size: 13px;">View Projects</a>
                </td>
                <td style="padding: 12px 15px; vertical-align: middle;" class="action-cell">
                    <button class="btn-dots" onclick="toggleActionDots(event, this)">...</button>
                    <div class="dots-dropdown">
                        <div class="dots-item" onclick="selectRole(this, 'Admin')">
                            <strong>Admin</strong>
                            <p>Can manage account settings and edit</p>
                        </div>
                        <div class="dots-item" onclick="selectRole(this, 'Contributor')">
                            <strong>Contributor</strong>
                            <p>Can view/edit project and tasks</p>
                        </div>
                        <div class="dots-item" onclick="selectRole(this, 'Guest')">
                            <strong>Guest</strong>
                            <p>Can only view and comment</p>
                        </div>
                    </div>
                </td>
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
        <form id="addUserForm">
            <div class="form-row">
                <div class="form-group full-width">
                    <label>Full Name</label>
                    <input type="text" id="userName" placeholder="Iskandar Zulkarnain" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>User ID</label>
                    <input type="text" id="userId" placeholder="Enter ID" required>
                </div>
                <div class="form-group">
                    <label>Assign Role</label>
                    <select id="userRole">
                        <option value="Admin">Admin</option>
                        <option value="Contributor" selected>Contributor</option>
                        <option value="Guest">Guest</option>
                    </select>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group full-width">
                    <label>Mac Address</label>
                    <input type="text" id="userMac" placeholder="Enter Mac Address">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" id="userEmail" placeholder="Enter Email" required>
                </div>
                <div class="form-group">
                    <label>Contact Number</label>
                    <input type="number" id="userContact" placeholder="Enter Number" required>
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
    function toggleModal() {
        const modal = document.getElementById('addUserModal');
        if (!modal) return;

        const isOpen = modal.style.display === 'flex';
        modal.style.display = isOpen ? 'none' : 'flex';
    }

    function closeActionMenus() {
        document.querySelectorAll('.action-cell .dots-dropdown').forEach(menu => {
            menu.style.display = 'none';
            menu.style.position = '';
            menu.style.left = '';
            menu.style.top = '';
        });
        document.querySelectorAll('.action-cell.dots-active').forEach(cell => cell.classList.remove('dots-active'));
    }

    function positionActionMenu(btn, menu) {
        if (!menu) return;

        const btnRect = btn.getBoundingClientRect();
        const gap = 8;

        menu.style.display = 'block';
        menu.style.position = 'fixed';

        const menuRect = menu.getBoundingClientRect();
        const maxLeft = window.innerWidth - menuRect.width - 12;
        const left = Math.max(12, Math.min(btnRect.right - menuRect.width, maxLeft));

        let top = btnRect.bottom + gap;
        if (top + menuRect.height > window.innerHeight - 12) {
            top = btnRect.top - menuRect.height - gap;
        }
        if (top < 12) top = 12;

        menu.style.left = `${left}px`;
        menu.style.top = `${top}px`;
    }

    function toggleActionDots(event, btn) {
        event.stopPropagation();

        const cell = btn.closest('.action-cell');
        if (!cell) return;
        const menu = cell.querySelector('.dots-dropdown');
        if (!menu) return;

        const alreadyOpen = menu.style.display === 'block';
        closeActionMenus();

        if (!alreadyOpen) {
            cell.classList.add('dots-active');
            positionActionMenu(btn, menu);
        }
    }

    function selectRole(item, role) {
        const cell = item.closest('.action-cell');
        if (cell) {
            cell.classList.remove('dots-active');
        }

        const row = item.closest('tr');
        const roleSelector = row ? row.querySelector('.role-selector') : null;
        if (roleSelector) {
            roleSelector.innerHTML = `<i class="far fa-user"></i> ${role}`;
        }
    }

    document.querySelectorAll('.btn-add-user').forEach(button => {
        button.addEventListener('click', toggleModal);
    });

    window.addEventListener('click', function(event) {
        const modal = document.getElementById('addUserModal');
        if (modal && event.target === modal) {
            modal.style.display = 'none';
        }
        closeActionMenus();
    });

    window.addEventListener('resize', closeActionMenus);

    const addUserForm = document.getElementById('addUserForm');
    if (addUserForm) {
        addUserForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const name = document.getElementById('userName').value;
            const id = document.getElementById('userId').value;
            const role = document.getElementById('userRole').value;
            const email = document.getElementById('userEmail').value;
            const contact = document.getElementById('userContact').value;
            const tableBody = document.getElementById('userTableBody');

            if (!tableBody) return;

            const newRow = `
                <tr style="border-bottom: 1px solid #edf2f7;">
                    <td style="padding: 12px 15px; vertical-align: middle;"><input type="checkbox"></td>
                    <td style="padding: 12px 15px; vertical-align: middle; color: #4a5568; font-size: 13px;">${id}</td>
                    <td style="padding: 12px 15px; vertical-align: middle;">
                        <div style="display: flex; flex-direction: column;">
                            <strong style="color: #2d3748; font-size: 14px;">${name}</strong>
                            <small style="color: #a0aec0; font-size: 11px;">Last login just now</small>
                        </div>
                    </td>
                    <td style="padding: 12px 15px; vertical-align: middle;">
                        <div style="display: flex; flex-direction: column;">
                            <span style="color: #4a5568; font-size: 13px;">${email}</span>
                            <small style="color: #a0aec0; font-size: 11px;">${contact}</small>
                        </div>
                    </td>
                    <td style="padding: 12px 15px; vertical-align: middle;">
                        <span class="badge-blue" style="background-color: #ebf8ff; color: #3182ce; padding: 4px 8px; border-radius: 6px; font-size: 11px; font-weight: 500;">AKS - Team 2</span>
                    </td>
                    <td style="padding: 12px 15px; vertical-align: middle; color: #4a5568; font-size: 13px;">
                        <i class="fas fa-user-shield" style="margin-right: 5px;"></i> ${role}
                    </td>
                    <td style="padding: 12px 15px; vertical-align: middle;">
                        <a href="#" style="color: #4299e1; text-decoration: none; font-size: 13px;">View Projects</a>
                    </td>
                    <td style="padding: 12px 15px; vertical-align: middle;" class="action-cell">
                        <button class="btn-dots" type="button" onclick="toggleActionDots(event, this)">...</button>
                        <div class="dots-dropdown">
                            <div class="dots-item" onclick="selectRole(this, 'Admin')">
                                <strong>Admin</strong>
                                <p>Can manage account settings and edit</p>
                            </div>
                            <div class="dots-item" onclick="selectRole(this, 'Contributor')">
                                <strong>Contributor</strong>
                                <p>Can view/edit project and tasks</p>
                            </div>
                            <div class="dots-item" onclick="selectRole(this, 'Guest')">
                                <strong>Guest</strong>
                                <p>Can only view and comment</p>
                            </div>
                        </div>
                    </td>
                </tr>
            `;

            tableBody.insertAdjacentHTML('beforeend', newRow);
            this.reset();
            toggleModal();
        });
    }
</script>
</body>
</html>
