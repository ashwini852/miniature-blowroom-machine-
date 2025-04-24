<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name    = strip_tags(trim($_POST["name"]));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    // Validate input
    if ( empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message) ) {
        http_response_code(400);
        echo "Please complete the form and try again.";
        exit;
    }

    // Set recipient email address
    $recipient = "your_email@example.com"; // replace with your email

    // Email subject
    $subject = "New contact from $name";

    // Email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Email headers
    $email_headers = "From: $name <$email>";

    // Send email
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Thank you! Your message has been sent.";
    } else {
        http_response_code(500);
        echo "Oops! Something went wrong.";
    }
} else {
    http_response_code(403);
    echo "There was a problem with your submission.";
}
?>
