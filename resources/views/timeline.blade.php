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
..timeline-table {
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
</style>
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
            @php $totalWeeks = 3 * 12 * 4; @endphp <tr class="row-main">
                <td class="col-id">FD001</td>
                <td class="col-task"><b><i class="fas fa-briefcase text-blue"></i> Project 1 - Office Reno</b></td>
                @for ($i = 0; $i < $totalWeeks; $i++) <td></td> @endfor
            </tr>

            <tr class="row-sub">
                <td class="col-id">TS001</td>
                <td class="col-task" style="padding-left: 30px;"><i class="fas fa-file-alt text-blue"></i> Task 1 (Proposal)</td>
                <td colspan="{{ $totalWeeks }}" class="timeline-cell">
                    <div class="timeline-bar blue-bar" style="width: 400px; margin-left: 0px;">
                        On-going 20%
                    </div>
                </td>
            </tr>

            @for ($j = 2; $j <= 20; $j++)
            <tr class="row-sub">
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