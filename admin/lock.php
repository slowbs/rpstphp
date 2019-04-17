<?php
include '../functions.php';
//$ap = isset($_GET['ap']) ? $_GET['ap'] : '';
//$ap = $_SESSION['user']['apid'];
if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
    exit();
}
$y = isset($_GET['y']) ? $_GET['y'] : '';
$ep = isset($_GET['ep']) ? $_GET['ep'] : '';
$status = $_SESSION["y{$y}"]["$ep"];
include 'db.php';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to delete a record
    $sql = "UPDATE year SET status = '1' WHERE year = '$y' and ep = '$ep'";

    // use exec() because no results are returned
    $conn->exec($sql);
    header('location: year.php');
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>

