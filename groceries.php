<?php
require 'vendor/autoload.php';
session_start(); 
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$db = $mongoClient->AIO;
$items = $db->groceries_items->find([]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AIO - Groceries</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .header {
            text-align: center;
            margin: 20px 0;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            padding: 20px;
            margin: auto;
        }

        .item-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            padding: 0;
            margin: 0 auto;
        }

        .item-card {
            position: relative;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
            background-color: #fafafa;
            overflow: hidden;
        }

        .item-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            overflow: hidden;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity .5s ease;
        }

        .item-card:hover .overlay {
            opacity: 1;
        }

        .overlay-buttons {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .item-info {
            height: 80px;
            overflow: hidden;
        }

        .btn-container {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
        }

        .btn-add-to-cart,
        .btn-primary,
        .btn-secondary {
            color: #fff;
            background-color: #5cb85c;
            border-color: #4cae4c;
            text-decoration: none;
            padding: 10px 20px;
            display: inline-block;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn-add-to-cart:hover,
        .btn-primary:hover,
        .btn-secondary:hover {
            background-color: #449d44;
            border-color: #398439;
        }

        .cart-icon {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
        }
        .modal-body p {
            margin-bottom: 0.5rem;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Groceries</h1>
</div>

<div class="cart-icon">
    <a href="cart.php" class="btn btn-info">
        View Cart (<span id="cart-count"><?= count($_SESSION['cart']) ?></span>)
    </a>
</div>

<div class="container">
    <div class="item-list">
        <?php foreach ($items as $item): ?>
            <div class="item-card">
                <img src="<?= htmlspecialchars($item['image_url']) ?>" class="item-image" alt="<?= htmlspecialchars($item['name']) ?>">
                <div class="overlay">
                    <div class="overlay-buttons">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#quickViewModal<?= htmlspecialchars($item['_id']) ?>">Quick View</button>
                    </div>
                </div>
                <div class="item-info">
                    <h3><?= htmlspecialchars($item['name']) ?></h3>
                    <p>Price: <?= htmlspecialchars($item['current_price']) ?></p>
                    <p><?= htmlspecialchars($item['description']) ?></p>
                    <p>Store: <?= htmlspecialchars($item['Store']) ?></p>
                </div>
                <div class="btn-container">
                    <form action="addToCart.php" method="post">
                        <input type="hidden" name="itemId" value="<?= htmlspecialchars($item['_id']) ?>">
                        <input type="hidden" name="itemName" value="<?= htmlspecialchars($item['name']) ?>">
                        <input type="hidden" name="itemPrice" value="<?= htmlspecialchars($item['current_price']) ?>">
                        <input type="hidden" name="itemStore" value="<?= htmlspecialchars($item['Store']) ?>">
                        <button type="submit" class="btn btn-success btn-add-to-cart">Add to Cart</button>
                    </form>
                </div>
            </div>
            <div class="modal fade" id="quickViewModal<?= htmlspecialchars($item['_id']) ?>" tabindex="-1" role="dialog" aria-labelledby="quickViewModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="quickViewModalLabel"><?= htmlspecialchars($item['name']) ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="<?= htmlspecialchars($item['image_url']) ?>" class="img-fluid" alt="<?= htmlspecialchars($item['name']) ?>">
                            <p><?= htmlspecialchars($item['description']) ?></p>
                            <p>Price: <?= htmlspecialchars($item['current_price']) ?></p>
                            <p>Store: <?= htmlspecialchars($item['Store']) ?></p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                            <button type="button" class="btn btn-primary add-to-cart-btn" 
                                    data-item-id="<?= htmlspecialchars($item['_id']) ?>"
                                    data-item-name="<?= htmlspecialchars($item['name']) ?>"
                                    data-item-price="<?= htmlspecialchars($item['current_price']) ?>">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                            <button type="button" class="btn btn-primary wishlist-btn" 
                                    data-item-id="<?= htmlspecialchars($item['_id']) ?>"
                                    data-item-name="<?= htmlspecialchars($item['name']) ?>">
                                <i class="fas fa-heart"></i> Wishlist
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
   $(document).ready(function () {
    $('.add-to-cart-btn').on('click', function () {
        var itemId = $(this).data('item-id');
        var itemName = $(this).data('item-name');
        var itemPrice = $(this).data('item-price');
        var form = $('<form action="addToCart.php" method="post">' +
            '<input type="hidden" name="itemId" value="' + itemId + '">' +
            '<input type="hidden" name="itemName" value="' + itemName + '">' +
            '<input type="hidden" name="itemPrice" value="' + itemPrice + '">' +
            '</form>');
        $('body').append(form);
        form.submit();
    });
    $('.wishlist-btn').on('click', function () {
        var itemId = $(this).data('item-id');
        var itemName = $(this).data('item-name');

    });

});
</script>

</body>
</html>
