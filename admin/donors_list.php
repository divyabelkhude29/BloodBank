<?php
include 'db.php';
check_login();

$sql = "SELECT d.id, d.name, d.age, d.gender, bg.group_name, d.contact, d.address, d.last_donation_date 
        FROM donors d 
        JOIN blood_groups bg ON d.blood_group_id = bg.id
        ORDER BY d.name ASC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Donor List - Blood Bank</title>
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
    <h2>Donor List</h2>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Name</th><th>Age</th><th>Gender</th><th>Blood Group</th><th>Contact</th><th>Address</th><th>Last Donation Date</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?=htmlspecialchars($row['name'])?></td>
                        <td><?=htmlspecialchars($row['age'])?></td>
                        <td><?=htmlspecialchars($row['gender'])?></td>
                        <td><?=htmlspecialchars($row['group_name'])?></td>
                        <td><?=htmlspecialchars($row['contact'])?></td>
                        <td><?=htmlspecialchars($row['address'])?></td>
                        <td><?=htmlspecialchars($row['last_donation_date'])?></td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No donors found.</p>
    <?php endif; ?>
</div>

<?php include 'footer.php'; ?>
</body>
</html>