<?php
session_start();
require_once('../model/authModel.php');

// Check if the user is logged in
if (!isset($_SESSION['username']) && (!isset($_COOKIE['logged_in']) || $_COOKIE['logged_in'] !== 'true')) {
    echo "Unauthorized access.";
    exit;
}

if (isset($_POST['vehicleData'])) {
    $data = json_decode($_POST['vehicleData'], true);

    if (json_last_error() === JSON_ERROR_NONE) {
        $city = $data['city'];
        $vehicleClass = $data['vehicleClass'];
        $series = $data['series'];
        $vehicleNumber = $data['vehicleNumber'];

        $result = saveVehicleRegistration($city, $vehicleClass, $series, $vehicleNumber);
        if ($result) {
            echo "Vehicle registration successful.";
        } else {
            echo "Failed to register vehicle.";
        }
    } else {
        echo "Invalid data received.";
    }
} else {
    echo "No data received.";
}
?>
