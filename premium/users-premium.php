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

        //  Query if there exists a payment method
        $sql = "SELECT * FROM $tbl_user_payment WHERE user_id = '$user_id'";
        $result = mysqli_query($conn, $sql);
        $total_users = mysqli_num_rows($result);
        
        //  If user does not have a payment method goto payment-info page
       /* if ($total_users == 0) {
            $url = '../premium/premium-payment-info.php';
            echo '<a href ='.$url.'>For only $9.99 a month recieve benefits such as discounts and express shipping on all orders</a>';
        }
        //  Else go to premium signup page
        else {
        }*/
        $url = '../premium/premium-payment-info.php';
        echo '<a href ='.$url.'>For only $9.99 a month recieve benefits such as discounts and express shipping on all orders</a>';
    }
    else {
        echo "Your membership expires: ";
        echo $users[0]['end_date'];
        echo "<h1>Enjoy free shipping with our premium membership!</h1>";
        $url = '../index.php';
        echo "<h2><a href='../index.php'>Check out our catalogue now!</h2>";
    }
    mysqli_free_result($result);
?>
    