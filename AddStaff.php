<?php
session_start();
include('message.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Add Staff</title>
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
    </style>
</head>
<body>
    <div class="addroom-container">
        <div class="container mt-5 mb-5 w-75 p-3 .h-25">
            <?php include('message.php'); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center" style=" background-color:#8d437f;">
                            <h4 class="m-0" style="padding: 5px; color: white"><b>Add Staff</b></h4>
                            <a href="Admin.php">
                                <button type="button" class="btn-close" aria-label="Close"></button>
                            </a>
                        </div>
                        <div class="card-body">
                            <form action="AddProcess.php" method="POST" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="fname">Firstname:</label>
                                    <input type="text" id="fname" name="fname" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label for="lname">Lastname:</label>
                                    <input type="text" id="lname" name="lname" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="uname">Username:</label>
                                    <input type="text" id="uname" name="uname" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="pwd">Password:</label>
                                    <input type="password" id="pwd" name="pwd" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="NIC">NIC Number:</label>
                                    <input type="text" id="nic" name="nic" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="Email">Email:</label>
                                    <input type="email" id="email" name="email" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="contact">Contact Number:</label>
                                    <input type="text" id="contact" name="contact" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="role">Role:</label>
                                    <select id="role" name="role" class="form-select" required>
                                        <option value="Staff">Staff</option>
                                        <option value="Receptionist">Receptionist</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Room Manager">Room Manager</option>
                                        <option value="None">None</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <button type="submit" class="btn btn-primary" name="staffSubmit" style="background-color: #8d437f; border:none; width: 100%;">Add Staff</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>