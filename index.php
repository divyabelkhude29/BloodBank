<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Blood Bank - Home</title>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="icon" type="image/x-icon" href="favicon.ico" />
    <style>
        /* Additional styling for home page */
        .home-container {
            max-width: 700px;
            margin: 80px auto;
            background: white;
            padding: 30px 40px;
            box-shadow: 0 0 15px #ccc;
            border-radius: 8px;
            text-align: center;
        }
        .home-container h1 {
            margin-bottom: 20px;
            color: #ff0400bd;
        }
        .home-container p {
            font-size: 18px;
            color: #555;
            margin-bottom: 40px;
        }
        .btn {
            display: inline-block;
            background-color: #ff0400bd;
            color: white;
            padding: 12px 25px;
            margin: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #ff0400bd;
        }
    </style>
</head>
<body>
    <div class="home-container">
        <h1>Welcome to the Blood Bank Management System</h1>
        <p>Your one-stop solution for managing blood donors, blood stock, and NGO information efficiently and securely.</p>

        <a href="admin/login.php" class="btn">Admin Login</a>
        <a href="user/index.php" class="btn">User  Site</a>
    </div>
</body>
</html>
