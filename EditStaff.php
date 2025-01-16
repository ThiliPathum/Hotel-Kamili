<?php
session_start();
require '../classes/DbConnector.php';
require '../classes/staff.php';

use classes\DbConnector;
use classes\staff;

$dbConnector = new DbConnector();
$con = $dbConnector->getConnection();

include('message.php');

if (!isset($_GET['staff_id']) || empty($_GET['staff_id'])) {
    die("Staff ID not provided.");
}

$staff_id = $_GET['staff_id'];

// Retrieve staff details from the database
$staffObj = new staff(null, null, null, null, null, null, null, null);
$staff = $staffObj->getStaffById($con, $staff_id);

if (!$staff) {
    die("Staff not found.");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>Update Staff</title>

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
    <div class="container mt-5 mb-5 w-75 p-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center" style="background-color: #8d437f; color: white;">
                <h4 class="m-0" style="padding: 5px;"><b>Update Staff</b></h4>
                <a href="Admin.php" class="btn-close" aria-label="Close"></a>
            </div>

            <div class="card-body">
                <?php if (isset($_SESSION['errors'])) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php foreach ($_SESSION['errors'] as $error) : ?>
                            <p><?php echo $error; ?></p>
                        <?php endforeach; ?>
                    </div>
                    <?php unset($_SESSION['errors']); ?>
                <?php endif; ?>

                <form action="EditProcess.php" method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="fname">First Name:</label>
                        <input type="text" id="fname" name="fname" class="form-control" required value="<?php echo htmlspecialchars($staff['firstname']); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="lname">Last Name:</label>
                        <input type="text" id="lname" name="lname" class="form-control" required value="<?php echo htmlspecialchars($staff['lastname']); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="nic">NIC Number:</label>
                        <input type="text" id="nic" name="nic" class="form-control" required value="<?php echo htmlspecialchars($staff['nic']); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="email">Email:</label>
                        <input type="text" id="email" name="email" class="form-control" required value="<?php echo htmlspecialchars($staff['email']); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="contact">Contact Number:</label>
                        <input type="text" id="contact" name="contact" class="form-control" required value="<?php echo htmlspecialchars($staff['contact_no']); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="role">Role:</label>
                        <select id="role" name="role" class="form-select" required>
                            <option value="Staff" <?php if ($staff['role'] === 'Staff') echo 'selected'; ?>>Staff</option>
                            <option value="Receptionist" <?php if ($staff['role'] === 'Receptionist') echo 'selected'; ?>>Receptionist</option>
                            <option value="Admin" <?php if ($staff['role'] === 'Admin') echo 'selected'; ?>>Admin</option>
                            <option value="Room Manager" <?php if ($staff['role'] === 'Room Manager') echo 'selected'; ?>>Room Manager</option>
                            <!-- <option value="None" <?php if ($staff['role'] === 'None') echo 'selected'; ?>>None</option> -->
                        </select>
                    </div>

                    <input type="hidden" name="staff_id" value="<?php echo $staff_id; ?>">

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="staffSubmit" style="background-color: #8d437f; border:none; width: 100%;">Update Staff</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>