<?php
$name = $_POST['name'];
$visitor_email = $_POST['email'];
$message = $_POST['message'];

$email_from = 'tvvidyashree@gmail.com';

$email_subject = "New Feedback!";

$email_body = "Username: $name.\n" . "User email: $visitor_email.\n" . "Feedback : $message.\n";

$to = "vidyashree.india@gmail.com";

$headers = "From:$email_from\r\n";

$headers .= "Reply-to: $visitor_email\r\n";

mail($to, $email_subject, $email_body, $headers);

redirect("index.php");
