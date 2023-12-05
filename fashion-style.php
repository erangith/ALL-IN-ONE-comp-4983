<?php
session_start();
require 'vendor/autoload.php';

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$db = $mongoClient->AIO;
$whiteShirt = $db->fashion_items->findOne(['name' => 'White Shirt']);
$blueBlazer = $db->fashion_items->findOne(['name' => 'blue blazer']);
$officeBelt = $db->fashion_items->findOne(['name' => 'Office belt']);
$brownShoes = $db->fashion_items->findOne(['name' => 'brown shoes']);
$officeTrouser = $db->fashion_items->findOne(['name' => 'Office troucer']);
$officeSkirt = $db->fashion_items->findOne(['name' => 'Office skirt']);
$womenBlazer = $db->fashion_items->findOne(['name' => 'Women blazer']);
$blackHeels = $db->fashion_items->findOne(['name' => 'black heels']);
$womenWatch = $db->fashion_items->findOne(['name' => 'women watch']);
$womenShirt = $db->fashion_items->findOne(['name' => 'women shirt']);

$mensItems = [
    'whiteShirt' => $whiteShirt,
    'blueBlazer' => $blueBlazer,
    'officeBelt' => $officeBelt,
    'brownShoes' => $brownShoes,
    'officeTrouser' => $officeTrouser,
];

$womensItems = [
    'officeSkirt' => $officeSkirt,
    'womenBlazer' => $womenBlazer,
    'blackHeels' => $blackHeels,
    'womenWatch' => $womenWatch,
    'womenShirt' => $womenShirt,
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion Styles</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color:#F9FFF3;
            margin: 0;
            padding: 0;
        }
        .header {
            text-align: center;
        margin: 50px 0;
        color: #9df9ef; 
        font-size: 48px; 
        font-weight: 300;
        text-transform: uppercase;
        letter-spacing: 5px;
        animation: fadeInDown 2s;
        }
        .item-card {
            position: relative;
            border: 1px solid #ddd;
            border-radius: 50%;
            margin-bottom: 20px;
            padding: 15px;
            background-color: #fafafa;
            width: 150px;
            height: 150px;
            text-align: center;
            overflow: hidden;
        }
        .item-image {
            width: 100%;
            height: 200px;
            object-fit: contain;
            border-radius: 50%;
        }
        .item-info {
            text-align: center;
        }
        .btn-add-to-cart {
            color: #fff;
            background-color: #26a69a;
            border-color: #00796b;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        .btn-add-to-cart:hover {
            background-color: #00897b;
            border-color: #00695c;
        }
        .central-image {
          
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }
        
        .central-image img {
            border-radius: 50%; 
}
        .person-image {
            width: 850px;
            height: 1130px;
            transition: transform 0.25s ease;
            border-radius: 50%; 
            object-fit: cover; 
            margin-bottom: 10px;
            transform-origin: center center;
        }
        .zoom-container {
            overflow: hidden;
            position: relative;
}
        .person-image-zoom:hover {
            transform: scale(1.5); 
            transition: transform 0.5s ease-in-out; 
}
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); 
            display: none; 
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .overlay button {
            margin: 5px;
            padding: 10px 20px;
            border: none;
            background-color: #26a69a;
            color: white;
            cursor: pointer;
        }

        .overlay button:hover {
            background-color: #2bbbad;
        }
        .rotate-image img {
            transition: transform 10s linear;
        }
        .rotate-image.start-rotation img {
            transform: rotate(360deg);
        }
        .recipe-description {
            text-align: center;
            margin: 20px 0;
            animation: fadeIn 2s;
        }
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .footer {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            margin-top: 20px;
            width: 100%;
        }
        @keyframes rotate {
            from {transform: rotate(0deg);}
            to {transform: rotate(360deg);}
        }
        .fashion-display {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin-bottom: 30px;
        }
        .item-card {
            animation: rotate 10s infinite linear;
        }
        @media (max-width: 768px) {
            .central-image {
                order: 0;
            }
            .fashion-display {
                flex-direction: column;
            }
            .item-card {
                margin: 10px auto;
            }
            
        }
    </style>
</head>
<body>
<div class="header">
    <h1>Fashion Styles</h1>
</div>

