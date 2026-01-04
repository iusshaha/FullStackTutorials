<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}

$theme = "light";
if (isset($_COOKIE['theme'])) {
    $theme = $_COOKIE['theme'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dashboard</title>

    <style>
        body {
            background-color: <?= ($theme === "dark") ? "#121212" : "#ffffff"; ?>;
            color: <?= ($theme === "dark") ? "#ffffff" : "#000000"; ?>;
            font-family: Arial, sans-serif;
        }

        a {
            display: block;
            margin: 10px 0;
            color: inherit;
            text-decoration: none;
        }
    </style>
</head>

<body>

<h1>Welcome <?= $_SESSION['username']; ?></h1>

<a href="preference.php">Change Theme</a>
<a href="logout.php">Logout</a>

</body>
</html>
