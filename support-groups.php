<?php
// Start session (must be at the very top of the file)
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Find heart disease support groups for patients and caregivers, both local and online">
    <title>Heart Disease Support Groups | HeartCare Connect</title>
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

.support-groups {
  margin-bottom: 40px;
}

.support-group-tabs {
  display: flex;
  border-bottom: 1px solid var(--border-color);
  margin-bottom: 30px;
  overflow-x: auto;
  padding-bottom: 5px;
}

.tab-btn {
  padding: 12px 24px;
  background: none;
  border: none;
  border-bottom: 3px solid transparent;
  font-weight: 600;
  color: var(--text-color);
  cursor: pointer;
  transition: all 0.3s ease;
  white-space: nowrap;
}

.tab-btn.active {
  color: var(--primary-color);
  border-bottom-color: var(--primary-color);
}

.tab-btn:hover:not(.active) {
  color: var(--secondary-color);
  border-bottom-color: var(--secondary-light);
}

.tab-content {
  display: none;
}

.tab-content.active {
  display: block;
  animation: fadeIn 0.5s ease;
}

@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

.group-item {
  padding: 25px;
  background-color: white;
  border-radius: var(--border-radius);
  box-shadow: var(--box-shadow);
  margin-bottom: 25px;
  transition: all 0.4s ease;
  cursor: pointer;
}

.group-item:hover {
  transform: translateY(-5px);
  box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
}

.group-header {
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
  margin-bottom: 15px;
}

.group-title {
  color: var(--secondary-color);
  margin-bottom: 5px;
  font-size: 1.3rem;
  transition: color 0.3s ease;
}

.group-item:hover .group-title {
  color: var(--primary-color);
}

.group-type {
  background-color: var(--secondary-light);
  color: var(--text-color);
  padding: 5px 12px;
  border-radius: 50px;
  font-size: 0.85rem;
  font-weight: 600;
  display: inline-block;
}

.group-type.virtual {
  background-color: #d1ecf1;
  color: #0c5460;
}

.group-type.in-person {
  background-color: #d4edda;
  color: #155724;
}

.group-type.hybrid {
  background-color: #fff3cd;
  color: #856404;
}

.group-details {
  color: #666;
  font-size: 0.95rem;
}

.group-details p i {
  color: var(--primary-color);
  width: 20px;
  text-align: center;
  margin-right: 8px;
}

.group-action {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 20px;
}

.group-contact {
  display: flex;
  gap: 10px;
}

.contact-btn {
  display: flex;
  align-items: center;
  justify-content: center;
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: var(--light-bg);
  color: var(--text-color);
  transition: all 0.3s ease;
}

.contact-btn:hover {
  background-color: var(--primary-color);
  color: white;
  transform: translateY(-3px);
}

.search-container {
  display: flex;
  margin-bottom: 30px;
}

.search-input {
  flex: 1;
  padding: 15px;
  border: 1px solid var(--border-color);
  border-radius: var(--border-radius) 0 0 var(--border-radius);
  font-size: 1rem;
  transition: all 0.3s ease;
}

.search-input:focus {
  outline: none;
  border-color: var(--secondary-color);
  box-shadow: 0 0 0 2px rgba(69, 123, 157, 0.2);
}

.search-btn {
  background-color: var(--secondary-color);
  color: white;
  border: none;
  padding: 15px 25px;
  border-radius: 0 var(--border-radius) var(--border-radius) 0;
  cursor: pointer;
  transition: all 0.3s ease;
}

.search-btn:hover {
  background-color: var(--primary-color);
}

.testimonial {
  background-color: var(--light-bg);
  padding: 40px 0;
  margin-top: 60px;
}

.testimonial-container {
  max-width: 800px;
  margin: 0 auto;
  text-align: center;
}

.testimonial-text {
  font-size: 1.2rem;
  font-style: italic;
  margin-bottom: 20px;
  position: relative;
}

.testimonial-text::before,
.testimonial-text::after {
  content: '"';
  font-size: 3rem;
  color: var(--primary-light);
  position: absolute;
  line-height: 1;
}

.testimonial-text::before {
  top: -20px;
  left: -15px;
}

.testimonial-text::after {
  bottom: -40px;
  right: -15px;
}

.testimonial-author {
  font-weight: 600;
  color: var(--secondary-color);
}

