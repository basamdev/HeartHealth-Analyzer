<?php
session_start();
$pageTitle = "Resources";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Comprehensive heart disease resources including symptom checker, educational videos, and support groups">
    <title>Heart Health Resources | HeartCare Connect</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
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
  scroll-behavior: smooth;
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
  transform: translateY(-2px);
}

ul {
  list-style: none;
}

img {
  max-width: 100%;
}

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
  transition: all 0.5s ease;
}

.logo:hover {
  transform: scale(1.05);
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
  transition: all 0.4s ease;
}

.nav-links li a:after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 0;
  width: 0;
  height: 2px;
  background-color: var(--primary-color);
  transition: all 0.4s ease;
}

.nav-links li a:hover:after,
.nav-links li a.active:after {
  width: 100%;
}

.nav-links li a:hover {
  color: var(--primary-color);
  transform: translateY(-3px);
}

.nav-links li a.active {
  color: var(--primary-color);
  font-weight: 600;
}

.mobile-menu {
  display: none;
  cursor: pointer;
  font-size: 1.5rem;
  transition: all 0.3s ease;
}

.mobile-menu:hover {
  color: var(--primary-color);
  transform: rotate(90deg);
}

.hero {
  background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
  color: var(--light-text);
  padding: 80px 0;
  text-align: center;
  position: relative;
  overflow: hidden;
}

.hero::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L0,100 100,100 Z" fill="rgba(255,255,255,0.05)"/></svg>');
  background-size: cover;
}

.hero h1 {
  margin-bottom: 20px;
  font-size: 2.8rem;
  position: relative;
  display: inline-block;
  transform: translateY(0);
  transition: transform 0.5s ease;
}

.hero h1:hover {
  transform: translateY(-5px);
}

.hero h1 i {
  animation: heartbeat 1.5s infinite;
}

@keyframes heartbeat {
  0% { transform: scale(1); }
  15% { transform: scale(1.15); }
  30% { transform: scale(1); }
  45% { transform: scale(1.15); }
  60% { transform: scale(1); }
}

.hero p {
  max-width: 700px;
  margin: 0 auto 30px;
  font-size: 1.1rem;
  opacity: 0.9;
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
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  box-shadow: var(--box-shadow);
  position: relative;
  overflow: hidden;
}

.btn::after {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 0;
  height: 0;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 50%;
  transform: translate(-50%, -50%);
  transition: all 0.6s ease;
}

.btn:hover::after {
  width: 300px;
  height: 300px;
  opacity: 0;
}

.btn:hover {
  transform: translateY(-4px) scale(1.05);
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
  background-color: var(--light-text);
}

.btn:active {
  transform: translateY(0) scale(0.98);
}

.section {
  padding: 80px 0;
  position: relative;
}

.section-title {
  text-align: center;
  margin-bottom: 60px;
}

.section-title h2 {
  margin-bottom: 15px;
  position: relative;
  display: inline-block;
  transition: transform 0.3s ease;
}

.section-title h2:hover {
  transform: translateY(-3px);
}

.section-title h2:after {
  content: '';
  position: absolute;
  width: 80px;
  height: 3px;
  background-color: var(--primary-color);
  bottom: -10px;
  left: 50%;
  transform: translateX(-50%);
  transition: width 0.4s ease;
}

.section-title h2:hover:after {
  width: 100%;
}

.section-title p {
  max-width: 700px;
  margin: 0 auto;
  color: #666;
}

.resource-cards {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 30px;
  margin-bottom: 40px;
  perspective: 1000px;
}

.resource-card {
  background-color: white;
  border-radius: var(--border-radius);
  box-shadow: var(--box-shadow);
  padding: 30px;
  transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
  transform-style: preserve-3d;
  backface-visibility: hidden;
  position: relative;
}

.resource-card::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border-radius: var(--border-radius);
  background: linear-gradient(135deg, transparent 0%, rgba(230, 57, 70, 0.05) 100%);
  z-index: -1;
  opacity: 0;
  transition: opacity 0.4s ease;
}

.resource-card:hover::before {
  opacity: 1;
}

.resource-card:hover {
  transform: translateY(-10px) rotateX(5deg);
  box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
}

.resource-card h3 {
  color: var(--secondary-color);
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 15px;
  transition: all 0.3s ease;
}

.resource-card:hover h3 {
  transform: translateY(-3px);
  color: var(--primary-color);
}

.resource-card h3 i {
  color: var(--primary-color);
  transition: transform 0.4s ease;
}

.resource-card:hover h3 i {
  transform: scale(1.2);
}

.resource-card .btn {
  margin-top: 20px;
  padding: 10px 20px;
  font-size: 0.95rem;
}

