<?php 
    include('../templates/header.php');
?>
<?php

    include('../config/db_connection.php');
    include('../variables/variables.php');
    include('../functions/functions.php');

    session_start();

    $user_id = htmlspecialchars($_SESSION['user_id']);

    //  Query premium membership info
    $sql = "SELECT * FROM $tbl_user_premium WHERE user_id = '$user_id'";
    //  Make query and get result
    $result = mysqli_query($conn, $sql);
    //  Fetch resulting rows as an assoc array
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $total_users = mysqli_num_rows($result);
    
    //  If returns 0 user is not a premium member
    if($total_users == 0) {
        echo "You're not a member!<br><br>";
        $url = '../users/users-payment-info.php';
        echo '<a href ='.$url.'>For only $9.99 a month recieve benefits such as discounts and express shipping on all orders</a>';
    }
    else {
        echo "Your membership expires: ";
        printf("%s", $users["end_date"]);
    }

    mysqli_free_result($result);
?>

<!DOCTYPE html>
<html lang="en">
    <h1> Premium benefits info goes here if valid member </h1>