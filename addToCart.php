<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item = [
        'id' => $_POST['itemId'],
        'name' => $_POST['itemName'],
        'price' => $_POST['itemPrice'],
        'quantity' => 1 
    ];

    
    $found = false;
    foreach ($_SESSION['cart'] as &$existingItem) {
        if ($existingItem['id'] === $item['id']) {
            $existingItem['quantity'] += 1; 
            $found = true;
            break;
        }
    }
    if (!$found) {
        $_SESSION['cart'][] = $item;
    }

    
    $_SESSION['message'] = "{$item['name']} added to cart.";

    
    header("Location: products.php");
    exit();
}
?>
