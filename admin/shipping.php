<?php 
    include('../config/db_connection.php');
    include('../variables/variables.php');
    include('../functions/functions.php');

    $sql = "SELECT * FROM $tbl_shipping_methods ORDER BY is_premium, book_type DESC;";
    $result = mysqli_query($conn, $sql);
    $methods = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);

    function determine_Booktype($type){
        include("../variables/variables.php");
        return strtoupper($book_types[$type]);
    }


?>

<br>
<h3>Available Discounts</h3>

<table>
    <th>Book Type</th>
    <th>Premium</th>    
    <th>Method</th>
    <th>Price</th>
    <th>Update Price</th>

    <?php foreach($methods as $method): ?> 
    <tr>
        <td class="admin"><?php echo determine_Booktype($method['book_type']); ?></td>
        <td class="admin"><?php echo ($method['is_premium'])? "YES" : "NO";?></td>
        <td class="admin"><?php echo $method['shipping_method']; ?></td>
        <td class="admin"><?php echo "$". $method['price']; ?></td>
        <td class="admin"><a href="./admin.php?shipupdate=T&id=<?php echo $method['ship_id']; ?> &next=<?php echo $_SERVER['PHP_SELF']; ?>&ship=T"><button>Update</button></a></td>
    </tr>

    <?php endforeach; ?>
</table>

<?php 
    if(isset($_GET['shipupdate']) and isset($_GET['id'])): 
    $id = $_GET['id'];
    $sql = "SELECT * FROM $tbl_shipping_methods WHERE ship_id = $id;";
    $result = mysqli_query($conn, $sql);
    $edit = mysqli_fetch_row($result);
    mysqli_free_result($result);
    
?>
<hr><br>
<h3>Edit</h3>
<h2><?php print_r($edit); ?></h2>
<table>
    <th>Book Type</th>
    <th>Premium</th>    
    <th>Method</th>
    <th>Price</th>
    <th>Update Price</th>
    <tr>
        <td class="admin"><?php echo determine_Booktype($edit[1]); ?></td>
        <td class="admin"><?php echo ($edit[2])? "YES" : "NO";?></td>
        <td class="admin"><?php echo $edit[3]; ?></td>
        <td class="admin"><?php echo "$". $edit[4]; ?></td>
        <td class="admin">
            <form action="./update_price.php?id=<?php echo $id; ?>" method="GET">
            <input type="hidden" name= "id" value="<?php echo $edit[0]; ?>">
                <input  type="number" name="new_price" id="" value="<?php echo "$". $edit[4]; ?>" placeholder="0.00" step="0.01" min="0" max="100">
            </form>

        </td>
    </tr>
</table>

<?php endif; ?>