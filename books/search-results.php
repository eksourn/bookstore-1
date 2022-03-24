<?php 
    include('../config/db_connection.php');
    include('../variables/variables.php');
    $is_found = False;
    $search_date = "";
    if(isset($_GET['search_date'])){
        $search_date = $_GET['search_date'];

        if($search_date == ""){
            $is_found = False;
        } else {
            if($search_date=="select"){
                $start_year = "1990";
                $end_year = intval(date("Y")) + 1;
                $sql = "SELECT SUM(book_count) AS best_selling, B.* FROM tbl_order_history AS O INNER JOIN tbl_books AS B ON O.book_id = B.book_id WHERE created_at BETWEEN '$start_year-01-01 00:00:00' AND '$end_year-01-01 00:00:00' GROUP BY O.book_id ORDER BY best_selling DESC LIMIT 1;";
            } else {
                $start_year = $search_date;
                $end_year = intval($search_date) + 1;
                $sql = "SELECT SUM(book_count) AS best_selling, B.* FROM tbl_order_history AS O INNER JOIN tbl_books AS B ON O.book_id = B.book_id WHERE created_at BETWEEN '$start_year-01-01 00:00:00' AND '$end_year-01-01 00:00:00' GROUP BY O.book_id ORDER BY best_selling DESC LIMIT 1;";
            }

            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                $is_found = True;
                $search_books = mysqli_fetch_all($result, MYSQLI_ASSOC);
                mysqli_free_result($result);
            } else {
                $is_found = False;
            }
        } 
    }

    if(isset($_GET['search_title']) && isset($_GET['search_author'])){
        $search_title = $_GET['search_title'];
        $search_author = $_GET['search_author'];
        $sql = "";

        if($search_author == "" && $search_title==""){
            // header('Location: ../index.php');
            $is_found = False;
        } else{
            if($search_author != "" && $search_title=="" ){
                /*
                    SELECT * FROM tbl_books WHERE book_id IN (SELECT book_id FROM tbl_author_books WHERE author_id IN (SELECT author_id FROM tbl_is_author WHERE author_name LIKE '%Jo%'));

                */
                $sql = "SELECT * FROM $tbl_books WHERE book_id IN (SELECT book_id FROM $tbl_author_books WHERE author_id IN (SELECT author_id FROM $tbl_is_author WHERE author_name LIKE '%$search_author%'));";

            } else if ($search_author == "" && $search_title!=""){
                $sql = "SELECT * FROM $tbl_books WHERE title LIKE '%$search_title%';";
            } else {
                $sql = "SELECT * FROM $tbl_books WHERE book_id IN (SELECT book_id FROM $tbl_author_books WHERE author_id IN (SELECT author_id FROM $tbl_is_author WHERE author_name LIKE '%$search_author%') AND title LIKE '%$search_title%');";

            }

            $result = mysqli_query($conn, $sql);
            if(mysqli_num_rows($result) > 0){
                $is_found = True;
                $search_books = mysqli_fetch_all($result, MYSQLI_ASSOC);
                mysqli_free_result($result);
            } else {
                $is_found = False;
            }
        }
    }

?>

<?php 
    include('../templates/header.php');
    include('./search-books.php');
    include('../functions/functions.php');
    function determine_Booktype($type){
        include("../variables/variables.php");
        return $book_types[$type];
    }
    if($is_found){
        $display_books= $search_books;
        if($search_date != ""){
            $search_date = ($search_date == "select") ? "All Time" : $search_date;
            echo "<h3>Best Selling Book of $search_date </h3>";
        }
        include('./display-books.php'); 
    } else{
        echo "<h3> No search result... </h3>";
    }

    include('../templates/footer.php');
?>