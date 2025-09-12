<?php
include 'db.php';
check_login();

$sql = "SELECT * FROM ngos ORDER BY name ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>NGO List - Blood Bank</title>
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
    <h2>NGO List</h2>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th><th>Contact</th><th>Email</th><th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?=htmlspecialchars($row['name'])?></td>
                        <td><?=htmlspecialchars($row['contact'])?></td>
                        <td><?=htmlspecialchars($row['email'])?></td>
                        <td><?=htmlspecialchars($row['address'])?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No NGOs found.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
</body>
</html>