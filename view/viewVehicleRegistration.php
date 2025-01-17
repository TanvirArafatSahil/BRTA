<?php
require_once('../model/authModel.php');

// Fetch vehicle registration data
$data = getAllVehicleRegistrations();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Registrations</title>
    <link rel="stylesheet" href="../css/viewVehicleRegistration.css">
</head>
<body>
    <header>
        <h1>Vehicle Registrations</h1>
    </header>
    <main>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>City</th>
                    <th>Vehicle Class</th>
                    <th>Series</th>
                    <th>Vehicle Number</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data)): ?>
                    <?php foreach ($data as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['city']); ?></td>
                            <td><?php echo htmlspecialchars($row['vehicle_class']); ?></td>
                            <td><?php echo htmlspecialchars($row['series']); ?></td>
                            <td><?php echo htmlspecialchars($row['vehicle_number']); ?></td>
                            <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No data available</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </main>
</body>
</html>
