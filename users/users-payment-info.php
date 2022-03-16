<?php 
    include('../templates/header.php');
?>
<?php

    include('../config/db_connection.php');
    include('../variables/variables.php');
    include('../functions/functions.php');

    //  Session start
    session_start();

    $f_name = htmlspecialchars($_SESSION['f_name']);
    $l_name = htmlspecialchars($_SESSION["l_name"]);
    $user_id = htmlspecialchars($_SESSION['user_id']);

    //  Query all payment info based on user id
    $sql = "SELECT * FROM $tbl_user_payment WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);

    //  Manage info link
    $url = '../premium/card-payment-signup.php';
    echo '<a href ='.$url.'>Manage my card info</a><br><br>';
    $url = '../premium/billingaddress-signup.php';
    echo '<a href ='.$url.'>Manage my billing info</a><br><br>';

    //  Display vertically
    echo "<br><table>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><th>Card Number</th><td>{$row['card_number']}</td></tr>";
        echo "<tr><th>CVV</th><td>{$row['cvv']}</td></tr>";
        echo "<tr><th>Expiry Date</th><td>{$row['Expiry_Date']}</td></tr>";
    }
    echo "</table>";
    //  Free result
    mysqli_free_result($result);

    //  Query address info next
    $sql = "SELECT * FROM $tbl_user_address WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    
    //  Do the same
    echo "<br><br><table>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><th>Address Line 1</th><td>{$row['address_line1']}</td></tr>";
        echo "<tr><th>Address Line 2</th><td>{$row['address_line2']}</td></tr>";
        echo "<tr><th>City</th><td>{$row['city']}</td></tr>";
        echo "<tr><th>Postal Code</th><td>{$row['postal_code']}</td></tr>";
        echo "<tr><th>Telephone</th><td>{$row['telephone']}</td></tr>";
        echo "<tr><th>Mobile</th><td>{$row['mobile']}</td></tr>";
        echo "<tr><th>Country</th><td>{$row['country']}</td></tr>";
    }
    echo "</table>";
    mysqli_free_result($result);
?>