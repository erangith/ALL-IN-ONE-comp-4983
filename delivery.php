<?php
session_start();

require 'vendor/autoload.php';

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$db = $mongoClient->AIO;

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

$userEmail = $_SESSION['email'];
$userCollection = $db->users;
$user = $userCollection->findOne(['email' => $userEmail]);

$deliveryCollection = $db->deliveries;
$deliveries = $deliveryCollection->find(['user_email' => $userEmail]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delivery Status</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .dashboard-links {
            display: flex;
            justify-content: space-around;
            margin-bottom: 20px;
        }

        .dashboard-links a {
            text-decoration: none;
            color: #007bff;
            font-weight: bold;
            border: 2px solid #007bff;
            padding: 10px 15px;
            border-radius: 8px;
            transition: background-color 0.3s, color 0.3s;
        }

        .dashboard-links a:hover {
            background-color: #007bff;
            color: #fff;
        }

        .profile-edit {
            margin-top: 20px;
        }

        form {
            display: grid;
            grid-template-columns: 1fr;
            grid-gap: 15px;
        }

        label {
            font-weight: bold;
        }

        input {
            padding: 12px;
            border: 2px solid #ccc;
            border-radius: 8px;
            width: 100%;
        }

        button {
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        .section {
            margin-top: 30px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        header {
            text-align: center;
            margin-bottom: 30px;
        }

        h1 {
            color: #007bff;
        }

        .success-message,
        .error-message {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .success-message {
            background-color: #4caf50;
            color: #fff;
        }

        .error-message {
            background-color: #ff5252;
            color: #fff;
        }

    </style>
</head>
<body>
    <div class="container">
        <?php if ($user): ?>
            <header>
                <h1>Welcome, <?= isset($user['name']) ? $user['name'] : 'User' ?> Dashboard</h1>
            </header>

            <div class="dashboard-links">
                <a href="home.php">Welcome</a>
                <a href="editprofile.php">Edit Profile</a>
                <a href="orders.php">View Orders</a>
                <a href="payments.php">View Payments</a>
                <a href="wishlist.php">View Wishlist</a>
                <a href="delivery.php">Delivery Status</a>
                <a href="signout.php">Log Out</a>
            </div>
            <section id="delivery" class="section">
                <h2>Delivery Status</h2>
                <?php if (iterator_count($deliveries) > 0): ?>

                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>Delivery Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($deliveries as $delivery): ?>
                                <tr>
                                    <td><?= $delivery['order_id'] ?></td>
                                    <td><?= $delivery['status'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No deliveries found.</p>
                <?php endif; ?>
            </section>

        <?php else: ?>
            <p class="error-message">Error: User not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
