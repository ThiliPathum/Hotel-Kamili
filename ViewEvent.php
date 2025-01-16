<?php
session_start(); 

require '../classes/DbConnector.php';
require '../classes/EventTypes.php';
require '../classes/DecorationOptions.php';

use classes\DbConnector;

// Initialize database connection
$dbConnector = new DbConnector();
$con = $dbConnector->getConnection();

// Include message display
include('message.php');

// Fetch all event names and their decorations
$events = EventTypes::getAllEventType($con); 


// Handle deletion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteItemId'])) {
    $eventTypeId = $_POST['deleteItemId'];
    if (EventTypes::deleteEventType($con, $eventTypeId)) {
        $_SESSION['success'] = "Event deleted successfully.";
    } else {
        $_SESSION['error'] = "Failed to delete the event.";
    }
    header("Location: viewEvent.php"); // Redirect to the same page to avoid form resubmission
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Events Settings</title>

    <style>
        body {
            background-color: lightgray;
        }

        .container {
            max-width: 1400px;
            width: 100%;
        }

        .card {
            margin: 15px;
            box-shadow: 0 0 20px dimgray;
            border-radius: 10px;
        }

        .card-body img {
            max-height: 150px;
            object-fit: cover;
            margin: 5px;
            border-radius: 10px;
        }

        .event-images {
            display: flex;
            gap: 15px;
            align-items: center;
            flex-wrap: wrap;
            margin-top: 20px;
        }


        .close-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 2.0em;
            color: #8d437f;
            text-decoration: none;
            transition: color 0.3s;
        }

        .close-icon:hover {
            color: #663366;
        }

        .card-header {
            background-color: #8d437f;
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 15px;
            font-size: 1.25rem;
        }

        .card-body {
            padding: 20px;
        }

        .no-event-message {
            text-align: center;
            color: red;
            font-size: 1.5em;
            margin-top: 20px;
        }

        .edit-button {
            background-color: #8d437f;
            border: none;
            color: white;

        }

        .edit-button:hover {
            background-color: darkgrey;
            color: black;

        }

        .close-icon.delete {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 1.4em;
            color: black;
            text-decoration: none;
            transition: color 0.3s;
            display: flex;
        }

        .close-icon:hover {
            color: white;
        }
    </style>
</head>

<body>
    <a href="AddEvent.php" class="close-icon" aria-label="Close">
        <i class="fas fa-times"></i>
    </a>
    <div class="container mt-5 mb-5">
        <?php
        if (empty($events)) {
            echo '
    <div class="no-events-container" style="border: 1px solid #ccc; border-radius: 5px; padding: 20px; text-align: center; background-color: #f9f9f9; margin: 20px; color: #555;">
        <h2>No Events Found</h2>
        <p>It seems there are currently no events available. Please check back later.</p>
    </div>
    ';
            die;
        }
        ?>

        <?php include('message.php'); // Include message handling 
        ?>
       <div class="row">
    <?php foreach ($events as $event) :
        $event_name = $event['event_name'];
        $event_type_id = $event['event_type_id'];
        $decorations = \DecorationOptions::getDecorationOptionsByEventTypeID($con, $event_type_id);
    ?>
        <div class="col-md-6">
            <div class="card">
                <a href="#" class="close-icon delete" aria-label="Delete" onclick="DeleteProcess(<?php echo $event_type_id; ?>, 'event')">
                    <i class="fas fa-trash"></i>
                </a>

                <div class="card-header">
                    <h5 class="m-0"><?php echo htmlspecialchars($event_name); ?></h5>
                </div>
                <div class="card-body">

                    <div class="event-images">
                        <?php if (!empty($decorations)) : ?>
                            <?php foreach ($decorations as $decoration) : ?>
                                <div class="decoration-item mb-2">
                                <img src="<?php echo htmlspecialchars($decoration['decoration_image']); ?>" alt="<?php echo htmlspecialchars($decoration['decoration_name']); ?>" class="img-fluid">

                                    <p><strong><?php echo htmlspecialchars($decoration['decoration_name']); ?></strong><br>
                                        <?php echo htmlspecialchars('Price: ' . $decoration['decoration_price']); ?></p>
                                </div>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <p>No decorations available for this event.</p>
                        <?php endif; ?>
                    </div>

                    <div class="text-end mt-3">
                        <a href="EditEvent.php?event_type_id=<?php echo $event_type_id; ?>" class="btn btn-warning edit-button">
                            Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

    </div>

    <!-- Optional Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        function DeleteProcess(itemId, itemType) {
            if (confirm("Are you sure you want to delete this " + itemType + "?")) {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = 'viewEvent.php'; // Point to the same file

                var inputId = document.createElement('input');
                inputId.type = 'hidden';
                inputId.name = 'deleteItemId';
                inputId.value = itemId;

                form.appendChild(inputId);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
</body>

</html>