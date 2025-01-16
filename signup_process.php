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
    die("Error in DbConnection on SignUp function" . $exc->getMessage());
}

// Function to validate email address
function validateEmail($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate NIC number
function validateNIC($nic)
{
    // Check if NIC is in format XXXXXXXXXV or XXXXXXXXXXXX
    $pattern = '/^\d{9}[Vv]|\d{12}$/';
    return preg_match($pattern, $nic);
}

// Function to validate contact number
function validateContactNo($contactNo)
{
    // Check if contact number consists of exactly 10 digits
    $pattern = '/^\d{10}$/';
    return preg_match($pattern, $contactNo);
}

// Main form submission handling
if (isset($_POST['first_name'], $_POST['last_name'], $_POST['user_name'], $_POST['nic_no'], $_POST['email_address'], $_POST['contact_no'], $_POST['password'])) {
    if (!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['user_name']) && !empty($_POST['nic_no']) && !empty($_POST['email_address']) && !empty($_POST['contact_no']) && !empty($_POST['password'])) {
        if (validateEmail($_POST['email_address']) && validateNIC($_POST['nic_no']) && validateContactNo($_POST['contact_no'])) {
            $first_name = $_POST['first_name'];
            $last_name = $_POST['last_name'];
            $user_name = $_POST['user_name'];
            $nic_no = $_POST['nic_no'];
            $email_address = $_POST['email_address'];
            $contact_no = $_POST['contact_no'];
            $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
            $role = "Staff";

            // Create staff instance
            $staff = new staff($first_name, $last_name, $user_name, $password, $nic_no, $email_address, $contact_no, $role);

            // Check if username is unique
            if ($staff->isUsernameUnique($user_name, $dbcon)) {
                // Attempt to register staff
                if ($staff->register($dbcon)) {
                    // $message = "Your Staff registration was successful!";
                    // $location = "login.php?status=1";
                    $_SESSION['message'] = "SUCCESS";
                    http_response_code(200);
                } else {
                    // $message = "Failed to register the Staff. Please try again later.";
                    // $location = "login.php?status=2";
                    $_SESSION['message'] = "Failed to register the Staff. Please try again later.";
                    http_response_code(500);
                }
            } else {
                // Username already exists
                // $message = "Username already exists. Please choose a different username.";
                // $location = "login.php?status=3";
                $_SESSION['message'] = "Username already exists. Please choose a different username.";
                http_response_code(400);
            }
        } else {
            // Invalid email, NIC number, or contact number format
            $invalidFields = [];
            if (!validateEmail($_POST['email_address'])) {
                $invalidFields[] = "email";
            }
            if (!validateNIC($_POST['nic_no'])) {
                $invalidFields[] = "NIC number";
            }
            if (!validateContactNo($_POST['contact_no'])) {
                $invalidFields[] = "contact number";
            }
            // $message = "Invalid " . implode(", ", $invalidFields) . " format.";
            // $location = "login.php?status=4";
            $_SESSION['message'] = "Invalid " . implode(", ", $invalidFields) . " format.";
            http_response_code(400);
        }
    } else {
        // Required fields are empty
        // $message = "All fields are required. Please fill in all the fields.";
        // $location = "login.php?status=5";
        $_SESSION['message'] = "All fields are required. Please fill in all the fields.";
        http_response_code(400);
    }
} else {
    // Data not received from the form
    // $message = "Data not received. Please check your form submission.";
    // $location = "login.php?status=6";
    $_SESSION['message'] = "Data not received. Please check your form submission.";
    http_response_code(400);
}


header("Location:login.php");


// Exit to prevent further execution
exit();