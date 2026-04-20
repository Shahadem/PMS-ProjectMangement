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
                <a href="{{ route('users.index')}}" class="nav-item {{ request()->is('users*') ? 'active' : '' }}"><i class="fas fa-users"></i>Users</a>
                <a href="{{route('settings.index') }}" class="nav-item {{ request()->is('settings*') ? 'active' : '' }}"><i class="fas fa-cog"></i>Settings</a>
            </nav>
            <a href="{{ route('logout') }}" class="logout">Log Out</a>
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
                    <button class="btn-create" onclick="openModal()"><i class="fas fa-plus-circle"></i> Create</button>
                </div>
            </header>

                <div class="breadcrumb" style="padding: 15px 25px; display: flex; align-items: center; justify-content: space-between;">
                    <div style="font-size: 13px; color: #718096;">
                        Projects &nbsp; > &nbsp; Project 1 - Office Reno &nbsp; > &nbsp; <b style="color: #2d3748;">Task (Example)</b>
                    </div>
                    <a href="#" class="timeline-link" style="text-decoration: none; color: #3182ce; font-size: 13px; font-weight: 600; display: flex; align-items: center; gap: 5px; margin-right: 5px;">
                        <i class="far fa-clock"></i> Timeline View
                    </a>
                </div>

            <div class="detail-layout">
                <div class="left-content">
                <div class="action-card">
                    @php
                        $getFileMeta = function($file) {
                            $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                            return match($ext) {
                                'pdf' => ['icon' => 'fa-file-pdf', 'color' => 'text-red'],
                                'doc', 'docx' => ['icon' => 'fa-file-word', 'color' => 'text-blue'],
                                'xls', 'xlsx' => ['icon' => 'fa-file-excel', 'color' => 'text-green'],
                                'png', 'jpg', 'jpeg', 'gif' => ['icon' => 'fa-file-image', 'color' => 'text-blue'],
                                default => ['icon' => 'fa-file-alt', 'color' => 'text-blue'],
                            };
                        };
                    @endphp
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
            @php $meta = $getFileMeta($item['file']); @endphp
            <tr>
                <td width="30%" 
                    onclick="openFileMenu(event, '{{ $item['file'] }}')" 
                    oncontextmenu="openFileMenu(event, '{{ $item['file'] }}')" 
                    style="cursor: pointer;">
                    <i class="fas {{ $meta['icon'] }} {{ $meta['color'] }}"></i> {{ $item['file'] }}
                </td>
                <td width="15%">Project 1</td>
                <td width="20%"><span class="status-pending"><i class="far fa-eye"></i> Pending Review</span></td>
                <td width="15%">
                    <div class="avatar-group assignee-trigger">
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
    </div>

    <div style="display: flex; justify-content: flex-end; gap: 10px; margin-bottom: 15px;">
        <button onclick="switchView('list')" id="btnList" style="cursor:pointer; padding: 5px 10px; background: #eee; border: 1px solid #ccc; border-radius: 4px;">
            <i class="fas fa-list"></i> List
        </button>
        <button onclick="switchView('grid')" id="btnGrid" style="cursor:pointer; padding: 5px 10px; background: #fff; border: 1px solid #ccc; border-radius: 4px;">
            <i class="fas fa-th-large"></i> Grid
        </button>
    </div>

    <div id="projectWrapper" class="view-list">
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

            @php $propMeta = $getFileMeta('Proposal.doc'); @endphp
            @for($i=0; $i<10; $i++)

            <tr style="border-bottom: 1px solid #f7fafc;">

                <td style="padding: 15px 12px;">TS001</td>

                <td onclick="openFileMenu(event, 'Proposal.doc')"

                    oncontextmenu="openFileMenu(event, 'Proposal.doc')"

                    style="cursor: pointer;">

                    <i class="fas {{ $propMeta['icon'] }} {{ $propMeta['color'] }}"></i> Proposal.doc

                </td>

                <td>Project 1</td>

                <td><span class="status-pending">Pending Review</span></td>

                <td>

                    <div class="avatar-group assignee-trigger">

                        <img src="https://i.pravatar.cc/150?u=a" alt="u">

                        <img src="https://i.pravatar.cc/150?u=b" alt="u">

                        <div class="avatar-count">+2</div>

                    </div>

                </td>

                <td style="color: #a0aec0;">1m ago</td>

                <td style="color: #e53e3e; font-weight: 600;">8 Nov 2025</td>

                <td><i class="fas fa-ellipsis-h" style="color: #cbd5e0; cursor: pointer;" onclick="openFileMenu(event, 'Proposal.doc')"></i></td>

            </tr>

            @endfor

        </tbody>

    </table>
    </div>

    <!-- Grid view container (file manager style) -->
    <div id="gridWrapper" style="display: none;" class="file-grid-container">
        <div id="fileGrid" class="file-grid">
        </div>
    </div>
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
                        <div class="avatar-group assignee-trigger" style="justify-content: flex-end;">
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

    <div id="createTaskModal" class="modal">
    <div class="modal-content" style="background: #fff; padding: 24px; border-radius: 12px; width: 420px; box-shadow: 0 4px 20px rgba(0,0,0,0.1); font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
        
        <div class="modal-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <h2 style="font-size: 18px; font-weight: 700; color: #2d3748; margin: 0;">Create New Task</h2>
            <i class="fas fa-times" style="cursor:pointer; color: #a0aec0; font-size: 18px;" onclick="closeModal()"></i>
        </div>
        
        <div style="display: flex; gap: 16px; margin-bottom: 18px;">
            <div class="form-group" style="flex: 1;">
                <label style="display: block; font-size: 13px; font-weight: 600; color: #4a5568; margin-bottom: 8px;">Task Name</label>
                <input type="text" id="taskNameInput" placeholder="Enter task name" 
                    style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; color: #2d3748; outline: none; box-sizing: border-box;">
            </div>
            <div class="form-group" style="flex: 1;">
                <label style="display: block; font-size: 13px; font-weight: 600; color: #4a5568; margin-bottom: 8px;">Project Name</label>
                <div style="position: relative; width: 100%;">
                    <select style="width: 100%; padding: 12px 12px 12px 12px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; color: #a0aec0; outline: none; box-sizing: border-box; background-color: white; cursor: pointer; appearance: none; -webkit-appearance: none;">
                        <option value="" disabled selected>Select Project</option>
                        <option value="proj1">Project 1 - Office Reno</option>
                    </select>
                    <i class="fas fa-chevron-down" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #a0aec0; font-size: 12px; pointer-events: none;"></i>
                </div>
            </div>
        </div>

        <div style="display: flex; gap: 16px; margin-bottom: 18px; align-items: flex-start;">
    
    <div class="form-group" style="flex: 1;">
        <label style="display: block; font-size: 13px; font-weight: 600; color: #4a5568; margin-bottom: 8px;">Add Roles</label>
        <div style="display: flex; align-items: center; padding: 4px 0;">
            <div style="width: 32px; height: 32px; border-radius: 50%; background-color: #a0aec0; border: 2px solid white; position: relative; z-index: 4;"></div>
            <div style="width: 32px; height: 32px; border-radius: 50%; background-color: #3182ce; border: 2px solid white; margin-left: -10px; position: relative; z-index: 3;"></div>
            <div style="width: 32px; height: 32px; border-radius: 50%; background-color: #f6ad55; border: 2px solid white; margin-left: -10px; position: relative; z-index: 2;"></div>
            <div style="width: 32px; height: 32px; border-radius: 50%; background-color: #edf2f7; color: #718096; border: 2px solid white; display: flex; align-items: center; justify-content: center; font-size: 11px; font-weight: bold; margin-left: -10px; position: relative; z-index: 1;">+2</div>
            <div style="width: 32px; height: 32px; border-radius: 50%; border: 1px dashed #cbd5e0; display: flex; align-items: center; justify-content: center; color: #cbd5e0; cursor: pointer; margin-left: 10px;">
                <i class="fas fa-plus" style="font-size: 14px;"></i>
            </div>
        </div>
    </div>

    <div class="form-group" style="flex: 1;">
        <label style="display: block; font-size: 13px; font-weight: 600; color: #4a5568; margin-bottom: 8px;">Set Timeline</label>
        <div style="position: relative; width: 100%;" onclick="document.getElementById('endDateInput').showPicker()">
            
            <div id="dateDisplay" style="width: 100%; padding: 12px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; color: #a0aec0; background: white; box-sizing: border-box; min-height: 45px; display: flex; align-items: center;">
                Select Date
            </div>

            <input type="date" id="endDateInput" onchange="formatDateDisplay(this)"
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0; cursor: pointer; z-index: 5;">
            
            <i class="far fa-calendar-alt" style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); color: #a0aec0; pointer-events: none;"></i>
        </div>
    </div>
