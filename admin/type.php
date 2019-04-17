<?php
include('functions.php');
	//$ap = isset($_GET['ap']) ? $_GET['ap'] : '';
    //$ap = $_SESSION['user']['apid'];
    if (!isAdmin()) {
		$_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
    exit();
    }
    $y = isset($_GET['y']) ? $_GET['y'] : '';
    $ep = isset($_GET['ep']) ? $_GET['ep'] : '';
    $t = isset($_GET['t']) ? $_GET['t'] : '';
    $month = $_SESSION['quarter']["$ep"];
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
  <style>
.btn{
         margin-bottom:10px;
 }
  </style>
</head>

<body>
<div class="container-fluid" align="center">
<br>
  <?php echo "<h2 align='center'>การประเมินผลการพัฒนางานสาธารณสุข รอบ <strong><span style='color:blue'>$ep</span></strong> เดือน <strong><span style='color:blue'>($month)</span></strong></h2>
  <h2 align='center'>ประจำปีงบประมาณ พ.ศ. <strong><span style='color:blue'>$y</span></strong></h2>"?>
  <div class="container">
  <div style="float: left"><a href="year.php"><button type="button" class="btn btn-success">หน้าหลัก</button></div>
  </div>
  <div class="container">
  <div style="float: right"><a href="../index.php?logout='1'"><button type="button" class="btn btn-danger">ออกจากระบบ</button></a></div>
  <br><br><br><div class="container" align="center">
<?php
include 'db.php';
include '../user/ctype.php';
?>
<br><!--<a href="total.php?y=<?php echo $y?>&ep=<?php echo $ep?>"<button class="btn btn-warning">รายมิติ</button></a>-->
<a href="totaltype.php?y=<?php echo $y?>&ep=<?php echo $ep?>"<button class="btn btn-warning">รวมคะแนนทุกระดับ</button></a>
  <br>
  <!-- <div align="right"><a href="index.php">หน้าหลัก</a></div> -->
</div>

</body>
</html>