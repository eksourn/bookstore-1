<?php 
    include('../config/db_connection.php');
    include('../variables/variables.php');

    $sql = "SELECT pub_name, pub_address, pub_phone FROM $tbl_publishers;";
    $result = mysqli_query($conn, $sql);
    $publishers = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);

?>

<br>
<h3>Current Publishers</h3>
<div class="input-box"><a href="../signup/publishers-signup.php?next=<?php echo $_SERVER['PHP_SELF']; ?>"><button>Register Publisher</button></a></div>
<table>
    <th>Publisher</th>  
    <th>Address</th>
    <th>Phone</th> 
    <th>Add book</th>
    <th>Delete Publisher</th> 

    <?php foreach($publishers as $pub): ?>
    <tr>
        <td><?php echo $pub['pub_name'];?></td>
        <td><?php echo $pub['pub_address'];?></td>
        <td><?php echo $pub['pub_phone'];?></td>
        <td class="admin"><a href="../publishers/publisher.php?pubname=<?php echo $pub['pub_name'];?>&next=<?php echo $_SERVER['PHP_SELF']; ?>"><button>Add book</button></a></td>
        <td class="admin"><a href="./delete.php?pubname=<?php echo $pub['pub_name'];?>"><button>Delete</button></a></td>
    </tr>

    <?php endforeach; ?>
</table>