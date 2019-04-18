<?php include('functions.php');
$id = isset($_GET['id']) ? $_GET['id'] : '';
if (!isset($_SESSION['user']) || $_SESSION['user']['id'] != $id){
	header('location: login.php');
	exit();
    }
?>

<!DOCTYPE html>
<html>
<head>
	<title>แก้ไขรหัสผ่าน</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <script src="fuk.js"></script>
</head>
<body>
<div class="container" align="center">
<div class="col-md-6">
	<div class="header">
		<h2>แก้ไขรหัสผ่าน</h2>
	</div>
	
	<form method="post" action="updateuserform.php?id=<?php echo $id?>">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>รหัสผ่านเก่า</label>
			<input type="password" name="passold">
		</div>
<!-- 		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div> -->
		<div class="input-group">
			<label>รหัสผ่านใหม่</label>
			<input type="password" name="passnew_1">
		</div>
		<div class="input-group">
			<label>ยืนยันรหัสผ่านใหม่</label>
			<input type="password" name="passnew_2">
			<input type="hidden" name="id">
		</div>
		<br>
		<div align="right">
			<button type="submit" class="btn btn-primary" name="updateuser_btn">บันทึก</button>
			<a href="../user"><button type="button" class="btn btn-danger">ยกเลิก</button></a>
		</div>
	</form>
	</div>
	</div>
</body>
</html>