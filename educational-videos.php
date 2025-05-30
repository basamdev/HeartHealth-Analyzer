<?php
// videos.php - Educational Videos Page for Heart Care Website
$pageTitle = "Educational Videos | Heart Care Center";

// Dynamic video data array
$videos = [
    [
        'category'    => 'prevention',
        'thumbnail'   => 'image/heart.jpg',
        'title'       => 'Understanding Cardiovascular Risk Factors',
        'speaker'     => 'Dr. Sarah Johnson',
        'duration'    => '15:42',
        'description' => 'Learn about the key risk factors for heart disease and how to address them effectively.',
        'tags'        => ['Prevention', 'Risk Factors'],
        'url'         => 'https://www.youtube.com/watch?v=7HhCl6YWKa8', 
    ],
    [
        'category'    => 'treatment',
'thumbnail'   => 'image/heart.jpg',
        'title'       => 'Modern Approaches to Heart Disease Treatment',
        'speaker'     => 'Dr. Michael Rodriguez',
        'duration'    => '22:15',
        'description' => 'Explore the latest treatment options for various types of heart disease.',
        'tags'        => ['Treatment', 'Medical'],
        'url'         => 'https://www.youtube.com/watch?v=NiNh_rgnSE0', 
    ],
    [
        'category'    => 'lifestyle',
        'thumbnail'   => 'image/heart.jpg',
        'title'       => 'Heart-Healthy Diet: What to Eat and Avoid',
        'speaker'     => 'Emma Thompson, RD',
        'duration'    => '18:37',
        'description' => 'Nutritional guidelines for maintaining optimal heart health through diet.',
        'tags'        => ['Lifestyle', 'Nutrition'],
        'url'         => 'https://www.youtube.com/watch?v=SBtRkjXSMmk', 
    ],
    [
        'category'    => 'prevention',
        'thumbnail'   => 'image/heart.jpg',
        'title'       => 'Understanding Cardiovascular Risk Factors',
        'speaker'     => 'Dr. Sarah Johnson',
        'duration'    => '15:42',
        'description' => 'Learn about the key risk factors for heart disease and how to address them effectively.',
        'tags'        => ['Prevention', 'Risk Factors'],
        'url'         => 'https://www.youtube.com/watch?v=7HhCl6YWKa8', 
    ],
    [
        'category'    => 'expert',
        'thumbnail'   => 'image/heart.jpg',
        'title'       => 'The Future of Cardiology: Innovations and Research',
        'speaker'     => 'Prof. David Chen',
        'duration'    => '34:21',
        'description' => 'Learn about cutting-edge research and innovations in cardiac care.',
        'tags'        => ['Expert', 'Research'],
        'url'         => 'https://www.youtube.com/watch?v=5WolSCIcm2c', 
    ],
    [
        'category'    => 'treatment',
'thumbnail'   => 'image/heart.jpg',
        'title'       => 'Modern Approaches to Heart Disease Treatment',
        'speaker'     => 'Dr. Michael Rodriguez',
        'duration'    => '22:15',
        'description' => 'Explore the latest treatment options for various types of heart disease.',
        'tags'        => ['Treatment', 'Medical'],
        'url'         => 'https://www.youtube.com/watch?v=NiNh_rgnSE0', 
    ],
    [
        'category'    => 'lifestyle',
        'thumbnail'   => 'image/heart.jpg',
        'title'       => 'Effective Exercise Routines for Heart Health',
        'speaker'     => 'James Wilson, CPT',
        'duration'    => '25:10',
        'description' => 'Safe and effective exercise programs designed specifically for heart health.',
        'tags'        => ['Lifestyle', 'Exercise'],
        'url'         => 'https://www.youtube.com/watch?v=KD2j72DhL8Y', 
    ],
    [
        'category'    => 'lifestyle',
        'thumbnail'   => 'image/heart.jpg',
        'title'       => 'Heart-Healthy Diet: What to Eat and Avoid',
        'speaker'     => 'Emma Thompson, RD',
        'duration'    => '18:37',
        'description' => 'Nutritional guidelines for maintaining optimal heart health through diet.',
        'tags'        => ['Lifestyle', 'Nutrition'],
        'url'         => 'https://www.youtube.com/watch?v=SBtRkjXSMmk', 
    ],
    [
        'category'    => 'prevention',
       'thumbnail'   => 'image/heart.jpg',
        'title'       => 'Stress Management Techniques for Heart Health',
        'speaker'     => 'Dr. Lisa Park',
        'duration'    => '19:45',
        'description' => 'Discover effective strategies to manage stress and protect your heart.',
        'tags'        => ['Prevention', 'Mental Health'],
        'url'         => 'https://www.youtube.com/watch?v=FcUNvGoRoOM', 
    ],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* Global styles */
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

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.3;
            color: var(--text-dark);
            background-color:hsl(0, 0.00%, 98.80%);
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        
        /* Custom styles for videos page */
        .video-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .page-title {
            text-align: center;
            color: var(--primary-color);
            margin-bottom: 40px;
            font-size: 36px;
            font-weight: 700;
            position: relative;
            padding-bottom: 15px;
            transition: var(--transition-slow);
        }
        
        .page-title:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100px;
            height: 3px;
            background: linear-gradient(to right, var(--primary-light), var(--primary-color), var(--primary-light));
            transition: var(--transition-slow);
        }
        
        .page-title:hover:after {
            width: 150px;
        }
        
        .video-intro {
            text-align: center;
            margin-bottom: 40px;
            font-size: 18px;
            line-height: 1.6;
            color: var(--text-medium);
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .video-categories {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 10px;
        }
        
        .category-btn {
            padding: 10px 20px;
            background-color: var(--background-light);
            color: var(--text-medium);
            border: 1px solid #dee2e6;
            border-radius: var(--border-radius-round);
            cursor: pointer;
            transition: var(--transition-fast);
            font-weight: 500;
            font-size: 14px;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .category-btn:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background-color: var(--primary-color);
            transition: var(--transition-fast);
            z-index: -1;
        }
        
        .category-btn:hover:before, .category-btn.active:before {
            width: 100%;
        }
        
        .category-btn:hover, .category-btn.active {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(217,83,79,0.2);
            border-color: transparent;
        }
        
        .video-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 30px;
            margin-top: 30px;
        }
        
        .video-card {
            background: var(--background-white);
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            transition: var(--transition-medium);
            opacity: 0;
            transform: translateY(20px);
            position: relative;
            isolation: isolate;
        }
        
        .video-card.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        .video-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
        }
        
        .video-thumbnail {
            position: relative;
            height: 200px;
            overflow: hidden;
        }
        
        .video-thumbnail img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s ease;
        }
        
        .video-card:hover .video-thumbnail img {
            transform: scale(1.05);
        }
        
        .play-icon {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(217, 83, 79, 0.9);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: var(--transition-fast);
            box-shadow: 0 0 20px rgba(217, 83, 79, 0.5);
        }
        
        .play-icon:after {
            content: '';
            display: block;
            border-style: solid;
            border-width: 12px 0 12px 20px;
            border-color: transparent transparent transparent white;
            margin-left: 5px;
            transition: transform 0.3s ease;
        }
        
        .video-card:hover .play-icon {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1.1);
        }
        
        .video-card:hover .play-icon:after {
            transform: scale(1.1);
        }
        
        .video-info {
            padding: 25px;
        }
        
        .video-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 12px;
            transition: var(--transition-fast);
            line-height: 1.4;
        }
        
        .video-card:hover .video-title {
            color: var(--primary-color);
        }
        
        .video-meta {
            display: flex;
            justify-content: space-between;
            color: var(--text-light);
            font-size: 14px;
            margin-bottom: 12px;
            font-weight: 500;
            align-items: center;
        }
        
        .video-meta span:first-child {
            position: relative;
            padding-left: 22px;
        }
        
        .video-meta span:first-child:before {
            content: '\f007';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            left: 0;
            top: 0;
            color: var(--primary-color);
        }
        
        .video-meta span:last-child {
            position: relative;
            padding-left: 22px;
        }
        
        .video-meta span:last-child:before {
            content: '\f017';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            left: 0;
            top: 0;
            color: var(--primary-color);
        }
        
        .video-description {
            color: var(--text-light);
            font-size: 14px;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        
        .video-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }
        
        .video-tag {
            font-size: 12px;
            padding: 4px 12px;
            background: var(--background-light);
            border-radius: 20px;
            color: var(--text-light);
            transition: var(--transition-fast);
            font-weight: 500;
        }
        
        .video-tag:hover {
            background: var(--primary-light);
            color: var(--primary-dark);
            transform: translateY(-2px);
        }
        
        .featured-section {
            margin: 80px 0;
            padding: 60px 40px;
            background: linear-gradient(135deg, var(--primary-light) 0%, #f5f5f5 100%);
            border-radius: var(--border-radius-lg);
            box-shadow: var(--box-shadow);
            position: relative;
            overflow: hidden;
        }
        
        .featured-section:before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 150px;
            height: 150px;
            background: var(--primary-light);
            border-radius: 50%;
            opacity: 0.2;
            transform: translate(50%, -50%);
        }
        
        .featured-section:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100px;
            height: 100px;
            background: var(--primary-light);
            border-radius: 50%;
            opacity: 0.2;
            transform: translate(-30%, 30%);
        }
        
        .featured-title {
            text-align: center;
            font-size: 28px;
            color: var(--primary-color);
            margin-bottom: 40px;
            position: relative;
            display: inline-block;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .featured-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50%;
            height: 3px;
            background: var(--primary-color);
        }
        
        .featured-video {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
            z-index: 1;
        }
        
        @media (min-width: 768px) {
            .featured-video {
                flex-direction: row;
                text-align: left;
                align-items: flex-start;
            }
        }
        
        .featured-video-player {
            flex: 1;
            min-width: 300px;
            max-width: 600px;
            margin-bottom: 30px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.15);
            border-radius: var(--border-radius);
            overflow: hidden;
            transition: var(--transition-slow);
            position: relative;
        }
        
        .featured-video-player:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.2);
            opacity: 0;
            transition: var(--transition-fast);
            z-index: 1;
        }
        
        .featured-video-player:after {
            content: '\f04b';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.9);
            width: 80px;
            height: 80px;
            background: var(--primary-color);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            opacity: 0;
            transition: var(--transition-medium);
            z-index: 2;
            box-shadow: 0 0 30px rgba(217, 83, 79, 0.8);
        }
        
        .featured-video-player:hover {
            transform: scale(1.02);
        }
        
        .featured-video-player:hover:before {
            opacity: 1;
        }
        
        .featured-video-player:hover:after {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
        
        .featured-video-info {
            flex: 1;
            padding: 0 20px;
        }
        
        @media (min-width: 768px) {
            .featured-video-info {
                padding: 0 0 0 50px;
            }
        }
        
        .featured-video-title {
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--text-dark);
            line-height: 1.4;
        }
        
        .featured-video-expert {
            font-weight: 500;
            margin-bottom: 20px;
            color: var(--text-medium);
            position: relative;
            padding-left: 30px;
            display: inline-block;
        }
        
        .featured-video-expert:before {
            content: '\f007';
            font-family: 'Font Awesome 6 Free';
            font-weight: 900;
            position: absolute;
            left: 0;
            top: 2px;
            color: var(--primary-color);
            font-size: 18px;
        }
        
        .featured-video-description {
            line-height: 1.8;
            margin-bottom: 30px;
            color: var(--text-medium);
            font-size: 16px;
        }
        
        .watch-btn {
            display: inline-block;
            background: var(--primary-color);
            color: white;
            padding: 14px 30px;
            border-radius: var(--border-radius-round);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition-fast);
            box-shadow: 0 5px 15px rgba(217, 83, 79, 0.3);
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .watch-btn:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background: var(--primary-dark);
            transition: var(--transition-fast);
            z-index: -1;
        }
        
        .watch-btn:hover:before {
            width: 100%;
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
            padding: 14px 28px;
            border-radius: 50px;
            font-weight: 600;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .btn i {
            font-size: 18px;
            transition: transform 0.3s ease;
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
            box-shadow: 0 15px 25px rgba(0, 0, 0, 0.15);
            background-color: white;
        }

        .btn:hover i {
            transform: translateX(5px);
        }

        .btn:active {
            transform: translateY(0) scale(0.98);
        }
        
        .watch-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(217, 83, 79, 0.4);
        }
        
        .watch-btn:active {
            transform: translateY(0);
        }
        
        .newsletter-section {
            background: var(--background-white);
            padding: 60px 30px;
            margin: 60px 0;
            text-align: center;
            border-radius: var(--border-radius-lg);
            box-shadow: var(--box-shadow);
            position: relative;
            overflow: hidden;
        }
        
        .newsletter-section:before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 150px;
            height: 150px;
            background: var(--primary-light);
            border-radius: 50%;
            opacity: 0.3;
        }
        
        .newsletter-section:after {
            content: '';
            position: absolute;
            bottom: -30px;
            left: -30px;
            width: 100px;
            height: 100px;
            background: var(--primary-light);
            border-radius: 50%;
            opacity: 0.3;
        }
        
        .newsletter-title {
            font-size: 28px;
            color: var(--text-dark);
            margin-bottom: 20px;
            position: relative;
            display: inline-block;
        }
        
        .newsletter-title:after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: var(--primary-color);
            transition: var(--transition-fast);
        }
        
        .newsletter-title:hover:after {
            width: 80px;
        }
        
        .newsletter-description {
            max-width: 600px;
            margin: 0 auto 40px;
            color: var(--text-medium);
            font-size: 16px;
        }
        
        .newsletter-form {
            display: flex;
            max-width: 500px;
            margin: 0 auto;
            flex-wrap: wrap;
            justify-content: center;
            position: relative;
            z-index: 1;
        }
        
        .newsletter-input {
            flex: 1;
            min-width: 200px;
            padding: 15px 25px;
            border: 1px solid #dee2e6;
            border-radius: var(--border-radius-round);
            margin-right: 15px;
            margin-bottom: 15px;
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            transition: var(--transition-fast);
        }
        
        .newsletter-input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(217, 83, 79, 0.1);
        }
        
        .newsletter-btn {
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: var(--border-radius-round);
            cursor: pointer;
            transition: var(--transition-fast);
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            font-size: 15px;
            position: relative;
            overflow: hidden;
            z-index: 1;
        }
        
        .newsletter-btn:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0%;
            height: 100%;
            background: var(--primary-dark);
            transition: var(--transition-fast);
            z-index: -1;
        }
        
        .newsletter-btn:hover:before {
            width: 100%;
        }
        
        .newsletter-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(217, 83, 79, 0.3);
        }
        
        .loader {
            display: flex;
            justify-content: center;
            margin: 40px 0;
        }
        
        .loader-dot {
            width: 12px;
            height: 12px;
            margin: 0 5px;
            background: var(--primary-color);
            border-radius: 50%;
            animation: bounce 1.5s infinite ease-in-out;
            transform-origin: center bottom;
        }
        
        .loader-dot:nth-child(2) {
            animation-delay: 0.2s;
            background: rgba(217, 83, 79, 0.8);
        }
        
        .loader-dot:nth-child(3) {
            animation-delay: 0.4s;
            background: rgba(217, 83, 79, 0.6);
        }
        
        @keyframes bounce {
            0%, 100% {
                transform: translateY(0) scale(1);
            }
            50% {
                transform: translateY(-20px) scale(1.1);
                box-shadow: 0 15px 10px rgba(0,0,0,0.1);
            }
        }

        /* Container for everything */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
        }
    </style>
