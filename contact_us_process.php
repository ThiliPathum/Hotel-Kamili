<?php
    session_start();

    use classes\EmailConnector;

    require './classes/EmailConnector.php';

    $message = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Check if all required fields are set
        $requiredFields = ['username', 'email', 'subject', 'msg'];
        foreach ($requiredFields as $field) {
            if (empty($_POST[$field])) {
                $_SESSION['message'] = "All fields are required.";
            }
        }

        // Sanitize user inputs
        $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $subject = filter_var(trim($_POST['subject']), FILTER_SANITIZE_STRING);
        $msg = filter_var(trim($_POST['msg']), FILTER_SANITIZE_STRING);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['message'] = "Invalid email address.";
        }

        // Email address to send the form data
        $to = "ayshacader2001@gmail.com";

        // Create and configure the email
        $mail = new EmailConnector();
        $mail->setFromAddress($email);
        $mail->setFromName($username);
        $mail->setToAddress($to);
        $mail->setSubject($subject);
        $mail->setBody($msg);

        // Send the email and handle the response
        if ($mail->sendEmail()) {
            $_SESSION['message'] = "SUCCESS";
        } else {
            $_SESSION['message'] = "Failed to send email.";
        }
    } else {
        $_SESSION['message'] = "Invalid request.";
    }

    header("Location:contact-us.php");
?>
