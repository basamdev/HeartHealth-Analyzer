<?php
session_start();
$pageTitle = "Symptom Checker";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Symptom Checker - Heart Health Insights</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* Global Styles */
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
  --success-color: #28a745;
  --warning-color: #ffc107;
  --danger-color: #dc3545;
  --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  --border-radius: 8px;
  --transition: all 0.3s ease;
}

* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
  color: var(--text-color);
  line-height: 1.6;
  background-color: #f8f9fa;
}

.container {
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

a {
  text-decoration: none;
  color: var(--secondary-color);
  transition: var(--transition);
}

a:hover {
  color: var(--primary-color);
}

ul {
  list-style: none;
}

img {
  max-width: 100%;
}

/* Typography */
h1, h2, h3, h4, h5, h6 {
  margin-bottom: 1rem;
  font-weight: 700;
  line-height: 1.2;
}

h1 {
  font-size: 2.5rem;
}

h2 {
  font-size: 2rem;
}

h3 {
  font-size: 1.5rem;
}

p {
  margin-bottom: 1rem;
}

/* Header */
.header {
  background-color: white;
  box-shadow: var(--box-shadow);
  position: sticky;
  top: 0;
  z-index: 1000;
  padding: 10px 0;
}

.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 10px 0;
}

.logo {
  font-size: 1.5rem;
  font-weight: 700;
  color: var(--primary-color);
  display: flex;
  align-items: center;
  gap: 8px;
}

.logo i {
  animation: pulse 2s infinite;
}

@keyframes pulse {
  0% { transform: scale(1); }
  50% { transform: scale(1.15); }
  100% { transform: scale(1); }
}

.nav-links {
  display: flex;
  gap: 25px;
  align-items: center;
}

.nav-links li a {
  color: var(--text-color);
  font-weight: 500;
  padding: 10px 0;
  position: relative;
}

.nav-links li a:after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background-color: var(--primary-color);
  transition: var(--transition);
}

.nav-links li a:hover:after,
.nav-links li a.active:after {
  width: 100%;
}

.nav-links li a.active {
  color: var(--primary-color);
  font-weight: 600;
}

.mobile-menu {
  display: none;
  cursor: pointer;
  font-size: 1.5rem;
}

/* Hero Section */
.hero {
  background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
  color: var(--light-text);
  padding: 60px 0;
  text-align: center;
}

.hero h1 {
  margin-bottom: 20px;
  font-size: 2.8rem;
}

.hero p {
  max-width: 700px;
  margin: 0 auto 30px;
  font-size: 1.1rem;
}

.btn {
  background-color: white;
  color: var(--primary-color);
  padding: 12px 24px;
  border-radius: 50px;
  font-weight: 600;
  border: none;
  display: inline-flex;
  align-items: center;
  gap: 8px;
  cursor: pointer;
  transition: var(--transition);
  box-shadow: var(--box-shadow);
}

.btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
  background-color: var(--light-text);
}

.btn-outline {
  background-color: transparent;
  color: var(--text-color);
  border: 1px solid var(--border-color);
}

.btn-outline:hover {
  border-color: var(--primary-color);
  color: var(--primary-color);
  background-color: transparent;
}

.btn-next, .btn-prev, .submit-btn {
  margin: 0 5px;
}

.btn-prev {
  background-color: var(--light-bg);
  color: var(--text-color);
}

.submit-btn {
  background-color: var(--primary-color);
  color: white;
}

.submit-btn:hover {
  background-color: var(--primary-dark);
  color: white;
}

/* Main Content Sections */
.section {
  padding: 60px 0;
}

.section-title {
  text-align: center;
  margin-bottom: 40px;
}

.section-title h2 {
  margin-bottom: 15px;
  position: relative;
  display: inline-block;
}

.section-title h2:after {
  content: '';
  position: absolute;
  width: 60px;
  height: 3px;
  background-color: var(--primary-color);
  bottom: -10px;
  left: 50%;
  transform: translateX(-50%);
}

.section-title p {
  max-width: 700px;
  margin: 0 auto;
  color: #666;
}

/* Emergency Section */
.emergency-section {
  background-color: var(--primary-light);
  padding: 25px;
  border-radius: var(--border-radius);
  margin-bottom: 40px;
  border-left: 5px solid var(--primary-color);
}

.emergency-section h2 {
  color: var(--primary-dark);
  display: flex;
  align-items: center;
  gap: 10px;
}

.emergency-section i {
  color: var(--primary-color);
}

.emergency-list {
  padding-left: 25px;
  margin: 15px 0;
}

