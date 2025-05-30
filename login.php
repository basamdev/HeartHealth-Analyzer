<?php
session_start();

// --- Database connection (adjust credentials as needed) ---
$host = "localhost";
$dbname = "heartcare_connect";
$username = "root";
$password =""; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // set error mode
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}


// --- Handle form submission ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user by username
    $stmt = $conn->prepare("SELECT id, username, password_hash FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['logged_in'] = true;
        $_SESSION['username']  = $user['username'];
        $_SESSION['user_id']   = $user['id'];
        $_SESSION['user_profile'] = $user['user_profile'] ?? null; // Assuming you have a profile picture field
        header("Location: dashboard.php");
        exit;
    } else {
        $error_message = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Login to access heart disease support groups">
    <title>Login | HeartCare Connect</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #ff4757;
            --primary-hover: #ff6b81;
            --primary-dark: #d63031;
            --primary-light: #ffe0e3;
            --secondary-color: #2e86de;
            --secondary-hover: #54a0ff;
            --secondary-dark: #0984e3;
            --text-color: #2d3436;
            --text-muted: #636e72;
            --light-text: #f5f6fa;
            --light-bg: #f9fafb;
            --border-color: #dfe6e9;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            --box-shadow-hover: 0 15px 40px rgba(0, 0, 0, 0.12);
            --card-bg: rgba(255, 255, 255, 0.98);
            --transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            --border-radius: 16px;
            --input-radius: 12px;
            --gradient: linear-gradient(135deg, #ff4757 0%, #ff6b81 100%);
            --gradient-hover: linear-gradient(135deg, #ff6b81 0%, #ff4757 100%);
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--text-color);
            line-height: 1.6;
            background-color: #f5f7fa;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='28' height='49' viewBox='0 0 28 49'%3E%3Cg fill-rule='evenodd'%3E%3Cg id='hexagons' fill='%23ff4757' fill-opacity='0.05' fill-rule='nonzero'%3E%3Cpath d='M13.99 9.25l13 7.5v15l-13 7.5L1 31.75v-15l12.99-7.5zM3 17.9v12.7l10.99 6.34 11-6.35V17.9l-11-6.34L3 17.9zM0 15l12.98-7.5V0h-2v6.35L0 12.69v2.3zm0 18.5L12.98 41v8h-2v-6.85L0 35.81v-2.3zM15 0v7.5L27.99 15H28v-2.31h-.01L17 6.35V0h-2zm0 49v-8l12.99-7.5H28v2.31h-.01L17 42.15V49h-2z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            overflow-x: hidden;
        }
        
        .container {
            width: 100%;
            max-width: 1300px;
            margin: 0 auto;
            padding: 0 24px;
        }
        
        .header {
            background-color: rgba(255, 255, 255, 0.98);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 100;
            padding: 15px 0;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px 0;
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            transition: var(--transition);
        }
        
        .logo:hover {
            transform: translateY(-3px);
            color: var(--primary-hover);
            text-shadow: 0 5px 15px rgba(255, 71, 87, 0.2);
        }
        
        .logo i {
            animation: heartbeat 2s infinite;
            font-size: 2rem;
            color: var(--primary-color);
            filter: drop-shadow(0 3px 6px rgba(255, 71, 87, 0.3));
        }
        
        @keyframes heartbeat {
            0% { transform: scale(1); }
            14% { transform: scale(1.18); }
            28% { transform: scale(1); }
            42% { transform: scale(1.18); }
            70% { transform: scale(1); }
        }
        
        .main-content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 70px 20px;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }
        
        .login-container {
            max-width: 480px;
            width: 100%;
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 45px 40px;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
            transform: translateY(30px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .login-container:hover {
            box-shadow: var(--box-shadow-hover);
            transform: translateY(-5px);
        }
        
        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: var(--gradient);
            z-index: 1;
        }
        
        .login-container::after {
            content: '';
            position: absolute;
            top: -150px;
            right: -150px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(255, 75, 87, 0.08) 0%, rgba(255, 107, 129, 0) 70%);
            border-radius: 50%;
            z-index: -1;
        }
        
        .login-container h1 {
            margin-bottom: 35px;
            font-size: 2.2rem;
            text-align: center;
            font-weight: 600;
            color: var(--text-color);
            position: relative;
            padding-bottom: 15px;
            animation: fadeIn 1s ease-out forwards;
            opacity: 0;
            animation-delay: 0.3s;
        }
        
        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
        
        .login-container h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: var(--gradient);
            border-radius: 4px;
            transition: var(--transition);
        }
        
        .login-container:hover h1::after {
            width: 100px;
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
            animation: slideInFromRight 0.6s ease-out forwards;
            opacity: 0;
            transform: translateX(20px);
        }
        
        .form-group:nth-child(1) {
            animation-delay: 0.4s;
        }
        
        .form-group:nth-child(2) {
            animation-delay: 0.6s;
        }
        
        @keyframes slideInFromRight {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: 500;
            color: var(--text-color);
            font-size: 0.95rem;
            transition: var(--transition);
            transform-origin: left;
        }
        
        .form-group:focus-within label {
            color: var(--secondary-color);
            transform: scale(1.05);
        }
        
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 16px 20px;
            font-size: 1rem;
            border: 2px solid var(--border-color);
            border-radius: var(--input-radius);
            transition: var(--transition);
            background-color: rgba(255, 255, 255, 0.9);
            font-family: 'Poppins', sans-serif;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
        }
        
        input[type="text"]:focus,
        input[type="password"]:focus {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 4px rgba(46, 134, 222, 0.15);
            background-color: white;
            transform: translateY(-2px);
        }
        
        .input-icon {
            position: absolute;
            top: 49px;
            right: 18px;
            color: var(--text-muted);
            transition: var(--transition);
            pointer-events: none;
        }
        
        input:focus + .input-icon {
            color: var(--secondary-color);
            transform: scale(1.1);
        }
        
        .toggle-password {
            position: absolute;
            right: 18px;
            top: 49px;
            color: var(--text-muted);
            cursor: pointer;
            transition: var(--transition);
            z-index: 2;
        }
        
        .toggle-password:hover {
            color: var(--text-color);
            transform: scale(1.1);
        }
        
        .btn-login {
            width: 100%;
            padding: 16px 20px;
            background: var(--gradient);
            color: white;
            border: none;
            border-radius: var(--input-radius);
            font-size: 1.05rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
            overflow: hidden;
            z-index: 1;
            box-shadow: 0 6px 20px rgba(255, 71, 87, 0.25);
            font-family: 'Poppins', sans-serif;
            margin-top: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            animation: slideInFromBottom 0.7s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
            animation-delay: 0.8s;
        }
        
        @keyframes slideInFromBottom {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: var(--gradient-hover);
            transition: all 0.6s ease-in-out;
            z-index: -1;
        }
        
        .btn-login:hover::before {
            left: 0;
        }
        
        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 71, 87, 0.35);
            letter-spacing: 0.5px;
        }
        
        .btn-login:active {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(255, 71, 87, 0.3);
        }
        
        .btn-login i {
            transition: transform 0.4s ease;
        }
        
        .btn-login:hover i {
            transform: translateX(6px);
        }
        
        .btn-login::after {
            content: '';
            position: absolute;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.3);
            top: 50%;
            left: 50%;
            transform: scale(0);
            transition: 0.5s ease-in-out;
        }
        
        .btn-login:active::after {
            transform: scale(20);
            opacity: 0;
        }
        
        .error-message {
            background-color: var(--primary-light);
            color: var(--primary-dark);
            padding: 18px;
            border-radius: var(--input-radius);
            margin-bottom: 30px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 14px;
            border-left: 4px solid var(--primary-color);
            box-shadow: 0 5px 15px rgba(255, 71, 87, 0.1);
            animation: shakeX 0.75s cubic-bezier(.36,.07,.19,.97) both;
        }
        
        @keyframes shakeX {
            10%, 90% { transform: translateX(-2px); }
            20%, 80% { transform: translateX(4px); }
            30%, 50%, 70% { transform: translateX(-6px); }
            40%, 60% { transform: translateX(6px); }
        }
        
        .error-message::before {
            content: '\f071';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 1.2rem;
            color: var(--primary-color);
        }
        
        .login-links {
            display: flex;
            justify-content: space-between;
            margin-top: 35px;
            font-size: 0.95rem;
            color: var(--text-muted);
            animation: fadeIn 0.8s ease-out forwards;
            opacity: 0;
            animation-delay: 1s;
        }
        
        .login-links a {
            color: var(--secondary-color);
            text-decoration: none;
            transition: var(--transition);
            font-weight: 500;
            position: relative;
            padding: 5px 2px;
        }
        
        .login-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary-color);
            transition: var(--transition);
        }
        
        .login-links a:hover {
            color: var(--primary-color);
        }
        
        .login-links a:hover::after {
            width: 100%;
        }
        
        .footer {
            background-color: var(--text-color);
            color: var(--light-text);
            padding: 25px 0;
            text-align: center;
            position: relative;
        }
        
        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: var(--gradient);
        }
        
        .footer p {
            opacity: 0.9;
            font-weight: 300;
            letter-spacing: 0.5px;
        }
        
        .divider {
            margin-top: auto;
            display: block;
            width: 100%;
            height: 80px;
            margin-bottom: -5px;
            filter: drop-shadow(0 -5px 5px rgba(0, 0, 0, 0.03));
        }
        
        /* Particles Animation */
        .particle {
            position: absolute;
            border-radius: 50%;
            z-index: -1;
            opacity: 0;
            pointer-events: none;
        }
        
        @keyframes float-up {
            0% { transform: translateY(0) rotate(0deg); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 0.5; }
            100% { transform: translateY(-1200%) rotate(360deg); opacity: 0; }
        }
        
        /* Pulse Effect Around Login Box */
        .pulse-ring {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 500px;
            height: 500px;
            border-radius: 50%;
            border: 2px solid rgba(255, 75, 87, 0.1);
            z-index: -2;
        }
        
        .pulse-ring:nth-child(1) {
            animation: pulse 4s infinite;
        }
        
        .pulse-ring:nth-child(2) {
            animation: pulse 4s infinite 1s;
        }
        
        .pulse-ring:nth-child(3) {
            animation: pulse 4s infinite 2s;
        }
        
        @keyframes pulse {
            0% { transform: translate(-50%, -50%) scale(0.3); opacity: 1; }
            100% { transform: translate(-50%, -50%) scale(2); opacity: 0; }
        }
        
        /* Wave Animation */
        .waves {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 200px;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%232d3436' fill-opacity='0.03' d='M0,192L48,176C96,160,192,128,288,138.7C384,149,480,203,576,224C672,245,768,235,864,202.7C960,171,1056,117,1152,106.7C1248,96,1344,128,1392,144L1440,160L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
            background-size: cover;
            z-index: -1;
            opacity: 0.6;
        }
        
        /* Floating Heartbeats */
        .floating-icon {
            position: absolute;
            font-size: 1.5rem;
            color: var(--primary-color);
            opacity: 0.2;
            animation: float 20s linear infinite;
            z-index: -1;
        }
        
        @keyframes float {
            0% { transform: translateY(0) rotate(0deg); }
            33% { transform: translateY(-100px) rotate(20deg); }
            66% { transform: translateY(50px) rotate(-20deg); }
            100% { transform: translateY(0) rotate(0deg); }
        }
        
        /* Responsive adjustments */
        @media (max-width: 576px) {
            .login-container {
                padding: 30px 20px;
                margin: 10px;
                border-radius: 12px;
            }
            
            .login-container h1 {
                font-size: 1.8rem;
            }
            
            .login-links {
                flex-direction: column;
                gap: 15px;
                align-items: center;
            }
            
            .divider {
                height: 40px;
            }
            
            .main-content {
                padding: 40px 15px;
            }
            
            input[type="text"],
            input[type="password"] {
                padding: 14px 16px;
            }
            
            .btn-login {
                padding: 14px 16px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <nav class="navbar">
                <a href="dashboard.php" class="logo">
                    <i class="fas fa-heartbeat"></i>
                    <span>HeartCare Connect</span>
                </a>
            </nav>
        </div>
    </header>
    
    <main class="main-content">
        <!-- Create pulse rings -->
        <div class="pulse-ring"></div>
        <div class="pulse-ring"></div>
        <div class="pulse-ring"></div>
        
        <!-- Create floating heartbeats -->
        <div id="floating-icons-container"></div>
        
        <!-- Create particles container -->
        <div id="particles-container"></div>
        
        <!-- Wave background effect -->
        <div class="waves"></div>
        
        <div class="login-container">
            <h1>Welcome Back</h1>
            
            <?php if (isset($error_message)): ?>
                <div class="error-message"><?= $error_message ?></div>
            <?php endif; ?>
            
            <form method="post" action="">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" placeholder="Enter your username" required autocomplete="username">
                    <i class="fas fa-user input-icon"></i>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password" required autocomplete="current-password">
                    <i class="fas fa-lock-open toggle-password" id="togglePassword"></i>
                </div>

                <button type="submit" class="btn-login">
                    Sign In
                    <i class="fas fa-arrow-right"></i>
                </button>
            </form>
            
            <div class="login-links">
                <a href="forget_password.php">Forgot password?</a>
                <a href="register.php">Create an account</a>
            </div>
        </div>
    </main>
    <script>
        // Toggle password visibility with animation
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = this;
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-lock-open');
                toggleIcon.classList.add('fa-lock');
                toggleIcon.style.transform = 'rotate(10deg) scale(1.2)';
                setTimeout(() => {
                    toggleIcon.style.transform = 'rotate(0) scale(1)';
                }, 300);
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-lock');
                toggleIcon.classList.add('fa-lock-open');
                toggleIcon.style.transform = 'rotate(-10deg) scale(1.2)';
                setTimeout(() => {
                    toggleIcon.style.transform = 'rotate(0) scale(1)';
                }, 300);
            }
        });
        
        // Create floating heart icons
        function createFloatingHearts() {
            const container = document.getElementById('floating-icons-container');
            const mainContent = document.querySelector('.main-content');
            const contentWidth = window.innerWidth;
            const contentHeight = window.innerHeight;
            
            const icons = [
                'fa-heartbeat',
                'fa-heart',
                'fa-heart-pulse',
                'fa-stethoscope'
            ];
            
            // Create 8 floating heart icons
            for (let i = 0; i < 8; i++) {
                const icon = document.createElement('i');
                icon.classList.add('fas', icons[Math.floor(Math.random() * icons.length)], 'floating-icon');
                
                // Random position
                const left = Math.random() * contentWidth;
                const top = Math.random() * contentHeight;
                icon.style.left = `${left}px`;
                icon.style.top = `${top}px`;
                
                // Random animation duration and delay
                const duration = 15 + Math.random() * 10;
                const delay = Math.random() * 5;
                icon.style.animationDuration = `${duration}s`;
                icon.style.animationDelay = `${delay}s`;
                
                // Add to container
                container.appendChild(icon);
            }
        }
        
        // Create rising particles
        function createParticles() {
            const container = document.getElementById('particles-container');
            const mainContent = document.querySelector('.main-content');
            const contentWidth = window.innerWidth;
            
            function createParticle() {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                
                // Random particle properties
                const size = Math.random() * 8 + 3;
                const posX = Math.random() * contentWidth;
                const duration = Math.random() * 8 + 6;
                const delay = Math.random() * 5;
                const hue = Math.random() * 30 + 350; 
                
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                particle.style.left = `${posX}px`;
                particle.style.bottom = '-20px';
                particle.style.backgroundColor = `hsla(${hue}, 100%, 65%, 0.6)`;
                particle.style.animation = `float-up ${duration}s linear ${delay}s infinite`;
                
                container.appendChild(particle);
            }
            
            // Create initial particles
            for (let i = 0; i < 15; i++) {
                createParticle();
            }
            
            // Add new particles periodically
            setInterval(createParticle, 2000);
        }
        
        // Add focus/blur effects for inputs
        const inputs = document.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateX(5px)';
                setTimeout(() => {
                    this.parentElement.style.transform = 'translateX(0)';
                }, 300);
            });
            
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.classList.add('shake-mild');
                    setTimeout(() => {
                        this.classList.remove('shake-mild');
                }, 300);
            }
        });
    });
    
    // Initialize animations when page loads
    window.addEventListener('load', function() {
        createFloatingHearts();
        createParticles();
        
        // Add subtle entrance animation for login container
        setTimeout(() => {
            document.querySelector('.login-container').classList.add('active');
        }, 200);
    });
    
    // Add ripple effect to button
    document.querySelector('.btn-login').addEventListener('mousedown', function(e) {
        const x = e.clientX - e.target.getBoundingClientRect().left;
        const y = e.clientY - e.target.getBoundingClientRect().top;
        
        const ripple = document.createElement('span');
        ripple.classList.add('ripple');
        ripple.style.left = `${x}px`;
        ripple.style.top = `${y}px`;
        
        this.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    });
    
    // Form validation enhancement
    document.querySelector('form').addEventListener('submit', function(e) {
        const username = document.getElementById('username').value.trim();
        const password = document.getElementById('password').value.trim();
        
        if (!username || !password) {
            e.preventDefault();
            
            if (!username) {
                document.getElementById('username').classList.add('error');
                document.getElementById('username').parentElement.classList.add('shake');
                setTimeout(() => {
                    document.getElementById('username').parentElement.classList.remove('shake');
                }, 500);
            }
            
            if (!password) {
                document.getElementById('password').classList.add('error');
                document.getElementById('password').parentElement.classList.add('shake');
                setTimeout(() => {
                    document.getElementById('password').parentElement.classList.remove('shake');
                }, 500);
            }
        }
    });
    
    // Remove error class on input
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            this.classList.remove('error');
        });
    });
</script>
</body>
</html>