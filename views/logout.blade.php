<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logging out...</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <div class="logout-wrapper">
    <div class="logout-card">
        <div class="avatar-circle">IZ</div>
        
        <h2 class="logout-title">Logging Out...</h2>
        <p class="logout-message">You have been successfully signed out. Returning to login screen in <span id="timer">3</span> seconds.</p>

        <div class="loader-bar">
            <div class="loader-progress"></div>
        </div>
        
        <a href="/" class="manual-link">Click here if you are not redirected</a>
    </div>
</div>

<script>
    let timeLeft = 0;
    const timerElement = document.getElementById('timer');

    const countdown = setInterval(() => {
        timeLeft--;
        timerElement.innerText = timeLeft;
        if (timeLeft <= 0) {
            clearInterval(countdown);
            window.location.href = '/'; // Hantar ke page login
        }
    }, 1000);
</script>
</body>
</html>