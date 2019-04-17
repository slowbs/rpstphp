<?php include('functions.php') ;
	if (!isAdmin()) {
		$_SESSION['msg'] = "You must log in first";
		header('location: ../login.php');
		exit();
	}
	?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL - Create user</title>
	<link rel="stylesheet" type="text/css" href="../user/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
	<style>
		.header {
			background: #003366;
		}

	</style>
</head>
<body>
<div class="container" align="center">
<div class="col-md-6">
	<div class="header">
		<h2>ผู้ดูแล เพิ่มบัญชีผู้ใช้</h2>
	</div>
	
	<form method="post" action="create_user.php">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>ชื่อผู้ใช้</label>
			<input type="text" name="username" value="<?php echo $username; ?>">
		</div>
<!-- 		<div class="input-group">
			<label>Email</label>
			<input type="email" name="email" value="<?php echo $email; ?>">
		</div> -->
		<div class="input-group">
			<label>ประเภทผู้ใช้</label>
			<select name="user_type" id="user_type" style="height:30px">
				<option value="" style="font-size:14px;"></option>
				<option value="admin" style="font-size:14px;">Admin</option>
				<option value="user" style="font-size:14px;">User</option>
			</select>
		</div>
        <div class="input-group">
		<label>อำเภอ</label>
		<select name="ampher" id="ampher" style="height:30px" >
		<option value=""></option>
		<?php
include 'db.php';
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM client;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){?>
			<option value="<?php echo $row['hospcode']?>" style="font-size:14px;"><?php echo $row['hospname']?></option>
 
<?php
		}  ?>
		</select></div>
		<?php
    }
    catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
        }
    
    $conn = null;
?>
		<div class="input-group">
			<label>รหัสผ่าน</label>
			<input type="password" name="password_1">
		</div>
		<div class="input-group">
			<label>ยืนยันรหัสผ่าน</label>
			<input type="password" name="password_2">
		</div>
		<div>
			<button type="submit" class="btn btn-primary" name="register_btn">บันทึก</button>
			<a href="../admin"><button type="button" class="btn btn-danger">ยกเลิก</button></a>
		</div>
	</form>
</body>
</div>
</div>
</html>