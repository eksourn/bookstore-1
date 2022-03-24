<?php 
    include('../config/db_connection.php');
    include('../variables/variables.php');
    include('../functions/functions.php');
    if(isset($_GET['id_to_del'])){
        $id_to_del =  htmlspecialchars($_GET['id_to_del']);
        $sql = "DELETE FROM $tbl_books WHERE book_id = '$id_to_del';";

        if(mysqli_query($conn, $sql)){
            header('Location: ./admin.php?books=T');
        } else {
            echo '<script>alert("Unable to delete selected book!")</script>';
        }
    }

    if(isset($_GET['name'])){
        $dis_code = $_GET['name'];
        $sql = "DELETE FROM $tbl_discounts WHERE discount_code = '$dis_code';";
        if(mysqli_query($conn, $sql)){
            header('Location: ./admin.php?discounts=T');
        }
    }

    if(isset($_GET['pubname'])){
        $pub = $_GET['pubname'];
        $sql = "DELETE FROM $tbl_publishers WHERE pub_name='$pub';";
        if(mysqli_query($conn, $sql)){
            header('Location: ./admin.php?pub=T');
        }
    }
?>