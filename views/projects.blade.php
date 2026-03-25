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
            <div class="profile-circle"><div class="profile-avatar">IZ</div></div>
            <div class="username">Iskandar</div>
            <nav class="nav-links">
                <a href="{{ route('dashboard.index') }}" class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i>Dashboard</a>
                <a href="{{ route('timeline.index') }}" class="nav-item"><i class="fas fa-history"></i>Timeline</a>
                <a href="{{ route('projects.index') }}" class="nav-item {{ request()->is('projects*') ? 'active' : '' }}"><i class="fas fa-folder"></i>Projects</a>
                <a href="{{ route('users.index')}}" class="nav-item {{ request()->is('users*') ? 'active' : '' }}"><i class="fas fa-users"></i>Users</a>
                <a href="{{ route('settings.index') }}" class="nav-item {{ request()->is('settings*') ? 'active' : '' }}"><i class="fas fa-cog"></i>Settings</a>
            </nav>
            <a href="#" class="logout">Log Out</a>
        </aside>

        <main class="main-container">
            <header class="top-header">
                <div class="header-left"><h1>All Projects</h1></div>
                <div class="header-right">
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
                        <tr class="row-main">
                            <td>FD001</td>
                            <td><i class="fas fa-briefcase text-blue"></i> Project 1 - Office Reno</td>
                            <td></td><td></td><td>1m ago</td><td>1 March 2027</td><td>...</td>
                            <td><a href="#" class="timeline-link"><i class="far fa-clock"></i> Timeline View</a></td>
                        </tr>
                        @foreach(['On-going' => '20%', 'On-going' => '20%', 'On-going' => '20%'] as $status => $per)
                        <tr class="row-sub">
                            <td>TS001</td>
                            <td class="pl-30"><i class="fas fa-file-alt text-blue"></i> Task (Example)</td>
                            <td><div class="prog-badge badge-blue"><span>{{$status}}</span> <span>{{$per}}</span></div></td>
                            <td><div class="owner"><i class="fas fa-user-circle"></i> Iskandar Z</div></td>
                            <td>1m ago</td><td class="text-red">1 March 2027</td><td>...</td>
                            <td><a href="#" class="timeline-link"><i class="far fa-clock"></i> Timeline View</a></td>
                        </tr>
                        @endforeach

                        <tr class="row-main">
                            <td>FD001</td>
                            <td><i class="fas fa-briefcase text-blue"></i> Project 2 - Team Building Off site</td>
                            <td></td><td></td><td>1m ago</td><td>1 March 2027</td><td>...</td>
                            <td><a href="#" class="timeline-link"><i class="far fa-clock"></i> Timeline View</a></td>
                        </tr>
                        <tr class="row-sub">
                            <td>TS001</td>
                            <td class="pl-30"><i class="fas fa-file-alt text-blue"></i> Task 1 (Proposal)</td>
                            <td><div class="prog-badge badge-green"><span>Completed</span> <span>100%</span></div></td>
                            <td><div class="owner"><i class="fas fa-user-circle"></i> Iskandar Z</div></td>
                            <td>1m ago</td><td class="text-red">1 March 2027</td><td>...</td>
                            <td><a href="#" class="timeline-link"><i class="far fa-clock"></i> Timeline View</a></td>
                        </tr>
                        <tr class="row-sub">
                            <td>TS001</td>
                            <td class="pl-30"><i class="fas fa-file-alt text-blue"></i> Task 2 (Budgeting)</td>
                            <td><div class="prog-badge badge-grey"><span>On Hold</span></div></td>
                            <td><div class="owner"><i class="fas fa-user-circle"></i> Iskandar Z</div></td>
                            <td>1m ago</td><td class="text-red">1 March 2027</td><td>...</td>
                            <td><a href="#" class="timeline-link"><i class="far fa-clock"></i> Timeline View</a></td>
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