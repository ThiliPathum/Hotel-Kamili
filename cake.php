<?php
session_start();
require '../classes/DbConnector.php';
require '../classes/CakeOptions.php';

use classes\DbConnector;
use classes\CakeOptions;

// Initialize database connection
$dbConnector = new DbConnector();
$con = $dbConnector->getConnection();

// Create an instance of the CakeOptions class
$cakeOptions = new CakeOptions($con, $cake_size, $cake_type, $cake_price);

// Fetch cake details
$cakeDetails = $cakeOptions->getAllCakeOptions($con);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deleteItemId'])) {
    var_dump($_POST['deleteItemId']); // Debug to check if the ID is being received
    $cake_option_id = $_POST['deleteItemId'];

    if ($cakeOptions->deleteCake($con, $cake_option_id)) {
        $_SESSION['message'] = "Cake option deleted successfully!";
    } else {
        $_SESSION['message'] = "Failed to delete the cake option.";
    }

    header("Location: cake.php");
    exit();
}


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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Cake Options</title>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 1200px;
        }

        .card {
            margin-bottom: 20px;
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
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

        .event-images {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .event-images img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .hidden-input {
            display: none;
        }

        .btn-close-custom {
            background-color: #8d437f;
            color: white;
            border: none;
            padding: 8px 16px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .btn-close-custom:hover {
            background-color: #663366;
            color: white;
        }

        .table {
            margin-top: 20px;
        }

        .table th {
            background-color: #cebcca;
            color: black;
        }

        .table td {
            vertical-align: middle;
        }

        .no-event-message {
            text-align: center;
            margin: 50px 0;
            font-size: 1.5rem;
            color: #8d437f;
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

        .edit-button {
            background-color: #8d437f;
            border: none;
            color: white;

        }

        .edit-button:hover {
            background-color: darkgrey;
            color: black;

        }

        a.delete {
            display: inline-block;
            color: black;
            font-size: 1.2em;
            text-decoration: none;
        }

        a.delete i {
            vertical-align: middle;
        }

        a.delete:hover {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container mt-5 mb-5">
        <?php if (!empty($cakeDetails)) { ?>
            <div class="card">
                <a href="AddEvent.php" class="close-icon" aria-label="Close">
                    <i class="fas fa-times"></i>
                </a>
                <div class="card-header">
                    <b>Cake Option</b>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Cake Design</th>
                                    <th>Weight</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cakeDetails as $cake) : ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($cake['cake_type']); ?></td>
                                        <td><?php echo htmlspecialchars($cake['cake_size']); ?></td>
                                        <td><?php echo htmlspecialchars($cake['cake_price']); ?></td>
                                        <td>
                                            <a href="#" class="delete" aria-label="Delete" onclick="DeleteCake(<?php echo $cake['cake_option_id']; ?>, 'cake')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="text-end mt-3">
                            <a href="AddCake.php" class="btn btn-success edit-button">Add</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php } else { ?>
            <div class="no-event-message">Currently no event available</div>
        <?php } ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function DeleteCake(itemId, itemType) {
            if (confirm("Are you sure you want to delete this " + itemType + "?")) {
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = 'cake.php';

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
