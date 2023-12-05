<?php
session_start();

require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://localhost:27017");
$database = $client->AIO;
$paymentsCollection = $database->payments;
$deliveriesCollection = $database->deliveries;

$storeAddress = "15 University Ave, Wolfville, NS B4P 2R6";

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit();
}


function calculateEstimatedDeliveryTime($customerAddress, $storeAddress) {
    $addressDistanceMap = [
        "16 University Ave, Wolfville, NS B4P 2R6" => 5, 
        "17 University Ave, Wolfville, NS B4P 2R6" => 6, 
        "18 University Ave, Wolfville, NS B4P 2R6" => 7, 
        "19 University Ave, Wolfville, NS B4P 2R6" => 8, 
        "20 University Ave, Wolfville, NS B4P 2R6" => 8, 
        "10 University Ave, Wolfville, NS B4P 2R6" => 9, 
    ];

    $distance = $addressDistanceMap[$customerAddress] ?? 11; 

    if ($distance <= 5) {
        return "15 minutes";
    } elseif ($distance > 5 && $distance <= 10) {
        return "30 minutes";
    } else {
        return "1 hour";
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $paymentData = [
        'card_number' => $_POST['cardNumber'],
        'name_on_card' => $_POST['nameOnCard'],
        'expiry_date' => $_POST['expiryDate'],
        'security_code' => $_POST['securityCode'],
    ];

    $deliveryData = [
        'customer_name' => $_POST['customerName'],
        'customer_address' => $_POST['customerAddress'],
        'customer_email' => $_POST['customerEmail'],
        'customer_phone' => $_POST['customerPhone'],
        'estimated_delivery_time' => calculateEstimatedDeliveryTime($_POST['customerAddress'], $storeAddress),
    ];

    $paymentResult = $paymentsCollection->insertOne($paymentData);

    $deliveryResult = $deliveriesCollection->insertOne($deliveryData);

    $_SESSION['form_submitted'] = true;

    header('Location: success.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - ALL IN ONE</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, #6dd5ed, #2193b0); 
        }
        .container {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: fadeInAnimation ease 3s; 
            animation-iteration-count: 1;
            animation-fill-mode: forwards;
        }
        @keyframes fadeInAnimation {
            0% {opacity: 0;}
            100% {opacity: 1;}
        }
        .card {
            width: 100%;
            max-width: 600px;
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.15); 
            overflow: hidden;
            padding: 2rem;
        }
        h2, h3 {
            color: #333;
            text-align: center;
            margin-bottom: 2rem;
        }
        .form-section {
            background: #f8f9fa;
            margin-bottom: 1rem;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.06);
        }
        .btn-custom {
            background-color: #5cb85c;
            border: none;
            border-radius: 4px;
            padding: 10px 30px;
            color: white;
            font-size: 1.2rem;
            letter-spacing: 1.1px;
            box-shadow: 0 4px 6px rgba(92,184,92,0.4);
            transition: all 0.2s ease-in-out;
            display: block;
            width: 100%;
            text-align: center;
            background-image: linear-gradient(to right, #56ab2f, #a8e063); 
        }
        .btn-custom:hover {
            background-image: linear-gradient(to right, #4cae4c, #a2e076); 
            box-shadow: 0 6px 10px rgba(76,174,76,0.4);
            transform: translateY(-2px);
        }
    
        .form-control {
            border-radius: 4px;
            border: 1px solid #ced4da;
            padding: 0.75rem 1.25rem;
            margin-bottom: 1rem;
            box-shadow: none;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        .form-control:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(128,189,255,.25);
        }
        .card-input-icon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: #ced4da;
        }
        .card-detail-input {
            position: relative;
        }
        .payment-image, .customer-service-image {
            width: 100%;
    max-width: 300px; 
    margin: 0 auto 20px;
    display: block;
    border-radius: 50%; 
    animation: slideIn 1.5s ease-out;
    animation-delay: 0.5s; 
    animation-fill-mode: forwards;
    }
    .payment-image, .customer-service-image, h3.animated-entry {
        animation-delay: 0.5s; 
    }

   
    h3.animated-entry {
        animation: slideIn 1.5s ease-out;
        animation-fill-mode: forwards; 
    }
        .animated-entry {
        animation: slideIn 1.5s ease-out;
    }

    @keyframes slideIn {
        0% {
            transform: translateY(-30px);
            opacity: 0;
            visibility: hidden;
        }
        1% {
            visibility: visible;
        }
        100% {
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
        }
    }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <h2>Checkout</h2>
        <form action="checkout.php" method="post">
            <div class="form-section">
                 <img src="https://th.bing.com/th/id/R.16dbc44d8d44fd6157f722a9674e7b07?rik=x6oCstpxCFwvng&pid=ImgRaw&r=0" alt="Payment Details" class="payment-image">
                <div class="card-detail-input mb-3">
                    <input type="text" name="cardNumber" class="form-control" placeholder="Card number" required>
                    <i class="far fa-credit-card card-input-icon"></i>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <input type="text" name="nameOnCard" class="form-control" placeholder="Name on card" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="text" name="expiryDate" class="form-control" placeholder="Expiry date" required>
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="text" name="securityCode" class="form-control" placeholder="Security code" required>
                    </div>
                </div>
            </div>

           

            <div class="form-section">
                 <img src="data:image/jpeg;base64,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" alt="Customer Service" class="customer-service-image">
                <input type="text" name="customerName" class="form-control" placeholder="Your Full Name" required>
                <input type="text" name="customerAddress" class="form-control" placeholder="Delivery Address" required>
                <input type="email" name="customerEmail" class="form-control" placeholder="Email Address">
                <input type="tel" name="customerPhone" class="form-control" placeholder="Phone Number">
            </div>

            <button type="submit" class="btn btn-custom">Confirm and Pay</button>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
   
    document.addEventListener('DOMContentLoaded', (event) => {
        setTimeout(() => {
            document.querySelectorAll('.animated-entry').forEach((el) => {
                el.style.visibility = 'visible';
            });
        }, 10);
    });
</script>

</body>
</html>