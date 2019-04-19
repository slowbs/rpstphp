<?php 
	include('functions.php');
	//$ap = isset($_GET['ap']) ? $_GET['ap'] : '';
    //$ap = $_SESSION['user']['apid'];
    if (!isAdmin()) {
      $_SESSION['msg'] = "You must log in first";
      header('location: ../user/login.php');
    }
	  $ap = isset($_GET['id']) ? $_GET['id'] : '';
    $id = $_SESSION['user']['id'];
    $duck = $_SESSION['user']['username'];
    $acode = isset($_GET['acode']) ? $_GET['acode'] : '';
    //$juck = $_SESSION['juck'][$ap];
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
.btn-file {
    position: relative;
    overflow: hidden;
}
.btn-file input[type=file] {
    position: absolute;
    top: 0;
    right: 0;
    min-width: 100%;
    min-height: 100%;
    font-size: 100px;
    text-align: right;
    filter: alpha(opacity=0);
    opacity: 0;
    outline: none;
    background: white;
    cursor: inherit;
    display: block;
}
</style>
</head>
<body>
<br>
<div class="container" align="center">

<?php
include 'db.php';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT *,time_format(updated_time, '%d/%m/%Y %H:%i') as updated_time from info where hospcode = $ap;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row){
      //echo $row['address'];
      //echo $ap;
      $amphur = $row['amphur'];
      $tambon = $row['tambon'];
      $village = $row['village'];
      $officer = $row['officer'];
      $academic = $row['academic'];
      $nurse = $row['nurse'];
      $dentist = $row['dentist'];
      $other = $row['other'];
      $dentist = $row['dentist'];
      $thaimed = $row['thaimed'];
      $physic = $row['physic'];
      $total = $row['total'];
      $juck = $row['hospname'];
      //echo $amphurcode;
      ?>
      <h1 align="center">ระบบสารสนเทศสถานบริการสาธารณสุข</h1>
  <h2 align="center"><?php echo $juck?></h2>
  <br>
      <div class="header">
	</div>
	<div class="col-md-8">
  <div style="float: left">
<button type="submit" class="btn btn-success" style="width:100px" form="profile">บันทึก</button>
<a href="../admin"><button type="button" class="btn btn-danger" style="width:100px">ยกเลิก</button></a>
</div>
  <div align="right">
<div class="btn-group">
  <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <?php echo $duck ?>
  </button>
  <div class="dropdown-menu">
  <a class="dropdown-item" href="year.php">แก้ไขข้อมูล</a>
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
        <nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">ข้อมูล</a>
    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">รูปภาพ</a>
    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>
  </div>
</nav>
<div class="tab-content" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" id="profile">
      <br>
  <form method="post" action="updateinfo.php?hospcode=<?php echo $ap?>&acode=<?php echo $acode?>" id="profile">
    <div class="form-group row">
    <label for="amphur" class="col-md-2 col-form-label" align="left">ที่อยู่</label>
    <div class="col-md-8">
    <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3" placeholder="บ้านเลขที่, ซอย, ถนน"><?php echo $row['address']?></textarea>
    </div>
    </div>

    <?php
    if($amphur !== "" && $tambon !== "" && $village !== ""){?>

        <div class="form-group row">
    <label for="amphur" class="col-md-2 col-form-label" align="left">อำเภอ</label>
    <div class="col-md-8">
    <select class="form-control" id="country" name ="amphur">
    <option value="">Select อำเภอ</option>
    <?php
		  $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
		  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		        $stmt = $conn->prepare("SELECT * FROM amphur;"); 
				$stmt->execute();
				$result = $stmt->FetchAll(PDO::FETCH_ASSOC);
				foreach($result as $row){?>
        <option value="<?php echo $row['amphurcode'];?>" <?php if($row['amphurcode'] == $amphur) echo 'selected="selected"'; ?>><?php echo $row['amphur_name'];?></option>
        <?php }?>
    </select>
    </div>
    </div>

    <div class="form-group row">
    <label for="amphur" class="col-md-2 col-form-label" align="left">ตำบล</label>
    <div class="col-md-8">
    <select class="form-control" id="state" name="tambon">
    <option value="">Select ตำบล</option>
    <?php
		  $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
		  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		        $stmt = $conn->prepare("SELECT * FROM tambon where AMPUR = $amphur and TAMBON > '00'"); 
				$stmt->execute();
				$result = $stmt->FetchAll(PDO::FETCH_ASSOC);
                foreach($result as $row){?>
                <option value="<?php echo $row['TAMBON'];?>" <?php if($row['TAMBON'] == $tambon) echo 'selected="selected"';?>><?php echo $row['TAMBONNAME']?></option>
                <?php } ?>
    </select>
    </div>
    </div>

        <div class="form-group row">
    <label for="amphur" class="col-md-2 col-form-label" align="left">หมู่บ้าน</label>
    <div class="col-md-8">
    <select class="form-control" id="city" name="village">
    <option value="00">กรุณาเลือกหมู่บ้าน</option>
    <?php
		  $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
		  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		        $stmt = $conn->prepare("SELECT * FROM village where ampurcode = $amphur and tamboncode = $tambon"); 
				$stmt->execute();
				$result = $stmt->FetchAll(PDO::FETCH_ASSOC);
                foreach($result as $row){?>
                <option value="<?php echo $row['villagecode'];?>" <?php if($row['villagecode'] == $village) echo 'selected="selected"';?>><?php echo $row['villagename']?></option>
                <?php } ?>
    </select>
    </div>
  </div>
    

    
    <?php }
    else { ?>
        <div class="form-group row">
    <label for="amphur" class="col-md-2 col-form-label" align="left">อำเภอ</label>
    <div class="col-md-8">
    <select class="form-control" id="country" name ="amphur">
    <option value="">กรุณาเลือกอำเภอ</option>
    <?php
		  $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
		  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		        $stmt = $conn->prepare("SELECT * FROM amphur;"); 
				$stmt->execute();
				$result = $stmt->FetchAll(PDO::FETCH_ASSOC);
				foreach($result as $row){?>
        <option value="<?php echo $row['amphurcode'];?>" <?php if($row['amphurcode'] == $amphur) echo 'selected="selected"'; ?>><?php echo $row['amphur_name'];?></option>
        <?php }?>
    </select>
    </div>
    </div>

        <div class="form-group row">
    <label for="amphur" class="col-md-2 col-form-label" align="left">ตำบล</label>
    <div class="col-md-8">
    <select class="form-control" id="state" name="tambon">
    <option value="">กรุณาเลือกตำบล</option>
    </select>
    </div>
    </div>



        <div class="form-group row">
    <label for="amphur" class="col-md-2 col-form-label" align="left">หมู่บ้าน</label>
    <div class="col-md-8">
    <select class="form-control" id="city" name="village">
    <option value="00">กรุณาเลือกหมู่บ้าน</option>
    </select>
    </div>
  </div>
  <?php } ?>
  <div class="form-group row">
    <label for="academic" class="col-md-4 col-form-label" align="left">นักวิชาการ สาธารณสุข</label>
    <div class="col-md-6">
    <input class="form-control num" id="academic" type="text" placeholder="จำนวนคน" name="academic" value="<?php echo $academic;?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="officer" class="col-md-4 col-form-label" align="left">เจ้าหน้าที่สาธารณสุข</label>
    <div class="col-md-6">
    <input class="form-control num" id="officer" type="text" placeholder="จำนวนคน" name="officer" value="<?php echo $officer;?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="nurse" class="col-md-4 col-form-label" align="left">พยาบาล</label>
    <div class="col-md-6">
    <input class="form-control num" id="nurse" type="text" placeholder="จำนวนคน" name="nurse" value="<?php echo $nurse;?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="dentist" class="col-md-4 col-form-label" align="left">เจ้าพนักงานทันตสาธารณสุข</label>
    <div class="col-md-6">
    <input class="form-control num" id="dentist" type="text" placeholder="จำนวนคน" name="dentist" value="<?php echo $dentist;?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="thaimed" class="col-md-4 col-form-label" align="left">แพทย์แผนไทย</label>
    <div class="col-md-6">
    <input class="form-control num" id="thaimed" type="text" placeholder="จำนวนคน" name="thaimed" value="<?php echo $thaimed;?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="physic" class="col-md-4 col-form-label" align="left">กายภาพบำบัด</label>
    <div class="col-md-6">
    <input class="form-control num" id="physic" type="text" placeholder="จำนวนคน" name="physic" value="<?php echo $physic;?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="other" class="col-md-4 col-form-label" align="left">อื่น ๆ</label>
    <div class="col-md-6">
    <input class="form-control num" id="other" type="text" placeholder="จำนวนคน" name="other" value="<?php echo $other;?>">
    </div>
  </div>
  <div class="form-group row">
    <label for="total" class="col-md-4 col-form-label" align="left">รวม</label>
    <div class="col-md-6">
    <input class="form-control num" id="total" type="text" placeholder="จำนวนคน" readonly="readonly" name="total" value="<?php echo $total;?>">
    </div>
  </div>
		<?php
		}
		?>
    </form>
  </div>
  <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
  <br>
