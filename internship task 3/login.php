<?php
session_start();
if(isset($_SESSION["user"])){
    header("Location: index.php");
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
        <header>
            <nav>
                <div class="menus">
                    <a href="homepage.html">Home</a>
                    <a href="about.html" target="_blank">About</a>
                    <a href="destination.html" target="_blank">Destinations</a>
                    <a href="hotel.html" target="_blank">Hotels</a>
                    <a href="#" target="_blank">Contact Us</a>
                </div>
                </div>
            </nav>
            <main>
                <section>
                    <div class="container">
                        <?php
                        if (isset($_POST["login"])){
                            $email = $_POST["email"];
                            $password = $_POST["password"];
                            require_once "database.php";
                            $sql = "SELECT * FROM users WHERE email = '$email'";
                            $result = mysqli_query($conn, $sql);
                            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                            if ($user){
                               if (password_verify($password, $user["password"])){
                                session_start();
                                $_SESSION["user"] = "yes";
                                header("Location: index.php");
                                die();
                               }else{
                                echo "<div class='alert alert-danger'>Password does not exists</div>";
                               }
                            }else{
                                echo "<div class='alert alert-danger'>Email does not exists</div>";
                            }
                        }
                        ?>
                        <form action="login.php" method="post">
                            <div class="form-group">
                                <input type="email" placeholder="Email" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <input type="password" placeholder="Password" name="password" class="form-control">
                            </div>
                            <div class="form-btn">
                                <input type="submit" value="Login" name="login" class="btn btn-primary">
                            </div>
                        </form>
                        <div>
                            <p>Not a member? <a href="signup.php">Register Now</a> </p>
                        </div>
                    </div>
                </section>
            </main>
        </header>
    </body>
</html>