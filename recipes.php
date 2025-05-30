<?php
// Heart-Healthy Recipes.php
// A website for heart-healthy recipes that accommodate dietary restrictions
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heart-Healthy Recipes</title>
    <style>
        /* Global Styles */
        :root {
            --primary-color: #e74c3c;
            --secondary-color: #3498db;
            --accent-color: #2ecc71;
            --text-color: #333;
            --light-bg: #f9f9f9;
            --box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            color: var(--text-color);
            background-color: var(--light-bg);
            line-height: 1.6;
        }
        
        a {
            text-decoration: none;
            color: var(--secondary-color);
            transition: color 0.3s ease;
        }
        
        a:hover {
            color: var(--primary-color);
        }

        img.heart-icon {
            width: 20px;
            vertical-align: middle;
            margin-right: 5px;
        }

        /* Header Styles */
        header {
            background: linear-gradient(135deg, var(--primary-color), #ff7675);
            color: white;
            padding: 2rem 0;
            text-align: center;
            box-shadow: var(--box-shadow);
        }
        
        .logo {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }
        
        .logo span {
            color: white;
        }
        
        .tagline {
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            font-weight: 300;
        }
        
        nav {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 1rem;
            border-radius: 50px;
            display: inline-block;
        }
        
        nav ul {
            list-style: none;
            display: flex;
            justify-content: center;
        }
        
        nav li {
            margin: 0 1rem;
        }
        
        nav a {
            color: white;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            transition: background-color 0.3s ease;
        }
        
        nav a:hover,
        nav a.active {
            background-color: rgba(255, 255, 255, 0.2);
        }

        /* Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        /* Hero Section */
        .hero {
            display: flex;
            align-items: center;
            margin: 2rem 0;
            gap: 2rem;
            flex-wrap: wrap;
        }
        
        .hero-content {
            flex: 1;
            min-width: 300px;
        }
        
        .hero h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }
        
        .hero p {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }
        
        .hero-image {
            flex: 1;
            min-width: 300px;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--box-shadow);
        }
        
        .hero-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        /* Dietary Filter */
        .filter-section {
            background-color: white;
            border-radius: 10px;
            padding: 1.5rem;
            margin: 2rem 0;
            box-shadow: var(--box-shadow);
        }
        
        .filter-title {
            font-size: 1.3rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }
        
        .filter-options {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .filter-option {
            padding: 0.5rem 1rem;
            background-color: #f1f1f1;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .filter-option:hover {
            background-color: #e0e0e0;
        }
        
        .filter-option.active {
            background-color: var(--secondary-color);
            color: white;
        }

        /* Recipe Cards */
        .recipe-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin: 2rem 0;
        }
        
        .recipe-card {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: var(--box-shadow);
            transition: transform 0.3s ease;
        }
        
        .recipe-card:hover {
            transform: translateY(-5px);
        }
        
        .recipe-image {
            height: 200px;
            overflow: hidden;
        }
        
        .recipe-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .recipe-card:hover .recipe-image img {
            transform: scale(1.05);
        }
        
        .recipe-content {
            padding: 1.5rem;
        }
        
        .recipe-title {
            font-size: 1.3rem;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
        }
        
        .recipe-description {
            margin-bottom: 1rem;
            color: #666;
        }
        
        .recipe-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        
        .recipe-tag {
            font-size: 0.8rem;
            padding: 0.2rem 0.6rem;
            background-color: #f1f1f1;
            border-radius: 20px;
        }
        
        .read-more {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            background-color: var(--secondary-color);
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        
        .read-more:hover {
            background-color: var(--primary-color);
        }

        /* ... rest unchanged ... */
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    

    <div class="container">
        <section class="hero">
            <div class="hero-content">
                <h1>Nourish Your Heart with Delicious Recipes</h1>
                <p>Discover a collection of heart-healthy recipes designed to support cardiovascular health while satisfying your taste buds. Our recipes are carefully crafted to accommodate various dietary restrictions, making healthy eating accessible to everyone.</p>
                <a href="#recipes" class="read-more">Explore Recipes</a>
            </div>
            <div class="hero-image">
                <img src="image/food.jpeg" alt="Colorful plate of heart-healthy food">
            </div>
        </section>

        <section class="filter-section">
            <h2 class="filter-title">Filter by Dietary Needs</h2>
            <div class="filter-options">
                <div class="filter-option active" data-filter="all">All Recipes</div>
                <div class="filter-option" data-filter="low-sodium">Low Sodium</div>
                <div class="filter-option" data-filter="low-cholesterol">Low Cholesterol</div>
                <div class="filter-option" data-filter="gluten-free">Gluten Free</div>
                <div class="filter-option" data-filter="vegan">Vegan</div>
                <div class="filter-option" data-filter="vegetarian">Vegetarian</div>
                <div class="filter-option" data-filter="mediterranean">Mediterranean</div>
                <div class="filter-option" data-filter="dash">DASH Diet</div>
            </div>
        </section>

        <section id="recipes" class="recipe-grid">
            <?php
            // In a real implementation, these would come from a database
            $recipes = [
                [
                    'id' => 1,
                    'title' => 'Mediterranean Quinoa Bowl',
                    'description' => 'A protein-rich quinoa bowl with roasted vegetables, olives, and a light lemon dressing.',
                    'image' => 'image/food.jpeg',
                    'tags' => ['low-sodium', 'gluten-free', 'vegetarian', 'mediterranean'],
                    'link' => 'https://www.loveandlemons.com/quinoa-bowl/'
                ],
                [
                    'id' => 2,
                    'title' => 'Heart-Healthy Salmon with Avocado Salsa',
                    'description' => 'Omega-3 rich salmon topped with fresh avocado salsa for a nutrient-dense meal.',
                    'image' => 'image/food.jpeg',
                    'tags' => ['low-cholesterol', 'gluten-free', 'dash'],
                    'link' => 'https://www.eatingwell.com/recipe/8012962/air-fryer-orange-salmon-with-avocado-salsa/'
                ],
                [
                    'id' => 3,
                    'title' => 'Colorful Veggie Stir-Fry',
                    'description' => 'A quick and nutritious stir-fry packed with colorful vegetables and plant-based protein.',
                    'image' => 'image/food.jpeg',
                    'tags' => ['vegan', 'low-sodium', 'gluten-free'],
                    'link' => 'https://www.loveandlemons.com/stir-fry-recipe/'
                ],
                [
                    'id' => 4,
                    'title' => 'Oatmeal Berry Breakfast Bowl',
                    'description' => 'Start your day with heart-healthy oats topped with antioxidant-rich berries and nuts.',
                    'image' => 'image/food.jpeg',
                    'tags' => ['vegetarian', 'dash', 'low-cholesterol'],
                    'link' => 'https://www.eatingwell.com/recipe/251104/creamy-blueberry-pecan-oatmeal/'
                ],
                [
                    'id' => 5,
                    'title' => 'Lentil and Vegetable Soup',
                    'description' => 'A comforting soup rich in fiber and plant protein, perfect for heart health.',
                    'image' => 'image/food.jpeg',
                    'tags' => ['vegan', 'low-sodium', 'dash'],
                    'link' => 'https://www.eatingwell.com/recipe/7917979/one-pot-lentil-vegetable-soup-with-parmesan/'
                ],
                [
                    'id' => 6,
                    'title' => 'Nut & Berry Parfait',
                    'description' => 'Greek yogurt layered with berries, almonds, and a drizzle of honey for a sweet-and-savory snack.',
                    'image' => 'image/food.jpeg',
                    'tags' => ['vegetarian', 'gluten-free', 'mediterranean'],
                    'link' => 'https://www.eatingwell.com/recipe/252837/nut-berry-parfait/'
                ]
            ];

            // Display recipe cards
            foreach ($recipes as $recipe) {
                echo '<div class="recipe-card" data-tags="' . implode(' ', $recipe['tags']) . '">';
                echo '<div class="recipe-image"><img src="' . $recipe['image'] . '" alt="' . htmlspecialchars($recipe['title']) . '"></div>';
                echo '<div class="recipe-content">';
                echo '<h3 class="recipe-title"><img src="image/food.jpeg" alt="Heart Icon" class="heart-icon">' . htmlspecialchars($recipe['title']) . '</h3>';
                echo '<p class="recipe-description">' . htmlspecialchars($recipe['description']) . '</p>';
                echo '<div class="recipe-tags">';
                foreach ($recipe['tags'] as $tag) {
                    echo '<span class="recipe-tag">' . ucfirst(str_replace('-', ' ', $tag)) . '</span>';
                }
                echo '</div>';
                echo '<a href="' . $recipe['link'] . '" class="read-more"><img src="image/food.jpeg" alt="Heart Icon" class="heart-icon">View Recipe</a>';
                echo '</div></div>';
            }
            ?>
        </section>

      
    </div>
    <script>
        // Recipe filtering functionality
        document.addEventListener('DOMContentLoaded', function() {
            const filterOptions = document.querySelectorAll('.filter-option');
            const recipeCards = document.querySelectorAll('.recipe-card');
            
            filterOptions.forEach(option => {
                option.addEventListener('click', function() {
                    // Remove active class from all options
                    filterOptions.forEach(opt => opt.classList.remove('active'));
                    
                    // Add active class to clicked option
                    this.classList.add('active');
                    
                    const filter = this.getAttribute('data-filter');
                    
                    // Filter recipes
                    recipeCards.forEach(card => {
                        if (filter === 'all') {
                            card.style.display = 'block';
                        } else {
                            const tags = card.getAttribute('data-tags');
                            if (tags.includes(filter)) {
                                card.style.display = 'block';
                            } else {
                                card.style.display = 'none';
                            }
                        }
                    });
                });
            });

            // Smooth scroll
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
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

            // Newsletter form submission
            const newsletterForm = document.querySelector('.newsletter-form');
            
            if (newsletterForm) {
                newsletterForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const emailInput = this.querySelector('.newsletter-input');
                    
                    if (emailInput.value) {
                        alert('Thank you for subscribing! You will receive our weekly heart-healthy recipes.');
                        emailInput.value = '';
                    } else {
                        alert('Please enter a valid email address.');
                    }
                });
            }
        });
    </script>
</body>
</html>
