<?php
function verifyRecaptcha($recaptcha_response) {
    $secret_key = '6Lf4Sk0qAAAAAOy2ayCa6OWx4dIheQlXfK-WDB73';  // Replace with your secret key
    $verify_url = 'https://www.google.com/recaptcha/api/siteverify';
    
    // Create POST request for verification
    $response = file_get_contents($verify_url . '?secret=' . $secret_key . '&response=' . $recaptcha_response);
    $response_data = json_decode($response);
    
    // Return true if reCAPTCHA is successful, false otherwise
    return isset($response_data->success) && $response_data->success == true;
}
?>