.emergency-list li {
  position: relative;
  padding-left: 10px;
  margin-bottom: 10px;
  list-style-type: disc;
}

/* Symptom Checker Tool */
.symptom-checker {
  background-color: white;
  border-radius: var(--border-radius);
  box-shadow: var(--box-shadow);
  padding: 30px;
  margin-bottom: 50px;
}

.progress-container {
  height: 8px;
  background-color: var(--light-bg);
  border-radius: 4px;
  margin-bottom: 30px;
  overflow: hidden;
}

.progress-bar {
  height: 100%;
  background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
  width: 0;
  transition: width 0.5s ease;
}

/* Step Indicators */
.step-indicators {
  display: flex;
  justify-content: space-between;
  margin-bottom: 40px;
}

.step {
  text-align: center;
  position: relative;
  flex: 1;
}

.step:not(:last-child):after {
  content: '';
  position: absolute;
  top: 17px;
  width: 100%;
  height: 2px;
  background-color: var(--border-color);
  left: 50%;
  z-index: 1;
}

.step-circle {
  width: 35px;
  height: 35px;
  border-radius: 50%;
  background-color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto;
  border: 2px solid var(--border-color);
  z-index: 2;
  position: relative;
  font-weight: 600;
  color: #999;
  transition: var(--transition);
}

.step.active .step-circle {
  background-color: var(--primary-color);
  border-color: var(--primary-color);
  color: white;
}

.step-label {
  margin-top: 10px;
  font-size: 0.9rem;
  color: #666;
}

.step.active .step-label {
  color: var(--primary-color);
  font-weight: 600;
}

/* Form Styling */
.symptom-section {
  margin-bottom: 30px;
  padding: 25px;
  background-color: var(--light-bg);
  border-radius: var(--border-radius);
}

.symptom-section h3 {
  margin-bottom: 20px;
  display: flex;
  align-items: center;
  gap: 10px;
}

.symptom-section h3 i {
  color: var(--secondary-color);
}

.form-group {
  margin-bottom: 20px;
}

.form-row {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
}

.form-row .form-group {
  flex: 1;
  min-width: 200px;
}

label {
  display: block;
  margin-bottom: 8px;
  font-weight: 500;
}

.form-control {
  width: 100%;
  padding: 12px 15px;
  border: 1px solid var(--border-color);
  border-radius: var(--border-radius);
  font-size: 1rem;
  transition: var(--transition);
}

.form-control:focus {
  outline: none;
  border-color: var(--secondary-color);
  box-shadow: 0 0 0 3px rgba(69, 123, 157, 0.2);
}

.radio-group, .checkbox-group {
  display: flex;
  flex-wrap: wrap;
  gap: 15px;
}

.radio-item, .checkbox-item {
  display: flex;
  align-items: center;
  gap: 8px;
  cursor: pointer;
  font-weight: normal;
}

input[type="radio"], input[type="checkbox"] {
  accent-color: var(--primary-color);
  width: 18px;
  height: 18px;
  cursor: pointer;
}

/* Range Slider */
.range-slider {
  position: relative;
  margin-bottom: 5px;
}

.form-range {
  width: 100%;
  height: 8px;
  border-radius: 4px;
  background: #ddd;
  outline: none;
}

