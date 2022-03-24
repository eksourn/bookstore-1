<?php
    include('../config/db_connection.php');
    include('../functions/functions.php');
    include('../variables/variables.php');
    $sql = "INSERT INTO tbl_user_order(user_id) VALUE(1);";
    if(mysqli_query($conn, $sql)){
        $new_order_id = mysqli_insert_id($conn);
        echo "Last inserted order id was " . $new_order_id;
        $sql = "INSERT INTO tbl_order_history(order_id, book_id, amount, book_count) VALUES('$new_order_id', '1', '23.44', '5'), ('$new_order_id', '2', '23.44', '2'),('$new_order_id', '3', '12.39', '1'),('$new_order_id', '4', '12.48', '2'); ";

        if(mysqli_query($conn, $sql)){
            echo "Successfully inserted";
        } else{
            echo "insert to order history error";
        }

        
    } else {
        echo "create new order id error";
    }




    
?>

