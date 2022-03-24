<?php 
    include('../config/db_connection.php');
    include('../variables/variables.php');

    $sql = "SELECT $tbl_users.user_id, f_name, l_name, username, address_line1, address_line2, city, postal_code, telephone, mobile, country FROM $tbl_users LEFT JOIN $tbl_user_address ON $tbl_users.user_id = $tbl_user_address.user_id;";
    $result = mysqli_query($conn, $sql);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);

    function concut_address($address){
        $line1 = ($address['address_line1']=="")? "": $address['address_line1']. ', ' ;
        $line2 = ($address['address_line2'] == "") ? "" : $address['address_line2']. ', ' ;
        $city = ($address['city']=="")? "": $address['city']. ', ' ;
        $postal = ($address['postal_code']=="")? "": $address['postal_code']. ', ' ;
        $country = ($address['country']=="")?"": $address['country'];

        $addr = $line1 . $line2 . $city . $postal .$country;
        return $addr;
    }

?>
<br>
<h2>Users</h2>
<table>
    <th>id</th>
    <th>name</th>
    <th>username</th>
    <th>Address</th>
    <th></th>

    <?php foreach($users as $user): ?>
    <tr>
        <td class="admin"><?php echo $user['user_id'] ?></td>
        <td class="admin"><?php echo $user['f_name'] .' '.$user['l_name']; ?></td>
        <td class="admin"><?php echo $user['username']; ?></td>
        <td class="admin"><?php echo concut_address($user);?></td>
        <td class="admin"><a href="./delete.php?id=<?php echo $user['user_id'] ?>"><button>Delete</button></a></td>
    </tr>

    <?php endforeach; ?>



</table>