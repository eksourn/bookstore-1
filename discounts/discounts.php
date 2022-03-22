<?php 

    include('../config/db_connection.php');
    include('../variables/variables.php');


    $dis_values = array('dis_name'=>"", 'dis_code'=>"", 'dis_percent'=> 0, 'dis_expires'=> "");
    $code ="";
    if(isset($_GET['code'])){
        $code = $_GET['code'];
        $sql = "SELECT discount_code, discount_name, discount_percentage, expired_at FROM $tbl_discounts WHERE discount_code = '$code';";

        $result = mysqli_query($conn, $sql);
        $edit = mysqli_fetch_row($result);
        mysqli_free_result($result);
        $dis_values['dis_name'] = $edit[1];
        $dis_values['dis_code'] = $edit[0];
        $dis_values['dis_percent'] = $edit[2];
        $dis_values['dis_expires'] = explode(' ', $edit[3])[0];
    }

    $sql = "SELECT * FROM $tbl_discounts";
    $result = mysqli_query($conn, $sql);
    $discounts = array();
    if(mysqli_num_rows($result) != 0){
        $discounts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    mysqli_free_result($result);


    if(isset($_POST['cancel'])){
        // if(isset($_GET['code'])){
        //     header('Location: ./discounts.php');
        // } else {
        //     header('Location: ../admin/admin.php');
        // }
        if(isset($_GET['next'])){
            $next = $_GET['next'];
            header("Location: $next?discounts=T");
        }
    }
    

    if(isset($_POST['add_discount'])){
        $dis_name = strtoupper(htmlspecialchars($_POST['dis_name']));
        $dis_code = strtolower(htmlspecialchars($_POST['dis_code']));
        $dis_percent = htmlspecialchars($_POST['dis_percent']);
        $dis_expires = htmlspecialchars($_POST['dis_expires']) . " " .date("H:i:s");
        $dis_created = date("Y-m-d") . " " .date("H:i:s");


        $sql = "INSERT INTO $tbl_discounts(discount_code, discount_name, discount_percentage, created_at, expired_at) VALUES('$dis_code', '$dis_name', '$dis_percent', '$dis_created' ,'$dis_expires');";

        if(mysqli_query($conn, $sql)){
            if(isset($_GET['next'])){
                $next = $_GET['next'];
                header("Location: $next?discounts=T");
            } else {
                header('refresh: 0; url = ./discounts.php');
            }
        } else {
            echo '<script>alert("Unable to add new discounts")</script>';
        }

    }

    if(isset($_POST['edit_discount'])){
        $dis_name = strtoupper(htmlspecialchars($_POST['dis_name']));
        $dis_code = strtolower(htmlspecialchars($_POST['dis_code']));
        $dis_percent = htmlspecialchars($_POST['dis_percent']);
        $dis_expires = htmlspecialchars($_POST['dis_expires']) . " " .date("H:i:s");
        $dis_created = date("Y-m-d") . " " .date("H:i:s");


        $sql = "UPDATE $tbl_discounts SET discount_name = '$dis_name', discount_code = '$dis_code', discount_percentage = '$dis_percent', expired_at = '$dis_expires' WHERE discount_code = '$code';";

        if(mysqli_query($conn, $sql)){
            header('refresh: 0; url = ./discounts.php');
        } else {
            echo '<script>alert("Unable to edit discount!)</script>';
        }

    }

    function tick_gen($datetime){
        $db_date_time = new DateTime($datetime);
        $current_date_time = new DateTime("now");
        if($db_date_time < $current_date_time){
            return "&#10761;";
        }       
        return "&#10004;";
    }

?>

<!DOCTYPE html>
<html lang="en">
    <?php include('../templates/header.php'); ?>

    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
        <div class="input-box">
            <label for="dis-code">CODE:</label>
            <input type="text" name="dis_code" id="dis-code" value="<?php echo $dis_values['dis_code']; ?>">
        </div>
        <div class="input-box">
            <label for="dis-name">NAME:</label>
            <input type="text" name="dis_name" id="dis-name" value="<?php echo $dis_values['dis_name']; ?>">
        </div>
        <div class="input-box">
            <label for="dis-percent">PERCENT:</label>
            <input type="number" name="dis_percent" id="dis-percent" placeholder="0.00" step="0.01" min="0" max="100" value="<?php echo $dis_values['dis_percent']; ?>">
        </div>
        <div class="input-box">
            <label for="dis-expires">EXPIRY:</label>
            <input type="date" name="dis_expires" id="dis-expires"  value="<?php echo $dis_values['dis_expires']; ?>">
        </div>
        <div class="input-box">
            <?php if(isset($_GET['code'])): ?>
                <input type="submit" name="edit_discount" value="Save">
            <?php else: ?>
                <input type="submit" name="add_discount" value="Add">
            <?php endif; ?>
                <input type="submit" name="cancel" value="Cancel">    
        </div>   
        
    </form>

    <hr>
    <h3>Available Discounts</h3>
    <table>
        <th></th>
        <th>Discount name</th>
        <th>Discount Code</th>
        <th>Discount Percent</th>
        <th>Created At</th>
        <th>Expired At</th>

        <?php foreach($discounts as $discount): ?>
            <tr>
                <td style="text-align:center; font-size: 18px; font-weight: bold;">
                    <?php echo tick_gen($discount['expired_at']); ?>
                </td>
                <td><?php echo $discount['discount_name'] ?></td>
                <td><a href="./discounts.php?code=<?php echo $discount['discount_code']; ?>"><?php echo $discount['discount_code']; ?></a></td>
                <td><?php echo $discount['discount_percentage'] ?></td>
                <td><?php echo $discount['created_at'] ?></td>
                <td><?php echo $discount['expired_at'] ?></td>
            </tr>

        <?php endforeach; ?>

    </table>


    <?php include('../templates/footer.php'); ?>
</html>