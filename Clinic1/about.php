<?php

session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <link rel="stylesheet" href="styles.css"> 
</head>
<body>
    <!-- Navbar -->
    <header class="navbar">
        <div class="logo">Clinic Management</div>
        <nav class="navbar-links">
            <a href="index.php">Home</a>
            <a href="about.php" class="active">About Us</a>
            <a href="./contact.php">Contact</a>
            <a href="login.php">Login</a>
        </nav>
    </header>

    <!-- About Content -->
    <div class="content-container">
        <h1>About Our Clinic</h1>
        <p>
            Welcome to our clinic management system. Our mission is to enhance healthcare operations by providing a seamless and efficient management solution.
        </p>

        <h2>Our Mission</h2>
        <p>
            To empower healthcare professionals with technology-driven solutions that simplify clinic operations and improve patient outcomes.
        </p>

        <h2>Our Vision</h2>
        <p>
            We envision a world where healthcare management is accessible, streamlined, and efficient for everyone.
        </p>

        <h2>Our Core Values</h2>
        <ul class="value-list">
            <li>Compassionate care for every patient.</li>
            <li>Innovation in healthcare management solutions.</li>
            <li>Commitment to excellence and integrity.</li>
            <li>Focus on patient satisfaction and safety.</li>
        </ul>

        <h2>Why Choose Us?</h2>
        <p>
            Our clinic is designed to meet the unique needs of healthcare providers and patients alike. By leveraging modern technology, we streamline appointment scheduling, patient records, and billing—making it easier for everyone involved. 
        </p>
    </div>
</body>
</html>


<style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* Navbar Styling */
.navbar {
    background-color: #007bff; 
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 30px;
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
    border-radius: 4px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.navbar-links a.active,
.navbar-links a:hover {
    background-color: #0056b3; 
    color: #ffffff;
}

/* Content Container */
.content-container {
    max-width: 900px;
    margin: 100px auto 50px;
    padding: 25px;
    background-color: #eef4fb; 
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    border-radius: 10px;
    text-align: left; 
}
.content-container h1 {
    font-size: 2.8em;
    color: #0056b3;
    margin-bottom: 20px;
}
.content-container h2 {
    font-size: 1.8em;
    color: #007bff;
    margin: 20px 0 10px;
}
.content-container p {
    font-size: 1.2em;
    line-height: 1.8;
    color: #333;
    margin-bottom: 20px;
}
.content-container ul {
    margin: 20px 0;
    padding-left: 20px;
}
.value-list li {
    font-size: 1.1em;
    line-height: 1.6;
    margin-bottom: 10px;
    color: #0056b3; /
}
</style>
