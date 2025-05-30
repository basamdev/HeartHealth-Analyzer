<?php
session_start();
$pageTitle = "Home";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heart Health Insights - Understanding and Preventing Heart Disease</title>
</head>
<header>
    <?php
include 'header.php';
?>
    </header>
<body>
    <section class="hero">
        <div class="container">
            <div class="hero-content">
                <h2>Take Control of Your Heart Health Today</h2>
                <p>Understanding heart disease is the first step toward prevention. Explore our resources and tools to assess your risk and make informed decisions about your health.</p>
                <div class="cta-buttons">
                    <a href="symptom-checker.php" class="btn primary">Check Your Symptoms</a>
                    <a href="LearnAboutHeartDisease.php" class="btn secondary">Learn More</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="image/heart.jpg" alt="Heart Health Illustration">
            </div>
        </div>
    </section>

    <section class="features">
        <div class="container">
            <h2 class="section-title">How We Help You</h2>
            <div class="feature-cards">
                <div class="feature-card">
                    <div class="icon">
                        <i class="fas fa-book-medical"></i>
                    </div>
                    <h3>Heart Disease Education</h3>
                    <p>Access comprehensive information about various heart conditions, symptoms, and treatment options.</p>
                    <a href="educational-videos.php" class="read-more">Learn More <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="feature-card">
                    <div class="icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h3>Symptom Checker</h3>
                    <p>Identify potential heart-related symptoms and understand when to seek medical attention.</p>
                    <a href="symptom-checker.php" class="read-more">Try It Now <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="feature-card">
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>Community</h</h3>
                    <p>Together, we empower each other to understand and reduce our heart disease risk—one health profile at a time.</p>
                    <a href="support-groups.php" class="read-more"> Enjoy Life <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="feature-card">
                    <div class="icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3>Health Assistant</h3>
                    <p>Chat with our AI-powered assistant to get answers to your heart health questions.</p>
                    <a href="chatbot.php" class="read-more">Start Chatting <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section class="stats bg-light">
        <div class="container">
            <h2 class="section-title">Heart Disease: By The Numbers</h2>
            <div class="stats-container">
                <div class="stat-box">
                    <div class="stat-number">17.9M</div>
                    <div class="stat-text">Annual deaths worldwide from cardiovascular diseases<br>                                    
                                                                 </br></div>
                </div>
                <div class="stat-box">
                    <div class="stat-number">80%</div>
                    <div class="stat-text">Heart disease cases are preventable with lifestyle changes</div>
                </div>
                <div class="stat-box">
                    <div class="stat-number">1 in 4</div>
                    <div class="stat-text">Deaths are caused by heart disease</div>
                </div>
                <div class="stat-box">
                    <div class="stat-number">50%</div>
                    <div class="stat-text">Risk reduction with early detection and intervention</div>
                </div>
            </div>
        </div>
    </section>

    <section class="testimonials">
        <div class="container">
        <h2 class="section-title">Support & Resources</h2>
            <div class="support-grid">
                <div class="support-card">
                    <div class="card-icon">
                        <i class="fas fa-file-medical"></i>
                    </div>
                    <div class="card-content">
                        <h3>Healthcare Resources</h3>
                        <p>Access our collection of heart health guides, educational materials, and recommended tools created by medical professionals.</p>
                        <a href="resources.php" class="action-link">View Resources</a>
                    </div>
                </div>
                <div class="support-card">
                    <div class="card-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="card-content">
                        <h3>Get in Touch</h3>
                        <p>Have questions about heart health or need personalized guidance? Our team of healthcare professionals is here to help.</p>
                        <a href="contact.php" class="action-link">Contact Us</a>
                    </div>
                </div>
                <div class="support-card">
                    <div class="card-icon">
                        <i class="fas fa-question-circle"></i>
                    </div>
                    <div class="card-content">
                        <h3>FAQ Center</h3>
                        <p>Find answers to frequently asked questions about heart conditions, prevention strategies, and treatment options.</p>
                        <a href="contact.php#faq" class="action-link">Read FAQs</a>
                    </div>
                </div>
            </div>
            <div class="testimonial-dots">
                <span class="dot active"></span>
                <span class="dot"></span>
            </div>
        </div>
    </section>

    <section class="call-to-action">
        <div class="container">
            <div class="cta-content">
                <h2>Take the First Step Toward Better Heart Health</h2>
                <p>Complete our comprehensive symptoms checker to understand your personal risk factors and receive tailored recommendations.</p>
                <a href="heart-symptom-checker.php" class="btn primary large">Check Your symptoms Now</a>
            </div>
        </div>
    </section>

    <footer>
    <div class="container">
        <div class="footer-content">
            <div class="footer-section about">
                <h3>About Heart Health Insights</h3>
                <p>We are dedicated to providing accessible information on heart disease to empower individuals to make informed health decisions.</p>
                <div class="social-links">
                    <a href="https://www.facebook.com/share/16EaaLi1EV/?mibextid=wwXIfr"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://x.com/basammerozy?s=21&t=wWivLJLlp97_xoMF3ztfrw"><i class="fab fa-twitter"></i></a>
                    <a href="https://www.instagram.com/sam_mzury?igsh=MTJidXBkYnd6aGdyNg%3D%3D&utm_source=qr"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="footer-section quick-links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="dashboard.php">Home</a></li>
                    <li><a href="education.html">Learn About Heart Disease</a></li>
                    <li><a href="symptom-checker.php">Symptom Checker</a></li>
                    <li><a href="Resources.php">Resources</a></li>
                    <li><a href="contact.php">Contact</a></li>  
                </ul>
            </div>
            <div class="footer-section contact-info">
                <h3>Contact Information</h3>
                <p><i class="fas fa-map-marker-alt"></i>Dream City<br>Erbil, AR 00964</p>
                <p><i class="fas fa-envelope"></i> info@hearthealthinsights.com</p>
                <p><i class="fas fa-phone"></i> +964 (750) 645-4656</p>
                <p><i class="fas fa-clock"></i> Sat-Fri: 9:00 AM - 5:00 PM</p>
            </div>
        </div>
        </div>
    </footer>

    <div class="chat-widget">
    <a href="chatbot.php" class="chat-button" tabindex="0">
    <script src="js/main.js">
