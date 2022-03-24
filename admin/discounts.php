<?php
   include('../config/db_connection.php');
   include('../variables/variables.php');

    $sql = "SELECT * FROM $tbl_discounts";
    $result = mysqli_query($conn, $sql);
    $discounts = array();
    if(mysqli_num_rows($result) != 0){
        $discounts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    mysqli_free_result($result);

    function tick_gen($datetime){
        $db_date_time = new DateTime($datetime);
        $current_date_time = new DateTime("now");
        if($db_date_time < $current_date_time){
            return "&#10761;";
        }       
        return "&#10004;";
    }

?>

<br>
<h3>Available Discounts</h3>

<div class="input-box"><a href="../discounts/discounts.php?next=<?php echo $_SERVER['PHP_SELF']; ?>"><button>Add Discount</button></a></div>
<table>
    <th></th>
    <th>Discount name</th>
    <th>Discount Code</th>
    <th>Discount Percent</th>
    <th>Created At</th>
    <th>Expired At</th>
    <th>Delete</th>

    <?php foreach($discounts as $discount): ?>
        <tr>
            <td style="text-align:center; font-size: 18px; font-weight: bold;">
                <?php echo tick_gen($discount['expired_at']); ?>
            </td>
            <td><?php echo $discount['discount_name'] ?></td>
            <td><a href="../discounts/discounts.php?code=<?php echo $discount['discount_code']; ?>&next=<?php echo $_SERVER['PHP_SELF']; ?>"><?php echo $discount['discount_code']; ?></a></td>
            <td><?php echo $discount['discount_percentage'] ?></td>
            <td><?php echo $discount['created_at'] ?></td>
            <td><?php echo $discount['expired_at'] ?></td>
            <td><a href="./delete.php?name=<?php echo $discount['discount_code'] ?>"><button>Delete</button></a></td>
        </tr>

    <?php endforeach; ?>

</table>