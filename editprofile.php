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

$updateSuccess = $updateError = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newName = $_POST['name'];
    $newEmail = $_POST['email'];
    $updateResult = $userCollection->updateOne(
        ['email' => $userEmail],
        ['$set' => ['name' => $newName, 'email' => $newEmail]]
    );

    if ($updateResult->getModifiedCount() > 0) {
        $user = $userCollection->findOne(['email' => $newEmail]);
        $updateSuccess = "Profile updated successfully!";
    } else {
        $updateError = "Error updating profile.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            color: #007bff;
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

        .back-link a {
            text-decoration: none;
            color: #007bff;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        .error-message,
        .success-message {
            padding: 15px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .error-message {
            background-color: #ff5252;
            color: #fff;
        }

        .success-message {
            background-color: #4caf50;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Profile</h2>
        <?php if ($updateError): ?>
            <div class="error-message"><?= $updateError ?></div>
        <?php elseif ($updateSuccess): ?>
            <div class="success-message"><?= $updateSuccess ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?= isset($user['name']) ? $user['name'] : '' ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?= $userEmail ?>" required readonly>

            <button type="submit">Save Changes</button>
        </form>
        <p class="back-link"><a href="myaccount.php">Back to My Account</a></p>
    </div>
</body>
</html>
