<?php
    function check_page_path(){
        $path = $_SERVER['PHP_SELF'];
        if ($path == '/bookstore/index.php'){
            return './index.php';
        }
        return '../index.php';
    }

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Store</title>
    <style>
    table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    th {text-align: center;}
    button:hover {cursor: pointer;}
    label {
        display: inline-block;
        width: 75px;
    }


    .input-box {margin-bottom: 10px;}
    .admin {text-align: center;}

    .center {
        position: absolute;
        left: 50%;
        top: 30%;
        transform: translate(-50%, -50%);
        border: 2px solid #000;
        padding: 10px;
        border-radius: 10px;
    }

    .index-center {text-align: center;}
    .book_author-checkbox{
        margin-left: 80px;
        margin-top: 10px;
        border:1px solid #000; 
        width:150px; 
        height: 100px; 
        overflow-y: scroll; 
    }

    <?php if(isset($_GET['next'])): ?>
 
            a {
                pointer-events: none;
            }
 
    <?php endif; ?>
    

</style>
</head>
<body>
    <div class="title-container">
        <h1 class="title-col"><a href="<?php echo check_page_path(); ?>" style="text-decoration: none; color: black; pointer-events:all;">BookStore: DB2 Project</a></h1>
    </div>
    <hr>