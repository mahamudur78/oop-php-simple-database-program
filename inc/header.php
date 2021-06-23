<?php 
    $filePath = realpath(dirname(__FILE__));
    include_once $filePath.'/../lib/Session.php';
    Session::init();
?>

<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Register System PHP</title>
    <link rel="stylesheet" href="inc/bootstrap.min.css">
    <script src="inc/jquery.min.js"></script>
    <script src="inc/popper.js"></script>
    <script src="inc/bootstrap.min.js"></script>
    <script src="inc/fontawesome.js"></script>
    <script src="inc/style.css"></script>
    <script src="inc/main.js"></script>
</head>
<?php 
    if(isset($_GET['action']) && $_GET['action'] == "logout"){
        Session::destroy();
    }
?>

<body>
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">Login Register System PHP PDO</a>
                </div>

                <ul class="nav navbar-nav pull-right">
                    <?php
                        $id = Session::get("id");
                        $userlogin = Session::get("login");
                        if($userlogin == true):
                    ?>
                            <li><a href="profile.php?id=<?php echo $id; ?>">Profile</a></li>
                            <li><a href="password.php?id=<?php echo $id; ?>">Change Password</a></li>
                            <li><a href="?action=logout">Logout</a></li>
                    <?php else: ?>
                            <li><a href="login.php">Login</a></li>
                            <li><a href="register.php">Register</a></li>
                    <?php endif; ?>
                </ul>
            </div>        
        </nav>