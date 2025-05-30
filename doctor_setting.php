<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['doctor_id'])) {
    header("Location: doctor_login.php");
    exit;
}

// Database connection
$host = 'localhost';
$dbname = 'heartcare_connect';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Initialize message variables
$success_message = "";
$error_message = "";

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update username
    if (isset($_POST['username']) && !empty($_POST['username'])) {
        $new_username = htmlspecialchars(trim($_POST['username']));
        
        // Check if username already exists
        $check_stmt = $pdo->prepare("SELECT COUNT(*) FROM doctors WHERE username = :username AND doctor_id != :doctor_id");
        $check_stmt->bindParam(':username', $new_username);
        $check_stmt->bindParam(':doctor_id', $_SESSION['doctor_id']);
        $check_stmt->execute();
        
        if ($check_stmt->fetchColumn() > 0) {
            $error_message = "Username already exists. Please choose another one.";
        } else {
            // Update in database
            $stmt = $pdo->prepare("UPDATE doctors SET username = :username WHERE doctor_id = :doctor_id");
            $stmt->bindParam(':username', $new_username);
            $stmt->bindParam(':doctor_id', $_SESSION['doctor_id']);
            $stmt->execute();

            // Update session username
            $_SESSION['username'] = $new_username;
            $success_message = "Username updated successfully!";
        }
    }

    // Change theme
    if (isset($_POST['theme'])) {
        $new_theme = $_POST['theme'];

        // Add missing SQL statement
        $stmt = $pdo->prepare("UPDATE doctors SET theme = :theme WHERE doctor_id = :doctor_id");
        $stmt->bindParam(':theme', $new_theme);
        $stmt->bindParam(':doctor_id', $_SESSION['doctor_id']);
        $stmt->execute();

        // Update session theme
        $_SESSION['theme'] = $new_theme;
        if (empty($success_message)) {
            $success_message = "Theme updated successfully!";
        } else {
            $success_message .= " Theme updated successfully!";
        }
    }

    // Handle profile picture upload
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        // Get file details
        $file_name = $_FILES['profile_picture']['name'];
        $file_size = $_FILES['profile_picture']['size'];
        $file_tmp = $_FILES['profile_picture']['tmp_name'];
        $file_type = $_FILES['profile_picture']['type'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        
        // Valid extensions
        $extensions = array("jpeg", "jpg", "png", "gif");
        
        if (in_array($file_ext, $extensions)) {
            // Check file size (limit to 5MB)
            if ($file_size <= 5000000) {
                // Create unique filename
                $new_file_name = uniqid('profile_') . '.' . $file_ext;
                $upload_dir = 'uploads/';
                $upload_file = $upload_dir . $new_file_name;
                
                // Check if directory exists, if not create it
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                
                // Move the uploaded file to the desired directory
                if (move_uploaded_file($file_tmp, $upload_file)) {
                    // Delete old profile picture if exists
                    if (isset($_SESSION['profile_picture']) && $_SESSION['profile_picture'] != 'default-avatar.png' && file_exists($_SESSION['profile_picture'])) {
                        unlink($_SESSION['profile_picture']);
                    }
                    
                    // Update in database
                    $stmt = $pdo->prepare("UPDATE doctors SET profile_picture = :profile_picture WHERE doctor_id = :doctor_id");
                    $stmt->bindParam(':profile_picture', $upload_file);
                    $stmt->bindParam(':doctor_id', $_SESSION['doctor_id']);
                    $stmt->execute();

                    // Update session profile picture
                    $_SESSION['profile_picture'] = $upload_file;
                    
                    if (empty($success_message)) {
                        $success_message = "Profile picture updated successfully!";
                    } else {
                        $success_message .= " Profile picture updated successfully!";
                    }
                } else {
                    $error_message = 'Failed to upload profile picture.';
                }
            } else {
                $error_message = 'File size must be less than 5MB';
            }
        } else {
            $error_message = 'Invalid file format. Only JPEG, JPG, PNG and GIF files are allowed.';
        }
    }
}

