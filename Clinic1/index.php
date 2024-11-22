<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Management System</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body>

    <!-- Navbar -->
    <header class="navbar">
        <div class="logo">Clinic Management</div>
        <nav class="navbar-links">
            <a href="index.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="./contact.php">Contact</a>
            <a href="login.php">Login</a>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Welcome to Our Clinic</h1>
            <p>Providing quality healthcare for you and your family</p>
            <a href="services.php" class="cta-button">Get Started</a>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="about">
        <div class="container">
            <h2>About Us</h2>
            <p>Our clinic is dedicated to providing top-notch healthcare services with a focus on patient care and comfort. Our team of experienced doctors and staff are here to help you live a healthier life.</p>
            <img src="Clinic.jpg" alt="Clinic Image">
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Clinic Management System | All Rights Reserved</p>
    </footer>

</body>
</html>


<style>
  
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    background-color: #f4f7fc;
    color: #333;
}

/* Navbar Styles */
.navbar {
    background-color: #007bff;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 20px 30px;
    position: fixed;
    width: 100%;
    top: 0;
    z-index: 1000;
}

.navbar .logo {
    font-size: 28px;
    font-weight: bold;
}

.navbar-links {
    display: flex;
    gap: 20px;
}

.navbar-links a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    padding: 10px;
    transition: background-color 0.3s ease;
}

.navbar-links a:hover {
    background-color: #0056b3;
}


.hero {
    background-image: url('clinic-hero.jpg'); 
    background-size: cover;
    background-position: center;
    color:purple;
    text-align: center;
    padding: 100px 20px;
    margin-top: 80px; 
}

.hero h1 {
    font-size: 48px;
    margin-bottom: 20px;
}

.hero p {
    font-size: 20px;
    margin-bottom: 30px;
}

.cta-button {
    background-color: #007bff;
    color: white;
    padding: 15px 30px;
    text-decoration: none;
    font-size: 18px;
    border-radius: 5px;
    transition: background-color 0.3s ease;
}

.cta-button:hover {
    background-color: #0056b3;
}

/* About Section */
.about {
    background-color: white;
    padding: 50px 0;
}

.about .container {
    max-width: 1200px;
    margin: 0 auto;
    text-align: center;
}

.about h2 {
    font-size: 36px;
    margin-bottom: 20px;
}

.about p {
    font-size: 18px;
    line-height: 1.6;
    color: #555;
    margin-bottom: 40px;
}

.about img {
    width: 100%;
    max-width: 600px;
    border-radius: 10px;
    margin: 0 auto;
    display: block;
}

/* Footer */
footer {
    background-color: #2c3e50;
    color: white;
    text-align: center;
    padding: 20px;
    margin-top: 40px;
}

/* Responsive Design */
@media (max-width: 768px) {
    .navbar {
        flex-direction: column;
        align-items: flex-start;
        padding: 15px;
    }

    .navbar-links {
        flex-direction: column;
        gap: 10px;
    }

    .hero h1 {
        font-size: 36px;
    }

    .hero p {
        font-size: 18px;
    }

    .cta-button {
        padding: 12px 25px;
        font-size: 16px;
    }

    .about .container {
        padding: 0 20px;
    }

    .about img {
        width: 90%;
        margin-bottom: 20px;
    }
}
</style>