</div>
        <div class="form-group" style="margin-bottom: 18px;">
            <label style="display: block; font-size: 13px; font-weight: 600; color: #4a5568; margin-bottom: 8px;">Add Files</label>
            <div id="dropZone" style="border: 1px dashed #cbd5e0; border-radius: 12px; padding: 32px; text-align: center; cursor: pointer; background: #fff;" onclick="document.getElementById('fileInput').click()">
                <i class="fas fa-cloud-upload-alt" style="font-size: 28px; color: #a0aec0; margin-bottom: 12px;"></i>
                <p style="margin: 0; font-size: 12px; color: #718096;">Drag & drop file here or click to upload</p>
                <input type="file" id="fileInput" hidden>
                <div id="fileInfo" style="margin-top: 8px; font-size: 12px; color: #3182ce; font-weight: 600;"></div>
            </div>
        </div>

        <div class="modal-footer" style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 24px;">
            <button class="btn-cancel" onclick="closeModal()" 
                style="padding: 12px 24px; border: none; background: #f7fafc; color: #4a5568; border-radius: 8px; font-size: 14px; font-weight: 700; cursor: pointer;">Cancel</button>
            <button class="btn-save" onclick="submitTask()" 
                style="padding: 12px 24px; border: none; background: #3182ce; color: white; border-radius: 8px; font-size: 14px; font-weight: 700; cursor: pointer;">Create Task</button>
        </div>
    </div>
