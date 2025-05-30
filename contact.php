<?php
session_start();
$pageTitle = "Contact Us";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Heart Health Insights</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <header>
    <?php
    $pageTitle = "Contact Us";
    include 'header.php';
    ?>
    </header>

    <section class="contact-hero">
        <div class="container">
            <div class="hero-content">
                <h2>Get in Touch</h2>
                <p>Have questions about heart health or need guidance? Our team is here to help you.</p>
            </div>
        </div>
    </section>

    <section class="contact-info-section">
        <div class="container">
            <div class="contact-grid">
                <div class="contact-info1">
                    <h3>Contact Information</h3>
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <div>
                            <h4>Address</h4>
                            <p>Dream City<br>Erbil, Kurdistan Region<br>Iraq 00964</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <div>
                            <h4>Email</h4>
                            <p>info@hearthealthinsights.com</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-phone"></i>
                        <div>
                            <h4>Phone</h4>
                            <p>+964 (750) 645-4656</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-clock"></i>
                        <div>
                            <h4>Working Hours</h4>
                            <p>Saturday - Friday: 9:00 AM - 5:00 PM</p>
                        </div>
                    </div>
                    <div class="social-links contact-social">
                        <a href="https://www.facebook.com/share/16EaaLi1EV/?mibextid=wwXIfr"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://x.com/basammerozy?s=21&t=wWivLJLlp97_xoMF3ztfrw"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.instagram.com/sam_mzury?igsh=MTJidXBkYnd6aGdyNg%3D%3D&utm_source=qr"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                
                <div class="contact-form">
                    <h3>Send Us a Message</h3>
                    <form action="process-contact.php" method="POST">
                        <div class="form-group">
                            <label for="name">Full Name</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" id="subject" name="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn primary">Send Message</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="map-section">
        <div class="container">
            <h3 class="section-title">Find Us Here</h3>
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3196.7371647318193!2d44.047720015561305!3d36.196711014288266!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x400722fe13443461%3A0x3f647fcfec74e03c!2sDream%20City%2C%20Erbil!5e0!3m2!1sen!2siq!4v1650450023412!5m2!1sen!2siq" width="100%" height="450" style="border:0; border-radius: var(--border-radius);" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <section class="faq-section bg-light" id="faq">
    <div class="container">
        <h2 class="section-title">Frequently Asked Questions</h2>
        <div class="faq-container">
            <div class="faq-item">
                <div class="faq-question">
                    <h3>How often should I get my heart health checked?</h3>
                    <span class="toggle-icon"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>For adults with no known heart disease, we recommend a baseline heart health assessment at age 20, followed by regular check-ups every 4-6 years until age 40. After 40, yearly check-ups are advisable. If you have risk factors like high blood pressure, diabetes, smoking history, or family history of heart disease, more frequent assessments may be necessary. Always consult with your healthcare provider for personalized recommendations.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3>What are the warning signs of heart disease I should watch for?</h3>
                    <span class="toggle-icon"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Important warning signs include chest pain or discomfort, shortness of breath during normal activities, unexplained fatigue, pain in the neck, jaw, throat, upper abdomen or back, and swelling in the legs, ankles, or feet. Women may experience different symptoms such as nausea, vomiting, and extreme fatigue. If you experience any of these symptoms, especially chest pain, seek immediate medical attention. Early detection is crucial for effective treatment.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3>What lifestyle changes can significantly reduce heart disease risk?</h3>
                    <span class="toggle-icon"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Several lifestyle changes can dramatically reduce your heart disease risk: maintain a heart-healthy diet rich in fruits, vegetables, whole grains, and lean proteins; engage in regular physical activity (aim for 150 minutes of moderate exercise weekly); avoid tobacco products and limit alcohol consumption; manage stress through techniques like meditation or yoga; maintain a healthy weight; get adequate sleep (7-9 hours nightly); and control conditions like high blood pressure, high cholesterol, and diabetes through proper medication and lifestyle management.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3>How can I interpret my cholesterol test results?</h3>
                    <span class="toggle-icon"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Cholesterol test results typically include: Total Cholesterol (ideally below 200 mg/dL), LDL or "bad" cholesterol (optimal is under 100 mg/dL), HDL or "good" cholesterol (higher is better, ideally above 60 mg/dL), and Triglycerides (below 150 mg/dL is desirable). However, these numbers should be interpreted in the context of your overall health profile, including factors like age, gender, family history, and other health conditions. Your healthcare provider can help explain what your specific numbers mean for your heart health and recommend appropriate actions.</p>
                </div>
            </div>

            <!-- Additional FAQs -->
            <div class="faq-item">
                <div class="faq-question">
                    <h3>What is an ECG and when is it recommended?</h3>
                    <span class="toggle-icon"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>An electrocardiogram (ECG or EKG) records the electrical activity of your heart. It’s recommended if you have symptoms like chest pain, palpitations, dizziness, or a family history of arrhythmias. An ECG can detect irregular heart rhythms, previous heart attacks, and other cardiac issues. Your doctor may perform it as part of a routine check-up if risk factors are present.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>Can heart disease be reversed?</h3>
                    <span class="toggle-icon"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>While some damage from heart disease cannot be undone, lifestyle changes and appropriate medical treatments can halt progression and even improve artery health. Dietary adjustments, regular exercise, quitting smoking, and controlling blood pressure and cholesterol can lead to plaque stabilization and regression in some cases. Always follow your cardiologist's guidance.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>How does stress affect my heart?</h3>
                    <span class="toggle-icon"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Chronic stress leads to increased heart rate and blood pressure, promoting inflammation and arterial damage over time. Stress hormones like cortisol and adrenaline can raise cholesterol levels and blood sugar. Incorporating stress-reduction practices—such as mindfulness, deep breathing, or regular physical activity—helps protect your heart.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>Are low-carb or low-fat diets better for heart health?</h3>
                    <span class="toggle-icon"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Both diets can be heart-healthy if they focus on whole, unprocessed foods. Low-carb plans should emphasize vegetables, lean proteins, and healthy fats. Low-fat diets should include whole grains, fruits, and legumes. The key is balanced nutrition, weight management, and reduced intake of refined sugars or unhealthy fats.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>What role does sleep play in heart health?</h3>
                    <span class="toggle-icon"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Poor sleep quality and insufficient duration are linked to higher blood pressure, increased inflammation, and weight gain—all risk factors for heart disease. Aim for 7–9 hours of uninterrupted sleep per night. If you suspect sleep apnea or other sleep disorders, seek evaluation from a sleep specialist.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>When should I consider taking aspirin for heart health?</h3>
                    <span class="toggle-icon"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Low-dose aspirin may be recommended for secondary prevention in those with a history of heart attack or stroke. Routine aspirin for primary prevention (no prior events) is generally not advised due to bleeding risks. Always discuss with your doctor before starting or stopping aspirin therapy.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>What is atrial fibrillation and what are its risks?</h3>
                    <span class="toggle-icon"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Atrial fibrillation (AFib) is an irregular, often rapid heart rhythm originating in the atria. It can cause palpitations, fatigue, and increased stroke risk due to clot formation in the atria. Management may include medications, electrical cardioversion, or ablation procedures to restore normal rhythm and prevent complications.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>How do I manage high blood pressure effectively?</h3>
                    <span class="toggle-icon"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Effective management includes reducing sodium intake, exercising regularly, maintaining a healthy weight, limiting alcohol, managing stress, and adhering to prescribed antihypertensive medications. Home blood pressure monitoring and regular follow-ups with your healthcare provider ensure targets are met and treatments adjusted as needed.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>What are the benefits of cardiac rehabilitation?</h3>
                    <span class="toggle-icon"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Cardiac rehab programs combine monitored exercise, education, and counseling to improve cardiovascular health after a heart event or procedure. Participants often experience improved fitness, better risk factor control, reduced symptoms, and enhanced quality of life, with a lower chance of future cardiac events.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>How does diabetes affect heart health?</h3>
                    <span class="toggle-icon"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Diabetes accelerates atherosclerosis, increases blood pressure, and raises inflammatory markers, all of which heighten heart disease risk. Tight glycemic control, blood pressure management, lipid-lowering therapy, and lifestyle modifications are crucial to minimize cardiovascular complications in diabetic patients.</p>
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question">
                    <h3>Can genetics predict my risk of heart disease?</h3>
                    <span class="toggle-icon"><i class="fas fa-plus"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Family history and certain genetic markers can indicate elevated risk for heart disease. Genetic testing may identify inherited conditions like familial hypercholesterolemia. However, genes interact with lifestyle factors, so even with a genetic predisposition, healthy habits and medical interventions can significantly reduce your overall risk.</p>
                </div>
            </div>
        </div>
    </div>
