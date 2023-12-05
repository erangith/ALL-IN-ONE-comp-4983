<?php 
session_start(); 
include 'navbar.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALL IN One</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body, html {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            height: 100%;
        }
        input[type="text"] {
        padding: 10px;
        margin: 10px 0;
        border-radius: 5px;
        border: 1px solid #ddd;
    }
    button {
        padding: 10px 20px;
        border-radius: 5px;
        background-color: #4CAF50;
        color: white;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s, transform 0.3s; 
    }

    button:hover {
        background-color: #45a049;
        transform: translateY(-5px); 
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
    }

        #videoBackground {
            position: fixed;
            top: 0;
            left: 0;
            min-width: 100%;
            min-height: 100%;
            z-index: -1;
            object-fit: cover;
        }

        .header-banner {
            text-align: center;
            padding: 20% 5%;
        }

        .header-banner h1 {
            font-weight: 700;
            font-size: 4rem;
            margin-bottom: 1rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
        }

        .header-banner p {
            font-weight: 600;
            margin-bottom: 2rem;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        .btn-primary {
            background-color: #ffffff;
            border: none;
            color: #2E8B57;
            padding: 10px 30px;
            font-weight: 700;
            letter-spacing: 1px;
            transition: all 0.3s;
            border-radius: 25px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover {
            background-color: #2E8B57;
            color: #ffffff;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); 
        }

        .product-section {
            padding: 50px 0;
            position: relative;
        }

        .product-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border-radius: 15px;
            overflow: hidden;
            cursor: pointer;
            box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.1);
        }

        .product-card:hover {
            transform: scale(1.05);
            box-shadow: 0px 8px 30px rgba(0, 0, 0, 0.2);
        }
        .glow {
            color: #333; 
            text-align: center;
            animation: glow 2s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 8px #fff, 0 0 12px #fff;
            }
            to {
                text-shadow: 0 0 10px #d9d9d9, 0 0 20px #d9d9d9;
            }
        }
        .product-image {
            transition: transform 0.3s;
            height: 100%;
            width: 100%;
            object-fit: cover;
        }

        .product-card:hover .product-image {
            transform: scale(1.1);
        }

        .product-card p {
            text-align: center;
            margin: 10px 0;
            font-weight: 600;
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background-color: rgba(255, 255, 255, 0.8);
            padding: 5px 15px;
            border-radius: 25px;
        }
    </style>

    <script>
        function exploreCategory(category) {
            window.location.href = 'products.php?category=' + category;
        }
    </script>
</head>
<body>




<div class="overlay"></div>

<video autoplay muted loop id="videoBackground">
    <source src="intro.mp4" type="video/mp4">
</video>

<div class="header-banner">
    <h1 class="glow">Welcome to AIO</h1>
    <p class="glow">Discover premium products tailored for you.</p>
    <a href="products.php" class="btn btn-primary">Explore Now</a>
</div>

<div class="container product-section" id="products">
    <div class="row">
        <!-- Groceries -->
        <div class="col-lg-12 product-card mb-4" onclick="window.location.href='groceries.php'">
            <img src="grocery2.jpeg" class="product-image" alt="Placeholder for Groceries">
            <p>All Groceries</p>
        </div>

        <!-- Fashion -->
        <div class="col-lg-6 product-card mb-4" onclick="window.location.href='fashion.php'">
            <img src="fashion.jpg" class="product-image" alt="Placeholder for Fashion">
            <p>Fashion</p>
        </div>

        <!-- Cosmetics -->
        <div class="col-lg-6 product-card mb-4" onclick="window.location.href='cosmetics.php'">
            <img src="makeup.jpg" class="product-image" alt="Placeholder for Cosmetics">
            <p>Cosmetics</p>
        </div>

        <!-- Electronics -->
        <div class="col-lg-12 product-card" onclick="window.location.href='electronics.php'">
            <img src="electronic.jpg" class="product-image" alt="Placeholder for Electronics">
            <p>Electronics</p>
        </div>
    </div>
</div>

<?php 
include 'footer.php';
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>