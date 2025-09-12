<?php
include 'db.php';
check_login();

$sql = "SELECT bg.group_name, IFNULL(bs.units, 0) AS units 
        FROM blood_groups bg 
        LEFT JOIN blood_stock bs ON bg.id = bs.blood_group_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Stock Blood List - Blood Bank</title>
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
    <h2>Stock Blood List</h2>
    <table>
        <thead>
            <tr><th>Blood Group</th><th>Units Available</th></tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?=htmlspecialchars($row['group_name'])?></td>
                    <td><?=htmlspecialchars($row['units'])?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
</body>
</html>