<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$role = $_POST['role'] ?? 'customer'; // fallback to 'customer'
$stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssss", $username, $email, $password, $role);


    if ($stmt->execute()) {
        header("Location: login.php");
        exit();
    } else {
        echo "Error saving user: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - Cat Adoption</title>
    <link rel="stylesheet" href="css/style.css">

    <style>
        /* Fallback styling */
        body {
            font-family: Arial, sans-serif;
            background: url('/image/cat.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        .form-container {
            width: 350px;
            margin: 120px auto;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.2);
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        input {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            border: none;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 10px;
        }

        button:hover {
            background-color: #388e3c;
        }

        p {
            margin-top: 15px;
            color: #555;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Create Your Account</h2>
    <form onsubmit="return validateRegister()" method="post">
        <input type="text" id="username" name="username" placeholder="Username" required><br>
        <input type="email" id="email" name="email" placeholder="Email" required><br>
        <input type="password" id="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a>.</p>
</div>

<script src="js/script.js"></script>
</body>
</html>
