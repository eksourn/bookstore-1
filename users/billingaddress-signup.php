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
    $sql = "SELECT user_id FROM $tbl_user_address WHERE user_id = $user_id";
    $result = mysqli_query($conn, $sql);
    $total_users = mysqli_num_rows($result);
    mysqli_free_result($result);

    //  Check if billing address info already exits
    if ($total_users == 0) {
        //  If no info exists add it
        if(isset($_POST['billing_address_signup'])) {
            $address1 = htmlspecialchars($_POST['address_line1']);
            $address2 = htmlspecialchars($_POST['address_line2']);
            $city = htmlspecialchars($_POST['city']);
            $postal_code = htmlspecialchars($_POST['postal_code']);
            $telephone = htmlspecialchars($_POST['telephone']);
            $mobile = htmlspecialchars($_POST['mobile']);
            $country = htmlspecialchars($_POST['country']);
            
            $sql = "INSERT INTO $tbl_user_address (user_id, address_line1, address_line2, city, postal_code, telephone, mobile, country) VALUES ('$user_id', '$address1', '$address2', '$city', '$postal_code', '$telephone', '$mobile', '$country')";
    
            if(mysqli_query($conn, $sql)) {
                $SESSION['address1'] = $address1;
                $SESSION['address2'] = $address2;
                $SESSION['city'] = $city;
                $SESSION['postal_code'] = $postal_code;
                $SESSION['telephone'] = $telephone;
                $SESSION['mobile'] = $mobile;
                $SESSION['country'] = $country;
                    
                echo '<script>alert("Success! Info has been updated.")</script>';
                header('Location: ../users/users-payment-info.php');
            } else {
                echo '<script>alert("Error with updating information!")</script>';
            } 
        } else if(isset($_POST['cancel_signup'])) {
            header('Location: ../users/users-payment-info.php');
        }
    }
    //  Else update info
    else {
        if(isset($_POST['billing_address_signup'])) {
            $address1 = htmlspecialchars($_POST['address_line1']);
            $address2 = htmlspecialchars($_POST['address_line2']);
            $city = htmlspecialchars($_POST['city']);
            $postal_code = htmlspecialchars($_POST['postal_code']);
            $telephone = htmlspecialchars($_POST['telephone']);
            $mobile = htmlspecialchars($_POST['mobile']);
            $country = htmlspecialchars($_POST['country']);
            
            $sql = "UPDATE $tbl_user_address SET address_line1 = '$address1', address_line2 = '$address2', city = '$city', postal_code = '$postal_code', telephone = '$telephone', mobile = '$mobile', country = '$country' WHERE user_id = '$user_id'";
    
            if(mysqli_query($conn, $sql)) {
                $SESSION['address1'] = $address1;
                $SESSION['address2'] = $address2;
                $SESSION['city'] = $city;
                $SESSION['postal_code'] = $postal_code;
                $SESSION['telephone'] = $telephone;
                $SESSION['mobile'] = $mobile;
                $SESSION['country'] = $country;
                    
                echo '<script>alert("Success! Info has been updated.")</script>';
                header('Location: ../users/users-payment-info.php');
    
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
            <h3>Billing Address Info</h3>
            <div class="addressl1-signup">
                <label for="address_line1">Address Line 1 </label>
                <input type="text" name="address_line1" id="address_line1" value= "<?= $_SESSION['address_line1'] ?>" placeholder="Address Line 1">
            </div>
            <div class="addressl2-signup">
                <label for="address_line2">Address Line 2 </label>
                <input type="text" name="address_line2" id="address_line2" value= "<?= $_SESSION['address_line2'] ?>" placeholder="Address Line 2">
            </div>
            <div class="city-signup">
                <label for="city">City: </label>
                <input type="text" name="city" id="city" value= "<?= $_SESSION['city'] ?>" placeholder="City">
            </div>
            <div class="postal-signup">
                <label for="postal_code">Postal Code: </label>
                <input type="text" name="postal_code" id="postal_code" value= "<?= $_SESSION['postal_code'] ?>" placeholder="Postal Code">
            </div>
            <div class="telephone-signup">
                <label for="telephone">Telephone </label>
                <input type="text" name="telephone" id="telephone" value= "<?= $_SESSION['telephone'] ?>" placeholder="Format: xxxxxxxxx">
            </div>
            <div class="mobile-signup">
                <label for="mobile">Mobile </label>
                <input type="text" name="mobile" id="mobile" value= "<?= $_SESSION['mobile'] ?>" placeholder="Format: xxxxxxxxxx">
            </div>
            <div class="country-signup">
                <label for="country">Country: </label>
                <input type="text" name="country" id="country" value= "<?= $_SESSION['country'] ?>" placeholder="Country">
            </div>
            <div class="submit-buttons">
                    <button type="submit" name="billing_address_signup">Update</button>
                    <a href="../users/users-payment-info.php">Cancel</a>
            </div>
        </form>
    </div>
    <?php include('../templates/footer.php') ?>
</html>