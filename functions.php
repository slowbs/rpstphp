<?php 
	session_start();

	// connect to database
	$db = mysqli_connect('localhost', 'slowbs', 'sodsongig4', 'ssj');
	mysqli_set_charset($db,"utf8");

	// variable declaration
	$username = "";
	//$email    = "";
	$errors   = array(); 

	// call the register() function if register_btn is clicked
	if (isset($_POST['register_btn'])) {
		register();
	}

	if (isset($_POST['updateuser_btn'])) {
		updateuser();
	}

	// call the login() function if register_btn is clicked
	if (isset($_POST['login_btn'])) {
		login();
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['user']);
		header("location: index.php");
	}

	// REGISTER USER
	function register(){
		global $db, $errors;

		// receive all input values from the form
		$username    =  e($_POST['username']);
		//$email       =  e($_POST['email']);
		$password_1  =  e($_POST['password_1']);
		$password_2  =  e($_POST['password_2']);
		$ampher = e($_POST['ampher']);

		// form validation: ensure that the form is correctly filled
		if (empty($username)) { 
			array_push($errors, "Username is required"); 
		}
/* 		if (empty($email)) { 
			array_push($errors, "Email is required"); 
		} */
		if (empty($password_1)) { 
			array_push($errors, "Password is required"); 
		}
		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database

			if (isset($_POST['user_type'])) {
				$user_type = e($_POST['user_type']);
				$query = "INSERT INTO users (username, user_type, password, apid) 
						  VALUES('$username', '$user_type', '$password', '$ampher')";
				mysqli_query($db, $query);
				$_SESSION['success']  = "New user successfully created!!";
				header('location: year.php');
			}else{
				$query = "INSERT INTO users (username, user_type, password, apid) 
						  VALUES('$username', 'user', '$password', '$ampher')";
				mysqli_query($db, $query);

				// get id of the created user
				$logged_in_user_id = mysqli_insert_id($db);

				$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
				$_SESSION['success']  = "You are now logged in";
				header('location: year.php');				
			}

		}

	}

	// UPDATE USER
	function updateuser(){
		global $db, $errors;

		// receive all input values from the form
		$passold    =  e($_POST['passold']);
		//$email       =  e($_POST['email']);
		$passnew_1  =  e($_POST['passnew_1']);
		$passnew_2  =  e($_POST['passnew_2']);
		$id = $_SESSION['user']['id'];
		$password = $_SESSION['user']['password'];
		$passold = md5($passold);

		// form validation: ensure that the form is correctly filled
		if (empty($passold)) { 
			array_push($errors, "Old Password is required"); 
		}
/* 		if (empty($email)) { 
			array_push($errors, "Email is required"); 
		} */

		if ($password != $passold){
			array_push($errors, "รหัสผ่านไม่ถูกต้อง");
		}
		if (empty($passnew_1)) { 
			array_push($errors, "กรุณากรอกรหัสผ่านใหม่"); 
		}
		if ($passnew_1 != $passnew_2) {
			array_push($errors, "รหัสผ่านใหม่ไม่ตรงกัน");
		}

		// register user if there are no errors in the form
		if (count($errors) == 0) {
			//encrypt the password before saving in the database
			$passnew_1 = md5($passnew_1);
			

			//if (isset($_POST['user_type'])) {
				//$user_type = e($_POST['user_type']);
				$query = "UPDATE users SET password = '$passnew_1' where id = '$id'";
				mysqli_query($db, $query);
				$_SESSION['success']  = "Update Successed";
				//echo $id;
				header('location: year.php');
			}else{
/* 				$query = "INSERT INTO users (username, user_type, password) 
						  VALUES('$username', 'user', '$password')";
				mysqli_query($db, $query);

				// get id of the created user
				$logged_in_user_id = mysqli_insert_id($db);

				$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
				$_SESSION['success']  = "You are now logged in";
				header('location: index.php');		 */		
			}

		}


	// return user array from their id
	function getUserById($id){
		global $db;
		$query = "SELECT * FROM users WHERE id=" . $id;
		$result = mysqli_query($db, $query);

		$user = mysqli_fetch_assoc($result);
		return $user;
	}

	// LOGIN USER
	function login(){
		global $db, $username, $errors;

		// grap form values
		$username = e($_POST['username']);
		$password = e($_POST['password']);

		// make sure form is filled properly
		if (empty($username)) {
			array_push($errors, "กรุณากรอกชื่อผู้ใช้");
		}
		if (empty($password)) {
			array_push($errors, "กรุณากรอกรหัสผ่าน");
		}

		// attempt login if no errors on form
		if (count($errors) == 0) {
			$password = md5($password);

			$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) { // user found
				// check if user is admin or user
				$logged_in_user = mysqli_fetch_assoc($results);
				if ($logged_in_user['user_type'] == 'admin') {

					$_SESSION['user'] = $logged_in_user;
					$_SESSION['success']  = "You are now logged in";
					header('location: admin/year.php');		  
				}else{
					$_SESSION['user'] = $logged_in_user;
					//$_SESSION['success']  = "You are now logged in";
					$ap = $_SESSION['user']['hospcode'];
					echo "<script>
					window.location.href='user/year.php';
            		</script>";
					
				}
			}else {
				array_push($errors, "ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง");
			}
		}
	}

	function isLoggedIn()
	{
		if (isset($_SESSION['user'])) {
			return true;
		}else{
			return false;
		}
	}

	function isLoggedIn2()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['id'] = $ap ) {
			return true;
		}else{
			return false;
		}
	}

	function isAdmin()
	{
		if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
			return true;
		}else{
			return false;
		}
	}

	// escape string
	function e($val){
		global $db;
		return mysqli_real_escape_string($db, trim($val));
	}

	function display_error() {
		global $errors;

		if (count($errors) > 0){
			echo '<div class="error">';
				foreach ($errors as $error){
					echo $error .'<br>';
				}
			echo '</div>';
		}
	}

?>