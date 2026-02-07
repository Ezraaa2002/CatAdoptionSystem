<?php
session_start();
include 'db.php';

// Only allow logged-in customers
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    header("Location: login.php");
    exit();
}

// Check if cat ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "Invalid cat selection.";
    exit();
}

$cat_id = intval($_GET['id']);
$stmt = $conn->prepare("SELECT * FROM cats WHERE id = ?");
$stmt->bind_param("i", $cat_id);
$stmt->execute();
$result = $stmt->get_result();
$cat = $result->fetch_assoc();

if (!$cat) {
    echo "Cat not found.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thank You for Choosing</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 40px;
            text-align: center;
        }

        .thankyou-container {
            max-width: 600px;
            margin: auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0,0,0,0.1);
        }

        h2 {
            color: #4CAF50;
            margin-bottom: 20px;
        }

        p {
            font-size: 16px;
            color: #555;
        }

        .button-group {
            margin-top: 30px;
        }

        .button-group a {
            display: inline-block;
            margin: 10px;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            text-decoration: none;
        }

        .button-group a.logout {
            background-color: #d9534f;
        }

        .button-group a:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>

<div class="thankyou-container">
    <h2>Thank You for Choosing <?= htmlspecialchars($cat['breed']) ?>!</h2>
    <p><strong>Age:</strong> <?= htmlspecialchars($cat['age']) ?> years</p>
    <p><?= htmlspecialchars($cat['description']) ?></p>

    <div class="button-group">
        <a href="customer_dashboard.php">← Back to Dashboard</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>
</div>

</body>
</html>
