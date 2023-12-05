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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Payments</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
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

        header {
            text-align: center;
            margin-bottom: 30px;
        }

        h1 {
            color: #007bff;
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
        #payments {
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }
        @media (max-width: 600px) {
            .container {
                padding: 10px;
            }

            .dashboard-links {
                flex-direction: column;
            }

            .dashboard-links a {
                margin-bottom: 10px;
            }
        }

    </style>
</head>
<body>
    <div class="container">
        <?php if ($user): ?>
            <header>
                <h1>Welcome, <?= isset($user['name']) ? $user['name'] : 'User' ?> - View Payments</h1>
            </header>

            <div class="dashboard-links">
                <a href="home.php">Welcome</a>
                <a href="editprofile.php">Edit Profile</a>
                <a href="orders.php">View Orders</a>
                <a href="payments.php">View Payments</a>
                <a href="wishlist.php">View Wishlist</a>
                <a href="#delivery">Delivery Status</a>
                <a href="signout.php">Log Out</a>
            </div>
            <section id="payments" class="section">
                <h2>View Payments</h2>
                <?php
                $paymentsCollection = $db->payments;
                $payments = $paymentsCollection->find(
                    ['user_email' => $userEmail],
                    ['sort' => ['date' => -1]]
                );

                $paymentData = iterator_to_array($payments);

                if (!empty($paymentData)):
                ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Transaction ID</th>
                                <th>Date</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($paymentData as $payment): ?>
                                <tr>
                                    <td><?= $payment['transaction_id'] ?></td>
                                    <td><?= $payment['date']->toDateTime()->format('Y-m-d H:i:s') ?></td>
                                    <td><?= $payment['amount'] ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                <?php else: ?>
                    <p>No payment transactions found.</p>
                <?php endif; ?>
            </section>

        <?php else: ?>
            <p class="error-message">Error: User not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
