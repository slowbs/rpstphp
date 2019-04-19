<?php
include ('functions.php');
include 'db.php';
//echo $_SESSION['abc']; // ผลลัพธ์คือแสดงข้อความ Hello 
//$count = isset($_POST['count']) ? $_POST['count'] : '';
$tambon = isset($_POST['tambon']) ? $_POST['tambon'] : '';
$amphur = isset($_POST['amphur']) ? $_POST['amphur'] : '';
$village = isset($_POST['village']) ? $_POST['village'] : '';
$address = isset($_POST['address']) ? $_POST['address'] : '';
$nurse = isset($_POST['nurse']) ? $_POST['nurse'] : '';
$academic = isset($_POST['academic']) ? $_POST['academic'] : '';
$officer = isset($_POST['officer']) ? $_POST['officer'] : '';
$thaimed = isset($_POST['thaimed']) ? $_POST['thaimed'] : '';
$physic = isset($_POST['physic']) ? $_POST['physic'] : '';
$dentist = isset($_POST['dentist']) ? $_POST['dentist'] : '';
$other = isset($_POST['other']) ? $_POST['other'] : '';
$total = isset($_POST['total']) ? $_POST['total'] : '';


$hospcode = isset($_GET['hospcode']) ? $_GET['hospcode'] : '';
$ap = $_SESSION['user']['username'];
//$ep = isset($_GET['ep']) ? $_GET['ep'] : '';
//$t = isset($_GET['t']) ? $_GET['t'] : '';
if (!isset($_SESSION['user']) || $_SESSION['user']['hospcode'] != $hospcode){
    header('location: login.php');
    exit();
    }
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $sql = "UPDATE info SET amphur = '$amphur', tambon = '$tambon', village = '$village', 
            address = '$address', academic = '$academic', nurse = '$nurse', dentist = '$dentist',
            officer = '$officer', thaimed = '$thaimed', physic = '$physic', other = '$other',
             total = '$total',updated_time = NOW(), updated_by = '$ap' 
            where hospcode = '$hospcode';";

    // Prepare statement
    $stmt = $conn->prepare($sql);

    // execute the query
    $stmt->execute();

    // echo a message to say the UPDATE succeeded
    //echo $stmt->rowCount() . " records UPDATED successfully";
    echo "<script>
alert('แก้ไขสำเร็จ');
window.location.href='info.php?id=$ap';
</script>";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>
