<?php 
    include('../config/db_connection.php');
    include('../variables/variables.php');

    /*
        SELECT user_d, f_name, l_name, username FROM tbl_users 
        WHERE user_id IN (
            SELECT user_id
            FROM tbl_is_author
            );
    */

    $sql = "SELECT user_id, f_name, l_name, username FROM $tbl_users WHERE user_id IN (SELECT user_id FROM tbl_is_author);";
    $result = mysqli_query($conn, $sql);
    $users = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
?>
<br>
<h2>Authors</h2>
<div class="input-box"><h3>TO DELETE AN AUTHOR, PLEASE GO TO USER PANEL</h3></div>
<table>
    <th>id</th>
    <th>name</th>
    <th>username</th>

    <?php foreach($users as $user): ?>
    <tr>
        <td class="admin"><?php echo $user['user_id'] ?></td>
        <td class="admin"><?php echo $user['f_name'] .' '.$user['l_name']; ?></td>
        <td class="admin"><?php echo $user['username']; ?></td>
    </tr>

    <?php endforeach; ?>



</table>