<?php
session_start();
if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
    if ($_SESSION['role'] === 'admin') {
        header("Location: admin_dashboard.php");
    } elseif ($_SESSION['role'] === 'customer') {
        header("Location: customer_dashboard.php");
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to Cat Adoption System</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f0f0f0;
        }

        .container {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 10px;
            width: 60%;
            margin: 40px auto 20px auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #333;
        }

        p {
            font-size: 18px;
            color: #666;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin: 20px 10px 0;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        .btn:hover {
            background-color: #45a049;
        }

        /* Swiper styles */
        .swiper {
            width: 100%;
            height: 300px;
            margin-top: 20px;
        }

        .swiper-slide img {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 10px;
        }

        .mySwiper {
            height: 20%;
            box-sizing: border-box;
            padding: 10px 0;
        }

        .mySwiper .swiper-slide {
            width: 25%;
            height: 100%;
            opacity: 0.4;
        }

        .mySwiper .swiper-slide-thumb-active {
            opacity: 1;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Welcome to Cat Adoption System</h1>
    <p>Find your purr-fect feline friend today! Register or login to start exploring.</p>
    <a href="register.php" class="btn">Register</a>
    <a href="login.php" class="btn">Login</a>

    <!-- Swiper Slider Section -->
    <div style="--swiper-navigation-color: #4CAF50; --swiper-pagination-color: #4CAF50" class="swiper mySwiper2">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="image/ct1.jpg" alt="Cat 1"></div>
            <div class="swiper-slide"><img src="image/ct2.jpg" alt="Cat 2"></div>
            <div class="swiper-slide"><img src="image/ct3.jpg" alt="Cat 3"></div>
            <div class="swiper-slide"><img src="image/ct4.jpg" alt="Cat 4"></div>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>

    <div thumbsSlider="" class="swiper mySwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide"><img src="image/ct1.jpg" alt="Cat 1"></div>
            <div class="swiper-slide"><img src="image/ct2.jpg" alt="Cat 2"></div>
            <div class="swiper-slide"><img src="image/ct3.jpg" alt="Cat 3"></div>
            <div class="swiper-slide"><img src="image/ct4.jpg" alt="Cat 4"></div>
        </div>
    </div>
</div>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
    var swiperThumbs = new Swiper(".mySwiper", {
        loop: true,
        spaceBetween: 10,
        slidesPerView: 4,
        freeMode: true,
        watchSlidesProgress: true,
    });
    var swiperMain = new Swiper(".mySwiper2", {
        loop: true,
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: swiperThumbs,
        },
    });
</script>

</body>
</html>