// Main JavaScript file for Heart Health Insights

document.addEventListener('DOMContentLoaded', function() {
    // Initialize mobile menu
    initMobileMenu();
    
    // Initialize testimonial slider
    initTestimonialSlider();
    
    // Initialize chat widget
    initChatWidget();
    
    // Initialize scroll animations
    initScrollAnimations();
});

// Mobile Menu Toggle
function initMobileMenu() {
    const mobileMenuButton = document.querySelector('.mobile-menu');
    const navMenu = document.querySelector('nav ul');
    
    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', function() {
            navMenu.classList.toggle('show');
            // Toggle between menu icon and close icon
            const icon = this.querySelector('i');
            if (icon.classList.contains('fa-bars')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
    }
    
    // Close menu when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('nav') && navMenu.classList.contains('show')) {
            navMenu.classList.remove('show');
            const icon = mobileMenuButton.querySelector('i');
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        }
    });
}

// Testimonial Slider
function initTestimonialSlider() {
    const testimonials = document.querySelectorAll('.testimonial');
    const dots = document.querySelectorAll('.dot');
    let currentSlide = 0;
    
    // Hide all testimonials except the first one
    if (testimonials.length > 1) {
        for (let i = 1; i < testimonials.length; i++) {
            testimonials[i].style.display = 'none';
        }
    }
    
    // Add click event to dots
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            showSlide(index);
        });
    });
    
    // Auto rotate testimonials every 5 seconds
    if (testimonials.length > 1) {
        setInterval(() => {
            currentSlide = (currentSlide + 1) % testimonials.length;
            showSlide(currentSlide);
        }, 5000);
    }
    
    function showSlide(index) {
        // Hide all testimonials
        testimonials.forEach(testimonial => {
            testimonial.style.display = 'none';
        });
        
        // Remove active class from all dots
        dots.forEach(dot => {
            dot.classList.remove('active');
        });
        
        // Show selected testimonial and activate corresponding dot
        testimonials[index].style.display = 'block';
        dots[index].classList.add('active');
        
        // Add fade-in animation
        testimonials[index].classList.add('fade-in');
        setTimeout(() => {
            testimonials[index].classList.remove('fade-in');
        }, 500);
        
        currentSlide = index;
    }
}

