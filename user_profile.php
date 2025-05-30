<?php
// Start session
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$db_host = "localhost";
$db_user = "root"; // Change as needed
$db_pass = ""; // Change as needed
$db_name = "heartcare_connect";

$conn = new mysqli($db_host, $db_user, $db_pass, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$user_query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($user_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user_result = $stmt->get_result();
$user = $user_result->fetch_assoc();
$stmt->close();

// Process profile update form
if (isset($_POST['update_profile'])) {
    $first_name = $conn->real_escape_string($_POST['first_name']);
    $last_name = $conn->real_escape_string($_POST['last_name']);
    $username = $conn->real_escape_string($_POST['username']);
    
    // Check if username already exists (except for the current user)
    $check_username = "SELECT id FROM users WHERE username = ? AND id != ?";
    $stmt = $conn->prepare($check_username);
    $stmt->bind_param("si", $username, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $update_error = "Username already exists. Please choose another.";
    } else {
        // Process image upload if there is one
        $user_profile = $user['user_profile']; // Keep existing by default
        
        if (isset($_FILES['user_profile']) && $_FILES['user_profile']['size'] > 0) {
            $target_dir = "uploads/";
            
            // Create directory if it doesn't exist
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
            
            $file_extension = pathinfo($_FILES["user_profile"]["name"], PATHINFO_EXTENSION);
            $new_filename = "profile_" . $user_id . "_" . time() . "." . $file_extension;
            $target_file = $target_dir . $new_filename;
            
            $upload_ok = true;
            $image_file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            // Check if image file is an actual image
            $check = getimagesize($_FILES["user_profile"]["tmp_name"]);
            if ($check === false) {
                $update_error = "File is not an image.";
                $upload_ok = false;
            }
            
            // Check file size (limit to 5MB)
            if ($_FILES["user_profile"]["size"] > 5000000) {
                $update_error = "Sorry, your file is too large.";
                $upload_ok = false;
            }
            
            // Allow certain file formats
            if ($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg" && $image_file_type != "gif") {
                $update_error = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $upload_ok = false;
            }
            
            // If everything is ok, try to upload file
            if ($upload_ok) {
                if (move_uploaded_file($_FILES["user_profile"]["tmp_name"], $target_file)) {
                    // If there was an old profile picture, delete it (except the default one)
                    if (!empty($user['user_profile']) && $user['user_profile'] != "default.png" && file_exists("uploads/" . $user['user_profile'])) {
                        unlink("uploads/" . $user['user_profile']);
                    }
                    $user_profile = $new_filename;
                } else {
                    $update_error = "Sorry, there was an error uploading your file.";
                }
            }
        }
        
        if (!isset($update_error)) {
            // Update user information
            $update_query = "UPDATE users SET first_name = ?, last_name = ?, username = ?, user_profile = ? WHERE id = ?";
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param("ssssi", $first_name, $last_name, $username, $user_profile, $user_id);
            
            if ($stmt->execute()) {
                $update_success = "Profile updated successfully!";
                // Update session data
                $_SESSION['username'] = $username;
                $_SESSION['user_profile'] = $user_profile;

                
                // Refresh user data
                $stmt = $conn->prepare($user_query);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $user_result = $stmt->get_result();
                $user = $user_result->fetch_assoc();
            } else {
                $update_error = "Error updating profile: " . $conn->error;
            }
            $stmt->close();
        }
    }
}

// Get symptoms for the user
$symptoms_query = "SELECT * FROM symptoms WHERE user_id = ? ORDER BY created_at DESC";
$stmt = $conn->prepare($symptoms_query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$symptoms_result = $stmt->get_result();
$symptoms = [];
while ($row = $symptoms_result->fetch_assoc()) {
    $symptoms[] = $row;
}
$stmt->close();

// Active tab handling
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'profile';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - HeartCare Connect</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #eef2f7 100%);
            color: #2c3e50;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
        }
        
        .container {
            margin-top: 40px;
            margin-bottom: 60px;
            max-width: 1200px;
        }
        
        .profile-card {
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
            padding: 35px;
            margin-bottom: 30px;
            transition: transform 0.3s ease;
        }
        
        .profile-card:hover {
            transform: translateY(-5px);
        }
        
        .profile-header {
            display: flex;
            align-items: center;
            margin-bottom: 40px;
            padding: 20px;
            background: linear-gradient(135deg, #f8f9fa 0%, #f1f4f8 100%);
            border-radius: 15px;
        }
        
        .profile-image {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            border: 6px solid #ffffff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s ease;
        }
        
        .profile-image:hover {
            transform: scale(1.05);
        }
        
        .profile-info {
            margin-left: 40px;
            padding: 20px;
        }
        
        .profile-info h1 {
            font-size: 2.5rem;
            color: #1a237e;
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .nav-tabs {
            border-bottom: 2px solid #e9ecef;
            margin-bottom: 25px;
        }
        
        .nav-tabs .nav-link {
            font-weight: 600;
            font-size: 1.1rem;
            color: #6c757d;
            border: none;
            padding: 15px 30px;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .nav-tabs .nav-link.active {
            color: #0d6efd;
            background-color: transparent;
            border-bottom: 3px solid #0d6efd;
        }
        
        .nav-tabs .nav-link:hover:not(.active) {
            color: #0d6efd;
            border-bottom: 3px solid #e1e1e1;
            background-color: rgba(13, 110, 253, 0.05);
        }
        
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
        }
        
        .btn-heartcare {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            color: white;
            border-radius: 30px;
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }
        
        .btn-heartcare:hover {
            background: linear-gradient(135deg, #0b5ed7 0%, #0a58ca 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.2);
            color: white;
        }
        
        .table {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .symptom-table th {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.9rem;
            padding: 15px;
        }
        
        .symptom-row {
            transition: all 0.3s ease;
        }
        
        .symptom-row:hover {
            background-color: #f8f9fa;
            transform: scale(1.01);
        }
        
        .good-status {
            color: #198754;
            font-weight: 600;
            background-color: rgba(25, 135, 84, 0.1);
            padding: 5px 10px;
            border-radius: 20px;
        }
        
        .bad-status {
            color: #dc3545;
            font-weight: 600;
            background-color: rgba(220, 53, 69, 0.1);
            padding: 5px 10px;
            border-radius: 20px;
        }
        
        .alert {
            border-radius: 15px;
            border: none;
            padding: 15px 20px;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }
        
        .form-label {
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }
        
        .text-muted {
            color: #6c757d !important;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="profile-card">
                    <div class="profile-header">
                        <img src="<?php echo !empty($user['user_profile']) ? 'uploads/' . $user['user_profile'] : 'uploads/default.png'; ?>" 
                             alt="Profile Picture" class="profile-image">
                        <div class="profile-info">
                            <h1><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></h1>
                            <p class="text-muted">@<?php echo $user['username']; ?></p>
                        </div>
                    </div>
                    
                    <ul class="nav nav-tabs" id="profileTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link <?php echo ($active_tab == 'profile') ? 'active' : ''; ?>" 
                               id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" 
                               aria-controls="profile" aria-selected="<?php echo ($active_tab == 'profile') ? 'true' : 'false'; ?>">
                               <i class="fas fa-user-edit me-2"></i>Edit Profile
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link <?php echo ($active_tab == 'symptoms') ? 'active' : ''; ?>" 
                               id="symptoms-tab" data-bs-toggle="tab" href="#symptoms" role="tab" 
                               aria-controls="symptoms" aria-selected="<?php echo ($active_tab == 'symptoms') ? 'true' : 'false'; ?>">
                               <i class="fas fa-heartbeat me-2"></i>Health Records
                            </a>
                        </li>
                    </ul>
                    
                    <div class="tab-content" id="profileTabsContent">
                        <!-- Profile Tab -->
                        <div class="tab-pane fade <?php echo ($active_tab == 'profile') ? 'show active' : ''; ?>" 
                             id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <?php if (isset($update_success)): ?>
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            <i class="fas fa-check-circle me-2"></i> <?php echo $update_success; ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <?php if (isset($update_error)): ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <i class="fas fa-exclamation-triangle me-2"></i> <?php echo $update_error; ?>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    <?php endif; ?>
                                    
                                    <form action="user_profile.php?tab=profile" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="first_name"><i class="fas fa-user me-2"></i>First Name</label>
                                                    <input type="text" class="form-control" id="first_name" name="first_name" 
                                                           value="<?php echo $user['first_name']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="last_name"><i class="fas fa-user me-2"></i>Last Name</label>
                                                    <input type="text" class="form-control" id="last_name" name="last_name" 
                                                           value="<?php echo $user['last_name']; ?>" required>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="username"><i class="fas fa-at me-2"></i>Username</label>
                                            <input type="text" class="form-control" id="username" name="username" 
                                                   value="<?php echo $user['username']; ?>" required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="user_profile"><i class="fas fa-image me-2"></i>Profile Picture</label>
                                            <input type="file" class="form-control" id="user_profile" name="user_profile">
                                            <small class="form-text text-muted">Leave empty to keep current image. Accepted formats: JPG, JPEG, PNG, GIF. Max size: 5MB.</small>
                                        </div>
                                        
                                        <button type="submit" name="update_profile" class="btn btn-heartcare mt-3">
                                            <i class="fas fa-save me-2"></i>Save Changes
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Symptoms Tab -->
                        <div class="tab-pane fade <?php echo ($active_tab == 'symptoms') ? 'show active' : ''; ?>" 
                             id="symptoms" role="tabpanel" aria-labelledby="symptoms-tab">
                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <!-- Display symptoms history -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h4><i class="fas fa-history me-2"></i>Health Records History</h4>
                                        </div>
                                        <div class="card-body">
                                            <?php if (count($symptoms) > 0): ?>
                                                <div class="table-responsive">
                                                    <table class="table table-hover symptom-table">
                                                        <thead>
                                                            <tr>
                                                                <th>Record Name</th>
                                                                <th>Date</th>
                                                                <th>Height (cm)</th>
                                                                <th>Weight (kg)</th>
                                                                <th>BMI</th>
                                                                <th>Condition</th>
                                                                <th>Heart Symptoms</th>
                                                                <th>Notes</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php foreach ($symptoms as $symptom): ?>
                                                                <?php 
                                                                    // Calculate BMI
                                                                    $height_m = $symptom['height'] / 100; // Convert cm to m
                                                                    $bmi = $symptom['weight'] / ($height_m * $height_m);
                                                                    $bmi = round($bmi, 2);
                                                                    
                                                                    // Determine BMI status
                                                                    $bmi_status = '';
                                                                    if ($bmi < 18.5) {
                                                                        $bmi_status = 'Underweight';
                                                                    } elseif ($bmi >= 18.5 && $bmi < 25) {
                                                                        $bmi_status = 'Normal';
                                                                    } elseif ($bmi >= 25 && $bmi < 30) {
                                                                        $bmi_status = 'Overweight';
                                                                    } else {
                                                                        $bmi_status = 'Obese';
                                                                    }
                                                                    
                                                                    // Determine condition status class
                                                                    $condition_class = '';
                                                                    if ($symptom['condition_status'] == 'Good') {
                                                                        $condition_class = 'good-status';
                                                                    } elseif ($symptom['condition_status'] == 'Bad' || $symptom['condition_status'] == 'Critical') {
                                                                        $condition_class = 'bad-status';
                                                                    }
                                                                ?>
                                                                <tr class="symptom-row">
                                                                    <td><?php echo $symptom['name']; ?></td>
                                                                    <td><?php echo date('M d, Y', strtotime($symptom['checkup_date'])); ?></td>
                                                                    <td><?php echo $symptom['height']; ?></td>
                                                                    <td><?php echo $symptom['weight']; ?></td>
                                                                    <td><?php echo $bmi . ' (' . $bmi_status . ')'; ?></td>
                                                                    <td class="<?php echo $condition_class; ?>"><?php echo $symptom['condition_status']; ?></td>
                                                                    <td><?php echo $symptom['additional_symptoms'] ? $symptom['additional_symptoms'] : 'None'; ?></td>
                                                                    <td><?php echo $symptom['notes'] ? $symptom['notes'] : 'No notes'; ?></td>
                                                                </tr>
                                                            <?php endforeach; ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            <?php else: ?>
                                                <div class="alert alert-info" role="alert">
                                                    <i class="fas fa-info-circle me-2"></i> No health records found. Add your first record using the form above.
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Initialize tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
        
        // Set active tab based on URL parameter
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab');
            
            if (tab) {
                const triggerEl = document.querySelector('#profileTabs a[href="#' + tab + '"]');
                if (triggerEl) {
                    bootstrap.Tab.getInstance(triggerEl).show();
                }
            }
        });
    </script>
</body>
</html>