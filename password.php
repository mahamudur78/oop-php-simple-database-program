<?php 
    include 'lib/user.php';
    include_once 'inc/header.php'; 
    Session::checkSession();    
?>
<?php 
    $user = new User();
    if(isset($_POST['changePassword'])){
        if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changePassword'])){
            $updatePass = $user->setNewPassword(Session::get("id"), $_POST);
        }
    }
?>

<?php 
    if(isset($updatePass)){
        echo $updatePass;
    }
?>


<div class="panel panel-default">
    <div class="panel-heading">
        <h2>Change Password <span class="pull-right"><a class="btn btn-primary" href="index.php">Back</a></span></h2>
    </div>

    <div class="panel-body">
        <div style="max-width:600px; margin:0 auto">
            <form action="" method="POST">
                <div class="form-group">
                    <label for="cPassword">Current Password</label>
                    <input type="text" name="cPassword" id="cPassword" value="" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="nPassword">New Password</label>
                    <div class="input-group" id="show_hide_nPassword">
                        <input class="form-control" name="nPassword" id="nPassword" type="password">
                        <div class="input-group-addon">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="rNPassword">Renew Password</label>
                    <div class="input-group" id="show_hide_rNPassword">
                        <input class="form-control" id="rNPassword" name="rNPassword" type="password">
                        <div class="input-group-addon">
                            <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                    <button type="submit" name="changePassword" class="btn btn-success">Change Password</button>
            </form>

        </div>
    </div>
</div>

<?php include_once 'inc/footer.php'; ?>