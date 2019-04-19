<?php
include('functions.php');
$rpst = isset($_GET['id']) ? $_GET['id'] : '';
$acode = isset($_GET['acode']) ? $_GET['acode'] : '';
//$juck = $_SESSION['juck'][$rpst];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap 4 Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link type="text/css" rel="stylesheet" href="css/lightgallery.css" /> 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <script src="js/lightgallery.js"></script>
</head>
<div class="container" align="center">
  <br>
<?php
include 'db.php';
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$sql = "SELECT * from info where hospcode = $ap;";
    $sql = "SELECT i.info_id as id, address, hospname, villagename, TAMBONNAME, amphur_name, academic, nurse, dentist,
    officer,thaimed, physic, other, total, time_format(updated_time, '%d/%m/%Y %H:%i') as updated_time, updated_by
    FROM `info` i 
    left JOIN amphur a on a.amphurcode = i.amphur
left JOIN tambon t on t.TAMBON = i.tambon and t.AMPUR = i.amphur
left JOIN village on village.villagecode = i.village and village.ampurcode = i.amphur and village.tamboncode = i.tambon
    where i.hospcode = $rpst";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row){?>
<?php
      
      //echo $row['address'];
      //echo $ap;
      $amphur = $row['amphur_name'];
      $tambon = $row['TAMBONNAME'];
      $village = $row['villagename'];
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
  <h2 align="center"><?php echo $juck ?></h2>
  <br>
      <div class="header">
	</div>
	<div class="col-md-8">
    <?php include 'headbutform.php'; ?>
    <div class="row">

    <div class="col-md-6" align="left">
      <!-- <p class="p1">
      ที่อยู่ <?php echo $row['address']; ?>
      </p> -->
      <table class="table table-borderless table-striped">
  <tbody>
    <tr>
      <th scope="row" style="width:40%">ที่ตั้ง</th>
      <td><?php echo $row['address'];?></td>
    </tr>
    <tr>
      <th scope="row" style="width:40%">หมู่บ้าน</th>
      <td><?php echo $village; ?></td>
    </tr>
    <tr>
      <th scope="row" style="width:40%">ตำบล</th>
      <td><?php echo $tambon; ?></td>
    </tr>
    <tr>
      <th scope="row" style="width:40%">อำเภอ</th>
      <td><?php echo $amphur; ?></td>
    </tr>
    <tr>
      <th scope="row">นักวิชาการสาธารณสุข</th>
      <td><?php echo $academic;?> คน</td>
    </tr>
    <tr>
      <th scope="row">เจ้าหน้าที่สาธารณสุข</th>
      <td><?php echo $officer;?> คน</td>
    </tr>
    <tr>
      <th scope="row">พยาบาล</th>
      <td><?php echo $nurse;?> คน</td>
    </tr>
    <tr>
      <th scope="row">เจ้าพนักงานทันตสาธารณสุข</th>
      <td><?php echo $dentist;?> คน</td>
    </tr>
    <tr>
      <th scope="row">แพทย์แผนไทย</th>
      <td><?php echo $thaimed;?> คน</td>
    </tr>
    <tr>
      <th scope="row">กายภาพบำบัด</th>
      <td><?php echo $physic;?> คน</td>
    </tr>
    <tr>
      <th scope="row">อื่นๆ  </th>
      <td><?php echo $other;?> คน</td>
    </tr>
    <tr>
      <th scope="row">เจ้าหน้าที่ทั้งหมด</th>
      <td><?php echo $total;?> คน</td>
    </tr>

  </tbody>
</table>
    </div>
    <div class="col-md-6" style="line-height: 1;">
      <!-- <img src="http://placehold.it/500x333" width="100%" height="270"> -->
      <iframe src="http://maps.google.com/maps?q=8.417977, 99.964048&z=15&output=embed" width="100%" height="270" frameborder="0" style="border:0"></iframe>
    <br><br>
        <table class="table table-borderless table-striped">
    <?php 
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$sql = "SELECT * from info where hospcode = $ap;";
    $sql = "SELECT * FROM `images` where user = $rpst order by type, id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
    $name = array("1" => "ป้าย", "2" => "หน้าบ้าน", "3" => "ถนน", "4" => "รั้ว");
    //echo "แถว1";
$i = 0;
    foreach($result as $row){
        if($row['type'] != $i){
            $i += 1;
            ?>
            <thead>
  <tr>
    <th scope="col"><?php echo $name[$i]; ?></th>
  </tr>
</thead>
<tbody>
<td id="lightgallery<?php echo $i?>">
          <?php
        }?>
        <a href="user/upload/<?php echo $row['name'];?>"><img src="user/upload/<?php echo $row['name'];?>" alt="Thumb-1" width="49%" style="margin-bottom:5px;border:5px outset #0D89A5;"  height="100"/></a>

    <?php } ?>
    
</table>
  
</div>
    <?php }}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>
  <br>
  <!-- <a href="insertyear.php">Insert year</a> -->
</div>

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
            $('#state').html('<option value="">Select country first</option>');
            $('#city').html('<option value="">Select state first</option>'); 
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
            $('#city').html('<option value="">Select state first</option>'); 
        }
    });

    $(".num").on('input', function () {
       var score = this.value;
       var boxid = this.id;
       var academic = parseFloat($("#academic").val());
       var nurse = parseFloat($("#nurse").val());
       var dentist = parseFloat($("#dentist").val());
       var officer = parseFloat($("#officer").val());
       var thaimed = parseFloat($("#thaimed").val());
       var physic = parseFloat($("#physic").val());
       //var gane5 = parseFloat($("#gane5_"+boxid).text());
       //alert(score)
       var koon = $("#koon"+boxid).text()
       if ( score != "" ){
           if (isNaN(score)){
            alert("กรุณากรอกเฉพาะตัวเลข")
            $("#"+boxid).val("")
           }
           else{
            var total = academic + nurse + dentist + officer + thaimed + physic;
            //alert(total);
            $("#total").val(total);
       }
    }});
});
</script>
<script type="text/javascript">
    lightGallery(document.getElementById('lightgallery1')); 
    lightGallery(document.getElementById('lightgallery2')); 
    lightGallery(document.getElementById('lightgallery3'));
    lightGallery(document.getElementById('lightgallery4'));
    lightGallery(document.getElementById('lightgallery5'));
</script>
</html>