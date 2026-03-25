<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline - Project Overview</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
                    <button class="btn-create"><i class="fas fa-plus-circle"></i> Create</button>
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
                        <tr class="month-header">
                            <th rowspan="2" class="col-id">ID</th>
                            <th rowspan="2" class="col-task">Task <i class="fas fa-caret-down"></i></th>
                            <th colspan="4">October</th>
                            <th colspan="4">November</th>
                            <th colspan="4">December</th>
                            <th colspan="4">January</th>
                        </tr>
                        <tr class="week-header">
                            @for ($i = 0; $i < 4; $i++)
                                <th>Wk 1</th><th>Wk 2</th><th>Wk 3</th><th>Wk 4</th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="row-main">
                            <td>FD001</td>
                            <td><i class="fas fa-briefcase text-blue"></i> Project 1 - Office Reno</td>
                            @for ($i = 0; $i < 16; $i++) <td></td> @endfor
                        </tr>
                        <tr class="row-sub">
                            <td>TS001</td>
                            <td class="pl-20"><i class="fas fa-file-alt text-blue"></i> Task 1 (Proposal)</td>
                            <td colspan="16" class="timeline-cell">
                                <div class="timeline-bar blue-bar" style="width: 40%; margin-left: 25%;">
                                    On-going 20%
                                </div>
                            </td>
                        </tr>
                        <tr class="row-sub">
                            <td>TS001</td>
                            <td class="pl-20"><i class="fas fa-file-alt text-blue"></i> Task 2 (Interior Design)</td>
                            <td colspan="16" class="timeline-cell">
                                <div class="timeline-bar grey-bar" style="width: 15%; margin-left: 55%;">
                                    On Hold
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>