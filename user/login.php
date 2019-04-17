<?php include('functions.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>เข้าสู่ระบบ</title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container" align="center">
<div class="col-md-6">
	<div class="header">
		<h2>เข้าสู่ระบบ</h2>
	</div>
	
	<form method="post" action="login.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>ชื่อผู้ใช้</label>
			<input type="text" name="username" >
		</div>
		<div class="input-group">
			<label>รหัสผ่าน</label>
			<input type="password" name="password">
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="login_btn">เข้าสู่ระบบ</button>
			&nbsp <a href="../index.php" class="btn" role="button" aria-pressed="true">ยกเลิก</a>
		</div>
<!-- 		<p>
			Not yet a member? <a href="register.php">Sign up</a>
		</p> -->
	</form>
</div>
</div>
</body>
</html>