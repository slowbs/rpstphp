<?php 
	include('functions.php');
	//$ap = isset($_GET['ap']) ? $_GET['ap'] : '';
    //$ap = $_SESSION['user']['apid'];
    if (!isLoggedIn()) {
		$_SESSION['msg'] = "You must log in first";
    header('location: login.php');
    exit();
    }
    $ap = $_SESSION['user']['hospcode'];
    $id = $_SESSION['user']['id'];
    $username = $_SESSION['user']['username'];

$fn = isset($_GET['fn']) ? $_GET['fn'] : '';
include 'db.php';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // sql to delete a record
    $sql = "DELETE FROM images WHERE name = '$fn'";

    // use exec() because no results are returned
    $conn->exec($sql);
    unlink('upload/'.$fn);
    header('location: edit.php#nav-profile');
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>

