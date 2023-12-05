<!DOCTYPE html>
<html>
<head>
    <title>Fashion Inspirations</title>
    <style>
        body {
    background-color: #2c3e50;
    color: #ecf0f1; 
    font-family: 'Georgia', serif;
    line-height: 1.6;
}


header {
    background-color: #34495e; 
    padding: 20px;
    text-align: center;
    box-shadow: 0 2px 5px rgba(0,0,0,.2);
}

h1 {
    color: #f1c40f; 
    text-transform: uppercase;
    letter-spacing: 1px;
    animation: pulse 2s infinite;
}
.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    margin: 20px auto;
    max-width: 1200px;
}

.fashion-card {
    background: #34495e;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0,0,0,.2);
    margin: 20px;
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    width: 350px;
    cursor: pointer;
}

.fashion-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 15px rgba(0,0,0,.3);
}

.card-img-top {
    height: 300px;
    object-fit: cover;
    width: 100%;
    border-bottom: 3px solid #f1c40f;
    transition: border-bottom 0.3s ease;
}

.card-body {
    padding: 15px;
    color: #ecf0f1; 
}

.card-title {
    color: #f1c40f; 
    font-size: 1.4rem;
    margin-bottom: 10px;
}

.card-text {
    font-size: 1.1rem;
    margin-bottom: 10px;
}

.discount-code {
    background-color: #16a085; 
    color: #ecf0f1; 
    padding: 10px;
    text-align: center;
    font-weight: bold;
    border-radius: 5px;
    margin-bottom: 20px;
}
.discount-code-btn {
    display: inline-block;
    background-color: #16a085; 
    color: #ecf0f1; 
    padding: 10px 20px; 
    text-align: center;
    font-weight: bold;
    border-radius: 5px; 
    margin: 10px 0; 
    text-decoration: none; 
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.discount-code-btn:hover {
    background-color: #149174;
    transform: translateY(-2px); 
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

@keyframes pulse {
    0% {transform: scale(1);}
    50% {transform: scale(1.05);}
    100% {transform: scale(1);}
}

@keyframes fadeIn {
    from {opacity: 0;}
    to {opacity: 1;}
}

.card-img-top {
    animation-name: fadeIn;
    animation-duration: 2s;
}
    </style>
</head>
<body>
    <header>
        <h1>Explore the Latest Fashion Trends</h1>
    </header>

    <div class="container">
    <?php
        $fashionIdeas = [
            [
                "title" => "Summer Beachwear",
                "image" => "summer.jpg",
                "description" => "Discover the must-have beachwear trends this summer, from swimming shorts to airy kaftans and sun hats.",
                "youtube_link" => "https://www.amazon.ca/s?k=Summer+Beachwear+Essentials"
            ],
            [
                "title" => "Vintage Revival For Style",
                "image" => "vintage.jpg",
                "description" => "Explore the classic charm of vintage fashion, featuring retro prints, polka dots, and timeless silhouettes.",
                "youtube_link" => "https://www.amazon.ca/s?k=Vintage+Revival"
            ],
            [
                "title" => "Urban Street Style",
                "image" => "urban.jpg",
                "description" => "Get inspired by the bold and edgy looks of urban street style, blending comfort with a touch of rebellion.",
                "youtube_link" => "https://www.amazon.ca/s?k=Urban+Street+Style"
            ],
            [
                "title" => "Eco-Friendly Fashion",
                "image" => "ecofriendly.jpg",
                "description" => "Embrace sustainable fashion choices with eco-friendly materials and ethical production practices.",
                "youtube_link" => "https://www.amazon.ca/s?k=Eco-Friendly+Fashion"
            ],
            [
                "title" => "Formal Elegance",
                "image" => "formal.jpg",
                "description" => "Discover the latest trends in formal wear, from sophisticated evening gowns to sleek tailored suits.",
                "youtube_link" => "https://www.amazon.ca/s?k=Formal+Elegance"
            ],
            [
                "title" => "Sporty Chic",
                "image" => "sporty.jpg",
                "description" => "Blend comfort and style with sporty chic outfits, perfect for a casual day out or a light workout session.",
                "youtube_link" => "https://www.amazon.ca/s?k=Sporty+Chic"
            ],
            [
                "title" => "Winter Warmers",
                "image" => "winter.jpg",
                "description" => "Stay cozy and stylish with winter essentials like oversized sweaters, scarves, and warm, plush coats.",
                "youtube_link" => "https://www.amazon.ca/s?k=Winter+Warmers"
            ]
        ];

        $discountCodes = [
            "Summer Beachwear" => "SUMMER20",
            "Vintage Revival For Style" => "VINTAGE15",
            "Urban Street Style" => "URBAN10",
            "Eco-Friendly Fashion" => "ECO25",
            "Formal Elegance" => "FORMAL30",
            "Sporty Chic" => "SPORTY5",
            "Winter Warmers" => "WINTER10"
        ];

        foreach ($fashionIdeas as $idea) {
            echo '<div class="fashion-card">';
            echo '<a href="' . $idea['youtube_link'] . '" target="_blank">';
            echo '<img class="card-img-top" src="' . $idea['image'] . '" alt="' . $idea['title'] . '">';
            echo '</a>';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">' . $idea['title'] . '</h5>';
            echo '<p class="card-text">' . $idea['description'] . '</p>';
            if (array_key_exists($idea['title'], $discountCodes)) {
                echo '<a href="' . $idea['youtube_link'] . '" class="discount-code-btn" target="_blank">Use Code: ' . $discountCodes[$idea['title']] . '</a>';
            }
            echo '</div>';
            echo '</div>';
        }
    ?>
    </div>

    <?php include('footer.php'); ?>
</body>
</html>
