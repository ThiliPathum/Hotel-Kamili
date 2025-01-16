<?php
session_start();
require '../classes/DbConnector.php';

use classes\DbConnector;

// Initialize database connection
$dbConnector = new DbConnector();
$con = $dbConnector->getConnection();

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
    <title>Event Settings</title>

    <style>
        body {
            background-color: lightgrey;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .main-container {
            max-width: 900px;
            width: 100%;
        }

        .card {
            box-shadow: 0 0 20px dimgray;
            border-radius: 10px;
        }

        .form-control {
            margin-bottom: 10px;
        }

        .event-options {
            text-align: right;
        }

        .btn-close {
            position: absolute;
            top: 10px;
            right: 15px;
        }

        .action-buttons {
            margin-bottom: 20px;
        }

        .action-buttons a {
            text-decoration: none;
        }

        .action-buttons .btn {
            margin-right: 10px;
            background-color: #8d437f;
            color: white;
            border: none;
        }

        .action-buttons .btn:hover {
            color: white;
            background-color: black;
        }

        .content-section {
            margin-top: 20px;
        }

        .event-card {
            margin-bottom: 30px;
        }

        .header-card {
            background-color: #8d437f;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            font-size: 1.5rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .card-header {
            position: relative;
            background-color: #cebcca;
            font-weight: bold;
            font-size: 1.2rem;
        }

        #view-events,
        #view-cakes,
        #submit-event {
            background-color: #8d437f;
            color: white;
        }

        #view-events:hover,
        #view-cakes:hover,
        #submit-event:hover {
            background-color: white;
            color: #8d437f;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <div class="row">


            <!-- Add Event Form Section -->
            <div class="col-12 content-section">
                <div class="add-event-form card event-card">
                    <div class="card-header">
                        <h4 class="m-0">Add Cake</h4>
                        <a href="cake.php">
                            <button type="button" class="btn-close" aria-label="Close"></button>
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="AddProcess.php" method="POST" enctype="multipart/form-data">

                            <!-- Decoration Types Section -->
                            <div class="mb-3">
                                <label for="CakeType">Cake Designs</label>
                                <div id="cakeTypesSection">
                                    <div class="d-flex align-items-center mb-2">
                                        <input type="text" name="cake_type[]" class="form-control" placeholder="Design" required>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="text" name="cake_size[]" class="form-control" placeholder="Weight (Do not use decimal)" required>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input type="number" name="cake_price[]" class="form-control" placeholder="Price" required>

                                    </div>
                                </div>
                                <button type="button" class="btn btn-link text-decoration-none" onclick="addCakeType()">Add Cake Design</button>
                            </div>

                            <div class="event-options text-end mt-3">
                                <button type="submit" name="cakeSubmit" class="btn btn-success" id="submit-event">Add Cake</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Optional Bootstrap JS -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

            <!-- JavaScript for Adding Dynamic Fields -->
            <script>
                function addCakeType() {
                    const section = document.getElementById('cakeTypesSection');
                    const div = document.createElement('div');
                    div.classList.add('d-flex', 'align-items-center', 'mb-2');
                    div.innerHTML = `
                <input type="text" name="cakeType[]" class="form-control" placeholder="Design" required>&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="text" name="cake_size[]" class="form-control" placeholder="Weight" required>&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="number" name="cake_price[]" class="form-control" placeholder="Price" required>
            `;
                    section.appendChild(div);
                }
            </script>
</body>

</html>