</div>
<div id="fileContextMenu" class="file-context-menu">
    <div class="menu-item" onclick="handleMenuAction('submit')"><i class="fas fa-paper-plane"></i> Submit for Approval</div>
    <div class="menu-divider"></div>
    <div class="menu-item" onclick="handleMenuAction('open')"><i class="fas fa-external-link-alt"></i> Open</div>
    <div class="menu-item" onclick="handleMenuAction('edit')"><i class="fas fa-edit"></i> Edit Setting</div>
    <div class="menu-item" onclick="handleMenuAction('copy')"><i class="fas fa-copy"></i> Copy</div>
    <div class="menu-item" onclick="handleMenuAction('copy-link')"><i class="fas fa-link"></i> Copy Link</div>
    <div class="menu-item" onclick="handleMenuAction('rename')"><i class="fas fa-i-cursor"></i> Rename</div>
    <div class="menu-divider"></div>
    <div class="menu-item delete" onclick="handleMenuAction('delete')"><i class="fas fa-trash-alt"></i> Delete</div>
</div>


<script src="{{ asset('js/assign-roles-stack.js') }}"></script>

<style>
    #endDateInput::-webkit-calendar-picker-indicator {
        position: absolute;
        top: 0; 
        left: 0; 
        right: 0; 
        bottom: 0;
        width: 100%; height: 100%;
        margin: 0; padding: 0;
        cursor: pointer;
        opacity: 0;
    }
    /* Priority Radio Styles */
    /* Kekalkan CSS Priority Box sebelum ini */
    .priority-option { 
        flex: 1; 
        cursor: pointer; 
    }
    .priority-box {
        display: flex; 
        align-items: center; 
        justify-content: center; 
        gap: 8px;
        padding: 10px; 
        border: 1px solid #e2e8f0; 
        border-radius: 10px;
        font-size: 13px; 
        font-weight: 600; 
        color: #718096; 
        background: #fff;
    }
    .priority-option input:checked + .priority-box {
        border-color: #3182ce; 
        background: #ebf8ff; 
        color: #3182ce;
    }
    .dot { 
        width: 8px; 
        height: 8px; 
        border-radius: 50%; 
        display: inline-block; 
    }

    .dot-low { 
        background: #48bb78; 
    }

    .dot-medium { 
        background: #ecc94b; 
    }
    .dot-high { 
        background: #e53e3e; 
    }

    /* Hover effect untuk button Add */
    .fa-plus:hover {
        color: #3182ce;
    }

    .action-table td {
        white-space: nowrap;
        padding: 10px 12px;
        font-size: 13px;
        vertical-align: middle;
    }

    .file-context-menu { 
        position: fixed;        
        display: none;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        width: 200px;
        z-index: 99999;
        padding: 6px 0;
        font-family: 'Segoe UI', sans-serif;
    }

    .menu-item {
        padding: 10px 16px;
        font-size: 13px;
        color: #4a5568;
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        transition: background 0.15s;
    }

    .menu-item:hover {
        background: #f0f7ff;
        color: #3182ce;
    }

    .menu-item i {
        width: 16px;
        font-size: 13px;
        color: #a0aec0;
    }

    .menu-item:hover i {
        color: #3182ce;
    }

    .menu-item.delete {
        color: #e53e3e;
    }

    .menu-item.delete:hover {
        background: #fff5f5;
    }

    .menu-item.delete i {
        color: #e53e3e;
    }

    .menu-divider {
        height: 1px;
        background: #f0f0f0;
        margin: 4px 0;
    }

    .timeline-container.view-grid thead,
    .timeline-container.view-grid .year-header,
    .timeline-container.view-grid .month-header,
    .timeline-container.view-grid .week-header,
    .timeline-container.view-grid .hide-grid, 
    .timeline-container.view-grid td:not(.col-task), 
    .timeline-container.view-grid th:not(.col-task) {
        display: none !important;
    }

        /* 1. Paksa container dan table ke mod Grid */
    .timeline-container.view-grid {
        width: 100%;
        max-height: 80vh !important; /* Biar nampak tinggi ke bawah */
        overflow-y: auto;
        border: none !important; /* Buang border container */
    }

        /* ========== FILE MANAGER GRID VIEW ========== */
    .file-grid-container {
        border: 1px solid #edf2f7;
        border-radius: 12px;
        background: #fff;
        padding: 14px 16px;
    }
    .file-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(140px, 160px));
        gap: 28px;
        justify-content: start;
        margin-top: 0;
        padding: 12px 4px;
    }
    .file-grid-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        cursor: pointer;
        padding: 18px 8px 14px;
        border-radius: 20px;
        transition: all 0.2s;
        background: transparent;
    }
    .file-grid-item:hover {
        background: #f8fafc;
        transform: translateY(-4px);
    }
    .file-icon {
        font-size: 64px;
        margin-bottom: 14px;
    }
    .file-icon .fa-folder { 
        color: #f59e0b; 
    }
    .file-icon .fa-file-word { 
        color: #2b5797; 
    }
    .file-icon .fa-file-excel { 
        color: #1f724c; 
    }
    .file-icon .fa-file-alt { 
        color: #6c757d; 
    }
    .file-name {
        font-size: 0.85rem;
        font-weight: 500;
        color: #1e293b;
        word-break: break-word;
        max-width: 140px;
        padding: 4px 8px;
        border-radius: 30px;
    }
    .file-grid-item:hover .file-name {
        background: #eef2ff;
        color: #1e40af;
    }
    .file-meta {
        margin-top: 6px;
        font-size: 11px;
        color: #64748b;
        display: flex;
        gap: 8px;
        justify-content: center;
        flex-wrap: wrap;
    }
    .file-meta span {
        background: #f1f5f9;
        border-radius: 999px;
        padding: 2px 8px;
        line-height: 1.4;
    }
