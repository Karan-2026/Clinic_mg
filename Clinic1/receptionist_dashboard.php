<?php
session_start();


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'receptionist') {
    header("Location: login.php");
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'clinic_mgm', 3307);

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Token Assignment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['assign_token'])) {
    $patient_id = $_POST['patient_id'];
    $token = rand(1000, 9999); //

    // Prepare and execute the update query
    $stmt = $conn->prepare("UPDATE patients SET token = ? WHERE id = ?");
    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error); 
    }
    $stmt->bind_param("ii", $token, $patient_id);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Token assigned successfully!');</script>";
}

// Handle Create Charges
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_charge'])) {
    $patient_id = $_POST['patient_id'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];

    // Insert charge into the charges table
    $stmt = $conn->prepare("INSERT INTO charges (patient_id, amount, description) VALUES (?, ?, ?)");
    if ($stmt === false) {
        die('MySQL prepare error: ' . $conn->error); 
    }
    $stmt->bind_param("ids", $patient_id, $amount, $description);
    $stmt->execute();
    $stmt->close();

    echo "<script>alert('Charge created successfully!');</script>";
}

// Fetch all patients for selection
$sql = "SELECT * FROM patients";
$patients_result = $conn->query($sql);

// Fetch all charges for patients
$charges_sql = "SELECT charges.*, patients.name AS patient_name FROM charges INNER JOIN patients ON charges.patient_id = patients.id";
$charges_result = $conn->query($charges_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receptionist Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            color: #333;
        }

        header {
            background-color: #4CAF50;
            color: white;
            text-align: center;
            padding: 20px;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin: 0;
        }

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

        .btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #45a049;
        }

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
        <h1>Receptionist Dashboard</h1> 
        <br><a href="logout.php" class="btn">Logout</a>
    </header>

    <div class="container">
        <h2>Assign Token to Patient</h2>

        <!-- Assign Token Form -->
        <div class="form-container">
            <form method="POST">
                <select name="patient_id" required>
                    <option value="">Select Patient</option>
                    <?php while ($row = $patients_result->fetch_assoc()): ?>
                        <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?> (<?= $row['mobile_no'] ?>) - Token: <?= $row['token'] ? $row['token'] : 'N/A' ?></option>
                    <?php endwhile; ?>
                </select>
                <button type="submit" name="assign_token" class="btn">Assign Token</button>
            </form>
        </div>

        <h2>Create Charges</h2>

        <!-- Create Charge Form -->
        <div class="form-container">
            <form method="POST">
                <select name="patient_id" required>
                    <option value="">Select Patient</option>
                    <?php
                    // Reset the result pointer for another loop
                    $patients_result->data_seek(0);
                    while ($row = $patients_result->fetch_assoc()):
                    ?>
                        <option value="<?= $row['id'] ?>"><?= htmlspecialchars($row['name']) ?> (<?= $row['mobile_no'] ?>) - Token: <?= $row['token'] ? $row['token'] : 'N/A' ?></option>
                    <?php endwhile; ?>
                </select>
                <input type="number" name="amount" placeholder="Charge Amount" required>
                <textarea name="description" placeholder="Charge Description" rows="4" required></textarea>
                <button type="submit" name="create_charge" class="btn">Create Charge</button>
            </form>
        </div>

        <h2>Patients with Assigned Tokens</h2>

        <!-- Patient List with Token -->
        <div class="form-container">
            <table>
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Mobile No</th>
                        <th>Assigned Token</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Reset the result pointer for another loop
                    $patients_result->data_seek(0);
                    while ($row = $patients_result->fetch_assoc()):
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['mobile_no']) ?></td>
                            <td><?= $row['token'] ? $row['token'] : 'N/A' ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <h2>Patients with Charges</h2>

        <!-- Charges List -->
        <div class="form-container">
            <table>
                <thead>
                    <tr>
                        <th>Patient Name</th>
                        <th>Charge Amount</th>
                        <th>Charge Description</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Reset the result pointer for charges
                    $charges_result->data_seek(0);
                    while ($row = $charges_result->fetch_assoc()):
                    ?>
                        <tr>
                            <td><?= htmlspecialchars($row['patient_name']) ?></td>
                            <td><?= htmlspecialchars($row['amount']) ?></td>
                            <td><?= htmlspecialchars($row['description']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <footer>
            <p>&copy; 2024 Clinic Management System | Receptionist Dashboard</p>
        </footer>
    </div>
</body>
</html>
