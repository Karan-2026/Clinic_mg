<?php
$conn = new mysqli('localhost', 'root', '', 'clinic_mgm', 3307);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $mobile_no = $_POST['mobile_no'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    // Backend validation for age >= 21
    if ($age < 21) {
        echo "Error: Age must be 21 or older.";
    } elseif (preg_match('/\d/', $name)) {
        // Backend validation for name (no numbers allowed)
        echo "Error: Name cannot contain numeric characters.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Backend validation for email
        echo "Error: Invalid email format.";
    } elseif (!ctype_digit($mobile_no) || strlen($mobile_no) !== 10) {
        // Backend validation for mobile number
        echo "Error: Mobile number must be exactly 10 digits and numeric.";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (name, age, gender, mobile_no, email, password, role) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sisssss", $name, $age, $gender, $mobile_no, $email, $password, $role);

        if ($stmt->execute()) {
            echo "Signup successful! You can now <a href='login.php'>login</a>.";
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Clinic Management System</title>
    <link rel="stylesheet" href="styles.css">
    <script>
        // Real-time validation for numeric-only input and max length of 10
        function validateMobile(input) {
            input.value = input.value.replace(/[^0-9]/g, ''); // Allow only numeric characters
            if (input.value.length > 10) {
                input.value = input.value.slice(0, 10); // Limit input to 10 digits
            }
        }

        // Complete form validation
        function validateForm() {
            const age = document.getElementById('age').value;
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const mobile_no = document.getElementById('mobile_no').value;

            // Age validation
            if (age < 21) {
                alert("Age must be 21 or older.");
                return false;
            }

            // Name validation (should not contain numbers)
            const namePattern = /^[^\d]+$/;
            if (!namePattern.test(name)) {
                alert("Name cannot contain numbers.");
                return false;
            }

            // Email validation
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }

            // Mobile number validation (must be exactly 10 digits)
            if (mobile_no.length !== 10) {
                alert("Mobile number must be exactly 10 digits.");
                return false;
            }

            return true;
        }
    </script>
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
          
            <p>Join our clinic management system by creating an account</p>
        </div>
    </section>

    <!-- Sign Up Form Section -->
    <section class="signup-section">
        <div class="container">
            <h2>Sign Up</h2>

            <form method="POST" onsubmit="return validateForm()">
                <div class="form-group">
                    <input type="text" name="name" id="name" placeholder="Full Name" required>
                </div>
                <div class="form-group">
                    <input type="number" name="age" id="age" placeholder="Age" required>
                </div>
                <div class="form-group">
                    <select name="gender" required>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="form-group">
                    <input type="text" name="mobile_no" id="mobile_no" placeholder="Mobile No" oninput="validateMobile(this)" required>
                </div>
                <div class="form-group">
                    <input type="email" name="email" id="email" placeholder="Email" required>
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
                <button type="submit" class="btn">Sign Up</button>
            </form>

            <p>Already have an account? <a href="login.php">Login</a></p>
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
    background-image: url('clinic-hero.jpg'); 
    background-size: cover;
    background-position: center;
    color: purple;
    text-align: center;
    padding: 10px 20px;
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

/* Sign Up Section */
.signup-section {
    padding: 50px 0;
    text-align: center;
}

.signup-section .container {
    max-width: 600px;
    margin: 0 auto;
    background-color: white;
    border-radius: 10px;
    padding: 30px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.signup-section h2 {
    font-size: 32px;
    margin-bottom: 30px;
    color: #333;
}

.form-group {
    margin-bottom: 20px;
}

.form-group input,
.form-group select {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 5px;
    margin-bottom: 10px;
}

.form-group input:focus,
.form-group select:focus {
    border-color: #007bff;
    outline: none;
}

button {
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 18px;
}

button:hover {
    background-color: #0056b3;
}

/* Footer */
footer {
    text-align: center;
    padding: 20px;
    background-color: #333;
    color: white;
    margin-top: 30px;
}
</style>