</style>

    
    <script>
    let currentSelectedFile = "";
    let uploadedFileName = "";
    const modal = document.getElementById('createTaskModal');
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const fileInfo = document.getElementById('fileInfo');

    // 1. Fungsi Tambah Komen
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

    // 2. Fungsi Approve Button
    function handleApprove(btn) {
        if (btn.classList.contains('is-approved')) {
            btn.classList.remove('is-approved');
            btn.innerHTML = '✓ Approve';
        } else {
            btn.classList.add('is-approved');
            btn.innerHTML = '✓ Approved';
        }
    }

    // 3. Modal & File Upload Logic
    function openModal() { modal.style.display = 'flex'; }
    function closeModal() { modal.style.display = 'none'; }

    fileInput.onchange = function() { handleFiles(this.files[0]); };
    dropZone.onclick = () => fileInput.click();
    dropZone.ondragover = (e) => { e.preventDefault(); dropZone.classList.add('dragover'); };
    dropZone.ondragleave = () => dropZone.classList.remove('dragover');
    dropZone.ondrop = (e) => {
        e.preventDefault();
        dropZone.classList.remove('dragover');
        handleFiles(e.dataTransfer.files[0]);
    };

    function handleFiles(file) {
        if (file) {
            uploadedFileName = file.name;
            fileInfo.innerHTML = `<i class="fas fa-file"></i> ${file.name}`;
        }
    }

    // 4. FORMAT TARIKH DI MODAL (Preview)
    function formatDateDisplay(input) {
        const dateValue = input.value;
        if (dateValue) {
            const date = new Date(dateValue);
            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            document.getElementById('dateDisplay').innerText = date.toLocaleDateString('en-GB', options);
            document.getElementById('dateDisplay').style.color = '#2d3748';
        }
    }

    // 5. SUBMIT TASK (Fungsi Utama yang telah dibetulkan)
    function submitTask() {
        const name = document.getElementById('taskNameInput').value;
        const deadlineValue = document.getElementById('endDateInput').value;

        if (!name || !uploadedFileName) {
            alert("Please enter the task name and upload the file.");
            return;
        }

        // --- PROSES FORMAT TARIKH ---
        let formattedDeadline = 'No Date';
        if (deadlineValue) {
            const dateObj = new Date(deadlineValue);
            const options = { day: 'numeric', month: 'short', year: 'numeric' };
            // Menukar 2026-03-30 -> 30 March 2026
            formattedDeadline = dateObj.toLocaleDateString('en-GB', options);
        }

        const tableBody = document.querySelector('.project-list tbody');
        const newRow = document.createElement('tr');
        newRow.style.borderBottom = "1px solid #f7fafc";
        
        const fileNameForJS = uploadedFileName;
        const iconClass = getFileIconClass(fileNameForJS);
        const colorClass = getFileColorClass(fileNameForJS);

        newRow.innerHTML = `
            <td style="padding: 15px 12px;">TS${Math.floor(100 + Math.random() * 900)}</td>
            <td onclick="openFileMenu(event, '${fileNameForJS}')" 
                oncontextmenu="openFileMenu(event, '${fileNameForJS}')" 
                style="cursor: pointer;">
                <i class="fas ${iconClass} ${colorClass}"></i> ${uploadedFileName}
            </td>
            <td>Project 1</td>
            <td><span class="status-pending">Pending Review</span></td>
            <td>
                <div class="avatar-group assignee-trigger">
                    <img src="https://i.pravatar.cc/150?u=new" alt="u">
                    <div class="avatar-count">+0</div>
                </div>
            </td>
            <td style="color: #a0aec0;">Just now</td>
            <td style="color: #e53e3e; font-weight: 600;">${formattedDeadline}</td> 
            <td><i class="fas fa-ellipsis-h" style="color: #cbd5e0; cursor: pointer;" onclick="openFileMenu(event, '${fileNameForJS}')"></i></td>
        `;

        tableBody.prepend(newRow);

        const gridWrapper = document.getElementById('gridWrapper');
        if (gridWrapper && gridWrapper.style.display === 'block') {
            syncGridFromList();
        }

        closeModal();
        
        // Reset Form Modal
        document.getElementById('taskNameInput').value = "";
        document.getElementById('endDateInput').value = "";
        document.getElementById('fileInfo').innerHTML = "";
        document.getElementById('dateDisplay').innerText = "Select Date";
        document.getElementById('dateDisplay').style.color = '#a0aec0';
        uploadedFileName = "";
    }

    // 6. Context Menu Logic
    function openFileMenu(e, fileName) {
        e.preventDefault();
        e.stopPropagation(); 
        currentSelectedFile = fileName;
        const menu = document.getElementById('fileContextMenu');
        menu.style.display = 'block';
        menu.style.left = e.pageX + 'px';
        menu.style.top = e.pageY + 'px';
    }

    document.addEventListener('click', function() {
        document.getElementById('fileContextMenu').style.display = 'none';
    });

    // Kemaskini fungsi sedia ada ini
    function handleMenuAction(action) {
        if (action === 'submit') {
            // Cari elemen stack dalam baris yang sama untuk mengekalkan konteks user
            const rows = document.querySelectorAll('.project-list tbody tr, .action-table tr');
            let targetStack = null;
            for (let row of rows) {
                if (row.innerText.includes(currentSelectedFile)) {
                    targetStack = row.querySelector('.assignee-trigger');
                    break;
                }
            }

            if (window.triggerApprovalModal && targetStack) {
                window.triggerApprovalModal(targetStack, currentSelectedFile);
            } else {
                alert(`Submit Approval flow for: ${currentSelectedFile}`);
            }
        } else {
            alert(`Action: ${action} pada ${currentSelectedFile}`);
        }
    }

