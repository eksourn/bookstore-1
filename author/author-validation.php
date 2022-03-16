<?php

    include('../config/db_connection.php');
    include('../variables/variables.php');
    include('../functions/functions.php');

    if (isset($_POST['author_signup']))
        $author_name = htmlspecialchars($_POST['author_signup_name']);

    $sql = "INSERT INTO tbl_is_author (author_name) VALUES ('$author_name')";
    if(mysqli_query($conn, $sql)) {
        header('Location: ../author/user-author.php');
    }
    else if (isset($_POST['cancel_signup'])) {
        header('Location: ../users/users.php');
    }

?>
<?php 
    include('../templates/header.php');
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('../templates/header.php') ?>
    <div class="center">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <h3>Would you like to register as an author?</h3>
            <div class="author-signup-name">
                <label for="author_singup_name">Name: </label>
                <input type="text" name="author_singup_name" id="" placeholder="your name" required>
            </div>
            <div class="submit-buttons">
                    <button type="submit" name="author_signup">Sign up</button>
                    <a href="../login/users.php">Cancel</a>
            </div>
        </form>
    </div>
    <?php include('../templates/footer.php') ?>
</html>