<form method="post" action="upload.php?ap=<?php echo $ap?>&acode=<?php echo $acode ?>" enctype="multipart/form-data">
<div class="form-group row">
<label for="amphur" class="col-md-3 col-form-label" align="left">ป้าย รั้วด้านหน้า</label>
    <div class="form-group col-md-9" align="left">
      <div class="custom-file" align="center">
        <input type='file' name='files1[]' multiple class="custom-file-input" id="customFile">
        <label class="custom-file-label" for="customFile">กรุณาเลือกรูปภาพ</label>
      </div>
    </div>
    <label for="amphur" class="col-md-3 col-form-label" align="left">ถนน</label>
    <div class="form-group col-md-9" align="left">
      <div class="custom-file" align="center">
        <input type='file' name='files2[]' multiple class="custom-file-input" id="customFile">
        <label class="custom-file-label" for="customFile">กรุณาเลือกรูปภาพ</label>
      </div>
    </div>
    <label for="amphur" class="col-md-3 col-form-label" align="left">รั้ว</label>
    <div class="form-group col-md-9" align="left">
      <div class="custom-file" align="center">
        <input type='file' name='files3[]' multiple class="custom-file-input" id="customFile">
        <label class="custom-file-label" for="customFile">กรุณาเลือกรูปภาพ</label>
      </div>
    </div>
    <label for="amphur" class="col-md-3 col-form-label" align="left">ป้าย รั้วด้านหน้า</label>
    <div class="form-group col-md-9" align="left">
      <div class="custom-file" align="center">
        <input type='file' name='files4[]' multiple class="custom-file-input" id="customFile">
        <label class="custom-file-label" for="customFile">กรุณาเลือกรูปภาพ</label>
      </div>
    </div>
    <div class="form-group col-md-4 offset-md-8">
