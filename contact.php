
<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';
    require 'PHPMailer/Exception.php';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

   /* $mail = new PHPMailer\PHPMailer\PHPMailer();    *** WE TRIED TO MAKE SMTP SERVER ISSUE WORK BUT UNFORTUNATELY WE COULDN'T MAKE IT WORK***
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'AIO23@gmail.com';
    $mail->Password = 'AIO@2023';
    $mail->SMTPSecure = 'tls';

    $mail->setFrom($email, $name);
    $mail->addAddress('ALLInOne23@gmail.com');
    $mail->Subject = 'New Contact Message';
    $mail->Body = "Name: $name\nEmail: $email\n\nMessage:\n$message";*/

    if ($mail->send()) {
        $successMessage = "We genuinely appreciate your query! Our team will revert to you shortly.";
    } else {
        $errorMessage = "Our apologies, an error occurred while dispatching your message. Please attempt once more. Technical Details: " . $mail->ErrorInfo;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - AIO</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    body {
            background: linear-gradient(120deg, #E9F7EF, #A8E6CF); 
            font-family: Arial, sans-serif;
            transition: background-color 0.3s;
        }
        h1, h3, label {
            color: #2E8B57;
            transition: color 0.3s;
        }
        .contact-info p {
            color: #4D4D4D;
        }
        .contact-form {
            background-color: #f2f2f2;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 2px 12px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s;
        }
        .form-control:focus {
            border-color: #138D75;
            box-shadow: 0 0 5px rgba(19, 141, 117, 0.5);
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        button {
            background-color: #138D75;
            border: none;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #117a66;
            transition: background-color 0.3s;
        }
        .alert {
            margin-bottom: 20px;
        }
        .animated-heading {
            animation: fadeInUp 1s ease-in-out;
        }
        .animated-input label {
            transition: all 0.3s ease-in-out;
        }
        .animated-input input:focus + label,
        .animated-input textarea:focus + label {
            transform: translateY(-20px);
            font-size: 0.8em;
            color: #138D75;
        }
        .download-button {
    background-image: linear-gradient(to right, #4facfe 0%, #00f2fe 100%);
    color: white;
    border: none;
    border-radius: 4px;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: bold;
    text-transform: uppercase;
    text-decoration: none;
    display: inline-block;
    transition: all 0.3s ease-in-out;
}

.download-button:hover, .download-button:focus {
    background-image: linear-gradient(to right, #00f2fe 0%, #4facfe 100%);
    color: white;
    text-decoration: none;
    transform: translateY(-2px);
}

.download-button:active {
    transform: translateY(1px);
}

    </style>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-5">
        <h1 class="mb-5 text-center">Reach Out to Us</h1>
        <div class="row">
            <div class="col-md-6 mb-4 contact-info">
                <h3>Find Us Here</h3>
                <iframe src="https://maps.google.com/maps?q=15%20University%20Ave%2C%20Wolfville%20Nova%20Scotia&t=&z=15&ie=UTF8&iwloc=&output=embed" frameborder="0" style="border:0; width: 100%; height: 250px;" allowfullscreen=""></iframe>
                <h3 class="mt-4">Stay Connected</h3>
                <p><strong>Email:</strong> info@AllInOne.com</p>
                <p><strong>Phone:</strong> +1 (555) 123-4567</p>
            </div>
            <div class="col-md-6">
                <div class="contact-form">
                    <?php if (isset($successMessage)): ?>
                        <div class="alert alert-success" role="alert">
                            <?= $successMessage ?>
                        </div>
                    <?php elseif (isset($errorMessage)): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $errorMessage ?>
                        </div>
                    <?php endif; ?>
                    <form method="post" action="contact.php">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Your Message"></textarea>
                        </div>
                     
                        <a class="btn btn-outline-light btn-lg download-button" href="mailto:info@AllInOne.com">Contact Us</a>

                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('a[href*="#"]').on('click', function(e) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop : $($(this).attr('href')).offset().top,
            }, 500, 'linear');
        });

    
    </script>
</body>
</html>