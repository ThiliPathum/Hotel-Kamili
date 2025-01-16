<?php

require_once '../classes/DbConnector.php';
require_once '../classes/EventCustomization.php';


try {
  // Establish database connection
  $dbConnector = new \classes\DbConnector();
  $con = $dbConnector->getConnection();
} catch (PDOException $exc) {
  // Handle database connection error
  die("Error in DbConnection on filtered_room file: " . $exc->getMessage());
}



if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get customization IDs and statuses from the form
    $customization_ids = $_POST['customization_id'];
    $statuses = $_POST['status'];

    // Loop through each customization_id and update its status
    foreach ($customization_ids as $index => $customization_id) {
        $status = $statuses[$index];

        // Call the function to update the status
        $result = EventCustomization::updateEventStatusByCustomizationId($con, $customization_id, $status);

        if (!$result) {
            echo "Error updating status for customization ID: " . $customization_id;
        }
    }

    // Redirect to a success page or show a success message
    header("Location: admin.php?success=1");
    exit;
}