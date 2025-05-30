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

// Fetch user info from session
$user = [
    'doctor_id' => $_SESSION['doctor_id'],
    'username' => $_SESSION['username'],
    'profile_picture' => $_SESSION['profile_picture'] ?? 'default-avatar.png',
    'theme' => $_SESSION['theme'] ?? 'light'
];

// Fetch additional statistics for the updated dashboard
try {
    // Count total patients
    $stmt = $pdo->prepare("SELECT 
        COUNT(*) as total_patients,
        SUM(CASE WHEN risk_level = 'high' THEN 1 ELSE 0 END) as high_risk,
        SUM(CASE WHEN risk_level = 'medium' THEN 1 ELSE 0 END) as medium_risk,
        SUM(CASE WHEN risk_level = 'low' THEN 1 ELSE 0 END) as low_risk
        FROM patients WHERE doctor_id = :doctor_id");
    $stmt->bindParam(':doctor_id', $_SESSION['doctor_id']);
    $stmt->execute();
    $patientStats = $stmt->fetch(PDO::FETCH_ASSOC);

    // Get today's checks count
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM checks 
        WHERE doctor_id = :doctor_id 
        AND DATE(check_date) = CURDATE()");
    $stmt->bindParam(':doctor_id', $_SESSION['doctor_id']);
    $stmt->execute();
    $todayChecks = $stmt->fetchColumn();

    // Get pending symptoms reports
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM symptoms 
        WHERE condition_status IS NULL 
        AND user_id IN (SELECT patient_id FROM patients WHERE doctor_id = :doctor_id)");
    $stmt->bindParam(':doctor_id', $_SESSION['doctor_id']);
    $stmt->execute();
    $pendingReports = $stmt->fetchColumn();

    // Get recent symptoms with patient info
    $stmt = $pdo->prepare("SELECT s.*, p.first_name, p.last_name, p.profile_picture 
        FROM symptoms s
        JOIN patients p ON s.user_id = p.patient_id
        WHERE p.doctor_id = :doctor_id 
        ORDER BY s.created_at DESC LIMIT 5");
    $stmt->bindParam(':doctor_id', $_SESSION['doctor_id']);
    $stmt->execute();
    $recentSymptoms = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Set default values if query fails
    $patientStats = [
        'total_patients' => 0,
        'high_risk' => 0,
        'medium_risk' => 0,
        'low_risk' => 0
    ];
    $todayChecks = 0;
    $pendingReports = 0;
    $recentSymptoms = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - HeartCare Connect</title>
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

        /* Dashboard specific styles */
        .welcome-banner {
            background: linear-gradient(90deg, var(--primary-color), var(--accent-color));
            color: var(--text-light);
            border-radius: var(--border-radius);
            padding: 30px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow-light);
        }

        body.dark .welcome-banner {
            background: linear-gradient(90deg, #2b2d42, #3a76c4);
            box-shadow: var(--shadow-dark);
        }

        .welcome-content h2 {
            font-size: 1.8rem;
            margin-bottom: 10px;
        }

        .welcome-content p {
            font-size: 1rem;
            opacity: 0.9;
        }

        .welcome-image {
            width: 120px;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .welcome-image i {
            font-size: 5rem;
            color: rgba(255, 255, 255, 0.5);
        }

        .stats-container {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-box {
            background-color: var(--card-light);
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--shadow-light);
            transition: var(--transition);
            display: flex;
            flex-direction: column;
        }

        body.dark .stat-box {
            background-color: var(--card-dark);
            box-shadow: var(--shadow-dark);
        }

        .stat-box-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .stat-box-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        body.dark .stat-box-icon {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .stat-box-icon.patients {
            background-color: rgba(67, 97, 238, 0.15);
            color: var(--primary-color);
        }

        .stat-box-icon.checks {
            background-color: rgba(72, 149, 239, 0.15);
            color: var(--accent-color);
        }

        .stat-box-icon.high-risk {
            background-color: rgba(247, 37, 133, 0.15);
            color: var(--warning-color);
        }

        .stat-box-icon i {
            font-size: 1.5rem;
        }

        .stat-box-value {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 10px 0;
        }

        .stat-box-label {
            font-size: 1rem;
            opacity: 0.7;
        }

        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .dashboard-card {
            background-color: var(--card-light);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-light);
            overflow: hidden;
            transition: var(--transition);
        }

        body.dark .dashboard-card {
            background-color: var(--card-dark);
            box-shadow: var(--shadow-dark);
        }

        .dashboard-card-header {
            padding: 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        body.dark .dashboard-card-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .dashboard-card-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
        }

        body.dark .dashboard-card-title {
            color: var(--accent-color);
        }

        .dashboard-card-action {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }

        body.dark .dashboard-card-action {
            color: var(--accent-color);
        }

        .dashboard-card-content {
            padding: 20px;
        }

        .patient-list, .check-list {
            list-style: none;
        }

        .patient-item, .check-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        body.dark .patient-item, body.dark .check-item {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .patient-item:last-child, .check-item:last-child {
            border-bottom: none;
        }

        .patient-avatar, .check-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        body.dark .patient-avatar, body.dark .check-avatar {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .patient-avatar img, .check-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .patient-info, .check-info {
            flex: 1;
        }

        .patient-name, .check-patient {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .patient-details, .check-date {
            font-size: 0.9rem;
            opacity: 0.7;
        }

        .patient-risk {
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .risk-low {
            background-color: rgba(76, 201, 240, 0.15);
            color: var(--success-color);
        }

        .risk-medium {
            background-color: rgba(255, 183, 3, 0.15);
            color: #ffb703;
        }

        .risk-high {
            background-color: rgba(247, 37, 133, 0.15);
            color: var(--warning-color);
        }

        .check-time {
            font-weight: 600;
            color: var(--primary-color);
        }

        body.dark .check-time {
            color: var(--accent-color);
        }

        .no-data {
            text-align: center;
            padding: 30px 0;
            opacity: 0.6;
        }

        .no-data i {
            font-size: 3rem;
            margin-bottom: 15px;
        }

        /* Mobile responsive */
        @media (max-width: 992px) {
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .dashboard-cards {
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
            
            .welcome-banner {
                flex-direction: column;
                text-align: center;
            }
            
            .welcome-image {
                margin-top: 20px;
            }
        }

        @media (max-width: 576px) {
            .stats-container {
                grid-template-columns: 1fr;
            }
            
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .header-actions {
                margin-top: 15px;
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
            <h1>Dashboard</h1>
            <div class="header-actions">
                <div class="profile-pic">
                    <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile">
                </div>
            </div>
        </div>

        <!-- Welcome Banner -->
        <div class="welcome-banner">
            <div class="welcome-content">
                <h2>Welcome back, Dr. <?= $user['username']; ?>!</h2>
                <p>Here's an overview of your patients and upcoming checks.</p>
            </div>
            <div class="welcome-image">
                <i class="fas fa-stethoscope"></i>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="stats-container">
            <div class="stat-box">
                <div class="stat-box-header">
                    <div class="stat-box-icon patients">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="stat-box-value"><?= $patientStats['total_patients']; ?></div>
                <div class="stat-box-label">Total Patients</div>
            </div>
            
            <div class="stat-box">
                <div class="stat-box-header">
                    <div class="stat-box-icon checks">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                </div>
                <div class="stat-box-value"><?= $todayChecks; ?></div>
                <div class="stat-box-label">Today's Checks</div>
            </div>
            
            <div class="stat-box">
                <div class="stat-box-header">
                    <div class="stat-box-icon high-risk">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                </div>
                <div class="stat-box-value"><?= $pendingReports; ?></div>
                <div class="stat-box-label">Pending Reports</div>
            </div>
        </div>

        <div class="dashboard-cards">
            <!-- Recent Symptoms Reports -->
            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <div class="dashboard-card-title">Recent Symptoms Reports</div>
                    <a href="doctor_checks.php" class="dashboard-card-action">View All</a>
                </div>
                <div class="dashboard-card-content">
                    <?php if (!empty($recentSymptoms)): ?>
                        <ul class="check-list">
                            <?php foreach ($recentSymptoms as $symptom): ?>
                                <li class="check-item">
                                    <div class="check-avatar">
                                        <img src="<?= $symptom['profile_picture'] ?? 'default-avatar.png'; ?>" alt="Patient">
                                    </div>
                                    <div class="check-info">
                                        <div class="check-patient">
                                            <?= $symptom['first_name'] . ' ' . $symptom['last_name']; ?>
                                        </div>
                                        <div class="check-date">
                                            Reported: <?= date('M j, Y g:i A', strtotime($symptom['created_at'])); ?>
                                        </div>
                                    </div>
                                    <div class="status <?= getStatusClass($symptom['condition_status'] ?? 'pending'); ?>">
                                        <?= $symptom['condition_status'] ?? 'Pending'; ?>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <div class="no-data">
                            <i class="fas fa-notes-medical"></i>
                            <p>No recent symptoms reports</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Risk Distribution -->
            <div class="dashboard-card">
                <div class="dashboard-card-header">
                    <div class="dashboard-card-title">Patient Risk Distribution</div>
                    <a href="doctor_patients.php" class="dashboard-card-action">View All</a>
                </div>
                <div class="dashboard-card-content">
                    <ul class="patient-list">
                        <li class="patient-item">
                            <div class="patient-risk risk-high"></div>
                            <div class="patient-info">
                                <div class="patient-name">High Risk</div>
                                <div class="patient-details"><?= $patientStats['high_risk']; ?> patients</div>
                            </div>
                        </li>
                        <li class="patient-item">
                            <div class="patient-risk risk-medium"></div>
                            <div class="patient-info">
                                <div class="patient-name">Medium Risk</div>
                                <div class="patient-details"><?= $patientStats['medium_risk']; ?> patients</div>
                            </div>
                        </li>
                        <li class="patient-item">
                            <div class="patient-risk risk-low"></div>
                            <div class="patient-info">
                                <div class="patient-name">Low Risk</div>
                                <div class="patient-details"><?= $patientStats['low_risk']; ?> patients</div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Theme toggle functionality if needed
        document.addEventListener('DOMContentLoaded', function() {
            // You could add additional dashboard functionality here
            // For example, charts or interactive elements
        });
    </script>
</body>
</html>