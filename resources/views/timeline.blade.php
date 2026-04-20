<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline - Project Overview</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<style>
/* 1. Container Utama */
.timeline-container {
    width: 100%;
    /* Gunakan vh (viewport height) untuk tarik container ke bawah skrin */
    /* Kita tolak 150px (anggaran tinggi header & breadcrumb anda) */
    height: calc(100vh - 150px); 
    
    overflow-x: auto;
    overflow-y: auto; /* Ini membolehkan body jadual diskrol ke bawah */
    border: 1px solid #e0e0e0;
    background: #fff;
    position: relative;
    display: flex;
    flex-direction: column;
}

/* 2. Table Settings */
.timeline-table {
    border-collapse: collapse;
    width: max-content;
    min-height: 100%; /* Paksa table memanjang ke bawah container */
    font-size: 12px;
}



/* Header Tahun, Bulan, Minggu */
.timeline-table th {
    padding: 4px 8px; /* Kecilkan padding */
    border: 1px solid #eee;
    background-color: #f8f9fa;
    white-space: nowrap;
}

/* Kecilkan lebar kolum Minggu (W1, W2...) */
.week-header th {
    min-width: 30px; /* Lebar minimum setiap minggu */
    font-size: 10px;
    color: #888;
}

/* 3. Kemaskan Kolum ID dan Task */
.col-id, .col-task {
    position: sticky;
    left: 0;
    background: white;
    z-index: 10;
    /* Guna box-shadow sebagai pengganti border supaya tak hilang bila scroll */
    box-shadow: inset -2px 0 0 0 #ddd; 
    border-right: none !important; 
}

.col-task {
    left: 50px; /* Pastikan ini sama dengan lebar .col-id */
    min-width: 200px;
    /* Tambah shadow sikit supaya nampak pemisah antara task & timeline area */
    box-shadow: inset -2px 0 0 0 #ddd;
}

/* 4. Kecilkan Bar Timeline */
.timeline-bar {
    height: 20px; /* Nipiskan sikit bar */
    line-height: 20px;
    font-size: 10px;
    border-radius: 4px;
    padding: 0 10px;
    margin-top: 2px;
    margin-bottom: 2px;
}

/* Row Sub-task bagi rapat sikit */
.row-sub td {
    padding: 2px 8px; /* Rapatkan jarak antara row */
    height: 35px;
}

.row-main {
    cursor: pointer;
}

.row-main:hover {
    background: #f7f9fc;
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
    z-index: 10;
}

.p-timeline-box-custom i, 
.p-timeline-box-custom span {
    pointer-events: none;
}

/* Modal specific styles */
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

            <div class="breadcrumb">
                Projects &nbsp; > &nbsp; Project 1 - Office Reno &nbsp; > &nbsp; <b>Task 1 (Proposal)</b>
            </div>

            <div class="project-selector">
                Project
                <h3><i class="fas fa-briefcase text-blue"></i> Project 1 - Office Reno <i class="fas fa-caret-down"></i></h3>
            </div>

