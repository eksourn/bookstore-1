<?php
    $op = array('users'=>FALSE, 'books'=>FALSE, "publishers"=>FALSE, "discounts"=>FALSE, "authors"=>FALSE, "orders"=> FALSE );
    print_r($op);
    if(isset($_POST['admin_users'])){
        $op['users'] = TRUE;
    } else if(isset($_POST['admin_books']) or isset($_GET['books'])){
        $op['books'] = TRUE;
    } else if(isset($_POST['admin_publishers']) or isset($_GET['pub'])){
        $op['publishers'] = TRUE;
    }else if(isset($_POST['admin_discounts']) or isset($_GET['discounts'])){
        $op['discounts'] = TRUE;
    }else if(isset($_POST['admin_authors'])){
        $op['authors'] = TRUE;
    }else if(isset($_POST['admin_orders'])){
        $op['orders'] = TRUE;
    }


?>


<!DOCTYPE html>
<html lang="en">
    <?php include('../templates/header.php'); ?>
    <h2>Admin Panel</h2>
    <hr>

    <h3>Create/ Read/ Update/ Delete</h3>

    <table>
        <th>Users</th>
        <th>Books</th>
        <th>Publishers</th>
        <th>Discounts</th>
        <th>Authors</th>
        <th>Orders</th>
        <form action="./admin.php" method="post">
            <tr >
                <td class="admin"><input type="submit" value="Users" name="admin_users"></td>    
                <td class="admin"><input type="submit" value="Books" name="admin_books"></td>    
                <td class="admin"><input type="submit" value="Publishers" name="admin_publishers"></td>    
                <td class="admin"><input type="submit" value="Discounts" name="admin_discounts"></td>    
                <td class="admin"><input type="submit" value="Authors" name="admin_authors"></td>    
                <td class="admin"><input type="submit" value="Orders" name="admin_orders"></td>    
            </tr>
        </form>
    </table>
    <hr>

    <?php 
        if($op['users']){include('./users.php'); }
        else if ($op['books']){include('./books.php');}
        else if ($op['publishers']){include('./publishers.php'); }
        else if ($op['discounts']){ include('./discounts.php');}
        else if ($op['authors']){ include('./authors.php');}
        else if ($op['orders']){ include('./orders.php');}
        
    ?>


    
    <?php include('../templates/footer.php'); ?>
    

</html>