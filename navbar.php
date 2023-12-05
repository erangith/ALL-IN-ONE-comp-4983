<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AIO</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
        body {
            background-color: #f4f4f8;
        }

        .navbar {
            font-family: 'Open Sans', sans-serif;
            padding: 10px 30px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            background: #2ecc71;
        }
        .navbar-search {
            display: flex;
            justify-content: center;
            flex-grow: 1;
            margin: 0 15px;
        }
        .navbar-search input[type="text"] {
            flex-grow: 1; 
            padding: 10px 20px; 
            font-size: 1em; 
            border: none;
            border-top-left-radius: 30px; 
            border-bottom-left-radius: 30px; 
            margin-right: -1px; 
        }

        .navbar-search button {
            padding: 10px 20px;
            font-size: 1em;
            border: none;
            background-color: #27ae60;
            color: white;
            border-top-right-radius: 30px;
            border-bottom-right-radius: 30px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: all 0.2s;
            cursor: pointer;
        }

        .navbar-search button:hover {
            background-color: #2ecc71;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .navbar-search button:active {
            background-color: #27ae60;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transform: translateY(1px);
        }

        @media (max-width: 768px) {
            .navbar-search input[type="text"] {
                margin-bottom: 10px; 
            }
        }

        .navbar-brand, .navbar-nav .nav-link {
            color: #fff;
        }

        .navbar-brand {
            font-size: 1.6em;
            font-weight: bold;
        }
        

        .navbar-nav .nav-link {
            margin-left: 15px;
        }

        .navbar-toggler {
            border: none;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255,255,255,0.5)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-menu a {
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            color: black;
        }

        .dropdown-menu a:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #2ecc71;">
        <a class="navbar-brand" href="home.php">
            <img src="logo.png" alt="Logo" id="brand-logo" style="height: 50px;"> All In One
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        ALL Categories
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="home.php">Home</a>
                        <a class="dropdown-item" href="about.php">About us</a>
                        <a class="dropdown-item" href="products.php">Products</a>
                        <a class="dropdown-item" href="suppliers.php">Our Suppliers</a>
                        <a class="dropdown-item" href="discounts.php">Discounts</a>
                        <a class="dropdown-item" href="recipe.php">Recipes</a>
                        <a class="dropdown-item" href="fashion-ideas.php">Fashion Trends</a>
                        <a class="dropdown-item" href="fashion-style.php">Fashion Styles</a>
                        <a class="dropdown-item" href="contact.php">Help</a>
                    </div>
                </li>
            </ul>
            <form class="navbar-search" action="searchResults.php" method="get">
                <input type="text" name="searchQuery" placeholder="Search items..." required>
                <button type="submit" class="btn btn-outline-success">Search</button>
            </form>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="wishlist.php"><i class="fas fa-heart"></i> Wishlist</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                        <?php if (isset($_SESSION['email'])): ?>
                            Welcome, <?= htmlspecialchars($_SESSION['name']) ?>
                        <?php else: ?>
                            Welcome, Guest
                        <?php endif; ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <?php if (!isset($_SESSION['email'])): ?>
                            <a class="dropdown-item" href="login.php">Sign In</a>
                            <a class="dropdown-item" href="login.php">Sign Up</a>
                        <?php else: ?>
                            <a class="dropdown-item" href="myaccount.php">My Profile</a>
                            <a class="dropdown-item" href="signout.php">Sign Out</a>
                        <?php endif; ?>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php"><i class="fas fa-shopping-cart"></i> Cart</a>
                </li>
            </ul>
        </div>
    </nav>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
