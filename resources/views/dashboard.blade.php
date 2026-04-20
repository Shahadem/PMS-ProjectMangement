<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Iskandar Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <style>
        .avatar-stack.assignee-trigger {
            cursor: pointer;
        }

        .assign-modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(20, 28, 40, 0.45);
            z-index: 12000;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .assign-modal {
            width: min(820px, 96vw);
            max-height: 92vh;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 16px 46px rgba(10, 25, 47, 0.22);
            display: flex;
            flex-direction: column;
        }

        .assign-modal-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 18px 22px;
            border-bottom: 1px solid #e8edf3;
        }

        .assign-modal-header h3 {
            margin: 0;
            font-size: 15px;
            color: #1f2937;
        }

        .assign-close-btn {
            border: none;
            background: transparent;
            font-size: 22px;
            color: #4b5563;
            cursor: pointer;
            line-height: 1;
        }

        .assign-modal-body {
            padding: 18px 22px 14px;
            overflow: auto;
        }

        .assign-add-row {
            display: flex;
            gap: 10px;
            margin-bottom: 16px;
        }

        .assign-add-row input {
            flex: 1;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            padding: 10px 12px;
            font-size: 13px;
        }

        .assign-add-row button,
        .assign-btn-done {
            border: none;
            background: #3498db;
            color: #fff;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            cursor: pointer;
        }

        .assign-users-title {
            font-size: 12px;
            color: #6b7280;
            margin-bottom: 10px;
            font-weight: 600;
        }

        .assign-users-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .assign-user-item {
            display: grid;
            grid-template-columns: auto 1fr auto;
            align-items: center;
            gap: 12px;
            border: 1px solid #eef2f7;
            border-radius: 10px;
            padding: 10px 12px;
            background: #fff;
        }

        .assign-user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 12px;
            font-weight: 700;
        }

        .assign-user-meta strong {
            font-size: 13px;
            color: #1f2937;
            display: block;
            margin-bottom: 2px;
        }

        .assign-user-meta span {
            color: #9ca3af;
            font-size: 12px;
        }

        .assign-role-select {
            border: none;
            background: transparent;
            color: #6b7280;
            font-weight: 700;
            font-size: 13px;
            cursor: pointer;
            outline: none;
            text-align: right;
        }

        .assign-modal-footer {
            border-top: 1px solid #e8edf3;
            padding: 14px 22px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .assign-btn-cancel {
            border: 1px solid #d1d5db;
            background: #fff;
            color: #6b7280;
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 600;
            cursor: pointer;
        }

        .task-checkbox-row {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 7px 6px;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.15s;
            border-bottom: 1px solid #f0f0f5;
        }

        .task-checkbox-row:hover { 
            background: #f0f7ff; 
        }

        .task-checkbox-row input[type="checkbox"] {
            width: 15px;
            height: 15px;
            flex-shrink: 0;
            accent-color: #3498db;
        }

        .task-check-info {
            display: flex;
            align-items: center;
            gap: 6px;
            flex: 1;
        }

        .task-check-name {
            font-size: 12px;
            font-weight: 600;
            color: #2d3748;
        }

        .task-check-project {
            font-size: 11px;
            color: #a0aec0;
            margin-left: 4px;
        }

        .create-task-inline {
            display: grid;
            grid-template-columns: 1fr 150px 110px;
            gap: 8px;
            align-items: center;
        }

        .p-add-task-btn {
            padding: 9px 12px;
            border-radius: 8px;
        }

        .project-tags-preview {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-top: 8px;
            min-height: 22px;
        }

        .project-tag-chip {
            background: #eef2ff;
            color: #3b82f6;
            font-size: 11px;
            font-weight: 600;
            border-radius: 999px;
            padding: 3px 8px;
        }

        .p-hidden-date-actual {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            cursor: pointer;
            border: none;
            background: transparent;
            z-index: 10;
        }

        .p-timeline-box-custom i, 
        .p-timeline-box-custom span {
            pointer-events: none;
        }
    </style>
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
                <a href="{{ route('users.index')}}" class="nav-item {{ request()->is('users*') ? 'active' : '' }}"><i class="fas fa-users"></i>Users</a>
                <a href="{{route('settings.index') }}" class="nav-item {{ request()->is('settings*') ? 'active' : '' }}"><i class="fas fa-cog"></i>Settings</a>
            </nav>
            <a href="{{ route('logout') }}" class="logout">Log Out</a>
        </aside>

        <main class="main-container">
            <header class="top-header">
                <div class="header-left"><h1>All Projects</h1></div>
                <div class="header-right">
                    <i class="far fa-envelope"></i>
                    <i class="far fa-bell"></i>
                    <div class="search-container"><i class="fas fa-search"></i><input type="text" placeholder="Search"></div>
                    <button class="btn-create" onclick="openCreateModal()">
                        <i class="fas fa-plus-circle"></i> Create
                    </button>
                </div>
            </header>

            <div class="dashboard-grid">
                <div class="main-stats">
                    <div class="stats-row">
                        <div class="stat-card"><span>Total Projects</span><h2>11</h2></div>
                        <div class="stat-card"><span>Total Tasks</span><h2>120</h2></div>
                        <div class="stat-card"><span>Total Users</span><h2>80</h2></div>
                        <div class="stat-card"><span>Active Tasks</span><h2>9</h2></div>
                    </div>

                    <div class="content-box">
                        <h3>Action Required</h3>
                        <table id="actionTable" style="width: 100%;">
                            @foreach(range(1,4) as $i)
                            <tr>
                                <td style="color:#999">TS00{{$i}}</td>
                                <td><i class="far fa-file-alt" style="color:#3498db"></i> Proposal_{{$i}}.doc</td>
                                <td>Project 1</td>
                                <td><span class="status-pending"><i class="fas fa-eye"></i> Pending</span></td>
                                <td>
                                    <div class="avatar-stack assignee-trigger">
                                        <div><img src="https://i.pravatar.cc/150?u={{$i}}" class="avatar-img-stack"></div>
                                        <div class="more">+2</div>
                                    </div>
                                </td>
                                <td style="color:#999">{{$i}}m ago</td>
                                <td class="text-red"><span class="date-fix">8 Nov 2025</span></td>
                                <td><button type="button" class="btn-approve" onclick="handleApprove(this)">✓ Approve</button></td>
                            </tr>
                            @endforeach

                            @foreach(range(5,10) as $i)
                            <tr class="extra-row" style="display: none;">
                                <td style="color:#999">TS0{{$i < 10 ? '0'.$i : $i}}</td>
                                <td><i class="far fa-file-pdf" style="color:#e74c3c"></i> Ref_Doc_{{$i}}.pdf</td>
                                <td>Project {{ $i % 2 == 0 ? '2' : '1' }}</td>
                                <td><span class="status-pending"><i class="fas fa-eye"></i> Pending</span></td>
                                <td>
                                    <div class="avatar-stack assignee-trigger">
                                        <div><img src="https://i.pravatar.cc/150?u={{$i+20}}" class="avatar-img-stack"></div>
                                        <div class="more">+1</div>
                                    </div>
                                </td>
                                <td style="color:#999">{{$i}}m ago</td>
                                <td class="text-red"><span class="date-fix">12 Nov 2025</span></td>
                                <td><button type="button" class="btn-approve" onclick="handleApprove(this)">✓ Approve</button></td>
                            </tr>
                            @endforeach
                        </table>

                        <div id="seeMoreBtn" onclick="toggleRows()" style="text-align:center; color:#3498db; margin-top:15px; font-size:12px; cursor:pointer">
                            <span id="btnText">See more</span> <i id="btnIcon" class="fas fa-caret-down"></i>
                        </div>
                    </div>

                    <div class="content-box">
                        <h3>My Tasks</h3>
                        <table>
                            <thead>
                                <tr>
                                    <th>ID <i class="fas fa-caret-down"></i></th>
                                    <th>Task <i class="fas fa-caret-down"></i></th>
                                    <th>Project <i class="fas fa-caret-down"></i></th>
                                    <th>Status <i class="fas fa-caret-down"></i></th>
                                    <th>Assignee <i class="fas fa-caret-down"></i></th>
                                    <th>Last Modified <i class="fas fa-caret-down"></i></th>
                                    <th>Due Date <i class="fas fa-caret-down"></i></th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="color:#999">FD001</td>
                                    <td><i class="fas fa-folder" style="color:#f1c40f"></i> Folder Stage 1</td>
                                    <td>Project 1</td>
                                    <td></td>
                                    <td><div class="avatar-stack assignee-trigger"><div></div><div></div><div class="more">+2</div></div></td>
                                    <td style="color:#999">1m ago</td>
                                    <td></td>
                                    <td><i class="fas fa-ellipsis-h" style="color:#ccc"></i></td>
                                </tr>
                                @foreach(range(1,5) as $i)
                                <tr>
                                    <td style="color:#999">TS001</td>
                                    <td><i class="far fa-file-alt" style="color:#3498db"></i> Proposal.doc</td>
                                    <td>Project 1</td>
                                    <td>
                                        <span class="status-pending">
                                         <i class="fas fa-eye"></i> Pending Review
                                        </span>
                                    </td>
                                    <td><div class="avatar-stack assignee-trigger"><div></div><div></div><div class="more">+2</div></div></td>
                                    <td style="color:#999">1m ago</td>
                                    <td class="text-red"><span class="date-fix">8 Nov 2025</span></td>
                                    <td><i class="fas fa-ellipsis-h" style="color:#ccc"></i></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <aside class="comments-panel">
                    <h3>Comments</h3>
                    @foreach(range(1,4) as $i)
                    <div class="comment-item">
                        <div class="comment-user"><b>Aliff</b> <span>1 min ago</span></div>
                        <p><span class="mention">@Iskandar</span> Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                    @endforeach
                    <div class="end-label">End</div>
                </aside>
            </div>
        </main>
    </div>
    @php
        $dashboardRoles = ['Admin'];
    @endphp
    <div class="assign-modal-overlay" id="assignRolesModal">
        <div class="assign-modal">
            <div class="assign-modal-header">
                <h3>Assign Roles</h3>
                <button type="button" class="assign-close-btn" onclick="closeAssignModal()">&times;</button>
            </div>
            <div class="assign-modal-body">
                <div class="assign-add-row">
                    <input type="email" id="assignUserEmailInput" placeholder="Add user / e-mail">
                    <button type="button" onclick="addUserToActiveAssignee()">Add Users</button>
                </div>
                <div class="assign-users-title">These users have access</div>
                <div class="assign-users-list" id="assignUsersList"></div>
            </div>
            <div class="assign-modal-footer">
                <button type="button" class="assign-btn-cancel" onclick="closeAssignModal()">Cancel</button>
                <button type="button" class="assign-btn-done" onclick="closeAssignModal()">Done</button>
            </div>
        </div>
    </div>
    <div class="p-modal-fixed-overlay" id="createProjectModal">
        <div class="p-modal-container">
            <div class="p-modal-top">
                <h3>Create New Project</h3>
                <span class="p-close-btn" onclick="closeCreateModal()">&times;</span>
            </div>

            <form id="createProjectForm" onsubmit="submitProject(event); return false;" action="javascript:void(0);">
                <div class="p-form-grid-top">
                    <div class="p-field-item">
                        <label>Project Name <span style="color:red">*</span></label>
                        <input type="text" id="projectNameInput" placeholder="Enter project name" class="p-main-input" required>
                    </div>
                    <div class="p-field-item">
                        <label>Tags</label>
                        <input type="text" id="projectTagInput" class="p-main-input" placeholder="e.g. Normal, Urgent">
                        <div id="projectTagsPreview" class="project-tags-preview"></div>
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
                            <span class="p-date-placeholder" id="date-display">Select date</span>
                            <i class="fas fa-chevron-down p-chev-icon"></i>
                            <input type="date" class="p-hidden-date-actual" id="projectDateInput" onchange="updateDateDisplay(this)">
                        </div>
                    </div>
                </div>

                <div class="p-task-section">
                    <label class="p-add-task-label">Create New Task <i class="fas fa-plus"></i></label>
                    <div class="create-task-inline">
                        <input type="text" id="newTaskNameInput" class="p-main-input" placeholder="Task name">
                        <select id="newTaskStatusInput" class="p-main-input">
                            <option value="On-going" selected>On-going</option>
                            <option value="Completed">Completed</option>
                            <option value="On Hold">On Hold</option>
                        </select>
                        <button type="button" class="p-btn-blue p-add-task-btn" onclick="createNewTaskOption()">
                            Add Task
                        </button>
                    </div>
                </div>

                <div class="p-task-section">
                    <label class="p-add-task-label">Add Existing Tasks <i class="fas fa-plus"></i></label>
                    <div class="p-task-scroll-box" id="existingTasksList">
                        @php
                            $existingTasks = [
                                ['id' => 'TS001', 'name' => 'Task (Example)', 'project' => 'Project 1 - Office Reno', 'status' => 'On-going', 'pct' => '20%', 'badge' => 'badge-blue'],
                                ['id' => 'TS001', 'name' => 'Task 1 (Proposal)', 'project' => 'Project 2', 'status' => 'Completed', 'pct' => '100%', 'badge' => 'badge-green'],
                                ['id' => 'TS001', 'name' => 'Task 2 (Budgeting)', 'project' => 'Project 2', 'status' => 'On Hold', 'pct' => '', 'badge' => 'badge-grey'],
                            ];
                        @endphp
                        @foreach($existingTasks as $index => $task)
                        <label class="task-checkbox-row" for="task_{{ $index }}">
                            <input type="checkbox" id="task_{{ $index }}" 
                                data-id="{{ $task['id'] }}"
                                data-name="{{ $task['name'] }}"
                                data-status="{{ $task['status'] }}"
                                data-pct="{{ $task['pct'] }}"
                                data-badge="{{ $task['badge'] }}">
                            <span class="task-check-info">
                                <i class="fas fa-file-alt text-blue"></i>
                                <span class="task-check-name">{{ $task['name'] }}</span>
                                <span class="task-check-project">{{ $task['project'] }}</span>
                            </span>
                            <span class="prog-badge {{ $task['badge'] }}" style="font-size:10px; padding:2px 8px;">
                                {{ $task['status'] }} {{ $task['pct'] }}
                            </span>
                        </label>
                        @endforeach
                    </div>
                </div>

                <p id="formError" style="color:#e53e3e; font-size:12px; margin-top:8px; display:none;">
                    Please enter a project name.
                </p>

                <div class="p-modal-footer" style="display:flex; justify-content:flex-end; gap:10px; margin-top:20px;">
                    <button type="button" class="p-btn-cancel" onclick="closeCreateModal()" 
                        style="padding:8px 20px; border:1px solid #eee; background:#fff; cursor:pointer; border-radius:6px;">Cancel</button>
                    <button type="submit" class="p-btn-blue" 
                        style="padding:8px 30px; background:#3498db; color:#fff; border:none; cursor:pointer; border-radius:6px;">Create</button>
                </div>
            </form>
        </div>
    </div>
    <script>
    const availableRoleOptions = @json($dashboardRoles);
    const assigneeState = new Map();
    let activeAssigneeStack = null;

    function getInitials(name) {
        if (!name) return 'U';
        return name
            .split(' ')
            .filter(Boolean)
            .slice(0, 2)
            .map(part => part[0].toUpperCase())
            .join('');
    }

    function nameFromEmail(email) {
        const local = email.split('@')[0] || 'User';
        return local
            .replace(/[._-]+/g, ' ')
            .replace(/\s+/g, ' ')
            .trim()
            .replace(/\b\w/g, c => c.toUpperCase());
    }

    function colorFromString(value) {
        const colors = ['#8ea9db', '#b6c6e3', '#e6c8c8', '#3f557f', '#e6d3c5', '#93b7e3', '#7d9ac8'];
        let hash = 0;
        for (let i = 0; i < value.length; i++) {
            hash = value.charCodeAt(i) + ((hash << 5) - hash);
        }
        return colors[Math.abs(hash) % colors.length];
    }

    function initStackData(stackElement) {
        if (assigneeState.has(stackElement)) return assigneeState.get(stackElement);

        const users = [
            {
                name: 'Iskandar Zulkarnain',
                email: 'iskandarw@companyemail.com',
                role: availableRoleOptions[0] || 'Admin',
                color: '#8ea9db'
            },
            {
                name: 'Project Reviewer',
                email: 'reviewer@companyemail.com',
                role: availableRoleOptions[0] || 'Admin',
                color: '#b6c6e3'
            },
            {
                name: 'Approver Team',
                email: 'approver@companyemail.com',
                role: availableRoleOptions[0] || 'Admin',
                color: '#e6c8c8'
            }
        ];

        assigneeState.set(stackElement, users);
        renderAvatarStack(stackElement);
        return users;
    }

    function renderAvatarStack(stackElement) {
        const users = assigneeState.get(stackElement) || [];
        const visibleUsers = users.slice(0, 2);
        const remainingCount = Math.max(0, users.length - visibleUsers.length);

        stackElement.innerHTML = '';
        visibleUsers.forEach(user => {
            const avatarNode = document.createElement('div');
            avatarNode.style.background = user.color;
            avatarNode.style.display = 'flex';
            avatarNode.style.alignItems = 'center';
            avatarNode.style.justifyContent = 'center';
            avatarNode.style.color = '#fff';
            avatarNode.style.fontSize = '10px';
            avatarNode.style.fontWeight = '700';
            avatarNode.textContent = getInitials(user.name);
            stackElement.appendChild(avatarNode);
        });

        if (remainingCount > 0) {
            const moreNode = document.createElement('div');
            moreNode.className = 'more';
            moreNode.textContent = `+${remainingCount}`;
            stackElement.appendChild(moreNode);
        }
    }

    function renderAssignUsersList() {
        const list = document.getElementById('assignUsersList');
        if (!list || !activeAssigneeStack) return;
        const users = assigneeState.get(activeAssigneeStack) || [];

        list.innerHTML = '';
        users.forEach((user, index) => {
            const item = document.createElement('div');
            item.className = 'assign-user-item';

            const roleOptionsMarkup = availableRoleOptions.map(role => {
                const selected = role === user.role ? 'selected' : '';
                return `<option value="${role}" ${selected}>${role}</option>`;
            }).join('');

            item.innerHTML = `
                <div class="assign-user-avatar" style="background:${user.color};">${getInitials(user.name)}</div>
                <div class="assign-user-meta">
                    <strong>${user.name}</strong>
                    <span>${user.email}</span>
                </div>
                <div>
                    <select class="assign-role-select" onchange="updateAssigneeRole(${index}, this.value)">
                        ${roleOptionsMarkup}
                    </select>
                </div>
            `;

            list.appendChild(item);
        });
    }

    function updateAssigneeRole(index, role) {
        if (!activeAssigneeStack) return;
        const users = assigneeState.get(activeAssigneeStack) || [];
        if (!users[index]) return;
        users[index].role = role;
    }

    function openAssignModal(stackElement) {
        activeAssigneeStack = stackElement;
        initStackData(stackElement);
        renderAssignUsersList();

        const modal = document.getElementById('assignRolesModal');
        const emailInput = document.getElementById('assignUserEmailInput');
        if (modal) modal.style.display = 'flex';
        if (emailInput) {
            emailInput.value = '';
            emailInput.focus();
        }
    }

    function closeAssignModal() {
        const modal = document.getElementById('assignRolesModal');
        if (modal) modal.style.display = 'none';
        activeAssigneeStack = null;
    }

    function addUserToActiveAssignee() {
        if (!activeAssigneeStack) return;
        const emailInput = document.getElementById('assignUserEmailInput');
        if (!emailInput) return;

        const email = emailInput.value.trim().toLowerCase();
        const isValidEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        if (!isValidEmail) {
            emailInput.focus();
            return;
        }

        const users = assigneeState.get(activeAssigneeStack) || [];
        const alreadyExists = users.some(user => user.email.toLowerCase() === email);
        if (alreadyExists) {
            emailInput.value = '';
            return;
        }

        users.push({
            name: nameFromEmail(email),
            email,
            role: availableRoleOptions[0] || 'Admin',
            color: colorFromString(email)
        });

        assigneeState.set(activeAssigneeStack, users);
        renderAssignUsersList();
        renderAvatarStack(activeAssigneeStack);
        emailInput.value = '';
        emailInput.focus();
    }

    document.addEventListener('DOMContentLoaded', function() {
        const timelineBox = document.querySelector('.p-timeline-box-custom');
        const dateInput = document.getElementById('projectDateInput');

        // Fix: Make the entire box clickable to show the calendar
        if (timelineBox && dateInput) {
            timelineBox.addEventListener('click', () => {
                if (typeof dateInput.showPicker === 'function') dateInput.showPicker();
                else dateInput.click();
            });
        }

        document.querySelectorAll('.avatar-stack.assignee-trigger').forEach(stack => {
            initStackData(stack);
            stack.addEventListener('click', function(event) {
                event.stopPropagation();
                openAssignModal(stack);
            });
        });

        const emailInput = document.getElementById('assignUserEmailInput');
        if (emailInput) {
            emailInput.addEventListener('keydown', function(event) {
                if (event.key === 'Enter') {
                    event.preventDefault();
                    addUserToActiveAssignee();
                }
            });
        }
    });

    // FUNGSI APPROVE YANG BOLEH PATAH BALIK (TOGGLE)
    function handleApprove(btn) {
        // Check kalau butang sekarang dah ada class hijau (is-approved)
        if (btn.classList.contains('is-approved')) {
            // Jika YA (tengah hijau), kita tukar balik jadi biru
            btn.classList.remove('is-approved');
            btn.innerHTML = '✓ Approve';
            console.log("Dah cancel approve (Biru balik)");
        } else {
            // Jika TIDAK (tengah biru), kita tukar jadi hijau
            btn.classList.add('is-approved');
            btn.innerHTML = '✓ Approved';
            console.log("Dah approve (Hijau)");
        }
        
        // JANGAN letak btn.disabled = true; supaya boleh klik balik
    }

    function toggleRows() {
        const rows = document.querySelectorAll('.extra-row');
        const btnText = document.getElementById('btnText');
        const btnIcon = document.getElementById('btnIcon');
        
        if (rows[0].style.display === 'none') {
            rows.forEach(row => { row.style.display = 'table-row'; });
            btnText.innerHTML = "See less";
            btnIcon.className = "fas fa-caret-up";
        } else {
            rows.forEach(row => { row.style.display = 'none'; });
            btnText.innerHTML = "See more";
            btnIcon.className = "fas fa-caret-down";
        }
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
    window.addEventListener('click', function(event) {
        var createProjectModal = document.getElementById('createProjectModal');
        var assignRolesModal = document.getElementById('assignRolesModal');
        if (createProjectModal && event.target == createProjectModal) {
            createProjectModal.style.display = "none";
        }
        if (assignRolesModal && event.target == assignRolesModal) {
            closeAssignModal();
        }
    });

    function updateDateDisplay(input) {
        const dateValue = input.value;
        if (dateValue) {
            document.getElementById('date-display').innerText = dateValue;
        }
    }

    function submitProject(e) {
        e.preventDefault();
        const name = document.getElementById('projectNameInput').value.trim();
        const error = document.getElementById('formError');
        if (!name) {
            error.style.display = 'block';
            document.getElementById('projectNameInput').focus();
            return;
        }
        error.style.display = 'none';
        showToast(`Project "${name}" created successfully!`);
        closeCreateModal();
    }

    function showToast(msg) {
        let toast = document.getElementById('globalToast');
        if (!toast) {
            toast = document.createElement('div');
            toast.id = 'globalToast';
            toast.style.cssText = `
                position: fixed; bottom: 30px; right: 30px;
                background: #2ecc71; color: #fff;
                padding: 12px 20px; border-radius: 10px;
                font-size: 13px; font-weight: 600;
                box-shadow: 0 4px 15px rgba(46,204,113,0.3);
                display: flex; align-items: center; gap: 8px;
                z-index: 99999; transition: opacity 0.3s;
            `;
            document.body.appendChild(toast);
        }
        toast.innerHTML = `<i class="fas fa-check-circle"></i> ${msg}`;
        toast.style.opacity = '1';
        toast.style.display = 'flex';
        setTimeout(() => {
            toast.style.opacity = '0';
            setTimeout(() => { toast.style.display = 'none'; }, 300);
        }, 3000);
    }
    
    </script>
</body>
</html>