<div class="zoom-container">
        <img src="man.jpg" class="person-image person-image-zoom" alt="Styled Man">
    </div>

<div class="fashion-display">
    <?php foreach ($mensItems as $key => $item): ?>
         <div class="item-card animate__animated animate__fadeInUp">
        <div class="overlay" style="display:none;">
                <button type="button" class="btn btn-primary quick-view-button" data-toggle="modal" data-target="#quickViewModal<?= htmlspecialchars($item['_id']) ?>">Quick View</button>
                
            </div> 
            <img src="<?= htmlspecialchars($item['image_url']) ?>" class="item-image" alt="<?= htmlspecialchars($key) ?>">


            <div class="item-info">
                <h5><?= htmlspecialchars($key) ?></h5>
                <p>Price: <?= htmlspecialchars($item['current_price']) ?></p>
                <button type="button" class="btn btn-primary quick-view-button" data-toggle="modal" data-target="#quickViewModal<?= htmlspecialchars($item['_id']) ?>">Quick View</button>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form action="addToCart.php" method="post" class="d-inline">
                            <input type="hidden" name="itemId" value="<?= htmlspecialchars($item['_id']) ?>">
                            <input type="hidden" name="itemName" value="<?= htmlspecialchars($item['name']) ?>">
                            <input type="hidden" name="itemPrice" value="<?= htmlspecialchars($item['current_price']) ?>">
                            <button type="submit" class="btn btn-success">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="zoom-container">
        <img src="woman.jpg" class="person-image person-image-zoom" alt="Styled Woman">
    </div>

<div class="fashion-display">
    <?php foreach ($womensItems as $key => $item): ?>
        <div class="item-card animate__animated animate__fadeInUp">
        <div class="overlay" style="display:none;">
                <button type="button" class="btn btn-primary quick-view-button" data-toggle="modal" data-target="#quickViewModal<?= htmlspecialchars($item['_id']) ?>">Quick View</button>
                
            </div> 
            <img src="<?= htmlspecialchars($item['image_url']) ?>" class="item-image" alt="<?= htmlspecialchars($key) ?>" height="300" width="300">


            <div class="item-info">
                <h5><?= htmlspecialchars($key) ?></h5>
                <p>Price: <?= htmlspecialchars($item['current_price']) ?></p>
                <button type="button" class="btn btn-primary quick-view-button" data-toggle="modal" data-target="#quickViewModal<?= htmlspecialchars($item['_id']) ?>">Quick View</button>
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <form action="addToCart.php" method="post" class="d-inline">
                            <input type="hidden" name="itemId" value="<?= htmlspecialchars($item['_id']) ?>">
                            <input type="hidden" name="itemName" value="<?= htmlspecialchars($item['name']) ?>">
                            <input type="hidden" name="itemPrice" value="<?= htmlspecialchars($item['current_price']) ?>">
                            <button type="submit" class="btn btn-success">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    $('.item-card').hover(
        function() {
            $(this).find('.overlay').stop(true, true).fadeIn();
        }, 
        function() {
            $(this).find('.overlay').stop(true, true).fadeOut();
        }
    );
    $('.rotate-image').hover(
        function() {
            $(this).addClass('start-rotation');
        }, 
        function() {
            $(this).removeClass('start-rotation');
        }
    );
    $('.zoom-container').mousemove(function(e) {
        var zoomContainer = $(this);
        var image = zoomContainer.find('.person-image');

        var containerWidth = zoomContainer.width();
        var containerHeight = zoomContainer.height();
        var mouseX = e.pageX - zoomContainer.offset().left;
        var mouseY = e.pageY - zoomContainer.offset().top;

        var bgPosX = (mouseX / containerWidth) * 100;
        var bgPosY = (mouseY / containerHeight) * 100;
        image.css({
            'transform-origin': `${bgPosX}% ${bgPosY}%`,
            'transform': 'scale(2)', 
            'transition': 'transform-origin 0.1s ease'
        });
    }).mouseleave(function() {
        $(this).find('.person-image').css({
            'transform': 'scale(1)',
            'transition': 'transform 0.25s ease'
        });
    });
    $('.quick-view-button').click(function() {
        var modalId = $(this).data('target');
        $(modalId).modal('show');
    });
});
</script>

</body>