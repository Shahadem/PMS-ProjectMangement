<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Iskandar Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
</head>
<body>
    <div class="wrapper">
        <aside class="sidebar">
            <div class="profile-circle"><div class="profile-avatar">IZ</div></div>
            <div class="username">Iskandar</div>
            <nav class="nav-links">
                <a href="{{ route('dashboard.index') }}" class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i>Dashboard</a>
                <a href="{{ route('timeline.index') }}" class="nav-item {{ request()->is('timeline*') ? 'active' : '' }}"><i class="fas fa-clock"></i>Timeline</a>
                <a href="{{ route('projects.index') }}" class="nav-item {{ request()->is('projects*') ? 'active' : '' }}"><i class="fas fa-folder"></i>Projects</a>
                <a href="{{ route('users.index')}}" class="nav-item {{ request()->is('users*') ? 'active' : '' }}"><i class="fas fa-users"></i>Users</a>
                <a href="{{route('settings.index') }}" class="nav-item {{ request()->is('settings*') ? 'active' : '' }}"><i class="fas fa-cog"></i>Settings</a>
            </nav>
            <a href="/" class="logout">Log Out</a>
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
                                    <div class="avatar-stack">
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
                                    <div class="avatar-stack">
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
                                    <td><div class="avatar-stack"><div></div><div></div><div class="more">+2</div></div></td>
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
                                    <td><div class="avatar-stack"><div></div><div></div><div class="more">+2</div></div></td>
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