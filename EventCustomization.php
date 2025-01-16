<?php
session_start();
require '../classes/DbConnector.php';
require '../classes/EventCustomization.php';

use classes\DbConnector;
use classes\EventCustomization;

// Initialize database connection
$dbConnector = new DbConnector();
$con = $dbConnector->getConnection();

// Fetch reservation ID from query parameters (assuming it's passed via URL)
$reservation_id = $_GET['reservation_id']; // Get the reservation ID from the query parameter

// Fetch event customization details by reservation ID
$customizations = \EventCustomization::getEventCustomizationByReservationId($con, $reservation_id);

// Display message if there is one
include('message.php');
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
    <title>Event Customization Details</title>

    <style>
        body {
            background-color: #f4f4f9;
        }

        .container {
            max-width: 800px;
            margin-top: 30px;
        }

        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.15);
            margin-bottom: 20px;
            background-color: #fff;
        }

        .card-header {
            background-color: #8d437f;
            color: white;
            padding: 20px;
            font-size: 1.5rem;
            border-radius: 12px 12px 0 0;
            text-align: center;
        }

        .detail-section {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 15px;
        }

        .detail-section div {
            flex: 0 0 48%;
            margin-bottom: 20px;
            background-color: #fafafa;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.05);
        }

        .detail-section div strong {
            display: block;
            color: #8d437f;
        }

        .no-event-message {
            text-align: center;
            font-size: 1.8rem;
            color: #8d437f;
            margin-top: 50px;
        }

        .section-divider {
            width: 100%;
            height: 1px;
            background-color: #eee;
            margin: 30px 0;
        }

        .btn-close {
            position: absolute;
            top: 10px;
            right: 15px;
            display: flex;
            color: white;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card">
            <div class="card-header">
            Event Customization Details - Reservation ID: <?php echo htmlspecialchars($customizations[0]['reservation_id']); ?>
 
                <a href="Admin.php">
                <button type="button" class="btn-close" aria-label="Close" style="color: white;"></button>
            </a>
            </div>

            <div class="card-body">
                <?php if (!empty($customizations)) { ?>
                    <div class="text-center mb-4">
                        <h4>Customization ID: <?php echo htmlspecialchars($customizations[0]['customization_id']); ?></h4>
                    </div>

                    <!-- Loop through each customization -->
                    <?php foreach ($customizations as $customization): ?>
                        <div class="detail-section">
                            <div>
                                <strong>Decoration ID</strong>
                                <?php echo htmlspecialchars($customization['selected_decoration_id']); ?>
                            </div>
                            <div>
                                <strong>Theme Color</strong>
                                <?php echo htmlspecialchars($customization['theme_color']); ?>
                            </div>
                            <div>
                                <strong>Cake Order</strong>
                                <?php echo htmlspecialchars($customization['cake_order']); ?>
                            </div>
                            <div>
                                <strong>Cake Weight (kg)</strong>
                                <?php echo htmlspecialchars($customization['cake_kg']); ?> kg
                            </div>
                            <div>
                                <strong>Cake Type ID</strong>
                                <?php echo htmlspecialchars($customization['cake_type_id']); ?>
                            </div>
                            <div>
                                <strong>Cake Message</strong>
                                <?php echo htmlspecialchars($customization['cake_message']); ?>
                            </div>
                            <div>
                                <strong>Cake Design</strong>
                                <img src="<?php echo htmlspecialchars($customization['cake_design']); ?>" alt="<?php echo htmlspecialchars($customization['cake_design']); ?>" class="img-fluid">
                            </div>
                            <div>
                                <strong>Suggestions</strong>
                                <?php echo htmlspecialchars($customization['suggestions']); ?>
                            </div>
                            <div>
                                <strong>Total Price</strong>
                                <?php echo htmlspecialchars($customization['total_customization_price']); ?>
                            </div>
                            <!-- <div>
                                <strong>Created At</strong>
                                // echo htmlspecialchars($customization['created_at']); ?>
                            </div>
                            <div>
                                <strong>Updated At</strong>
                                <?php //echo htmlspecialchars($customization['updated_at']); ?>
                            </div> -->
                        </div>

                    <?php endforeach; ?>
                <?php } else { ?>
                    <div class="no-event-message">
                        No customizations found for this event.
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Optional Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
