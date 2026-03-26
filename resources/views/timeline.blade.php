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
</body>
</html>