// Fetch user info from session
$user = [
    'doctor_id' => $_SESSION['doctor_id'],
    'username' => $_SESSION['username'],
    'profile_picture' => $_SESSION['profile_picture'] ?? 'default-avatar.png',
    'theme' => $_SESSION['theme'] ?? 'light'
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - HeartCare Connect</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
            --accent-color: #4895ef;
            --success-color: #4cc9f0;
            --warning-color: #f72585;
            --text-light: #f8f9fa;
            --text-dark: #212529;
            --bg-light: #f8f9fa;
            --bg-dark: #121212;
            --card-light: #ffffff;
            --card-dark: #1e1e1e;
            --sidebar-light: #ffffff;
            --sidebar-dark: #121212;
            --border-radius: 12px;
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            --shadow-light: 0 4px 20px rgba(0, 0, 0, 0.08);
            --shadow-dark: 0 4px 20px rgba(0, 0, 0, 0.25);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: var(--bg-light);
            color: var(--text-dark);
            transition: var(--transition);
            overflow-x: hidden;
        }

        body.dark {
            background-color: var(--bg-dark);
            color: var(--text-light);
        }

        /* Sidebar Styles */
        .sidebar {
            width: 280px;
            height: 100vh;
            background: linear-gradient(180deg, var(--primary-color), var(--secondary-color));
            color: var(--text-light);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            z-index: 100;
            transition: var(--transition);
            box-shadow: var(--shadow-light);
            overflow-y: auto;
        }

        body.dark .sidebar {
            background: linear-gradient(180deg, #2b2d42, #121420);
            box-shadow: var(--shadow-dark);
        }

        .brand-container {
            padding: 25px 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .brand-logo {
            width: 45px;
            height: 45px;
            background-color: var(--accent-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.2);
        }

        .brand-logo i {
            font-size: 24px;
            color: var(--text-light);
        }

        .brand-name {
            font-size: 1.5rem;
            font-weight: bold;
            letter-spacing: 1px;
        }

        .menu-container {
            padding: 20px 15px;
            flex-grow: 1;
        }

        .menu-label {
            text-transform: uppercase;
            font-size: 0.8rem;
            letter-spacing: 1px;
            margin: 20px 0 10px 10px;
            opacity: 0.6;
        }

        .sidebar ul {
            list-style: none;
        }

        .sidebar ul li {
            margin: 8px 0;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        .sidebar ul li.active {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .sidebar ul li:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar ul li a {
            text-decoration: none;
            color: var(--text-light);
            display: flex;
            align-items: center;
            padding: 15px 20px;
            border-radius: var(--border-radius);
            font-weight: 500;
        }

        .sidebar ul li i {
            min-width: 25px;
            margin-right: 10px;
            font-size: 1.1rem;
        }

        .sidebar-footer {
            padding: 15px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            font-size: 0.8rem;
            opacity: 0.7;
        }

        /* Main Content */
        .main {
            margin-left: 280px;
            padding: 30px;
            transition: var(--transition);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.dark .header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .header h1 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        body.dark .header h1 {
            color: var(--accent-color);
        }

        .header-actions {
            display: flex;
            align-items: center;
        }

        .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            box-shadow: var(--shadow-light);
            cursor: pointer;
        }

        body.dark .profile-pic {
            box-shadow: var(--shadow-dark);
        }

        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Settings Content */
        .settings-container {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: 30px;
        }

        .profile-card {
            background-color: var(--card-light);
            border-radius: var(--border-radius);
            padding: 30px;
            text-align: center;
            box-shadow: var(--shadow-light);
            transition: var(--transition);
            height: fit-content;
        }

        body.dark .profile-card {
            background-color: var(--card-dark);
            box-shadow: var(--shadow-dark);
        }

        .avatar-container {
            position: relative;
            width: 150px;
            height: 150px;
            margin: 0 auto 25px;
        }

        .avatar {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid var(--primary-color);
            box-shadow: 0 0 20px rgba(67, 97, 238, 0.3);
            transition: var(--transition);
        }

        body.dark .avatar {
            border-color: var(--accent-color);
            box-shadow: 0 0 20px rgba(72, 149, 239, 0.3);
        }

        .doctor-name {
            font-size: 1.7rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .doctor-id {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 25px;
        }

        .doctor-stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 20px;
        }

        .stat-card {
            background-color: rgba(67, 97, 238, 0.1);
            padding: 15px;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }

        body.dark .stat-card {
            background-color: rgba(72, 149, 239, 0.1);
        }

        .stat-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        body.dark .stat-value {
            color: var(--accent-color);
        }

        .stat-label {
            font-size: 0.8rem;
            opacity: 0.8;
            margin-top: 5px;
        }

        .settings-form-container {
            background-color: var(--card-light);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-light);
            transition: var(--transition);
            overflow: hidden;
        }

        body.dark .settings-form-container {
            background-color: var(--card-dark);
            box-shadow: var(--shadow-dark);
        }

        .settings-tabs {
            display: flex;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.dark .settings-tabs {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .tab-item {
            padding: 18px 25px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            position: relative;
        }

        .tab-item.active {
            color: var(--primary-color);
        }

        body.dark .tab-item.active {
            color: var(--accent-color);
        }

        .tab-item.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 3px;
            background-color: var(--primary-color);
            border-radius: 3px 3px 0 0;
        }

        body.dark .tab-item.active::after {
            background-color: var(--accent-color);
        }

        .settings-form {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
            font-weight: 500;
            font-size: 1rem;
        }

        .form-control {
            width: 100%;
            padding: 15px;
            border: 1px solid #ced4da;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
            background-color: var(--bg-light);
            color: var(--text-dark);
        }

        body.dark .form-control {
            border-color: #2d3748;
            background-color: #2d3748;
            color: var(--text-light);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(67, 97, 238, 0.2);
        }

        body.dark .form-control:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 2px rgba(72, 149, 239, 0.2);
        }

        .form-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23212529' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 16px 12px;
        }

        body.dark .form-select {
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23f8f9fa' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        }

        .custom-file-input {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .custom-file-label {
            display: block;
            padding: 15px;
            border: 1px solid #ced4da;
            border-radius: var(--border-radius);
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
            background-color: var(--bg-light);
            color: var(--text-dark);
        }

        body.dark .custom-file-label {
            border-color: #2d3748;
            background-color: #2d3748;
            color: var(--text-light);
        }

        .custom-file-label:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }

        body.dark .custom-file-label:hover {
            background-color: rgba(72, 149, 239, 0.05);
        }

        .custom-file-input input[type="file"] {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            opacity: 0;
            cursor: pointer;
            width: 100%;
            height: 100%;
        }

        .file-name {
            margin-top: 10px;
            font-size: 0.9rem;
            color: #6c757d;
        }

        body.dark .file-name {
            color: #a0aec0;
        }

        .btn {
            display: inline-block;
            padding: 12px 25px;
            border: none;
            border-radius: var(--border-radius);
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            text-align: center;
        }

        .btn-primary {
            background-color: var(--primary-color);
            color: var(--text-light);
        }

        .btn-primary:hover {
            background-color: var(--secondary-color);
        }

        body.dark .btn-primary {
            background-color: var(--accent-color);
        }

        body.dark .btn-primary:hover {
            background-color: #3a76c4;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: var(--border-radius);
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .alert i {
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .alert-success {
            background-color: rgba(76, 201, 240, 0.15);
            border-left: 4px solid var(--success-color);
            color: var(--success-color);
        }

        .alert-danger {
            background-color: rgba(247, 37, 133, 0.15);
            border-left: 4px solid var(--warning-color);
            color: var(--warning-color);
        }

        /* Theme toggle in profile card */
        .theme-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
        }

        .theme-label {
            margin-right: 10px;
            font-weight: 500;
        }

        .theme-switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 30px;
        }

        .theme-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: var(--transition);
            border-radius: 30px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 22px;
            width: 22px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: var(--transition);
            border-radius: 50%;
        }

        input:checked + .slider {
            background-color: var(--primary-color);
        }

        body.dark input:checked + .slider {
            background-color: var(--accent-color);
        }

        input:checked + .slider:before {
            transform: translateX(30px);
        }

        .slider-icons {
            display: flex;
            justify-content: space-between;
            padding: 0 8px;
            line-height: 30px;
            color: white;
        }

        /* Mobile responsive */
        @media (max-width: 992px) {
            .settings-container {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                padding: 15px 10px;
            }
            
            .sidebar .brand-name,
            .sidebar .menu-label,
            .sidebar ul li a span,
            .sidebar-footer {
                display: none;
            }
            
            .brand-container {
                justify-content: center;
                padding: 15px 5px;
            }
            
            .brand-logo {
                margin-right: 0;
            }
            
            .sidebar ul li a {
                padding: 15px;
                justify-content: center;
            }
            
            .sidebar ul li i {
                margin-right: 0;
                font-size: 1.3rem;
            }
            
            .main {
                margin-left: 70px;
                padding: 20px;
            }
        }

        @media (max-width: 576px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .header-actions {
                margin-top: 15px;
            }
            
            .settings-tabs {
                overflow-x: auto;
                white-space: nowrap;
            }
            
            .tab-item {
                padding: 15px;
            }
            
            .settings-form {
                padding: 20px;
            }
        }
    </style>
</head>
<body class="<?= $user['theme']; ?>">

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="brand-container">
            <div class="brand-logo">
                <i class="fas fa-heartbeat"></i>
            </div>
            <div class="brand-name">HeartCare</div>
        </div>
        
        <div class="menu-container">
            <div class="menu-label">Main Menu</div>
            <ul>
                <li class="active"><a href="doctor_dashboard.php"><i class="fas fa-chart-line"></i> <span>Dashboard</span></a></li>
                <li><a href="doctor_checks.php"><i class="fas fa-calendar-check"></i> <span>Checks</span></a></li>
                <li><a href="doctor_patients.php"><i class="fas fa-user-injured"></i> <span>Patients</span></a></li>
                <li><a href="doctor_setting.php"><i class="fas fa-cog"></i> <span>Settings</span></a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
            </ul>
        </div>

    </div>

    <!-- Main Content -->
    <div class="main">
        <div class="header">
            <h1>Account Settings</h1>
            <div class="header-actions">
                <div class="profile-pic">
                    <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile">
                </div>
            </div>
        </div>

        <!-- Success/Error Messages -->
        <?php if (!empty($success_message)): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                <?= $success_message; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($error_message)): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i>
                <?= $error_message; ?>
            </div>
        <?php endif; ?>

        <div class="settings-container">
            <!-- Profile Card -->
            <div class="profile-card">
                <div class="avatar-container">
                    <img src="<?= $user['profile_picture']; ?>" alt="Profile Picture" class="avatar">
                </div>
                <h2 class="doctor-name">Dr. <?= $user['username']; ?></h2>
                <div class="doctor-id">ID: <?= $user['doctor_id']; ?></div>
                
                <div class="theme-toggle">
                    <span class="theme-label">Dark Mode</span>
                    <label class="theme-switch">
                        <input type="checkbox" id="theme-toggle-checkbox" <?= $user['theme'] == 'dark' ? 'checked' : ''; ?>>
                        <span class="slider">
                            <div class="slider-icons">
                                <i class="fas fa-sun"></i>
                                <i class="fas fa-moon"></i>
                            </div>
                        </span>
                    </label>
                </div>
                
                <div class="doctor-stats">
                    <div class="stat-card">
                        <div class="stat-value">42</div>
                        <div class="stat-label">Patients</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-value">126</div>
                        <div class="stat-label">Tests</div>
                    </div>
                </div>
            </div>

            <!-- Settings Form -->
            <div class="settings-form-container">
                <div class="settings-tabs">
                    <div class="tab-item active">Account Settings</div>
                </div>
                
                <form class="settings-form" method="POST" action="doctor_setting.php" enctype="multipart/form-data">
                    <!-- Change Username -->
                    <div class="form-group">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?= $user['username']; ?>" required>
                    </div>

                    <!-- Change Theme -->
                    <div class="form-group">
                        <label for="theme" class="form-label">Theme Preference</label>
                        <select name="theme" id="theme" class="form-control form-select">
                            <option value="light" <?= $user['theme'] == 'light' ? 'selected' : ''; ?>>Light Mode</option>
                            <option value="dark" <?= $user['theme'] == 'dark' ? 'selected' : ''; ?>>Dark Mode</option>
                        </select>
                    </div>

                    <!-- Profile Picture Upload -->
                    <div class="form-group">
                        <label class="form-label">Profile</label>
                        <div class="custom-file-input">
                            <label for="profile_picture" class="custom-file-label">
                                <i class="fas fa-cloud-upload-alt"></i> Choose Image
                            </label>
                            <input type="file" name="profile_picture" id="profile_picture" accept="image/*">
                        </div>
                        <div class="file-name" id="file-name">No file chosen</div>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Toggle theme
        document.getElementById('theme-toggle-checkbox').addEventListener('change', function() {
            if (this.checked) {
                document.body.classList.add('dark');
                document.body.classList.remove('light');
                document.getElementById('theme').value = 'dark';
            } else {
                document.body.classList.add('light');
                document.body.classList.remove('dark');
                document.getElementById('theme').value = 'light';
            }
        });

        // Show file name when user selects a file
        document.getElementById('profile_picture').addEventListener('change', function() {
            var fileName = this.files[0] ? this.files[0].name : 'No file chosen';
            document.getElementById('file-name').textContent = fileName;
        });

        // Fix theme update issue
        document.addEventListener('DOMContentLoaded', function() {
            // Add missing statement for theme update
            const themeUpdateStmt = `
                $stmt = $pdo->prepare("UPDATE doctors SET theme = :theme WHERE doctor_id = :doctor_id");
                $stmt->bindParam(':theme', $new_theme);
            `;
            
            // This is just for reference - the PHP code would need to be updated in the actual file
        });
    </script>
</body>
</html>