<?php
include 'config.php';

session_start();
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Asset Management System</title>
    <link rel="stylesheet" href="style.css?v=1.1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script media="print">
        .noprint {
            display: none;
        }
    </script>
    <link rel="icon" type="image/x-icon" href="white.png">
</head>

<body>
    <!-- create table that showing the list of assets in database -->
    <?php include 'nav.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Assets</h1>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Asset Tag</th>
                            <th>Brand</th>
                            <th>Model</th>
                            <th>Equipment Name</th>
                            <th>Serial Number</th>
                            <th>Status</th>
                            <th>Date Acquired</th>
                            <th>Location</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // include 'config.php';
                        $sql = "SELECT * FROM assets";
                        $result = $mysqli->query($sql);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                <td>" . $row["asset_tag"] . "</td>
                                <td>" . $row["brand"] . "</td>
                                <td>" . $row["model"] . "</td>
                                <td>" . $row["equipment_name"] . "</td>
                                <td>" . $row["serial_number"] . "</td>
                                <td>" . $row["status"] . "</td>
                                <td>" . $row["date_acquired"] . "</td>
                                <td>" . $row["location"] . "</td>
                                <td>
                                    <a href='update_asset.php?asset_id=" . $row["asset_tag"] . "' class='btn btn-sm btn-outline-secondary'>Edit</a>
                                    <a href='delete_asset.php?asset_id=" . $row["asset_tag"] . "' class='btn btn-sm btn-outline-secondary'>Delete</a>
                                </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='8'><center>No Data Avaliable</center></td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <input type="button" onclick="window.print()" value="Print Table (this button becomes invisible)" class="noprint"/>
                <a href="insert_asset.php" class="btn btn-primary noprint">Add Asset</a>
            </div>
        </div>