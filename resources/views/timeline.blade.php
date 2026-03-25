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
    <div class="timeline-scroll-wrapper">
        <table class="timeline-table">
            <thead>
                <tr class="year-header">
                    <th rowspan="3" class="col-id sticky-col">ID</th>
                    <th rowspan="3" class="col-task sticky-col">Task <i class="fas fa-caret-down"></i></th>
                    @foreach(['2025', '2026', '2027'] as $year)
                        <th colspan="48" class="year-label">{{ $year }}</th> @endforeach
                </tr>

                <tr class="month-header">
                    @foreach(['2025', '2026', '2027'] as $year)
                        @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                            <th colspan="4">{{ $month }}</th>
                        @endforeach
                    @endforeach
                </tr>

                <tr class="week-header">
                    @for ($i = 0; $i < (3 * 12); $i++) <th>1</th><th>2</th><th>3</th><th>4</th>
                    @endfor
                </tr>
            </thead>
            <tbody>
                <tr class="row-main">
                    <td class="sticky-col">FD001</td>
                    <td class="sticky-col"><i class="fas fa-briefcase text-blue"></i> Project 1 - Office Reno</td>
                    @for ($i = 0; $i < 144; $i++) <td></td> @endfor </tr>
                </tbody>
        </table>
    </div>
</div>
        </main>
    </div>
</body>
</html>