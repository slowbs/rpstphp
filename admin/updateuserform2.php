<?php 
	include('functions.php');
	//$ap = isset($_GET['ap']) ? $_GET['ap'] : '';
    //$ap = $_SESSION['user']['apid'];
    if (!isAdmin()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: ../login.php');
		exit();
	}
$id = isset($_GET['id']) ? $_GET['id'] : '';
?>

<!DOCTYPE html>
<html>
<head>
	<title>แก้ไขรหัสผ่าน</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="header">
		<h2>แก้ไขรหัสผ่าน</h2>
	</div>
	
	<form method="post" action="updateuserform2.php?id=<?php echo $id?>">

		<?php echo display_error(); 
		include 'db.php';
		  $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
		  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		        $stmt = $conn->prepare("SELECT * FROM users where id = $id;"); 
				$stmt->execute();
				$result = $stmt->FetchAll(PDO::FETCH_ASSOC);
				foreach($result as $row){
		?>
		<div class="input-group">
			<label>ลำดับชื่อผู้ใช้</label>
			<input type="text" name="id" value="<?php echo $id?>" readonly="readonly">
		</div>
		<div class="input-group">
			<label>ชื่อผู้ใช้</label>
			<input type="text" name="username" value="<?php echo $row['username']?>">
		</div>
		<div class="input-group">
			<label>รหัสผ่านใหม่</label>
			<input type="password" name="passnew_1">
		</div>
		<div class="input-group">
			<label>ยืนยันรหัสผ่านใหม่</label>
			<input type="password" name="passnew_2">
		</div>
		<div>
			<button type="submit" class="btn btn-primary" name="edituser_btn">บันทึก</button>
			<a href="totaluser.php"><button type="button" class="btn btn-danger">ยกเลิก</button></a>
		</div>
		<?php
		}
		?>
	</form>
</body>
</html>