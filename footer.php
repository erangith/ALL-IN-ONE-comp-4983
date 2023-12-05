<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AIO - Footer</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
    body {
        font-family: 'Open Sans', sans-serif;
    }

    footer {
        color: #FFFFFF; 
        background-color: #333; 
        padding: 20px 0;
        margin-top: auto;
        text-align: center; 
    }

    footer p, .footer-links, .social-media-icons {
        display: inline; 
        margin: 0 10px; 
    }

    footer a, footer p {
        color: #FFFFFF; 
        text-decoration: none;
        transition: color 0.3s ease;
        text-shadow: 0 0 5px rgba(255, 255, 255, 0.7), 
                     0 0 10px rgba(255, 255, 255, 0.5),
                     0 0 15px rgba(255, 255, 255, 0.3);
    }

    footer a:hover, footer p:hover {
        color: #4DB8FF; 
        text-shadow: 0 0 10px rgba(77, 184, 255, 0.7), 
                     0 0 20px rgba(77, 184, 255, 0.5),
                     0 0 30px rgba(77, 184, 255, 0.3);
    }

    .social-media-icons a {
        font-size: 20px;
        margin: 0 8px;
        color: #FFFFFF; 
        transition: transform 0.3s ease, color 0.3s ease;
    }

    .social-media-icons a:hover {
        transform: scale(1.2);
        text-shadow: 0 0 10px rgba(77, 184, 255, 0.7), 
                     0 0 20px rgba(77, 184, 255, 0.5),
                     0 0 30px rgba(77, 184, 255, 0.3);
    }
</style>

</head>
<body>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <p>&copy; AIO - All rights reserved</p>
                </div>
                <div class="col-md-4">
                    <div class="footer-links">
                        <a href="home.php">Home</a> |
                        <a href="about.php">About Us</a> |
                        <a href="new.php">Products</a> |
                        <a href="suppliers.php">Suppliers</a> |
                        <a href="contact.php">Help</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="social-media-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
