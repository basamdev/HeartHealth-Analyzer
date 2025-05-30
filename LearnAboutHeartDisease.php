<?php
session_start();
$pageTitle = "Learn About Heart Disease";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learn About Heart Disease - Heart Health Insights</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
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
   
        .education-hero {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
    padding: 80px 0;
    text-align: center;
    position: relative;
    overflow: hidden;
}

.education-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
}

.education-hero h1 {
    margin-bottom: 20px;
    font-size: 2.8rem;
    position: relative;
    display: inline-block;
    transform: translateY(0);
    transition: transform 0.5s ease;
}

.education-hero h1:hover {
    transform: translateY(-5px);
}

.education-hero h1 i {
    animation: heartbeat 1.5s infinite;
}

.education-hero p {
    max-width: 700px;
    margin: 0 auto 30px;
    font-size: 1.1rem;
    opacity: 0.9;
}

.search-box {
    max-width: 600px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    gap: 10px;
    position: relative;
}

.search-box input {
    width: 100%;
    padding: 15px 20px;
    border-radius: 50px;
    border: none;
    font-size: 1rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    transition: all 0.3s ease;
}

.search-box input:focus {
    outline: none;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
    transform: translateY(-2px);
}

.search-btn {
    background-color: var(--primary-color);
    color: white;
    border-radius: 50px;
    padding: 12px 24px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.4s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.search-btn:hover {
    background-color: var(--primary-dark);
    transform: translateY(-3px);
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15);
}



        .condition-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--shadow);
            transition: var(--transition);
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
        }

        .condition-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .condition-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        }

        .condition-card h3 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        .accordion {
            background: rgba(255, 255, 255, 0.9);
            border-radius: var(--border-radius);
            margin-bottom: 1rem;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        

        .accordion-icon {
            transition: var(--transition);
        }

        .accordion-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
            padding: 0 1.5rem;
        }

        .accordion.active .accordion-content {
            max-height: 1000px;
            padding: 1.5rem;
        }

        .accordion.active .accordion-icon {
            transform: rotate(180deg);
        }

        .symptoms-list, .treatments-list, .prevention-list {
            padding-left: 20px;
        }

        .symptoms-list li, .treatments-list li, .prevention-list li {
            margin-bottom: 0.8rem;
            position: relative;
            padding-left: 1.5rem;
        }

        .symptoms-list li::before {
            content: "\f753";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            color: var(--warning-color);
            position: absolute;
            left: 0;
        }

        .treatments-list li::before {
            content: "\f469";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            color: var(--success-color);
            position: absolute;
            left: 0;
        }

        .prevention-list li::before {
            content: "\f05e";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            color: var(--accent-color);
            position: absolute;
            left: 0;
        }

        .resources-section {
            background: linear-gradient(135deg, #f8f9fc 0%, #ffffff 100%);
        }

        .resource-cards {
            display: inline-flex;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 2rem;
        }

        .resource-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--shadow);
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .resource-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-lg);
        }

        .resource-card .icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, rgba(229, 57, 53, 0.1), rgba(57, 73, 171, 0.1));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            transition: var(--transition);
        }

        .resource-card:hover .icon {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        }

        .resource-card .icon i {
            font-size: 1.5rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            transition: var(--transition);
        }

        .resource-card:hover .icon i {
            -webkit-text-fill-color: white;
        }

        .resource-card h4 {
            margin-bottom: 1rem;
            font-size: 1.2rem;
        }

        .resource-card p {
            color: var(--light-text);
            margin-bottom: 1.5rem;
            flex-grow: 1;
        }

        .tab-navigation {
            display: flex;
            margin-bottom: 2rem;
            overflow-x: auto;
            border-radius: var(--border-radius);
            background: rgba(255, 255, 255, 0.8);
            box-shadow: var(--shadow-sm);
        }

        .tab-button {
            padding: 1.2rem 2rem;
            background: transparent;
            border: none;
            cursor: pointer;
            font-weight: 600;
            color: var(--light-text);
            transition: var(--transition);
            flex: 1;
            text-align: center;
            position: relative;
            white-space: nowrap;
        }

        .tab-button:hover {
            color: var(--primary-color);
        }

        .tab-button.active {
            color: var(--primary-color);
        }

        .tab-button.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .info-box {
            background: linear-gradient(135deg, rgba(0, 172, 193, 0.1), rgba(57, 73, 171, 0.1));
            border-left: 4px solid var(--accent-color);
            padding: 1.5rem;
            border-radius: 0 var(--border-radius) var(--border-radius) 0;
            margin: 2rem 0;
        }

        .warning-box {
            background: linear-gradient(135deg, rgba(255, 167, 38, 0.1), rgba(229, 57, 53, 0.1));
            border-left: 4px solid var(--warning-color);
            padding: 1.5rem;
            border-radius: 0 var(--border-radius) var(--border-radius) 0;
            margin: 2rem 0;
        }
        
        .search-box {
            margin-bottom: 2rem;
            position: relative;
        }
        
        .search-box input {
            width: 100%;
            padding: 1rem 1.5rem;
            padding-left: 3rem;
            border: 2px solid #eee;
            border-radius: var(--border-radius);
            transition: var(--transition);
            font-size: 1rem;
        }
        
        .search-box input:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(229, 57, 53, 0.1);
            outline: none;
        }
        
        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--light-text);
        }
    </style>
