<?php 
    include 'lib/user.php';
    include_once 'inc/header.php'; 
    Session::checkSession();    
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h2>User Profile <span class="pull-right"><a class="btn btn-primary" href="index.php">Back</a></span></h2>
    </div>

    <div class="panel-body">
        <div style="max-width:600px; margin:0 auto">

        <?php
            if(isset($_GET['id'])){
                $userId = (int)$_GET['id'];
        
                $user = new user();
                if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])){
                    echo $updateMsg = $user->updateUserData($userId, $_POST);
                }

                $userData = $user->getUserById($userId);
        ?>

            <form action="" method="POST">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" name="name" id="name" value="<?php echo  $userData['name']; ?>" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo  $userData['username']; ?>" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="text" name="email" id="email" value="<?php echo  $userData['email']; ?>" class="form-control"/>
                </div>

                <?php 
                    $sessionUserID = Session::get("id"); 
                    if($sessionUserID == $userId ): 
                ?>
                    <button type="submit" name="update" class="btn btn-success">Update</button>
                
            <?php endif ?>

            </form>

        <?php
            }else{
                return header("Location: index.php");
            } 
        ?>

        </div>
    </div>
</div>

<?php include_once 'inc/footer.php'; ?>