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

// Add this code after database connection
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_condition'])) {
    try {
        $sql = "UPDATE symptoms SET condition_status = ? WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST['condition'], $_POST['symptom_id']]);
        echo "success";
        exit;
    } catch(PDOException $e) {
        echo "error";
        exit;
    }
}

// Fetch all symptoms
try {
    $sql = "SELECT s.*, u.username as patient_name 
            FROM symptoms s
            JOIN users u ON s.user_id = u.id
            ORDER BY s.created_at DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $symptoms = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    $symptoms = [];
    $error = $e->getMessage();
}

// Get symptoms statistics
$total_symptoms = count($symptoms);
$critical = 0;
$moderate = 0;
$normal = 0;

if ($total_symptoms > 0) {
    foreach ($symptoms as $symptom) {
        $condition = strtolower($symptom['condition_status'] ?? 'normal');
        
        if ($condition == 'critical') {
            $critical++;
        } elseif ($condition == 'moderate') {
            $moderate++;
        } else {
            $normal++;
        }
    }
}

// Get theme preference from session
$theme = $_SESSION['theme'] ?? 'light';

// Add this helper function before the HTML:
function getStatusClass($condition) {
    switch(strtolower($condition ?? '')) {
        case 'critical':
            return 'cancelled';
        case 'moderate':
            return 'pending';
        default:
            return 'completed';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Check-ups - HeartCare Connect</title>
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

        .search-bar {
            width: 300px;
            padding: 12px 15px;
            border: 1px solid #ced4da;
            border-radius: var(--border-radius);
            font-size: 0.9rem;
            transition: var(--transition);
            background-color: var(--bg-light);
            color: var (--text-dark);
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

        /* Stats Cards */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background-color: var(--card-light);
            border-radius: var(--border-radius);
            padding: 20px;
            box-shadow: var(--shadow-light);
            transition: var (--transition);
            text-align: center;
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

        .stat-card.yellow {
            border-top: 4px solid var(--warning-color);
        }

        .stat-card.red {
            border-top: 4px solid var(--danger-color);
        }

        .stat-card h3 {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 15px;
        }

        body.dark .stat-card h3 {
            color: #a0aec0;
        }

        .stat-card p {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        body.dark .stat-card p {
            color: var(--accent-color);
        }

        .stat-card.blue p {
            color: var(--primary-color);
        }

        .stat-card.green p {
            color: var(--success-color);
        }

        .stat-card.yellow p {
            color: var(--warning-color);
        }

        .stat-card.red p {
            color: var(--danger-color);
        }

        /* Check-ups List Card */
        .card {
            background-color: var(--card-light);
            border-radius: var(--border-radius);
            box-shadow: var(--shadow-light);
            margin-bottom: 30px;
            overflow: hidden;
        }

        body.dark .card {
            background-color: var(--card-dark);
            box-shadow: var(--shadow-dark);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
        }

        body.dark .card-header {
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .card-header h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--text-dark);
        }

        body.dark .card-header h2 {
            color: var(--text-light);
        }

        .btn {
            padding: 10px 20px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: var (--border-radius);
            cursor: pointer;
            font-weight: 500;
            font-size: 0.9rem;
            display: inline-flex;
            align-items: center;
            transition: var(--transition);
        }

        .btn i {
            margin-right: 8px;
        }

        .btn:hover {
            background-color: var(--secondary-color);
        }

        body.dark .btn {
            background-color: var(--accent-color);
        }

        body.dark .btn:hover {
            background-color: #3a76c4;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        body.dark th, 
        body.dark td {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        th {
            font-weight: 600;
            color: #6c757d;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        body.dark th {
            color: #a0aec0;
        }

        tbody tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }

        body.dark tbody tr:hover {
            background-color: rgba(72, 149, 239, 0.05);
        }

        /* Status Tags */
        .status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 30px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status.pending {
            background-color: rgba(251, 188, 5, 0.2);
            color: #fb8c00;
        }

        .status.completed {
            background-color: rgba(76, 201, 240, 0.2);
            color: #4cc9f0;
        }

        .status.cancelled {
            background-color: rgba(247, 37, 133, 0.2);
            color: #f72585;
        }

        body.dark .status.pending {
            background-color: rgba(251, 188, 5, 0.15);
            color: #ffb74d;
        }

        body.dark .status.completed {
            background-color: rgba(76, 201, 240, 0.15);
            color: #81d4fa;
        }

        body.dark .status.cancelled {
            background-color: rgba(247, 37, 133, 0.15);
            color: #f48fb1;
        }

        /* Action Buttons */
        .action-btn {
            background: transparent;
            border: none;
            font-size: 1rem;
            cursor: pointer;
            margin-right: 10px;
            color: #6c757d;
            transition: var(--transition);
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        body.dark .action-btn {
            color: #a0aec0;
        }

        .action-btn:hover {
            background-color: rgba(67, 97, 238, 0.1);
        }

        .view-btn:hover {
            color: var(--primary-color);
        }

        .edit-btn:hover {
            color: var(--success-color);
        }

        .delete-btn:hover {
            color: var(--warning-color);
        }

        body.dark .view-btn:hover {
            color: var(--accent-color);
        }

        body.dark .edit-btn:hover {
            color: var(--success-color);
        }

        body.dark .delete-btn:hover {
            color: var(--warning-color);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 50px 20px;
        }

        .empty-state i {
            font-size: 5rem;
            color: #ced4da;
            margin-bottom: 20px;
        }

        body.dark .empty-state i {
            color: #2d3748;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: var(--text-dark);
        }

        body.dark .empty-state h3 {
            color: var(--text-light);
        }

        .empty-state p {
            color: #6c757d;
            margin-bottom: 20px;
        }

        body.dark .empty-state p {
            color: #a0aec0;
        }

        .notes-cell {
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
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
            
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .search-bar {
                width: 100%;
                margin-top: 15px;
            }
        }

        @media (max-width: 576px) {
            .stats {
                grid-template-columns: 1fr;
            }
            
            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .card-header .btn {
                margin-top: 15px;
            }
            
            table {
                display: block;
                overflow-x: auto;
            }
        }

        .condition-cell {
            min-width: 150px;
        }

        .condition-display, .condition-edit {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .edit-condition-btn, .save-condition-btn {
            background: transparent;
            border: none;
            cursor: pointer;
            color: var(--primary-color);
            padding: 4px;
        }

        .condition-input {
            padding: 4px 8px;
            border: 1px solid var(--primary-color);
            border-radius: 4px;
            width: 100px;
        }
    </style>
</head>
<body class="<?= $theme; ?>">
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
                <li class="active"><a href="doctor_checks.php"><i class="fas fa-calendar-check"></i> <span>Checks</span></a></li>
                <li><a href="doctor_patients.php"><i class="fas fa-user-injured"></i> <span>Patients</span></a></li>
                <li><a href="doctor_setting.php"><i class="fas fa-cog"></i> <span>Settings</span></a></li>
                <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i> <span>Logout</span></a></li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main">
        <div class="header">
            <h1>Doctor Check-ups</h1>
            <div class="header-actions">
                <input type="text" class="search-bar" id="searchInput" placeholder="Search check-ups...">
                <div class="profile-pic">
                    <img src="<?php echo htmlspecialchars($_SESSION['profile_picture'] ?? 'default-avatar.png'); ?>" alt="Profile">
                </div>
            </div>
        </div>
        
        <div class="stats">
            <div class="stat-card blue">
                <h3>Total Reports</h3>
                <p><?php echo $total_symptoms; ?></p>
            </div>
            <div class="stat-card red">
                <h3>Critical</h3>
                <p><?php echo $critical; ?></p>
            </div>
            <div class="stat-card yellow">
                <h3>Moderate</h3>
                <p><?php echo $moderate; ?></p>
            </div>
            <div class="stat-card green">
                <h3>Normal</h3>
                <p><?php echo $normal; ?></p>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <h2>Symptoms Reports</h2>
            </div>
            
            <?php if (!empty($symptoms)): ?>
                <div style="overflow-x: auto;">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Patient</th>
                                <th>Name</th>
                                <th>Height</th>
                                <th>Weight</th>
                                <th>Checkup Date</th>
                                <th>Additional Symptoms</th>
                                <th>Date Created</th>
                                <th>Result</th>
                            </tr>
                        </thead>
                        <tbody id="symptomsTableBody">
                            <?php foreach ($symptoms as $symptom): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($symptom['id']); ?></td>
                                    <td><?php echo htmlspecialchars($symptom['patient_name']); ?></td>
                                    <td><?php echo htmlspecialchars($symptom['name'] ?? 'N/A'); ?></td>
                                    <td><?php echo htmlspecialchars($symptom['height'] ?? 'N/A'); ?></td>
                                    <td><?php echo htmlspecialchars($symptom['weight'] ?? 'N/A'); ?></td>
                                    <td><?php echo htmlspecialchars($symptom['checkup_date'] ?? 'N/A'); ?></td>
                                    <td class="notes-cell"><?php echo htmlspecialchars($symptom['additional_symptoms'] ?? 'None'); ?></td>
                                    <td><?php echo date('M d, Y H:i', strtotime($symptom['created_at'])); ?></td>
                                    <td class="condition-cell">
                                        <div class="condition-display">
                                            <span class="status <?php echo getStatusClass($symptom['condition_status']); ?>">
                                                <?php echo htmlspecialchars($symptom['condition_status'] ?? 'Not Set'); ?>
                                            </span>
                                            <button class="edit-condition-btn" onclick="editCondition(this, <?php echo $symptom['id']; ?>)">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        </div>
                                        <div class="condition-edit" style="display:none;">
                                            <input type="text" class="condition-input" value="<?php echo htmlspecialchars($symptom['condition_status'] ?? ''); ?>">
                                            <button class="save-condition-btn" onclick="saveCondition(this, <?php echo $symptom['id']; ?>)">
                                                <i class="fas fa-save"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-notes-medical"></i>
                    <h3>No symptoms reports found</h3>
                    <p>
                        <?php if (isset($error)): ?>
                            There might be an issue with the database: <?php echo $error; ?>
                        <?php else: ?>
                            There are currently no symptoms reports in the database.
                        <?php endif; ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>

        <script>
            document.getElementById('searchInput').addEventListener('keyup', function() {
                const searchValue = this.value.toLowerCase();
                const tableRows = document.getElementById('symptomsTableBody').getElementsByTagName('tr');
                
                for (let i = 0; i < tableRows.length; i++) {
                    const patientName = tableRows[i].getElementsByTagName('td')[1].textContent.toLowerCase();
                    const riskLevel = tableRows[i].getElementsByTagName('td')[6].textContent.toLowerCase();
                    const date = tableRows[i].getElementsByTagName('td')[7].textContent.toLowerCase();
                    
                    if (patientName.includes(searchValue) || 
                        riskLevel.includes(searchValue) || 
                        date.includes(searchValue)) {
                        tableRows[i].style.display = '';
                    } else {
                        tableRows[i].style.display = 'none';
                    }
                }
            });

            function editCondition(btn, id) {
                const cell = btn.closest('.condition-cell');
                cell.querySelector('.condition-display').style.display = 'none';
                cell.querySelector('.condition-edit').style.display = 'flex';
            }

            function saveCondition(btn, id) {
                const cell = btn.closest('.condition-cell');
                const input = cell.querySelector('.condition-input');
                const condition = input.value.trim();
                
                fetch('doctor_checks.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `update_condition=1&symptom_id=${id}&condition=${condition}`
                })
                .then(response => response.text())
                .then(result => {
                    if (result === 'success') {
                        const statusSpan = cell.querySelector('.status');
                        statusSpan.textContent = condition;
                        statusSpan.className = `status ${getStatusClassJS(condition)}`;
                        cell.querySelector('.condition-display').style.display = 'flex';
                        cell.querySelector('.condition-edit').style.display = 'none';
                    } else {
                        alert('Failed to update condition');
                    }
                })
                .catch(error => {
                    alert('Error updating condition');
                });
            }

            function getStatusClassJS(condition) {
                switch(condition.toLowerCase()) {
                    case 'critical':
                        return 'cancelled';
                    case 'moderate':
                        return 'pending';
                    default:
                        return 'completed';
                }
            }
        </script>
    </div>
</body>
</html>