// Add smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        
        const targetId = this.getAttribute('href');
        if (targetId === '#') return;
        
        const targetElement = document.querySelector(targetId);
        if (targetElement) {
            window.scrollTo({
                top: targetElement.offsetTop - 100,
                behavior: 'smooth'
            });
        }
    });
});

// Add active class to navigation links based on scroll position
window.addEventListener('scroll', function() {
    const scrollPosition = window.scrollY;
    const navLinks = document.querySelectorAll('nav ul li a');
    const sections = document.querySelectorAll('section');
    
    sections.forEach((section, index) => {
        const sectionTop = section.offsetTop - 150;
        const sectionHeight = section.offsetHeight;
        const sectionId = section.id;
        
        if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + sectionId) {
                    link.classList.add('active');
                }
            });
        }
    });
});



// Risk calculator preview for demonstration purposes
// This would be expanded in the full risk assessment page
function calculateRiskPreview() {
    // Sample function to be called from risk assessment buttons
    const age = document.getElementById('age') ? document.getElementById('age').value : 0;
    const systolic = document.getElementById('systolic') ? document.getElementById('systolic').value : 0;
    const cholesterol = document.getElementById('cholesterol') ? document.getElementById('cholesterol').value : 0;
    
    if (age && systolic && cholesterol) {
        // This is a simplified demo calculation - not medically accurate
        let risk = 0;
        
        if (age > 50) risk += 5;
        if (systolic > 140) risk += 10;
        if (cholesterol > 200) risk += 8;
        
        // Redirect to full assessment with preliminary data
        window.location.href = `risk-assessment.html?preview=${risk}`;
    } else {
        alert('Please complete all fields for a preliminary assessment.');
    }
}

// Newsletter subscription
function subscribeNewsletter() {
    const emailInput = document.getElementById('newsletter-email');
    if (emailInput) {
        const email = emailInput.value.trim();
        if (email && email.includes('@') && email.includes('.')) {
            // In production, this would call an API to register the email
            alert('Thank you for subscribing to our newsletter!');
            emailInput.value = '';
        } else {
            alert('Please enter a valid email address.');
        }
    }
}

// Add CSS class for animations
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        document.body.classList.add('loaded');
    }, 300);
});
    </script>
</body>
</html>

<style>
/* Global Styles */
:root {
  --primary-color: #e63946;
  --primary-light: #f8d7da;
  --primary-dark: #c1121f;
  --secondary-color: #457b9d;
  --secondary-light: #a8dadc;
  --text-color: #1d3557;
  --light-text:rgb(0, 0, 0);
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
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: var(--font-body);
    color: var(--text-color);
    line-height: 1.7;
    /* Modern abstract medical background */
    background-color:rgb(252, 248, 248);
    background-size: 40px 40px;
    background-position: 0 0, 20px 20px;
    background-attachment: fixed;
}

.container {
    width: 90%;
    max-width: 1300px;
    margin: 0 auto;
    padding: 0 20px;
}

h1, h2, h3, h4, h5, h6 {
    font-family: var(--font-heading);
    margin-bottom: 1rem;
    font-weight: 600;
    letter-spacing: -0.03em;
    line-height: 1.2;
}

.section-title {
    text-align: center;
    margin-bottom: 3rem;
    position: relative;
    font-size: 2.5rem;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.section-title:after {
    content: '';
    display: block;
    width: 80px;
    height: 4px;
    background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
    margin: 25px auto 0;
    border-radius: 4px;
}

a {
    text-decoration: none;
    color: var(--primary-color);
    transition: var(--transition);
}

a:hover {
    color: var(--secondary-color);
}
.support-section {
    padding: 60px 0;
    position: relative;
    overflow: hidden;
}

.support-section::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(108,99,255,0.1) 0%, rgba(255,255,255,0) 70%);
    border-radius: 50%;
    z-index: 1;
}