</head>
<body>
    <header>
        <?php include 'header.php'; ?>
    </header>

    <section class="education-hero">
        <div class="container">
            <div class="hero-content">
                <h2>Understanding Heart Disease</h2>
                <p>Access comprehensive information about various heart conditions, symptoms, treatment options, and prevention strategies to better manage your heart health.</p>
                <div class="search-box">
                    <i class="fas fa-search"></i>
                    <input type="text" id="conditionSearch" placeholder="Search for specific heart conditions...">
                </div>
            </div>
        </div>
    </section>

    <section class="education-content">
        <div class="container">
            <div class="tab-navigation">
                <button class="tab-button active" data-tab="conditions">Common Heart Conditions</button>
                <button class="tab-button" data-tab="risk-factors">Risk Factors</button>
                <button class="tab-button" data-tab="symptoms">Warning Signs</button>
                <button class="tab-button" data-tab="prevention">Prevention Strategies</button>
                <button class="tab-button" data-tab="treatments">Treatment Options</button>
            </div>
            <div id="conditions" class="tab-content active">
                <h2 class="section-title">Common Heart Conditions</h2>
                
                <div class="condition-card" data-condition="coronary artery disease">
                    <h3><i class="fas fa-heart-broken"></i> Coronary Artery Disease (CAD)</h3>
                    <p>Coronary artery disease (CAD) is the most common type of heart disease in the United States. It occurs when the arteries that supply blood to the heart muscle become hardened and narrowed due to the buildup of plaque (atherosclerosis).</p>
                    
                    <div class="accordion">
                        <div class="accordion-header">
                            <h3>Symptoms</h3>
                            <div class="accordion-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="accordion-content">
                            <ul class="symptoms-list">
                                <li>Chest pain or discomfort (angina)</li>
                                <li>Shortness of breath</li>
                                <li>Fatigue with activity</li>
                                <li>Heart attack symptoms (severe chest pain, pain in left arm/jaw, sweating, nausea)</li>
                                <li>Some people may have no symptoms until they have a heart attack</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="accordion">
                        <div class="accordion-header">
                            <h3>Treatment Options</h3>
                            <div class="accordion-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="accordion-content">
                            <ul class="treatments-list">
                                <li><strong>Lifestyle changes:</strong> Healthy diet, regular exercise, smoking cessation, weight management</li>
                                <li><strong>Medications:</strong> Cholesterol-lowering medications, aspirin, beta-blockers, ACE inhibitors</li>
                                <li><strong>Medical procedures:</strong> Angioplasty and stent placement, coronary artery bypass surgery</li>
                                <li><strong>Cardiac rehabilitation:</strong> Programs to improve heart health after a heart attack or procedure</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="accordion">
                        <div class="accordion-header">
                            <h3>Prevention Strategies</h3>
                            <div class="accordion-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="accordion-content">
                            <ul class="prevention-list">
                                <li>Regular exercise (at least 150 minutes per week)</li>
                                <li>Heart-healthy diet rich in fruits, vegetables, whole grains, and lean proteins</li>
                                <li>Maintain a healthy weight</li>
                                <li>Quit smoking and avoid secondhand smoke</li>
                                <li>Manage stress through meditation, yoga, or other relaxation techniques</li>
                                <li>Control high blood pressure, diabetes, and high cholesterol</li>
                                <li>Limit alcohol consumption</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="condition-card" data-condition="heart attack myocardial infarction">
                    <h3><i class="fas fa-heartbeat"></i> Heart Attack (Myocardial Infarction)</h3>
                    <p>A heart attack, or myocardial infarction, occurs when blood flow to a part of the heart is blocked for a significant time, causing damage or death to heart muscle cells. It is a serious medical emergency that requires immediate treatment.</p>
                    
                    <div class="accordion">
                        <div class="accordion-header">
                            <h3>Symptoms</h3>
                            <div class="accordion-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="accordion-content">
                            <ul class="symptoms-list">
                                <li>Chest pain or discomfort that may feel like pressure, squeezing, fullness, or pain</li>
                                <li>Pain or discomfort that spreads to the shoulder, arm, back, neck, jaw, or stomach</li>
                                <li>Shortness of breath</li>
                                <li>Cold sweat</li>
                                <li>Nausea or vomiting</li>
                                <li>Lightheadedness or sudden dizziness</li>
                                <li>Women may experience different symptoms like fatigue, shortness of breath, and nausea</li>
                            </ul>
                            
                            <div class="warning-box">
                                <h4><i class="fas fa-exclamation-triangle"></i> Warning</h4>
                                <p>If you or someone else may be having a heart attack, call emergency services (122) immediately. Every minute matters during a heart attack.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion">
                        <div class="accordion-header">
                            <h3>Treatment Options</h3>
                            <div class="accordion-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="accordion-content">
                            <ul class="treatments-list">
                                <li><strong>Emergency treatments:</strong> Aspirin, nitroglycerin, oxygen therapy, pain relievers</li>
                                <li><strong>Clot-busting medications:</strong> Thrombolytics (given within the first few hours of a heart attack)</li>
                                <li><strong>Emergency procedures:</strong> Coronary angioplasty and stent placement, coronary artery bypass surgery</li>
                                <li><strong>Medications after a heart attack:</strong> Blood thinners, blood pressure medications, cholesterol-lowering drugs</li>
                                <li><strong>Cardiac rehabilitation:</strong> Programs including exercise, education, and counseling</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="accordion">
                        <div class="accordion-header">
                            <h3>Recovery and Long-term Management</h3>
                            <div class="accordion-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="accordion-content">
                            <p>Recovery from a heart attack takes time. Most people can return to work and normal activities after several weeks, but it depends on the severity of the heart attack, your overall health, and the type of work you do.</p>
                            
                            <p>Long-term management includes:</p>
                            <ul class="prevention-list">
                                <li>Taking prescribed medications as directed</li>
                                <li>Attending follow-up appointments with your healthcare provider</li>
                                <li>Participating in a cardiac rehabilitation program</li>
                                <li>Making lifestyle changes such as quitting smoking, eating a heart-healthy diet, and exercising regularly</li>
                                <li>Managing stress</li>
                                <li>Monitoring and controlling other health conditions like diabetes or high blood pressure</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="condition-card" data-condition="heart failure congestive heart failure">
                    <h3><i class="fas fa-heart"></i> Heart Failure</h3>
                    <p>Heart failure, sometimes called congestive heart failure, occurs when the heart muscle doesn't pump blood as well as it should. This doesn't mean that your heart has stopped working, but that it needs support to function effectively.</p>
                    
                    <div class="accordion">
                        <div class="accordion-header">
                            <h3>Symptoms</h3>
                            <div class="accordion-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="accordion-content">
                            <ul class="symptoms-list">
                                <li>Shortness of breath during activity or when lying down</li>
                                <li>Fatigue and weakness</li>
                                <li>Swelling in the legs, ankles, and feet</li>
                                <li>Rapid or irregular heartbeat</li>
                                <li>Persistent cough or wheezing with white or pink blood-tinged mucus</li>
                                <li>Increased need to urinate, especially at night</li>
                                <li>Sudden weight gain from fluid retention</li>
                                <li>Difficulty concentrating or decreased alertness</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="accordion">
                        <div class="accordion-header">
                            <h3>Treatment Options</h3>
                            <div class="accordion-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="accordion-content">
                            <ul class="treatments-list">
                                <li><strong>Medications:</strong> ACE inhibitors, beta-blockers, diuretics, aldosterone antagonists, ARBs</li>
                                <li><strong>Medical devices:</strong> Implantable cardioverter-defibrillators (ICDs), cardiac resynchronization therapy (CRT), heart pumps</li>
                                <li><strong>Heart surgery:</strong> Coronary bypass surgery, heart valve repair or replacement</li>
                                <li><strong>Heart transplant:</strong> For severe cases when other treatments have failed</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="accordion">
                        <div class="accordion-header">
                            <h3>Living with Heart Failure</h3>
                            <div class="accordion-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="accordion-content">
                            <p>Although heart failure is a chronic condition that gets worse over time, many people learn to live full and enjoyable lives by taking care of themselves and following their treatment plan.</p>
                            
                            <p>Self-care recommendations include:</p>
                            <ul class="prevention-list">
                                <li>Take medications as prescribed</li>
                                <li>Monitor your symptoms daily and report changes to your healthcare provider</li>
                                <li>Weigh yourself daily to detect early fluid retention</li>
                                <li>Restrict sodium (salt) in your diet</li>
                                <li>Maintain physical activity as recommended by your doctor</li>
                                <li>Manage stress through relaxation techniques</li>
                                <li>Avoid alcohol and tobacco</li>
                                <li>Keep regular follow-up appointments with your healthcare team</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="condition-card" data-condition="arrhythmia atrial fibrillation">
                    <h3><i class="fas fa-heartbeat"></i> Arrhythmias</h3>
                    <p>An arrhythmia is an irregular heartbeat caused by changes in the heart's electrical system. The heart may beat too fast (tachycardia), too slow (bradycardia), or with an irregular rhythm. Atrial fibrillation is the most common type of serious arrhythmia.</p>
                    
                    <div class="accordion">
                        <div class="accordion-header">
                            <h3>Symptoms</h3>
                            <div class="accordion-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="accordion-content">
                            <ul class="symptoms-list">
                                <li>Feeling of skipped heartbeats or fluttering in your chest</li>
                                <li>Racing heartbeat (tachycardia)</li>
                                <li>Slow heartbeat (bradycardia)</li>
                                <li>Chest pain</li>
                                <li>Shortness of breath</li>
                                <li>Lightheadedness or dizziness</li>
                                <li>Fainting or near fainting</li>
                                <li>Some arrhythmias may cause no noticeable symptoms</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="accordion">
                        <div class="accordion-header">
                            <h3>Treatment Options</h3>
                            <div class="accordion-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="accordion-content">
                            <ul class="treatments-list">
                                <li><strong>Medications:</strong> Antiarrhythmic drugs, beta-blockers, calcium channel blockers, anticoagulants (for atrial fibrillation)</li>
                                <li><strong>Cardioversion:</strong> A procedure to restore normal heart rhythm using electric shocks or medication</li>
                                <li><strong>Catheter ablation:</strong> A procedure that destroys small areas of heart tissue causing rhythm problems</li>
                                <li><strong>Pacemaker:</strong> A device implanted to help control abnormal heart rhythms</li>
                                <li><strong>Implantable cardioverter-defibrillator (ICD):</strong> A device that detects and corrects dangerous arrhythmias</li>
                                <li><strong>Maze procedure:</strong> Surgery to create a pattern of scar tissue to prevent atrial fibrillation</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="accordion">
                        <div class="accordion-header">
                            <h3>Prevention and Management</h3>
                            <div class="accordion-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="accordion-content">
                            <ul class="prevention-list">
                                <li>Eat a heart-healthy diet</li>
                                <li>Exercise regularly</li>
                                <li>Maintain a healthy weight</li>
                                <li>Avoid smoking</li>
                                <li>Limit or avoid caffeine and alcohol</li>
                                <li>Reduce stress</li>
                                <li>Get enough sleep</li>
                                <li>Manage conditions that can lead to arrhythmias, such as high blood pressure</li>
                                <li>Take medications as prescribed</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="condition-card" data-condition="valve disease">
                    <h3><i class="fas fa-heart"></i> Heart Valve Disease</h3>
                    <p>Heart valve disease occurs when one or more of your heart valves don't work properly. The heart has four valves — the aortic, mitral, pulmonary, and tricuspid valves — that open and close to direct blood flow through your heart.</p>
                    
                    <div class="accordion">
                        <div class="accordion-header">
                            <h3>Types of Valve Problems</h3>
                            <div class="accordion-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="accordion-content">
                            <ul>
                                <li><strong>Regurgitation (leaky valve):</strong> When a valve doesn't close properly, allowing blood to leak backward</li>
                                <li><strong>Stenosis (narrowed valve):</strong> When valve flaps thicken, stiffen, or fuse together, restricting blood flow</li>
                                <li><strong>Atresia:</strong> When a valve lacks an opening for blood to pass through</li>
                                <li><strong>Prolapse:</strong> When valve flaps bulge back into an upper heart chamber during heart contraction</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="accordion">
                        <div class="accordion-header">
                            <h3>Symptoms</h3>
                            <div class="accordion-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="accordion-content">
                            <ul class="symptoms-list">
                                <li>Abnormal heart sound (heart murmur)</li>
                                <li>Fatigue</li>
                                <li>Shortness of breath, especially during activity or when lying down</li>
                                <li>Swelling in ankles, feet, or abdomen</li>
                                <li>Dizziness or fainting</li>
                                <li>Irregular heartbeat</li>
                                <li>Chest pain</li>
                                <li>Some people may not experience symptoms for many years</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="accordion">
                        <div class="accordion-header">
                            <h3>Treatment Options</h3>
                            <div class="accordion-icon">
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                        <div class="accordion-content">
                            <ul class="treatments-list">
                                <li><strong>Monitoring:</strong> For mild cases, regular checkups to monitor valve function</li>
                                <li><strong>Medications:</strong> To ease symptoms and reduce complications (not to fix valve problems)</li>
                                <li><strong>Heart-healthy lifestyle changes:</strong> Diet, exercise, and smoking cessation</li>
                                <li><strong>Balloon valvuloplasty:</strong> Inflating a balloon in the valve to widen it (usually for stenosis)</li>
                                <li><strong>Valve repair surgery:</strong> Fixing the existing valve</li>
                                <li><strong>Valve replacement surgery:</strong> Replacing the damaged valve with a mechanical or biological valve</li>
                                <li><strong>TAVR (Transcatheter aortic valve replacement):</strong> Less invasive procedure for aortic valve replacement</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Risk Factors Tab -->
            <div id="risk-factors" class="tab-content">
                <h2 class="section-title">Risk Factors for Heart Disease</h2>
                
                <div class="condition-card">
                    <h3><i class="fas fa-exclamation-triangle"></i> Non-Modifiable Risk Factors</h3>
                    <p>These are factors that you cannot change but are important to be aware of:</p>
                    
                    <ul class="prevention-list">
                        <li><strong>Age:</strong> The risk of heart disease increases as you get older, especially after age 45 for men and 55 for women</li>
                        <li><strong>Gender:</strong> Men have a higher risk of heart disease than women before menopause, but women's risk increases after menopause</li>
                        <li><strong>Family history:</strong> You have a greater risk if a close family member had heart disease at an early age</li>
                        <li><strong>Ethnicity:</strong> Certain ethnic groups have higher rates of heart disease</li>
                        <li><strong>Genetic conditions:</strong> Certain genetic disorders can increase risk</li>
                    </ul>
                </div>
                
                <div class="condition-card">
                    <h3><i class="fas fa-edit"></i> Modifiable Risk Factors</h3>
                    <p>These are factors that you can change to reduce your risk of heart disease:</p>
                    
                    <ul class="prevention-list">
                        <li><strong>High blood pressure:</strong> Can damage arteries and heart if left untreated</li>
                        <li><strong>High cholesterol:</strong> Builds up in artery walls, restricting blood flow</li>
                        <li><strong>Smoking:</strong> Damages blood vessels and reduces oxygen in blood</li>
                        <li><strong>Physical inactivity:</strong> Increases risk of obesity, high blood pressure, and diabetes</li>
                        <li><strong>Obesity:</strong> Increases strain on the heart and risk of other conditions</li>
                        <li><strong>Diabetes:</strong> Increases risk of heart disease by affecting blood vessels</li>
                        <li><strong>Unhealthy diet:</strong> High in saturated fats, trans fats, sodium, and sugar</li>
                        <li><strong>Excessive alcohol consumption:</strong> Can raise blood pressure and add calories</li>
                        <li><strong>Stress:</strong> Can increase blood pressure and may lead to other risk factors</li>
                        <li><strong>Poor sleep:</strong> Associated with higher risk of obesity, high blood pressure, heart attack, and diabetes</li>
                    </ul>
                    
                    <div class="info-box">
                        <h4><i class="fas fa-info-circle"></i> Did You Know?</h4>
                        <p>According to the American Heart Association, about 80% of cardiovascular disease, including heart disease and stroke, are preventable by addressing modifiable risk factors.</p>
                    </div>
                </div>
                
                <div class="condition-card">
                    <h3><i class="fas fa-chart-line"></i> Risk Assessment</h3>
                    <p>Understanding your personal risk level is important for prevention and early intervention. Consider these points about risk:</p>
                    
                    <ul>
                        <li>Multiple risk factors compound each other, significantly increasing overall risk</li>
                        <li>Even one severe risk factor can substantially increase your chances of heart disease</li>
                        <li>Regular health check-ups can help identify risk factors before symptoms develop</li>
                        <li>Your doctor can use risk calculators to estimate your 10-year risk of heart disease</li>
                        <li>Early identification and management of risk factors can prevent or delay heart disease</li>
                    </ul>
                    
                    <p class="cta-text">Use our <a href="risk.php" class="btn-link">Risk Assessment Tool</a> to evaluate your personal risk level.</p>
                </div>
            </div>

            <!-- Warning Signs Tab -->
            <div id="symptoms" class="tab-content">
                <h2 class="section-title">Warning Signs of Heart Disease</h2>
                
                <div class="condition-card">
                    <h3><i class="fas fa-exclamation-circle"></i> Common Warning Signs</h3>
                    <p>Heart disease symptoms can vary depending on the type of heart disease and between men and women. Some people may not experience symptoms until they have a heart attack or heart failure.</p>
                    
                    <ul class="symptoms-list">
                        <li><strong>Chest pain, pressure, tightness or discomfort (angina)</strong> - May feel like pressure, squeezing, fullness, or pain in the center or left side of the chest</li>
                        <li><strong>Shortness of breath</strong> - During activity or at rest</li>
                        <li><strong>Pain, numbness, weakness or coldness in legs or arms</strong> - When blood vessels in these parts of your body are narrowed</li>
                        <li><strong>Pain in the neck, jaw, throat, upper abdomen or back</strong> - These might be symptoms of heart pain, especially in women</li>
                        <li><strong>Fluttering in chest (palpitations)</strong> - Irregular heartbeats or a "flip-flopping" feeling</li>
                        <li><strong>Racing heartbeat</strong> - A heartbeat that is faster than normal</li>
                        <li><strong>Slow heartbeat</strong> - A heartbeat that is slower than normal</li>
                        <li><strong>Lightheadedness or dizziness</strong> - Can be a sign of heart valve problems or heart failure</li>
                        <li><strong>Fainting (syncope)</strong> - Could be related to heart valve problems, heart failure, or arrhythmias</li>
                        <li><strong>Fatigue</strong> - Especially with increased activity</li>
                        <li><strong>Swelling in legs, ankles, feet, or abdomen</strong> - Due to fluid buildup, may indicate heart failure</li>
                    </ul>
                    
                    <div class="warning-box">
                        <h4><i class="fas fa-ambulance"></i> When to Seek Emergency Help</h4>
                        <p>Call emergency services (122) if you experience these heart attack warning signs:</p>
                        <ul>
                            <li>Chest pain or discomfort that lasts more than a few minutes or that goes away and comes back</li>
                            <li>Pain or discomfort in one or both arms, the back, neck, jaw, or stomach</li>
                            <li>Shortness of breath (with or without chest discomfort)</li>
                            <li>Other signs such as breaking out in a cold sweat, nausea, or lightheadedness</li>
                        </ul>
                        <p><strong>Don't wait to get help if you experience these warning signs!</strong></p>
                    </div>
                </div>
                
                <div class="condition-card">
                    <h3><i class="fas fa-venus"></i> Heart Disease Symptoms in Women</h3>
                    <p>Women may experience different symptoms than men, making heart disease sometimes harder to recognize:</p>
                    
                    <ul class="symptoms-list">
                        <li>Women are more likely to have symptoms unrelated to chest pain</li>
                        <li>Extreme fatigue that comes on suddenly</li>
                        <li>Shortness of breath</li>
                        <li>Upper back, shoulder, or throat pain</li>
                        <li>Jaw pain or pain that spreads to the jaw</li>
                        <li>Pressure or pain in the center of the chest that may spread to the arm</li>
                        <li>Nausea, vomiting, or flu-like symptoms</li>
                        <li>Sleep disturbances</li>
                        <li>Stomach or abdominal pain</li>
                    </ul>
                    
                    <div class="info-box">
                        <h4><i class="fas fa-info-circle"></i> Important Note</h4>
                        <p>Women are more likely than men to have heart attack symptoms unrelated to chest pain. Because these symptoms are less recognized as heart-related, women might be diagnosed less promptly than men, leading to worse outcomes.</p>
                    </div>
                </div>
                
                <div class="condition-card">
                    <h3><i class="fas fa-heartbeat"></i> Silent Heart Disease</h3>
                    <p>Some people have "silent" heart disease, meaning they have no symptoms at all. This is more common in:</p>
                    
                    <ul>
                        <li>People with diabetes, who may have nerve damage affecting pain perception</li>
                        <li>Older adults, who may attribute symptoms to aging</li>
                        <li>People who have had previous heart damage without realizing it</li>
                    </ul>
                    
                    <p>Regular check-ups with your healthcare provider are essential for detecting silent heart disease and preventing complications.</p>
                </div>
            </div>

            <!-- Prevention Strategies Tab -->
            <div id="prevention" class="tab-content">
                <h2 class="section-title">Heart Disease Prevention</h2>
                
                <div class="condition-card">
                    <h3><i class="fas fa-utensils"></i> Heart-Healthy Diet</h3>
                    <p>A heart-healthy diet can significantly reduce your risk of heart disease and improve overall health:</p>
                    
                    <ul class="prevention-list">
                        <li><strong>Eat more fruits and vegetables</strong> - Aim for 4-5 servings each of fruits and vegetables daily</li>
                        <li><strong>Choose whole grains</strong> - Include whole wheat, brown rice, oats, barley, quinoa, and other whole grains</li>
                        <li><strong>Select lean proteins</strong> - Fish (especially fatty fish with omega-3 fatty acids), skinless poultry, beans, peas, and lentils</li>
                        <li><strong>Include healthy fats</strong> - Olive oil, avocados, nuts, and seeds</li>
                        <li><strong>Limit unhealthy fats</strong> - Reduce saturated and trans fats found in red meat, full-fat dairy, and fried fast foods</li>
                        <li><strong>Reduce sodium (salt) intake</strong> - Aim for less than 2,300 mg per day (about 1 teaspoon)</li>
                        <li><strong>Minimize added sugars</strong> - Found in sweetened beverages, desserts, and many processed foods</li>
                        <li><strong>Practice portion control</strong> - Even healthy foods should be consumed in appropriate portions</li>
                    </ul>
                    
                    <div class="info-box">
                        <h4><i class="fas fa-leaf"></i> Heart-Healthy Eating Patterns</h4>
                        <p>Several eating patterns have been shown to benefit heart health:</p>
                        <ul>
                            <li><strong>Mediterranean diet:</strong> Emphasizes fruits, vegetables, whole grains, beans, nuts, olive oil, and fish</li>
                            <li><strong>DASH diet:</strong> Designed to help lower high blood pressure</li>
                            <li><strong>Plant-based diets:</strong> Focus on plant foods with limited or no animal products</li>
                        </ul>
                    </div>
                </div>
                
                <div class="condition-card">
                    <h3><i class="fas fa-running"></i> Physical Activity</h3>
                    <p>Regular physical activity is one of the best ways to strengthen your heart and improve overall health:</p>
                    
                    <ul class="prevention-list">
                        <li><strong>Aim for at least 150 minutes</strong> of moderate-intensity aerobic activity per week</li>
                        <li><strong>Include muscle-strengthening activities</strong> at least 2 days per week</li>
                        <li><strong>Break up prolonged sitting</strong> with short activity breaks throughout the day</li>
                        <li><strong>Find activities you enjoy</strong> - Walking, swimming, cycling, dancing, or sports</li>
                        <li><strong>Start slowly</strong> and gradually increase intensity and duration if you're new to exercise</li>
                        <li><strong>Incorporate activity into daily life</strong> - Take stairs, park farther away, walk during lunch breaks</li>
                    </ul>
                    
                    <div class="warning-box">
                        <h4><i class="fas fa-exclamation-triangle"></i> Important</h4>
                        <p>If you have existing heart disease or multiple risk factors, consult with your healthcare provider before starting a new exercise program. They can help you determine what level of physical activity is safe for you.</p>
                    </div>
                </div>
                
                <div class="condition-card">
                    <h3><i class="fas fa-ban"></i> Avoid Tobacco and Limit Alcohol</h3>
                    <p>Tobacco use and excessive alcohol consumption significantly increase heart disease risk:</p>
                    
                    <ul class="prevention-list">
                        <li><strong>Quit smoking and avoid secondhand smoke</strong> - Smoking damages blood vessels and reduces oxygen in blood</li>
                        <li><strong>Seek help if needed</strong> - Nicotine replacement products, medications, and counseling can help you quit</li>
                        <li><strong>Benefits begin quickly</strong> - Within 1 year of quitting, your risk of heart disease drops dramatically</li>
                        <li><strong>Limit alcohol consumption</strong> - No more than 2 drinks per day for men and 1 for women</li>
                        <li><strong>Avoid binge drinking</strong> - Can cause irregular heartbeats and increase blood pressure</li>
                    </ul>
                </div>
                
                <div class="condition-card">
                    <h3><i class="fas fa-balance-scale"></i> Maintain a Healthy Weight</h3>
                    <p>Being overweight or obese increases your risk of heart disease:</p>
                    
                    <ul class="prevention-list">
                        <li><strong>Aim for a healthy Body Mass Index (BMI)</strong> between 18.5 and 24.9</li>
                        <li><strong>Focus on waist circumference</strong> - Men should aim for less than 40 inches (102 cm) and women less than 35 inches (88 cm)</li>
                        <li><strong>Combine diet and exercise</strong> for the most effective weight management</li>
                        <li><strong>Set realistic goals</strong> - Even modest weight loss (5-10% of body weight) can improve heart health</li>
                        <li><strong>Make sustainable lifestyle changes</strong> rather than following fad diets</li>
                    </ul>
                </div>
                
                <div class="condition-card">
                    <h3><i class="fas fa-stethoscope"></i> Manage Other Health Conditions</h3>
                    <p>Controlling other health conditions is crucial for heart disease prevention:</p>
                    
                    <ul class="prevention-list">
                        <li><strong>High blood pressure</strong> - Aim for readings below 120/80 mm Hg</li>
                        <li><strong>High cholesterol</strong> - Target levels depend on your risk factors</li>
                        <li><strong>Diabetes</strong> - Keep blood sugar levels within the target range</li>
                        <li><strong>Sleep apnea</strong> - Seek treatment if you have symptoms like loud snoring or daytime fatigue</li>
                        <li><strong>Regular check-ups</strong> - Monitor your numbers and adjust treatments as needed</li>
                        <li><strong>Take medications as prescribed</strong> - Don't stop or change dosages without consulting your doctor</li>
                    </ul>
                </div>
                
                <div class="condition-card">
                    <h3><i class="fas fa-spa"></i> Manage Stress</h3>
                    <p>Chronic stress may contribute to heart disease risk:</p>
                    
                    <ul class="prevention-list">
                        <li><strong>Practice relaxation techniques</strong> - Deep breathing, meditation, yoga, or tai chi</li>
                        <li><strong>Get enough sleep</strong> - Aim for 7-9 hours per night</li>
                        <li><strong>Connect with others</strong> - Strong social connections reduce stress</li>
                        <li><strong>Find healthy outlets</strong> - Physical activity, hobbies, or creative pursuits</li>
                        <li><strong>Seek professional help</strong> if stress feels overwhelming</li>
                    </ul>
                </div>
            </div>

            <!-- Treatment Options Tab -->
            <div id="treatments" class="tab-content">
                <h2 class="section-title">Treatment Options for Heart Disease</h2>
                
                <div class="condition-card">
                    <h3><i class="fas fa-pills"></i> Medications</h3>
                    <p>Many medications can help treat and manage heart disease. Your doctor may prescribe one or more of these depending on your condition:</p>
                    
                    <ul class="treatments-list">
                        <li><strong>Anticoagulants (blood thinners)</strong> - Prevent blood clot formation (e.g., warfarin, apixaban)</li>
                        <li><strong>Antiplatelet agents</strong> - Prevent platelets from sticking together (e.g., aspirin, clopidogrel)</li>
                        <li><strong>ACE inhibitors</strong> - Lower blood pressure and reduce strain on heart (e.g., lisinopril, enalapril)</li>
                        <li><strong>Angiotensin II receptor blockers (ARBs)</strong> - Alternative to ACE inhibitors (e.g., losartan, valsartan)</li>
                        <li><strong>Beta blockers</strong> - Slow heart rate and reduce blood pressure (e.g., metoprolol, carvedilol)</li>
                        <li><strong>Calcium channel blockers</strong> - Relax blood vessels and lower blood pressure (e.g., amlodipine)</li>
                        <li><strong>Cholesterol-lowering medications</strong> - Reduce LDL cholesterol (e.g., statins, ezetimibe)</li>
                        <li><strong>Diuretics</strong> - Remove excess fluid from body (e.g., furosemide, hydrochlorothiazide)</li>
                        <li><strong>Nitrates</strong> - Relieve chest pain by relaxing blood vessels (e.g., nitroglycerin)</li>
                    </ul>
                    
                    <div class="info-box">
                        <h4><i class="fas fa-info-circle"></i> Medication Management</h4>
                        <p>Always take medications exactly as prescribed. Do not stop taking medications without consulting your healthcare provider, even if you feel better. Many heart medications need to be taken continuously to be effective.</p>
                    </div>
                </div>
                
                <div class="condition-card">
                    <h3><i class="fas fa-procedures"></i> Medical Procedures and Surgeries</h3>
                    <p>When medications and lifestyle changes aren't enough, medical procedures or surgeries may be recommended:</p>
                    
                    <ul class="treatments-list">
                        <li><strong>Angioplasty and stent placement</strong> - A procedure to open narrowed arteries using a balloon, often with placement of a mesh tube (stent) to keep the artery open</li>
                        <li><strong>Coronary artery bypass surgery</strong> - Creates a new path for blood to flow around blocked arteries using blood vessels from another part of your body</li>
                        <li><strong>Heart valve repair or replacement</strong> - Fixes or replaces damaged heart valves</li>
                        <li><strong>Implantable devices:</strong>
                            <ul>
                                <li><strong>Pacemakers</strong> - Control abnormal heart rhythms</li>
                                <li><strong>Implantable cardioverter-defibrillators (ICDs)</strong> - Monitor heart rhythm and deliver shocks when needed</li>
                                <li><strong>Cardiac resynchronization therapy (CRT)</strong> - Coordinates contractions between heart chambers</li>
                                <li><strong>Left ventricular assist devices (LVADs)</strong> - Help pump blood in advanced heart failure</li>
                            </ul>
                        </li>
                        <li><strong>Heart transplant</strong> - For severe heart failure when other treatments haven't helped</li>
                    </ul>
                </div>
                
                <div class="condition-card">
                    <h3><i class="fas fa-heartbeat"></i> Cardiac Rehabilitation</h3>
                    <p>Cardiac rehabilitation is a medically supervised program designed to help improve cardiovascular health after a heart attack, heart failure, angioplasty, or heart surgery:</p>
                    
                    <ul class="treatments-list">
                        <li><strong>Exercise training</strong> - Supervised program tailored to your abilities and condition</li>
                        <li><strong>Education</strong> - Learning about heart-healthy living and reducing risks</li>
                        <li><strong>Counseling</strong> - Addressing stress, depression, and adjusting to lifestyle changes</li>
                        <li><strong>Support</strong> - From healthcare professionals and others with heart disease</li>
                    </ul>
                    
                    <p>Cardiac rehabilitation has been shown to reduce mortality, lower the risk of future heart problems, improve quality of life, and help manage symptoms.</p>
                </div>
                
                <div class="condition-card">
                    <h3><i class="fas fa-apple-alt"></i> Lifestyle Modifications as Treatment</h3>
                    <p>For many people with heart disease, lifestyle changes are a crucial part of treatment:</p>
                    
                    <ul class="treatments-list">
                        <li><strong>Heart-healthy diet</strong> - Following a diet low in saturated fat, trans fat, sodium, and added sugars</li>
                        <li><strong>Regular physical activity</strong> - As recommended by your healthcare provider</li>
                        <li><strong>Smoking cessation</strong> - If you smoke, quitting is one of the best things you can do for your heart</li>
                        <li><strong>Stress management</strong> - Using techniques such as meditation, deep breathing, or yoga</li>
                        <li><strong>Weight management</strong> - Maintaining a healthy weight through diet and exercise</li>
                        <li><strong>Limiting alcohol</strong> - Reducing or eliminating alcohol consumption</li>
                    </ul>
                </div>
                
                <div class="condition-card">
                    <h3><i class="fas fa-user-md"></i> Working with Your Healthcare Team</h3>
                    <p>Effective treatment of heart disease involves collaboration with healthcare professionals:</p>
                    
                    <ul>
                        <li><strong>Cardiologist</strong> - A doctor specializing in heart conditions</li>
                        <li><strong>Primary care physician</strong> - Coordinates overall care</li>
                        <li><strong>Cardiac nurses</strong> - Provide education and support</li>
                        <li><strong>Dietitian</strong> - Helps with heart-healthy eating plans</li>
                        <li><strong>Exercise physiologist</strong> - Designs safe exercise programs</li>
                        <li><strong>Pharmacist</strong> - Helps manage medications</li>
                    </ul>
                    
                    <p>Regular follow-up appointments, open communication about symptoms and concerns, and adherence to treatment plans are essential for managing heart disease successfully.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="resources-section">
        <div class="container">
            <h2 class="section-title">Additional Heart Health Resources</h2>
            <div class="resource-cards">
                
                <div class="resource-card">
                    <div class="icon">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <h4>Check Your Symptom</h4>
                    <p>Use our interactive tools to assess your personal Symptom of heart disease and identify areas for improvement.</p>
                    <a href="heart-symptom-checker.php" class="btn btn-primary">Check Your Symptom</a>
                </div>
                
                <div class="resource-card">
                    <div class="icon">
                        <i class="fas fa-video"></i>
                    </div>
                    <h4>Educational Videos</h4>
                    <p>Watch expert videos explaining heart conditions, procedures, and lifestyle modifications in easy-to-understand terms.</p>
                    <a href="Resources.php#videos" class="btn btn-primary">Watch Videos</a>
                </div>
                
                <div class="resource-card">
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4>Support Groups</h4>
                    <p>Connect with others who are living with heart disease to share experiences, tips, and emotional support.</p>
                    <a href="Resources.php#support" class="btn btn-primary">Find Support</a>
                </div>
            </div>
        </div>
    </section>
    <footer>
    <?php include 'footer.php'; ?>
    </footer>
    <script>
        // Toggle mobile menu
        document.querySelector('.mobile-menu').addEventListener('click', function() {
            document.querySelector('nav ul').classList.toggle('active');
        });
        
        // Tab navigation
        const tabButtons = document.querySelectorAll('.tab-button');
        const tabContents = document.querySelectorAll('.tab-content');
        
        tabButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Remove active class from all buttons and contents
                tabButtons.forEach(btn => btn.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));
                
                // Add active class to clicked button and corresponding content
                button.classList.add('active');
                document.getElementById(button.dataset.tab).classList.add('active');
            });
        });
        
       
        
        // Search functionality
        document.getElementById('conditionSearch').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const conditionCards = document.querySelectorAll('.condition-card');
            
            conditionCards.forEach(card => {
                const conditionText = card.getAttribute('data-condition') || '';
                const cardText = card.textContent.toLowerCase();
                
                if (cardText.includes(searchTerm) || conditionText.includes(searchTerm)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });

        // Accordion functionality
        document.querySelectorAll('.accordion-header').forEach(header => {
            header.addEventListener('click', () => {
                const accordion = header.parentElement;
                const content = accordion.querySelector('.accordion-content');

                // Toggle active class
                accordion.classList.toggle('active');

                // Adjust max-height for smooth toggle
                if (accordion.classList.contains('active')) {
                    content.style.maxHeight = content.scrollHeight + 'px';
                } else {
                    content.style.maxHeight = '0';
                }
            });
        });
    </script>
</body>
</html>
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

// Chat Widget
function initChatWidget() {
    const chatButton = document.querySelector('.chat-button');
    const chatBox = document.querySelector('.chat-box');
    const closeChat = document.querySelector('.close-chat');
    const chatInput = document.querySelector('.chat-input input');
    const sendButton = document.querySelector('.chat-input button');
    const chatMessages = document.querySelector('.chat-messages');
    
    // Toggle chat box
    if (chatButton) {
        chatButton.addEventListener('click', function() {
            chatBox.style.display = chatBox.style.display === 'block' ? 'none' : 'block';
            if (chatBox.style.display === 'block') {
                chatInput.focus();
            }
        });
    }
    
    // Close chat box
    if (closeChat) {
        closeChat.addEventListener('click', function() {
            chatBox.style.display = 'none';
        });
    }
    
    // Send message function
    function sendMessage() {
        const message = chatInput.value.trim();
        if (message !== '') {
            // Add user message
            addMessage(message, 'user');
            
            // Clear input
            chatInput.value = '';
            
            // Simulate bot response (replace with actual API call in production)
            setTimeout(() => {
                botResponse(message);
            }, 1000);
        }
    }
    
    // Send message when clicking send button
    if (sendButton) {
        sendButton.addEventListener('click', sendMessage);
    }
    
    // Send message when pressing Enter
    if (chatInput) {
        chatInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    }
    
    // Add message to chat
    function addMessage(text, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.classList.add('message', sender);
        messageDiv.textContent = text;
        chatMessages.appendChild(messageDiv);
        
        // Scroll to bottom
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }
    
    // Bot response logic - replace with actual AI or API in production
    function botResponse(userMessage) {
        let response;
        
        // Simple keyword matching for demo purposes
        const lowerCaseMessage = userMessage.toLowerCase();
        
        if (lowerCaseMessage.includes('hello') || lowerCaseMessage.includes('hi')) {
            response = "Hello! How can I help you with your heart health today?";
        } else if (lowerCaseMessage.includes('symptom')) {
            response = "If you're experiencing symptoms, please check our symptom checker tool or consult a healthcare professional immediately if you're concerned.";
        } else if (lowerCaseMessage.includes('risk')) {
            response = "Our risk assessment tool can help you understand your heart disease risk factors. Would you like me to guide you through it?";
        } else if (lowerCaseMessage.includes('doctor') || lowerCaseMessage.includes('appointment')) {
            response = "It's always good to consult with a healthcare professional. Would you like information about finding a cardiologist?";
        } else if (lowerCaseMessage.includes('thank')) {
            response = "You're welcome! Is there anything else I can help you with?";
        } else {
            response = "Thank you for your question. For specific medical advice, please consult with a healthcare professional. You can also explore our educational resources or take our risk assessment.";
        }
        
        addMessage(response, 'bot');
    }
}

// Scroll Animations
function initScrollAnimations() {
    // Add fade-in animation to elements when they come into view
    const animateElements = document.querySelectorAll('.feature-card, .stat-box, .testimonial');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.2
    });
    
    animateElements.forEach(element => {
        observer.observe(element);
    });
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

// Add sticky header effect


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
  --secondary-color: #457b9d;
    --text-color: #333;
    --light-text: #666;
    --light-bg: #f8f9fc;
    --accent-color: #00acc1;
    --success-color: #66bb6a;
    --warning-color: #ffa726;
    --font-heading: 'Poppins', sans-serif;
    --font-body: 'Inter', 'Open Sans', sans-serif;
    --shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    --shadow-sm: 0 4px 6px rgba(0, 0, 0, 0.05);
    --shadow-lg: 0 20px 40px rgba(0, 0, 0, 0.15);
    --border-radius: 12px;
    --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
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
    background-color:rgb(255, 255, 255);
    
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



.hero::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
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

.container {
  width: 100%;
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
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
    background: rgba(255, 255, 255, 0.9);
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
    background: url("data:image/svg+xml,%3Csvg width='40' height='40' viewBox='0 0 40 40' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'%3E%3Cpath d='M0 40L40 0H20L0 20M40 40V20L20 40'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
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
</style>
