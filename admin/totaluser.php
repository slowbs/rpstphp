<?php
  include('../functions.php');
  $duck = $_SESSION['user']['username'];
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
  <!-- data-table -->
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/fc-3.2.5/fh-3.1.4/datatables.min.css"/>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/fc-3.2.5/fh-3.1.4/datatables.min.js"></script>
  <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.css"/>
 <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.18/datatables.min.js"></script> -->

  <style>
  @page {
    size: auto;
}
</style>
</head>

<body>

<div class="container" align="center">
<div class="col-md-8">
<br>
<h2>รายชื่อบัญชีผู้ใช้</h2>
<div style="float: left"><a href="../admin"><button type="button" class="btn btn-success">หน้าหลัก</button></a>
</div>

<div style="float: right">
  <!-- <a href="../index.php?logout='1'"><button type="button" class="btn btn-danger">ออกจากระบบ</button></a> -->
  <div class="btn-group">
  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    จัดการบัญชีผู้ใช้
  </button>
  <div class="dropdown-menu">
  <a class="dropdown-item" href="create_user.php">เพิ่มชื่อผู้ใช้</a>
    <a class="dropdown-item" href="updateuserform.php?id=<?php echo $_SESSION['user']['id'] ?>">เปลี่ยนรหัสผ่าน</a>
    <a class="dropdown-item" href="totaluser.php">จัดการผู้ใช้</a>
    <a class="dropdown-item" href="../index.php?logout='1'">ออกจการะบบ</a>
  </div>
</div>
</div>
<br><br>
<br>
<table class="table table-hover table-bordered table-striped table-sm" id="myTable">
  <thead style="text-align:center" class="thead-dark">
    <tr>
      <th scope="col">ลำดับที่</th>
      <th scope="col">ชื่อผู้ใช้</th>
      <th scope="col">อำเภอ</th>
      <th scope="col">สถานะ</th>
      <th scope="col">แก้ไข</th>
      <th scope="col">ลบ</th>
    </tr>
  </thead>
  <tbody style="text-align:center">
  <?php
include 'db.php';
$i = 0;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$sql = "SELECT * FROM total_score where time = $y && ep = $ep && type = $t order by mp5 desc;";
        $sql = "SELECT users.id, users.username, users.user_type, client.hospname FROM `users` 
        left join client on users.username = client.hospcode";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
             $i+=1;
            ?><tr>
      <th scope="row"><?php echo $row['id'] ?></th>
      <td><?php echo $row['username']?></td>
      <td><?php echo $row['hospname']?></td>
      <td><?php echo $row['user_type']?></td>
      <td><a href="updateuserform2.php?id=<?php echo $row['id'] ?>">
      <button type="button" class="btn btn-warning btn-sm">แก้ไข</button></td>
      <td>
      <!-- Button trigger modal -->
<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#exampleModal_<?php echo $row['id']?>">
  ลบ
</button>
      </td>
    </tr>
<!-- Modal -->
<div class="modal fade" id="exampleModal_<?php echo $row['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ลบชื่อผู้ใช้</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ยืนยันที่จะลบ
      </div>
      <div class="modal-footer">
      <a href = "deleteuser.php?id=<?php echo $row['id']?>">
      <button type="button" class="btn btn-danger">ยืนยัน</button></a>
      <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
      </div>
    </div>
  </div>
</div>
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
<script>
$(document).ready(function() {
    var table = $('#myTable').DataTable( {
        fixedHeader: {
            header: true,
            footer: true
        }
    } );
} );
</script>
</html>