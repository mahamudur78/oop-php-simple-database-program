<?php 
    include_once 'inc/header.php'; 
    include 'lib/user.php';
    Session::checkSession();
?>

<?php 
    $loginMsg = Session::get("loginMsg");
    if(isset($loginMsg)){
        echo $loginMsg;
    }
    Session::set("loginMsg", null);
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h2>User List <span class="pull-right"><strong>Welcom! </strong>
        <?php 
            $name = Session::get("name");
            if(isset($name)){
                echo $name;
            }
        ?>
        </span></h2>
    </div>

    <div class="panel-body">
        <table class="table table-striped">
            <th width="20%">Serial</th>
            <th width="20%">Name</th>
            <th width="20%">Username</th>
            <th width="20%">Email Address</th>
            <th width="20%">Action</th>

            <?php 
            $user = new User();
            $userData = $user->getUserData();
            if(isset($userData)):
                $id = 0;
                foreach($userData as $sData):
                    $id++;
            ?>

            <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $sData['name']; ?></td>
                <td><?php echo $sData['username']; ?></td>
                <td><?php echo $sData['email']; ?></td>
                <td>
                    <a class="btn btn-primary" href="profile.php?id=<?php echo $sData['id']; ?>">View</a>
                </td>
            </tr>

            <?php endforeach; else:; ?>
                <tr>
                    <td colspan = "5">
                        <h2>No User Data Found...</h2>
                    </td>
                </tr>
            <?php endif; ?>
        </table>
    </div>

</div>

<?php include_once 'inc/footer.php'; ?>