<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'doctor') {
    header("Location: login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'clinic_mgm', 3307);

// Handle Add Patient Form
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_patient'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $mobile_no = $_POST['mobile_no'];
    $prescription = $_POST['prescription'];

    if (preg_match('/\d/', $name)) {
        echo "<script>alert('Name should not contain numbers.');</script>";
    } 
  
    elseif (!preg_match('/^\d{10}$/', $mobile_no)) {
        echo "<script>alert('Mobile number must be exactly 10 digits and contain only numbers.');</script>";
    } else {
 
        $stmt = $conn->prepare("INSERT INTO patients (name, age, gender, mobile_no, prescription) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sisss", $name, $age, $gender, $mobile_no, $prescription);
        $stmt->execute();
        $stmt->close();

    
        header("Location: doctor_dashboard.php");
        exit();
    }
}


if (isset($_GET['delete_patient_id'])) {
    $patient_id = $_GET['delete_patient_id'];

   
    $stmt = $conn->prepare("DELETE FROM patients WHERE id = ?");
    $stmt->bind_param("i", $patient_id);
    $stmt->execute();
    $stmt->close();

    // Redirect back to the dashboard after deleting
    header("Location: doctor_dashboard.php");
    exit();
}

$sql = "SELECT * FROM patients";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Dashboard</title>
    <style>
 
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
            color: #333;
        }

        header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 20px;
        }

        h1 {
            margin: 0;
        }

        h2 {
            color: #4CAF50;
        }

        /* Container for content */
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #4CAF50;
            color: white;
        }

        table tr:hover {
            background-color: #f1f1f1;
        }

        /* Button Styling */
        .btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .btn:hover {
            background-color: #45a049;
        }

        /* Form Styling */
        .form-container {
            margin-bottom: 30px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-container input, .form-container select, .form-container textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        /* No Data Message */
        .no-data {
            text-align: center;
            color: #777;
            font-size: 18px;
        }

        /* Footer */
        footer {
            text-align: center;
            margin-top: 30px;
            background-color: #f1f1f1;
            padding: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to the Doctor Dashboard</h1><a href="logout.php" class="btn">Logout</a>

    </header>

    <div class="container">
        <h2>Patient List</h2>

        <div class="form-container">
            <h3>Add New Patient</h3>
            <form method="POST">
                <input type="text" name="name" placeholder="Patient's Name" required>
                <input type="number" name="age" placeholder="Age" required>
                <select name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
                <input type="text" name="mobile_no" placeholder="Mobile Number" required pattern="\d{10}">
                <textarea name="prescription" placeholder="Prescription" rows="4" required></textarea>
                <button type="submit" name="add_patient" class="btn">Add Patient</button>
            </form>
        </div>

        <!-- Patient List Table -->
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Mobile</th>
                        <th>Prescription</th>
                        <th>Date Added</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= $row['age'] ?></td>
                            <td><?= $row['gender'] ?></td>
                            <td><?= $row['mobile_no'] ?></td>
                            <td><?= htmlspecialchars($row['prescription']) ?></td>
                            <td><?= $row['created_at'] ?></td> <!-- Display Date and Time -->
                            <td>
                                <a href="doctor_dashboard.php?delete_patient_id=<?= $row['id'] ?>" class="btn" onclick="return confirm('Are you sure you want to delete this patient?')">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-data">No patients found.</p>
        <?php endif; ?>

        <footer>
            <p>&copy; 2024 Clinic Management System | Doctor Dashboard</p>
        </footer>
    </div>
</body>
</html>
