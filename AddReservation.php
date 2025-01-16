<?php
session_start();
include('message.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Add Reservation</title>
    <style>
        body {
            /* background-image: url(images/image1.jpeg); */
            background-color: lightgray;
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            opacity: 0.9;
        }

        .card{
            box-shadow: 0 0 20px dimgray;
        }

        label {
            font-weight: 600;
        }

        .form-step {
            display: none;
        }

        .form-step-active {
            display: block;
        }
    </style>
</head>

<body>
    <div class="addroom-container">
        <div class="container mt-5 mb-5 w-75 p-3">
            <?php include('message.php'); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center" style=" background-color:#8d437f;">
                            <h4 class="m-0" style="padding: 5px; color: white"><b>Add a Reservation</b></h4>
                            <a href="Admin.php">
                                <button type="button" class="btn-close" aria-label="Close"></button>
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="ddProcess.php"A method="POST" enctype="multipart/form-data">
                                <!-- Customer Details Form -->
                                <div class="form-step form-step-active" id="step-1">
                                    <h5 style="color:grey">Personal Information</h5>
                                    <hr>
                                    <div class="mb-3">
                                        <label for="name">Full Name:</label>
                                        <input type="text" id="fullname" name="fullname" class="form-control" placeholder="Eg: Michal Perera" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="email">Email:</label>
                                        <input type="email" id="email" name="email" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="contact">Telephone:</label>
                                        <input type="text" id="contact" name="contact" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="address">Address:</label>
                                        <input type="text" id="address" name="address" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="country">Country:</label>
                                        <input type="text" id="country" name="country" class="form-control" required>
                                    </div>
                                    <div class="mb-3" style="display: flex; justify-content: flex-end;">
                                        <button type="button" class="btn btn-primary" style="background-color: #8d437f; border:none;" onclick="nextStep()">Next</button>
                                    </div>
                                </div>

                                <!-- Reservation Details Form -->
                                <div class="form-step" id="step-2">
                                    <h5 style="color:grey">Reservation Information</h5>
                                    <hr>

                                    <!-- <div class="mb-3">
                                        <label for="room">Room Type:</label>
                                        <select id="room" name="room" class="form-select" required>
                                            <option value="Deluxe">Deluxe</option>
                                            <option value="Superior">Superior</option>
                                        </select>
                                    </div> -->
                                    <div class="mb-3">
                                        <label for="room_id">Room Id:</label>
                                        <input type="number" id="room_id" name="room_id" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="check_in_date">Check In Date:</label>
                                        <input type="date" id="check_in_date" name="check_in_date" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="check_out_date">Check Out Date:</label>
                                        <input type="date" id="check_out_date" name="check_out_date" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="number_of_adult">Number of Adults:</label>
                                        <input type="text" id="number_of_adult" name="number_of_adult" class="form-control">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="number_of_children">Number of Children:</label>
                                        <input type="text" id="number_of_children" name="number_of_children" class="form-control">
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="number_of_room">Number of Rooms:</label>
                                        <input type="text" id="number_of_room" name="number_of_room" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="total_price">Total Amount:</label>
                                        <input type="text" id="total_price" name="total_price" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="payment_status">Payment Status:</label>
                                        <select id="payment_status" name="payment_status" class="form-select" required>
                                            <option value="Completed">Completed</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Failed">Failed</option>
                                        </select>
                                    </div>
                                

                                    <div class="mb-3" style="display: flex; justify-content: flex-end;">
                                        <button type="button" class="btn btn-primary" style="background-color: #8d437f; border:none; margin-right: 10px;" onclick="previousStep()">Previous</button>
                                        <button type="submit" class="btn btn-primary" name="ReservationSubmit" style="background-color: #8d437f; border:none;">Add Reservation</button>
                                        <!-- <button type="button" class="btn btn-primary" style="background-color: #8d437f; border:none;" onclick="nextStep()">Next</button> -->
                                    </div>
                                </div>

                                <!-- Customization Details Form -->
                                <!-- <div class="form-step" id="step-3">
                                    <h5 style="color:grey">Customization Information</h5>
                                    <hr>

                                    <div class="mb-3">
                                        <label for="event">Custom Event:</label>
                                        <select id="event" name="event" class="form-select" required>
                                            <option value="Birthday">Birthday</option>
                                            <option value="Anniversary">Anniversary</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="reference_image">Reference Image:</label>
                                        <input type="file" id="reference_image" name="reference_image" class="form-control">
                                    </div>

                                    <div class="mb-3">
                                        <label for="total_price">Total Amount:</label>
                                        <input type="text" id="total_price" name="total_price" class="form-control">
                                    </div>
                                    <div class="mb-3">
                                        <label for="payment_status">Payment Status:</label>
                                        <select id="payment_status" name="payment_status" class="form-select" required>
                                            <option value="Completed">Completed</option>
                                            <option value="Pending">Pending</option>
                                            <option value="Failed">Failed</option>
                                        </select>
                                    </div>

                                    <div class="mb-3" style="display: flex; justify-content: flex-end;">
                                        <button type="button" class="btn btn-primary" style="background-color: #8d437f; border:none; margin-right: 10px;" onclick="previousStep()">Previous</button>
                                        <button type="submit" class="btn btn-primary" name="ReservationSubmit" style="background-color: #8d437f; border:none;">Add Reservation</button>
                                    </div>
                                </div>
                            </form> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function nextStep() {
            const currentStep = document.querySelector('.form-step-active');
            const nextStep = currentStep.nextElementSibling;
            if (nextStep) {
                currentStep.classList.remove('form-step-active');
                nextStep.classList.add('form-step-active');
            }
        }

        function previousStep() {
            const currentStep = document.querySelector('.form-step-active');
            const previousStep = currentStep.previousElementSibling;
            if (previousStep) {
                currentStep.classList.remove('form-step-active');
                previousStep.classList.add('form-step-active');
            }
        }
    </script>
</body>

</html>