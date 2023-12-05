<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST['quantity'] as $itemIndex => $quantity) {
        if ($quantity == 0) {
            unset($_SESSION['cart'][$itemIndex]);
        } else {
            $_SESSION['cart'][$itemIndex]['quantity'] = $quantity;
        }
    }
    header('Location: cart.php');
    exit;
}

$totalPrice = array_sum(array_map(function ($item) {
    return $item['quantity'] * $item['price'];
}, $_SESSION['cart']));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - AIO</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f7f7f7; 
        color: #333; 
    }
    .container {
        background-color: #ffffff; 
        padding: 20px;
        border-radius: 8px;
        margin-top: 30px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    
    .cart-header {
    background: linear-gradient(to right, #6dd5fa, #ff758c); 
    color: white; 
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
}
   
    .cart-item {
        border-bottom: 2px solid #eceff1; 
        padding-bottom: 10px;
        margin-bottom: 10px;
        transition: all 0.3s ease-in-out; 
    }
    .cart-item:hover {
        background-color: #fafafa; 
        transform: translateY(-5px); 
        border-color: #ddd; 
    }

    h4, .price-per-unit, .item-total-price {
        color: #5c6bc0; 
    }
    .total-price {
        font-weight: bold;
        color: #2e7d32; 
    }

    
    .btn-custom {
        padding: 8px 20px;
        border-radius: 4px;
        border: none;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease; 
        margin-right: 10px;
        text-transform: uppercase; 
        letter-spacing: 0.05em; 
    }
    .checkout-btn {
        background-color: #66bb6a; 
        color: white;
    }
    .update-btn {
        background-color: #ffa726; 
        color: white;
    }
    .remove-btn {
        background-color: #ef5350; 
        color: white;
    }
    .btn-custom:hover {
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        transform: translateY(-2px); 
    }

    
    .item-quantity {
        border: 2px solid #bdbdbd; 
        border-radius: 4px;
        padding: 5px;
        text-align: center;
        width: auto; 
        transition: border 0.2s ease-in-out;
    }
    .item-quantity:focus {
        border-color: #42a5f5; 
    }

    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .cart-item {
        animation: fadeIn 0.5s ease-in-out;
    }
    </style>
</head>
<body>

<div class="container">
    <form action="cart.php" method="post">
        <div class="cart-header">
            <h2>Your Shopping Cart</h2>
        </div>

        <?php if (empty($_SESSION['cart'])): ?>
            <p>Your cart is empty.</p>
        <?php else: ?>
            <div class="cart-items">
                <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                    <div class="cart-item">
                        <h4><?= htmlspecialchars($item['name']); ?></h4>
                        <p>Unit Price: $<span class="price-per-unit"><?= number_format($item['price'], 2); ?></span></p>
                        <p>Quantity: <input type="number" name="quantity[<?= $index ?>]" class="item-quantity" value="<?= $item['quantity']; ?>" min="0"></p>
                        <p>Total: $<span class="item-total-price"><?= number_format($item['quantity'] * $item['price'], 2); ?></span></p>
                        <button type="button" class="btn btn-custom remove-btn" onclick="removeItem(this, <?= $index ?>)">Remove</button>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="total-price" id="subtotal">
                Subtotal: $<?= number_format($totalPrice, 2); ?>
            </div>

            <div class="checkout">
                <button type="submit" class="btn btn-custom checkout-btn">Update Cart</button>
                <a href="checkout.php" class="btn btn-custom checkout-btn">Proceed to Checkout</a>
            </div>
        <?php endif; ?>
    </form>
</div>

<script>
    document.querySelectorAll('.item-quantity').forEach(input => {
        input.addEventListener('change', (event) => {
            if (event.target.value < 0) {
                event.target.value = 0; 
            }
            const quantity = event.target.value;
            const pricePerUnit = event.target.closest('.cart-item').querySelector('.price-per-unit').textContent;
            const totalPriceElement = event.target.closest('.cart-item').querySelector('.item-total-price');
            totalPriceElement.textContent = (quantity * parseFloat(pricePerUnit)).toFixed(2);
            updateSubtotal();
        });
    });

    function removeItem(button, index) {
        const cartItem = button.closest('.cart-item');
        cartItem.style.animation = 'slideUpAndFadeOut 0.5s forwards';
        cartItem.addEventListener('animationend', function() {
            const form = button.closest('form');
            const input = form.querySelector('input[name="quantity[' + index + ']"]');
            input.value = 0;
            form.submit();
        });
    }

    function updateSubtotal() {
        const subtotal = Array.from(document.querySelectorAll('.item-total-price'))
                              .reduce((acc, item) => acc + parseFloat(item.textContent), 0);
        document.getElementById('subtotal').textContent = `Subtotal: $${subtotal.toFixed(2)}`;
    }

    const styleSheet = document.createElement('style');
    styleSheet.type = 'text/css';
    styleSheet.innerText = `
        @keyframes slideUpAndFadeOut {
            to { transform: translateY(-100%); opacity: 0; visibility: hidden; }
        }
    `;
    document.head.appendChild(styleSheet);

    document.addEventListener('DOMContentLoaded', updateSubtotal);
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