function escapeHtml(value) {
    if (!value) return '';
    return value
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#39;');
}

function getFileIconClass(fileName) {
    const lower = (fileName || '').toLowerCase();
    if (lower.endsWith('.doc') || lower.endsWith('.docx')) return 'fa-file-word';
    if (lower.endsWith('.xls') || lower.endsWith('.xlsx')) return 'fa-file-excel';
    if (lower.endsWith('.pdf')) return 'fa-file-pdf';
    if (lower.endsWith('.png') || lower.endsWith('.jpg') || lower.endsWith('.jpeg') || lower.endsWith('.gif')) return 'fa-file-image';
    return 'fa-file-alt';
}

function getFileColorClass(fileName) {
    const lower = (fileName || '').toLowerCase();
    if (lower.endsWith('.doc') || lower.endsWith('.docx')) return 'text-blue';
    if (lower.endsWith('.xls') || lower.endsWith('.xlsx')) return 'text-green';
    if (lower.endsWith('.pdf')) return 'text-red';
    return 'text-blue';
}

function syncGridFromList() {
    const fileGrid = document.getElementById('fileGrid');
    const rows = document.querySelectorAll('#projectWrapper .project-list tbody tr');

    if (!fileGrid) return;
    fileGrid.innerHTML = '';

    rows.forEach((row) => {
        const id = row.cells[0] ? row.cells[0].innerText.trim() : '';
        const fileName = row.cells[1] ? row.cells[1].innerText.trim() : 'Untitled';
        const status = row.cells[3] ? row.cells[3].innerText.trim() : '';
        const dueDate = row.cells[6] ? row.cells[6].innerText.trim() : '';
        const iconClass = getFileIconClass(fileName);

        const item = document.createElement('div');
        item.className = 'file-grid-item';
        item.addEventListener('click', function(e) {
            openFileMenu(e, fileName);
        });
        item.addEventListener('contextmenu', function(e) {
            openFileMenu(e, fileName);
        });
        item.innerHTML = `
            <div class="file-icon"><i class="fas ${iconClass}"></i></div>
            <div class="file-name">${escapeHtml(fileName)}</div>
            <div class="file-meta">
                <span>${escapeHtml(id)}</span>
                <span>${escapeHtml(status)}</span>
                <span>${escapeHtml(dueDate)}</span>
            </div>
        `;

        fileGrid.appendChild(item);
    });
}

function switchView(viewType) {
    const listWrapper = document.getElementById('projectWrapper');
    const gridWrapper = document.getElementById('gridWrapper');
    const btnList = document.getElementById('btnList');
    const btnGrid = document.getElementById('btnGrid');

    if (viewType === 'grid') {
        syncGridFromList();
        listWrapper.style.display = 'none';
        gridWrapper.style.display = 'block';
        btnGrid.style.background = '#eee';
        btnList.style.background = '#fff';
        btnGrid.classList.add('active');
        btnList.classList.remove('active');
    } else {
        listWrapper.style.display = 'block';
        gridWrapper.style.display = 'none';
        btnList.style.background = '#eee';
        btnGrid.style.background = '#fff';
        btnList.classList.add('active');
        btnGrid.classList.remove('active');
    }
}
</script>
<script src="{{ asset('js/assign-roles-stack.js') }}"></script>
</body>
</html>
