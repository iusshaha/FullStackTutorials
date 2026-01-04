<?php

session_start();

if(isset($_SESSION['logged_in'])){
    echo "User logged in!";
}else{
    header("Location:login.php");
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
</head>
<body>
    <h1>Welcome <?=$_SESSION['username']?></h1>

</body>
</html>