<?php
session_start();

// If this is a form submission, handle and save to DB:
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ensure user is logged in
    if (empty($_SESSION['user_id'])) {
        die('<p>Please log in before submitting symptoms.</p>');
    }
    $user_id = $_SESSION['user_id'];

    // Include DB connection
    include 'db_config.php';
    if ($conn->connect_error) {
        die('<p>DB Connection failed: ' . htmlspecialchars($conn->connect_error) . '</p>');
    }

    // Sanitize inputs
    $name                = trim($_POST['name']                ?? '');
    $height              = trim($_POST['height']              ?? '');
    $weight              = trim($_POST['weight']              ?? '');
    $condition_status    = trim($_POST['condition_status']    ?? '');
    $checkup_date        = trim($_POST['checkup_date']        ?? '');
    $notes               = trim($_POST['notes']               ?? '');
    $additional_symptoms = trim($_POST['additional_symptoms'] ?? '');

    if (empty($checkup_date)) {
        $checkup_date = date('Y-m-d');
    }

    // Prepare and execute INSERT
    $sql = "
        INSERT INTO symptoms
          (user_id, name, height, weight, condition_status, checkup_date, notes, additional_symptoms, created_at, updated_at)
        VALUES
          (?,       ?,    ?,      ?,      ?,                ?,           ?,     ?,                   NOW(),      NOW())
    ";
    if (! $stmt = $conn->prepare($sql)) {
        die('<p>Prepare failed: ' . htmlspecialchars($conn->error) . '</p>');
    }
    $stmt->bind_param(
        'isssssss',
        $user_id,
        $name,
        $height,
        $weight,
        $condition_status,
        $checkup_date,
        $notes,
        $additional_symptoms
    );
    if (! $stmt->execute()) {
        die('<p>Error saving symptom check: ' . htmlspecialchars($stmt->error) . '</p>');
    }
    $stmt->close();
    $conn->close();

    echo '<p>Symptom check saved successfully! <a href="' . htmlspecialchars($_SERVER['PHP_SELF']) . '">Go back</a></p>';
    // after POST we show success and a link back; HTML form will render below
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heart Symptom Checker</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            color: #d9534f;
            margin-bottom: 20px;
            text-align: center;
        }
        h2, h3 {
            color: #d9534f;
            margin: 15px 0;
        }
        .section {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .symptom-section {
            margin-bottom: 25px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        textarea.form-control {
            resize: vertical;
        }
        .checkbox-group, .radio-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 5px;
        }
        .checkbox-item, .radio-item {
            display: flex;
            align-items: center;
            background: #f8f9fa;
            padding: 8px 12px;
            border-radius: 4px;
            border: 1px solid #e9ecef;
            cursor: pointer;
        }
        .checkbox-item:hover, .radio-item:hover {
            background: #e9ecef;
        }
        .checkbox-item input, .radio-item input {
            margin-right: 5px;
        }
        .form-row {
            display: flex;
            gap: 15px;
        }
        .form-row .form-group {
            flex: 1;
        }
        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            background: #d9534f;
            color: white;
            cursor: pointer;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }
        .btn:hover {
            background: #c9302c;
        }
        .btn-outline {
            background: transparent;
            border: 1px solid #d9534f;
            color: #d9534f;
        }
        .btn-outline:hover {
            background: #f8d7da;
        }
        .btn-prev {
            background: #6c757d;
        }
        .btn-prev:hover {
            background: #5a6268;
        }
        .progress-container {
            height: 8px;
            background: #e9ecef;
            border-radius: 4px;
            margin-bottom: 20px;
            overflow: hidden;
        }
        .progress-bar {
            height: 100%;
            background: #d9534f;
            width: 0%;
            transition: width 0.3s ease;
        }
        .step-indicators {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1;
            position: relative;
        }
        .step-circle {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: #e9ecef;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #adb5bd;
            font-weight: bold;
            z-index: 2;
        }
        .step.active .step-circle {
            background: #d9534f;
            color: white;
        }
        .step-label {
            margin-top: 8px;
            font-size: 14px;
        }
        /* Enhanced Result Styles */
.symptom-result {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    padding: 25px;
    transition: all 0.3s ease;
}

.result-heading {
    color: #d9534f;
    margin-bottom: 25px;
    text-align: center;
    font-size: 22px;
    font-weight: 600;
}

.risk-meter {
    padding: 25px;
    background: #f8f9fa;
    border-radius: 12px;
    margin-bottom: 25px;
    text-align: center;
    border: 1px solid #e9ecef;
    position: relative;
}

.meter-container {
    background: #e9ecef;
    height: 25px;
    border-radius: 15px;
    margin: 25px 0;
    position: relative;
    overflow: hidden;
    box-shadow: inset 0 2px 3px rgba(0,0,0,0.1);
}

.meter-bar {
    height: 100%;
    border-radius: 15px;
    transition: background 0.5s, width 0.5s;
    position: relative;
}

.meter-marker {
    position: absolute;
    top: -10px;
    transform: translateX(-50%);
    width: 12px;
    height: 45px;
    background: #333;
    border-radius: 6px;
    z-index: 2;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    transition: left 0.5s ease;
}

.meter-marker::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 50%;
    transform: translateX(-50%);
    width: 20px;
    height: 20px;
    background: #333;
    border-radius: 50%;
}