.section-title {
    text-align: center;
    margin-bottom: 50px;
    font-size: 2.5rem;
    color: #c62828; /* Updated to match style#2 primary color gradient end */
    position: relative;
    font-weight: 700;
}

.section-title::after {
    content: '';
    display: block;
    width: 80px;
    height: 4px;
    background: linear-gradient(135deg, var(--primary-color), #c62828); /* Updated to match btn.primary gradient */
    margin: 15px auto 0;
    border-radius: 2px;
}

.support-grid {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 30px;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.support-card {
    flex: 1;
    min-width: 300px;
    max-width: 350px;
    border-radius: 16px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); /* Updated to match style#2 box-shadow color */
    overflow: hidden;
    transition: all 0.35s ease-in-out;
    position: relative;
    z-index: 2;
}

.support-card:hover {
    transform: translateY(-15px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15); /* Updated to match style#2 hover box-shadow */
}

.card-icon {
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: var(--primary-color); /* Updated to match style#2 primary color variable */
    background: linear-gradient(135deg, #f8f9fc 0%, #ffffff 100%); /* Updated to match style#2 bg-light */
    transition: all 0.3s ease;
}

.support-card:hover .card-icon {
    color: #303f9f; /* Updated to match style#2 secondary color gradient end */
    transform: scale(1.1);
}

.card-content {
    padding: 25px;
    text-align: center;
}

.card-content h3 {
    font-size: 1.5rem;
    color: var(--primary-color); /* Updated to match style#2 primary color variable */
    margin-bottom: 15px;
    font-weight: 600;
    transition: color 0.3s ease;
}

.support-card:hover .card-content h3 {
    color: #c62828; /* Updated to match style#2 primary color gradient end */
}

.card-content p {
    color:rgb(0, 0, 0); /* Updated to match style#2 secondary color gradient end */
    margin-bottom: 25px;
    line-height: 1.6;
}

.action-link {
    display: inline-block;
    padding: 10px 25px;
    background: linear-gradient(to right, #6c63ff, #4e54c8);
    color: #ffffff;
    text-decoration: none;
    border-radius: 30px;
    font-weight: 500;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.action-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(to right, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.7s ease;
}

.action-link:hover::before {
    left: 100%;
}

.action-link:hover {
    box-shadow: 0 5px 15px rgba(108, 99, 255, 0.4);
    transform: translateY(-3px);
}

/* Animation classes */
.fade-in {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.6s ease-out, transform 0.6s ease-out;
}

.fade-in.visible {
    opacity: 1;
    transform: translateY(0);
}

@media (max-width: 768px) {
    .support-grid {
        flex-direction: column;
        align-items: center;
    }
    
    .support-card {
        width: 100%;
    }
}
img {
    border-radius:100%;/* Makes all images circular */
}

.bg-light {
    background: linear-gradient(135deg, #f8f9fc 0%, #ffffff 100%);
}

section {
    padding: 6rem 0;
    position: relative;
    overflow: hidden;
}

/* Glass effect overlay */
section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.6);
    backdrop-filter: blur(5px);
    z-index: -1;
}

/* Button Styles */
.btn {
    display: inline-block;
    padding: 14px 28px;
    border-radius: 30px;
    font-weight: 600;
    text-align: center;
    transition: var(--transition);
    cursor: pointer;
    border: none;
    background: transparent;
    position: relative;
    overflow: hidden;
}

.btn.primary {
    background: linear-gradient(135deg, var(--primary-color), #c62828);
    color: white;
    box-shadow: 0 4px 15px rgba(229, 57, 53, 0.4);
}

.btn.secondary {
    background: linear-gradient(135deg, var(--secondary-color), #303f9f);
    color: white;
    box-shadow: 0 4px 15px rgba(57, 73, 171, 0.4);
}

.btn.outline {
    border: 2px solid var(--primary-color);
    color: var(--primary-color);
    background: transparent;
}

.btn.large {
    padding: 16px 36px;
    font-size: 1.1rem;
}

.btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

.btn.primary:hover {
    background: linear-gradient(135deg, #c62828, var(--primary-color));
}

.btn.secondary:hover {
    background: linear-gradient(135deg, #303f9f, var(--secondary-color));
}

.btn::after {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, rgba(255,255,255,0) 70%);
    transform: scale(0);
    transition: transform 0.5s ease;
}

.btn:hover::after {
    transform: scale(1);
}

/* Header Styles */

.logo {
    display: flex;
    align-items: center;
}

.logo img {
    height: 45px;
    margin-right: 12px;
}

.logo h1 {
    font-size: 1.5rem;
    margin-bottom: 0;
    font-weight: 700;
}

.logo span {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

nav ul {
    display: flex;
    list-style: none;
}

nav ul li {
    margin-left: 2rem;
}

nav ul li a {
    color: var(--text-color);
    font-weight: 500;
    padding: 0.5rem 0;
    position: relative;
    transition: var(--transition);
}

nav ul li a:hover, nav ul li a.active {
    color: var(--primary-color);
}

nav ul li a::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
    transform: scaleX(0);
    transition: transform 0.3s ease;
}

nav ul li a:hover::after, nav ul li a.active::after {
    transform: scaleX(1);
}

.mobile-menu {
    display: none;
    font-size: 1.5rem;
    cursor: pointer;
}

/* Hero Section */
.hero {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    background-size: cover;
    background-position: center;
    padding: 7rem 0;
    position: relative;
}

.hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23e8e8e8' fill-opacity='0.4' fill-rule='evenodd'/%3E%3C/svg%3E");
    opacity: 0.5;
}

.hero .container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    position: relative;
    z-index: 1;
}

.hero-content {
    flex: 1;
    padding-right: 3rem;
}

.hero-content h2 {
    font-size: 3rem;
    margin-bottom: 1.5rem;
    color: var(--text-color);
    font-weight: 700;
    line-height: 1.2;
}

.hero-content p {
    font-size: 1.2rem;
    margin-bottom: 2.5rem;
    color: var(--light-text);
    max-width: 600px;
}

.cta-buttons {
    display: flex;
    gap: 1.5rem;
}

.hero-image {
    flex: 1;
    display: flex;
    justify-content: center;
    position: relative;
}

.hero-image img {
    max-width: 50%;
    animation: float 6s ease-in-out infinite;
    filter: drop-shadow(0 10px 30px rgba(0, 0, 0, 0.1));
}

@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
    100% { transform: translateY(0px); }
}

/* Features Section */
.feature-cards {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 2rem;
}

.feature-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    border-radius: var(--border-radius);
    padding: 2.5rem;
    box-shadow: var(--shadow);
    transition: var(--transition);
    text-align: center;
    position: relative;
    overflow: hidden;
}

.feature-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(229, 57, 53, 0.05), rgba(57, 73, 171, 0.05));
    z-index: -1;
    transition: var(--transition);
    opacity: 0;
}

