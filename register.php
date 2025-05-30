<?php
session_start();
$host    = '127.0.0.1';
$db      = 'heartcare_connect';
$user    = 'root';
$pass    = '';        
$charset = 'utf8mb4';

$dsn = "mysql:host={$host};dbname={$db};charset={$charset}";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // during development, show the full error
    exit('Connection failed: ' . $e->getMessage());
}

// Redirect if already logged in
if (!empty($_SESSION['logged_in'])) {
    header("Location: support-groups.php");
    exit;
}

$error_message   = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name       = trim($_POST['first_name']);
    $last_name        = trim($_POST['last_name']);
    $email            = trim($_POST['email']);
    $username         = trim($_POST['username']);
    $password         = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation
    if (empty($first_name) || empty($last_name) || empty($email) || empty($username) || empty($password) || empty($confirm_password)) {
        $error_message = "All fields are required";
    } elseif ($password !== $confirm_password) {
        $error_message = "Passwords do not match";
    } elseif (strlen($password) < 8) {
        $error_message = "Password must be at least 8 characters long";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format";
    } else {
        // Check uniqueness
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        if ($stmt->fetchColumn() > 0) {
            $error_message = "Username or email already taken";
        } else {
            // Insert new user
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare("
                INSERT INTO users 
                  (first_name, last_name, email, username, password_hash) 
                VALUES 
                  (?, ?, ?, ?, ?)
            ");
            $stmt->execute([$first_name, $last_name, $email, $username, $password_hash]);

            $success_message = "Registration successful! You can now <a href='login.php'>login</a>.";
            // Clear form
            $first_name = $last_name = $email = $username = "";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Register for heart disease support groups">
    <title>Register | HeartCare Connect</title>
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
            padding: 50px 20px;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }
        
        .register-container {
            max-width: 650px;
            width: 100%;
            background-color: var(--card-bg);
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            padding: 40px;
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
        
        .register-container:hover {
            box-shadow: var(--box-shadow-hover);
            transform: translateY(-5px);
        }
        
        .register-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 6px;
            background: var(--gradient);
            z-index: 1;
        }
        
        .register-container::after {
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
        
        .register-container h1 {
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
        
        .register-container h1::after {
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
        
        .register-container:hover h1::after {
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
            animation-delay: 0.3s;
        }
        
        .form-group:nth-child(2) {
            animation-delay: 0.4s;
        }
        
        .form-group:nth-child(3) {
            animation-delay: 0.5s;
        }
        
        .form-group:nth-child(4) {
            animation-delay: 0.6s;
        }
        
        .form-group:nth-child(5) {
            animation-delay: 0.7s;
        }
        
        .form-group:nth-child(6) {
            animation-delay: 0.8s;
        }
        
        @keyframes slideInFromRight {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        .form-row {
            display: flex;
            gap: 20px;
        }
        
        .form-col {
            flex: 1;
            position: relative;
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
        
        .form-group:focus-within label, 
        .form-col:focus-within label {
            color: var(--secondary-color);
            transform: scale(1.05);
        }
        
        input[type="text"],
        input[type="password"],
        input[type="email"] {
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
        input[type="password"]:focus,
        input[type="email"]:focus {
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
        
        button[type="submit"] {
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
            animation-delay: 0.9s;
        }
        
        @keyframes slideInFromBottom {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        button[type="submit"]::before {
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
        
        button[type="submit"]:hover::before {
            left: 0;
        }
        
        button[type="submit"]:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 71, 87, 0.35);
            letter-spacing: 0.5px;
        }
        
        button[type="submit"]:active {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(255, 71, 87, 0.3);
        }
        
        button[type="submit"] i {
            transition: transform 0.4s ease;
        }
        
        button[type="submit"]:hover i {
            transform: translateX(6px);
        }
        
        button[type="submit"]::after {
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
        
        button[type="submit"]:active::after {
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
        
        .success-message {
            color: #155724;
            background-color: #d4edda;
            padding: 18px;
            border-radius: var(--input-radius);
            margin-bottom: 30px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 14px;
            border-left: 4px solid #155724;
            box-shadow: 0 5px 15px rgba(46, 125, 50, 0.1);
            animation: bounceIn 0.75s cubic-bezier(0.215, 0.610, 0.355, 1.000) both;
        }
        
        @keyframes bounceIn {
            0% { transform: scale(0.3); opacity: 0; }
            20% { transform: scale(1.1); }
            40% { transform: scale(0.9); }
            60% { transform: scale(1.03); opacity: 1; }
            80% { transform: scale(0.97); }
            100% { transform: scale(1); opacity: 1; }
        }
        
        .success-message::before {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 1.2rem;
            color: #155724;
        }
        
        .register-links {
            text-align: center;
            margin-top: 25px;
            font-size: 0.95rem;
            color: var(--text-muted);
            animation: fadeIn 0.8s ease-out forwards;
            opacity: 0;
            animation-delay: 1s;
        }
        
        .register-links a {
            color: var(--secondary-color);
            text-decoration: none;
            transition: var(--transition);
            font-weight: 500;
            position: relative;
            padding: 5px 2px;
        }
        
        .register-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary-color);
            transition: var(--transition);
        }
        
        .register-links a:hover {
            color: var(--primary-color);
        }
        
        .register-links a:hover::after {
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
        
        /* Password strength indicator */
        .password-strength {
            height: 5px;
            margin-top: -15px;
            margin-bottom: 15px;
            border-radius: 3px;
            overflow: hidden;
            background-color: #eee;
            transition: var(--transition);
        }
        
        .password-strength-bar {
            height: 100%;
            width: 0;
            transition: var(--transition);
            background-color: #dc3545;
        }
        
        .password-strength-text {
            font-size: 0.8rem;
            margin-top: 5px;
            color: #6c757d;
            text-align: right;
            margin-bottom: 15px;
            transition: var(--transition);
        }
        
        /* Pulse Effect Around Register Box */
        .pulse-ring {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 600px;
            height: 600px;
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
        
        /* Waves Animation */
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
        
        /* Particle Animation */
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
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .register-container {
                padding: 30px 20px;
                margin: 10px;
                border-radius: 12px;
            }
            
            .register-container h1 {
                font-size: 1.8rem;
            }
            
            .form-row {
                flex-direction: column;
                gap: 0;
            }
            
            .main-content {
                padding: 30px 15px;
            }
            
            input[type="text"],
            input[type="password"],
            input[type="email"] {
                padding: 14px 16px;
            }
            
            button[type="submit"] {
                padding: 14px 16px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <nav class="navbar">
                <a href="index.php" class="logo">
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
        
        <div class="register-container">
            <h1>Join HeartCare Connect</h1>

            <?php if ($error_message): ?>
                <div class="error-message"><?= $error_message ?></div>
            <?php endif; ?>
            
            <?php if ($success_message): ?>
                <div class="success-message"><?= $success_message ?></div>
            <?php endif; ?>

            <form method="post" action="">
                <div class="form-row">
                    <div class="form-col form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" 
                               value="<?= htmlspecialchars($first_name ?? '') ?>" required placeholder="Enter your first name">
                        <i class="fas fa-user input-icon"></i>
                    </div>
                    <div class="form-col form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name"
                               value="<?= htmlspecialchars($last_name ?? '') ?>" required placeholder="Enter your last name">
                        <i class="fas fa-user input-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email"
                           value="<?= htmlspecialchars($email ?? '') ?>" required placeholder="Enter your email address">
                    <i class="fas fa-envelope input-icon"></i>
                </div>

                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username"
                           value="<?= htmlspecialchars($username ?? '') ?>" required placeholder="Choose a username">
                    <i class="fas fa-user-tag input-icon"></i>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required placeholder="Create a strong password">
                    <i class="fas fa-lock-open toggle-password" id="togglePassword"></i>
                    <div class="password-strength">
                        <div class="password-strength-bar"></div>
                    </div>
                    <div class="password-strength-text">Password strength: Too short</div>
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" id="confirm_password" name="confirm_password" required placeholder="Confirm your password">
                    <i class="fas fa-lock toggle-password" id="toggleConfirmPassword"></i>
                </div>

                <button type="submit">
                    Create Account
                    <i class="fas fa-arrow-right"></i>
                </button>
                
                <div class="register-links">
                    Already have an account? <a href="login.php">Login here</a>
                </div>
            </form>
        </div>
    </main>
    
    <footer class="footer">
        <div class="container">
            <p>&copy; <?= date('Y') ?> HeartCare Connect. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this;
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-lock-open');
                icon.classList.add('fa-lock');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-lock');
                icon.classList.add('fa-lock-open');
            }
        });
        
        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const confirmPasswordInput = document.getElementById('confirm_password');
            const icon = this;
            
            if (confirmPasswordInput.type === 'password') {
                confirmPasswordInput.type = 'text';
                icon.classList.remove('fa-lock');
                icon.classList.add('fa-lock-open');
            } else {
                confirmPasswordInput.type = 'password';
                icon.classList.remove('fa-lock-open');
                icon.classList.add('fa-lock');
            }
        });
        
        // Password strength meter
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.querySelector('.password-strength-bar');
            const strengthText = document.querySelector('.password-strength-text');
            
            let strength = 0;
            
            if (password.length > 0) strength += password.length * 2;
            if (password.length >= 8) strength += 10;
            if (/[A-Z]/.test(password)) strength += 10;
            if (/[a-z]/.test(password)) strength += 10;
            if (/[0-9]/.test(password)) strength += 10;
            if (/[^A-Za-z0-9]/.test(password)) strength += 15;
            
            // Cap at 100
            strength = Math.min(100, strength);
            
            // Update UI
            strengthBar.style.width = strength + '%';
            
            if (strength < 30) {
                strengthBar.style.backgroundColor = '#dc3545';
                strengthText.textContent = 'Password strength: Weak';
                strengthText.style.color = '#dc3545';
            } else if (strength < 60) {
                strengthBar.style.backgroundColor = '#ffc107';
                strengthText.textContent = 'Password strength: Medium';
                strengthText.style.color = '#ffc107';
            } else {
                strengthBar.style.backgroundColor = '#28a745';
                strengthText.textContent = 'Password strength: Strong';
                strengthText.style.color = '#28a745';
            }
            
            if (password.length === 0) {
                strengthText.textContent = 'Password strength: Too short';
                strengthText.style.color = '#6c757d';
            }
        });
        
        // Create floating heartbeats
        function createFloatingHeartbeats() {
            const container = document.getElementById('floating-icons-container');
            const icons = ['fa-heartbeat', 'fa-heart', 'fa-heart-pulse'];
            
            for (let i = 0; i < 10; i++) {
                const icon = document.createElement('i');
                icon.className = `fas ${icons[Math.floor(Math.random() * icons.length)]} floating-icon`;
                
                // Random positioning
                icon.style.left = `${Math.random() * 100}%`;
                icon.style.top = `${Math.random() * 100}%`;
                
                // Random animation duration
                const animDuration = 15 + Math.random() * 20;
                icon.style.animationDuration = `${animDuration}s`;
                
                // Random animation delay
                icon.style.animationDelay = `${Math.random() * 10}s`;
                
                container.appendChild(icon);
            }
        }
        
        // Create particles effect
        function createParticles() {
            const container = document.getElementById('particles-container');
            const colors = ['#ff4757', '#ff6b81', '#ff7f50', '#ff6348'];
            
            for (let i = 0; i < 30; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                
                // Random size
                const size = 3 + Math.random() * 5;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
                // Random positioning
                particle.style.left = `${Math.random() * 100}%`;
                particle.style.bottom = '0';
                
                // Random color
                particle.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                
                // Animation
                const animDuration = 10 + Math.random() * 20;
                particle.style.animation = `float-up ${animDuration}s linear infinite`;
                particle.style.animationDelay = `${Math.random() * 20}s`;
                
                container.appendChild(particle);
            }
        }
        
        // Execute animations
        window.addEventListener('load', function() {
            createFloatingHeartbeats();
            createParticles();
        });
    </script>
</body>
</html>