<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task 1 (Example)</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
    </style>
</head>
<body>
    <div class="wrapper">
        <aside class="sidebar">
            <div class="profile-circle"><div class="profile-avatar">IZ</div></div>
            <div class="username">Iskandar</div>
            <nav class="nav-links">
                <a href="{{ route('dashboard.index') }}" class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}"><i class="fas fa-home"></i>Dashboard</a>
                <a href="{{ route('timeline.index') }}" class="nav-item {{ request()->is('timeline*') ? 'active' : '' }}"><i class="fas fa-history"></i>Timeline</a>
                <a href="{{ route('projects.index') }}" class="nav-item {{ request()->is('projects*') ? 'active' : '' }}"><i class="fas fa-folder"></i>Projects</a>
                <a href="{{ route('users.index')}}" class="nav-item {{ request()->is('users*') ? 'active' : '' }}"><i class="fas fa-users"></i>Users</a>
                <a href="{{route('settings.index') }}" class="nav-item {{ request()->is('settings*') ? 'active' : '' }}"><i class="fas fa-cog"></i>Settings</a>
            </nav>
            <a href="{{ route('logout.index') }}" class="logout">Log Out</a>
        </aside>


        <main class="main-container">
            <header class="top-header">
                <div class="header-left" style="display: flex; align-items: center;">
                    <a href="{{ route('projects.index') }}" style="color: #333; margin-right: 10px; display: flex; align-items: center; text-decoration: none;">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                <h1 style="font-size: 1.25rem; margin: 0; line-height: 1;">
                    {{ $task_name ?? 'Task 1 (Proposal)' }}
                </h1>
                </div>
                <div class="header-right">
                    <i class="far fa-envelope"></i>
                    <div style="position: relative;">
                        <i class="far fa-bell"></i>
                        <span style="position: absolute; top: -5px; right: -2px; width: 8px; height: 8px; background: #e53e3e; border-radius: 50%; border: 2px solid #fff;"></span>
                    </div>
                    <div class="search-container">
                        <i class="fas fa-search"></i>
                        <input type="text" placeholder="Search">
                    </div>
                    <button class="btn-create"><i class="fas fa-plus-circle"></i> Create</button>
                </div>
            </header>

                <div class="breadcrumb" style="padding: 15px 25px; display: flex; align-items: center; gap: 20px;">
                    <div style="font-size: 13px; color: #718096;">
                        Projects &nbsp; > &nbsp; Project 1 - Office Reno &nbsp; > &nbsp; <b style="color: #2d3748;">Task (Example)</b>
                    </div>
                    <a href="#" class="timeline-link" style="text-decoration: none; color: #3182ce; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 5px;">
                        <i class="far fa-clock"></i> Timeline View
                    </a>
                </div>

            <div class="detail-layout">
                <div class="left-content">
                    <div class="action-card">
                        <h3>Action Required</h3>
                        <table class="action-table">
                            @php
                                $actions = [
                                    ['file' => 'Proposal.doc', 'time' => '1m ago'],
                                    ['file' => 'Committee List.doc', 'time' => '1m ago'],
                                    ['file' => 'Budget.xlsx', 'time' => '1m ago'],
                                    ['file' => 'Profit.xlsx', 'time' => '1m ago']
                                ];
                            @endphp
                            @foreach($actions as $item)
                            <tr>
                                <td width="30%"><i class="fas fa-file-alt text-blue"></i> {{ $item['file'] }}</td>
                                <td width="15%">Project 1</td>
                                <td width="20%"><span class="status-pending"><i class="far fa-eye"></i> Pending Review</span></td>
                                <td width="15%">
                                    <div class="avatar-group">
                                        <img src="https://i.pravatar.cc/150?u=1" alt="u1">
                                        <img src="https://i.pravatar.cc/150?u=2" alt="u2">
                                        <div class="avatar-count">+2</div>
                                        <div class="avatar-add">+</div>
                                    </div>
                                </td>
                                <td width="10%" style="color: #a0aec0;">{{ $item['time'] }}</td>
                                <td width="10%"><b style="color: #e53e3e; font-size: 12px;">8 Nov 2025</b></td>
                                <td><button type="button" class="btn-approve" onclick="handleApprove(this)">✓ Approve</button></td>
                            </tr>
                            @endforeach
                        </table>
                        <div id="seeMoreBtn" onclick="toggleRows()" style="text-align:center; color:#3498db; margin-top:15px; font-size:12px; cursor:pointer">
                            <span id="btnText">See more</span> <i id="btnIcon" class="fas fa-caret-down"></i>
                        </div>
                    </div>

                    <table class="project-list">
                        <thead>
                            <tr style="border-bottom: 1px solid #edf2f7; text-align: left;">
                                <th style="padding: 12px; font-size: 12px; color: #a0aec0;">ID</th>
                                <th style="padding: 12px; font-size: 12px; color: #a0aec0;">Task</th>
                                <th style="padding: 12px; font-size: 12px; color: #a0aec0;">Project</th>
                                <th style="padding: 12px; font-size: 12px; color: #a0aec0;">Status</th>
                                <th style="padding: 12px; font-size: 12px; color: #a0aec0;">Assignee</th>
                                <th style="padding: 12px; font-size: 12px; color: #a0aec0;">Last Modified</th>
                                <th style="padding: 12px; font-size: 12px; color: #a0aec0;">Due Date</th>
                                <th style="padding: 12px; font-size: 12px; color: #a0aec0;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i=0; $i<5; $i++)
                            <tr style="border-bottom: 1px solid #f7fafc;">
                                <td style="padding: 15px 12px;">TS001</td>
                                <td><i class="fas fa-file-alt text-blue"></i> Proposal.doc</td>
                                <td>Project 1</td>
                                <td><span class="status-pending">Pending Review</span></td>
                                <td>
                                    <div class="avatar-group">
                                        <img src="https://i.pravatar.cc/150?u=a" alt="u">
                                        <img src="https://i.pravatar.cc/150?u=b" alt="u">
                                        <div class="avatar-count">+2</div>
                                        <div class="avatar-add">+</div>
                                    </div>
                                </td>
                                <td style="color: #a0aec0;">1m ago</td>
                                <td style="color: #e53e3e; font-weight: 600;">8 Nov 2025</td>
                                <td><i class="fas fa-ellipsis-h" style="color: #cbd5e0;"></i></td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>

                <div class="right-sidebar">
                    <div class="task-header">
                        <h3 style="font-size: 16px; font-weight: 700; color: #2d3748;">Task Overview</h3>
                        <i class="fas fa-ellipsis-v" style="color:#cbd5e0;"></i>
                    </div>

                    <div class="task-item">
                        <i class="fas fa-archive"></i> <span>Project Group</span> <b>Project 1</b>
                    </div>

                    <div class="task-item">
                        <i class="fas fa-users"></i> <span>Assigned Users</span>
                        <div class="avatar-group" style="justify-content: flex-end;">
                            <img src="https://i.pravatar.cc/150?u=9" alt="u">
                            <img src="https://i.pravatar.cc/150?u=8" alt="u">
                            <img src="https://i.pravatar.cc/150?u=7" alt="u">
                            <div class="avatar-add">+</div>
                        </div>
                    </div>

                    <div class="task-item">
                        <i class="fas fa-calendar-alt"></i> <span>Due Date</span> <b>13 Aug 2026 - 2 Dec 2026</b>
                    </div>

                    <div class="task-item">
                        <i class="fas fa-times-circle"></i> <span>Progress</span> 
                        <div style="text-align: right;">
                            <span class="status-pending" style="font-size: 9px; padding: 2px 8px;">In Review</span> 
                            <span style="color: #3182ce; font-weight: 700; font-size: 12px; margin-left: 5px;">20%</span>
                        </div>
                        <div class="progress-wrapper">
                            <div class="progress-container"><div class="progress-bar"></div></div>
                        </div>
                    </div>

                    <div class="comment-tabs">
                        <div class="tab-item active">Comments <span class="dot">●</span></div>
                        <div class="tab-item">Activity</div>
                    </div>

                    <div id="comment-list" style="max-height: 350px; overflow-y: auto;">
                        <div class="comment-box">
                            <div class="comment-header">
                                <span class="comment-author">Aliff</span>
                                <span class="comment-time">1 min ago</span>
                            </div>
                            <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                        </div>
                        <div class="comment-box">
                            <div class="comment-header">
                                <span class="comment-author">Aliff</span>
                                <span class="comment-time">1 hrs ago</span>
                            </div>
                            <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        </div>
                    </div>

                    <div class="comment-input-area">
                        <textarea id="comment-text" placeholder="Write your comments here..." style="width: 100%; border: 1px solid #edf2f7; border-radius: 8px; padding: 12px; height: 100px; resize: none; font-family: inherit; font-size: 13px;"></textarea>
                        <button onclick="addComment()" class="btn-submit">Submit</button>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function addComment() {
            const text = document.getElementById('comment-text').value;
            if (text.trim() === "") return;
            const commentList = document.getElementById('comment-list');
            const newComment = document.createElement('div');
            newComment.className = 'comment-box';
            newComment.innerHTML = `
                <div class="comment-header">
                    <span class="comment-author">Iskandar</span>
                    <span class="comment-time">Just now</span>
                </div>
                <p class="comment-text">${text}</p>
            `;
            commentList.prepend(newComment);
            document.getElementById('comment-text').value = "";
        }
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
    </script>
</body>
</html>