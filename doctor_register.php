<?php
// Database connection
$db_host = "localhost";
$db_name = "heartcare_connect";
$db_user = "root";
$db_pass = "";

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Initialize variables
$username = $email = $mobile = "";
$errors = [];
$success = false;

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate username
    if (empty($_POST["username"])) {
        $errors["username"] = "Username is required";
    } else {
        $username = trim($_POST["username"]);
        if (strlen($username) < 3) {
            $errors["username"] = "Username must be at least 3 characters";
        }
        
        // Check if username already exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM doctors WHERE username = ?");
        $stmt->execute([$username]);
        if ($stmt->fetchColumn() > 0) {
            $errors["username"] = "Username already taken";
        }
    }
    
    // Validate email
    if (empty($_POST["email"])) {
        $errors["email"] = "Email is required";
    } else {
        $email = trim($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Please enter a valid email address";
        }
        
        // Check if email already exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM doctors WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetchColumn() > 0) {
            $errors["email"] = "Email already registered";
        }
    }
    
    // Validate password
    if (empty($_POST["password"])) {
        $errors["password"] = "Password is required";
    } elseif (strlen($_POST["password"]) < 8) {
        $errors["password"] = "Password must be at least 8 characters";
    }
    
    // Validate password confirmation
    if ($_POST["password"] !== $_POST["confirm_password"]) {
        $errors["confirm_password"] = "Passwords do not match";
    }
    
    // Validate mobile (optional)
    if (!empty($_POST["mobile"])) {
        $mobile = trim($_POST["mobile"]);
        if (!preg_match("/^[0-9\-\(\)\/\+\s]*$/", $mobile)) {
            $errors["mobile"] = "Please enter a valid phone number";
        }
    }
    
    // Process profile picture if uploaded
    $profile_picture = "default-avatar.png"; // Default value
    if (isset($_FILES["profile_picture"]) && $_FILES["profile_picture"]["error"] == 0) {
        $allowed = ["jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png"];
        $filename = $_FILES["profile_picture"]["name"];
        $filetype = $_FILES["profile_picture"]["type"];
        $filesize = $_FILES["profile_picture"]["size"];
        
        // Verify file extension
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!array_key_exists($ext, $allowed)) {
            $errors["profile_picture"] = "Please select a valid file format (JPG, JPEG, PNG, GIF)";
        }
        
        // Verify file size - 5MB maximum
        $maxsize = 5 * 1024 * 1024;
        if ($filesize > $maxsize) {
            $errors["profile_picture"] = "File size must be less than 5MB";
        }
        
        // If no errors, proceed with upload
        if (empty($errors["profile_picture"])) {
            // Create unique filename
            $new_filename = uniqid() . "." . $ext;
            $upload_dir = "uploads/profiles/";
            
            // Create directory if it doesn't exist
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            
            // Move the file
            if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $upload_dir . $new_filename)) {
                $profile_picture = $upload_dir . $new_filename;
            } else {
                $errors["profile_picture"] = "Failed to upload file";
            }
        }
    }
    
    // If no errors, insert new user
    if (empty($errors)) {
        try {
            $hashed_password = password_hash($_POST["password"], PASSWORD_DEFAULT);
            $theme = "light"; // Default theme
            
            $sql = "INSERT INTO doctors (username, password, email, mobile, profile_picture, theme) 
                    VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$username, $hashed_password, $email, $mobile, $profile_picture, $theme]);
            
            $success = true;
        } catch (PDOException $e) {
            $errors["db"] = "Registration failed: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Doctor registration portal for HeartCare Connect">
    <title>Doctor Registration - HeartCare Connect</title>
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

        .main-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 80px); /* Subtracting header height */
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
            padding: 40px 20px;
            position: relative;
            z-index: 1;
            overflow: hidden;
        }
        
        .register-container {
            max-width: 600px;
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
            margin: 40px 0;
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
        
        .register-container h2 {
            margin-bottom: 10px;
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
        
        .register-container p.text-muted {
            text-align: center;
            color: var(--text-muted);
            margin-bottom: 30px;
            font-size: 1.1rem;
            animation: fadeIn 1s ease-out forwards;
            opacity: 0;
            animation-delay: 0.4s;
        }
        
        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
        
        .register-container h2::after {
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
        
        .register-container:hover h2::after {
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
            animation-delay: 0.5s;
        }
        
        .form-group:nth-child(3) {
            animation-delay: 0.6s;
        }
        
        .form-group:nth-child(4) {
            animation-delay: 0.7s;
        }
        
        .form-group:nth-child(5) {
            animation-delay: 0.8s;
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
            color: var (--text-color);
            font-size: 0.95rem;
            transition: var(--transition);
            transform-origin: left;
        }
        
        .form-group:focus-within label {
            color: var(--secondary-color);
            transform: scale(1.05);
        }
        
        input[type="text"],
        input[type="email"],
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
        input[type="email"]:focus,
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
            color: var (--secondary-color);
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
        
        .custom-file {
            position: relative;
            margin-bottom: 10px;
        }
        
        .custom-file-input {
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 100%;
            opacity: 0;
            cursor: pointer;
            z-index: 2;
        }
        
        .custom-file-label {
            display: block;
            width: 100%;
            padding: 16px 20px;
            font-size: 1rem;
            border: 2px solid var(--border-color);
            border-radius: var(--input-radius);
            transition: var(--transition);
            background-color: rgba(255, 255, 255, 0.9);
            font-family: 'Poppins', sans-serif;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.03);
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        .custom-file-input:focus ~ .custom-file-label {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 4px rgba(46, 134, 222, 0.15);
            background-color: white;
            transform: translateY(-2px);
        }
        
        .btn-primary {
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
        
        .btn-primary::before {
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
        
        .btn-primary:hover::before {
            left: 0;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(255, 71, 87, 0.35);
            letter-spacing: 0.5px;
        }
        
        .btn-primary:active {
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(255, 71, 87, 0.3);
        }
        
        .btn-primary i {
            transition: transform 0.4s ease;
        }
        
        .btn-primary:hover i {
            transform: translateX(6px);
        }
        
        .btn-primary::after {
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
        
        .btn-primary:active::after {
            transform: scale(20);
            opacity: 0;
        }
        
        .text-center {
            text-align: center;
            margin-top: 25px;
            animation: fadeIn 0.8s ease-out forwards;
            opacity: 0;
            animation-delay: 1s;
        }
        
        .text-center p {
            color: var(--text-muted);
            font-size: 0.95rem;
        }
        
        .text-center a {
            color: var(--secondary-color);
            text-decoration: none;
            font-weight: 500;
            transition: var(--transition);
            position: relative;
            padding: 5px 2px;
        }
        
        .text-center a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background-color: var(--primary-color);
            transition: var(--transition);
        }
        
        .text-center a:hover {
            color: var(--primary-color);
        }
        
        .text-center a:hover::after {
            width: 100%;
        }
        
        .alert-danger {
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
        
        .alert-danger::before {
            content: '\f071';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 1.2rem;
            color: var(--primary-color);
        }
        
        .error-feedback {
            color: var(--primary-color);
            font-size: 0.85rem;
            margin-top: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .error-feedback::before {
            content: '\f06a';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
        }
        
        .form-text {
            color: var(--text-muted);
            font-size: 0.85rem;
            margin-top: 8px;
        }
        
        /* Pulse Effect Around Register Box */
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
        
        /* Success message */
        .alert-success {
            background-color: rgba(46, 213, 115, 0.1);
            color: #2ed573;
            padding: 18px;
            border-radius: var(--input-radius);
            margin-bottom: 30px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 14px;
            border-left: 4px solid #2ed573;
            box-shadow: 0 5px 15px rgba(46, 213, 115, 0.1);
            animation: fadeIn 0.75s ease-out both;
        }
        
        .alert-success::before {
            content: '\f058';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            font-size: 1.2rem;
            color: #2ed573;
        }
        
        /* Responsive adjustments */
        @media (max-width: 576px) {
            .register-container {
                padding: 30px 20px;
                margin: 10px;
                border-radius: 12px;
            }
            
            .register-container h2 {
                font-size: 1.8rem;
            }
            
            .main-content {
                padding: 40px 15px;
            }
            
            input[type="text"],
            input[type="email"],
            input[type="password"],
            .custom-file-label {
                padding: 14px 16px;
            }
            
            .btn-primary {
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
       <i class="fas fa-heartbeat floating-icon" style="top: 10%; left: 5%;"></i>
        <i class="fas fa-heartbeat floating-icon" style="top: 20%; right: 10%;"></i>
        <i class="fas fa-heartbeat floating-icon" style="top: 70%; left: 15%;"></i>
        <i class="fas fa-heartbeat floating-icon" style="top: 80%; right: 20%;"></i>
        <i class="fas fa-heartbeat floating-icon" style="top: 40%; left: 90%;"></i>
        
        <!-- Wave animation -->
        <div class="waves"></div>
        
        <div class="container main-container">
            <div class="register-container">
                <?php if ($success): ?>
                    <div class="alert-success">
                        Registration successful! You can now <a href="doctor_login.php">login</a> to your account.
                    </div>
                <?php endif; ?>
                
                <?php if (isset($errors["db"])): ?>
                    <div class="alert-danger">
                        <?php echo $errors["db"]; ?>
                    </div>
                <?php endif; ?>
                
                <h2>Doctor Registration</h2>
                <p class="text-muted">Join HeartCare Connect to manage your patients and services</p>
                
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" placeholder="Enter your username">
                        <i class="fas fa-user input-icon"></i>
                        <?php if (isset($errors["username"])): ?>
                            <div class="error-feedback"><?php echo $errors["username"]; ?></div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Enter your email">
                        <i class="fas fa-envelope input-icon"></i>
                        <?php if (isset($errors["email"])): ?>
                            <div class="error-feedback"><?php echo $errors["email"]; ?></div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="Enter your password">
                        <i class="toggle-password fas fa-eye" onclick="togglePassword('password')"></i>
                        <?php if (isset($errors["password"])): ?>
                            <div class="error-feedback"><?php echo $errors["password"]; ?></div>
                        <?php endif; ?>
                        <div class="form-text">Password must be at least 8 characters long</div>
                    </div>
                    
                    <div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password">
                        <i class="toggle-password fas fa-eye" onclick="togglePassword('confirm_password')"></i>
                        <?php if (isset($errors["confirm_password"])): ?>
                            <div class="error-feedback"><?php echo $errors["confirm_password"]; ?></div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label for="mobile">Mobile Number (Optional)</label>
                        <input type="text" id="mobile" name="mobile" value="<?php echo htmlspecialchars($mobile); ?>" placeholder="Enter your mobile number">
                        <i class="fas fa-phone input-icon"></i>
                        <?php if (isset($errors["mobile"])): ?>
                            <div class="error-feedback"><?php echo $errors["mobile"]; ?></div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="form-group">
                        <label>Profile Picture (Optional)</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="profile_picture" name="profile_picture">
                            <label class="custom-file-label" for="profile_picture">Choose file</label>
                        </div>
                        <?php if (isset($errors["profile_picture"])): ?>
                            <div class="error-feedback"><?php echo $errors["profile_picture"]; ?></div>
                        <?php endif; ?>
                        <div class="form-text">Max file size: 5MB. Allowed formats: JPG, JPEG, PNG, GIF</div>
                    </div>
                    
                    <button type="submit" class="btn-primary">
                        Register Account
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
                
                <div class="text-center">
                    <p>Already have an account? <a href="doctor_login.php">Login here</a></p>
                </div>
            </div>
        </div>
    </main>
    
    <script>
        // Add particles animation
        function createParticles() {
            const particles = 15;
            const colors = ['#ff4757', '#ff6b81', '#ff7f50', '#ff6348'];
            
            for (let i = 0; i < particles; i++) {
                setTimeout(() => {
                    const particle = document.createElement('div');
                    particle.classList.add('particle');
                    
                    // Random position, size, and color
                    const size = Math.random() * 15 + 5;
                    const color = colors[Math.floor(Math.random() * colors.length)];
                    const left = Math.random() * 100;
                    const duration = Math.random() * 20 + 10;
                    const delay = Math.random() * 5;
                    
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    particle.style.backgroundColor = color;
                    particle.style.left = `${left}%`;
                    particle.style.bottom = '-20px';
                    particle.style.animation = `float-up ${duration}s linear infinite ${delay}s`;
                    
                    document.body.appendChild(particle);
                }, i * 300);
            }
        }
        
        // Initialize particles
        window.addEventListener('load', createParticles);
        
        // Toggle password visibility
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const toggleIcon = passwordField.nextElementSibling;
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
        
        // Update file input label with selected filename
        document.getElementById('profile_picture').addEventListener('change', function(e) {
            const fileName = e.target.files[0] ? e.target.files[0].name : 'Choose file';
            document.querySelector('.custom-file-label').textContent = fileName;
        });
    </script>
</body>
</html>