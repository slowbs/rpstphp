<?php
include 'functions.php';
include 'db.php';
if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
    exit();
}
//echo $_SESSION['abc']; // ผลลัพธ์คือแสดงข้อความ Hello 

//$count = isset($_POST['count']) ? $_POST['count'] : '';
$y = isset($_GET['y']) ? $_GET['y'] : '';
$ap = isset($_GET['ap']) ? $_GET['ap'] : '';
$ep = isset($_GET['ep']) ? $_GET['ep'] : '';
$t = isset($_GET['t']) ? $_GET['t'] : '';
//$apname = $_SESSION['name'][$ap];
$score = isset($_POST['score']) ? $_POST['score'] : '';
$score2 = isset($_POST['score2']) ? $_POST['score2'] : '';
$scorei = isset($_POST['scorei']) ? $_POST['scorei'] : '';
$score2i = isset($_POST['score2i']) ? $_POST['score2i'] : '';
$userd = $_SESSION['user']['username'];
if ( isset( $_POST['input'] ) ){
foreach ($_POST['input'] as $key => $value) {
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sql = "UPDATE ap$ap SET value = '$value', valuegane = '$score[$key]', valuekoon = '$score2[$key]'  
        where rid = '$key' and type = '$t' and year = '$y' and ep = '$ep';
        UPDATE log SET time = NOW(), username = '$userd' 
        where apid = '$ap' && year = '$y' && ep = '$ep' && type = '$t';
        ";
    
        // Prepare statement
        $stmt = $conn->prepare($sql);
    
        // execute the query
        $stmt->execute();
    
        // echo a message to say the UPDATE succeeded
        
        //header("Location:selectbootstrap.php");
        }

    catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
        }
    
    $conn = null;
}
if ( isset( $_POST['input2'] ) ){
    foreach ($_POST['input2'] as $key2 => $value) {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $sql = "UPDATE total_score SET m$key2 = '$scorei[$key2]', mp$key2 = '$score2i[$key2]' 
            where apid = '$ap' && time = '$y' && ep = '$ep' && type = '$t';
            UPDATE log SET time = NOW(), username = '$userd' 
            where apid = '$ap' && year = '$y' && ep = '$ep' && type = '$t';
            ";
        
            // Prepare statement
            $stmt = $conn->prepare($sql);
        
            // execute the query
            $stmt->execute();
        
            // echo a message to say the UPDATE succeeded
            
            //header("Location:selectbootstrap.php");
            }
    
        catch(PDOException $e)
            {
            echo $sql . "<br>" . $e->getMessage();
            }
        
        $conn = null;
    }

}
echo "<script>
alert('แก้ไขสำเร็จ');
window.location.href='form.php?y=$y&ap=$ap&ep=$ep&t=$t';
</script>";
}
?>