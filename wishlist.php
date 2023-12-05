<?php
require 'vendor/autoload.php'; 

$client = new MongoDB\Client("mongodb://localhost:27017"); 
$collection = $client->AIO->groceries_items;
$wishlistItems = $collection->find();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Your Wishlist</title>
</head>
<body>

<h1>Your Wishlist</h1>

<div id="wishlist-container">
    <?php foreach ($wishlistItems as $item): ?>
        <div class="wishlist-item">
            <h2><?= htmlspecialchars($item['name']) ?></h2>
            <p>Price: <?= isset($item['price']) ? htmlspecialchars($item['price']) : 'Price not available' ?></p>
            <p>Description: <?= htmlspecialchars($item['description'] ?? 'No description available') ?></p>
            <p>Store: <?= htmlspecialchars($item['store'] ?? 'Store unknown') ?></p>
            <form method="post" action="remove_from_wishlist.php"> 
                <input type="hidden" name="item_id" value="<?= htmlspecialchars((string)$item['_id']) ?>" />
                <input type="submit" value="Remove from Wishlist" />
            </form>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
