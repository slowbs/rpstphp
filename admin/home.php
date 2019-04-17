<?php
include 'functions.php';
//$ap = isset($_GET['ap']) ? $_GET['ap'] : '';
//$ap = $_SESSION['user']['apid'];
$duck = $_SESSION['user']['username'];
if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../user/login.php');
}
//$ap = $_SESSION['user']['apid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap 4 Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</head>
<body>
<div class="container" align="center">
<br>
<h1 align="center">การประเมินผลการพัฒนางานสาธารณสุข </h1>
  <h2 align="center">สำนักงานสาธารณสุขจังหวัดนครศรีธรรมราช</h2>
  <br>
  <div class="col-md-8">
<div align="right">
<div class="btn-group">
  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo $duck ?>
  </button>
  <div class="dropdown-menu">
  <a class="dropdown-item" href="create_user.php">เพิ่มชื่อผู้ใช้</a>
    <a class="dropdown-item" href="updateuserform.php?id=<?php echo $_SESSION['user']['id'] ?>">เปลี่ยนรหัสผ่าน</a>
    <a class="dropdown-item" href="totaluser.php">จัดการผู้ใช้</a>
    <a class="dropdown-item" href="../index.php?logout='1'">ออกจการะบบ</a>
  </div>
</div>

<!-- <a href="create_user.php"><button type="button" class="btn btn-primary">เพิ่มชื่อผู้ใช้</button></a>
<a href="updateuserform.php?id=<?php echo $_SESSION['user']['id'] ?>">
<button type="button" class="btn btn-warning">แก้ไขรหัสผ่าน</button></a> -->
</div>

<br>
<table class="table table-hover table-bordered table-striped table-sm" id="myTable">
  <thead style="text-align:center" class="thead-dark">
    <tr>
      <th scope="col">ลำดับ</th>
      <th scope="col">รหัสอำเภอ</th>
      <th scope="col">อำเภอ</th>
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
        //$sql = "SELECT users.*, ampher.name FROM users left join ampher on users.apid = ampher.id";
        $sql = "SELECT * FROM amphur;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
             $i+=1;
            ?><tr>
      <?php $_SESSION['juck'][$row['amphurcode']] = $row['amphur_name']; ?>
      <th scope="row"><?php echo $i; ?></th>
      <td><?php echo $row['id']?></td>
      <td><a href="rplist.php?acode=<?php echo $row['amphurcode'] ?>"><?php echo $row['amphur_name']?></td>
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
      </div>
</body>
</html>