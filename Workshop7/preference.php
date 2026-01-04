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


if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['theme'])) {
    $theme = $_POST['theme'];

    setcookie("theme", $theme, time() + (86400 * 30), "/");

    header("Location: preference.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Theme Preference</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: <?= ($theme === "dark") ? "#121212" : "#ffffff"; ?>;
            color: <?= ($theme === "dark") ? "#ffffff" : "#000000"; ?>;
            text-align: center;
            padding-top: 50px;
        }

        select, button {
            padding: 10px;
            margin-top: 15px;
        }

        a {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            color: inherit;
        }
    </style>
</head>

<body>

<h2>Hello <?= $_SESSION['username']; ?> </h2>
<h3>Select Your Theme Preference</h3>

<form method="POST">
    <select name="theme" required>
        <option value="light" <?= ($theme === "light") ? "selected" : ""; ?>>Light Mode</option>
        <option value="dark" <?= ($theme === "dark") ? "selected" : ""; ?>>Dark Mode</option>
    </select>
    <br>
    <button type="submit">Save Preference</button>
</form>

<a href="dashboard.php"> Back to Dashboard</a>

</body>
</html>
