<div style="float: left"><a href="../admin"><button type="button" class="btn btn-success">หน้าหลัก</button></a>
<!-- <a href="type.php?y=<?php echo $y ?>&ep=<?php echo $ep?>"><button type="button" class="btn btn-success">ประเภท</button></a> -->
<a href="rplist.php?acode=<?php echo $acode?>"><button type="button" class="btn btn-success">ย้อนกลับ</button></a>
<a href="edit.php?id=<?php echo $rpst?>&acode=<?php echo $acode?>"><button type="button" class="btn btn-success">แก้ไขข้อมูล</button></a>
</div>

  <div align="right">
<div class="btn-group">
  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo $duck?>
  </button>
  <div class="dropdown-menu">
  <a class="dropdown-item" href="create_user.php">เพิ่มชื่อผู้ใช้</a>
    <a class="dropdown-item" href="updateuserform.php?id=<?php echo $_SESSION['user']['id'] ?>">เปลี่ยนรหัสผ่าน</a>
    <a class="dropdown-item" href="totaluser.php">จัดการผู้ใช้</a>
    <a class="dropdown-item" href="../index.php?logout='1'">ออกจการะบบ</a>
  </div>
</div>
</div>
<div align="right">
Last-Modified:  <?php echo $row['updated_time'];?> by <?php echo $row['updated_by']?> 
</div>
<br>