.feature-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-lg);
}

.feature-card:hover::before {
    opacity: 1;
}

.feature-card .icon {
    width: 85px;
    height: 85px;
    background: linear-gradient(135deg, rgba(229, 57, 53, 0.1), rgba(57, 73, 171, 0.1));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    transition: var(--transition);
}

.feature-card:hover .icon {
    transform: scale(1.1);
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
}

.feature-card .icon i {
    font-size: 2.2rem;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    transition: var(--transition);
}

.feature-card:hover .icon i {
    -webkit-text-fill-color: white;
}

.feature-card h3 {
    margin-bottom: 1rem;
    font-size: 1.3rem;
}

.feature-card p {
    color: var(--light-text);
    margin-bottom: 1.5rem;
}

.read-more {
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    color: var(--primary-color);
}

.read-more i {
    margin-left: 8px;
    transition: transform 0.3s ease;
}

.read-more:hover i {
    transform: translateX(5px);
}

/* Stats Section */
.stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 2rem;
}

.stat-box {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.9), rgba(248, 249, 252, 0.9));
    backdrop-filter: blur(10px);
    border-radius: var(--border-radius);
    padding: 3rem 2rem;
    text-align: center;
    box-shadow: var(--shadow);
    position: relative;
    overflow: hidden;
    transition: var(--transition);
}

