<?php
	include('../functions.php');
	//$ap = isset($_GET['ap']) ? $_GET['ap'] : '';
    //$ap = $_SESSION['user']['apid'];
    if (!isAdmin()) {
		$_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
    exit();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap 4 Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <?php
  $y = isset($_GET['y']) ? $_GET['y'] : '';
  $t = isset($_GET['t']) ? $_GET['t'] : '';
  $ep = isset($_GET['ep']) ? $_GET['ep'] : '';
  $typename = $_SESSION['typename'][$t];
  $month = $_SESSION['quarter']["$ep"];
  ?>
  <style>
  @page {
    size: auto;
}
</style>
</head>

<body>

<div class="container-fluid" align="center">
<br>
<?php echo "<h2 align='center'>การประเมินผลการพัฒนางานสาธารณสุข รอบ <strong><span style='color:blue'>$ep</span></strong> เดือน <strong><span style='color:blue'>($month)</span></strong></h2>"?>
<?php echo "<h2 align='center'>รายมิติ ระดับ <strong><span style='color:blue'>$typename</span></strong> ประจำปีงบประมาณ พ.ศ. <strong><span style='color:blue'>$y</span></strong></h2>";?>
</div>
<div class="container">
<?php include 'headbutform.php' ?>
<br>
<table class="table table-hover table-bordered table-striped table-sm">
  <thead style="text-align:center" class="thead-dark">
    <tr>
      <th scope="col">ลำดับที่</th>
      <th scope="col">ชื่อ</th>
      <th scope="col">มิติที่ 1</th>
      <th scope="col">มิติที่ 2</th>
      <th scope="col">มิติที่ 3</th>
      <th scope="col">มิติที่ 4</th>
      <th scope="col">รวม 4 มิติ</th>
      <th scope="col">คะแนนรวม</th>
    </tr>
  </thead>
  <tbody style="text-align:center">
  <?php
include 'db.php';
$i = 0;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM total_score where time = $y && ep = $ep && type = $t order by mp5 desc;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
             $i+=1;
            ?><tr>
      <th scope="row"><?php echo $i ?></th>
      <td><?php echo $row['name']?></td>
      <td><?php echo $row['mp1']?></td>
      <td><?php echo $row['mp2']?></td>
      <td><?php echo $row['mp3']?></td>
      <td><?php echo $row['mp4']?></td>
      <td><?php echo $row['mp5']?></td>
      <td><?php echo $row['m5']?></td>
    </tr>
    <?php
        }  
    }
    catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
        }
    
    $conn = null;
?>
  </tbody>
</table>
</div>

</body>
</html>