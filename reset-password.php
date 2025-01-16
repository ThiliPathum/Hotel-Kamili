<?php

use classes\staff;

require './classes/DbConnector.php';
require './classes/staff.php';

try {
    // Establish database connection
    $dbconnector = new classes\DbConnector();
    $dbcon = $dbconnector->getConnection();
} catch (PDOException $exc) {
    // Handle database connection error
    die("Error in DbConnection on reset-password file" . $exc->getMessage());
}

$token = $_GET["token"];

$token_hash = hash("sha256", $token);

// Create staff instance for authentication
$staff = new staff(null, null, null, null, null, null, null, null);

$staffDetailsByToken = $staff->getAllStaffDetailsByToken($dbcon, $token_hash);

if ($staffDetailsByToken === false) {
    die("token not found");
}

// Check if token has expired
if (strtotime($staffDetailsByToken["reset_token_expires_at"]) <= time()) {
    die("token has expired");
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>

    <h1>Reset Password</h1>

    <form method="post" action="process-reset-password.php">

        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

        <label for="password">New password</label>
        <input type="password" id="password" name="password" required>

        <label for="password_confirmation">Repeat password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>

        <button>Send</button>
    </form>

</body>
</html>
