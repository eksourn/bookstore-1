<?php 
    include('../templates/header.php');
?>
<?php

    include('../config/db_connection.php');
    include('../variables/variables.php');
    include('../functions/functions.php');

    session_start();

    $user_id = htmlspecialchars($_SESSION['user_id']);

    //  Query user id
    $sql = "SELECT user_id FROM $tbl_user_payment WHERE user_id = $user_id";
    $result = mysqli_query($conn, $sql);
    $total_users = mysqli_num_rows($result);
    mysqli_free_result($result);

    //  Check if payment info already exits
    if ($total_users == 0) {
        //  If no info exists add it
        if(isset($_POST['card_payment_signup'])) {
            $payment_type = htmlspecialchars($_POST['payment_type']);
            $card_num = htmlspecialchars($_POST['card_number']);
            $cvv = htmlspecialchars($_POST['cvv']);
            $expiry_date = htmlspecialchars($_POST['expiry_date']);
            
            $sql = "INSERT INTO tbl_user_payment (user_id, payment_type, card_number, cvv, Expiry_Date) VALUES ('$user_id', '$payment_type', '$card_num', '$cvv', '$expiry_date')";
    
            if(mysqli_query($conn, $sql)) {
                $SESSION['payment_type'] = $payment_type;
                $SESSION['card_num'] = $card_num;
                $SESSION['cvv'] = $cvv;
                $SESSION['expiry_date'] = $expiry_date;
                    
                echo '<script>alert("Success! Info has been added.")</script>';
                header('Location: ../premium/billingaddress-signup.php');
            } else {
                echo '<script>alert("Error with updating information!")</script>';
            }
        } else if(isset($_POST['cancel_signup'])){
            header('Location: ../users/users-payment-info.php');
        }
    }
    //  Else update info
    else {
        if(isset($_POST['card_payment_signup'])) {
            $payment_type = htmlspecialchars($_POST['payment_type']);
            $card_num = htmlspecialchars($_POST['card_number']);
            $cvv = htmlspecialchars($_POST['cvv']);
            $expiry_date = htmlspecialchars($_POST['expiry_date']);
            
            $sql = "UPDATE $tbl_user_payment SET payment_type = '$payment_type', card_number = '$card_num', cvv = '$cvv', Expiry_Date = '$expiry_date' WHERE user_id = '$user_id'";
    
            if(mysqli_query($conn, $sql)) {
                $SESSION['payment_type'] = $payment_type;
                $SESSION['card_num'] = $card_num;
                $SESSION['cvv'] = $cvv;
                $SESSION['expiry_date'] = $expiry_date;
                    
                echo '<script>alert("Success! Info has been updated.")</script>';
                header('Location: ../premium/billingaddress-signup.php');
            } else {
                echo '<script>alert("Error with updating information!")</script>';
            }
        } else if(isset($_POST['cancel_signup'])){
            header('Location: ../users/users-payment-info.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <div class="center">
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
            <h3>Payment Info</h3>
            <div class="payment-type-signup">
                <label for="payment_type">Payment Type </label>
                <input type="text" name="payment_type" id="" placeholder="0 Credit, 1 Debit" required>
            </div>
            <div class="card-num-signup">
                <label for="card_number">Card Number </label>
                <input type="text" name="card_number" id="" placeholder="Format: xxxxxxxxxx" required>
            </div>
            <div class="cvv-signup">
                <label for="cvv">Username: </label>
                <input type="text" name="cvv" id="" placeholder="CVV" required>
            </div>
            <div class="expiry-date-signup">
                <label for="expiry_date">Expiry Date: </label>
                <input type="text" name="expiry_date" id="" placeholder="Format: dd/yy" required>
            </div>
            <div class="submit-buttons">
                    <button type="submit" name="card_payment_signup">Update</button>
                    <a href="../users/users-payment-info.php">Cancel</a>
            </div>
        </form>
    </div>
    <?php include('../templates/footer.php') ?>
</html>