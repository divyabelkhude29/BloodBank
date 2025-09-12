<?php
// Connect to database
$servername = "localhost";
$username = "root";  // change if needed
$password = "";      // change if needed
$dbname = "bloodbank";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch blood groups for dropdown
$blood_groups = [];
$result = $conn->query("SELECT * FROM blood_groups ORDER BY group_name ASC");
while ($row = $result->fetch_assoc()) {
    $blood_groups[] = $row;
}

// Handle donor search
$search_results = [];
$search_blood_group_id = 0;
if (isset($_GET['blood_group']) && is_numeric($_GET['blood_group'])) {
    $search_blood_group_id = intval($_GET['blood_group']);
    $stmt = $conn->prepare("SELECT d.name, d.age, d.gender, d.contact, d.address, d.last_donation_date, bg.group_name 
                            FROM donors d 
                            JOIN blood_groups bg ON d.blood_group_id = bg.id 
                            WHERE d.blood_group_id = ?");
    $stmt->bind_param("i", $search_blood_group_id);
    $stmt->execute();
    $search_results = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}

// Fetch blood stock
$stock = [];
$stock_result = $conn->query("SELECT bg.group_name, IFNULL(bs.units, 0) AS units 
                              FROM blood_groups bg 
                              LEFT JOIN blood_stock bs ON bg.id = bs.blood_group_id
                              ORDER BY bg.group_name ASC");
while ($row = $stock_result->fetch_assoc()) {
    $stock[] = $row;
}

// Fetch NGOs
$ngos = [];
$ngo_result = $conn->query("SELECT * FROM ngos ORDER BY name ASC");
while ($row = $ngo_result->fetch_assoc()) {
    $ngos[] = $row;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blood Bank - User Site</title>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        /* Additional styling for user site */
        h1, h2, h3 {
            color: #ff0400bd;
        }
        section {
            margin-bottom: 40px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Welcome to the Blood Bank</h1>

    <section>
        <h2>Available Blood Stock</h2>
        <table>
            <thead>
                <tr><th>Blood Group</th><th>Units Available</th></tr>
            </thead>
            <tbody>
                <?php foreach ($stock as $row): ?>
                    <tr>
                        <td><?=htmlspecialchars($row['group_name'])?></td>
                        <td><?=htmlspecialchars($row['units'])?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <section>
        <h2>Search Donors by Blood Group</h2>
        <form method="get" action="">
            <select name="blood_group" required>
                <option value="">Select Blood Group</option>
                <?php foreach ($blood_groups as $bg): ?>
                    <option value="<?= $bg['id'] ?>" <?= ($bg['id'] == $search_blood_group_id) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($bg['group_name']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <input type="submit" value="Search">
        </form>

        <?php if ($search_blood_group_id): ?>
            <h3>Donors with blood group: 
                <?= htmlspecialchars(array_filter($blood_groups, fn($bg) => $bg['id'] == $search_blood_group_id)[0]['group_name'] ?? '') ?>
            </h3>
            <?php if (count($search_results) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th><th>Age</th><th>Gender</th><th>Contact</th><th>Address</th><th>Last Donation Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($search_results as $donor): ?>
                            <tr>
                                <td><?=htmlspecialchars($donor['name'])?></td>
                                <td><?=htmlspecialchars($donor['age'])?></td>
                                <td><?=htmlspecialchars($donor['gender'])?></td>
                                <td><?=htmlspecialchars($donor['contact'])?></td>
                                <td><?=htmlspecialchars($donor['address'])?></td>
                                <td><?=htmlspecialchars($donor['last_donation_date'])?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No donors found for this blood group.</p>
            <?php endif; ?>
        <?php endif; ?>
    </section>

    <section>
        <h2>NGO Information</h2>
        <?php if (count($ngos) > 0): ?>
            <table>
                <thead>
                    <tr><th>Name</th><th>Contact</th><th>Email</th><th>Address</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($ngos as $ngo): ?>
                        <tr>
                            <td><?=htmlspecialchars($ngo['name'])?></td>
                            <td><?=htmlspecialchars($ngo['contact'])?></td>
                            <td><?=htmlspecialchars($ngo['email'])?></td>
                            <td><?=htmlspecialchars($ngo['address'])?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No NGO information available.</p>
        <?php endif; ?>
    </section>
</div>
</body>
</html>