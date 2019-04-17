<?php
include '../functions.php';
//$ap = isset($_GET['ap']) ? $_GET['ap'] : '';
//$ap = $_SESSION['user']['apid'];
if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
    exit();
}
$id = isset($_GET['id']) ? $_GET['id'] : '';
include 'db.php';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM year where id = '$id';";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row){
        $y = $row['year'];
        $ep = $row['ep'];
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // sql to delete a record
            $sql = "DELETE from year where year = $y and ep = $ep;
            DELETE from log where year = $y and ep = $ep;
            DELETE from total_score where time = $y and ep = $ep;
            DELETE FROM ap1 where year = $y and ep = $ep;
            DELETE FROM ap2 where year = $y and ep = $ep;
            DELETE FROM ap3 where year = $y and ep = $ep;
            DELETE FROM ap4 where year = $y and ep = $ep;
            DELETE FROM ap5 where year = $y and ep = $ep;
            DELETE FROM ap6 where year = $y and ep = $ep;
            DELETE FROM ap7 where year = $y and ep = $ep;
            DELETE FROM ap8 where year = $y and ep = $ep;
            DELETE FROM ap9 where year = $y and ep = $ep;
            DELETE FROM ap10 where year = $y and ep = $ep;
            DELETE FROM ap11 where year = $y and ep = $ep;
            DELETE FROM ap12 where year = $y and ep = $ep;
            DELETE FROM ap13 where year = $y and ep = $ep;
            DELETE FROM ap14 where year = $y and ep = $ep;
            DELETE FROM ap15 where year = $y and ep = $ep;
            DELETE FROM ap16 where year = $y and ep = $ep;
            DELETE FROM ap17 where year = $y and ep = $ep;
            DELETE FROM ap18 where year = $y and ep = $ep;
            DELETE FROM ap19 where year = $y and ep = $ep;
            DELETE FROM ap20 where year = $y and ep = $ep;
            DELETE FROM ap21 where year = $y and ep = $ep;
            DELETE FROM ap22 where year = $y and ep = $ep;
            DELETE FROM ap23 where year = $y and ep = $ep;";
            // use exec() because no results are returned
            $conn->exec($sql);
            header('location: year.php');
    }  
}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>

