<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - My Account</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<style>
    /* Avatar wrapper */
.avatar-wrapper {
    position: relative;
    width: 90px;
    height: 90px;
    cursor: pointer;
    border-radius: 50%;
    flex-shrink: 0;
}

.avatar-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.4);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.2s;
    color: #fff;
    font-size: 18px;
}

.avatar-wrapper:hover .avatar-overlay {
    opacity: 1;
}

#avatarDisplay {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    object-fit: cover;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Inline edit (name/title above form) */
.inline-edit-group {
    display: flex;
    align-items: center;
    gap: 8px;
}

.inline-edit-group.hidden {
    display: none;
}

.inline-text-input {
    border: 1.5px solid #3498db;
    border-radius: 6px;
    padding: 4px 10px;
    font-size: 16px;
    font-weight: 700;
    color: #2d3748;
    outline: none;
    font-family: inherit;
}

.inline-text-input.small {
    font-size: 13px;
    font-weight: 400;
    color: #718096;
}

.inline-edit-btn {
    background: none;
    border: none;
    color: #a0aec0;
    cursor: pointer;
    font-size: 12px;
    padding: 4px;
    border-radius: 4px;
    transition: color 0.15s;
}

.inline-edit-btn:hover { 
    color: #3498db; 
}

.inline-edit-btn.small { 
    font-size: 11px; 
}

.inline-save-btn,
.inline-cancel-btn {
    width: 26px;
    height: 26px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    font-size: 11px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.15s;
}

.inline-save-btn   { 
    background: #3498db; 
    color: #fff; 
}

.inline-cancel-btn { 
    background: #edf2f7; 
    color: #718096; 
}

.inline-save-btn:hover   { 
    background: #2980b9; 
}

.inline-cancel-btn:hover { 
    background: #e2e8f0; 
}

/* Field-level edit */
.input-edit-wrapper {
    position: relative;
    display: flex;
    align-items: center;
}

.input-edit-wrapper input {
    width: 100%;
    padding: 10px 40px 10px 12px;
    border: 1px solid #eee;
    border-radius: 6px;
    font-size: 13px;
    background: #fdfdfd;
    color: #2d3748;
    transition: border-color 0.2s, background 0.2s;
    box-sizing: border-box;
}

.input-edit-wrapper input:not([disabled]) {
    border-color: #3498db;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(52,152,219,0.1);
}

.input-edit-wrapper input:disabled {
    color: #4a5568;
    cursor: default;
}

.field-edit-btn {
    position: absolute;
    right: 10px;
    background: none;
    border: none;
    color: #cbd5e0;
    cursor: pointer;
    font-size: 12px;
    padding: 4px;
    transition: color 0.15s;
}

.field-edit-btn:hover { color: #3498db; }

.field-edit-btn.active {
    color: #3498db;
}

/* Discard + Save buttons */
.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 30px;
}

.discard-btn {
    background: #fff;
    color: #718096;
    border: 1px solid #e2e8f0;
    padding: 10px 24px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.15s;
}

.discard-btn:hover { 
    background: #f7fafc; 
}

/* Toast notification */
.save-toast {
    display: none;
    position: fixed;
    bottom: 30px;
    right: 30px;
    background: #2ecc71;
    color: #fff;
    padding: 12px 20px;
    border-radius: 10px;
    font-size: 13px;
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(46,204,113,0.3);
    gap: 8px;
    align-items: center;
    z-index: 9999;
    animation: slideUp 0.3s ease;
}

