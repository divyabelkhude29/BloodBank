<?php
include 'db.php';
check_login();

$success = $error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $age = intval($_POST['age']);
    $gender = $_POST['gender'];
    $blood_group_id = intval($_POST['blood_group']);
    $contact = trim($_POST['contact']);
    $address = trim($_POST['address']);
    $last_donation_date = $_POST['last_donation_date'];

    if ($age < 18 || $age > 65) {
        $error = "Age must be between 18 and 65.";
    } else {
        $stmt = $conn->prepare("INSERT INTO donors (name, age, gender, blood_group_id, contact, address, last_donation_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sisisss", $name, $age, $gender, $blood_group_id, $contact, $address, $last_donation_date);

        if ($stmt->execute()) {
            // Update blood stock: add 1 unit for this blood group
            $update_stock = $conn->prepare("INSERT INTO blood_stock (blood_group_id, units) VALUES (?, 1) ON DUPLICATE KEY UPDATE units = units + 1");
            $update_stock->bind_param("i", $blood_group_id);
            $update_stock->execute();
            $update_stock->close();

            $success = "Donor added successfully!";
        } else {
            $error = "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Donor - Blood Bank</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<nav>
    <a href="dashboard.php">Dashboard</a>
    <a href="donors_add.php">Add Donor</a>
    <a href="donors_list.php">Donor List</a>
    <a href="stock_list.php">Stock Blood List</a>
    <a href="ngo_add.php">Add NGO</a>
    <a href="ngo_list.php">NGO List</a>
    <a href="logout.php" style="float:right;">Logout (<?=htmlspecialchars($_SESSION['admin_username'])?>)</a>
</nav>

<div class="container">
    <h2>Add Donor</h2>
    <?php if ($error): ?>
        <p class="error"><?=htmlspecialchars($error)?></p>
    <?php elseif ($success): ?>
        <p class="success"><?=htmlspecialchars($success)?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label>Name</label>
        <input type="text" name="name" required>

        <label>Age</label>
        <input type="number" name="age" min="18" max="65" required>

        <label>Gender</label>
        <select name="gender" required>
            <option value="">Select</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select>

        <label>Blood Group</label>
        <select name="blood_group" required>
            <option value="">Select</option>
            <?php
            $result = $conn->query("SELECT * FROM blood_groups");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['group_name']}</option>";
            }
            ?>
        </select>

        <label>Contact</label>
        <input type="text" name="contact">

        <label>Address</label>
        <textarea name="address"></textarea>

        <label>Last Donation Date</label>
        <input type="date" name="last_donation_date">

        <input type="submit" value="Add Donor">
    </form>
</div>

<?php include 'footer.php'; ?>
</body>
</html>