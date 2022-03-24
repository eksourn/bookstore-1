<?php
    session_start();

    if(isset( $_SESSION['admin']) and  $_SESSION['admin']==TRUE){
        header("Location: ../admin/admin.php");
    }


    if(isset($_POST['signin'])){
        $username = htmlspecialchars($_POST['admin_name']);
        $password = htmlspecialchars($_POST['admin_pass']);


        if($username=="admin" and $password="admin"){
            $host = 'localhost';
            $host_user = 'root';
            $host_password = '';
            $host_db = 'bookstore_test4';

            $conn1 = mysqli_connect($host, $host_user, $host_password, $host_db);

            if($conn1){
                mysqli_close($conn1);
                $_SESSION['admin'] = TRUE;
                header("Location: ../admin/admin.php");
            }
        } else{
            echo '<script>alert("Username or Password Incorrect")</script>';
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <?php include('../templates/header.php'); ?>
    
    <div class="center">
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <h3>Admin Panel Login</h3>
            <div class="input-box">
                <label for="admin_name">Username</label>
                <input type="text" name="admin_name" id="admin_name" placeholder="username" require>
            </div>
            <div class="input-box">
                <label for="admin_pass">Password</label>
                <input type="password" name="admin_pass" id="admin_pass" placeholder="password" require>
            </div>
            <div class="input-box">
                <input type="submit" value="signin" name="signin">
                <a href="../index.php">Cancel</a>
            </div>
        </form>
    </div>
    <?php include('../templates/footer.php'); ?>
</html>