@keyframes slideUp {
    from { 
        transform: translateY(20px); 
        opacity: 0; 
    }
    to   { 
        transform: translateY(0);   
        opacity: 1; 
    }
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
                <a href="{{ route('users.index')}}" class="nav-item {{ request()->is('users*') ? 'active' : '' }}"><i class="fas fa-users"></i>Users</a>
                <a href="{{route('settings.index') }}" class="nav-item {{ request()->is('settings*') ? 'active' : '' }}"><i class="fas fa-cog"></i>Settings</a>
            </nav>
            <a href="{{ route('logout') }}" class="logout">Log Out</a>
        </aside>

        <main class="main-container">
            <header class="top-header">
                <div class="header-left"><h1>My Account</h1></div>
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

            <div class="settings-flex-row">
            <nav class="settings-sub-nav">
                <a href="{{ route('settings.index') }}" class="sub-nav-item active">My Profile</a>
                <a href="{{ route('security.index') }}" class="sub-nav-item">Security</a>
                <a href="{{ route('password.index') }}" class="sub-nav-item">Password</a>
                <a href="{{ route('deleteaccount.index') }}" class="sub-nav-item">Account</a>    
            </nav>

            <section class="profile-form-section">

                @if(session('success'))
    <div id="saveToast" class="save-toast" style="display:flex;">
        <i class="fas fa-check-circle"></i> {{ session('success') }}
    </div>
    <script>
        setTimeout(() => {
            document.getElementById('saveToast').style.display = 'none';
        }, 3000);
    </script>
    @endif

    <h2 class="section-heading">My Profile</h2>

    {{-- Profile Card Top --}}
    <div class="profile-card-top">

        {{-- Avatar with edit overlay --}}
        <div class="avatar-wrapper" onclick="document.getElementById('avatarFormInput').click()" title="Change photo">
            <div class="large-avatar" id="avatarDisplay">
                @if(Auth::user()->avatar)
                    <img src="{{ asset('storage/' . Auth::user()->avatar) }}"
                    style="width:90px;height:90px;border-radius:50%;object-fit:cover;display:block;">
                @else
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                @endif
            </div>
            <div class="avatar-overlay">
                <i class="fas fa-camera"></i>
            </div>
        </div>

        <div class="user-meta">
            {{-- Editable name inline --}}
            <div class="inline-edit-group" id="nameDisplay">
                <h3 id="nameText">{{ Auth::user()->name }}</h3>
                <button class="inline-edit-btn" onclick="toggleInlineEdit('name')">
                    <i class="fas fa-pencil-alt"></i>
                </button>
            </div>
            <div class="inline-edit-group hidden" id="nameEdit">
                <input type="text" id="nameInput" class="inline-text-input" value="{{ Auth::user()->name }}">
                <button class="inline-save-btn" onclick="saveInlineEdit('name')">
                    <i class="fas fa-check"></i>
                </button>
                <button class="inline-cancel-btn" onclick="cancelInlineEdit('name')">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            {{-- Editable title inline --}}
            <div class="inline-edit-group" id="titleDisplay">
                <p id="titleText">{{ Auth::user()->title ?? 'Add your title' }}</p>
                <button class="inline-edit-btn small" onclick="toggleInlineEdit('title')">
                    <i class="fas fa-pencil-alt"></i>
                </button>
            </div>
            <div class="inline-edit-group hidden" id="titleEdit">
                <input type="text" id="titleInput" class="inline-text-input small" value="{{ Auth::user()->title ?? '' }}">
                <button class="inline-save-btn" onclick="saveInlineEdit('title')">
                    <i class="fas fa-check"></i>
                </button>
                <button class="inline-cancel-btn" onclick="cancelInlineEdit('title')">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Form Fields --}}
    <form class="profile-grid-form" id="profileForm" action="{{ route('settings.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="file" id="avatarFormInput" name="avatar" hidden accept="image/*" onchange="previewAvatar(this)">
        <div class="form-row">
            <div class="form-group">
                <label>Full Name</label>
                <div class="input-edit-wrapper">
                    <input type="text" id="fullNameField" name="name" value="{{ Auth::user()->name }}" disabled>
                    <button type="button" class="field-edit-btn" onclick="toggleField('fullNameField', this)">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                </div>
            </div>
            <div class="form-group">
                <label>Title</label>
                <div class="input-edit-wrapper">
                    <input type="text" id="titleField" name="title" value="{{ Auth::user()->title ?? ''}}" disabled>
                    <button type="button" class="field-edit-btn" onclick="toggleField('titleField', this)">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="form-row">
            <div class="form-group">
                <label>Email</label>
                <div class="input-edit-wrapper">
                    <input type="email" id="emailField" name="email" value="{{ Auth::user()->email }}" disabled>
                    <button type="button" class="field-edit-btn" onclick="toggleField('emailField', this)">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                </div>
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <div class="input-edit-wrapper">
                    <input type="text" id="phoneField" name="phone" value="{{ Auth::user()->phone }}" disabled>
                    <button type="button" class="field-edit-btn" onclick="toggleField('phoneField', this)">
                        <i class="fas fa-pencil-alt"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="form-actions">
            <button type="button" class="discard-btn" onclick="discardChanges()">Discard</button>
            <button type="submit" class="save-btn" onclick="saveProfile(event)">Save Changes</button>
        </div>
    </form>

    {{-- Success toast --}}
    <div id="saveToast" class="save-toast">
        <i class="fas fa-check-circle"></i> Profile updated successfully!
    </div>

</section>
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
</body>
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
    // ── Avatar Preview ──────────────────────────────────────
    function previewAvatar(input) {
        const file = input.files[0];
        if (!file) return;
        
        const reader = new FileReader();
        reader.onload = function(e) {
            const avatar = document.getElementById('avatarDisplay');
            avatar.innerHTML = '';
            avatar.style.background = 'none';
            avatar.style.padding = '0';
            const img = document.createElement('img');
            img.src = e.target.result;
            img.style.cssText = 'width:90px;height:90px;border-radius:50%;object-fit:cover;display:block;';
            avatar.appendChild(img);
        };
        reader.readAsDataURL(file);
    }

    // ── Inline Edit (Name & Title in avatar area) ───────────
    function toggleInlineEdit(type) {
        document.getElementById(type + 'Display').classList.add('hidden');
        document.getElementById(type + 'Edit').classList.remove('hidden');
        document.getElementById(type + 'Input').focus();
        document.getElementById(type + 'Input').select();
    }

    function saveInlineEdit(type) {
        const val = document.getElementById(type + 'Input').value.trim();
        if (val) document.getElementById(type + 'Text').textContent = val;
        document.getElementById(type + 'Display').classList.remove('hidden');
        document.getElementById(type + 'Edit').classList.add('hidden');

        // Sync with form fields
        if (type === 'name') {
            document.getElementById('fullNameField').value = val;
        }
        if (type === 'title') {
            document.getElementById('titleField').value = val;
        }
    }

    function cancelInlineEdit(type) {
        document.getElementById(type + 'Display').classList.remove('hidden');
        document.getElementById(type + 'Edit').classList.add('hidden');
    }

    // Allow Enter key to save inline edit
    document.addEventListener('DOMContentLoaded', function () {
        ['name', 'title'].forEach(type => {
            const input = document.getElementById(type + 'Input');
            if (input) {
                input.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') saveInlineEdit(type);
                    if (e.key === 'Escape') cancelInlineEdit(type);
                });
            }
        });
    });

    // ── Field-level Edit ────────────────────────────────────
    function toggleField(fieldId, btn) {
        const input = document.getElementById(fieldId);
        const isDisabled = input.disabled;

        if (isDisabled) {
            // Enable for editing
            input.disabled = false;
            input.focus();
            input.select();
            btn.innerHTML = '<i class="fas fa-check" style="color:#3498db;"></i>';
            btn.setAttribute('onclick', `saveField('${fieldId}', this)`);
            input.closest('.input-edit-wrapper').classList.add('editing');
        }
    }

    function saveField(fieldId, btn) {
        const input = document.getElementById(fieldId);
        input.disabled = true;
        btn.innerHTML = '<i class="fas fa-pencil-alt"></i>';
        btn.setAttribute('onclick', `toggleField('${fieldId}', this)`);
        input.closest('.input-edit-wrapper').classList.remove('editing');

        // Sync name/title back to avatar area
        if (fieldId === 'fullNameField') {
            document.getElementById('nameText').textContent = input.value;
            document.getElementById('nameInput').value = input.value;
        }
        if (fieldId === 'titleField') {
            document.getElementById('titleText').textContent = input.value;
            document.getElementById('titleInput').value = input.value;
        }
    }

    // Allow Enter to save field
    document.addEventListener('DOMContentLoaded', function () {
        ['fullNameField','titleField','emailField','phoneField'].forEach(id => {
            const el = document.getElementById(id);
            if (el) {
                el.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter') {
                        const btn = this.closest('.input-edit-wrapper').querySelector('button');
                        if (btn) btn.click();
                    }
                    if (e.key === 'Escape') {
                        this.disabled = true;
                        const btn = this.closest('.input-edit-wrapper').querySelector('button');
                        if (btn) {
                            btn.innerHTML = '<i class="fas fa-pencil-alt"></i>';
                            btn.setAttribute('onclick', `toggleField('${id}', this)`);
                        }
                        this.closest('.input-edit-wrapper').classList.remove('editing');
                    }
                });
            }
        });
    });

    // ── Discard ─────────────────────────────────────────────
    function discardChanges() {
        ['fullNameField','titleField','emailField','phoneField'].forEach(id => {
            const input = document.getElementById(id);
            if (input) {
                input.disabled = true;
                input.value = input.defaultValue;
                const btn = input.closest('.input-edit-wrapper').querySelector('button');
                if (btn) {
                    btn.innerHTML = '<i class="fas fa-pencil-alt"></i>';
                    btn.setAttribute('onclick', `toggleField('${id}', this)`);
                }
                input.closest('.input-edit-wrapper').classList.remove('editing');
            }
        });

        // Reset inline edits
        ['name','title'].forEach(type => {
            const displayEl = document.getElementById(type + 'Display');
            const editEl = document.getElementById(type + 'Edit');
            if (displayEl) displayEl.classList.remove('hidden');
            if (editEl) editEl.classList.add('hidden');
        });
    }

    // ── Save & Toast ─────────────────────────────────────────
    function saveProfile(e) {
        e.preventDefault();

        // Save any open fields first
        ['fullNameField','titleField','emailField','phoneField'].forEach(id => {
            const input = document.getElementById(id);
            if (input && !input.disabled) {
                const btn = input.closest('.input-edit-wrapper').querySelector('button');
                if (btn) btn.click();
            }
        });

        // Submit the form
        document.getElementById('profileForm').submit();
    }

    // ── Create Project Modal ─────────────────────────────────
    function openCreateModal() {
        document.getElementById('createProjectModal').style.display = 'flex';
    }

    function closeCreateModal() {
        document.getElementById('createProjectModal').style.display = 'none';
    }

    window.addEventListener('click', function(event) {
        const modal = document.getElementById('createProjectModal');
        if (event.target === modal) modal.style.display = 'none';
    });

    function updateDateDisplay(input) {
        if (input.value) {
            const [year, month, day] = input.value.split('-');
            document.getElementById('date-display').textContent = `${day}/${month}/${year}`;
        }
    }
</script>
<script src="{{ asset('js/assign-roles-stack.js') }}"></script>
</html>
