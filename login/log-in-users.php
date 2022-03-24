<?php
    include_once('../config/db_connection.php');
    include('../variables/variables.php');

    session_start();
    $typedIn = array('user_name'=>'');
    print_r($typedIn);
    print_r($_SESSION);

    if(isset($_POST['user_login'])){
        $user_username = htmlspecialchars($_POST['user_username']);
        $user_password = htmlspecialchars($_POST['user_password']);
        $typedIn['user_name'] = $user_username;

        $sql = "SELECT * FROM $tbl_users WHERE username = '$user_username' AND password='$user_password'";

        $result = mysqli_query($conn, $sql);
        $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $total_users = mysqli_num_rows($result);
        mysqli_free_result($result);
        
        //  If user exists return nonzero
        if($total_users == 0){
            echo '<script>alert("Invalid Username or Password")</script>';
        } else {
            $typedIn['user_name'] = '';
            $_SESSION['f_name'] = $users[0]['f_name'];
            $_SESSION['l_name'] = $users[0]['l_name'];
            $_SESSION['user_username'] = $users[0]['username'];
            $_SESSION['user_id'] = $users[0]['user_id'];
            $_SESSION['user_logged_in'] = True;

            //  Query to see if user exists in author table
            $sql = "SELECT $tbl_is_author.author_id FROM $tbl_is_author WHERE user_id = (SELECT $tbl_users.user_id FROM $tbl_users WHERE username = '$user_username' AND password='$user_password')";
            $result = mysqli_query($conn, $sql);
            $authors = mysqli_fetch_all($result, MYSQLI_ASSOC);
            $total_authors = mysqli_num_rows($result);
            mysqli_free_result($result);

            //  If there is no author redirect to regular users page
            if ($total_authors == 0) {
                header('Location: ../users/users.php');
            }// Else author page
            else {
                $_SESSION['is_author'] = True;
                $_SESSION['author_id'] = $authors[0]['author_id'];
                header('Location: ../author/author.php'); 
            }
        }   
        mysqli_close($conn);

    }else if(isset($_POST['cancel'])){
        header('Location: ../index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('../templates/header.php') ?>
    <div class="user-log-in center">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <h3>Users Log In</h3>
            <div class="user-username">
                <label for="user-username">Username: </label>
                <input type="text" name="user_username" id="" placeholder="Enter username" value="<?php echo $typedIn['user_name']; ?>">
            </div>
            <div class="user-password">
                <label for="user-password">Pasword: </label>
                <input type="password" name="user_password" id="" placeholder="Enter password">
            </div>
            <div class="submit-buttons">
                <button type="submit" name="user_login">Log in</button>
                <button type="submit" name="cancel" value="Cancel">Cancel </button>
            </div>
        </form>

        <a href="../signup/users-signup.php">Don't have an account?</a>
    </div>
    <?php include('../templates/footer.php') ?>
</html>