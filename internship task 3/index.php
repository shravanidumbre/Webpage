<?php
session_start();
if(!isset($_SESSION["user"])){
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scaler=1, maximun-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" intergrity="sha384-Zenh87qX5JnK2JlOvWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="signup.css">
    </head>
    <body>
        <div class="container">
            <h1>Welcome To Dashboard</h1>
            <a href="logout.php" class="btn btn-warning">Logout</a>
        </div>
    </body>
</html>