</section>


    

    <div class="chat-widget">
        <a href="chatbot.php" class="chat-button" tabindex="0">
            <i class="fas fa-comment-medical"></i>
        </a>
    </div>
    <footer>
        <?php include 'footer.php'; ?>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize FAQ accordions
            const faqItems = document.querySelectorAll('.faq-question');
            
            faqItems.forEach(item => {
                item.addEventListener('click', function() {
                    const parent = this.parentElement;
                    const answer = this.nextElementSibling;
                    const icon = this.querySelector('.toggle-icon i');
                    
                    // Toggle current item
                    parent.classList.toggle('active');
                    
                    // Toggle icon
                    if (icon.classList.contains('fa-plus')) {
                        icon.classList.remove('fa-plus');
                        icon.classList.add('fa-minus');
                    } else {
                        icon.classList.remove('fa-minus');
                        icon.classList.add('fa-plus');
                    }
                    
                    // Toggle answer visibility with slide effect
                    if (parent.classList.contains('active')) {
                        answer.style.maxHeight = answer.scrollHeight + 'px';
                    } else {
                        answer.style.maxHeight = '0';
                    }
                });
            });
            
            // Mobile menu functionality from main.js
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
            
            // Form validation
            const contactForm = document.querySelector('.contact-form form');
            if (contactForm) {
                contactForm.addEventListener('submit', function(event) {
                    const nameInput = document.getElementById('name');
                    const emailInput = document.getElementById('email');
                    const messageInput = document.getElementById('message');
                    
                    let isValid = true;
                    
                    if (nameInput.value.trim() === '') {
                        isValid = false;
                        highlightError(nameInput);
                    }
                    
                    if (emailInput.value.trim() === '' || !isValidEmail(emailInput.value)) {
                        isValid = false;
                        highlightError(emailInput);
                    }
                    
                    if (messageInput.value.trim() === '') {
                        isValid = false;
                        highlightError(messageInput);
                    }
                    
                    if (!isValid) {
                        event.preventDefault();
                    }
                });
            }
            
            function highlightError(input) {
                input.classList.add('error');
                input.addEventListener('input', function() {
                    this.classList.remove('error');
                });
            }
            
            function isValidEmail(email) {
                const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return regex.test(email);
            }
        });
    </script>

    <style>
        /* Contact Page Specific Styles */
        .contact-hero {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            padding: 5rem 0;
            text-align: center;
            position: relative;
        }
        
        .contact-hero h2 {
            color: white;
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        
        .contact-hero p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 1.2rem;
            max-width: 600px;
            margin: 0 auto;
        }
        
        .contact-info1-section {
            padding: 5rem 0;
        }
        
        .contact-grid {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 3rem;
        }
        
        .contact-info1 {
            background: white;
            border-radius: var(--border-radius);
            padding: 2.5rem;
            box-shadow: var(--box-shadow);
        }
        
        .contact-info1 h3 {
            font-size: 1.8rem;
            margin-bottom: 2rem;
            color: var(--primary-color);
        }
        
        .info-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid var(--border-color);
        }
        
        .info-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        
        .info-item i {
            font-size: 1.5rem;
            color: var(--primary-color);
            margin-right: 1.5rem;
            margin-top: 0.2rem;
        }
        
        .info-item h4 {
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }
        
        .info-item p {
            color: black;
            line-height: 1.6;
        }
        
        .contact-social {
            margin-top: 2rem;
            justify-content: flex-start;
        }
        
        .contact-form {
            background: white;
            border-radius: var(--border-radius);
            padding: 2.5rem;
            box-shadow: var(--box-shadow);
        }
        
        .contact-form h3 {
            font-size: 1.8rem;
            margin-bottom: 2rem;
            color: var(--primary-color);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-color);
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem 1.2rem;
            border: 1px solid var(--border-color);
            border-radius: var(--border-radius);
            background: #f9f9f9;
            transition: var(--transition);
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.1);
            background: white;
        }
        
        .form-group input.error,
        .form-group textarea.error {
            border-color: var(--danger-color);
            box-shadow: 0 0 0 3px rgba(220, 53, 69, 0.1);
        }
        
        .contact-form .btn {
            padding: 0.8rem 2rem;
            margin-top: 1rem;
        }
        
        .map-section {
            padding: 3rem 0 6rem;
        }
        
        .map-container {
            height: 450px;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
        }
        
        /* FAQ Styles */
        .faq-section {
            padding: 6rem 0;
        }
        
        .faq-container {
            max-width: 900px;
            margin: 0 auto;
        }
        
        .faq-item {
            background: white;
            border-radius: var(--border-radius);
            margin-bottom: 1.5rem;
            box-shadow: var(--box-shadow);
            overflow: hidden;
        }
        
        .faq-question {
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .faq-question:hover {
            background: rgba(229, 57, 53, 0.05);
        }
        
        .faq-question h3 {
            font-size: 1.2rem;
            margin-bottom: 0;
            color: var(--text-color);
            flex: 1;
        }
        
        .toggle-icon {
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
            transition: var(--transition);
        }
        
        .faq-answer {
            padding: 0 2rem;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
        
        .faq-answer p {
            padding-bottom: 1.5rem;
            color: black;
            line-height: 1.7;
        }
        
        .faq-item.active .faq-question {
            background: rgba(229, 57, 53, 0.05);
        }
        
        /* Responsive Styles */
        @media (max-width: 992px) {
            .contact-grid {
                grid-template-columns: 1fr;
            }
            
            .contact-info1 {
                margin-bottom: 2rem;
            }
        }
        
        @media (max-width: 768px) {
            .contact-hero h2 {
                font-size: 2.5rem;
            }
            
            .contact-hero p {
                font-size: 1.1rem;
            }
            
            .map-container {
                height: 350px;
            }
            
            .contact-form,
            .contact-info1 {
                padding: 2rem;
            }
        }
        
        @media (max-width: 576px) {
            .contact-hero h2 {
                font-size: 2rem;
            }
            
            .contact-hero p {
                font-size: 1rem;
            }
            
            .faq-question {
                padding: 1.2rem 1.5rem;
            }
            
            .faq-question h3 {
                font-size: 1.1rem;
            }
            
            .faq-answer {
                padding: 0 1.5rem;
            }
        }
    </style>
</body>
</html>