<div class="timeline-container">
    <table class="timeline-table">
        <thead>
            <tr class="year-header">
                <th rowspan="3" class="col-id">ID</th>
                <th rowspan="3" class="col-task">Task <i class="fas fa-caret-down"></i></th>
                @foreach (['2025', '2026', '2027'] as $year)
                <th colspan="48" class="year-th">
                    <div class="sticky-year-wrapper">
                        <span class="sticky-year">{{ $year }}</span>
                    </div>
                </th>
                @endforeach
            </tr>
            </tr>
            <tr class="month-header">
                @foreach (['2025', '2026', '2027'] as $year)
                    @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                        <th colspan="4">{{ $month }}</th>
                    @endforeach
                @endforeach
            </tr>
            <tr class="week-header">
                @for ($i = 0; $i < 36; $i++) <th>W1</th><th>W2</th><th>W3</th><th>W4</th>
                @endfor
            </tr>
        </thead>
        <tbody>
            @php $totalWeeks = 3 * 12 * 4; @endphp <tr class="row-main" data-project="1" onclick="toggleProject(1)">
                <td class="col-id">FD001</td>
                <td class="col-task">
                    <b><i class="fas fa-briefcase text-blue"></i> Project 1 - Office Reno</b>
                    <i class="fas fa-caret-down toggle-icon" id="icon-1"></i>
                </td>
                @for ($i = 0; $i < $totalWeeks; $i++) <td></td> @endfor
            </tr>

            <tr class="row-sub timeline-task-row" data-child="1">
                <td class="col-id">TS001</td>
                <td class="col-task" style="padding-left: 30px;"><i class="fas fa-file-alt text-blue"></i> Task 1 (Proposal)</td>
                <td colspan="{{ $totalWeeks }}" class="timeline-cell">
                    <div class="timeline-bar blue-bar" style="width: 400px; margin-left: 0px;">
                        On-going 20%
                    </div>
                </td>
            </tr>

            @for ($j = 2; $j <= 20; $j++)
            <tr class="row-sub timeline-task-row" data-child="1">
                <td class="col-id">TS0{{ $j }}</td>
                <td class="col-task" style="padding-left: 30px;"><i class="fas fa-file-alt text-blue"></i> Extra Task {{ $j }}</td>
                <td colspan="{{ $totalWeeks }}" class="timeline-cell">
                    <div class="timeline-bar grey-bar" style="width: 200px; margin-left: {{ $j * 100 }}px;">
                        On Hold 
                    </div>
                </td>
            </tr>
            @endfor
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
    const STATUS_META = {
        'On-going': { badge: 'badge-blue', pct: '20%' },
        'Completed': { badge: 'badge-green', pct: '100%' },
        'On Hold': { badge: 'badge-grey', pct: '' }
    };

    let createdTaskCounter = 100;

    function openCreateModal() {
        const modal = document.getElementById('createProjectModal');
        if (modal) modal.style.display = 'flex';
    }

    function closeCreateModal() {
        const modal = document.getElementById('createProjectModal');
        if (modal) modal.style.display = 'none';
        resetForm();
    }

    function resetForm() {
        const form = document.getElementById('createProjectForm');
        const dateDisplay = document.getElementById('date-display');
        const error = document.getElementById('formError');
        const preview = document.getElementById('projectTagsPreview');

        if (form) form.reset();
        if (dateDisplay) dateDisplay.textContent = 'Select date';
        if (error) error.style.display = 'none';
        if (preview) preview.innerHTML = '';
        document.querySelectorAll('#existingTasksList [data-created-task="true"]').forEach(node => node.remove());
    }

    function parseTags(rawTags) {
        return rawTags.split(',').map(tag => tag.trim()).filter(Boolean).slice(0, 4);
    }

    function renderTagsPreview() {
        const tagInput = document.getElementById('projectTagInput');
        const preview = document.getElementById('projectTagsPreview');
        if (!tagInput || !preview) return;
        const tags = parseTags(tagInput.value);
        preview.innerHTML = tags.map(tag => `<span class="project-tag-chip">${tag}</span>`).join('');
    }

    function updateDateDisplay(input) {
        const display = document.getElementById('date-display');
        if (!display) return;
        if (!input.value) {
            display.textContent = 'Select date';
            return;
        }
        const [year, month, day] = input.value.split('-');
        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        display.textContent = `${day} ${months[parseInt(month, 10) - 1]} ${year}`;
    }

    function getStatusMeta(status) {
        return STATUS_META[status] || STATUS_META['On-going'];
    }

    function createTaskCheckboxMarkup(taskId, taskName, status, pct, badge, indexKey) {
        return `
            <label class="task-checkbox-row" for="${indexKey}" data-created-task="true">
                <input type="checkbox" id="${indexKey}"
                    data-id="${taskId}"
                    data-name="${taskName}"
                    data-status="${status}"
                    data-pct="${pct}"
                    data-badge="${badge}" checked>
                <span class="task-check-info">
                    <i class="fas fa-file-alt text-blue"></i>
                    <span class="task-check-name">${taskName}</span>
                    <span class="task-check-project">New Task</span>
                </span>
                <span class="prog-badge ${badge}" style="font-size:10px; padding:2px 8px;">
                    ${status} ${pct}
                </span>
            </label>
        `;
    }

    function createNewTaskOption() {
        const nameInput = document.getElementById('newTaskNameInput');
        const statusInput = document.getElementById('newTaskStatusInput');
        const list = document.getElementById('existingTasksList');
        if (!nameInput || !statusInput || !list) return;
        const taskName = nameInput.value.trim();
        if (!taskName) {
            nameInput.focus();
            return;
        }
        const status = statusInput.value;
        const meta = getStatusMeta(status);
        createdTaskCounter += 1;
        const taskId = `TS${String(createdTaskCounter).padStart(3, '0')}`;
        const indexKey = `task_new_${Date.now()}`;
        list.insertAdjacentHTML('afterbegin', createTaskCheckboxMarkup(taskId, taskName, status, meta.pct, meta.badge, indexKey));
        nameInput.value = '';
        nameInput.focus();
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

    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('createProjectModal');
        if (event.target == modal) closeCreateModal();
    }

    // Timeline table: collapse/expand projects + lazy load rows
    const projectState = { 1: true };
    const lazyState = {
        rows: [],
        loadedCount: 0,
        chunkSize: 6,
        isLoading: false
    };

    function refreshProjectRows(projectId) {
        const shouldShow = !!projectState[projectId];
        const childRows = document.querySelectorAll(`.timeline-task-row[data-child="${projectId}"]`);
        childRows.forEach(row => {
            const loaded = row.dataset.lazyLoaded === 'true';
            row.style.display = shouldShow && loaded ? '' : 'none';
        });
    }

    function toggleProject(projectId) {
        projectState[projectId] = !projectState[projectId];

        const icon = document.getElementById(`icon-${projectId}`);
        if (icon) {
            icon.classList.toggle('rotated', !projectState[projectId]);
        }

        refreshProjectRows(projectId);
    }

    function loadNextTimelineChunk() {
        if (lazyState.isLoading) return;
        if (lazyState.loadedCount >= lazyState.rows.length) return;

        lazyState.isLoading = true;
        const start = lazyState.loadedCount;
        const end = Math.min(start + lazyState.chunkSize, lazyState.rows.length);

        for (let i = start; i < end; i++) {
            lazyState.rows[i].dataset.lazyLoaded = 'true';
        }

        lazyState.loadedCount = end;
        refreshProjectRows(1);
        lazyState.isLoading = false;
    }

    function maybeLoadMoreTimelineRows() {
        const container = document.querySelector('.timeline-container');
        if (!container) return;

        const nearBottom = container.scrollTop + container.clientHeight >= container.scrollHeight - 120;
        if (nearBottom) {
            loadNextTimelineChunk();
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        const container = document.querySelector('.timeline-container');
        const timelineBox = document.querySelector('.p-timeline-box-custom');
        const dateInput = document.getElementById('projectDateInput');

        lazyState.rows = Array.from(document.querySelectorAll('.timeline-task-row'));

        lazyState.rows.forEach(row => {
            row.dataset.lazyLoaded = 'false';
            row.style.display = 'none';
        });

        // Fix: Make the entire box clickable to show the calendar
        if (timelineBox && dateInput) {
            timelineBox.addEventListener('click', () => {
                if (typeof dateInput.showPicker === 'function') dateInput.showPicker();
                else dateInput.click();
            });
        }

        loadNextTimelineChunk();

        if (container) {
            document.getElementById('projectTagInput')?.addEventListener('input', renderTagsPreview);
            container.addEventListener('scroll', maybeLoadMoreTimelineRows);
        }
    });
    </script>
    <script src="{{ asset('js/assign-roles-stack.js') }}"></script>
</body>
</html>
