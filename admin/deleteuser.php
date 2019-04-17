<?php
include '../functions.php';
//$ap = isset($_GET['ap']) ? $_GET['ap'] : '';
//$ap = $_SESSION['user']['apid'];
if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
    exit();
}
    $username = $_SESSION['user']['username'];

    $fn = isset($_GET['fn']) ? $_GET['fn'] : '';
    $ap = isset($_GET['ap']) ? $_GET['ap'] : '';
include 'db.php';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to delete a record
    $sql = "DELETE FROM images WHERE name = '$fn'";

    // use exec() because no results are returned
    $conn->exec($sql);
    unlink('../user/upload/'.$fn);
    header("location: edit.php?id=$ap#nav-profile");
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>

