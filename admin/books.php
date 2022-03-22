<?php 
    include('../config/db_connection.php');
    include('../variables/variables.php');
    include('../functions/functions.php');
    

    $sql = "SELECT tbl_books.book_id, tbl_books.isbn, tbl_books.title, tbl_books.genre, tbl_books.book_type, tbl_books.price, tbl_books.rating, tbl_books.publisher_name FROM $tbl_books";

    $result = mysqli_query($conn, $sql);
    $books = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    
    function determine_Booktype($type){
        include("../variables/variables.php");
        return $book_types[$type];
    }

?>

<br>
<h2>Books</h2>
<div class="input-box"><h3>TO ADD BOOK, PLEASE GO FROM PUBLISHER</h3></div>
<table>
    <tr>
        <th>Publisher</th>
        <th>Title</th>
        <th>ISBN</th>
        <th>Genre</th>
        <th>Book Type</th>
        <th>Price</th>
        <th>Rating</th>
        <th>Authors</th>
        <th>Remove</th>
    </tr>

    <?php foreach($books as $book): ?>
            <tr>
                <td><?php echo $book['publisher_name'] ?></td>
                <td><a href="../books/edit-books.php?id=<?php echo $book['book_id'] ?>&next=<?php echo $_SERVER['PHP_SELF']; ?>"><?php echo $book['title'] ?></a></td>
                <td><?php echo $book['isbn'] ?></td>
                <td><?php echo $book['genre'] ?></td>
                <td><?php echo determine_Booktype($book['book_type']); ?></td>
                <td><?php $number = sprintf('%.2f', $book['price']); echo '$'.$number;  ?></td>
                <td><?php echo $book['rating'] ?></td>
                <td><?php  echo get_author_for_each_book($book['book_id'], $conn);?></td>

                <td style="text-align:center;">
                    <a href="./delete.php?id_to_del=<?php echo $book['book_id']; ?>"><button>Delete</button></a>
                </td>
            </tr>
        <?php endforeach; ?>
</table>
