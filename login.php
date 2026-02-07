<?php
session_start();
include 'db.php';

$login_error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Add role to SELECT statement
    $stmt = $conn->prepare("SELECT id, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password, $role);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $user_id;
            $_SESSION['role'] = $role;

            if ($role === 'admin') {
                header("Location: admin_dashboard.php");
            } else {
                header("Location: customer_dashboard.php");
            }
            exit();
        } else {
            $login_error = "Invalid password.";
        }
    } else {
        $login_error = "Email not found.";
    }

    $stmt->close();
}
?>


<!-- HTML START -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - Cat Adoption</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: url('/image/cat.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
        }

        .form-container {
            width: 400px;
            margin: 100px auto;
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

        .error {
            color: red;
            font-weight: bold;
            margin-bottom: 10px;
        }

        input {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border-radius: 6px;
            border: 1px solid #ccc;
        }

        button {
            width: 95%;
            padding: 10px;
            margin-top: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover {
            background-color: #388e3c;
        }

        p {
            margin-top: 15px;
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
    <h2>Login to Your Account</h2>

    <?php if (!empty($login_error)): ?>
        <div class="error"><?= htmlspecialchars($login_error) ?></div>
    <?php endif; ?>

    <form method="post">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>

    <p>New user? <a href="register.php">Register here</a>.</p>
</div>

</body>
</html>
