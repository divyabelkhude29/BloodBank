<?php
include 'db.php';
check_login();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard - Blood Bank</title>
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
    <h1>Welcome, <?=htmlspecialchars($_SESSION['admin_username'])?></h1>
    <p>Use the navigation menu to manage the blood bank system.</p>
</div>
<div class="container">
    <h2>Abstract</h2>
    <p>Despite the immense technological advancement, blood bank systems are either manual or valuable data Consequently, one of the major issues in blood bank systems, as talked about in many research papers and articles, is the lack of data security. People always doubt whether their personal information and medical records are safely stored and secured. Therefore, our project aims to develop an online blood donation system applying the concepts of database security and encryption. easily retrievable.</p>
</div>

<div class="abstract-image">
    <img src="logo.png" alt="Blood Bank Logo" style="display:block; margin:20px auto; max-width:300px;">
</div>

<?php include 'footer.php'; ?>
</body>
</html>