<?php 
session_start();

require '../classes/DbConnector.php';
require '../classes/staff.php';

use classes\DbConnector;
use classes\staff;

$msg = "";

try {
    // Establish database connection
    $dbconnector = new DbConnector;
    $con = $dbconnector->getConnection();
} catch (PDOException $exc) {
    // Handle database connection error
    die("Error in DbConnection on LogIn_process file" . $exc->getMessage());
}

// Check if username and password are provided
if(isset($_POST['user_name'], $_POST['password'])){
    if(!empty($_POST['user_name']) || !empty($_POST['password'])){
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        // Create staff instance for authentication
        $staff = new staff(null, null, $user_name, $password, null, null, null, null);

        // Authenticate user
        if($staff->authenticate($con)){
            // Store user information in session
            $_SESSION['staff_id'] = $staff->getStaffId();
            $_SESSION['first_name'] = $staff->getFirstName();
            $_SESSION['last_name'] = $staff->getLastName();
            $_SESSION['user_name'] = $staff->getUserName();
            $_SESSION['role'] = $staff->getRole();
            $role = $staff->getRole();

            // Redirect user based on role
            switch($staff->getRole()) {
                case 'Staff':
                    header("Location: ./initialPage.php");
                    break;
                case 'Room Manager':
                    header("Location: ./Admin.php");
                    break;
                case 'Receptionist':
                    header("Location: ./Admin.php");
                    break;
                case 'Admin':
                    header("Location: ./Admin.php");
                    break;
                default:
                    header("Location: ../login.php");
            }
            // Exit to prevent further execution
            exit();
        }else{
            // Invalid username or password
            $_SESSION['msg'] = "Invalid username or password";
            header("Location: login.php");
            // $locattion = "login.php?status=1";
        }
    }else{
        // Required fields are empty
        $_SESSION['msg'] = "Required fields are empty";
        header("Location: login.php");
        // $locattion = "login.php?status=2";
    }
}else{
    // Data not received from the form
    $_SESSION['msg'] = "Data not received from the form";
    header("Location: login.php");
    // $locattion = "login.php?status=3";
}


// Exit to prevent further execution
exit(); 

?>