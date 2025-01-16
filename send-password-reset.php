<?php
session_start();

use classes\staff;
use classes\EmailConnector;

require '../classes/DbConnector.php';
require '../classes/staff.php';
require '../classes/EmailConnector.php';

$message = "";

try {
    // Establish database connection
    $dbconnector = new classes\DbConnector();
    $dbcon = $dbconnector->getConnection();
} catch (PDOException $exc) {
    // Handle database connection error
    die("Error in DbConnection on SignUp function: " . $exc->getMessage());
}

// Validate email input
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["email"]) && filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    
    $email = trim($_POST["email"]);
    // Create staff instance for setting the token
    $staff = new staff(null, null, null, null, null, $email, null, null);
    if(!($staff->checkEmailAvailability($email, $dbcon))){
        
        // Generate a random token
        $token = bin2hex(random_bytes(16));
        // Hash the token for storage
        $token_hash = hash("sha256", $token);
        // Token expiry set to 30 minutes from now
        $expiry = date("Y-m-d H:i:s", time() + 60 * 30); 

        if ($staff->setHashToken($dbcon, $token_hash, $expiry)) {
            // Configure the email
            $emailConnector = new EmailConnector();
            $emailConnector->setFromAddress('noreply@example.com');
            $emailConnector->setFromName('Your Company');
            $emailConnector->setToAddress($email);
            $emailConnector->setSubject('Password Reset');
            $emailConnector->setBody(<<<EOT
                Click <a href="http://localhost:8000/AdminPanel/reset-pwd.php?token=$token">here</a> to reset your password.
            EOT);

            // Send the email
            if ($emailConnector->sendEmail()) {
                // $message = "Message sent, please check your inbox.";
                $_SESSION['message'] = "SUCCESS";
                header("Location: forget.php");
            } else {
                // $message = "Failed to send email. Please try again.";
                $_SESSION['message'] = "Failed to send email. Please try again.";
                header("Location: forget.php");
            }
        } else {
            // $message = "Failed to generate reset token. Please try again.";
            $_SESSION['message'] = "Something went wrong, Try Again!";
            header("Location: forget.php");
        }

    }else{
        // $message = "The email is not registered.";
        $_SESSION['message'] = "The email is not registered.";
        header("Location: forget.php");
    }
} else {
    // $message = "The email format is invalid.";
    $_SESSION['message'] = "The email format is invalid.";
    header("Location: forget.php");
}

// echo $message;