.form-range::-webkit-slider-thumb {
  -webkit-appearance: none;
  appearance: none;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: var(--primary-color);
  cursor: pointer;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.form-range::-moz-range-thumb {
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: var(--primary-color);
  cursor: pointer;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
  border: none;
}

.range-labels {
  display: flex;
  justify-content: space-between;
  margin-top: 8px;
  font-size: 0.85rem;
  color: #666;
}

.range-value {
  text-align: center;
  font-weight: 600;
  color: var(--primary-color);
}

.form-actions {
  display: flex;
  justify-content: space-between;
  margin-top: 30px;
}

/* Results Loader */
.results-loader {
  display: none;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 40px 0;
}

.loader {
  border: 5px solid #f3f3f3;
  border-radius: 50%;
  border-top: 5px solid var(--primary-color);
  width: 50px;
  height: 50px;
  animation: spin 1s linear infinite;
  margin-bottom: 20px;
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Results */
.symptom-result {
  display: none;
  margin-top: 20px;
}

.result-heading {
  text-align: center;
  margin-bottom: 30px;
  color: var(--primary-color);
}

/* Risk Meter */
.risk-meter {
  text-align: center;
  max-width: 600px;
  margin: 0 auto 40px;
}

.meter-container {
  position: relative;
  height: 15px;
  background: linear-gradient(to right, #4CAF50, #FFC107, #F44336);
  border-radius: 10px;
  margin: 20px 0;
}

.meter-marker {
  position: absolute;
  top: -10px;
  width: 20px;
  height: 35px;
  background-color: white;
  border: 2px solid #333;
  border-radius: 5px;
  transform: translateX(-50%);
  left: 15%;
  transition: left 0.8s ease;
}

.meter-labels {
  display: flex;
  justify-content: space-between;
  margin-top: 10px;
  font-weight: 500;
}

.meter-result {
  font-size: 1.5rem;
  font-weight: 700;
  margin-top: 15px;
}

/* Emergency Box */
.emergency-box {
  background-color: var(--danger-color);
  color: white;
  padding: 20px;
  border-radius: var(--border-radius);
  margin-bottom: 30px;
  text-align: center;
}

.emergency-box h3 {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
}

/* Expandable Info */
.expandable-info {
  margin-bottom: 20px;
  border: 1px solid var(--border-color);
  border-radius: var(--border-radius);
  overflow: hidden;
}

.expandable-header {
  padding: 15px;
  background-color: var(--light-bg);
  display: flex;
  justify-content: space-between;
  align-items: center;
  cursor: pointer;
  font-weight: 600;
}

.expandable-content {
  padding: 0;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.3s ease, padding 0.3s ease;
}

.expandable-content[style*="max-height"] {
  padding: 20px;
}

.result-actions {
  display: flex;
  flex-wrap: wrap;
  gap: 10px;
  justify-content: center;
  margin-top: 40px;
}

/* Symptom Cards */
.symptom-cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
  gap: 25px;
  margin-top: 40px;
}

.symptom-card {
  background-color: white;
  padding: 25px;
  border-radius: var(--border-radius);
  box-shadow: var(--box-shadow);
  transition: var(--transition);
}

.symptom-card:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}

.symptom-card h3 {
  color: var(--secondary-color);
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 15px;
}

.symptom-card h3 i {
  color: var(--primary-color);
}

/* Heart Anatomy Section */
.heart-anatomy {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 30px;
}

.heart-info {
  background-color: white;
  padding: 30px;
  border-radius: var (--border-radius);
  box-shadow: var(--box-shadow);
}

.heart-info h3 {
  display: flex;
  align-items: center;
  gap: 10px;
  color: var(--primary-color);
  margin-bottom: 20px;
}

.heart-info ul {
  padding-left: 20px;
  margin: 15px 0;
}

.heart-info ul li {
  list-style-type: disc;
  margin-bottom: 8px;
}

/* Info Grid */
.info-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 25px;
}

.info-card {
  background-color: white;
  padding: 25px;
  border-radius: var(--border-radius);
  box-shadow: var(--box-shadow);
}

.info-card h3 {
  display: flex;
  align-items: center;
  gap: 10px;
  color: var(--secondary-color);
  margin-bottom: 20px;
}

.info-card h3 i {
  color: var(--primary-color);
}

.info-card ul {
  padding-left: 20px;
}

.info-card ul li {
  list-style-type: disc;
  margin-bottom: 10px;
}

/* Disclaimer */
.disclaimer {
  background-color: var(--light-bg);
  padding: 20px;
  border-radius: var(--border-radius);
  font-size: 0.9rem;
  color: #666;
  margin: 40px 0;
}

/* Footer */
.footer {
  background-color: var(--text-color);
  color: var(--light-text);
  padding: 50px 0 20px;
}

.social-links {
  display: flex;
  justify-content: center;
  gap: 15px;
  margin-bottom: 30px;
}

.social-links a {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: rgba(255, 255, 255, 0.1);
  color: var(--light-text);
  transition: var(--transition);
}

.social-links a:hover {
  background-color: var(--primary-color);
  transform: translateY(-3px);
}

.footer-links {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  gap: 20px;
  margin-bottom: 20px;
}

.footer-links a {
  color: var(--light-text);
  font-size: 0.9rem;
}

.footer-links a:hover {
  color: var(--secondary-light);
}

.footer p {
  text-align: center;
  font-size: 0.85rem;
  margin-top: 20px;
  color: rgba(255, 255, 255, 0.6);
}

/* Modal */
.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1100;
}

.modal-content {
  background-color: white;
  padding: 30px;
  border-radius: var(--border-radius);
  max-width: 500px;
  width: 100%;
  position: relative;
}

