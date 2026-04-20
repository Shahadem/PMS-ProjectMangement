<div class="p-register-container" style="max-width: 480px; margin: 60px auto; text-align: center; padding: 20px; font-family: 'Inter', -apple-system, sans-serif;">
    
    <div style="width: 72px; height: 72px; background: #EBF8FF; color: #3182CE; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px; font-size: 30px;">
        <i class="fas fa-user-plus"></i>
    </div>

    <h2 style="font-size: 28px; font-weight: 800; color: #1A202C; margin-bottom: 8px; letter-spacing: -0.5px;">Create Account</h2>
    <p style="color: #718096; font-size: 15px; margin-bottom: 32px;">Join us to manage your task projects.</p>

    <div style="text-align: left; background: #FFFFFF; border: 1px solid #E2E8F0; border-radius: 16px; padding: 32px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.04); margin-bottom: 24px;">
        @if ($errors->any())
            <div style="margin-bottom: 20px; padding: 12px; border-radius: 10px; background: #FFF5F5; color: #C53030; font-size: 14px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('register.index') }}" method="POST">
            @csrf
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 14px; font-weight: 700; color: #2D3748; margin-bottom: 8px;">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="John Doe" autocomplete="name" style="width: 100%; padding: 12px 16px; border: 1.5px solid #E2E8F0; border-radius: 10px; font-size: 15px; outline: none; transition: all 0.2s; box-sizing: border-box;" onfocus="this.style.borderColor='#3182CE'; this.style.boxShadow='0 0 0 3px rgba(49, 130, 206, 0.1)';" onblur="this.style.borderColor='#E2E8F0'; this.style.boxShadow='none';" required>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-size: 14px; font-weight: 700; color: #2D3748; margin-bottom: 8px;">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="name@example.com" autocomplete="email" style="width: 100%; padding: 12px 16px; border: 1.5px solid #E2E8F0; border-radius: 10px; font-size: 15px; outline: none; transition: all 0.2s; box-sizing: border-box;" onfocus="this.style.borderColor='#3182CE'; this.style.boxShadow='0 0 0 3px rgba(49, 130, 206, 0.1)';" onblur="this.style.borderColor='#E2E8F0';" required>
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; font-size: 14px; font-weight: 700; color: #2D3748; margin-bottom: 8px;">Password</label>
                <input type="password" placeholder="••••••••" style="width: 100%; padding: 12px 16px; border: 1.5px solid #E2E8F0; border-radius: 10px; font-size: 15px; outline: none; transition: all 0.2s; box-sizing: border-box;" onfocus="this.style.borderColor='#3182CE'; this.style.boxShadow='0 0 0 3px rgba(49, 130, 206, 0.1)';" onblur="this.style.borderColor='#E2E8F0';">
                <p style="font-size: 12px; color: #718096; margin-top: 6px;">Must be at least 8 characters long.</p>
            </div>

            <input type="hidden" name="password" id="register-password-hidden">

            <button type="submit" style="width: 100%; padding: 14px; background: #3182CE; color: #FFFFFF; border: none; border-radius: 12px; font-weight: 700; font-size: 16px; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 14px rgba(49, 130, 206, 0.3);" onmouseover="this.style.background='#2B6CB0'; this.style.transform='translateY(-1px)';" onmouseout="this.style.background='#3182CE'; this.style.transform='translateY(0)';" >
                Create Account
            </button>
        </form>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const registerForm = document.querySelector('.p-register-container form');
                const visiblePasswordInput = registerForm?.querySelector('input[type="password"]');
                const hiddenPasswordInput = document.getElementById('register-password-hidden');

                if (! registerForm || ! visiblePasswordInput || ! hiddenPasswordInput) {
                    return;
                }

                const syncPassword = function () {
                    hiddenPasswordInput.value = visiblePasswordInput.value;
                };

                visiblePasswordInput.addEventListener('input', syncPassword);
                registerForm.addEventListener('submit', syncPassword);
            });
        </script>
    </div>

    <p style="color: #718096; font-size: 14px;">
        Already have an account? 
        <a href="{{ route('login') }}" style="color: #3182CE; font-weight: 700; text-decoration: none; margin-left: 4px;" onmouseover="this.style.textDecoration='underline';" onmouseout="this.style.textDecoration='none';">Log In</a>
    </p>
</div>