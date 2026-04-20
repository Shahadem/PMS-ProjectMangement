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
                    <button class="btn-create" onclick="openCreateModal()">
                        <i class="fas fa-plus-circle"></i> Create
                    </button>
                </div>
            </header>

        <div class="users-layout-wrapper">
    <nav class="users-sub-nav">
        <a href="{{ route('users.index') }}" class="sub-link">Admins</a>
        <a href="{{ route('usersindex.index') }}" class="sub-link active">Users</a>
        <a href="{{ route('rolesindex.index') }}" class="sub-link">Roles</a>
    </nav>

    <section class="users-table-content">
        <div class="content-header">
            
        </div>

    <section class="users-table-content">
        <table class="users-table">
            <thead>
                <div class="">
                    <h2 class="section-title">User Management</h2>
                    <button class="btn-add-user" type="button">+ Add New User</button>
                </div>
                <div class="breadcrumb">Other Users</div>
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
            <tbody id="userTableBody">
                <tr>
                    <td><input type="checkbox"></td>
                    <td class="text-muted">US001</td>
                    <td><div class="user-info"><strong>Iskandar Zulkarnain</strong><span>Last login 2 minutes ago</span></div></td>
                    <td class="text-contact">iskandar@gmail.com<br>017 - 7853 5385</td>
                    <td><span class="badge badge-pink">Project Team 1</span></td>
                    <td class="role-cell">
                        <div class="role-selector" onclick="toggleRoleDropdown(this)"><i class="far fa-user"></i> Contributor</i></div>
                        <div class="role-dropdown">
                            <div class="role-item"><strong>Admin</strong><p>Can manage account settings and edit</p></div>
                            <div class="role-item active"><strong>Contributor</strong><p>Can view/edit project and tasks</p></div>
                            <div class="role-item"><strong>Guest</strong><p>Can only view and comment</p></div>
                        </div>
                    </td>
                    <td><a href="#" class="view-link">View Projects <i class="fas fa-pencil-alt edit-sm"></i></a></td>
                    <td class="action-cell">
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
                <tr class="row-selected">
                    <td><input type="checkbox" checked></td>
                    <td class="text-muted">US001</td>
                    <td><div class="user-info"><strong>Iskandar Zulkarnain</strong><span>Last login 2 minutes ago</span></div></td>
                    <td class="text-contact">iskandar@gmail.com<br>017 - 7853 5385</td>
                    <td><span class="badge badge-blue">Project Team 2</span></td>
                    <td class="role-cell">
                        <div class="role-selector" onclick="toggleRoleDropdown(this)"><i class="far fa-user"></i> Contributor</i></div>
                        <div class="role-dropdown">
                            <div class="role-item"><strong>Admin</strong><p>Can manage account settings and edit</p></div>
                            <div class="role-item active"><strong>Contributor</strong><p>Can view/edit project and tasks</p></div>
                            <div class="role-item"><strong>Guest</strong><p>Can only view and comment</p></div>
                        </div>
                    </td>
                    <td><a href="#" class="view-link">View Projects <i class="fas fa-pencil-alt edit-sm"></i></a></td>
                    <td class="action-cell">
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
                <tr class="row-selected">
                    <td><input type="checkbox" checked></td>
                    <td class="text-muted">US001</td>
                    <td><div class="user-info"><strong>Iskandar Zulkarnain</strong><span>Last login 2 minutes ago</span></div></td>
                    <td class="text-contact">iskandar@gmail.com<br>017 - 7853 5385</td>
                    <td><span class="badge badge-blue">Project Team 2</span></td>
                    <td class="role-cell">
                        <div class="role-selector" onclick="toggleRoleDropdown(this)"><i class="far fa-user"></i> Contributor</i></div>
                        <div class="role-dropdown">
                            <div class="role-item"><strong>Admin</strong><p>Can manage account settings and edit</p></div>
                            <div class="role-item active"><strong>Contributor</strong><p>Can view/edit project and tasks</p></div>
                            <div class="role-item"><strong>Guest</strong><p>Can only view and comment</p></div>
                        </div>
                    </td>
                    <td><a href="#" class="view-link">View Projects <i class="fas fa-pencil-alt edit-sm"></i></a></td>
                    <td class="action-cell">
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
                <tr class="row-selected">
                    <td><input type="checkbox" checked></td>
                    <td class="text-muted">US001</td>
                    <td><div class="user-info"><strong>Iskandar Zulkarnain</strong><span>Last login 2 minutes ago</span></div></td>
                    <td class="text-contact">iskandar@gmail.com<br>017 - 7853 5385</td>
                    <td><span class="badge badge-blue">Project Team 2</span></td>
                    <td class="role-cell">
                        <div class="role-selector" onclick="toggleRoleDropdown(this)"><i class="far fa-user"></i> Contributor</i></div>
                        <div class="role-dropdown">
                            <div class="role-item"><strong>Admin</strong><p>Can manage account settings and edit</p></div>
                            <div class="role-item active"><strong>Contributor</strong><p>Can view/edit project and tasks</p></div>
                            <div class="role-item"><strong>Guest</strong><p>Can only view and comment</p></div>
                        </div>
                    </td>
                    <td><a href="#" class="view-link">View Projects <i class="fas fa-pencil-alt edit-sm"></i></a></td>
                    <td class="action-cell">
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
                <tr class="row-selected">
                    <td><input type="checkbox" checked></td>
                    <td class="text-muted">US001</td>
                    <td><div class="user-info"><strong>Iskandar Zulkarnain</strong><span>Last login 2 minutes ago</span></div></td>
                    <td class="text-contact">iskandar@gmail.com<br>017 - 7853 5385</td>
                    <td><span class="badge badge-blue">Project Team 2</span></td>
                    <td class="role-cell">
                        <div class="role-selector" onclick="toggleRoleDropdown(this)"><i class="far fa-user"></i> Contributor</i></div>
                        <div class="role-dropdown">
                            <div class="role-item"><strong>Admin</strong><p>Can manage account settings and edit</p></div>
                            <div class="role-item active"><strong>Contributor</strong><p>Can view/edit project and tasks</p></div>
                            <div class="role-item"><strong>Guest</strong><p>Can only view and comment</p></div>
                        </div>
                    </td>
                    <td><a href="#" class="view-link">View Projects <i class="fas fa-pencil-alt edit-sm"></i></a></td>
                    <td class="action-cell">
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
                <tr class="row-selected">
                    <td><input type="checkbox" checked></td>
                    <td class="text-muted">US001</td>
                    <td><div class="user-info"><strong>Iskandar Zulkarnain</strong><span>Last login 2 minutes ago</span></div></td>
                    <td class="text-contact">iskandar@gmail.com<br>017 - 7853 5385</td>
                    <td><span class="badge badge-blue">Project Team 2</span></td>
                    <td class="role-cell">
                        <div class="role-selector" onclick="toggleRoleDropdown(this)"><i class="far fa-user"></i> Contributor</i></div>
                        <div class="role-dropdown">
                            <div class="role-item"><strong>Admin</strong><p>Can manage account settings and edit</p></div>
                            <div class="role-item active"><strong>Contributor</strong><p>Can view/edit project and tasks</p></div>
                            <div class="role-item"><strong>Guest</strong><p>Can only view and comment</p></div>
                        </div>
                    </td>
                    <td><a href="#" class="view-link">View Projects <i class="fas fa-pencil-alt edit-sm"></i></a></td>
                    <td class="action-cell">
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
    </section>
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
                    <input type="text" id="userContact" placeholder="Enter Number" required>
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
    function toggleModal() {
        const modal = document.getElementById('addUserModal');
        if (!modal) return;

        const isOpen = modal.style.display === 'flex';
        modal.style.display = isOpen ? 'none' : 'flex';
    }

    function openCreateModal() {
        const modal = document.getElementById('createProjectModal');
        if (modal) {
            modal.style.display = 'flex';
        }
    }

    function closeCreateModal() {
        const modal = document.getElementById('createProjectModal');
        if (modal) {
            modal.style.display = 'none';
        }
    }

    function updateDateDisplay(input) {
        const dateValue = input.value;
        if (dateValue) {
            document.getElementById('date-display').innerText = dateValue;
        }
    }

    function toggleActionDots(event, btn) {
        event.stopPropagation();
        const cell = btn.closest('.action-cell');
        if (!cell) return;

        document.querySelectorAll('.action-cell.dots-active').forEach(c => {
            if (c !== cell) c.classList.remove('dots-active');
        });

        cell.classList.toggle('dots-active');
    }

    function selectRole(item, role) {
        const actionCell = item.closest('.action-cell');
        if (actionCell) {
            actionCell.classList.remove('dots-active');
        }

        const row = item.closest('tr');
        const roleSelector = row ? row.querySelector('.role-selector') : null;
        if (roleSelector) {
            roleSelector.innerHTML = `<i class="far fa-user"></i> ${role}`;
        }
    }

    function toggleRoleDropdown(el) {
        const cell = el.closest('.role-cell');
        if (!cell) return;

        document.querySelectorAll('.role-cell.active').forEach(c => {
            if (c !== cell) c.classList.remove('active');
        });
        cell.classList.toggle('active');
    }

    document.querySelectorAll('.btn-add-user').forEach(button => {
        button.addEventListener('click', toggleModal);
    });

    document.addEventListener('click', function(event) {
        const addUserModal = document.getElementById('addUserModal');
        const createProjectModal = document.getElementById('createProjectModal');

        if (addUserModal && event.target === addUserModal) {
            addUserModal.style.display = 'none';
        }

        if (createProjectModal && event.target === createProjectModal) {
            createProjectModal.style.display = 'none';
        }

        if (!event.target.closest('.action-cell')) {
            document.querySelectorAll('.action-cell.dots-active').forEach(c => c.classList.remove('dots-active'));
        }

        if (!event.target.closest('.role-cell')) {
            document.querySelectorAll('.role-cell.active').forEach(c => c.classList.remove('active'));
        }
    });

    const addUserForm = document.getElementById('addUserForm');
    if (addUserForm) {
        addUserForm.addEventListener('submit', function(e) {
            e.preventDefault();

            const name = document.getElementById('userName').value.trim();
            const id = document.getElementById('userId').value.trim();
            const role = document.getElementById('userRole').value;
            const email = document.getElementById('userEmail').value.trim();
            const contact = document.getElementById('userContact').value.trim();
            const tableBody = document.getElementById('userTableBody');

            if (!tableBody || !name || !id || !email || !contact) return;

            const newRow = `
                <tr class="row-selected">
                    <td><input type="checkbox" checked></td>
                    <td class="text-muted">${id}</td>
                    <td>
                        <div class="user-info">
                            <strong>${name}</strong>
                            <span>Last login just now</span>
                        </div>
                    </td>
                    <td class="text-contact">${email}<br>${contact}</td>
                    <td><span class="badge badge-blue">Project Team 2</span></td>
                    <td class="role-cell">
                        <div class="role-selector" onclick="toggleRoleDropdown(this)"><i class="far fa-user"></i> ${role}</div>
                        <div class="role-dropdown">
                            <div class="role-item"><strong>Admin</strong><p>Can manage account settings and edit</p></div>
                            <div class="role-item active"><strong>Contributor</strong><p>Can view/edit project and tasks</p></div>
                            <div class="role-item"><strong>Guest</strong><p>Can only view and comment</p></div>
                        </div>
                    </td>
                    <td><a href="#" class="view-link">View Projects <i class="fas fa-pencil-alt edit-sm"></i></a></td>
                    <td class="action-cell">
                        <button type="button" class="btn-dots" onclick="toggleActionDots(event, this)">...</button>
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
            addUserForm.reset();
            toggleModal();
        });
    }
</script>
<script src="{{ asset('js/assign-roles-stack.js') }}"></script>
</body>
</html>