.meter-labels {
    display: flex;
    justify-content: space-between;
    margin-bottom: 15px;
    font-weight: 500;
}

.meter-result {
    font-size: 28px;
    font-weight: bold;
    margin-top: 20px;
    color: #d9534f;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
    letter-spacing: 1px;
}

.emergency-box {
    background: #f8d7da;
    border-left: 5px solid #d9534f;
    padding: 20px;
    margin-bottom: 25px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(217, 83, 79, 0.2);
}

.emergency-box h3 {
    color: #721c24;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.emergency-box p {
    color: #721c24;
}

.expandable-info {
    margin-bottom: 20px;
    border: 1px solid #e9ecef;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    transition: all 0.3s ease;
}

.expandable-info:hover {
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.expandable-header {
    background: #f8f9fa;
    padding: 15px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    font-weight: bold;
    color: #495057;
    transition: all 0.2s ease;
}

.expandable-header:hover {
    background: #e9ecef;
}

.expandable-content {
    padding: 20px;
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.5s ease;
    background: #fff;
}

.expandable-content ul {
    margin-left: 20px;
    margin-bottom: 15px;
}

.expandable-content li {
    margin-bottom: 10px;
    position: relative;
    padding-left: 5px;
}

.expandable-content li strong {
    color: #d9534f;
}

.result-actions {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-top: 30px;
    justify-content: center;
}

.btn {
    padding: 12px 25px;
    border: none;
    border-radius: 6px;
    background: #d9534f;
    color: white;
    cursor: pointer;
    font-weight: bold;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s ease;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.btn:hover {
    background: #c9302c;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
}

.btn-outline {
    background: transparent;
    border: 2px solid #d9534f;
    color: #d9534f;
}

.btn-outline:hover {
    background: #f8d7da;
}

/* Risk level color variants */
.risk-low .meter-result {
    color: #28a745;
}

.risk-moderate .meter-result {
    color: #ffc107;
}

.risk-high .meter-result {
    color: #d9534f;
}
        .step::before {
            content: '';
            position: absolute;
            top: 15px;
            left: 0;
            right: 0;
            height: 2px;
            background: #e9ecef;
            z-index: 1;
        }
        .step:first-child::before {
            left: 50%;
        }
        .step:last-child::before {
            right: 50%;
        }
        .range-slider {
            width: 100%;
        }
        .form-range {
            width: 100%;
        }
        .range-labels {
            display: flex;
            justify-content: space-between;
            margin-top: 5px;
            font-size: 14px;
            color: #6c757d;
        }
        .range-value {
            text-align: center;
            font-weight: bold;
            margin-top: 5px;
            color: #d9534f;
        }
        .results-loader {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 200px;
        }
        .loader {
            border: 5px solid #f3f3f3;
            border-top: 5px solid #d9534f;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin-bottom: 15px;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .symptom-result {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px;
        }
        .result-heading {
            color: #d9534f;
            margin-bottom: 20px;
            text-align: center;
        }
        .risk-meter {
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }
        .meter-container {
            background: #e9ecef;
            height: 20px;
            border-radius: 10px;
            margin: 20px 0;
            position: relative;
        }
        .meter-bar {
            height: 100%;
            border-radius: 10px;
            background: #6c757d;
            width: 100%;
        }
        .meter-marker {
            position: absolute;
            top: -10px;
            transform: translateX(-50%);
            width: 20px;
            height: 40px;
            background: #333;
            border-radius: 4px;
        }
        .meter-labels {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        .meter-result {
            font-size: 20px;
            font-weight: bold;
            margin-top: 10px;
            color: #d9534f;
        }
        .emergency-box {
            background: #f8d7da;
            border-left: 5px solid #d9534f;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .expandable-info {
            margin-bottom: 15px;
            border: 1px solid #e9ecef;
            border-radius: 4px;
            overflow: hidden;
        }
        .expandable-header {
            background: #f8f9fa;
            padding: 12px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            font-weight: bold;
        }
        .expandable-content {
            padding: 15px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
        .result-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
            justify-content: center;
        }
        .emergency-section {
            background: #f8d7da;
            border-left: 5px solid #d9534f;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
        }
        .emergency-list {
            margin-left: 20px;
            margin-top: 10px;
        }
        .emergency-list li {
            margin-bottom: 5px;
        }
        @media (max-width: 768px) {
            .form-row {
                flex-direction: column;
                gap: 0;
            }
            .form-actions {
                flex-direction: column;
                gap: 10px;
            }
            .btn {
                width: 100%;
            }
            .step-label {
                font-size: 12px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1><i class="fas fa-stethoscope"></i> Heart Symptom Checker</h1>
        
        <div class="section">
            <div class="emergency-section">
                <h2><i class="fas fa-exclamation-triangle"></i> Emergency Warning Signs</h2>
                <p><strong>Call emergency services (122) immediately if you experience:</strong></p>
                <ul class="emergency-list">
                    <li>Chest pain or discomfort that lasts more than a few minutes or goes away and comes back</li>
                    <li>Severe shortness of breath</li>
                    <li>Pain or discomfort in the jaw, neck, back, arm, or shoulder</li>
                    <li>Feeling weak, lightheaded, or faint</li>
                    <li>Cold sweat along with chest discomfort</li>
                </ul>
                <p><strong>Don't wait!</strong> Minutes matter in heart emergencies.</p>
            </div>
            
            <div id="symptom-checker-tool">
                <div class="progress-container">
                    <div class="progress-bar" id="progress-bar"></div>
                </div>
                
                <div class="step-indicators">
                    <div class="step active" id="step1">
                        <div class="step-circle">1</div>
                        <div class="step-label">Basic Info</div>
                    </div>
                    <div class="step" id="step2">
                        <div class="step-circle">2</div>
                        <div class="step-label">Symptoms</div>
                    </div>
                    <div class="step" id="step3">
                        <div class="step-circle">3</div>
                        <div class="step-label">Risk Factors</div>
                    </div>
                    <div class="step" id="step4">
                        <div class="step-circle">4</div>
                        <div class="step-label">Results</div>
                    </div>
                </div>
                
                <form id="symptom-form" method="post" action="">
                <input type="hidden" id="user_id" name="user_id" value="1">
                    <div class="form-content" id="form-step-1">
                        <div class="symptom-section">
                            <h3><i class="fas fa-user"></i> Basic Information</h3>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="age">Age</label>
                                    <input type="number" id="age" class="form-control" min="18" max="120" required>
                                </div>
                                <div class="form-group">
                                    <label for="height">height</label>
                                    <input type="number" id="height" class="form-control" min="60" max="500" required>
                                </div>
                                <div class="form-group">
                                    <label for="kg">Kg</label>
                                    <input type="number" id="kg" class="form-control" min="20" max="300" required>
                                </div>
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select id="gender" class="form-control" required>
                                        <option value="">Select</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label>Do you have any known heart conditions?</label>
                                <div class="radio-group">
                                    <label class="radio-item">
                                        <input type="radio" name="heart_condition" value="yes" required> Yes
                                    </label>
                                    <label class="radio-item">
                                        <input type="radio" name="heart_condition" value="no"> No
                                    </label>
                                    <label class="radio-item">
                                        <input type="radio" name="heart_condition" value="unsure"> Unsure
                                    </label>
                                </div>
                            </div>
                            
                            <div class="form-group heart-condition-details" style="display: none;">
                                <label for="condition_details">Please specify your heart condition(s):</label>
                                <textarea id="condition_details" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-next" data-next="2">Next: Symptoms <i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>
                    
                    <div class="form-content" id="form-step-2" style="display: none;">
                        <div class="symptom-section">
                            <h3><i class="fas fa-heartbeat"></i> Chest Symptoms</h3>
                            <div class="checkbox-group">
                                <label class="checkbox-item">
                                    <input type="checkbox" name="chest_pain" id="chest_pain"> Chest pain or discomfort
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="chest_pressure"> Pressure or tightness in chest
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="chest_burning"> Burning sensation in chest
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="chest_fullness"> Fullness or squeezing in chest
                                </label>
                            </div>
                            
                            <div class="chest-symptom-details" style="display: none;">
                                <div class="form-group">
                                    <label>If you have chest symptoms, where exactly?</label>
                                    <div class="checkbox-group">
                                        <label class="checkbox-item">
                                            <input type="checkbox" name="pain_left"> Left side of chest
                                        </label>
                                        <label class="checkbox-item">
                                            <input type="checkbox" name="pain_center"> Center of chest
                                        </label>
                                        <label class="checkbox-item">
                                            <input type="checkbox" name="pain_right"> Right side of chest
                                        </label>
                                        <label class="checkbox-item">
                                            <input type="checkbox" name="pain_upper"> Upper chest
                                        </label>
                                        <label class="checkbox-item">
                                            <input type="checkbox" name="pain_lower"> Lower chest
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>How long have you been experiencing chest symptoms?</label>
                                    <select class="form-control" name="chest_duration">
                                        <option value="">Select</option>
                                        <option value="less_than_5min">Less than 5 minutes</option>
                                        <option value="5_30min">5-30 minutes</option>
                                        <option value="30min_2hours">30 minutes to 2 hours</option>
                                        <option value="2_12hours">2-12 hours</option>
                                        <option value="12_24hours">12-24 hours</option>
                                        <option value="more_than_24hours">More than 24 hours</option>
                                        <option value="intermittent">Comes and goes</option>
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label>Rate the intensity of your chest symptoms:</label>
                                    <div class="range-slider">
                                        <input type="range" min="1" max="10" value="5" class="form-range" id="pain_intensity" name="pain_intensity">
                                        <div class="range-labels">
                                            <span>Mild</span>
                                            <span>Moderate</span>
                                            <span>Severe</span>
                                        </div>
                                    </div>
                                    <div class="range-value">5/10</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="symptom-section">
                            <h3><i class="fas fa-lungs"></i> Associated Symptoms</h3>
                            <div class="checkbox-group">
                                <label class="checkbox-item">
                                    <input type="checkbox" name="shortness_breath"> Shortness of breath
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="dizziness"> Dizziness or lightheadedness
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="fainting"> Fainting or almost fainting
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="sweating"> Cold sweat
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="nausea"> Nausea or vomiting
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="fatigue"> Unusual fatigue
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="pain_arm"> Pain in one or both arms
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="pain_jaw"> Pain in jaw or neck
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="pain_back"> Pain in back or shoulders
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="swelling"> Swelling in legs or feet
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="palpitations"> Heart palpitations
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="rapid_heartbeat"> Rapid heartbeat
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-prev" data-prev="1"><i class="fas fa-arrow-left"></i> Previous</button>
                            <button type="button" class="btn btn-next" data-next="3">Next: Risk Factors <i class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>
                    
                    <div class="form-content" id="form-step-3" style="display: none;">
                        <div class="symptom-section">
                            <h3><i class="fas fa-wind"></i> Symptom Triggers</h3>
                            <div class="form-group">
                                <label>Do your symptoms occur or worsen with:</label>
                                <div class="checkbox-group">
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="trigger_exertion"> Physical exertion
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="trigger_rest"> Rest
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="trigger_stress"> Emotional stress
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="trigger_eating"> After eating
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="trigger_lying"> Lying down
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="trigger_bending"> Bending over
                                    </label>
                                    <label class="checkbox-item">
                                        <input type="checkbox" name="trigger_cold"> Cold weather
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div class="symptom-section">
                            <h3><i class="fas fa-exclamation-circle"></i> Risk Factors</h3>
                            <div class="checkbox-group">
                                <label class="checkbox-item">
                                    <input type="checkbox" name="risk_hypertension"> High blood pressure
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="risk_cholesterol"> High cholesterol
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="risk_diabetes"> Diabetes
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="risk_smoking"> Current smoker
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="risk_obesity"> Overweight or obesity
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="risk_family"> Family history of heart disease
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="risk_sedentary"> Sedentary lifestyle
                                </label>
                                <label class="checkbox-item">
                                    <input type="checkbox" name="risk_stress"> High stress levels
                                </label>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="additional_info">Additional Information</label>
                            <textarea id="additional_info" name="additional_info" class="form-control" rows="4" placeholder="Please share any other symptoms or concerns not covered above."></textarea>
                        </div>
                        
                        <div class="form-actions">
                            <button type="button" class="btn btn-prev" data-prev="2"><i class="fas fa-arrow-left"></i> Previous</button>
                            <button type="button" class="btn submit-btn" onclick="analyzeSymptoms()">Check My Symptoms</button>
                        </div>
                    </div>
                </form>
                
                <div class="results-loader" id="results-loader" style="display: none;">
                    <div class="loader"></div>
                    <p>Analyzing your symptoms...</p>
                </div>
                
                <div class="symptom-result" id="symptom-result" style="display: none;">
    <h3 class="result-heading"><i class="fas fa-clipboard-list"></i> Your Heart Health Assessment</h3>
    
    <div class="risk-meter" id="risk-meter">
        <h3><i class="fas fa-chart-line"></i> Heart Risk Level</h3>
        <div class="meter-container">
            <div class="meter-bar" id="risk-meter-bar"></div>
            <div class="meter-marker" id="risk-meter-marker"></div>
        </div>
        <div class="meter-labels">
            <span><i class="fas fa-check-circle"></i> Low</span>
            <span><i class="fas fa-exclamation-circle"></i> Moderate</span>
            <span><i class="fas fa-exclamation-triangle"></i> High</span>
        </div>
        <div class="meter-result" id="risk-level-text"></div>
    </div>
    
    <div class="result-content">
        <div id="urgent-warning" class="emergency-box" style="display: none;">
            <h3><i class="fas fa-exclamation-triangle"></i> Urgent Warning</h3>
            <p>Based on your symptoms, you may be experiencing a serious cardiac issue that requires <strong>immediate medical attention</strong>. Please call emergency services (122) right away.</p>
        </div>
        
        <div id="general-results">
            <p><strong id="result-summary"></strong></p>
            <p class="disclaimer">Please note that this assessment is for informational purposes only and does not constitute a medical diagnosis.</p>
            
            <div class="expandable-info">
                <div class="expandable-header" onclick="toggleSection('symptoms-explained')">
                    <span><i class="fas fa-heartbeat"></i> Your Symptoms Explained</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="expandable-content" id="symptoms-explained">
                    <div id="symptoms-explanation"></div>
                </div>
            </div>
            
            <div class="expandable-info">
                <div class="expandable-header" onclick="toggleSection('recommendations')">
                    <span><i class="fas fa-clipboard-check"></i> Recommendations</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="expandable-content" id="recommendations">
                    <div id="recommendations-content"></div>
                </div>
            </div>
            
            <div class="expandable-info">
                <div class="expandable-header" onclick="toggleSection('next-steps')">
                    <span><i class="fas fa-shoe-prints"></i> Next Steps</span>
                    <i class="fas fa-chevron-down"></i>
                </div>
                <div class="expandable-content" id="next-steps">
                    <div id="next-steps-content"></div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="result-actions">
        <button type="button" class="btn" id="print-results"><i class="fas fa-print"></i> Print Results</button>
        <button type="button" class="btn btn-outline" onclick="resetForm()"><i class="fas fa-redo"></i> Start Over</button>
    </div>
</div>
            </div>
        </div>
        
        <p style="text-align: center; margin-top: 20px; font-style: italic;">
            <strong>Disclaimer:</strong> This symptom checker is for informational purposes only and is not a substitute for professional medical advice. In case of emergency, call 122.
        </p>
    </div>
    
    <script>
        // Form navigation
const formSteps = ['form-step-1', 'form-step-2', 'form-step-3'];
const stepIndicators = ['step1', 'step2', 'step3', 'step4'];

document.querySelectorAll('.btn-next').forEach(button => {
    button.addEventListener('click', function() {
        const nextStep = this.getAttribute('data-next');
        navigateToStep(nextStep);
    });
});

document.querySelectorAll('.btn-prev').forEach(button => {
    button.addEventListener('click', function() {
        const prevStep = this.getAttribute('data-prev');
        navigateToStep(prevStep);
    });
});

function navigateToStep(stepNum) {
    // Validate current step if moving forward
    if (parseInt(stepNum) > getCurrentStep()) {
        if (!validateStep(getCurrentStep())) {
            return false;
        }
    }
    
    // Hide all steps
    formSteps.forEach(step => {
        document.getElementById(step).style.display = 'none';
    });
    
    // Show target step
    const targetStep = `form-step-${stepNum}`;
    document.getElementById(targetStep).style.display = 'block';
    
    // Update progress bar
    updateProgress(stepNum);
    
    // Update step indicators
    updateStepIndicators(stepNum);
    
    // Scroll to top of form
    document.getElementById('symptom-checker-tool').scrollIntoView({
        behavior: 'smooth'
    });
    
    return true;
}

function getCurrentStep() {
    for (let i = 0; i < formSteps.length; i++) {
        if (document.getElementById(formSteps[i]).style.display !== 'none') {
            return i + 1;
        }
    }
    return 1; // Default to first step
}

function validateStep(stepNum) {
    // Add validation logic for each step
    if (stepNum === 1) {
        const age = document.getElementById('age').value;
        const gender = document.getElementById('gender').value;
        const heartCondition = document.querySelector('input[name="heart_condition"]:checked');
        
        if (!age || !gender || !heartCondition) {
            alert('Please complete all required fields before proceeding.');
            return false;
        }
    }
    
    return true;
}

function updateProgress(stepNum) {
    const progressBar = document.getElementById('progress-bar');
    const progress = ((stepNum - 1) / 3) * 100;
    progressBar.style.width = `${progress}%`;
}

function updateStepIndicators(stepNum) {
    stepIndicators.forEach((step, index) => {
        const stepElement = document.getElementById(step);
        if (index + 1 <= stepNum) {
            stepElement.classList.add('active');
        } else {
            stepElement.classList.remove('active');
        }
    });
}
// This function should be called at the end of analyzeSymptoms() or when submitting the form
function ymptomsToDB() {
    // Get the condition status (risk level) from the risk meter text
    const conditionStatus = document.getElementById('risk-level-text').textContent;
    
    // Collect all checked symptom checkboxes to create additional_symptoms string
    const checkedSymptoms = Array.from(
        document.querySelectorAll('input[type="checkbox"]:checked')
    ).map(cb => cb.name).join(',');
    
    // Create FormData object for POST request
    const fd = new FormData();
    fd.append('name', document.getElementById('age').value); // Use age as name since there's no name field
    fd.append('height', document.getElementById('height').value);
    fd.append('weight', document.getElementById('kg').value);
    fd.append('condition_status', conditionStatus); // LOW RISK, MODERATE RISK, or HIGH RISK
    fd.append('checkup_date', new Date().toISOString().slice(0,10)); // YYYY-MM-DD
    fd.append('notes', document.getElementById('condition_details')?.value || 
               document.getElementById('additional_info')?.value || '');
    fd.append('additional_symptoms', checkedSymptoms);

    // Send POST request to same page
    fetch(window.location.href, {
        method: 'POST',
        body: fd
    })
    .then(response => {
        console.log('Symptoms saved successfully');
    })
    .catch(err => {
        console.error('Error saving symptoms:', err);
    });
}

// Show/hide heart condition details when "Yes" is selected
document.querySelectorAll('input[name="heart_condition"]').forEach(radio => {
    radio.addEventListener('change', function() {
        const detailsDiv = document.querySelector('.heart-condition-details');
        if (this.value === 'yes') {
            detailsDiv.style.display = 'block';
        } else {
            detailsDiv.style.display = 'none';
        }
    });
});

// Show/hide chest symptom details when any chest symptom is checked
document.querySelectorAll('input[name="chest_pain"], input[name="chest_pressure"], input[name="chest_burning"], input[name="chest_fullness"]').forEach(checkbox => {
    checkbox.addEventListener('change', function() {
        const detailsDiv = document.querySelector('.chest-symptom-details');
        const anyChecked = document.querySelector('input[name="chest_pain"]:checked, input[name="chest_pressure"]:checked, input[name="chest_burning"]:checked, input[name="chest_fullness"]:checked');
        
        if (anyChecked) {
            detailsDiv.style.display = 'block';
        } else {
            detailsDiv.style.display = 'none';
        }
    });
});

// Pain intensity slider
const painIntensity = document.getElementById('pain_intensity');
const rangeValue = document.querySelector('.range-value');

painIntensity.addEventListener('input', function() {
    rangeValue.textContent = `${this.value}/10`;
});

// Toggle expandable sections
function toggleSection(sectionId) {
    const content = document.getElementById(sectionId);
    const header = content.parentElement.querySelector('.expandable-header');
    const icon = header.querySelector('i');
    
    if (content.style.maxHeight && content.style.maxHeight !== '0px') {
        content.style.maxHeight = null;
        icon.className = 'fas fa-chevron-down';
    } else {
        content.style.maxHeight = content.scrollHeight + 'px';
        icon.className = 'fas fa-chevron-up';
    }
}

// Reset form
function resetForm() {
    document.getElementById('symptom-form').reset();
    document.querySelector('.heart-condition-details').style.display = 'none';
    document.querySelector('.chest-symptom-details').style.display = 'none';
    document.getElementById('symptom-result').style.display = 'none';
    document.getElementById('urgent-warning').style.display = 'none';
    
    navigateToStep(1);
}

// Print results
document.getElementById('print-results').addEventListener('click', function() {
    window.print();
});

// Calculate risk level function
function calculateRiskLevel() {
    // Calculate risk level based on all inputs
    let riskScore = 0;
    const age = parseInt(document.getElementById('age').value);
    
    // Age factor
    if (age >= 65) riskScore += 15;
    else if (age >= 50) riskScore += 10;
    else if (age >= 40) riskScore += 5;
    
    // Gender factor
    if (document.getElementById('gender').value === 'male') riskScore += 5;
    
    // Known heart condition
    if (document.querySelector('input[name="heart_condition"]:checked').value === 'yes') riskScore += 20;
    
    // Chest symptoms
    if (document.getElementById('chest_pain').checked) riskScore += 15;
    if (document.querySelector('input[name="chest_pressure"]:checked') !== null) riskScore += 10;
    if (document.querySelector('input[name="chest_burning"]:checked') !== null) riskScore += 5;
    if (document.querySelector('input[name="chest_fullness"]:checked') !== null) riskScore += 10;
    
    // Left-sided pain is more concerning
    if (document.querySelector('input[name="pain_left"]:checked') !== null) riskScore += 10;
    
    // Associated symptoms
    if (document.querySelector('input[name="shortness_breath"]:checked') !== null) riskScore += 15;
    if (document.querySelector('input[name="dizziness"]:checked') !== null) riskScore += 10;
    if (document.querySelector('input[name="fainting"]:checked') !== null) riskScore += 15;
    if (document.querySelector('input[name="sweating"]:checked') !== null) riskScore += 10;
    if (document.querySelector('input[name="nausea"]:checked') !== null) riskScore += 5;
    if (document.querySelector('input[name="fatigue"]:checked') !== null) riskScore += 5;
    if (document.querySelector('input[name="pain_arm"]:checked') !== null) riskScore += 10;
    if (document.querySelector('input[name="pain_jaw"]:checked') !== null) riskScore += 10;
    if (document.querySelector('input[name="pain_back"]:checked') !== null) riskScore += 5;
    if (document.querySelector('input[name="swelling"]:checked') !== null) riskScore += 5;
    if (document.querySelector('input[name="palpitations"]:checked') !== null) riskScore += 5;
    if (document.querySelector('input[name="rapid_heartbeat"]:checked') !== null) riskScore += 10;
    
    // Risk factors
    if (document.querySelector('input[name="risk_hypertension"]:checked') !== null) riskScore += 10;
    if (document.querySelector('input[name="risk_cholesterol"]:checked') !== null) riskScore += 10;
    if (document.querySelector('input[name="risk_diabetes"]:checked') !== null) riskScore += 10;
    if (document.querySelector('input[name="risk_smoking"]:checked') !== null) riskScore += 15;
    if (document.querySelector('input[name="risk_obesity"]:checked') !== null) riskScore += 5;
    if (document.querySelector('input[name="risk_family"]:checked') !== null) riskScore += 10;
    if (document.querySelector('input[name="risk_sedentary"]:checked') !== null) riskScore += 5;
    if (document.querySelector('input[name="risk_stress"]:checked') !== null) riskScore += 5;
    
    // Normalize to 0-100 scale (max possible score ~250)
    return Math.min(100, Math.round((riskScore / 250) * 100));
}

    function updateRiskMeter(riskLevel) {
    const riskMeterBar = document.getElementById('risk-meter-bar');
    const riskMeterMarker = document.getElementById('risk-meter-marker');
    const riskLevelText = document.getElementById('risk-level-text');
    const riskMeter = document.getElementById('risk-meter');
    
    // Set position of marker (percentage)
    riskMeterMarker.style.left = `${riskLevel}%`;
    
    // Remove any existing risk classes
    riskMeter.classList.remove('risk-low', 'risk-moderate', 'risk-high');
    
    // Set color and text based on risk level
    if (riskLevel < 30) {
        riskMeterBar.style.background = '#28a745'; // Green
        riskLevelText.textContent = 'LOW RISK';
        riskMeter.classList.add('risk-low');
    } else if (riskLevel < 70) {
        riskMeterBar.style.background = '#ffc107'; // Yellow/amber
        riskLevelText.textContent = 'MODERATE RISK';
        riskMeter.classList.add('risk-moderate');
    } else {
        riskMeterBar.style.background = '#d9534f'; // Red
        riskLevelText.textContent = 'HIGH RISK';
        riskMeter.classList.add('risk-high');
    }
    
    // Add animation to the meter bar
    riskMeterBar.style.width = '0%';
    setTimeout(() => {
        riskMeterBar.style.width = `${riskLevel}%`;
    }, 50);
}
    
    // Set position of marker (percentage)
    riskMeterMarker.style.left = `${riskLevel}%`;
    
    // Set color and text based on risk level
    if (riskLevel < 30) {
        riskMeterBar.style.background = '#28a745'; // Green
        riskLevelText.textContent = 'LOW RISK';
    } else if (riskLevel < 70) {
        riskMeterBar.style.background = '#ffc107'; // Yellow/amber
        riskLevelText.textContent = 'MODERATE RISK';
    } else {
        riskMeterBar.style.background = '#d9534f'; // Red
        riskLevelText.textContent = 'HIGH RISK';
    }


// Check for urgent symptoms
function checkForUrgentSymptoms() {
    // Check for combination of symptoms that indicate emergency
    const hasSevereChestPain = document.getElementById('chest_pain').checked && 
                               parseFloat(document.getElementById('pain_intensity').value) >= 7;
    const hasShortness = document.querySelector('input[name="shortness_breath"]:checked') !== null;
    const hasFainting = document.querySelector('input[name="fainting"]:checked') !== null;
    const hasSweating = document.querySelector('input[name="sweating"]:checked') !== null;
    const hasJawPain = document.querySelector('input[name="pain_jaw"]:checked') !== null;
    const hasArmPain = document.querySelector('input[name="pain_arm"]:checked') !== null;
    
    // Check for chest pain duration
    const chestDurationSelect = document.querySelector('select[name="chest_duration"]');
    const chestDuration = chestDurationSelect ? chestDurationSelect.value : '';
    const prolongedPain = ['30min_2hours', '2_12hours', '12_24hours', 'more_than_24hours'].includes(chestDuration);
    
    // Determine if emergency warning should be shown
    return (hasSevereChestPain && (hasShortness || hasFainting || hasSweating || hasJawPain || hasArmPain)) ||
           (document.getElementById('chest_pain').checked && prolongedPain);
}

function analyzeSymptoms() {
    // Show loading spinner
    document.getElementById('results-loader').style.display = 'flex';
    document.getElementById('form-step-3').style.display = 'none';
    
    // Update progress and step indicators
    document.getElementById('progress-bar').style.width = '100%';
    stepIndicators.forEach((step, index) => {
        if (index < 4) {
            document.getElementById(step).classList.add('active');
        }
    });
    
    // Simulate analysis (replace with actual analysis in production)
    setTimeout(() => {
        // Hide loader and show results
        document.getElementById('results-loader').style.display = 'none';
        document.getElementById('symptom-result').style.display = 'block';
        
        // Check for urgent symptoms
        const hasUrgentSymptoms = checkForUrgentSymptoms();
        if (hasUrgentSymptoms) {
            document.getElementById('urgent-warning').style.display = 'block';
            document.getElementById('risk-level-text').textContent = 'HIGH RISK';
            document.getElementById('risk-meter-bar').style.background = '#d9534f';
            document.getElementById('risk-meter-marker').style.left = '90%';
        } else {
            // Calculate risk level
            const riskLevel = calculateRiskLevel();
            updateRiskMeter(riskLevel);
        }
        
        // Generate results
        generateResults();
        
        // Save data to database
        saveSymptomsToDB();
        
        // Open the symptoms explanation section by default
        document.getElementById('symptoms-explained').style.maxHeight = document.getElementById('symptoms-explained').scrollHeight + 'px';
        document.querySelector('#symptoms-explained').parentElement.querySelector('i').className = 'fas fa-chevron-up';
        
        // Scroll to results
        document.getElementById('symptom-result').scrollIntoView({
            behavior: 'smooth'
        });
    }, 2000);
}

function saveSymptomsToDB() {
    // Get the condition status (risk level) from the risk meter text
    const conditionStatus = document.getElementById('risk-level-text')?.textContent || '';

    // Collect all checked symptom checkboxes to create additional_symptoms string
    const checkedSymptoms = Array.from(
        document.querySelectorAll('input[type="checkbox"]:checked')
    ).map(cb => cb.name).join(',');

    // Create FormData object for POST request
    const fd = new FormData();
    // Add user_id from hidden field or use 1 as default
    const userId = document.getElementById('user_id')?.value || '1';

    fd.append('user_id', userId); // Correctly append user_id
    fd.append('name', document.getElementById('age')?.value || ''); // Using age as name
    fd.append('height', document.getElementById('height')?.value || '');
    fd.append('weight', document.getElementById('kg')?.value || '');
    fd.append('condition_status', conditionStatus); // LOW RISK, MODERATE RISK, or HIGH RISK
    fd.append('checkup_date', new Date().toISOString().slice(0, 10)); // YYYY-MM-DD
    fd.append('notes', document.getElementById('condition_details')?.value || 
               document.getElementById('additional_info')?.value || '');
    fd.append('additional_symptoms', checkedSymptoms);

    // Send POST request to same page
    fetch(window.location.href, {
        method: 'POST',
        body: fd
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.text();
    })
    .then(data => {
        console.log('Symptoms saved successfully:', data);
    })
    .catch(err => {
        console.error('Error saving symptoms:', err);
    });
}

function generateResults() {
    // Get form data
    const age = document.getElementById('age').value;
    const gender = document.getElementById('gender').value;
    const hasChestPain = document.getElementById('chest_pain').checked;
    const hasShortnessOfBreath = document.querySelector('input[name="shortness_breath"]:checked') !== null;
    
    // Generate summary
    let summary = '';
    if (document.getElementById('urgent-warning').style.display !== 'none') {
        summary = 'Your symptoms suggest a possible serious cardiac condition that requires immediate medical attention.';
    } else {
        const riskLevel = document.getElementById('risk-level-text').textContent;
        if (riskLevel === 'LOW RISK') {
            summary = 'Based on the information provided, your symptoms suggest a lower risk of heart-related issues.';
        } else if (riskLevel === 'MODERATE RISK') {
            summary = 'Your symptoms indicate a moderate risk of heart-related issues that should be evaluated by a healthcare provider.';
        } else {
            summary = 'Your symptoms suggest a higher risk of heart-related issues that should be evaluated promptly by a healthcare provider.';
        }
    }
    document.getElementById('result-summary').textContent = summary;
    
    // Generate symptom explanation
    let explanation = '<p>Here\'s what your symptoms might indicate:</p><ul>';
    
    if (hasChestPain) {
        explanation += '<li><strong>Chest Pain:</strong> Chest pain can be a symptom of several heart conditions including coronary artery disease, heart attack, or angina. The location and characteristics of your pain provide important diagnostic clues.</li>';
    }
    
    if (document.querySelector('input[name="chest_pressure"]:checked')) {
        explanation += '<li><strong>Chest Pressure or Tightness:</strong> This sensation can indicate reduced blood flow to the heart muscle, potentially due to coronary artery narrowing.</li>';
    }
    
    if (hasShortnessOfBreath) {
        explanation += '<li><strong>Shortness of Breath:</strong> This could indicate heart failure, valve issues, or could accompany a heart attack. It may also be related to lung conditions or anxiety.</li>';
    }
    
    if (document.querySelector('input[name="pain_jaw"]:checked') || document.querySelector('input[name="pain_arm"]:checked')) {
        explanation += '<li><strong>Pain in Jaw, Neck, or Arms:</strong> These are referred pain patterns often associated with heart attacks and require immediate medical evaluation.</li>';
    }
    
    if (document.querySelector('input[name="sweating"]:checked')) {
        explanation += '<li><strong>Cold Sweats:</strong> Combined with other cardiac symptoms, sweating can be a warning sign of a heart attack due to the body\'s stress response.</li>';
    }
    
    if (document.querySelector('input[name="palpitations"]:checked') || document.querySelector('input[name="rapid_heartbeat"]:checked')) {
        explanation += '<li><strong>Palpitations/Rapid Heartbeat:</strong> These could indicate arrhythmias (irregular heart rhythms) which may or may not be serious depending on the type and your overall health.</li>';
    }
    
    explanation += '</ul>';
    document.getElementById('symptoms-explanation').innerHTML = explanation;
    
    // Generate recommendations
    let recommendations = '<ul>';
    
    if (document.getElementById('urgent-warning').style.display !== 'none') {
        recommendations += '<li><strong>Call 122 or emergency services immediately.</strong></li>';
        recommendations += '<li>Do not drive yourself to the hospital.</li>';
        recommendations += '<li>If available and advised by a healthcare provider, take aspirin.</li>';
    } else if (document.getElementById('risk-level-text').textContent === 'HIGH RISK') {
        recommendations += '<li><strong>Seek medical attention promptly</strong> - Contact your doctor today or go to an urgent care facility.</li>';
        recommendations += '<li>Avoid strenuous activities until evaluated by a healthcare provider.</li>';
        recommendations += '<li>Monitor your symptoms closely and call 122 if they worsen.</li>';
    } else if (document.getElementById('risk-level-text').textContent === 'MODERATE RISK') {
        recommendations += '<li><strong>Contact your healthcare provider</strong> for an evaluation within the next few days.</li>';
        recommendations += '<li>Monitor your symptoms and seek emergency care if they worsen.</li>';
        recommendations += '<li>Consider lifestyle modifications to reduce risk factors.</li>';
    } else {
        recommendations += '<li>Follow up with your regular healthcare provider at your next scheduled visit.</li>';
        recommendations += '<li>Consider lifestyle modifications to maintain heart health.</li>';
        recommendations += '<li>Monitor your symptoms and seek medical attention if they worsen or persist.</li>';
    }
    
    recommendations += '</ul>';
    document.getElementById('recommendations-content').innerHTML = recommendations;
    
    // Generate next steps
    let nextSteps = '<ul>';
    
    // Risk factor-specific recommendations
    if (document.querySelector('input[name="risk_hypertension"]:checked')) {
        nextSteps += '<li>Continue monitoring your blood pressure regularly.</li>';
    }
    
    if (document.querySelector('input[name="risk_cholesterol"]:checked')) {
        nextSteps += '<li>Follow your healthcare provider\'s recommendations for managing cholesterol.</li>';
    }
    
    if (document.querySelector('input[name="risk_smoking"]:checked')) {
        nextSteps += '<li>Consider smoking cessation programs or resources to help you quit smoking.</li>';
    }
    
    if (document.querySelector('input[name="risk_obesity"]:checked') || document.querySelector('input[name="risk_sedentary"]:checked')) {
        nextSteps += '<li>Gradually increase physical activity as recommended by your healthcare provider.</li>';
        nextSteps += '<li>Consider dietary modifications to support heart health.</li>';
    }
    
    nextSteps += '<li>Follow up with your healthcare provider to create or update your heart health plan.</li>';
    nextSteps += '<li>Consider learning CPR and heart emergency response techniques.</li>';
    nextSteps += '</ul>';
    
    document.getElementById('next-steps-content').innerHTML = nextSteps;
}
    </script>
</body>
</html>