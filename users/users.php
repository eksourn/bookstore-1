<?php

    include('../config/db_connection.php');
    include('../variables/variables.php');
    include('../functions/functions.php');

    //  Session start
    session_start();
   // $typedIn = array('f_name' =>'', 'l_name'=>'');

    //  Create session variables as HTML entities
    $f_name = htmlspecialchars($_SESSION['f_name']);
    $l_name = htmlspecialchars($_SESSION["l_name"]);
    
    //  Query
    $sql = "SELECT $tbl_users.f_name, $tbl_users.l_name, $tbl_users.username FROM $tbl_users WHERE f_name = '$f_name' AND l_name = '$l_name'";
    //  Make query and get result
    $result = mysqli_query($conn, $sql);
    //  Fetch resulting rows as an assoc array
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);

    //  Free result from mem
    mysqli_free_result($result);
        
    //  Logout and unset session variables
    if (isset($_POST['log_out'])) {
        unset($_SESSION['f_name']);
        unset($_SESSION['l_name']);
        unset($_SESSION['user_username']);
        unset($_SESSION['user_logged_in']);
        header('Location:../index.php');
    }

    //  Close connection
    mysqli_close($conn);
?>
<?php 
    include('../templates/header.php');
?>

<!DOCTYPE html>
<html lang="en">
    <h1>Welcome Back <?php echo $_SESSION['f_name']; ?></h1> <hr>
    <a href ="../users/users-payment-info.php">Manage Payment Info</a> <br><br>
    <a href ="../users/users-payment-info.php">My Orders</a> <br><br>
    <a href ="../premium/users-premium.php">My Benefits/Membership</a> <br><br>
    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <div class="submit-buttons">
           <button type="submit" name="log_out">Log out</button>
        </div>
    </form>


