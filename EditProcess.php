<?php
session_start();
require '../classes/DbConnector.php';
require '../classes/staff.php';
require '../classes/room.php';
require '../classes/Reservation.php';
require '../classes/EventTypes.php';
require '../classes/DecorationOptions.php';

use classes\DbConnector;
use classes\staff;
use classes\Room;

$dbConnector = new DbConnector();
$con = $dbConnector->getConnection();

include('message.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Staff Update Logic
    if (isset($_POST['staffSubmit'])) {
        $staff_id = $_POST['staff_id'];
        $first_name = $_POST['fname'];
        $last_name = $_POST['lname'];
        $nic_no = $_POST['nic'];
        $email = $_POST['email'];
        $contact_no = $_POST['contact'];
        $role = $_POST['role'];

        // Error handling
        $errors = [];

        if (empty($first_name) || empty($last_name) || empty($nic_no) || empty($email) || empty($contact_no) || empty($role)) {
            $errors[] = "All fields are required.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header("Location: EditStaff.php?staff_id=$staff_id");
            exit();
        } else {
            $staffObj = new staff(null, null, null, null, null, null, null, null);

            $updated = $staffObj->updateStaff($con, $staff_id, $first_name, $last_name, $nic_no, $email, $contact_no, $role);

            if ($updated) {
                $_SESSION['message'] = "Staff details updated successfully!";
            } else {
                $_SESSION['errors'] = ["Failed to update staff details."];
            }

            header("Location: EditStaff.php?staff_id=$staff_id");
            exit();
        }
    }

    // Room Update Logic

    if (isset($_POST['roomSubmit'])) {
        $dbConnector = new DbConnector();
        $con = $dbConnector->getConnection();

        $room_id = $_POST['room_id'];

        $room = Room::getRoomById($con, $room_id);

        if (!$room) {
            $_SESSION['errors'] = ["Room not found."];
            header("Location: Admin.php");
            exit();
        }

        $roomType = $_POST['roomType'];
        $adultCount = $_POST['adultCount'];
        $childrenCount = $_POST['childrenCount'];
        $pricePerNight = $_POST['pricePerNight'];
        $room_description = $_POST['roomDescription'];
        $number_of_rooms = $_POST['numberOfRooms'];

        // Error handling
        $errors = [];

        // Validate that all fields are provided and are valid
        if (empty($roomType)) {
            $errors[] = "Room type is required.";
        }
        if ($adultCount === '' || $adultCount < 0) {
            $errors[] = "Adult count is required and must be non-negative.";
        }
        if ($childrenCount === '' || $childrenCount < 0) {
            $errors[] = "Children count is required and must be non-negative.";
        }
        if ($pricePerNight === '' || $pricePerNight < 0) {
            $errors[] = "Price per night is required and must be non-negative.";
        }
        if (empty($room_description)) {
            $errors[] = "Room description is required.";
        }
        if ($number_of_rooms === '' || $number_of_rooms < 0) {
            $errors[] = "Number of rooms is required and must be non-negative.";
        }

        // If there are errors, redirect back with errors
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            header("Location: EditRoom.php?room_id=$room_id");
            exit();
        }

        // Handle file uploads
        $room_inside_normal_image = !empty($_FILES['roomInsideNormalImage']['name']) ? 'uploads/' . basename($_FILES['roomInsideNormalImage']['name']) : $room->getRoomInsideNormalImage();
        $room_inside_360view_image = !empty($_FILES['roomInside360ViewImage']['name']) ? 'uploads/' . basename($_FILES['roomInside360ViewImage']['name']) : $room->getRoomInside360ViewImage();
        $room_bathroom_360view_image = !empty($_FILES['roomBathroom360ViewImage']['name']) ? 'uploads/' . basename($_FILES['roomBathroom360ViewImage']['name']) : $room->getRoomBathroom360ViewImage();
        $room_outdoor_360view_image = !empty($_FILES['roomOutdoor360ViewImage']['name']) ? 'uploads/' . basename($_FILES['roomOutdoor360ViewImage']['name']) : $room->getRoomOutdoor360ViewImage();

        if (!empty($_FILES['roomInsideNormalImage']['name'])) {
            move_uploaded_file($_FILES['roomInsideNormalImage']['tmp_name'], $room_inside_normal_image);
        }
        if (!empty($_FILES['roomInside360ViewImage']['name'])) {
            move_uploaded_file($_FILES['roomInside360ViewImage']['tmp_name'], $room_inside_360view_image);
        }
        if (!empty($_FILES['roomBathroom360ViewImage']['name'])) {
            move_uploaded_file($_FILES['roomBathroom360ViewImage']['tmp_name'], $room_bathroom_360view_image);
        }
        if (!empty($_FILES['roomOutdoor360ViewImage']['name'])) {
            move_uploaded_file($_FILES['roomOutdoor360ViewImage']['tmp_name'], $room_outdoor_360view_image);
        }

        // Proceed with the update if there are no errors
        $updated = $room->update($con, $room_id, $roomType, $adultCount, $childrenCount, $pricePerNight, $room_description, $number_of_rooms, $room_inside_normal_image, $room_inside_360view_image, $room_bathroom_360view_image, $room_outdoor_360view_image);

        if ($updated) {
            $_SESSION['message'] = "Room is Successfully Updated!";
        } else {
            $_SESSION['errors'][] = "Something Went Wrong!";
        }

        header("Location: EditRoom.php?room_id=$room_id");
        exit();
    }

    // Edit Event

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Event Update Logic
        if (isset($_POST['EventEdit'])) {
            $event_id = $_POST['event_id'];
            $event_name = $_POST['event_name'];
            $decoTypes = $_POST['decoType'];
            $decoPrices = $_POST['deco_price'];
            $decoImages = $_FILES['DecoPhotos'];
    
            // Error handling
            $errors = [];
    
            if (empty($event_name)) {
                $errors[] = "Event name is required.";
            }
    
            if (empty($decoTypes) || !is_array($decoTypes) || count($decoTypes) === 0) {
                $errors[] = "At least one decoration type is required.";
            }
    
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: EditEvent.php?event_id=$event_id");
                exit();
            } else {
                // Update event name
                $eventObj = new EventTypes($con);
                $updatedEvent = $eventObj->updateEvent($con, $event_type_id, $deco_types, $deco_price, $image_paths);
    
                // Handle decorations (Add/Edit/Remove)
                $decorationObj = new \DecorationOptions($con, $decoration_name, $decoration_image, $decoration_price);
    
                foreach ($decoTypes as $index => $decoType) {
                    $decoPrice = $decoPrices[$index];
                    $decoImage = !empty($decoImages['name'][$index]) ? 'uploads/' . basename($decoImages['name'][$index]) : '';
    
                    // Upload image if provided
                    if (!empty($decoImages['name'][$index])) {
                        move_uploaded_file($decoImages['tmp_name'][$index], $decoImage);
                    }
 
                }
    
                if ($updatedEvent) {
                    $_SESSION['message'] = "Event details updated successfully!";
                } else {
                    $_SESSION['errors'] = ["Failed to update event details."];
                }
    
                header("Location: EditEvent.php?event_id=$event_id");
                exit();
            }
        }
    }
    
    
}