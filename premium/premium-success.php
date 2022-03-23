<?php 
    include('../templates/header.php');

    //  Calculate end date code provided by https://stackoverflow.com/questions/2870295/increment-date-by-one-month
    function add_months($months, DateTime $dateObject) {
        $next = new DateTime($dateObject->format('Y-m-d'));
        $next->modify('last day of +'.$months.' month');

        if($dateObject->format('d') > $next->format('d')) {
            return $dateObject->diff($next);
        } else {
            return new DateInterval('P'.$months.'M');
        }
    }

    function endCycle($d1, $months) {
        $date = new DateTime($d1);

        // call second function to add the months
        $newDate = $date->add(add_months($months, $date));

        //formats final date to Y-m-d form
        $dateReturned = $newDate->format('Y-m-d'); 

        return $dateReturned;
    }
?>
<?php

    include('../config/db_connection.php');
    include('../variables/variables.php');
    include('../functions/functions.php');

    //  Session start
    session_start();

    $user_id = htmlspecialchars($_SESSION['user_id']);

    //  Default time zone
    date_default_timezone_set('EST');
    //  Gets current date in format YYYY-MM-DD
    $curr_date = date("Y-m-d");
    //  Output end date
    $final = endCycle($curr_date, 3);
   /* echo $curr_date;
    echo "<br>";
    echo $final;*/

    $sql = "INSERT INTO tbl_user_premium (user_id, start_date, end_date) VALUES ('$user_id', '$curr_date', '$final')";
    
    if (mysqli_query($conn, $sql)) {
        echo '<script>alert("Success! You are now a premium member.")</script>';
        header("Location: ../premium/users-premium.php");
    }
    else {
        echo "";
    }
    exit();

?>