</head>
<body>
    <section class="hero">
        <div class="container">
            <h1><i class="fas fa-heartbeat"></i> Educational Videos</h1>
            <p>Watch informative videos about heart disease prevention, treatment options, and lifestyle modifications from leading cardiologists and health experts. Our curated collection offers valuable insights to help you maintain a healthy heart.</p>
            <a href="#video-categories" class="btn"><i class="fas fa-play-circle"></i> Explore Videos <i class="fas fa-chevron-right"></i></a>
        </div>
    </section>

    <div class="video-container">
        <div class="video-categories" id="video-categories">
            <button class="category-btn active" data-category="all">All Videos</button>
            <button class="category-btn" data-category="prevention">Prevention</button>
            <button class="category-btn" data-category="treatment">Treatment Options</button>
            <button class="category-btn" data-category="lifestyle">Lifestyle Changes</button>
            <button class="category-btn" data-category="expert">Expert Talks</button>
        </div>
        
        <  <div class="video-grid">
            <?php foreach ($videos as $video): ?>
                <div class="video-card" data-category="<?php echo $video['category']; ?>">
                    <a href="<?php echo $video['url']; ?>" target="_blank">
                        <div class="video-thumbnail">
                            <img src="<?php echo $video['thumbnail']; ?>" alt="<?php echo htmlspecialchars($video['title']); ?>">
                            <div class="play-icon"></div>
                        </div>
                    </a>
                    <div class="video-info">
                        <h3 class="video-title"><?php echo $video['title']; ?></h3>
                        <div class="video-meta">
                            <span><?php echo $video['speaker']; ?></span>
                            <span><?php echo $video['duration']; ?></span>
                        </div>
                        <p class="video-description"><?php echo $video['description']; ?></p>
                        <div class="video-tags">
                            <?php foreach ($video['tags'] as $tag): ?>
                                <span class="video-tag"><?php echo $tag; ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
            
           
        
        <div class="loader" id="video-loader">
            <div class="loader-dot"></div>
            <div class="loader-dot"></div>
            <div class="loader-dot"></div>
        </div>
        
        <div class="featured-section">
            <h2 class="featured-title">Featured Video</h2>
            <div class="featured-video">
                <div class="featured-video-player">
                    <img src="image/heart.jpg" alt="Featured Heart Care Video" style="width: 100%;">
                </div>
                <div class="featured-video-info">
                    <h3 class="featured-video-title">Heart Disease Prevention: A Comprehensive Guide</h3>
                    <p class="featured-video-expert">By Dr. Robert Anderson, Chief of Cardiology</p>
                    <p class="featured-video-description">In this comprehensive guide, Dr. Anderson outlines the most effective strategies for preventing heart disease. From diet and exercise to stress management and regular screenings, this video covers everything you need to know to maintain a healthy heart for years to come.</p>
                    <a href="#" class="watch-btn">Watch Now</a>
                </div>
            </div>
        </div>
        
        <div class="newsletter-section">
            <h3 class="newsletter-title">Never Miss a New Video</h3>
            <p class="newsletter-description">Subscribe to our newsletter to receive notifications when we publish new educational videos and heart health resources.</p>
            <form class="newsletter-form">
                <input type="email" class="newsletter-input" placeholder="Your email address">
                <button type="submit" class="newsletter-btn">Subscribe</button>
            </form>
        </div>
    </div>
    
    <script>
        // JavaScript for the video page functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Show videos with animation on page load
            const videoCards = document.querySelectorAll('.video-card');
            videoCards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('visible');
                }, 100 * index);
            });
            
            // Hide loader after all videos are loaded
            setTimeout(() => {
                document.getElementById('video-loader').style.display = 'none';
            }, 100 * videoCards.length + 200);
            
            // Category filtering
            const categoryBtns = document.querySelectorAll('.category-btn');
            categoryBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Update active button
                    categoryBtns.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');
                    
                    const category = this.getAttribute('data-category');
                    
                    // Hide all videos first
                    videoCards.forEach(card => {
                        card.classList.remove('visible');
                        setTimeout(() => {
                            if (category === 'all' || card.getAttribute('data-category') === category) {
                                card.style.display = 'block';
                                setTimeout(() => {
                                    card.classList.add('visible');
                                }, 50);
                            } else {
                                card.style.display = 'none';
                            }
                        }, 300);
                    });
                });
            });
            
            // Add hover effect for video thumbnails
            videoCards.forEach(card => {
                card.addEventListener('click', function() {
                    alert('Are you sure you want to leave and watch this video?');
                });
            });
            
            // Newsletter form submission (placeholder)
            const newsletterForm = document.querySelector('.newsletter-form');
            if (newsletterForm) {
                newsletterForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const email = this.querySelector('.newsletter-input').value;
                    if (email) {
                        alert('Thank you for subscribing! You will receive our updates soon.');
                        this.reset();
                    } else {
                        alert('Please enter a valid email address.');
                    }
                });
            }
        });
    </script>
</body>
</html>