.stat-box::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(229, 57, 53, 0.1) 0%, transparent 70%);
    transform: rotate(45deg);
    transition: var(--transition);
    z-index: 0;
}

.stat-box:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.stat-box:hover::before {
    transform: rotate(45deg) scale(1.2);
}

.stat-number {
    font-size: 3rem;
    font-weight: 700;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
    position: relative;
    z-index: 1;
}

.stat-text {
    color: var(--light-text);
    font-weight: 500;
    position: relative;
    z-index: 1;
}

/* Testimonials Section */
.testimonials {
    background: linear-gradient(135deg, #f8f9fc 0%, #ffffff 100%);
    position: relative;
}

.testimonials::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23e8e8e8' fill-opacity='0.2'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    opacity: 0.5;
}

.testimonial-slider {
    max-width: 900px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
}

.testimonial {
    background: rgb(255, 255, 255);
    backdrop-filter: blur(10px);
    border-radius: var(--border-radius);
    padding: 3rem;
    box-shadow: var(--shadow);
    margin-bottom: 2rem;
    transition: var(--transition);
}

.testimonial:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
}

.testimonial-content {
    font-style: italic;
    margin-bottom: 2rem;
    font-size: 1.1rem;
    line-height: 1.8;
    position: relative;
}

.testimonial-content::before {
    content: '"';
    position: absolute;
    top: -15px;
    left: -10px;
    font-size: 4rem;
    color: var(--primary-color);
    opacity: 0.2;
}

.testimonial-author {
    display: flex;
    align-items: center;
}

.testimonial-author img {
    width: 70px;
    height: 70px;
    border-radius: 50%; /* Makes the image circular */
    margin-right: 1.5rem;
    border: 3px solid var(--primary-color);
    padding: 3px;
    background: white;
}

.author-info h4 {
    margin-bottom: 0.3rem;
    font-size: 1.2rem;
}

.author-info p {
    color: var(--light-text);
    font-size: 0.9rem;
}

.testimonial-dots {
    display: flex;
    justify-content: center;
    gap: 12px;
}

.dot {
    width: 12px;
    height: 12px;
    background-color: #ddd;
    border-radius: 50%;
    cursor: pointer;
    transition: var(--transition);
}

.dot.active {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    transform: scale(1.3);
}

/* Call to Action */
.call-to-action {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.call-to-action::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'%3E%3Cpath d='M0 40L40 0H20L0 20M40 40V20L20 40'/%3E%3C/g%3E%3C/svg%3E");
}

.cta-content {
    max-width: 800px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
}

.cta-content h2 {
    margin-bottom: 1rem;
    font-size: 2.5rem;
}

.cta-content p {
    margin-bottom: 2.5rem;
    opacity: 0.9;
    font-size: 1.1rem;
}

