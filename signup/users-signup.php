<?php
    include_once('../config/db_connection.php');
    include('../variables/variables.php');

    if(isset($_POST['users_signup'])){
        $f_name = htmlspecialchars($_POST['users_signup_fname']);
        $l_name = htmlspecialchars($_POST['users_signup_lname']);
        $user_username = htmlspecialchars($_POST['users_signup_username']);
        $user_password = htmlspecialchars($_POST['users_signup_password']);

        $sql = "INSERT INTO $tbl_users (f_name, l_name, username, passwrd) VALUES ('$f_name','$l_name', '$user_username', '$user_password')";

        if(mysqli_query($conn, $sql)){
            $last_inserted_user_id = mysqli_insert_id($conn);
            $_SESSION['user_fname'] = $f_name;
            $_SESSION['user_lname'] = $l_name;
            if (isset($_POST['author_check'])) {
                $name = $f_name . ' ' . $l_name;
                $sql2 = "INSERT INTO tbl_is_author (user_id, author_name) VALUES ('$last_inserted_user_id', '$name')";
                if(mysqli_query($conn, $sql2))
                  header('Location: ../author/user-author.php');
            }
            header('Location: ../login/log-in-users.php');
        } else{
            echo '<script>alert("Username Or Organizaiton already exits!")</script>';
        }
    } else if(isset($_POST['cancel_signup'])){
        header('Location: ../login/log-in-users.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('../templates/header.php') ?>
    <div class="center">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <h3>Users Sign Up</h3>
            <div class="users_signup-fname">
                <label for="users_signup_fname">First Name: </label>
                <input type="text" name="users_signup_fname" id="" placeholder="First name" required>
            </div>
            <div class="users-signup-lname">
                <label for="users_signup_lname">Last Name: </label>
                <input type="text" name="users_signup_lname" id="" placeholder="Last name" required>
            </div>
            <div class="users-signup-username">
                <label for="users_signup_username">Username: </label>
                <input type="text" name="users_signup_username" id="" placeholder="Username" required>
            </div>
            <div class="users-signup-password">
                <label for="users_signup_password">Password: </label>
                <input type="password" name="users_signup_password" id="" placeholder="Password" required>
            </div>
            <div class ="Is-author-checkbox">
                <label for="Is-author-checkbox">Author?</label>
                <input type="checkbox" name="author_check" value="value1">
            </div>
            <div class="submit-buttons">
                    <button type="submit" name="users_signup">Sign up</button>
                    <a href="../login/log-in-users.php">Cancel</a>
            </div>
        </form>
    </div>
    <?php include('../templates/footer.php') ?>
</html>