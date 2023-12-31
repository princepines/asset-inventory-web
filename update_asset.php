<?php
include 'config.php';
session_start();

if (!isset($_SESSION['loggedin'])) {
	header('Location: login.php');
	exit;
}

if ($_SESSION['account_type'] !== "admin" && $_SESSION['account_type'] !== "superadmin") {
    header('Location: 404.php');
}

// show results from database using the url parameter
$query = "SELECT * FROM assets WHERE asset_tag = ?";
if ($stmt = $mysqli->prepare($query)) {
    $stmt->bind_param("s", $_GET['asset_tag']);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}


// parse update data to mysql
if (isset($_POST['submit'])) {

    $sql = "UPDATE assets SET brand=?, model=?, serial_number=?, asset_type=?, status=?, equipment_name=?, location_asset=?, price_value=?, date_acquired=?, remarks=?, user_id=?, updated_at=? WHERE asset_tag = '" . $_POST['asset_tag'] . "' ";
    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("ssssssssssss", $brand, $model, $serial_number, $asset_type, $status, $equipment_name, $location_asset, $price_value, $date_acquired, $remarks, $user_id, $updated_at);

        $brand =  $_POST['brand'];
        $model =  $_POST['model'];
        $serial_number =  $_POST['serial_number'];
        $asset_tag =  $_POST['asset_tag'];
        $asset_type =  $_POST['asset_type'];
        $status =  $_POST['status'];
        $equipment_name =  $_POST['equipment_name'];
        $location_asset =  $_POST['location_asset'];
        $price_value =  $_POST['price_value'];
        $date_acquired =  $_POST['date_acquired'];
        $remarks =  $_POST['remarks'];
        $user_id = $_SESSION['id'];
        $updated_at = date("Y-m-d H:i:s");

        if ($stmt->execute()) {
            header('Location: assets.php');
            echo "<script>alert('The Asset has been sucessfully updated.')</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again!')</script>";
        }
    }
    $stmt->close();
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
    <link rel="icon" type="image/x-icon" href="white.png">
</head>

<body>
    <?php include 'nav.php'; ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Update Asset</h1>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="off">
                    <label for="asset_type">Asset Type</label>
                    <select name="asset_type" id="asset_type" class="form-control">
                        <option value="Office Equipment"
                            <?php if ($row['asset_type'] === 'Office Equipment') echo 'selected'; ?>>Office Equipment
                        </option>
                        <option value="Furnitures and Fixtures"
                            <?php if ($row['asset_type'] === 'Furnitures and Fixtures') echo 'selected'; ?>>Furnitures
                            and
                            Fixtures</option>
                        <option value="Aircon Equipment"
                            <?php if ($row['asset_type'] === 'Aircon Equipment') echo 'selected'; ?>>Aircon Equipment
                        </option>
                    </select>
                    <br>
                    <label for="brand">Brand</label>
                    <input type="text" name="brand" id="brand" class="form-control" value="<?php echo htmlspecialchars($row['brand']); ?>">
                    <br>
                    <label for="model">Model</label>
                    <input type="text" name="model" id="model" class="form-control" value="<?php echo htmlspecialchars($row['model']); ?>">
                    <br>
                    <label for="serial_number">Serial Number</label>
                    <input type="text" name="serial_number" id="serial_number" class="form-control" value="<?php echo htmlspecialchars($row['serial_number']); ?>">
                    <br>
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="In Use" <?php if ($row['status'] === 'In Use') echo 'selected'; ?>>In Use
                        </option>
                        <option value="In Storage" <?php if ($row['status'] === 'In Storage') echo 'selected'; ?>>In
                            Storage</option>
                        <option value="For Repair" <?php if ($row['status'] === 'For Repair') echo 'selected'; ?>>For
                            Repair
                        </option>
                        <option value="For Disposal" <?php if ($row['status'] === 'For Disposal') echo 'selected'; ?>>
                            For
                            Disposal</option>
                    </select>
                    <br>
                    <label for="equipment_name">Equipment Name</label>
                    <input type="text" name="equipment_name" id="equipment_name" class="form-control" value="<?php echo htmlspecialchars($row['equipment_name']); ?>">
                    <br>
                    <label for="location_asset">Location</label>
                    <input type="text" name="location_asset" id="location_asset" class="form-control" value="<?php echo htmlspecialchars($row['location_asset']); ?>">
                    <br>
                    <label for="price_value">Price Value</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">₱</span>
                        </div>
                        <input type="text" name="price_value" id="price_value" class="form-control" value="<?php echo htmlspecialchars($row['price_value']); ?>">
                    </div>
                    <br>
                    <label for="date_acquired">Date Acquired</label>
                    <input type="text" name="date_acquired" id="date_acquired" class="form-control" value="<?php echo htmlspecialchars($row['date_acquired']); ?>">
                    <br>
                    <label for="remarks">Remarks</label>
                    <textarea name="remarks" id="remarks" class="form-control"><?php echo htmlspecialchars($row['remarks']); ?></textarea>
                    <br>
                    <input type="hidden" name="asset_tag" value="<?php echo $row['asset_tag']; ?>">
                    <!-- Hidden field for asset_tag -->
                    <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                    <a href="assets.php" class="btn btn-secondary ml-2"
                        onClick="return confirm('Do you want to go back? All inserted data here before submitting will be gone!')">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>

</html>