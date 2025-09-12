<?php
include 'db.php';
check_login();

$success = $error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = trim($_POST['name']);
    $contact = trim($_POST['contact']);
    $address = trim($_POST['address']);
    $email = trim($_POST['email']);

    // Basic validation
    if (empty($name)) {
        $error = "NGO name is required.";
    } elseif (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        $stmt = $conn->prepare("INSERT INTO ngos (name, contact, address, email) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $contact, $address, $email);

        if ($stmt->execute()) {
            $success = "NGO added successfully!";
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
    <title>Add NGO - Blood Bank</title>
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
    <h2>Add NGO</h2>
    <?php if ($error): ?>
        <p class="error"><?=htmlspecialchars($error)?></p>
    <?php elseif ($success): ?>
        <p class="success"><?=htmlspecialchars($success)?></p>
    <?php endif; ?>
    <form method="post" action="">
        <label>NGO Name <span style="color:red;">*</span></label>
        <input type="text" name="name" required>

        <label>Contact</label>
        <input type="text" name="contact">

        <label>Address</label>
        <textarea name="address"></textarea>

        <label>Email</label>
        <input type="email" name="email">

        <input type="submit" value="Add NGO">
    </form>
</div>

<?php include 'footer.php'; ?>
</body>
</html>