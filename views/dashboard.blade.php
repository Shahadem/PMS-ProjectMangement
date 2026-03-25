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

             <a href="{{ route('users.index')}}" class="nav-item {{ request()->is('users*') ? 'active' : '' }}">
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
                    <i class="far fa-envelope" style="color:#888"></i>
                    <i class="far fa-bell" style="color:#888"></i>
                    <div class="search-container">
                        <i class="fas fa-search" style="color:#ccc"></i>
                        <input type="text" placeholder="Search">
                    </div>
                    <button class="btn-create"><i class="fas fa-plus-circle"></i> Create</button>
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
                        <table>
                            @foreach(range(1,4) as $i)
                            <tr>
                                <td style="color:#999">TS001</td>
                                <td><i class="far fa-file-alt" style="color:#3498db"></i> Proposal.doc</td>
                                <td>Project 1</td>
                               <td>
                                    <span class="status-pending">
                                        <i class="fas fa-eye"></i> Pending Review
                                    </span>
                                </td>
                                <td>
                                <div class="avatar-stack">
                                    <div><img src="https://i.pravatar.cc/150?u=1" class="avatar-img-stack"></div>
                                    <div><img src="https://i.pravatar.cc/150?u=2" class="avatar-img-stack"></div>
                                     <div class="more">+2</div>
                                </div>
                                </td>
                                <td style="color:#999">1m ago</td>
                                <td class="text-red"><span class="date-fix">8 Nov 2025</span></td>
                                <td><button class="btn-approve">✓ Approve</button></td>
                            </tr>
                            @endforeach
                        </table>
                        <div style="text-align:center; color:#3498db; margin-top:15px; font-size:12px; cursor:pointer">
                            See more <i class="fas fa-caret-down"></i>
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
</body>
<style>
    /* Ini untuk paksa tarikh lurus satu baris */
    .date-fix {
        white-space: nowrap !important;
        display: inline-block;
        min-width: 90px; /* Bagi ruang sikit supaya tak berlanggar */
    }

    /* Pastikan table cell tak terlalu sempit */
    table td {
        padding: 10px 5px;
    }
</style>
</html>