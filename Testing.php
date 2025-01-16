<?php

use classes\DbConnector;

require_once '../classes/DbConnector.php';
require_once '../classes/EventTypes.php';
require_once '../classes/EventCustomization.php';

try {
    // Establish database connection
    $dbConnector = new \classes\DbConnector();
    $con = $dbConnector->getConnection();
} catch (PDOException $exc) {
    // Handle database connection error
    die("Error in DbConnection on filtered_room file: " . $exc->getMessage());
}

$cus_id = 5;
echo $cus_id;
$event_type_id = EventCustomization::getEventTypeIdByCustomizationId($con, $cus_id);
echo $event_type_id;
$event_name = EventTypes::getEventNameById($con, $event_type_id);

echo $event_name;


?>