<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['doctor_id'])) {
    header("Location: doctor_login.php");
    exit;
}

// Database connection parameters
$host = "localhost";
$dbname = "heartcare_connect";
$username = "root"; // Change this to your actual database username
$password = ""; // Change this to your actual database password

// Establish database connection
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("ERROR: Could not connect. " . $e->getMessage());
}

// Fetch all users
try {
    $sql = "SELECT id, username, email FROM users";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("ERROR: Could not execute query. " . $e->getMessage());
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
    <title>Patient Management - HeartCare Connect</title>
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
            --bg-light: #f5f5f5;
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
            box-sizing: border-box;
            margin: 0;
            padding: 0;
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
        
        .search-bar {
            width: 300px;
            padding: 12px 15px;
            border: 1px solid #ced4da;
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
            background-color: var(--bg-light);
            color: var(--text-dark);
        }

        body.dark .search-bar {
            border-color: #2d3748;
            background-color: #2d3748;
            color: var(--text-light);
        }

        .search-bar:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 2px rgba(67, 97, 238, 0.2);
        }

        body.dark .search-bar:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 2px rgba(72, 149, 239, 0.2);
        }

        .profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            overflow: hidden;
            box-shadow: var(--shadow-light);
            cursor: pointer;
            margin-left: 20px;
        }

        body.dark .profile-pic {
            box-shadow: var(--shadow-dark);
        }

        .profile-pic img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Stats Cards */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background-color: var(--card-light);
            border-radius: var(--border-radius);
            padding: 25px;
            text-align: center;
            box-shadow: var(--shadow-light);
            transition: var(--transition);
        }
        
        body.dark .stat-card {
            background-color: var(--card-dark);
            box-shadow: var(--shadow-dark);
        }
        
        .stat-card.blue {
            border-top: 4px solid var(--primary-color);
        }
        
        .stat-card.green {
            border-top: 4px solid var(--success-color);
        }
        
        .stat-card.red {
            border-top: 4px solid var(--warning-color);
        }
        
        .stat-card h3 {
            font-size: 14px;
            color: #666;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        body.dark .stat-card h3 {
            color: #a0aec0;
        }
        
        .stat-card p {
            font-size: 28px;
            font-weight: bold;
            color: var(--text-dark);
        }
        
        body.dark .stat-card p {
            color: var(--text-light);
        }

        /* Patient Card */
        .patient-card {
            background-color: var(--card-light);
            border-radius: var(--border-radius);
            padding: 25px;
            box-shadow: var(--shadow-light);
            transition: var(--transition);
            margin-bottom: 30px;
        }
        
        body.dark .patient-card {
            background-color: var(--card-dark);
            box-shadow: var(--shadow-dark);
        }
        
        .patient-card h2 {
            margin-bottom: 20px;
            color: var(--primary-color);
            font-weight: 600;
        }
        
        body.dark .patient-card h2 {
            color: var(--accent-color);
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        body.dark th, body.dark td {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        th {
            background-color: rgba(67, 97, 238, 0.05);
            font-weight: 600;
            color: var(--primary-color);
        }
        
        body.dark th {
            background-color: rgba(72, 149, 239, 0.05);
            color: var(--accent-color);
        }
        
        tr:hover {
            background-color: rgba(67, 97, 238, 0.03);
        }
        
        body.dark tr:hover {
            background-color: rgba(72, 149, 239, 0.03);
        }
        
        .empty-state {
            text-align: center;
            padding: 40px;
            color: #666;
        }
        
        body.dark .empty-state {
            color: #a0aec0;
        }
        
        .empty-state i {
            font-size: 50px;
            margin-bottom: 20px;
            color: #ddd;
        }
        
        body.dark .empty-state i {
            color: #2d3748;
        }

        /* Mobile responsive */
        @media (max-width: 992px) {
            .stats {
                grid-template-columns: repeat(2, 1fr);
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
            
            .stats {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .header-actions {
                margin-top: 15px;
                width: 100%;
            }
            
            .search-bar {
                width: 100%;
            }
            
            .profile-pic {
                margin-left: auto;
                margin-top: 15px;
            }
            
            table {
                display: block;
                overflow-x: auto;
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
                <li><a href="doctor_dashboard.php"><i class="fas fa-chart-line"></i> <span>Dashboard</span></a></li>
                <li><a href="doctor_checks.php"><i class="fas fa-calendar-check"></i> <span>Checks</span></a></li>
                <li class="active"><a href="doctor_patients.php"><i class="fas fa-user-injured"></i> <span>Patients</span></a></li>
                <li><a href="doctor_setting.php"><i class="fas fa-cog"></i> <span>Settings</span></a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
            </ul>
        </div>

    </div>

    <!-- Main Content -->
    <div class="main">
        <div class="header">
            <h1>Patient Management</h1>
            <div class="header-actions">
                <input type="text" id="searchInput" class="search-bar" placeholder="Search patients...">
                <div class="profile-pic">
                    <img src="<?php echo htmlspecialchars($user['profile_picture']); ?>" alt="Profile">
                </div>
            </div>
        </div>
        
        <div class="stats">
            <div class="stat-card blue">
                <h3>Total Patients</h3>
                <p><?php echo count($users); ?></p>
            </div>
            <div class="stat-card green">
                <h3>Active Patients</h3>
                <p><?php echo count($users); ?></p>
            </div>
            <div class="stat-card red">
                <h3>New This Month</h3>
                <p>0</p>
            </div>
        </div>
        
        <div class="patient-card">
            <h2>Patient List</h2>
            <?php if (count($users) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody id="patientTableBody">
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['id']); ?></td>
                                <td><?php echo htmlspecialchars($user['username']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-user-slash"></i>
                    <h3>No patients found</h3>
                    <p>There are currently no patients in the database.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Simple search functionality
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const tableRows = document.getElementById('patientTableBody').getElementsByTagName('tr');
            
            for (let i = 0; i < tableRows.length; i++) {
                const username = tableRows[i].getElementsByTagName('td')[1].textContent.toLowerCase();
                const email = tableRows[i].getElementsByTagName('td')[2].textContent.toLowerCase();
                
                if (username.includes(searchValue) || email.includes(searchValue)) {
                    tableRows[i].style.display = '';
                } else {
                    tableRows[i].style.display = 'none';
                }
            }
        });
    </script>
</body>
</html>