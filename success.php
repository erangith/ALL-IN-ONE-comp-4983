<?php
session_start();

require 'vendor/autoload.php';

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$db = $mongoClient->AIO;

if (!isset($_SESSION['form_submitted']) || $_SESSION['form_submitted'] !== true) {
    header('Location: checkout.php');
    exit();
}

$estimatedDeliveryTime = isset($_SESSION['estimatedDeliveryTime']) ? $_SESSION['estimatedDeliveryTime'] : "Not available";
$orderDetails = isset($_SESSION['orderDetails']) ? $_SESSION['orderDetails'] : $_SESSION['cart'];

function getRandomDriver($db) {
    $deliveryDriversCollection = $db->delivery_driver;
    $drivers = $deliveryDriversCollection->find()->toArray();
    if (empty($drivers)) {
        return null;
    }
    $randomDriver = $drivers[array_rand($drivers)];
    return $randomDriver;
}

$randomDriver = getRandomDriver($db);
unset($_SESSION['form_submitted'], $_SESSION['estimatedDeliveryTime']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success - ALL IN ONE</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <style>
        body, html {
        font-family: 'Poppins', sans-serif;
        background: #f7fafc;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0;
        color: #424242;
    }
    .jumbotron {
        background: #ffffff;
        border-radius: 8px;
        padding: 2rem;
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
        animation: fadeIn 2s ease-in-out;
        width: 50%; 
        margin: auto;
    }
    .jumbotron h1 {
        color: #32c787; 
        font-size: 2.5rem;
    }
    .jumbotron p {
        font-size: 1.2rem;
    }
    .jumbotron hr {
        border-top: 2px solid #eee;
        margin: 1.5rem 0;
    }
    .info-section {
        display: flex;
        align-items: center;
        font-size: 1rem;
    }
    .info-section i {
        color: #32c787;
        margin-right: 0.5rem;
        width: 24px;
        text-align: center;
    }
    .info-section span {
        display: block;
    }
    .btn-primary {
        background-color: #32c787;
        border-color: #32c787;
        box-shadow: none;
    }
    .btn-primary:hover {
        background-color: #29a66a;
        border-color: #29a66a;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    #left-curtain, #right-curtain {
        position: fixed;
        width: 50vw;
        height: 100vh; 
        top: 0;
        background: #1a1a2e;
        z-index: 5;
    }
    #left-curtain { left: 0; }
    #right-curtain { right: 0; }
    
    @keyframes slideLeft {
        to { transform: translateX(-100vw); } 
    }
    @keyframes slideRight {
        to { transform: translateX(100vw); } 
    }
    #left-curtain {
        animation: slideLeft 1s ease-out forwards;
        animation-delay: 1s; 
    }
    #right-curtain {
        animation: slideRight 1s ease-out forwards;
        animation-delay: 1s; 
    }
    ul {
        list-style-type: none;
        padding: 0;
    }
    ul li {
        padding: 0.25rem 0;
        font-weight: 500;
    }
    ul li:before {
        content: '✔';
        color: #21bf73;
        font-weight: bold;
        display: inline-block;
        width: 1.5em;
        margin-left: -1.5em;
    }
    
    </style>
</head>
<body>
    <div id="left-curtain"></div>
    <div id="right-curtain"></div>

    <div class="jumbotron">
        <h1>Thank You!</h1>
        <p class="lead">Your payment and delivery details have been successfully recorded.</p>
        <hr>
        <?php if (!empty($orderDetails)): ?>
            <ul>
                <?php foreach ($orderDetails as $item): ?>
                    <li><?php echo htmlspecialchars($item['name']) . " - Quantity: " . $item['quantity']; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No order details available</p>
        <?php endif; ?>
        <p>Estimated Delivery Time: <?php echo htmlspecialchars($estimatedDeliveryTime); ?></p>
        <p>
        <?php if ($randomDriver): ?>
            <div class="info-section"><i class="fas fa-user"></i><span>Delivery Driver: <?php echo htmlspecialchars($randomDriver->name); ?></span></div>
            <div class="info-section"><i class="fas fa-id-badge"></i><span>Delivery Driver ID: <?php echo htmlspecialchars($randomDriver->driver_id); ?></span></div>
            <div class="info-section"><i class="fas fa-truck"></i><span>Delivery Vehicle: <?php echo htmlspecialchars($randomDriver->vechicle); ?></span></div>
            <div class="info-section"><i class="fas fa-phone-alt"></i><span>Driver Contact: <?php echo htmlspecialchars($randomDriver->contact_number); ?></span></div>
        <?php else: ?>
            <p>Delivery Driver information is not available.</p>
        <?php endif; ?>
        <P></P>
        <p></P>
        <p >Your order is being processed and will be on its way shortly.</p>
        <a class="btn btn-primary btn-lg" href="home.php" role="button">Go to Homepage</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
