<?php
session_start();

// Check if user is logged in via session or cookies
if (!isset($_SESSION['username']) && (!isset($_COOKIE['logged_in']) || $_COOKIE['logged_in'] !== 'true')) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit;
}

require_once('../view/homepage.php'); // Template (if necessary)
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Registration</title>
    <link rel="stylesheet" href="../css/vehicleReg.css">
    <script src="../js/vehicleReg.js"></script>
</head>
<body>
    <h1>Bangladesh Vehicle Registration</h1>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>!</p>
    <form>
        <table>
            <tr>
                <th>Select City:</th>
                <td>
                    <select id="city" name="city" required>
                        <option value="">Select</option>
                        <option value="DHAKA">DHAKA</option>
                        <option value="CHITTAGONG">CHITTAGONG</option>
                        <option value="KHULNA">KHULNA</option>
                        <option value="SYLHET">SYLHET</option>
                        <option value="BARISAL">BARISAL</option>
                        <option value="RAJSHAHI">RAJSHAHI</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th>Enter Vehicle Class:</th>
                <td><input type="text" id="vehicleClass" name="vehicleClass" maxlength="1" required></td>
            </tr>
            <tr>
                <th>Enter Registration Series:</th>
                <td><input type="number" id="series" name="series" min="1" max="99" required></td>
            </tr>
            <tr>
                <th>Enter Vehicle Number:</th>
                <td><input type="number" id="vehicleNumber" name="vehicleNumber" min="1" max="9999" required></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="button" id="submitBtn" value="Register" onclick="submitVehicleReg()">
                </td>
            </tr>
            <tr><td><p id="msg"></p></td></tr>
        </table>
    </form>
    <p><a href="../controller/logout.php">Logout</a></p>
</body>
</html>
