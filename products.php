<?php
session_start(); 

require 'vendor/autoload.php';
include 'navbar.php';

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$db = $mongoClient->AIO;

$electronicsItems = $db->electronics_items->find([]);
$fashionItems = $db->fashion_items->find([]);
$cosmeticsItems = $db->cosmetics_items->find([]);
$groceryItems = $db->groceries_items->find([]);

function displayItems($items, $categoryName) {
    echo "<div class='category-section'>";
    echo "<h2 class='category-title'>" . $categoryName . "</h2>";
    echo "<div class='item-container'>";
    foreach ($items as $item) {
        echo "<div class='item-card'>";
        echo "<div class='item-image-container'>";
        if (isset($item['image_url'])) {
            echo "<img src=\"" . htmlspecialchars($item['image_url']) . "\" alt=\"" . htmlspecialchars($item['name']) . "\" class='item-image'/>";
        }
        echo "</div>";
        echo "<div class='item-info'>";
        echo "<h3 class='item-name'>" . htmlspecialchars($item['name']) . "</h3>";
        echo "<p class='item-price'>Price: " . htmlspecialchars($item['current_price']) . "</p>";
        echo "<div class='item-description'>" . htmlspecialchars($item['description']) . "</div>";
        echo "<p class='item-store'>Store: " . htmlspecialchars($item['Store']) . "</p>";
        echo "<form action='addToCart.php' method='post' class='add-to-cart-form'>";
        echo "<input type='hidden' name='itemId' value='" . htmlspecialchars($item['_id']) . "' />";
        echo "<input type='hidden' name='itemName' value='" . htmlspecialchars($item['name']) . "' />";
        echo "<input type='hidden' name='itemPrice' value='" . htmlspecialchars($item['current_price']) . "' />";
        echo "<input type='hidden' name='itemStore' value='" . htmlspecialchars($item['Store']) . "' />";
        echo "<button type='submit' class='btn btn-primary'>Add to Cart</button>";
        echo "<i class='fas fa-heart wishlist-icon'></i>"; 
        echo "</form>";
        echo "</div>";
        echo "</div>"; 
    }
    echo "</div>"; 
    echo "</div>"; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fast N Fresh</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
        }
        .category-section {
            margin: 20px;
            padding: 15px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .category-title {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        .item-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
            gap: 20px;
        }
        .item-card {
            background-color: #ffffff;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 16px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .item-image-container {
            text-align: center;
            margin-bottom: 16px;
        }
        .item-image {
            max-width: 100%;
            max-height: 200px;
            object-fit: contain;
        }
        .item-info {
            display: flex;
            flex-direction: column;
        }
        .item-name {
            font-size: 1.1em;
            font-weight: bold;
            margin-bottom: 8px;
        }
        .item-price {
            font-weight: bold;
            margin-bottom: 8px;
        }
        .item-description {
            font-size: 0.9em;
            margin-bottom: 12px;
            color: #555;
            height: 4.5em; 
            overflow: hidden;
        }
        .add-to-cart-form {
            margin-top: 12px;
        }
        .btn-primary {
            background-color: #FF9900;
            border-color: #FF9900;
            color: white;
        }
        .btn-primary:hover {
            background-color: #C77600;
            border-color: #C77600;
        }
        .cart-icon {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
        .btn-wishlist {
            background-color: #ff4081;
            color: white;
            border: none;
            margin-left: 10px;
        }
        .btn-wishlist:hover {
            background-color: #e03568;
        }
        .btn-wishlist .fa-heart {
            margin-right: 5px;
        }
        .wishlist-icon {
            color: #ff4081;
            font-size: 24px;
            margin-left: 10px;
            cursor: pointer;
        }
        .wishlist-icon:hover {
            color: #e03568;
        }
    </style>
</head>
<body>

<div class="container mt-4">
    <div class="cart-icon">
        <a href="cart.php" class="btn btn-info">
            View Cart (<span id="cart-count"><?= count($_SESSION['cart'] ?? []) ?></span>)
        </a>
    </div>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success" role="alert">
            <?= $_SESSION['message']; ?>
            <?php unset($_SESSION['message']); ?>
        </div>
    <?php endif; ?>

    <?php
    displayItems($electronicsItems, 'Electronics');
    displayItems($fashionItems, 'Fashion');
    displayItems($cosmeticsItems, 'Cosmetics');
    displayItems($groceryItems, 'Groceries');
    include 'footer.php';
    ?>

</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
