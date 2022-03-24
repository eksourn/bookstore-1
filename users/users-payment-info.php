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
    $pay_info = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $total_users1 = mysqli_num_rows($result);

    if($total_users1) {
        //  Create session vars for card-payment-signup.php
        $_SESSION['payment_type'] = $pay_info[0]['payment_type'];
        $_SESSION['card_number'] = $pay_info[0]['card_number'];
        $_SESSION['cvv'] = $pay_info[0]['cvv'];
        $_SESSION['expiry_date'] = $pay_info[0]['Expiry_Date'];
    }
    
    //  Free result
    mysqli_free_result($result);

    //  Query address info next
    $sql = "SELECT * FROM $tbl_user_address WHERE user_id = '$user_id'";
    $result = mysqli_query($conn, $sql);
    $billing_info = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $total_users2 = mysqli_num_rows($result);

    if($total_users2) {
        //  Create session vars for billingaddress-signup.php
        $_SESSION['address_line1'] = $billing_info[0]['address_line1'];
        $_SESSION['address_line2'] = $billing_info[0]['address_line2'];
        $_SESSION['city'] = $billing_info[0]['city'];
        $_SESSION['postal_code'] = $billing_info[0]['postal_code'];
        $_SESSION['telephone'] = $billing_info[0]['telephone'];
        $_SESSION['mobile'] = $billing_info[0]['mobile'];
        $_SESSION['country'] = $billing_info[0]['country'];
    }
    
    //  If nothing exists create empty vars
    if ($total_users1 == 0)
        if ($total_users2 == 0) {
        $_SESSION['payment_type'] = false;
        $_SESSION['card_number'] = false;
        $_SESSION['cvv'] = false;
        $_SESSION['expiry_date'] = false;
        $_SESSION['address_line1'] = false;
        $_SESSION['address_line2'] = false;
        $_SESSION['city'] = false;
        $_SESSION['postal_code'] = false;
        $_SESSION['telephone'] = false;
        $_SESSION['mobile'] = false;
        $_SESSION['country'] = false;
    }

    mysqli_free_result($result);
?>
<!DOCTYPE html>
<html lang="en">
    <h3>My Payment Card</h3>
    <table>
        <tr>
            <th>Card Number</th>
            <th>CVV</th>
            <th>Expiry Date</th>
        </tr>
        <?php foreach($pay_info as $pi): ?>
            <tr>
                <td><?php echo $pi['card_number'] ?></td>
                <td><?php echo $pi['cvv'] ?></td>
                <td><?php echo $pi['Expiry_Date'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href ="../users/card-payment-signup.php"><button>Add or update payment method</button></a>
    <h3>My Billing Address</h3>
    <table>
        <tr>
            <th>Address Line 1</th>
            <th>Address Line 2</th>
            <th>City</th>
            <th>Postal Code</th>
            <th>Telephone</th>
            <th>Mobile</th>
            <th>Country</th>
        </tr>
        <?php foreach($billing_info as $bi): ?>
            <tr>
                <td><?php echo $bi['address_line1'] ?></td>
                <td><?php echo $bi['address_line2'] ?></td>
                <td><?php echo $bi['city'] ?></td>
                <td><?php echo $bi['postal_code'] ?></td>
                <td><?php echo $bi['telephone'] ?></td>
                <td><?php echo $bi['mobile'] ?></td>
                <td><?php echo $bi['country'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href ="../users/billingaddress-signup.php"><button>Add or update billing address</button></a><br><br>
   <!-- <a href ="../users/billingaddress-signup.php"><button>Pay Now</button></a> -->


</html>