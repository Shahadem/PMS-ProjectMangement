<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Overview</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Pastikan modal sembunyi secara default */
        .p-modal-fixed-overlay {
            display: none; 
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            justify-content: center;
            align-items: center;
            z-index: 9999;
        }
    </style>
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
                <a href="{{ route('users.index')}}" class="nav-item {{ request()->is('users*') ? 'active' : '' }}"><i class="fas fa-users"></i>Users</a>
                <a href="{{ route('settings.index') }}" class="nav-item {{ request()->is('settings*') ? 'active' : '' }}"><i class="fas fa-cog"></i>Settings</a>
            </nav>
            <a href="/" class="logout">Log Out</a>
        </aside>

        <main class="main-container">
            <header class="top-header">
                <div class="header-left"><h1>All Projects</h1></div>
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

            <div class="breadcrumb">Projects &nbsp; ></div>

            <div class="project-table-container">
                <table class="project-list">
                    <thead>
                        <tr>
                            <th>ID <i class="fas fa-caret-down"></i></th>
                            <th>Task <i class="fas fa-caret-down"></i></th>
                            <th>Status <i class="fas fa-caret-down"></i></th>
                            <th>Owner <i class="fas fa-caret-down"></i></th>
                            <th>Last Modified <i class="fas fa-caret-down"></i></th>
                            <th>Due Date <i class="fas fa-caret-down"></i></th>
                            <th>Action</th>
                            <th></th>
                        </tr>
                    </thead>
                        <tbody>
                        {{-- Project 1 --}}
                        <tr class="row-main" data-project="1" onclick="toggleProject(1)">
                            <td>FD001</td>
                            <td><i class="fas fa-briefcase text-blue"></i> Project 1 - Office Reno <i class="fas fa-caret-down toggle-icon" id="icon-1"></i></td>
                            <td></td><td></td><td>1m ago</td><td>1 March 2027</td><td>...</td>
                            <td><a href="#" class="timeline-link" onclick="event.stopPropagation()"><i class="far fa-clock"></i> Timeline View</a></td>
                        </tr>
                        @foreach(['On-going' => '20%'] as $status => $per)
                        <tr class="row-sub" data-child="1" onclick="window.location='{{ route('projects.task.show', ['name' => 'Task (Example)']) }}'">
                            <td>TS001</td>
                            <td class="pl-30">
                                <i class="fas fa-file-alt text-blue"></i> Task (Example)
                            </td>
                            <td><div class="prog-badge badge-blue"><span>On-going</span> <span>20%</span></div></td>
                            <td><div class="owner"><i class="fas fa-user-circle"></i> Iskandar Z</div></td>
                            <td></td><td></td><td></td><td></td>
                        </tr>
                        @endforeach

                        {{-- Project 2 --}}
                        <tr class="row-main" data-project="2" onclick="toggleProject(2)">
                            <td>FD002</td>
                            <td><i class="fas fa-briefcase text-blue"></i> Project 2 - Team Building Off site <i class="fas fa-caret-down toggle-icon" id="icon-2"></i></td>
                            <td></td><td></td><td>1m ago</td><td>1 March 2027</td><td>...</td>
                            <td><a href="#" class="timeline-link" onclick="event.stopPropagation()"><i class="far fa-clock"></i> Timeline View</a></td>
                        </tr>
                        <tr class="row-sub" data-child="2" onclick="window.location='#'">
                        <td>TS001</td>
                            <td class="pl-30"><i class="fas fa-file-alt text-blue"></i> Task 1 (Proposal)</td>
                            <td><div class="prog-badge badge-green"><span>Completed</span> <span>100%</span></div></td>
                            <td><div class="owner"><i class="fas fa-user-circle"></i> Iskandar Z</div></td>
                            <td>1m ago</td><td class="text-red">1 March 2027</td><td>...</td>
                            <td><a href="#" class="timeline-link" onclick="event.stopPropagation()"><i class="far fa-clock"></i> Timeline View</a></td>
                        </tr>
                        <tr class="row-sub" data-child="2" onclick="window.location='#'">
                            <td>TS001</td>
                            <td class="pl-30"><i class="fas fa-file-alt text-blue"></i> Task 2 (Budgeting)</td>
                            <td><div class="prog-badge badge-grey"><span>On Hold</span></div></td>
                            <td><div class="owner"><i class="fas fa-user-circle"></i> Iskandar Z</div></td>
                            <td>1m ago</td><td class="text-red">1 March 2027</td><td>...</td>
                            <td><a href="#" class="timeline-link" onclick="event.stopPropagation()"><i class="far fa-clock"></i> Timeline View</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <div class="p-modal-fixed-overlay" id="createProjectModal">
    <div class="p-modal-container">
        <div class="p-modal-top">
            <h3>Create New Project</h3>
            <span class="p-close-btn" onclick="closeCreateModal()">&times;</span>
        </div>

        <form id="createProjectForm" onsubmit="submitProject(event)">
            <div class="p-form-grid-top">
                <div class="p-field-item">
                    <label>Project Name <span style="color:red">*</span></label>
                    <input type="text" id="projectNameInput" placeholder="Enter project name" class="p-main-input" required>
                </div>
                <div class="p-field-item">
                    <label>Tags</label>
                    <select id="projectTagInput" class="p-main-input">
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
                        <span class="p-date-placeholder" id="date-display">Select date</span>
                        <i class="fas fa-chevron-down p-chev-icon"></i>
                        <input type="date" class="p-hidden-date-actual" id="projectDateInput" onchange="updateDateDisplay(this)">
                    </div>
                </div>
            </div>

            {{-- Existing Tasks --}}
            <div class="p-task-section">
                <label class="p-add-task-label">Add Existing Tasks <i class="fas fa-plus"></i></label>
                <div class="p-task-scroll-box" id="existingTasksList">
                    {{-- Tasks rendered as checkboxes --}}
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

            {{-- Validation message --}}
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

    <style>
        .row-main {
            cursor: pointer;
        }
        .row-main:hover {
            background: #f5f5f8;
        }
        .row-sub {
            transition: opacity 0.2s ease;
        }
        .row-sub.hidden {
            display: none;
        }
        .toggle-icon {
            margin-left: 8px;
            font-size: 12px;
            color: #9ca3af;
            transition: transform 0.2s ease;
        }
        .toggle-icon.rotated {
            transform: rotate(-90deg);
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

        .new-project-badge {
            display: inline-block;
            background: #eef2f7;
            color: #3498db;
            font-size: 11px;
            font-weight: 700;
            padding: 2px 8px;
            border-radius: 4px;
            margin-left: 6px;
        }

        .view-grid .project-list, 
        .view-grid .project-list tbody, 
        .view-grid .project-list thead {
            display: block;
            width: 100%;
        }

        .p-timeline-box-custom {
            position: relative;
            cursor: pointer;
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
        }
    </style>
<script>
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
        if (input.value) {
            const [year, month, day] = input.value.split('-');
            document.getElementById('date-display').textContent = `${day}/${month}/${year}`;
        }
    }


    function toggleProject(id) {
        const children = document.querySelectorAll(`tr[data-child="${id}"]`);
        const icon = document.getElementById(`icon-${id}`);

        children.forEach(row => row.classList.toggle('hidden'));
        icon.classList.toggle('rotated');
    }

    let projectCounter = 3; // FD001 and FD002 already exist

    // ── Modal open/close ────────────────────────────
    function openCreateModal() {
        document.getElementById('createProjectModal').style.display = 'flex';
    }

    function closeCreateModal() {
        document.getElementById('createProjectModal').style.display = 'none';
        resetForm();
    }

    window.onclick = function(event) {
        const modal = document.getElementById('createProjectModal');
        if (event.target === modal) closeCreateModal();
    }

    function resetForm() {
        document.getElementById('projectNameInput').value = '';
        document.getElementById('projectDateInput').value = '';
        document.getElementById('date-display').textContent = 'Select date';
        document.getElementById('formError').style.display = 'none';
        document.querySelectorAll('#existingTasksList input[type="checkbox"]').forEach(cb => cb.checked = false);
    }

    document.addEventListener('DOMContentLoaded', function() {
        const timelineBox = document.querySelector('.p-timeline-box-custom');
        const dateInput = document.getElementById('projectDateInput');

        if (timelineBox && dateInput) {
            timelineBox.addEventListener('click', function(event) {
                if (event.target !== dateInput) {
                    dateInput.focus();
                    if (typeof dateInput.showPicker === 'function') {
                        dateInput.showPicker();
                    }
                }
            });
        }
    });

    // ── Date display ────────────────────────────────
    function updateDateDisplay(input) {
        if (input.value) {
            const [year, month, day] = input.value.split('-');
            const months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            document.getElementById('date-display').textContent = `${day} ${months[parseInt(month)-1]} ${year}`;
        }
    }

    // ── Submit & add to table ───────────────────────
    function submitProject(e) {
        e.preventDefault();

        const name = document.getElementById('projectNameInput').value.trim();
        const date = document.getElementById('date-display').textContent;
        const error = document.getElementById('formError');

        if (!name) {
            error.style.display = 'block';
            document.getElementById('projectNameInput').focus();
            return;
        }

        error.style.display = 'none';
        projectCounter++;
        const projectId = `FD00${projectCounter}`;
        const tableBody = document.querySelector('.project-list tbody');

        // ── Add project row ──
        const projectRow = document.createElement('tr');
        projectRow.className = 'row-main';
        projectRow.setAttribute('data-project', projectCounter);
        projectRow.setAttribute('onclick', `toggleProject(${projectCounter})`);
        projectRow.innerHTML = `
            <td>${projectId}</td>
            <td>
                <i class="fas fa-briefcase text-blue"></i> ${name}
                <i class="fas fa-caret-down toggle-icon" id="icon-${projectCounter}"></i>
            </td>
            <td></td>
            <td></td>
            <td>Just now</td>
            <td>${date !== 'Select date' ? date : '—'}</td>
            <td>...</td>
            <td><a href="#" class="timeline-link" onclick="event.stopPropagation()"><i class="far fa-clock"></i> Timeline View</a></td>
        `;
        tableBody.appendChild(projectRow);

        // ── Add selected existing tasks as sub-rows ──
        const checkedTasks = document.querySelectorAll('#existingTasksList input[type="checkbox"]:checked');
        checkedTasks.forEach(cb => {
            const subRow = document.createElement('tr');
            subRow.className = 'row-sub';
            subRow.setAttribute('data-child', projectCounter);
            subRow.setAttribute('onclick', `window.location='#'`);
            subRow.innerHTML = `
                <td>${cb.dataset.id}</td>
                <td class="pl-30">
                    <i class="fas fa-file-alt text-blue"></i> ${cb.dataset.name}
                </td>
                <td>
                    <div class="prog-badge ${cb.dataset.badge}">
                        <span>${cb.dataset.status}</span>
                        <span>${cb.dataset.pct}</span>
                    </div>
                </td>
                <td><div class="owner"><i class="fas fa-user-circle"></i> Iskandar Z</div></td>
                <td>Just now</td>
                <td></td>
                <td>...</td>
                <td><a href="#" class="timeline-link" onclick="event.stopPropagation()"><i class="far fa-clock"></i> Timeline View</a></td>
            `;
            tableBody.appendChild(subRow);
        });

        // ── Show success toast ──
        showToast(`Project "${name}" created successfully!`);
        closeCreateModal();
    }

    // ── Toast notification ──────────────────────────
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
            setTimeout(() => toast.style.display = 'none', 300);
        }, 3000);
    }

    // ── Toggle project rows ─────────────────────────
    function toggleProject(id) {
        const children = document.querySelectorAll(`tr[data-child="${id}"]`);
        const icon = document.getElementById(`icon-${id}`);
        children.forEach(row => row.classList.toggle('hidden'));
        if (icon) icon.classList.toggle('rotated');
    }
</script>
</body>
</html>