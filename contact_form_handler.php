<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $errors = [];

    if (empty($name)) {
        $errors[] = "Name is required";
    }

    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (empty($message)) {
        $errors[] = "Message is required";
    }

    if (empty($errors)) {
        $to = "info@aio.com";
        $subject = "New Contact Form Submission";
        $body = "Name: " . $name . "\n";
        $body .= "Email: " . $email . "\n\n";
        $body .= "Message:\n" . $message . "\n";
        $headers = "From: " . $email;

        if (mail($to, $subject, $body, $headers)) {
            header("Location: contact.php?success=true");
        } else {
            header("Location: contact.php?error=true");
        }
    } else {
        header("Location: contact.php?validation_error=true&errors=" . urlencode(json_encode($errors)));
    }
} else {
    header("Location: contact.php");
}
?>