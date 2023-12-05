<?php
session_start();
require 'vendor/autoload.php';

$mongoClient = new MongoDB\Client("mongodb://localhost:27017");
$db = $mongoClient->AIO;

$greekYogurt = $db->groceries_items->findOne(['name' => 'Greek Yogurt']);
$OrganicBlueberries = $db->groceries_items->findOne(['name' => 'Organic Blueberries']);
$granolaBars = $db->groceries_items->findOne(['name' => 'Granola Bars']);
$honey = $db->groceries_items->findOne(['name' => 'Honey']);
$quinoa = $db->groceries_items->findOne(['name' => 'Quinoa']);
$almonds = $db->groceries_items->findOne(['name' => 'Almonds']);
$oliveOil = $db->groceries_items->findOne(['name' => 'Olive Oil']);
$garlic = $db->groceries_items->findOne(['name' => 'Garlic']);
$organicCarrots = $db->groceries_items->findOne(['name' => 'Organic Carrots']);
$frozenPeas = $db->groceries_items->findOne(['name' => 'Frozen Peas']);
$organicBabySpinach = $db->groceries_items->findOne(['name' => 'Organic Baby Spinach']);
$blackBeans = $db->groceries_items->findOne(['name' => 'Black Beans']);
$soySauce = $db->groceries_items->findOne(['name' => 'Soy Sauce']);
$sesameOil = $db->groceries_items->findOne(['name' => 'Sesame Oil']);
$ginger = $db->groceries_items->findOne(['name' => 'Ginger']);
$almondButter = $db->groceries_items->findOne(['name' => 'Almond Butter']);
$almondMilk = $db->groceries_items->findOne(['name' => 'Almond Milk']);
$frozenBlueberries = $db->groceries_items->findOne(['name' => 'Frozen Blueberries']);
$banana = $db->groceries_items->findOne(['name' => 'Banana']);

$greekYogurtParfaitwithBlueberriesItems = [
    'greekYogurt' => $greekYogurt,
    'OrganicBlueberries' => $OrganicBlueberries,
    'granolaBars' => $granolaBars,
    'honey' => $honey,
    'almonds' => $almonds,
];

$quinoaandVegetableStirFryItems = [
    'quinoa' => $quinoa,
    'oliveOil' => $oliveOil,
    'garlic' => $garlic,
    'organicCarrots' => $organicCarrots,
    'frozenPeas' => $frozenPeas,
    'organicBabySpinach' => $organicBabySpinach,
    'blackBeans' => $blackBeans,
    'soySauce' => $soySauce,
    'sesameOil' => $sesameOil,
    'ginger' => $ginger,
];

$almondButterBananaSmoothieItems = [
    'almondButter' => $almondButter,
    'almondMilk' => $almondMilk,
    'frozenBlueberries' => $frozenBlueberries,
    'banana' => $banana,
    'greekYogurt' => $greekYogurt,
    'honey' => $honey,
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipe Ideas</title>
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
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }
        .central-image img:hover {
    animation: rotate 10s infinite linear;
}
        .central-image img {
    border-radius: 50%; 
    transition: transform 10s linear;
}
        .person-image {
            width: 250px;
            height: 200px;
            border-radius: 50%; 
    object-fit: cover; 
    margin-bottom: 10px;
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
    <h1>Explore Delicious Recipes</h1>
</div>

<div class="central-image rotate-image">
    <img src="https://img.freepik.com/free-photo/delicious-healthy-dessert-with-blueberry-arrangement_23-2148988788.jpg?size=626&ext=jpg&ga=GA1.1.61237127.1701226985&semt=aise" class="person-image">
</div>
<div class="recipe-description">
    <h2>Greek Yogurt Parfait with Blueberries</h2>
    <p>Start your day with a perfect blend of creamy Greek yogurt, fresh organic blueberries, crunchy granola, and a drizzle of honey.</p>
    <p> Topped with slivered almonds for an extra crunch, it's a nutritious breakfast that's as delightful as it is healthy.</p>
</div>

<div class="fashion-display">
    <?php foreach ($greekYogurtParfaitwithBlueberriesItems as $key => $item): ?>
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

<div class="central-image rotate-image">
    <img src="https://img.freepik.com/free-photo/side-view-quinoa-salad-with-tomato-cucumber-basil-salt-pepper-table_141793-3676.jpg?size=626&ext=jpg&ga=GA1.1.923433535.1699319700&semt"class="person-image">
</div>
<div class="recipe-description">
    <h2>Quinoa and Vegetable Stir Fry</h2>
    <p>Experience the flavors of a hearty stir fry with quinoa at its heart.</p>
    <p>Accompanied by a vibrant mix of organic carrots, peas, and baby spinach, this dish is seasoned with a blend of soy sauce, sesame oil, and ginger.</p>
    <p> A plant-based feast that's as satisfying as it is nutritious.</p>
</div>

<div class="fashion-display">
    <?php foreach ($quinoaandVegetableStirFryItems as $key => $item): ?>
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
                        <h5 class="modal-title"><?= htmlspecialchars($item['name']) ?></h5>
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

<div class="central-image rotate-image">
   <img src="https://img.freepik.com/free-photo/banana-almond-smoothie-dark-background_1150-45196.jpg?size=626&ext=jpg&ga=GA1.1.923433535.1699319700&semt"class="person-image">
</div>
<div class="recipe-description">
    <h2>Almond Butter Banana Smoothie</h2>
    <p>Whip up a luscious smoothie with the rich taste of almond butter, ripe bananas, and smooth almond milk.</p>
     <p>It's an energizing drink that's both delicious and a great source of nutrients.</p>
    <P>Perfect for a quick breakfast or a refreshing post-workout treat.</p>
</div>
<div class="fashion-display">
    <?php foreach ($almondButterBananaSmoothieItems as $key => $item): ?>
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
                        <h5 class="modal-title"><?= htmlspecialchars($item['name']) ?></h5>
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

    $('.quick-view-button').click(function() {
        var modalId = $(this).data('target');
        $(modalId).modal('show');
    });
});
</script>

</body>