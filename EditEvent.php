<?php
session_start();

require '../classes/DbConnector.php';
require '../classes/EventTypes.php';
require '../classes/DecorationOptions.php';

use classes\DbConnector;

// Initialize database connection
$dbConnector = new DbConnector();
$con = $dbConnector->getConnection();

include('message.php');

if (!isset($_GET['event_type_id']) || empty($_GET['event_type_id'])) {
    die("Event ID not provided.");
}

$event_type_id = $_GET['event_type_id'];
$event = EventTypes::getEventNameById($con, $event_type_id);

if (!$event) {
    die("Event not found.");
}

$decorations = \DecorationOptions::getDecorationOptionsByEventTypeID($con, $event_type_id);

if (!$decorations) {
    die("Details not found");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Edit Event</title>
    <style>
        body {
            background-color: lightgray;
        }

        .container {
            max-width: 1000px;
            width: 100%;
            margin-top: 50px;
            margin-bottom: 50px;
        }

        .card {
            margin: 15px;
            box-shadow: 0 0 20px dimgray;
            border-radius: 10px;
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

        .decoration-image {
            max-height: 150px;
            object-fit: cover;
            border-radius: 10px;
            margin-top: 5px;
        }

        .btn-primary {
            background-color: #8d437f;
            border: none;
            color: white;
        }

        .btn-primary:hover {
            background-color: darkgrey;
            color: black;
        }

        .close-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 1.5em;
            color: white;
            text-decoration: none;
            transition: color 0.3s;
            display: flex;
        }

        .close-icon:hover {
            color: #663366;
        }

        .decoration-section {
            border: 1px solid darkgray; 
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #f8f9fa; /* Light background */
        }

        .decoration-heading {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 1.2rem;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card">
            <a href="ViewEvent.php" class="close-icon" aria-label="Close">
                <i class="fas fa-times"></i>
            </a>
            <div class="card-header">
                Edit Event: <b><?php echo htmlspecialchars($event); ?></b>
            </div>
            <div class="card-body">
                <form action="EditProcess.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="event_type_id" value="<?php echo htmlspecialchars($event_type_id); ?>">

                    <div class="mb-3">
                        <!-- <label for="event_name" class="form-label">Event Name</label> -->
                        <input type="hidden" id="event_name" name="event_name" value="<?php echo htmlspecialchars($event); ?>">

                    </div>

                    <div class="mb-3">
                        <!-- <label class="form-label">Decoration Types:</label> -->
                        <?php foreach ($decorations as $decoration): ?>
                            <div class="decoration-section">
                                <div class="decoration-heading">Decoration Type: <?php echo htmlspecialchars($decoration['decoration_name']); ?></div>
                                <input type="text" name="decoType[]" class="form-control mb-2" value="<?php echo htmlspecialchars($decoration['decoration_name']); ?>" required>
                                
                                <label class="form-label">Decoration Price:</label>
                                <input type="number" name="deco_price[]" class="form-control mb-2" value="<?php echo htmlspecialchars($decoration['decoration_price']); ?>" required>
                                
                                <label class="form-label">Decoration Image:</label>
                                <input type="file" name="DecoPhotos[]" class="form-control mb-2">
                                <small>Current Image: <img src="<?php echo htmlspecialchars($decoration['decoration_image']); ?>" alt="Decoration Image" class="decoration-image"></small>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button type="submit" class="btn btn-primary" name="EventSubmit">Update Event</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