.emergency-box {
  background-color: var(--primary-light);
  border-left: 5px solid var(--primary-color);
  padding: 30px;
  border-radius: var(--border-radius);
  margin-bottom: 60px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
  transition: all 0.4s ease;
  position: relative;
  overflow: hidden;
}

.emergency-box::after {
  content: '';
  position: absolute;
  top: 0;
  right: 0;
  width: 100px;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
  transform: skewX(-20deg);
  animation: shimmer 3s infinite;
}

@keyframes shimmer {
  0% { transform: translateX(-150%) skewX(-20deg); }
  100% { transform: translateX(400%) skewX(-20deg); }
}

.emergency-box:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
  border-left-width: 8px;
}

.emergency-box h3 {
  color: var(--primary-dark);
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 15px;
  font-size: 1.6rem;
}

.emergency-box h3 i {
  color: var(--primary-color);
  animation: pulse 2s infinite;
}

.emergency-box p {
  margin-bottom: 10px;
}

.disclaimer {
  background-color: var(--light-bg);
  padding: 25px;
  border-radius: var(--border-radius);
  font-size: 0.9rem;
  color: #666;
  margin: 60px 0;
  border-left: 3px solid var(--secondary-color);
  transition: all 0.3s ease;
}

.disclaimer:hover {
  background-color: #f1f1f1;
  transform: translateY(-3px);
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
}

@media (max-width: 992px) {
  .resource-cards {
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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
    padding: 50px 0;
  }
}

@media (max-width: 576px) {
  h1 {
    font-size: 2rem;
  }
  
  h2 {
    font-size: 1.8rem;
  }
  
  .resource-cards {
    grid-template-columns: 1fr;
  }
  
}
    </style>
    <body>
    <header>
    <?php
$pageTitle = "Resources";
include 'header.php';
?>
    </header>
</head>
    
    <section class="hero">
        <div class="container">
            <h1><i class="fas fa-heartbeat"></i> Heart Health Resources</h1>
            <p>Welcome to our comprehensive resource center for heart disease awareness, education, and support. Here you'll find tools to check your symptoms, educational videos about heart health, and information about support groups in your area.</p>
            <a href="#resources" class="btn"><i class="fas fa-book-medical"></i> Explore Resources</a>
        </div>
    </section>
    
    <section class="section" id="resources">
        <div class="container">
            <div class="emergency-box">
                <h3><i class="fas fa-exclamation-triangle"></i> Emergency Information</h3>
                <p><strong>If you're experiencing chest pain, shortness of breath, or other heart attack symptoms:</strong></p>
                <p>Call emergency services immediately: <strong>122</strong> or your local emergency number.</p>
            </div>
            
            <div class="section-title">
                <h2>Essential Heart Health Resources</h2>
                <p>Access our most important tools and resources to help you understand, monitor, and manage heart health.</p>
            </div>
            
            <div class="resource-cards">
                <div class="resource-card">
                    <h3><i class="fas fa-stethoscope"></i> Check Your Symptoms</h3>
                    <p>Our interactive symptom checker helps you identify potential heart-related issues. Remember, this tool is not a substitute for professional medical advice.</p>
                    <a href="symptom-checker.php" class="btn"><i class="fas fa-arrow-right"></i> Check Symptoms</a>
                </div>
                
                <div class="resource-card">
                    <h3><i class="fas fa-video"></i> Educational Videos</h3>
                    <p>Watch informative videos about heart disease prevention, treatment options, and lifestyle modifications from leading cardiologists and health experts.</p>
                    <a href="educational-videos.php" class="btn"><i class="fas fa-arrow-right"></i> Watch Videos</a>
                </div>
                
                <div class="resource-card">
                    <h3><i class="fas fa-users"></i> Support Groups</h3>
                    <p>Connect with others who are experiencing similar challenges. Find local and online support groups for patients and caregivers affected by heart disease.</p>
                    <a href="support-groups.php" class="btn"><i class="fas fa-arrow-right"></i> Find Support</a>
                </div>
            </div>
        </div>
    </section>
    
    <div class="container">
        <div class="disclaimer">
            <strong>Disclaimer:</strong> The information provided on this website is for general informational purposes only and should not be considered as medical advice. Always consult with a qualified healthcare provider for diagnosis and treatment.
        </div>
    </div>
    
    <footer>
    <?php include 'footer.php'; ?>
    </footer>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (document.getElementById('current-date')) {
                const today = new Date();
                const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                document.getElementById('current-date').textContent = today.toLocaleDateString('en-US', options);
            }
        });
        
        document.getElementById('mobile-menu').addEventListener('click', function() {
            document.getElementById('nav-links').classList.toggle('active');
        });
    </script>
</body>
</html>