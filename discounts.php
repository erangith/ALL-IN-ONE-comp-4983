<?php
session_start();
require 'vendor/autoload.php';

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$db = $mongoClient->AIO;

function getRandomDiscountedItems($db, $collectionName, $discountPercentage, $limit = 3) {
    $currentDate = date("Y-m-d");
    srand(hexdec(substr(md5($currentDate), 0, 8))); 

    $items = $db->$collectionName->find([]);
    $allItems = iterator_to_array($items);
    shuffle($allItems); 

    return array_slice($allItems, 0, $limit); 
}
function displayDiscountedItems($items, $discountPercentage) {
    $itemsCount = 0;

    echo "<div class='row'>"; 
    foreach ($items as $item) {
        if ($itemsCount > 0 && $itemsCount % 2 == 0) {
            echo "</div><div class='row'>";
        }
        
        $discountedPrice = $item['current_price'] - ($item['current_price'] * ($discountPercentage / 100));
        
        echo "<div class='col-md-6 item-card' data-aos='fade-up'>";
        echo "<img src='" . htmlspecialchars($item['image_url']) . "' alt='" . htmlspecialchars($item['name']) . "' class='item-image'>";
        echo "<h3>" . htmlspecialchars($item['name']) . "</h3>";
        echo "<p class='description'>" . htmlspecialchars($item['description']) . "</p>";
        echo "<p class='price'>";
        echo "<span class='discounted-price'>$" . htmlspecialchars(number_format($discountedPrice, 2)) . "</span> ";
        echo "<span class='original-price'>$" . htmlspecialchars(number_format($item['current_price'], 2)) . "</span>";
        echo "</p>";
        
        echo "<form action='addToCart.php' method='post'>";
        echo "<input type='hidden' name='itemId' value='" . htmlspecialchars($item['_id']) . "' />";
        echo "<input type='hidden' name='itemName' value='" . htmlspecialchars($item['name']) . "' />";
        echo "<input type='hidden' name='itemPrice' value='" . htmlspecialchars(number_format($discountedPrice, 2)) . "' />";
        echo "<button type='submit' class='btn btn-discount'>Add to Cart</button>";
        echo "</form>";
        echo "</div>";

        $itemsCount++; 
    }
    echo "</div>"; 
}

$discountPercentage = 10;

$discountedElectronics = getRandomDiscountedItems($db, 'electronics_items', $discountPercentage);
$discountedFashion = getRandomDiscountedItems($db, 'fashion_items', $discountPercentage);
$discountedCosmetics = getRandomDiscountedItems($db, 'cosmetics_items', $discountPercentage);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Discounts - ALL IN ONE </title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f8ff; 
        }
        .discount-header {
            text-align: center;
            padding: 30px;
            background-color: #007bff; 
            color: white;
        }
        .discount-container {
            padding: 20px 50px;
        }
        .item-card {
            margin-bottom: 30px;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.15);
            background-color: white;
            transition: all 0.3s ease;
        }
        .item-card img {
            width: 100%; 
            height: 200px; 
            object-fit: contain; 
            border-radius: 10px;
            margin-bottom: 20px;
            background: #fff;
        }
        .item-card:hover {
            transform: scale(1.03);
            box-shadow: 0 5px 12px rgba(0, 0, 0, 0.3);
        }
        .btn-discount {
            background-color: #28a745; 
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            cursor: pointer;
        }
        .btn-discount:hover {
            background-color: #218838;
        }
        .price {
            font-size: 1.3em;
            margin: 10px 0;
        }
        .discounted-price {
            color: #dc3545; 
            font-weight: bold;
        }
        .original-price {
            text-decoration: line-through;
            color: #6c757d; 
            margin-left: 10px;
            font-size: 0.9em;
        }
        @media (min-width: 768px) {
            .col-md-6 {
                flex: 0 0 50%;
                max-width: 50%;
            }
        }
    </style>
</head>
<body>

<div class="discount-header">
    <h1>Today's Special Discounts</h1>
    <p>Explore our exclusive daily deals and find your perfect match!</p>
</div>

<div class="container discount-container">
    <?php displayDiscountedItems($discountedElectronics, $discountPercentage); ?>
    <?php displayDiscountedItems($discountedFashion, $discountPercentage); ?>
    <?php displayDiscountedItems($discountedCosmetics, $discountPercentage); ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1200,
        once: true,
    });
</script>

</body>
</html>
