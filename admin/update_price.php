<?php 
    include('../config/db_connection.php');
    include('../variables/variables.php');
    include('../functions/functions.php');

    if(isset($_GET['new_price']) and isset($_GET['id'])){
        $price = $_GET['new_price'];
        $id = $_GET['id'];

        $sql = "UPDATE $tbl_shipping_methods SET price = $price WHERE ship_id=$id;";
        if(mysqli_query($conn, $sql)){
            header("Location: ./admin.php?ship=T");
        }
    }


?>