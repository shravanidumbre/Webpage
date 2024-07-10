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
            </nav>
            <main>
                <section>
                <div class="container">
                    <?php
                    if(isset($_POST["submit"])){
                        $name = $_POST["name"];
                        $email = $_POST["email"];
                        $password = $_POST["password"];
                        $conformpassword = $_POST["conform_password"];
                        
                        $passwordhash = password_hash($password, PASSWORD_DEFAULT);

                        $errors = array();

                        if (empty($name) OR empty($email) OR empty($password) OR empty($conformpassword)){
                        array_push($errors,"All fields are required");
                        }
                        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
                        array_push($errors, "Email is not valid");
                        }
                        if (strlen($password)<8){
                            array_push($errors, "Password must be at least 8 characters long");
                        }
                        if ($password!==$conformpassword){
                            array_push($errors, "Password does not match");
                        }
                        
                        require_once "database.php";
                        $sql = "SELECT * FROM users WHERE email = '$email'";
                        $result = mysqli_query($conn, $sql);
                        $rowCount = mysqli_num_rows($result);
                        if($rowCount>0){
                            array_push($errors, "Email already exists");
                        }
                        if (count($errors)>0){
                            foreach ($errors as $error){
                                echo "<div class='alert alert-danger'>$error</div>";
                            }
                        }else{
                            $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
                            $stmt = mysqli_stmt_init($conn);
                            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                            if ($prepareStmt) {
                                mysqli_stmt_bind_param($stmt,"sss",$name,$email,$passwordhash);
                                mysqli_stmt_execute($stmt);
                                echo "<div class='alert alert-success'>You are registered sucessfully.</div>";
                            }else{
                                die("Something went wrong");
                            }
                        }
                    }
                    ?>
                    <form action="signup.php" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Name">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="conform_password" placeholder="Conform Password">
                        </div>
                        <div class="form-btn">
                            <input type="submit" class="btn btn-primary" value="Sign Up" name="submit">
                        </div>
                    </form>
                    <div>
                            <p>Already a member? <a href="login.php">Login Here</a> </p>
                        </div>
                </div>
                </section>
            </main>
        </header>
    </body>
</html>