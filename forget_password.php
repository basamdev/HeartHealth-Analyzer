<?php
session_start();

// --- Database connection (same as above) ---
$host = "localhost";
$dbname = "heartcare_connect";
$username = "heartcare_user";
$password =""; // no password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // set error mode
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Redirect if logged in
if (!empty($_SESSION['logged_in'])) {
    header("Location: support-groups.php");
    exit;
}

$error_message   = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    if (empty($email)) {
        $error_message = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Invalid email format";
    } else {
        // Look up user
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user) {
            // Generate & store token
            $token      = bin2hex(random_bytes(16));
            $expires_at = date('Y-m-d H:i:s', time() + 3600);
            $stmt = $pdo->prepare("
                INSERT INTO password_resets 
                  (user_id, token, expires_at) 
                VALUES 
                  (?, ?, ?)
            ");
            $stmt->execute([$user['id'], $token, $expires_at]);

            // You would email this link in production:
            // $reset_link = "https://yourdomain.com/reset_password.php?token=$token";
            // mail($email, "Reset Your Password", "Click here: $reset_link");
        }

        // Always show success message
        $success_message = "If the email address exists in our database, you will receive password reset instructions shortly.";
        $email = "";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Reset your password for HeartCare Connect">
    <title>Forgot Password | HeartCare Connect</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #e63946;
            --primary-light: #f8d7da;
            --primary-dark: #c1121f;
            --secondary-color: #457b9d;
            --secondary-light: #a8dadc;
            --text-color: #1d3557;
            --light-text: #f1faee;
            --light-bg: #f8f9fa;
            --border-color: #dee2e6;
            --box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            --border-radius: 12px;
            --input-border-radius: 8px;
            --transition: all 0.3s ease;
            --gradient: linear-gradient(135deg, #e63946 0%, #c1121f 100%);
        }
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            color: var(--text-color);
            line-height: 1.6;
            background-color: #f8f9fa;
            background-image: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .header {
            background-color: white;
            box-shadow: var(--box-shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
            padding: 15px 0;
        }
        
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px 0;
        }
        
        .logo {
            font-size: 1.7rem;
            font-weight: 700;
            color: var(--primary-color);
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            transition: var(--transition);
        }
        
        .logo:hover {
            transform: translateY(-2px);
        }
        
        .logo i {
            animation: pulse 2s infinite;
            font-size: 1.9rem;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.15); }
            100% { transform: scale(1); }
        }
        
        .password-reset-container {
            max-width: 480px;
            margin: 80px auto;
            padding: 40px;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            position: relative;
            overflow: hidden;
        }
        
        .password-reset-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: var(--gradient);
        }
        
        .password-reset-container h1 {
            margin-bottom: 30px;
            color: var(--text-color);
            font-size: 2rem;
            text-align: center;
            font-weight: 600;
        }
        
        form label {
            display: block;
            margin-bottom: 10px;
            font-weight: 500;
            color: #495057;
            font-size: 0.95rem;
        }
        
        form input[type="email"] {
            width: 100%;
            padding: 14px 18px;
            margin-bottom: 25px;
            border: 1px solid var(--border-color);
            border-radius: var(--input-border-radius);
            font-size: 1rem;
            transition: var(--transition);
            background-color: #f8f9fa;
        }
        
        form input[type="email"]:focus {
            outline: none;
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(69, 123, 157, 0.2);
            background-color: white;
        }
        
        form button {
            width: 100%;
            padding: 14px;
            background: var(--gradient);
            color: white;
            border: none;
            border-radius: var(--input-border-radius);
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            letter-spacing: 0.5px;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        form button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #457b9d 0%, #1d3557 100%);
            transition: var(--transition);
            z-index: -1;
        }
        
        form button:hover::before {
            left: 0;
        }
        
        form button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
        }
        
        .error-message {
            color: var(--primary-color);
            background-color: var(--primary-light);
            padding: 12px 16px;
            border-radius: var(--input-border-radius);
            margin-bottom: 25px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 4px solid var(--primary-color);
        }
        
        .error-message::before {
            content: '\f071';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
        }
        
        .success-message {
            color: #155724;
            background-color: #d4edda;
            padding: 12px 16px;
            border-radius: var(--input-border-radius);
            margin-bottom: 25px;
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 10px;
            border-left: 4px solid #155724;
        }
        
        .success-message::before {
            content: '\f00c';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
        }
        
        .reset-links {
            text-align: center;
            margin-top: 25px;
            display: flex;
            justify-content: center;
            gap: 15px;
            font-size: 0.95rem;
            color: #6c757d;
        }
        
        .reset-links a {
            color: var(--secondary-color);
            text-decoration: none;
            transition: var(--transition);
            font-weight: 500;
        }
        
        .reset-links a:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }
        
        .footer {
            background-color: var(--text-color);
            color: var(--light-text);
            padding: 25px 0;
            text-align: center;
            margin-top: auto;
        }
        
        /* Responsive adjustments */
        @media (max-width: 576px) {
            .password-reset-container {
                margin: 40px auto;
                padding: 30px 20px;
            }
            
            .password-reset-container h1 {
                font-size: 1.7rem;
            }
            
            .reset-links {
                flex-direction: column;
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <nav class="navbar">
                <a href="index.php" class="logo"><i class="fas fa-heartbeat"></i> HeartCare Connect</a>
            </nav>
        </div>
    </header>
    
    <div class="password-reset-container">
        <h1>Forgot Password</h1>
        
        <?php if ($error_message): ?>
            <div class="error-message"><?= $error_message ?></div>
        <?php endif; ?>
        
        <?php if ($success_message): ?>
            <div class="success-message"><?= $success_message ?></div>
        <?php endif; ?>
        
        <form method="post" action="">
            <label for="email">Email Address</label>
            <input type="email" id="email" name="email" 
                   value="<?= htmlspecialchars($email ?? '') ?>" 
                   placeholder="Enter your registered email" required>
            
            <button type="submit">Send Reset Link</button>
        </form>
        
        <div class="reset-links">
            <a href="login.php">Back to Login</a>
            <span>|</span>
            <a href="register.php">Create an account</a>
        </div>
    </div>
    
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 HeartCare Connect. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>