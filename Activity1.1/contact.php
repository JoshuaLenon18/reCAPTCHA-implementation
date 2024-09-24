<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'recaptcha_verification.php';  // Include reCAPTCHA verification script

    $name = htmlspecialchars(trim($_POST['name']));
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars(trim($_POST['message']));

    // Check if the reCAPTCHA was successful
    if (verifyRecaptcha($_POST['g-recaptcha-response'])) {
        if (!empty($name) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // All inputs valid; process the message (send email, save to database, etc.)
            echo "Message sent successfully!";
        } else {
            echo "Please fill in all fields correctly.";
        }
    } else {
        echo "reCAPTCHA verification failed. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

<h2>Contact Us</h2>

<form action="contact.php" method="POST">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="message">Message:</label>
    <textarea id="message" name="message" rows="5" required></textarea>

    <div class="g-recaptcha" data-sitekey="6Lf4Sk0qAAAAABWTObrIwUN0gN25gdw93yarGEYI"></div>
    
    <button type="submit">Submit</button>
</form>

</body>
</html>