.footer {
  background-color: var(--text-color);
  color: var(--light-text);
  padding: 60px 0 20px;
  position: relative;
  overflow: hidden;
}

.footer::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 5px;
  background: linear-gradient(90deg, var(--primary-color), var(--secondary-color), var(--primary-color));
  animation: slideGradient 10s infinite linear;
}

@keyframes slideGradient {
  0% { background-position: 0% 50%; }
  50% { background-position: 100% 50%; }
  100% { background-position: 0% 50%; }
}

.footer-content {
  display: flex;
  flex-wrap: wrap;
  gap: 40px;
  justify-content: space-between;
  margin-bottom: 40px;
}

.footer-column {
  flex: 1;
  min-width: 200px;
  transition: transform 0.3s ease;
}

.footer-column:hover {
  transform: translateY(-5px);
}

.footer-column h3 {
  font-size: 1.2rem;
  margin-bottom: 25px;
  position: relative;
}

.footer-column h3:after {
  content: '';
  position: absolute;
  width: 40px;
  height: 2px;
  background-color: var(--primary-color);
  bottom: -10px;
  left: 0;
  transition: width 0.3s ease;
}

.footer-column:hover h3:after {
  width: 60px;
}

.footer-links {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.footer-links a {
  color: var(--light-text);
  opacity: 0.8;
  transition: all 0.3s ease;
  display: inline-block;
}

.footer-links a:hover {
  opacity: 1;
  transform: translateX(8px);
  color: var(--primary-light);
}

.social-links {
  display: flex;
  gap: 15px;
  margin-top: 20px;
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
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
}

.social-links a:hover {
  background-color: var(--primary-color);
  transform: translateY(-5px) rotate(360deg);
}

.footer-bottom {
  border-top: 1px solid rgba(255, 255, 255, 0.1);
  padding-top: 20px;
  text-align: center;
  font-size: 0.9rem;
  color: rgba(255, 255, 255, 0.6);
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
  
  .support-group-tabs {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
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
  
  .footer-content {
    flex-direction: column;
  }
  
  .group-header {
    flex-direction: column;
  }
  
  .group-type {
    margin-top: 10px;
  }
  
  .search-container {
    flex-direction: column;
  }
  
  .search-input, .search-btn {
    border-radius: var(--border-radius);
    width: 100%;
  }
  
  .search-btn {
    margin-top: 10px;
  }
}
    </style>
</head>
<body>  
    <section class="hero">
        <div class="container">
            <h1><i class="fas fa-users"></i> Heart Disease Support Groups</h1>
            <p>Connect with others who understand what you're going through. Find comfort, advice, and friendship in our community of heart disease patients, survivors, and caregivers.</p>
            <a href="#find-support" class="btn"><i class="fas fa-search"></i> Find Support Near You</a>
        </div>
    </section>
    
    <section class="section" id="find-support">
        <div class="container">
            <div class="emergency-box">
                <h3><i class="fas fa-exclamation-triangle"></i> Emergency Information</h3>
                <p><strong>If you're experiencing chest pain, shortness of breath, or other heart attack symptoms:</strong></p>
                <p>Call emergency services immediately: <strong>122</strong> or your local emergency number.</p>
            </div>
            
            <div class="section-title">
                <h2>Find Support Groups</h2>
                <p>Whether you're looking for in-person meetings or virtual connections, we can help you find the right support group for your journey.</p>
            </div>
            
            <div class="search-container">
                <input type="text" class="search-input" placeholder="Enter your city or zip code..." id="location-search">
                <button class="search-btn" id="search-button"><i class="fas fa-search"></i> Search</button>
            </div>
            
            <div class="support-groups">
    <div class="support-group-tabs">
        <button class="tab-btn active" data-tab="all">All Groups</button>
        <button class="tab-btn" data-tab="in-person">In-Person</button>
        <button class="tab-btn" data-tab="virtual">Virtual</button>
        <button class="tab-btn" data-tab="patient">For Patients</button>
        <button class="tab-btn" data-tab="caregiver">For Caregivers</button>
    </div>
                
    <div class="tab-content active" id="all">
    <div class="group-item">
        <div class="group-header">
            <div>
                <h3 class="group-title">Heartbeat Connection</h3>
                <p>A supportive community for heart attack survivors</p>
            </div>
            <span class="group-type in-person">In-Person</span>
        </div>
        <div class="group-details">
            <p><i class="fas fa-map-marker-alt"></i> Community Center, 123 Main St, Chicago, IL</p>
            <p><i class="fas fa-calendar-alt"></i> Every Tuesday, 6:30 PM - 8:00 PM</p>
            <p><i class="fas fa-info-circle"></i> Open group for heart attack survivors. No registration required.</p>
        </div>
        <div class="group-action">
            <div class="group-contact">
                <a href="tel:5551234567" class="contact-btn"><i class="fas fa-phone"></i></a>
                <a href="mailto:info@heartbeatconnection.org" class="contact-btn"><i class="fas fa-envelope"></i></a>
            </div>
            <a href="#" class="btn">Learn More</a>
        </div>
    </div>
    
    <div class="group-item">
        <div class="group-header">
            <div>
                <h3 class="group-title">Heart Warriors Online</h3>
                <p>Virtual support for people living with congestive heart failure</p>
            </div>
            <span class="group-type virtual">Virtual</span>
        </div>
        <div class="group-details">
            <p><i class="fas fa-video"></i> Zoom meetings (link provided upon registration)</p>
            <p><i class="fas fa-calendar-alt"></i> Every Wednesday, 7:00 PM - 8:30 PM EST</p>
            <p><i class="fas fa-info-circle"></i> Moderated group specifically for CHF patients and their families.</p>
        </div>
        <div class="group-action">
            <div class="group-contact">
                <a href="mailto:join@heartwarriors.org" class="contact-btn"><i class="fas fa-envelope"></i></a>
                <a href="https://heartwarriors.org" target="_blank" class="contact-btn"><i class="fas fa-globe"></i></a>
            </div>
            <a href="#" class="btn">Register Now</a>
        </div>
    </div>
    
    <div class="group-item">
        <div class="group-header">
            <div>
                <h3 class="group-title">Caregiver Circle</h3>
                <p>Support for those caring for heart disease patients</p>
            </div>
            <span class="group-type hybrid">Hybrid</span>
        </div>
        <div class="group-details">
            <p><i class="fas fa-map-marker-alt"></i> Memorial Hospital, 456 Oak Ave, Boston, MA</p>
            <p><i class="fas fa-video"></i> Also available via Zoom for remote participants</p>
            <p><i class="fas fa-calendar-alt"></i> First and Third Saturday of each month, 10:00 AM - 12:00 PM</p>
            <p><i class="fas fa-info-circle"></i> Focus on emotional support and practical tips for caregivers.</p>
        </div>
        <div class="group-action">
            <div class="group-contact">
                <a href="tel:5552345678" class="contact-btn"><i class="fas fa-phone"></i></a>
                <a href="mailto:help@caregivercircle.org" class="contact-btn"><i class="fas fa-envelope"></i></a>
            </div>
            <a href="#" class="btn">Join Group</a>
        </div>
    </div>
    
    <div class="group-item">
        <div class="group-header">
            <div>
                <h3 class="group-title">Young Hearts</h3>
                <p>Support for young adults (18-40) with congenital heart defects</p>
            </div>
            <span class="group-type virtual">Virtual</span>
        </div>
        <div class="group-details">
            <p><i class="fas fa-video"></i> Discord community with weekly video meetups</p>
            <p><i class="fas fa-calendar-alt"></i> Thursdays, 8:00 PM - 9:30 PM EST</p>
            <p><i class="fas fa-info-circle"></i> Peer-led group focusing on living with CHD as a young adult.</p>
        </div>
        <div class="group-action">
            <div class="group-contact">
                <a href="mailto:hello@younghearts.org" class="contact-btn"><i class="fas fa-envelope"></i></a>
                <a href="https://discord.gg/younghearts" target="_blank" class="contact-btn"><i class="fab fa-discord"></i></a>
            </div>
            <a href="#" class="btn">Join Discord</a>
        </div>
    </div>
</div>

<div class="tab-content" id="in-person">
    <div class="group-item">
        <div class="group-header">
            <div>
                <h3 class="group-title">Heartbeat Connection</h3>
                <p>A supportive community for heart attack survivors</p>
            </div>
            <span class="group-type in-person">In-Person</span>
        </div>
        <div class="group-details">
            <p><i class="fas fa-map-marker-alt"></i> Community Center, 123 Main St, Chicago, IL</p>
            <p><i class="fas fa-calendar-alt"></i> Every Tuesday, 6:30 PM - 8:00 PM</p>
            <p><i class="fas fa-info-circle"></i> Open group for heart attack survivors. No registration required.</p>
        </div>
        <div class="group-action">
            <div class="group-contact">
                <a href="tel:5551234567" class="contact-btn"><i class="fas fa-phone"></i></a>
                <a href="mailto:info@heartbeatconnection.org" class="contact-btn"><i class="fas fa-envelope"></i></a>
            </div>
            <a href="#" class="btn">Learn More</a>
        </div>
    </div>
    
    <div class="group-item">
        <div class="group-header">
            <div>
                <h3 class="group-title">AFib Fellowship</h3>
                <p>Support for people living with atrial fibrillation</p>
            </div>
            <span class="group-type in-person">In-Person</span>
        </div>
        <div class="group-details">
            <p><i class="fas fa-map-marker-alt"></i> St. Luke's Hospital, 789 Pine St, Seattle, WA</p>
            <p><i class="fas fa-calendar-alt"></i> Second Monday of each month, 5:30 PM - 7:00 PM</p>
            <p><i class="fas fa-info-circle"></i> Educational presentations followed by group discussion.</p>
        </div>
        <div class="group-action">
            <div class="group-contact">
                <a href="tel:5553456789" class="contact-btn"><i class="fas fa-phone"></i></a>
                <a href="mailto:afib@stlukes.org" class="contact-btn"><i class="fas fa-envelope"></i></a>
            </div>
            <a href="#" class="btn">Register</a>
        </div>
    </div>
</div>

<div class="tab-content" id="virtual">
    <div class="group-item">
        <div class="group-header">
            <div>
                <h3 class="group-title">Heart Warriors Online</h3>
                <p>Virtual support for people living with congestive heart failure</p>
            </div>
            <span class="group-type virtual">Virtual</span>
        </div>
        <div class="group-details">
            <p><i class="fas fa-video"></i> Zoom meetings (link provided upon registration)</p>
            <p><i class="fas fa-calendar-alt"></i> Every Wednesday, 7:00 PM - 8:30 PM EST</p>
            <p><i class="fas fa-info-circle"></i> Moderated group specifically for CHF patients and their families.</p>
        </div>
        <div class="group-action">
            <div class="group-contact">
                <a href="mailto:join@heartwarriors.org" class="contact-btn"><i class="fas fa-envelope"></i></a>
                <a href="https://heartwarriors.org" target="_blank" class="contact-btn"><i class="fas fa-globe"></i></a>
            </div>
            <a href="#" class="btn">Register Now</a>
        </div>
    </div>
    
    <div class="group-item">
        <div class="group-header">
            <div>
                <h3 class="group-title">Young Hearts</h3>
                <p>Support for young adults (18-40) with congenital heart defects</p>
            </div>
            <span class="group-type virtual">Virtual</span>
        </div>
        <div class="group-details">
            <p><i class="fas fa-video"></i> Discord community with weekly video meetups</p>
            <p><i class="fas fa-calendar-alt"></i> Thursdays, 8:00 PM - 9:30 PM EST</p>
            <p><i class="fas fa-info-circle"></i> Peer-led group focusing on living with CHD as a young adult.</p>
        </div>
        <div class="group-action">
            <div class="group-contact">
                <a href="mailto:hello@younghearts.org" class="contact-btn"><i class="fas fa-envelope"></i></a>
                <a href="https://discord.gg/younghearts" target="_blank" class="contact-btn"><i class="fab fa-discord"></i></a>
            </div>
            <a href="#" class="btn">Join Discord</a>
        </div>
    </div>
    
    <div class="group-item">
        <div class="group-header">
            <div>
                <h3 class="group-title">Global Heart Chat</h3>
                <p>International support forum for all types of heart conditions</p>
            </div>
            <span class="group-type virtual">Virtual</span>
        </div>
        <div class="group-details">
            <p><i class="fas fa-globe"></i> 24/7 online forum with monthly webinar events</p>
            <p><i class="fas fa-calendar-alt"></i> Webinars held last Sunday of each month, 2:00 PM GMT</p>
            <p><i class="fas fa-info-circle"></i> Moderated forums in multiple languages with medical professionals available.</p>
        </div>
        <div class="group-action">
            <div class="group-contact">
                <a href="mailto:support@globalheartchat.org" class="contact-btn"><i class="fas fa-envelope"></i></a>
                <a href="https://globalheartchat.org" target="_blank" class="contact-btn"><i class="fas fa-globe"></i></a>
            </div>
            <a href="#" class="btn">Join Community</a>
        </div>
    </div>
</div>

<div class="tab-content" id="patient">
    <div class="group-item">
        <div class="group-header">
            <div>
                <h3 class="group-title">Heartbeat Connection</h3>
                <p>A supportive community for heart attack survivors</p>
            </div>
            <span class="group-type in-person">In-Person</span>
        </div>
        <div class="group-details">
            <p><i class="fas fa-map-marker-alt"></i> Community Center, 123 Main St, Chicago, IL</p>
            <p><i class="fas fa-calendar-alt"></i> Every Tuesday, 6:30 PM - 8:00 PM</p>
            <p><i class="fas fa-info-circle"></i> Open group for heart attack survivors. No registration required.</p>
        </div>
        <div class="group-action">
            <div class="group-contact">
                <a href="tel:5551234567" class="contact-btn"><i class="fas fa-phone"></i></a>
                <a href="mailto:info@heartbeatconnection.org" class="contact-btn"><i class="fas fa-envelope"></i></a>
            </div>
            <a href="#" class="btn">Learn More</a>
        </div>
    </div>
    
    <div class="group-item">
        <div class="group-header">
            <div>
                <h3 class="group-title">Heart Warriors Online</h3>
                <p>Virtual support for people living with congestive heart failure</p>
            </div>
            <span class="group-type virtual">Virtual</span>
        </div>
        <div class="group-details">
            <p><i class="fas fa-video"></i> Zoom meetings (link provided upon registration)</p>
            <p><i class="fas fa-calendar-alt"></i> Every Wednesday, 7:00 PM - 8:30 PM EST</p>
            <p><i class="fas fa-info-circle"></i> Moderated group specifically for CHF patients and their families.</p>
        </div>
        <div class="group-action">
            <div class="group-contact">
                <a href="mailto:join@heartwarriors.org" class="contact-btn"><i class="fas fa-envelope"></i></a>
                <a href="https://heartwarriors.org" target="_blank" class="contact-btn"><i class="fas fa-globe"></i></a>
            </div>
            <a href="#" class="btn">Register Now</a>
        </div>
    </div>
    
    <div class="group-item">
        <div class="group-header">
            <div>
                <h3 class="group-title">Young Hearts</h3>
                <p>Support for young adults (18-40) with congenital heart defects</p>
            </div>
            <span class="group-type virtual">Virtual</span>
        </div>
        <div class="group-details">
            <p><i class="fas fa-video"></i> Discord community with weekly video meetups</p>
            <p><i class="fas fa-calendar-alt"></i> Thursdays, 8:00 PM - 9:30 PM EST</p>
            <p><i class="fas fa-info-circle"></i> Peer-led group focusing on living with CHD as a young adult.</p>
        </div>
        <div class="group-action">
            <div class="group-contact">
                <a href="mailto:hello@younghearts.org" class="contact-btn"><i class="fas fa-envelope"></i></a>
                <a href="https://discord.gg/younghearts" target="_blank" class="contact-btn"><i class="fab fa-discord"></i></a>
            </div>
            <a href="#" class="btn">Join Discord</a>
        </div>
    </div>
</div>

<div class="tab-content" id="caregiver">
    <div class="group-item">
        <div class="group-header">
            <div>
                <h3 class="group-title">Caregiver Circle</h3>
                <p>Support for those caring for heart disease patients</p>
            </div>
            <span class="group-type hybrid">Hybrid</span>
        </div>
        <div class="group-details">
            <p><i class="fas fa-map-marker-alt"></i> Memorial Hospital, 456 Oak Ave, Boston, MA</p>
            <p><i class="fas fa-video"></i> Also available via Zoom for remote participants</p>
            <p><i class="fas fa-calendar-alt"></i> First and Third Saturday of each month, 10:00 AM - 12:00 PM</p>
            <p><i class="fas fa-info-circle"></i> Focus on emotional support and practical tips for caregivers.</p>
        </div>
        <div class="group-action">
            <div class="group-contact">
                <a href="tel:5552345678" class="contact-btn"><i class="fas fa-phone"></i></a>
                <a href="mailto:help@caregivercircle.org" class="contact-btn"><i class="fas fa-envelope"></i></a>
            </div>
            <a href="#" class="btn">Join Group</a>
        </div>
    </div>
    
    <div class="group-item">
        <div class="group-header">
            <div>
                <h3 class="group-title">Heart Family Network</h3>
                <p>Support for family members of cardiac patients</p>
            </div>
            <span class="group-type virtual">Virtual</span>
        </div>
        <div class="group-details">
            <p><i class="fas fa-video"></i> Weekly Zoom meetings plus Facebook support group</p>
            <p><i class="fas fa-calendar-alt"></i> Mondays, 7:30 PM - 9:00 PM CST</p>
            <p><i class="fas fa-info-circle"></i> Focus on coping strategies and self-care for family caregivers.</p>
        </div>
        <div class="group-action">
            <div class="group-contact">
                <a href="mailto:connect@heartfamily.net" class="contact-btn"><i class="fas fa-envelope"></i></a>
                <a href="https://facebook.com/groups/heartfamilynetwork" target="_blank" class="contact-btn"><i class="fab fa-facebook"></i></a>
            </div>
            <a href="#" class="btn">Join Group</a>
        </div>
    </div>
</div>
            
            <div class="disclaimer">
                <p><strong>Disclaimer:</strong> The support groups listed on this page are provided for informational purposes only. HeartCare Connect does not endorse any specific group and encourages you to research each organization before participating. Always consult with your healthcare provider regarding your specific medical situation.</p>
            </div>
        </div>
    </section>
    <section class="section">
        <div class="container">
            <div class="section-title">
                <h2>Additional Resources</h2>
                <p>Beyond support groups, we offer a variety of resources to help you on your heart health journey.</p>
            </div>
            
            <div class="resource-cards">
                <div class="resource-card">
                    <h3><i class="fas fa-book-medical"></i> Educational Materials</h3>
                    <p>Access free guides, videos, and articles about heart disease prevention, treatment options, and recovery strategies.</p>
                    <a href="educational-videos.php" class="btn">Browse Resources</a>
                </div>
                
                <div class="resource-card">
                    <h3><i class="fas fa-utensils"></i> Heart-Healthy Recipes</h3>
                    <p>Discover delicious recipes that support cardiovascular health and fit with dietary restrictions.</p>
                    <a href="recipes.php" class="btn">Find Recipes</a>
                </div>
            </div>
        </div>
    </section>
    <script>
       // Mobile Menu Toggle
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenu = document.getElementById('mobile-menu');
    const navLinks = document.getElementById('nav-links');
    
    if (mobileMenu) {
        mobileMenu.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    }
    
    // Fixed Tab functionality
    const tabs = document.querySelectorAll('.tab-btn');
    
    tabs.forEach(function(tab) {
        tab.addEventListener('click', function() {
            // Get the tab target from data attribute
            const tabTarget = this.getAttribute('data-tab');
            
            // Remove active class from all buttons and contents
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.remove('active');
            });
            
            // Add active class to current button
            this.classList.add('active');
            
            // Find and show the corresponding content
            const targetContent = document.getElementById(tabTarget);
            if (targetContent) {
                targetContent.classList.add('active');
            } else {
                console.error("Tab content with ID '" + tabTarget + "' not found");
            }
        });
    });
    
    // Search functionality
    const searchButton = document.getElementById('search-button');
    const locationSearch = document.getElementById('location-search');
    
    if (searchButton && locationSearch) {
        searchButton.addEventListener('click', () => {
            const searchTerm = locationSearch.value.trim().toLowerCase();
            const groupItems = document.querySelectorAll('.group-item');
            
            if (searchTerm === '') {
                groupItems.forEach(item => {
                    item.style.display = 'block';
                });
                return;
            }
            
            groupItems.forEach(item => {
                const locationText = item.querySelector('.fa-map-marker-alt')?.parentElement?.textContent.toLowerCase() || '';
                if (locationText.includes(searchTerm)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    }
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                window.scrollTo({
                    top: target.offsetTop - 100,
                    behavior: 'smooth'
                });
            }
        });
    });
});
    </script>
</body>
</html>