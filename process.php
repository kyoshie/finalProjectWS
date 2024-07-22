<?php 
function insert_data($title, $date, $volume, $issue) {
    require_once "connection.php";

    $sql = "INSERT INTO journals (title, date, volume, issue)
            VALUES ('$title', '$date', '$volume', '$issue')";

    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    if ($result) {
        header("Location: admin.php");
        exit();
    } else {
        echo "Error: ";
    }
}


if (isset($_POST['submit'])) {
    if (($_POST['title']=='') || ($_POST['date']=='' )|| ($_POST['issue']=='') || ($_POST['volume']=='' )) {
        header ('location: admin.php');
    }

    else {
        insert_data($_POST['title'], $_POST['date'], $_POST['issue'], $_POST['volume']);
    }
} else {
    include('connection.php');

}


?>


<