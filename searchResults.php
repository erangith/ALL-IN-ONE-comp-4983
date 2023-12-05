<?php
session_start();
require 'vendor/autoload.php';
include 'navbar.php';

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$db = $mongoClient->AIO;

$searchQuery = $_GET['searchQuery'] ?? '';

$queryOptions = [
    '$regex' => $searchQuery,
    '$options' => 'i', 
];

$electronicsItemsArray = iterator_to_array($db->electronics_items->find(['name' => $queryOptions]));
$fashionItemsArray = iterator_to_array($db->fashion_items->find(['name' => $queryOptions]));
$cosmeticsItemsArray = iterator_to_array($db->cosmetics_items->find(['name' => $queryOptions]));
$groceriesItemsArray = iterator_to_array($db->groceries_items->find(['name' => $queryOptions]));

function displayItems($itemsArray, $categoryName)
{
    usort($itemsArray, function ($a, $b) {
        return $a['current_price'] <=> $b['current_price'];
    });

    $cheapestItem = reset($itemsArray);

    echo "<div class='category-section'>";
    echo "<h2 class='category-title'>" . $categoryName . "</h2>";
    echo "<div class='item-container'>";

    foreach ($itemsArray as $item) {
        $isCheapest = $item['_id'] == $cheapestItem['_id'] ? "cheapest-item" : "";

        echo "<div class='item-card $isCheapest'>";
        echo "<h3>" . htmlspecialchars($item['name']) . "</h3>";
        echo "<p>Price: $" . number_format($item['current_price'], 2) . "</p>";
        echo "<p>Description: " . htmlspecialchars($item['description']) . "</p>";
        echo "<p>Store: " . htmlspecialchars($item['Store']) . "</p>";

        $imagePath = isset($item['image_url']) ? $item['image_url'] : 'images/placeholder.png';
        echo "<img src=\"" . htmlspecialchars($imagePath) . "\" alt=\"" . htmlspecialchars($item['name']) . "\" class='item-image'/>";

        echo "<form action='addToCart.php' method='post'>";
        echo "<input type='hidden' name='itemId' value='" . htmlspecialchars($item['_id']) . "' />";
        echo "<input type='hidden' name='itemName' value='" . htmlspecialchars($item['name']) . "' />";
        echo "<input type='hidden' name='itemPrice' value='" . htmlspecialchars($item['current_price']) . "' />";
        echo "<input type='hidden' name='itemStore' value='" . htmlspecialchars($item['Store']) . "' />";

        echo "<button type='submit' class='btn btn-success'>Add to Cart</button>";
        echo "</form>";

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
    <title>All in One - Search Results</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #e8eff7;
            padding-top: 56px;
            font-family: 'Open Sans', sans-serif;
        }

        .navbar {
            padding: 10px 30px;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
            background: #34b7a7;
        }

        .category-section {
            margin-top: 20px;
            animation: fadeIn 1s;
        }

        .category-title {
            font-size: 24px;
            color: #333;
            margin-bottom: 10px;
            border-bottom: 2px solid #34b7a7;
            padding-bottom: 5px;
        }

        .item-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .item-card {
            background-color: #fff;
            box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
            width: calc(33.333% - 20px);
            transition: transform 0.3s ease-in-out;
            overflow: hidden;
        }

        .item-card:hover {
            transform: translateY(-5px);
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        .item-image {
            width: 100%;
            max-height: 200px;
            object-fit: contain;
            border-radius: 6px;
            margin-bottom: 15px;
            background-color: #fff;
        }

        .btn-success {
            background-color: #34b7a7;
            border-color: #34b7a7;
        }

        .btn-success:hover {
            background-color: #2da192;
            border-color: #2da192;
        }

        .cheapest-item {
            border: 2px solid #ffa07a;
            animation: pulseGreen 2s infinite;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes pulseGreen {
            0% {
                box-shadow: 0 0 0 0 rgba(255, 160, 122, 0.7);
            }
            70% {
                box-shadow: 0 0 0 10px rgba(255, 160, 122, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(255, 160, 122, 0);
            }
        }
    </style>
</head>
<body>

<div class="container mt-4">
        <h1>Search Results for '<?= htmlspecialchars($searchQuery) ?>'</h1>

        <?php
        if (!empty($electronicsItemsArray)) {
            displayItems($electronicsItemsArray, 'Electronics');
        }

        if (!empty($fashionItemsArray)) {
            displayItems($fashionItemsArray, 'Fashion');
        }

        if (!empty($cosmeticsItemsArray)) {
            displayItems($cosmeticsItemsArray, 'Cosmetics');
        }

        if (!empty($groceriesItemsArray)) {
            displayItems($groceriesItemsArray, 'Groceries');
        }

        if (
            empty($electronicsItemsArray) &&
            empty($fashionItemsArray) &&
            empty($cosmeticsItemsArray) &&
            empty($groceriesItemsArray)
        ) {
            echo "<p>No results found for '$searchQuery'</p>";
        }

        include 'footer.php';
        ?>

    </div>
</body>

</html>