<button type='submit' value='Submit' name='submit' id="upload" class="btn btn-block btn-dark"><i class="fa fa-fw fa-upload"></i> เพิ่มรูป</button>
    </div>
</div>
  </form>
  <table class="table table-hover table-bordered table-striped table-sm" id="myTable">
  <thead style="text-align:center" class="thead-dark">
    <tr>
      <th scope="col" style="width:70px">ลำดับที่</th>
      <th scope="col">รูปภาพ</th>
      <th scope="col" style="width:60px">ลบ</th>
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
        $sql = "SELECT * FROM `images` where user = $ap";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
             $i+=1;
            ?><tr>
      <th scope="row"><?php echo $i ?></th>
      <td><a href="../user/upload/<?php echo $row['name'];?>" target="_blank"><img src="../user/upload/<?php echo $row['name'];?>" alt="Thumb-1" height="100" style="max-width:350px !important;"/></a></td>
      <!-- <td><?php echo $row['name']?></td> -->
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
      <a href = "deleteuser.php?fn=<?php echo $row['name']?>&ap=<?php echo $ap?>">
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
  <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
</div>
	
  <?php
    }  
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>
  <br>
  <!-- <a href="insertyear.php">Insert year</a> -->
</div>
</div> <!--div container-->
</body>
<script type="text/javascript">
$(document).ready(function(){
    $('#country').on('change',function(){
        var countryID = $(this).val();
        if(countryID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'amphurcode='+countryID,
                success:function(html){
                    $('#state').html(html);
                    $('#city').html('<option value="00">กรุณาเลือกหมู่บ้าน</option>'); 
                }
            }); 
        }else{
            $('#state').html('<option value="">กรุณาเลือกตำบล</option>');
            $('#city').html('<option value="">กรุณาเลือกหมู่บ้าน</option>'); 
        }
    });
    
    $('#state').on('change',function(){
        var stateID = $(this).val();
        var countryID = $("#country").val();
        if(stateID){
            $.ajax({
                type:'POST',
                url:'ajaxData.php',
                data:'tambon='+stateID+'&amphur='+countryID,
                success:function(html){
                    $('#city').html(html);
                }
            }); 
        }else{
            $('#city').html('<option value="">กรุณาเลือกหมู่บ้าน</option>'); 
        }
    });

    $(".num").on('input', function () {
       var score = this.value;
       var boxid = this.id;
       //var gane5 = parseFloat($("#gane5_"+boxid).text());
       //alert(score)
       //var koon = $(this).text()
           if (isNaN(score)){
            alert("กรุณากรอกเฉพาะตัวเลข")
            $('#'+boxid).val("")
           }
       var academic = parseFloat($("#academic").val() || 0);
       var nurse = parseFloat($("#nurse").val() || 0);
       var dentist = parseFloat($("#dentist").val() || 0);
       var officer = parseFloat($("#officer").val() || 0);
       var thaimed = parseFloat($("#thaimed").val() || 0);
       var physic = parseFloat($("#physic").val() || 0);
       var other = parseFloat($("#other").val() || 0);
            var total = academic + nurse + dentist + officer + thaimed + physic + other;
            //alert(total);
            $("#total").val(total);
            //$("#total").val(boxid);
    });
    $('input[type="file"]').on("change", function() {
    let filenames = [];
    let files = this.files;
    if (files.length > 1) {
      filenames.push("Total Files (" + files.length + ")");
    } else {
      for (let i in files) {
        if (files.hasOwnProperty(i)) {
          filenames.push(files[i].name);
        }
      }
    }
    $(this)
      .next(".custom-file-label")
      .html(filenames.join(","));
  });

  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    console.log("tab shown...");
});

// read hash from page load and change tab
var hash = document.location.hash;
var prefix = "tab_";
if (hash) {
    $('.nav-tabs a[href="'+hash.replace(prefix,"")+'"]').tab('show');
} 
});
</script>
</html>