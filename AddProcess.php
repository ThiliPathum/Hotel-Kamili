<?php
session_start();

require '../classes/DbConnector.php';
require '../classes/Room.php';
require '../classes/staff.php';
require '../classes/Reservation.php';
require '../classes/Customer.php';
require '../classes/EventTypes.php';
require '../classes/DecorationOptions.php';
require '../classes/CakeOptions.php';
require 'message.php';

use classes\DbConnector;
use classes\Room;
use classes\Reservation;
use classes\Customer;
use classes\staff;
use classes\CakeOptions;


// Add Room Process
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['RoomSubmit'])) {
        $roomType = $_POST['roomType'];
        $adultCount = $_POST['adultCount'];
        $childrenCount = $_POST['childrenCount'];
        $pricePerNight = $_POST['pricePerNight'];
        $roomDescription = $_POST['roomDescription'];
        $numberOfRooms = $_POST['numberOfRooms'];

        $uploadDir = 'uploads/';

        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Initialize image variables
        $roomInsideImage = '';
        $roomInside360Image = '';
        $bathroom360Image = '';
        $outdoor360Image = '';

        $files = [
            'roomInsideImageUpload' => &$roomInsideImage,
            'roomInside360ImageUpload' => &$roomInside360Image,
            'bathroom360ImageUpload' => &$bathroom360Image,
            'outdoor360ImageUpload' => &$outdoor360Image
        ];

        foreach ($files as $fileKey => &$fileName) {
            if (!empty($_FILES[$fileKey]['name'])) {
                $fileTmpPath = $_FILES[$fileKey]['tmp_name'];
                $fileName = basename($_FILES[$fileKey]['name']);
                $destPath = $uploadDir . $fileName;
                // Assuming moving the file was missed in the provided code
                move_uploaded_file($fileTmpPath, $destPath);
            }
        }

        $dbConnector = new DbConnector();
        $con = $dbConnector->getConnection();

        $room = new Room(
            $roomType,
            $adultCount,
            $childrenCount,
            $pricePerNight,
            $roomDescription,
            $numberOfRooms,
            $roomInsideImage,
            $roomInside360Image,
            $bathroom360Image,
            $outdoor360Image
        );

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
        } else {
            if ($room->create($con)) {
                $_SESSION['message'] = "Room details saved successfully!";
            } else {
                $_SESSION['errors'] = "Failed to save room details.";
            }
        }

        header('Location: AddRoom.php');
        exit();
    }

    // Add staff process
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Add staff process
        if (isset($_POST['staffSubmit'])) {
            $first_name = $_POST['fname'];
            $last_name = $_POST['lname'];
            $user_name = $_POST['uname'];
            $password = $_POST['pwd'];
            $nic_no = $_POST['nic'];
            $email = $_POST['email'];
            $contact_no = $_POST['contact'];
            $role = $_POST['role'];

            // staff error handlings
            $errors = [];

            if (empty($first_name) || empty($last_name) || empty($user_name) || empty($password) || empty($nic_no) || empty($email) || empty($contact_no) || empty($role)) {
                $errors[] = "All fields are required.";
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format.";
            }

            $dbConnector = new DbConnector();
            $con = $dbConnector->getConnection();

            $staff = new staff($first_name, $last_name, $user_name, $password, $nic_no, $email, $contact_no, $role);

            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
            } else {
                if ($staff->register($con)) {
                    $_SESSION['message'] = "Staff details saved successfully!";
                } else {
                    $_SESSION['errors'] = ["Failed to save staff details."];
                }
            }

            header('Location: AddStaff.php');
            exit();
        }
    }

    // add reservation

    if (isset($_POST['ReservationSubmit'])) {

        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $country = $_POST['country'];

        $dbConnector = new DbConnector();
        $con = $dbConnector->getConnection();

        $customer = new Customer($fullname, $email, $contact, $address, $country);

        if ($con) {
            if ($customer->create($con)) {
                $customer_id = $customer->getCustomerId();

                $room = $_POST['room_id'];
                $check_in_date = $_POST['check_in_date'];
                $check_out_date = $_POST['check_out_date'];
                $number_of_children = $_POST['number_of_children'];
                $number_of_adult = $_POST['number_of_adult'];
                $number_of_room = $_POST['number_of_room'];
                $total_price = $_POST['total_price'];
                $payment_status = $_POST['payment_status'];

                $reservation = new Reservation($customer_id, $room, $check_in_date, $check_out_date, $number_of_children, $number_of_adult, $number_of_room, $total_price, $payment_status);

                // Create reservation
                if ($reservation->create($con)) {
                    $_SESSION['message'] = "Reservation added successfully!";
                } else {
                    $_SESSION['errors'] = "Failed to add reservation.";
                }
            } else {
                $_SESSION['errors'] = "Failed to add customer.";
            }
        } else {
            $_SESSION['errors'] = "Database connection error.";
        }

        header('Location: AddReservation.php');
        exit();
    }

    // Add Event Process

    if (isset($_POST['EventSubmit'])) {
        // Database connection
        $dbConnector = new DbConnector();
        $con = $dbConnector->getConnection();

        // Retrieve form data
        $eventName = $_POST['event_name'];
        $decoTypes = $_POST['decoType'];
        $decoPrices = $_POST['deco_price'];
        $decoPhotos = $_FILES['DecoPhotos'];

        // Initialize error array
        $errors = [];

        // Validate form data
        if (empty($eventName)) {
            $errors[] = "Event name is required.";
        }

        if (empty($decoTypes) || count($decoTypes) == 0) {
            $errors[] = "At least one decoration type is required.";
        }

        if (empty($decoPhotos['name'][0])) {
            $errors[] = "At least one decoration photo is required.";
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors; // Store errors in session
            header('Location: AddEvent.php'); // Redirect back to the form
            exit();
        }

        try {
            // Insert or get the event type ID
            $eventType = new EventTypes($eventName);
            $existingEventTypeId = $eventType->getEventNameById($con, $eventName);

            if ($existingEventTypeId) {
                $eventTypeId = $existingEventTypeId; // Use existing ID
            } else {
                $eventTypeId = $eventType->insertEvent($con); // Insert new event type if it doesn't exist
            }

            // Initialize arrays to store decoration options data
            $decorationNames = [];
            $decorationImages = [];

            // Process each decoration type and its image
            foreach ($decoTypes as $index => $decoType) {
                if (isset($decoPhotos['name'][$index]) && $decoPhotos['error'][$index] == 0) {
                    $targetDir = "../uploads/"; // Ensure this directory exists
                    $targetFile = $targetDir . basename($decoPhotos['name'][$index]);

                    // Move uploaded file to the target directory
                    if (move_uploaded_file($decoPhotos['tmp_name'][$index], $targetFile)) {
                        // Store decoration option data
                        $decorationNames[] = $decoType; // Collect decoration types
                        $decorationPrices[] = $decoPrices[$index]; // Collect decoration prices
                        $decorationImages[] = $targetFile; // Collect uploaded image paths
                    } else {
                        throw new Exception("Failed to move uploaded file for {$decoType}.");
                    }
                } else {
                    throw new Exception("Error uploading file for {$decoType}. Error code: " . $decoPhotos['error'][$index]);
                }
            }

            // Insert decoration options into the database using the new method
            \DecorationOptions::insertDecorationOptions($con, $eventTypeId, $decorationNames, $decorationImages, $decorationPrices);

            // Success
            $_SESSION['message'] = "Event and decoration types added successfully!";
            header("Location: ViewEvent.php");
            exit();
        } catch (Exception $e) {
            $_SESSION['errors'] = ["Error: " . $e->getMessage()];
            header('Location: AddEvent.php'); // Redirect back to the form
            exit();
        }
    }

    // Add cake
if (isset($_POST['cakeSubmit'])) {
    // Database connection
    $dbConnector = new DbConnector();
    $con = $dbConnector->getConnection();

    // Retrieve form data
    $cake_type = $_POST['cake_type'];
    $cake_size = $_POST['cake_size'];
    $cake_price = $_POST['cake_price'];

    // Initialize error array
    $errors = [];

    // Validate form data
    if (empty($cake_type) || empty($cake_size) || empty($cake_price)) {
        $errors[] = "All fields are required ";
    }

    // If there are errors, redirect back to the form with error messages
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header('Location: AddCake.php');
        exit();
    }

    try {
        // Insert cake options into the database
        
        CakeOptions::insertCakeType($con, $cake_size, $cake_type, $cake_price);

        // Success
        $_SESSION['message'] = "A new cake design added successfully!";
        header("Location: cake.php");
        exit();
    } catch (Exception $e) {
        // Catch any exceptions and store error messages
        $_SESSION['errors'] = ["Error: " . $e->getMessage()];
        header('Location: AddCake.php'); // Redirect back to the form
        exit();
    }
}

}
