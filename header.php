<?php
ob_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Heart Health Insights'; ?></title>
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
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif !important;
  color: var(--text-color) !important;
  line-height: 1.6 !important;
  background-color: #f8f9fa !important;
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

/* User Profile Icon */
.user-profile {
  margin-left: 20px;
}

.profile-circle {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  background-color: var(--secondary-light);
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  cursor: pointer;
  transition: var(--transition);
  border: 2px solid var(--border-color);
}

.profile-circle:hover {
  border-color: var(--primary-color);
  transform: scale(1.05);
}

.profile-circle img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.profile-circle i {
  color: var(--secondary-color);
  font-size: 1.2rem;
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

/* Responsive Styles */
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
}

@media (max-width: 576px) {
  h1 {
    font-size: 2rem;
  }
  
  h2 {
    font-size: 1.8rem;
  }
}
    </style>
    <?php if (isset($additionalCSS)) echo $additionalCSS; ?>
    <?php if (isset($additionalHeadContent)) echo $additionalHeadContent; ?>
</head>
<body>
    <header class="header">
        <div class="container">
            <nav class="navbar">
                <div class="logo"><i class="fas fa-heartbeat"></i> Heart Health Insights</div>
                <div class="mobile-menu" id="mobile-menu">
                    <i class="fas fa-bars"></i>
                </div>
                <ul class="nav-links" id="nav-links">
                    <li><a href="dashboard.php" <?php echo (isset($currentPage) && $currentPage == 'home') ? 'class="active"' : ''; ?>>Home</a></li>
                    <li><a href="learnaboutHeartDisease.php" <?php echo (isset($currentPage) && $currentPage == 'learn') ? 'class="active"' : ''; ?>>Learn About Heart Disease</a></li>
                    <li><a href="symptom-checker.php" <?php echo (isset($currentPage) && $currentPage == 'symptom') ? 'class="active"' : ''; ?>>Symptom Checker</a></li>
                    <li><a href="Resources.php" <?php echo (isset($currentPage) && $currentPage == 'resources') ? 'class="active"' : ''; ?>>Resources</a></li>
                    <li><a href="contact.php" <?php echo (isset($currentPage) && $currentPage == 'contact') ? 'class="active"' : ''; ?>>Contact</a></li>
                    <li class="user-profile">
                        <a href="user_profile.php">
                            <div class="profile-circle">
                                <?php if(isset($_SESSION['user_id'])): ?>
                                    <?php if(isset($_SESSION['user_profile']) && !empty($_SESSION['user_profile'])): ?>
                                        <img src="uploads/<?php echo htmlspecialchars($_SESSION['user_profile']); ?>" alt="Profile Picture" style="width: 100%; height: 100%; object-fit: cover;">
                                    <?php else: ?>
                                        <i class="fas fa-user"></i>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <i class="fas fa-user"></i>
                                <?php endif; ?>
                            </div>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </header>
    
    <?php if (isset($includeHero) && $includeHero): ?>
    <section class="hero">
        <div class="container">
            <h1><?php echo isset($heroIcon) ? $heroIcon : '<i class="fas fa-heartbeat"></i>'; ?> <?php echo isset($heroTitle) ? $heroTitle : 'Heart Health Insights'; ?></h1>
            <p><?php echo isset($heroText) ? $heroText : 'Identify potential heart-related symptoms and get guidance on when to seek medical attention. This tool is for informational purposes only and does not replace professional medical advice.'; ?></p>
            <?php if (isset($heroButton) && isset($heroButtonLink)): ?>
            <a href="<?php echo $heroButtonLink; ?>" class="btn"><?php echo $heroButton; ?></a>
            <?php endif; ?>
        </div>
    </section>
    <?php endif; ?>
    
    <!-- Script for mobile menu toggle -->
    <script>
        document.getElementById('mobile-menu').addEventListener('click', function() {
            document.getElementById('nav-links').classList.toggle('active');
        });
    </script>
</body>
</html>