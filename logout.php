<?php
session_start();
session_destroy();
header("Location: login.php");
exit();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logout - Cat Adoption</title>
    <link rel="stylesheet" href="css/style.css">

    <style>
        /* Fallback styling if CSS file is missing */
        body {
            font-family: Arial, sans-serif;
            background: url('/image/cat.jpg') no-repeat center center fixed;
            background-size: cover;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .logout-container {
            margin-top: 120px;
            text-align: center;
            background-color: rgba(255, 255, 255, 0.95);
            width: 80%;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);
        }

        h2 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #388e3c;
        }
    </style>
</head>
<body>

<div class="logout-container">
    <h2>You have successfully logged out.</h2>
    <a href="index.html" class="btn">Back to Home</a>
</div>

</body>
</html>
