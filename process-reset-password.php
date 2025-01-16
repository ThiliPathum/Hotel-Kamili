<?php
session_start();

use classes\staff;

require '../classes/DbConnector.php';
require '../classes/staff.php';

$message = "";

try {
    // Establish database connection
    $dbconnector = new classes\DbConnector();
    $dbcon = $dbconnector->getConnection();
} catch (PDOException $exc) {
    // Handle database connection error
    die("Error in DbConnection on process-reset-password file: " . $exc->getMessage());
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $token = trim($_POST["token"]);
    $password = trim($_POST["password"]);
    $password_confirmation = trim($_POST["password_confirmation"]);

    $token_hash = hash("sha256", $token);

    // Create staff instance for authentication
    $staff = new staff(null, null, null, null, null, null, null, null);

    $staffDetailsByToken = $staff->getAllStaffDetailsByToken($dbcon, $token_hash);

    if ($staffDetailsByToken === false) {
        // die("Token not found.");
        $_SESSION['message'] = "Something went wrong, Try Again !";
        header("Location: reset-pwd.php");
    }

    // Check if token has expired
    if (strtotime($staffDetailsByToken["reset_token_expires_at"]) <= time()) {
        // die("Token has expired.");
        $_SESSION['message'] = "Timeout, Try Again !";
        header("Location: reset-pwd.php");
    }

    // Validate password length
    if (strlen($password) < 8) {
        // die("Password must be at least 8 characters.");
        $_SESSION['message'] = "Password must be at least 8 characters.";
        header("Location: reset-pwd.php");
    }

    // Validate password contains at least one letter
    if (!preg_match("/[a-z]/i", $password)) {
        // die("Password must contain at least one letter.");
        $_SESSION['message'] = "Password must contain at least one letter.";
        header("Location: reset-pwd.php");
    }

    // Validate password contains at least one number
    if (!preg_match("/[0-9]/", $password)) {
        // die("Password must contain at least one number.");
        $_SESSION['message'] = "Password must contain at least one number.";
        header("Location: reset-pwd.php");
    }

    // Validate password confirmation
    if ($password !== $password_confirmation) {
        // die("Passwords must match.");
        $_SESSION['message'] = "Passwords must match.";
        header("Location: reset-pwd.php");
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    $staff_id = $staffDetailsByToken["staff_id"];

    if ($staff->updateResetPassword($dbcon, $password_hash, $staff_id)) {
        // echo "Password updated. You can now login.";
        $_SESSION['message'] = "SUCCESS";
        header("Location: reset-pwd.php");
    } else {
        // echo "Failed to update password. Please try again.";
        $_SESSION['message'] = "Failed to update password. Please try again.";
        header("Location: reset-pwd.php");
    }
} else {
    // die("Invalid request method.");
    $_SESSION['message'] = "Something went wrong, Try Again !";
    header("Location: reset-pwd.php");
}
