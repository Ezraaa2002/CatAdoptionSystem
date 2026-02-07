<?php
session_start();
include 'db.php';

// Only allow customers to access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    header("Location: login.php");
    exit();
}

// Fetch cats from the database
$result = $conn->query("SELECT * FROM cats ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 50px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        h2 {
            color: #4CAF50;
            text-align: center;
        }

        .cat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .cat-card {
            background: #fafafa;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }

        .cat-card h3 {
            margin: 10px 0 5px;
        }

        .cat-card p {
            margin: 5px 0;
            font-size: 14px;
        }

        .logout {
            display: block;
            text-align: center;
            margin-top: 30px;
        }

        .logout a {
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 10px 25px;
            border-radius: 6px;
        }

        .logout a:hover {
            background-color: #388e3c;
        }

        .choose-btn {
            margin-top: 10px;
            background-color: #4CAF50;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }

        .choose-btn:hover {
            background-color: #388e3c;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Welcome, Customer! 🐾</h2>
    <p style="text-align: center;">Here are the cats available for adoption:</p>

    <div class="cat-grid">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="cat-card">
                <h3><?= htmlspecialchars($row['breed']) ?></h3>
                <p><strong>Age:</strong> <?= htmlspecialchars($row['age']) ?> years</p>
                <p><?= htmlspecialchars($row['description']) ?></p>

                <!-- Choose Button -->
                <form method="get" action="cat_thankyou.php">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <button type="submit" class="choose-btn">Choose</button>
                </form>
            </div>
        <?php endwhile; ?>
    </div>

    <div class="logout">
        <a href="logout.php">Logout</a>
    </div>
</div>

</body>
</html>
