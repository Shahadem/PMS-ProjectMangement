(function() {
    var stackSelector = '.avatar-stack.assignee-trigger, .avatar-group.assignee-trigger, .p-role-stack';
    var roleOptions = Array.isArray(window.ASSIGN_ROLE_OPTIONS) && window.ASSIGN_ROLE_OPTIONS.length
        ? window.ASSIGN_ROLE_OPTIONS
        : ['Admin'];

    var stackState = new WeakMap();
    var activeStack = null;

    function getInitials(name) {
        if (!name) return 'U';
        return name
            .split(' ')
            .filter(Boolean)
            .slice(0, 2)
            .map(function(part) { return part[0].toUpperCase(); })
            .join('');
    }

    function nameFromEmail(email) {
        var local = (email.split('@')[0] || 'User')
            .replace(/[._-]+/g, ' ')
            .replace(/\s+/g, ' ')
            .trim();

        return local.replace(/\b\w/g, function(c) { return c.toUpperCase(); });
    }

    function colorFromString(value) {
        var colors = ['#8ea9db', '#b6c6e3', '#e6c8c8', '#3f557f', '#e6d3c5', '#93b7e3', '#7d9ac8'];
        var hash = 0;
        for (var i = 0; i < value.length; i++) {
            hash = value.charCodeAt(i) + ((hash << 5) - hash);
        }
        return colors[Math.abs(hash) % colors.length];
    }

    function ensureStyles() {
        if (document.getElementById('assign-roles-stack-style')) return;

        var style = document.createElement('style');
        style.id = 'assign-roles-stack-style';
        style.textContent = [
            '.assignee-trigger,.p-role-stack{cursor:pointer}',
            '.global-assign-modal-overlay{display:none;position:fixed;inset:0;background:rgba(20,28,40,.45);z-index:12000;align-items:center;justify-content:center;padding:20px}',
            '.global-assign-modal{width:min(820px,96vw);max-height:92vh;background:#fff;border-radius:16px;overflow:hidden;box-shadow:0 16px 46px rgba(10,25,47,.22);display:flex;flex-direction:column}',
            '.global-assign-modal-header{display:flex;align-items:center;justify-content:space-between;padding:18px 22px;border-bottom:1px solid #e8edf3}',
            '.global-assign-modal-header h3{margin:0;font-size:15px;color:#1f2937}',
            '.global-assign-close-btn{border:none;background:transparent;font-size:22px;color:#4b5563;cursor:pointer;line-height:1}',
            '.global-assign-modal-body{padding:18px 22px 14px;overflow:auto}',
            '.global-assign-add-row{display:flex;gap:10px;margin-bottom:16px}',
            '.global-assign-add-row input{flex:1;border:1px solid #d1d5db;border-radius:6px;padding:10px 12px;font-size:13px}',
            '.global-assign-add-row button,.global-assign-btn-done{border:none;background:#3498db;color:#fff;border-radius:8px;padding:10px 20px;font-weight:600;cursor:pointer}',
            '.global-assign-users-title{font-size:12px;color:#6b7280;margin-bottom:10px;font-weight:600}',
            '.global-assign-users-list{display:flex;flex-direction:column;gap:10px}',
            '.global-assign-user-item{display:grid;grid-template-columns:auto 1fr auto;align-items:center;gap:12px;border:1px solid #eef2f7;border-radius:10px;padding:10px 12px;background:#fff}',
            '.global-assign-user-avatar{width:40px;height:40px;border-radius:50%;display:flex;align-items:center;justify-content:center;color:#fff;font-size:12px;font-weight:700}',
            '.global-assign-user-meta strong{font-size:13px;color:#1f2937;display:block;margin-bottom:2px}',
            '.global-assign-user-meta span{color:#9ca3af;font-size:12px}',
            '.global-assign-role-select{border:none;background:transparent;color:#6b7280;font-weight:700;font-size:13px;cursor:pointer;outline:none;text-align:right}',
            '.global-assign-modal-footer{border-top:1px solid #e8edf3;padding:14px 22px;display:flex;justify-content:flex-end;gap:10px}',
            '.global-assign-btn-cancel{border:1px solid #d1d5db;background:#fff;color:#6b7280;border-radius:8px;padding:10px 20px;font-weight:600;cursor:pointer}',
            '.p-role-stack .p-circle-add{pointer-events:none}',
            '.priority-box{display:flex;align-items:center;justify-content:center;gap:8px;padding:10px;border:1px solid #e2e8f0;border-radius:10px;font-size:13px;font-weight:600;color:#718096;background:#fff}',
            '.priority-option input:checked+.priority-box{border-color:#3182ce;background:#ebf8ff;color:#3182ce}',
            '.p-dot{width:8px;height:8px;border-radius:50%;display:inline-block}',
            '.p-dot-low{background:#48bb78}',
            '.p-dot-medium{background:#ecc94b}',
            '.p-dot-high{background:#e53e3e}'
        ].join('');
        document.head.appendChild(style);
    }

    function ensureModal() {
        if (document.getElementById('globalAssignRolesModal')) return;

        var modal = document.createElement('div');
        modal.id = 'globalAssignRolesModal';
        modal.className = 'global-assign-modal-overlay';
        modal.innerHTML =
            '<div class="global-assign-modal">' +
                '<div class="global-assign-modal-header">' +
                    '<h3>Assign Roles</h3>' +
                    '<button type="button" class="global-assign-close-btn" id="globalAssignCloseBtn">&times;</button>' +
                '</div>' +
                '<div class="global-assign-modal-body">' +
                    '<div class="global-assign-add-row">' +
                        '<input type="email" id="globalAssignUserEmailInput" placeholder="Add user / e-mail">' +
                        '<button type="button" id="globalAssignAddBtn">Add Users</button>' +
                    '</div>' +
                    '<div class="global-assign-users-title">These users have access</div>' +
                    '<div class="global-assign-users-list" id="globalAssignUsersList"></div>' +
                    '<div id="globalAssignFileInfo" style="display:none;margin-top:20px;">' +
                        '<label style="display:block;font-size:13px;font-weight:600;color:#4a5568;margin-bottom:10px;">' +
                            '<i style="margin-right:8px;color:#a0aec0;">These users are set for approval and will be requested to approve "<span style="color:#60B2FF;font-weight:700;"></span>"</i>' +
                        '</label>' +
                    '</div>' +
                    '<div id="globalAssignPrioritySection" style="display:none;margin-top:20px;padding-top:15px;border-top:1px solid #f7fafc;">' +
                        '<label style="display:block;font-size:13px;font-weight:600;color:#4a5568;margin-bottom:12px;">' +
                            '<i class="fas fa-flag" style="margin-right:8px;color:#a0aec0;"></i> Priority' +
                        '</label>' +
                        '<div style="display:flex;gap:12px;justify-content:space-between;">' +
                            '<label class="priority-option" style="flex:1;cursor:pointer;"><input type="radio" name="globalPriority" value="Low" hidden><div class="priority-box"><span class="p-dot p-dot-low"></span> Low</div></label>' +
                            '<label class="priority-option" style="flex:1;cursor:pointer;"><input type="radio" name="globalPriority" value="Medium" hidden><div class="priority-box"><span class="p-dot p-dot-medium"></span> Medium</div></label>' +
                            '<label class="priority-option" style="flex:1;cursor:pointer;"><input type="radio" name="globalPriority" value="High" hidden><div class="priority-box"><span class="p-dot p-dot-high"></span> High</div></label>' +
                        '</div>' +
                    '</div>' +
                '</div>' +
                '<div class="global-assign-modal-footer">' +
                    '<button type="button" class="global-assign-btn-cancel" id="globalAssignCancelBtn">Cancel</button>' +
                    '<button type="button" class="global-assign-btn-done" id="globalAssignDoneBtn">Done</button>' +
                '</div>' +
            '</div>';

        document.body.appendChild(modal);
        document.getElementById('globalAssignCloseBtn').addEventListener('click', function() { closeModal(); });
        document.getElementById('globalAssignCancelBtn').addEventListener('click', function() { closeModal(); });
        document.getElementById('globalAssignDoneBtn').addEventListener('click', function() {
            var prioritySection = document.getElementById('globalAssignPrioritySection');
            if (prioritySection && prioritySection.style.display === 'block') {
                var selected = document.querySelector('input[name="globalPriority"]:checked');
                if (!selected) {
                    alert("Sila pilih priority!");
                    return;
                }
                alert("Berjaya dihantar!");
            }
            closeModal();
        });
        document.getElementById('globalAssignAddBtn').addEventListener('click', addUserToActiveStack);

        var emailInput = document.getElementById('globalAssignUserEmailInput');
        emailInput.addEventListener('keydown', function(event) {
            if (event.key === 'Enter') {
                event.preventDefault();
                addUserToActiveStack();
            }
        });

        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                closeModal();
            }
        });
    }

    function initStackData(stackElement) {
        if (stackState.has(stackElement)) return stackState.get(stackElement);

        var users = [
            { name: 'Iskandar Zulkarnain', email: 'iskandarw@companyemail.com', role: roleOptions[0] || 'Admin', color: '#8ea9db' },
            { name: 'Project Reviewer', email: 'reviewer@companyemail.com', role: roleOptions[0] || 'Admin', color: '#b6c6e3' },
            { name: 'Approver Team', email: 'approver@companyemail.com', role: roleOptions[0] || 'Admin', color: '#e6c8c8' }
        ];

        stackState.set(stackElement, users);
        renderStack(stackElement);
        return users;
    }

    function renderStack(stackElement) {
        var users = stackState.get(stackElement) || [];
        var visibleUsers = users.slice(0, 2);
        var remaining = Math.max(0, users.length - visibleUsers.length);
        var isPRoleStack = stackElement.classList.contains('p-role-stack');

        stackElement.innerHTML = '';

        visibleUsers.forEach(function(user) {
            if (isPRoleStack) {
                var span = document.createElement('span');
                span.className = 'p-circle';
                span.style.background = user.color;
                span.style.color = '#fff';
                span.style.display = 'inline-flex';
                span.style.alignItems = 'center';
                span.style.justifyContent = 'center';
                span.style.fontSize = '10px';
                span.style.fontWeight = '700';
                span.textContent = getInitials(user.name);
                stackElement.appendChild(span);
            } else {
                var avatar = document.createElement('div');
                avatar.style.background = user.color;
                avatar.style.display = 'flex';
                avatar.style.alignItems = 'center';
                avatar.style.justifyContent = 'center';
                avatar.style.color = '#fff';
                avatar.style.fontSize = '10px';
                avatar.style.fontWeight = '700';
                avatar.textContent = getInitials(user.name);
                stackElement.appendChild(avatar);
            }
        });

        if (remaining > 0) {
            if (isPRoleStack) {
                var count = document.createElement('span');
                count.className = 'role-circle-iz new-count-style';
                count.textContent = '+' + remaining;
                stackElement.appendChild(count);

                var addCircle = document.createElement('div');
                addCircle.className = 'p-circle-add';
                addCircle.innerHTML = '<i class="fas fa-plus"></i>';
                stackElement.appendChild(addCircle);
            } else {
                var more = document.createElement('div');
                more.className = 'more';
                more.textContent = '+' + remaining;
                stackElement.appendChild(more);
            }
        }
    }

    function renderUserList() {
        var list = document.getElementById('globalAssignUsersList');
        if (!list || !activeStack) return;

        var users = stackState.get(activeStack) || [];
        list.innerHTML = '';

        users.forEach(function(user, index) {
            var item = document.createElement('div');
            item.className = 'global-assign-user-item';

            var options = roleOptions.map(function(role) {
                var selected = role === user.role ? ' selected' : '';
                return '<option value="' + role + '"' + selected + '>' + role + '</option>';
            }).join('');

            item.innerHTML =
                '<div class="global-assign-user-avatar" style="background:' + user.color + ';">' + getInitials(user.name) + '</div>' +
                '<div class="global-assign-user-meta"><strong>' + user.name + '</strong><span>' + user.email + '</span></div>' +
                '<div><select class="global-assign-role-select" data-role-index="' + index + '">' + options + '</select></div>';

            list.appendChild(item);
        });

        list.querySelectorAll('.global-assign-role-select').forEach(function(selectNode) {
            selectNode.addEventListener('change', function() {
                var idx = parseInt(this.getAttribute('data-role-index'), 10);
                var currentUsers = stackState.get(activeStack) || [];
                if (currentUsers[idx]) {
                    currentUsers[idx].role = this.value;
                }
            });
        });
    }

    function openModalForStack(stackElement) {
        activeStack = stackElement;
        initStackData(stackElement);
        renderUserList();

        var modal = document.getElementById('globalAssignRolesModal');
        var input = document.getElementById('globalAssignUserEmailInput');
        if (modal) modal.style.display = 'flex';
        if (input) {
            input.value = '';
            input.focus();
        }
    }

    function closeModal() {
        var modal = document.getElementById('globalAssignRolesModal');
        if (modal) modal.style.display = 'none';
        
        // Reset modal to default Assign Roles state
        var headerTitle = modal.querySelector('.global-assign-modal-header h3');
        var fileInfo = document.getElementById('globalAssignFileInfo');
        var priority = document.getElementById('globalAssignPrioritySection');
        var doneBtn = document.getElementById('globalAssignDoneBtn');

        if (headerTitle) headerTitle.textContent = 'Assign Roles';
        if (fileInfo) fileInfo.style.display = 'none';
        if (priority) priority.style.display = 'none';
        if (doneBtn) doneBtn.textContent = 'Done';
        
        document.querySelectorAll('input[name="globalPriority"]').forEach(function(r) { r.checked = false; });
        
        activeStack = null;
    }

    window.triggerApprovalModal = function(stackElement, fileName) {
        activeStack = stackElement;
        initStackData(stackElement);
        renderUserList();

        var modal = document.getElementById('globalAssignRolesModal');
        var headerTitle = modal.querySelector('.global-assign-modal-header h3');
        var fileInfo = document.getElementById('globalAssignFileInfo');
        var priority = document.getElementById('globalAssignPrioritySection');
        var doneBtn = document.getElementById('globalAssignDoneBtn');

        if (headerTitle) headerTitle.textContent = 'Submit for Approval';
        if (fileInfo) {
            fileInfo.style.display = 'block';
            fileInfo.querySelector('span').textContent = fileName;
        }
        if (priority) priority.style.display = 'block';
        if (doneBtn) doneBtn.textContent = 'Submit for Approval';

        modal.style.display = 'flex';
    };

    function addUserToActiveStack() {
        if (!activeStack) return;
        var input = document.getElementById('globalAssignUserEmailInput');
        if (!input) return;

        var email = input.value.trim().toLowerCase();
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            input.focus();
            return;
        }

        var users = stackState.get(activeStack) || [];
        var exists = users.some(function(user) { return user.email.toLowerCase() === email; });
        if (exists) {
            input.value = '';
            return;
        }

        users.push({
            name: nameFromEmail(email),
            email: email,
            role: roleOptions[0] || 'Admin',
            color: colorFromString(email)
        });

        stackState.set(activeStack, users);
        renderUserList();
        renderStack(activeStack);
        input.value = '';
        input.focus();
    }

    function init() {
        ensureStyles();
        ensureModal();

        document.querySelectorAll(stackSelector).forEach(function(stack) {
            initStackData(stack);
            stack.addEventListener('click', function(event) {
                event.stopPropagation();
                openModalForStack(stack);
            });
        });

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                closeModal();
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
