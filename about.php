<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALL IN ONE - Our Journey</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            line-height: 1.6;
            color: #555;
        }
        
        .fade-in {
            opacity: 0;
            transition: opacity 1.5s ease-in;
        }

        .hover-grow {
            transition: transform 0.3s ease;
        }

        .hover-grow:hover {
            transform: scale(1.05);
        }

        .banner, .about-content, .mission-vision, .team-section {
            transition: background-color 0.3s ease;
        }

        .banner {
            background-color: #16a085;
            color: #ffffff;
            padding: 80px 0;
            text-align: center;
            background-image: linear-gradient(120deg, #84fab0 0%, #8fd3f4 100%);
        }

        .about-content {
            padding: 60px 0;
            background-color: #f9f9f9;
        }

        .mission-vision {
            padding: 40px 0;
            background-color: #ffffff;
            border-top: 1px solid #e7e7e7;
            border-bottom: 1px solid #e7e7e7;
        }

        .team-section {
            padding: 60px 0;
            background-color: #f2f2f2;
        }

        .team-card {
            background-color:  #9df9ef; 
            border-radius: 10px; 
            overflow: hidden; 
            transition: box-shadow 0.3s ease-in-out, transform 0.3s ease-in-out;
        }

        .team-card:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2); 
            transform: translateY(-5px); 
        }
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-30px);
            }
            60% {
                transform: translateY(-15px);
            }
        }

        .bounce {
            animation: bounce 2s ease infinite;
        }
        

    </style>
</head>
<body>

   
    <?php include('navbar.php'); ?>

    
    <section class="banner">
        <div class="container">
            <h1>ALL IN ONE</h1>
            <p>An odyssey of passion, innovation, and dedication.</p>
        </div>
    </section>

   
    <section class="about-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2>Our Mission</h2>
                    <p>At the foundation of the All In One (AIO), project lies the story of two innovative youngsters, Thanuka Mabulage Don and Poorna Dadayakkara Dewege. while starting learning at Acadia University in 2022, they faced the difficulty of balancing their academics with the regular necessity of buying. The concept of AIO originated from the contrast of academic intensity and daily tasks.</p>
                    <p>A platform that combines ease of use with high-quality products was their idea, developed out of an amazing desire for innovation and a lifelong commitment to technology. They founded AIO, committed to improving everyone's shopping experience, as a result of their relentless search of excellence.</p>
                </div>
                <div class="col-lg-6">
                    <div class="text-center">
                        <img src="logo.png" alt="AIO Logo" class="fade-in" style="border-radius: 50%;">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="mission-vision">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Our Hope</h2>
                    <p>It's more than a service; AIO is a game-changer. By providing an unparalleled combination of ease, excellence, and innovation, we aim to revolutionize shopping. Our mission is to promote an eco-friendly retail environment that provides excellent service to our customers while reducing their impact on the environment.</p>
                </div>
                <div class="col-md-6">
                    <h2>Our Vision for Tomorrow</h2>
                    <p>We believe in a world where the shopping experience is completely transformed. Every transaction serves as evidence of our unwavering dedication to quality and the faith our customers place in us. At AIO, we consistently strive to improve the purchasing experience, while remaining committed to our ideals of sustainability and exceptional customer service.</p>
</div>
</div>
</div>
</section>
              
<section class="team-section">
    <div class="container">
        <h2 class="text-center">Meet The Pioneers</h2>
        <p class="text-center">The brilliant minds behind AIO</p>
        <div class="row mt-5">
            <div class="col-md-6">
                <div class="card team-card">
                    <img src="https://media.licdn.com/dms/image/C5603AQGg4WnZdVjbpA/profile-displayphoto-shrink_400_400/0/1631674935144?e=1703116800&v=beta&t=7Di1tzOtqAEj6TdXAA2HNHiWJdWCw_V3WoZ7oWeWH70" alt="Thanuka Mabulage Don" class="card-img-top bounce" style="border-radius: 50%;">
                    <div class="card-body">
                        <h5 class="card-title">Thanuka Mabulage Don</h5>
                        <p class="card-text">Co-founder & Chief Technical Officer</p>
                        <p>Passionate about technology and has a natural talent for coming up with new ideas. Making a difference through technology is something Thanuka is passionate about.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card team-card">
                    <img src="https://media.licdn.com/dms/image/D4E03AQHDkhSAgnkkaQ/profile-displayphoto-shrink_400_400/0/1672115915203?e=1703116800&v=beta&t=loV1lH6eHcda7qnIGM1abJOkIFwjFQJWENcs3fFtnw0" alt="Poorna Dadayakkara Dewege" class="card-img-top bounce" style="border-radius: 50%;">
                    <div class="card-body">
                        <h5 class="card-title">Poorna Dadayakkara Dewege</h5>
                        <p class="card-text">Co-founder & Chief Operational Officer</p>
                        <p>When it comes to operational excellence at AIO, Poorna is the one behind the wheel. He aspires to transform shopping into an enjoyable experience.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include('footer.php'); ?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
        document.addEventListener("DOMContentLoaded", function() {
            Array.from(document.querySelectorAll('.fade-in')).forEach(el => el.style.opacity = 1);
        });
    </script>

</body>
</html>