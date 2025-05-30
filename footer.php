<?php
/**
 * Footer template for Heart Health Insights website
 * 
 * This file contains the footer section that can be included
 * in all pages of the website for consistent design.
 */
?>
<style>
    /**
 * Footer styles for Heart Health Insights website
 */

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

/* Responsive Footer Styles */
@media (max-width: 768px) {
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
}

@media (max-width: 576px) {
    .chat-box {
        width: 290px;
        right: -20px;
    }
}

@media (max-width: 480px) {
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
</style>
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
        <i class="fas fa-comment-medical"></i>
    </a>
</div>
