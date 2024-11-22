<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'clinic_mgm', 3307);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role']; 


    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE email = ? AND role = ?");
    $stmt->bind_param("ss", $email, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $user['password'])) {
  
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role'] = $user['role'];

            if ($user['role'] === 'doctor') {
                header("Location: doctor_dashboard.php");
                exit();
            } elseif ($user['role'] === 'receptionist') {
                header("Location: receptionist_dashboard.php");
                exit();
            }
        } else {
            echo "<div class='error-message'>Error: Invalid email or password.</div>";
        }
    } else {
        echo "<div class='error-message'>Error: Invalid email, password, or role.</div>";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Clinic Management System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Navbar -->
    <header class="navbar">
        <div class="logo">Clinic Management</div>
        <nav class="navbar-links">
            <a href="index.php">Home</a>
            <a href="about.php">About Us</a>
            <a href="contact.php">Contact</a>
            <a href="login.php">Login</a>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Login to Your Account</h1>
            <p>Please log in to access your dashboard.</p>
        </div>
    </section>

    <!-- Login Form Section -->
    <section class="login-section">
        <div class="container">
            <h2>Login to Your Account</h2>

            <form method="POST">
                <div class="form-group">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <select name="role" required>
                        <option value="doctor">Doctor</option>
                        <option value="receptionist">Receptionist</option>
                    </select>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>

            <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
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

/* Hero Section */
.hero {

 

    color: white;

    padding: 10px 30px;
    margin-top: 100px;
}

.hero h1 {
    font-size: 48px;
    margin-bottom: 20px;
}

.hero p {
    font-size: 20px;
    margin-bottom: 30px;
}

/* Login Form Styles */
.login-section {
    background-color: white;
    padding: 50px 0;
}

.login-section .container {
    max-width: 600px;
    margin: 0 auto;
    text-align: center;
}

.login-section h2 {
    font-size: 36px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 15px;
    border-radius: 5px;
    border: 1px solid #ddd;
    font-size: 16px;
}

button.btn {
    padding: 15px 30px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 18px;
    transition: background-color 0.3s ease;
}

button.btn:hover {
    background-color: #0056b3;
}

.error-message {
    background-color: #ffdddd;
    color: #d8000c;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
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

    .login-section .container {
        padding: 0 20px;
    }
}
