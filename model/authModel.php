<?php
require_once('database.php');

function saveVehicleRegistration($city, $vehicleClass, $series, $vehicleNumber) {
    $conn = getConnection();
    $sql = "INSERT INTO vehicle_registration (city, vehicle_class, series, vehicle_number) 
            VALUES ('$city', '$vehicleClass', '$series', '$vehicleNumber')";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function authenticateUser($username, $password) {
    echo "authenticateUser function called.<br>";
    $conn = getConnection();
    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        echo "User found in database.<br>";
        if (password_verify($password, $row['password'])) {
            echo "Password verified successfully.<br>";
            return true;
        } else {
            echo "Incorrect password.<br>";
        }
    } else {
        echo "User not found in database.<br>";
    }
    return false;
}


function registerUser($username, $password, $email, $mobile, $address) {
    $conn = getConnection();
    $sql = "INSERT INTO users (username, password, email, mobile, address) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssss', $username, $password, $email, $mobile, $address);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $result;
}

function getTaxTokenApplication($applicationID) {
    $conn = getConnection();
    $sql = "SELECT * FROM tax_tokens WHERE id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $applicationID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $row;
    } else {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return false;
    }
}

function savePaymentDetails($applicationID, $paymentMethod, $bankName, $mobileService, $transactionID) {
    $conn = getConnection();
    $sql = "INSERT INTO payments (application_id, payment_method, bank_name, mobile_service, transaction_id) 
            VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'issss', $applicationID, $paymentMethod, $bankName, $mobileService, $transactionID);
    $result = mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return $result;
}


function getPaymentDetails($transactionID) {
    $conn = getConnection();
    $sql = "SELECT * FROM payments WHERE transaction_id = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 's', $transactionID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $row;
    } else {
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return false;
    }
}

function saveTaxTokenApplication($permitType, $regNumber, $chassisNumber, $fullName, $licenseNumber, $permitFilePath, $inspectionFilePath) {
    $conn = getConnection(); // Ensure the database connection function is working
    $sql = "INSERT INTO tax_tokens (permit_type, reg_number, chassis_number, full_name, license_number, permit_file, inspection_certificate) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'sssssss', $permitType, $regNumber, $chassisNumber, $fullName, $licenseNumber, $permitFilePath, $inspectionFilePath);

    if (mysqli_stmt_execute($stmt)) {
        $applicationID = mysqli_insert_id($conn); // Get the last inserted ID
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return $applicationID; // Return the ID
    } else {
        error_log("MySQL Error: " . mysqli_error($conn));
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
        return false;
    }
}



?>