.close-modal {
  position: absolute;
  right: 20px;
  top: 15px;
  font-size: 1.5rem;
  cursor: pointer;
}

#email-message {
  margin-top: 15px;
  color: var(--primary-color);
  font-weight: 500;
}

/* Print Styles */
@media print {
  .header, .hero, footer, .btn, .form-actions {
    display: none !important;
  }
  
  .symptom-result {
    display: block !important;
  }
  
  body, .container {
    width: 100%;
    margin: 0;
    padding: 0;
  }
  
  .symptom-checker {
    box-shadow: none;
    padding: 0;
  }
  
  .expandable-content {
    max-height: none !important;
    padding: 20px !important;
    display: block !important;
  }
}

/* Responsive Styles */
@media (max-width: 992px) {
  .heart-anatomy {
    grid-template-columns: 1fr;
  }
}

@media (max-width: 768px) {
  .nav-links {
    display: none;
    flex-direction: column;
    position: absolute;
    top: 100%;
    left: 0;
    width: 100%;
    background-color: white;
    padding: 20px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    z-index: 100;
  }
  
  .nav-links.active {
    display: flex;
  }
  
  .mobile-menu {
    display: block;
  }
  
  .hero h1 {
    font-size: 2.2rem;
  }
  
  .section {
    padding: 40px 0;
  }
  
  .form-actions {
    flex-direction: column;
    gap: 10px;
  }
  
  .btn {
    width: 100%;
    justify-content: center;
  }
  
  .step-label {
    font-size: 0.8rem;
  }
}

@media (max-width: 576px) {
  h1 {
    font-size: 2rem;
  }
  
  h2 {
    font-size: 1.8rem;
  }
  
  .symptom-checker {
    padding: 20px 15px;
  }
  
  .symptom-section {
    padding: 15px;
  }
  
  .step-indicators {
    flex-wrap: wrap;
    gap: 10px;
  }
  
  .step:not(:last-child):after {
    display: none;
  }
  
  .result-actions {
    flex-direction: column;
  }
}
    </style>
</head>
<body>
<header>
    <?php
