<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'recaptcha_verification.php';  // Include reCAPTCHA verification script

    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Check if the reCAPTCHA was successful
    if (verifyRecaptcha($_POST['g-recaptcha-response'])) {
        if (!empty($username) && !empty($password)) {
            // login process 
            if ($username == 'admin' && $password == '1234') { //login credentials here
                $_SESSION['loggedin'] = true;
                header("Location: dashboard.php");
            } else {
                echo "Invalid username or password.";
            }
        } else {
            echo "Please fill in all fields.";
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
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>

<h2>Admin Login</h2>

<form action="login.php" method="POST">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>

    <div class="g-recaptcha" data-sitekey="6Lf4Sk0qAAAAABWTObrIwUN0gN25gdw93yarGEYI"></div>
    
    <button type="submit">Login</button>
</form>

</body>
</html>
