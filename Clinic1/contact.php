<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

  
    if (!empty($name) && !empty($email) && !empty($message)) {
        $success_msg = "Thank you, $name. Your message has been sent!";
    } else {
        $error_msg = "Please fill in all fields!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="contact-style.css">
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="logo">Clinic Management</div>
        <div class="navbar-links">
            <a href="index.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="contact.php" class="active">Contact</a>
            <a href="login.php">Login</a>
        </div>
    </nav>

    <!-- Contact Page Content -->
    <div class="contact-container">
        <h1>Contact Us</h1>
        <p>We'd love to hear from you! Feel free to reach out using the form below or through the contact information provided.</p>
        
        <!-- Email & Map Section -->
        <div class="info-section">
            <div class="email-info">
                <h2>Email Us</h2>
                <p>Reach out at: <a href="mailto:info@clinicmanagement.com">info@clinicmanagement.com</a></p>
                <p>Phone: +1-800-CLINIC</p>
            </div>
            <div class="map-container">
                <h2>Our Location</h2>
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126915.8928872538!2d-122.48214643134065!3d37.75767923884714!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8085809c2a15e789%3A0x7b1b33e328cb34b1!2sSan+Francisco%2C+CA%2C+USA!5e0!3m2!1sen!2sin!4v1616006600735!5m2!1sen!2sin" 
                    width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

        
        <?php if (isset($success_msg)) { ?>
            <div class="success"><?php echo $success_msg; ?></div>
        <?php } ?>
        
        <?php if (isset($error_msg)) { ?>
            <div class="error"><?php echo $error_msg; ?></div>
        <?php } ?>

        <!-- Contact Form Section -->
        <form action="contact.php" method="POST" class="contact-form">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="5" required></textarea>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>

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
    background-color: #f0f4f8;
    color: #333;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
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

.navbar-links a.active,
.navbar-links a:hover {
    background-color: #0056b3;
}

/* Contact Form Container */
.contact-container {
    margin: 100px auto 20px;
    padding: 40px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    max-width: 800px;
    width: 90%;
}

.contact-container h1 {
    font-size: 28px;
    color: #007bff;
    margin-bottom: 15px;
}

.contact-container p {
    margin-bottom: 20px;
    font-size: 16px;
    color: #555;
}

/* Email and Map Section */
.info-section {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-bottom: 30px;
}

.email-info {
    text-align: center;
}

.email-info h2 {
    font-size: 22px;
    color: #007bff;
    margin-bottom: 10px;
}

.email-info p {
    font-size: 16px;
    color: #555;
}

.email-info a {
    color: #0056b3;
    text-decoration: none;
}

.email-info a:hover {
    text-decoration: underline;
}

.map-container iframe {
    border-radius: 8px;
}

/* Contact Form */
.contact-form .form-group {
    margin-bottom: 15px;
}

.contact-form label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
    color: #333;
}

.contact-form input,
.contact-form textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

.contact-form textarea {
    resize: none;
}

.contact-form button {
    display: block;
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 10px;
    transition: background-color 0.3s;
}

.contact-form button:hover {
    background-color: #0056b3;
}

/* Footer Styles */
footer {
    background-color: #2c3e50;
    color: white;
    text-align: center;
    padding: 15px;
    margin-top: auto;
}
</style>