$pageTitle = "Symptom Checker";
include 'header.php';
?>
    </header>
    
    <section class="hero">
        <div class="container">
            <h1><i class="fas fa-heartbeat"></i> Heart Symptom Checker</h1>
            <p>Identify potential heart-related symptoms and get guidance on when to seek medical attention. This tool is for informational purposes only and does not replace professional medical advice.</p>
            <a href="heart-symptom-checker.php" class="btn"><i class="fas fa-stethoscope"></i> Check Your Symptoms</a>
        </div>
    </section>
    
    <section class="section">
        <div class="container">
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
        </div>
    </section>
    
    <section class="section" style="background-color: white;">
        <div class="container">
            <div class="section-title">
                <h2>Common Heart-Related Symptoms</h2>
                <p>Learn about the most common symptoms associated with heart conditions and what they might indicate.</p>
            </div>
            
            <div class="symptom-cards">
                <div class="symptom-card">
                    <h3><i class="fas fa-heart-broken"></i> Chest Pain or Discomfort</h3>
                    <p>Often described as pressure, squeezing, fullness, or pain in the center or left side of the chest. May last for more than a few minutes or go away and return.</p>
                    <p><strong>Potential conditions:</strong> Heart attack, angina, pericarditis, aortic dissection</p>
                </div>
                
                <div class="symptom-card">
                    <h3><i class="fas fa-lungs"></i> Shortness of Breath</h3>
                    <p>Difficulty breathing or feeling like you can't get enough air, especially during physical activity or when lying down.</p>
                    <p><strong>Potential conditions:</strong> Heart failure, coronary artery disease, valve problems</p>
                </div>
                
                <div class="symptom-card">
                    <h3><i class="fas fa-heartbeat"></i> Heart Palpitations</h3>
                    <p>Feelings of a racing, fluttering, or pounding heart. May feel like your heart is skipping beats.</p>
                    <p><strong>Potential conditions:</strong> Arrhythmias, anxiety, thyroid issues</p>
                </div>
                
                <div class="symptom-card">
                    <h3><i class="fas fa-battery-quarter"></i> Fatigue and Weakness</h3>
                    <p>Unusual tiredness or weakness that doesn't improve with rest, especially when accompanied by other symptoms.</p>
                    <p><strong>Potential conditions:</strong> Heart failure, coronary artery disease, anemia</p>
                </div>
                
                <div class="symptom-card">
                    <h3><i class="fas fa-compress-arrows-alt"></i> Swelling in Legs, Ankles, or Feet</h3>
                    <p>Fluid buildup (edema) that may indicate your heart isn't pumping blood effectively.</p>
                    <p><strong>Potential conditions:</strong> Heart failure, valve problems</p>
                </div>
                
                <div class="symptom-card">
                    <h3><i class="fas fa-dizzy"></i> Lightheadedness or Dizziness</h3>
                    <p>Feeling faint or dizzy, especially when changing positions or during exertion.</p>
                    <p><strong>Potential conditions:</strong> Arrhythmias, valve problems, low blood pressure</p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Heart Attack vs. Cardiac Arrest</h2>
                <p>Understanding the difference between these two serious heart events can save lives.</p>
            </div>
            
            <div class="heart-anatomy">
                <div class="heart-info">
                    <h3><i class="fas fa-heartbeat"></i> Heart Attack</h3>
                    <p>A heart attack occurs when blood flow to a part of the heart is blocked, usually by a blood clot. The heart muscle begins to die from lack of oxygen.</p>
                    <p><strong>Key symptoms:</strong></p>
                    <ul>
                        <li>Chest pain or discomfort</li>
                        <li>Pain radiating to arm, jaw, neck, or back</li>
                        <li>Shortness of breath</li>
                        <li>Cold sweat</li>
                        <li>Nausea or vomiting</li>
                        <li>Fatigue</li>
                    </ul>
                    <p><strong>The person is usually conscious and has a pulse.</strong></p>
                </div>
                
                <div class="heart-info">
                    <h3><i class="fas fa-exclamation-circle"></i> Cardiac Arrest</h3>
                    <p>Cardiac arrest is the sudden loss of heart function. The heart stops beating and pumping blood, causing the person to lose consciousness and stop breathing normally.</p>
                    <p><strong>Key signs:</strong></p>
                    <ul>
                        <li>Sudden collapse</li>
                        <li>No pulse</li>
                        <li>No breathing or only gasping</li>
                        <li>Loss of consciousness</li>
                    </ul>
                    <p><strong>This is an immediate life-threatening emergency requiring CPR and defibrillation.</strong></p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="section" style="background-color: #f8f9fa;">
        <div class="container">
            <div class="section-title">
                <h2>When to Seek Medical Attention</h2>
                <p>Know when to call your doctor and when to seek emergency care.</p>
            </div>
            
            <div class="info-grid">
                <div class="info-card">
                    <h3><i class="fas fa-ambulance"></i> Seek Emergency Care (Call 122) If:</h3>
                    <ul>
                        <li>Chest pain lasting more than a few minutes</li>
                        <li>Severe shortness of breath</li>
                        <li>Fainting or loss of consciousness</li>
                        <li>Symptoms of heart attack or stroke</li>
                        <li>Rapid or irregular heartbeat with weakness, dizziness, or shortness of breath</li>
                        <li>Severe anxiety feeling like a panic attack</li>
                    </ul>
                </div>
                
                <div class="info-card">
                    <h3><i class="fas fa-user-md"></i> Call Your Doctor If:</h3>
                    <ul>
                        <li>Mild chest discomfort that goes away with rest</li>
                        <li>Shortness of breath with mild exertion</li>
                        <li>Heart palpitations that come and go</li>
                        <li>Mild swelling in your legs or ankles</li>
                        <li>Fatigue or weakness that persists</li>
                        <li>Risk factors for heart disease that concern you</li>
                    </ul>
                </div>
                
                <div class="info-card">
                    <h3><i class="fas fa-clipboard-list"></i> Prepare for Your Doctor Visit:</h3>
                    <ul>
                        <li>Write down your symptoms, including when they occur</li>
                        <li>List all medications and supplements you take</li>
                        <li>Note any family history of heart disease</li>
                        <li>Bring results from your symptom checker</li>
                        <li>Prepare questions about your symptoms</li>
                        <li>Consider bringing a family member or friend for support</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    <div class="container">
        <div class="disclaimer">
            <strong>Disclaimer:</strong> This symptom checker is for informational purposes only and is not a substitute for professional medical advice, diagnosis, or treatment. Always seek the advice of your physician or other qualified health provider with any questions you may have regarding a medical condition. Never disregard professional medical advice or delay in seeking it because of something you have read on this website. If you think you may have a medical emergency, call your doctor or emergency services immediately.
        </div>
    </div>
    
    <footer>
    <?php include 'footer.php'; ?>
    </footer>
    
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu').addEventListener('click', function() {
            document.getElementById('nav-links').classList.toggle('active');
        });
    </script>
</body>
</html>