/* Footer Styles */
footer {
    background: linear-gradient(180deg, #1a1a1a 0%, #111111 100%);
    color: #f1f1f1;
    padding: 5rem 0 1rem;
}

.footer-content {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 3rem;
    margin-bottom: 3rem;
}

.footer-section h3 {
    color: white;
    position: relative;
    padding-bottom: 15px;
    margin-bottom: 25px;
    font-size: 1.4rem;
}

.footer-section h3:after {
    content: '';
    position: absolute;
    left: 0;
    bottom: 0;
    width: 50px;
    height: 3px;
    background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
}

.social-links {
    display: flex;
    gap: 15px;
    margin-top: 25px;
}

.social-links a {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
    color: white;
    transition: var(--transition);
}

.social-links a:hover {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    transform: translateY(-5px);
}

.quick-links ul {
    list-style: none;
}

.quick-links ul li {
    margin-bottom: 12px;
}

.quick-links ul li a {
    color: #ccc;
    transition: var(--transition);
    position: relative;
}

.quick-links ul li a:hover {
    color: white;
    padding-left: 10px;
}

.contact-info p {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    color: #ccc;
}

.contact-info p i {
    margin-right: 15px;
    color: var(--primary-color);
    width: 20px;
    text-align: center;
}

.footer-bottom {
    text-align: center;
    padding-top: 30px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.disclaimer {
    font-size: 0.85rem;
    margin-top: 15px;
    color: #999;
}

/* Chat Widget */
.chat-widget {
    position: fixed;
    bottom: 40px;
    right: 40px;
    z-index: 999;
}

.chat-button {
    width: 65px;
    height: 65px;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: white;
    font-size: 1.5rem;
    box-shadow: 0 4px 20px rgba(229, 57, 53, 0.3);
    transition: var(--transition);
}

.chat-button:hover {
    transform: scale(1.1);
    box-shadow: 0 6px 25px rgba(229, 57, 53, 0.4);
}

.chat-box {
    position: absolute;
    bottom: 85px;
    right: 0;
    width: 380px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(10px);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    display: none;
}

.chat-header {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    padding: 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.chat-header h4 {
    margin: 0;
    font-size: 1.2rem;
}

.close-chat {
    cursor: pointer;
    font-size: 1.2rem;
    transition: var(--transition);
}

.close-chat:hover {
    transform: scale(1.2);
}

.chat-messages {
    height: 350px;
    padding: 20px;
    overflow-y: auto;
    background: rgba(248, 249, 252, 0.8);
}

.message {
    padding: 12px 18px;
    border-radius: 20px;
    margin-bottom: 15px;
    max-width: 80%;
    animation: fadeInUp 0.3s ease;
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.message.bot {
    background: white;
    border-top-left-radius: 5px;
    align-self: flex-start;
    box-shadow: var(--shadow-sm);
}

.message.user {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    border-top-right-radius: 5px;
    align-self: flex-end;
    margin-left: auto;
    box-shadow: var(--shadow-sm);
}

.chat-input {
    display: flex;
    padding: 15px;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    background: white;
}

.chat-input input {
    flex: 1;
    padding: 12px 18px;
    border: 2px solid #eee;
    border-radius: 25px;
    outline: none;
    transition: var(--transition);
}

.chat-input input:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.1);
}

.chat-input button {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    border: none;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    margin-left: 15px;
    cursor: pointer;
    transition: var(--transition);
    font-size: 1.2rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.chat-input button:hover {
    transform: scale(1.1);
    box-shadow: 0 4px 15px rgba(229, 57, 53, 0.3);
}

/* Responsive Styles */
@media (max-width: 992px) {
    .hero .container {
        flex-direction: column;
    }
    
    .hero-content {
        text-align: center;
        padding-right: 0;
        margin-bottom: 4rem;
    }
    
    .cta-buttons {
        justify-content: center;
    }

    .section-title {
        font-size: 2.2rem;
    }
}

@media (max-width: 768px) {
    nav ul {
        display: none;
    }
    
    .mobile-menu {
        display: block;
    }
    
    .footer-content {
        grid-template-columns: 1fr;
    }
    
    .footer-section {
        text-align: center;
    }
    
    .footer-section h3:after {
        left: 50%;
        transform: translateX(-50%);
    }
    
    .social-links {
        justify-content: center;
    }
    
    .chat-box {
        width: 320px;
        right: -10px;
    }
    
    .hero-content h2 {
        font-size: 2.5rem;
    }
}

@media (max-width: 576px) {
    .section-title {
        font-size: 1.8rem;
    }
    
    .hero-content h2 {
        font-size: 2rem;
    }
    
    .feature-cards {
        grid-template-columns: 1fr;
    }
    
    .stats-container {
        grid-template-columns: 1fr;
    }
    
    .testimonial {
        padding: 2rem;
    }
    
    .chat-box {
        width: 290px;
        right: -20px;
    }
    
    .btn {
        padding: 12px 24px;
    }
    
    .btn.large {
        padding: 14px 28px;
    }
    
    .cta-content h2 {
        font-size: 2rem;
    }
    
    .testimonial-author img {
        width: 60px;
        height: 60px;
    }
}

@media (max-width: 480px) {
    .cta-buttons {
        flex-direction: column;
        gap: 1rem;
    }
    
    .chat-box {
        width: 260px;
        right: -25px;
    }
    
    .testimonial-author {
        flex-direction: column;
        text-align: center;
    }
    
    .testimonial-author img {
        margin-right: 0;
        margin-bottom: 1rem;
    }
}
