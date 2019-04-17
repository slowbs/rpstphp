<?php
include 'db.php';
include('../functions.php');
//$ap = isset($_GET['ap']) ? $_GET['ap'] : '';
//$ap = $_SESSION['user']['apid'];
if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
    exit();
}
$y = isset($_GET['y']) ? $_GET['y'] : '';
$t = isset($_GET['t']) ? $_GET['t'] : '';
$ep = isset($_GET['ep']) ? $_GET['ep'] : '';
$typename = $_SESSION['typename'][$t];
$month = $_SESSION['quarter']["$ep"];
//echo $id; // ผลลัพธ์คือแสดงข้อความ Hello 

?>
  <title>Bootstrap 4 Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/floatthead"></script>
  <link rel="stylesheet" href="fuk.css">
  <script src="fuk.js"></script>
  <style>
td,
th {
  border: 1px solid #000;
}
th {background-color:red;}

td:first-child, th:first-child {
  position:sticky;
  left:0;
  z-index:1;
  background-color:grey;
}
thead tr th {
  position:sticky;
  top:0;
}
th:first-child, th:last-child {z-index:2;background-color:red;}
</style>
<?php
?>
  <body>
  <div class="container-fluid">
  <div class="page-header" align="center">
<br>
<?php echo "<h2 align='center'>การประเมินผลการพัฒนางานสาธารณสุข รอบ <strong><span style='color:blue'>$ep</span></strong> เดือน <strong><span style='color:blue'>($month)</span></strong></h2>"?>
<?php echo "<h2 align='center'>รวมคะแนนทุกอำเภอ ระดับ <strong><span style='color:blue'>$typename</span></strong> ประจำปีงบประมาณ พ.ศ. <strong><span style='color:blue'>$y</span></strong></h2>";?>

</div></div>
<div class="container">
<?php include 'headbutform.php' ?>
</div>
<div class="container-fluid">
<br>
  <table class="table table-bordered testimonial-group sticky-head" >
  <thead class="thead-dark">
  <tr>
      <th scope="col" rowspan="2" style="font-size:12px">PA/สตป.</th>
      <th scope="col" rowspan="2" style="font-size:12px">ลำดับ</th>
      <th rowspan="2" style="font-size:12px; min-width:500px; text-align:center">ตัวชี้วัดประเมินผล</th>
      <th scope="col" rowspan="2" style="font-size:12px">เกณฑ์ ปี 2561</th>
      <th scope="col" rowspan="2" style="font-size:12px">แหล่งข้อมูล</th>
      <th scope="col" rowspan="2" style="font-size:12px">สสอ</th>
      <th scope="col" colspan="5"style="text-align:center">เกณฑ์การให้คะแนน</th>
      <?php
include 'db.php';
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM ampher;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
        $apnum=0;
        foreach($result as $ampher){?>
           <?php $apnum +=1;?>
            <th scope="col" colspan="3"style="text-align:center"><?php echo $ampher['name']?></th><?php
        }  
    }
    catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
        }
    
    $conn = null;
?>
      
    </tr>
    <tr>
      <th scope="col" style="font-size:12px">ระดับ1</th>
      <th scope="col" style="font-size:12px">ระดับ2</th>
      <th scope="col" style="font-size:12px">ระดับ3</th>
      <th scope="col" style="font-size:12px">ระดับ4</th>
      <th scope="col" style="font-size:12px">ระดับ5</th>
      <?php for($r=1;$r<=$apnum;$r++){
          ?>
        <th scope="col" style="font-size:12px">ผลการดำเนินงาน</th>
      <th scope="col" style="font-size:12px">ค่าคะแนนที่ได้</th>
      <th scope="col" style="font-size:12px">คะแนนถ่วงน้ำหนัก</th>
      <?php
      }?>

    </tr>
  </thead>
  <tbody>
  <form action="update.php?y=<?php echo $y?>&ap=<?php echo $ap?>" method="POST"> 
<?php
include 'db.php';
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT form_{$ep}_$y.*,ap1.value 'ap1.value', ap1.valuegane 'ap1.valuegane', ap1.valuekoon 'ap1.valuekoon',
  ap2.value 'ap2.value', ap2.valuegane 'ap2.valuegane', ap2.valuekoon 'ap2.valuekoon',
  ap3.value 'ap3.value', ap3.valuegane 'ap3.valuegane', ap3.valuekoon 'ap3.valuekoon',
  ap4.value 'ap4.value', ap4.valuegane 'ap4.valuegane', ap4.valuekoon 'ap4.valuekoon',
  ap5.value 'ap5.value', ap5.valuegane 'ap5.valuegane', ap5.valuekoon 'ap5.valuekoon',
  ap6.value 'ap6.value', ap6.valuegane 'ap6.valuegane', ap6.valuekoon 'ap6.valuekoon',
  ap7.value 'ap7.value', ap7.valuegane 'ap7.valuegane', ap7.valuekoon 'ap7.valuekoon',
  ap8.value 'ap8.value', ap8.valuegane 'ap8.valuegane', ap8.valuekoon 'ap8.valuekoon',
  ap9.value 'ap9.value', ap9.valuegane 'ap9.valuegane', ap9.valuekoon 'ap9.valuekoon',
  ap10.value 'ap10.value', ap10.valuegane 'ap10.valuegane', ap10.valuekoon 'ap10.valuekoon',
  ap11.value 'ap11.value', ap11.valuegane 'ap11.valuegane', ap11.valuekoon 'ap11.valuekoon',
  ap12.value 'ap12.value', ap12.valuegane 'ap12.valuegane', ap12.valuekoon 'ap12.valuekoon',
  ap13.value 'ap13.value', ap13.valuegane 'ap13.valuegane', ap13.valuekoon 'ap13.valuekoon',
  ap14.value 'ap14.value', ap14.valuegane 'ap14.valuegane', ap14.valuekoon 'ap14.valuekoon',
  ap15.value 'ap15.value', ap15.valuegane 'ap15.valuegane', ap15.valuekoon 'ap15.valuekoon',
  ap16.value 'ap16.value', ap16.valuegane 'ap16.valuegane', ap16.valuekoon 'ap16.valuekoon',
  ap17.value 'ap17.value', ap17.valuegane 'ap17.valuegane', ap17.valuekoon 'ap17.valuekoon',
  ap18.value 'ap18.value', ap18.valuegane 'ap18.valuegane', ap18.valuekoon 'ap18.valuekoon',
  ap19.value 'ap19.value', ap19.valuegane 'ap19.valuegane', ap19.valuekoon 'ap19.valuekoon',
  ap20.value 'ap20.value', ap20.valuegane 'ap20.valuegane', ap20.valuekoon 'ap20.valuekoon',
  ap21.value 'ap21.value', ap21.valuegane 'ap21.valuegane', ap21.valuekoon 'ap21.valuekoon',
  ap22.value 'ap22.value', ap22.valuegane 'ap22.valuegane', ap22.valuekoon 'ap22.valuekoon',
  ap23.value 'ap23.value', ap23.valuegane 'ap23.valuegane', ap23.valuekoon 'ap23.valuekoon'
  FROM form_{$ep}_$y,ap1,ap2,ap3,ap4,ap5,ap6,ap7,ap8,ap9,ap10,ap11,ap12,ap13,
  ap14,ap15,ap16,ap17,ap18,ap19,ap20,ap21,ap22,ap23
  where ap1.year = '$y' and ap1.ep = '$ep' and ap1.type = '$t' and ap1.id = ap2.id and form_{$ep}_$y.id = ap1.rid
  and ap1.id = ap2.id and ap2.id = ap3.id and ap3.id = ap4.id and ap4.id = ap5.id and ap5.id = ap6.id 
  and ap6.id = ap7.id and ap7.id = ap8.id and ap8.id = ap9.id and ap9.id = ap10.id and ap10.id = ap11.id
  and ap11.id = ap12.id and ap12.id = ap13.id and ap13.id = ap14.id and ap14.id = ap15.id and ap15.id = ap16.id and ap16.id = ap17.id 
  and ap17.id = ap18.id  and ap18.id = ap19.id and ap19.id = ap20.id and ap20.id = ap21.id and ap21.id = ap22.id 
  and ap22.id = ap23.id"); 
  $stmt->execute();
  $result = $stmt->FetchAll(PDO::FETCH_BOTH);
  $i=0;
    foreach($result as $row){
      if($row['status']==1){?>
        <tr>
        <td colspan="11" style="background-color : #b1b9af" class="foo"><?php echo $row['name']?></td>
        <?php for($r=1;$r<=$apnum;$r++){?>
        <td class="cl<?php echo $r ?>"></td>
        <td class="cl<?php echo $r ?>"></td>
        <td class="cl<?php echo $r ?>"></td>
        <?php }
        ?>
        </tr><?php
    }
    else if($row['status']==2){?>
    <tr>
      <td align="center"><?php echo $row['pa']?></td>
      <td align="center"><?php echo $row['lumdub']?></td>
      <td><?php echo $row['name']?></td>
      <td align="center"><?php echo $row['gane']?></td>
      <td align="center"><?php echo $row['data']?></td>
      <td align="center" id="koon<?php echo $row['id']?>"><?php echo $row["koon$t"]?></td>
      <td align="center" id="gane1<?php echo $row['id']?>"><?php echo $row['gane1']?></td>
      <td align="center" id="gane2<?php echo $row['id']?>"><?php echo $row['gane2']?></td>
      <td align="center" id="gane3<?php echo $row['id']?>"><?php echo $row['gane3']?></td>
      <td align="center" id="gane4<?php echo $row['id']?>"><?php echo $row['gane4']?></td>
      <td align="center" id="gane5<?php echo $row['id']?>"><?php echo $row['gane5']?></td>
      <?php for($r=1;$r<=$apnum;$r++){
          ?>
      <td style="text-align:center" class="cl<?php echo $r?>"><?php echo $row["ap{$r}.value"]?></td>
      <td style="text-align:center" class="cl<?php echo $r?>"><?php echo $row["ap{$r}.valuegane"]?></td>
      <td style="text-align:center" class="cl<?php echo $r?>"><?php echo $row["ap{$r}.valuekoon"]?></td> 
      <?php }?>
    </tr>
    <?php
    } 
else if($row['status']==3){?>
        <tr>
        <td align="center"><?php echo $row['pa']?></td>
      <td align="center"><?php echo $row['lumdub']?></td>
        <td colspan="9" ><?php echo $row['name']?></td>
        <td colspan="69" style="background-color : #666f6394"></td>
      </tr><?php
    }
    else if($row['status']==4){?>
      <tr>
      <td align="center"><?php echo $row['pa']?></td>
      <td align="center"><?php echo $row['lumdub']?></td>
      <td><?php echo $row['name']?></td>
      <td align="center"><?php echo $row['gane']?></td>
      <td align="center"><?php echo $row['data']?></td>
        <td align="center" id="koon<?php echo $row['id']?>"><?php echo $row["koon$t"]?></td>
        <td align="center"><?php echo $row['gane1']?></td>
        <td style="display:none;" id="gane1<?php echo $row['id']?>">1</td>
        <td align="center"><?php echo $row['gane2']?></td>
        <td style="display:none;" id="gane2<?php echo $row['id']?>">2</td>
        <td align="center"><?php echo $row['gane3']?></td>
        <td style="display:none;" id="gane3<?php echo $row['id']?>">3</td>
        <td align="center"><?php echo $row['gane4']?></td>
        <td style="display:none;" id="gane4<?php echo $row['id']?>">4</td>
        <td align="center"><?php echo $row['gane5']?></td>
        <td style="display:none;" id="gane5<?php echo $row['id']?>">5</td>
        <?php for($r=1;$r<=$apnum;$r++){
          ?>
      <td style="text-align:center" class="cl<?php echo $r?>"><?php echo $row["ap{$r}.value"]?></td>
      <td style="text-align:center" class="cl<?php echo $r?>"><?php echo $row["ap{$r}.valuegane"]?></td>
      <td style="text-align:center" class="cl<?php echo $r?>"><?php echo $row["ap{$r}.valuekoon"]?></td> 
      <?php }?>
      
      </tr>
      <?php
      } 
      else if($row['status']==5){?>
        <tr>
        <td ></td>
      <td></td>
        <td colspan="9"><?php echo $row['name']?></td>
        <?php
        $i +=1;
        //$r =0;
        //$stmt = $conn->prepare("SELECT sum(koon) FROM form_$id where kor = $i; select * from total_score"); 
        $stmt = $conn->prepare("select m$i from total_score 
        where time = '$y' && ep = $ep && type = $t"); 
        $stmt->execute();
        $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
          //$r +=1;?>
        <td colspan="2"></td>
        <td style="text-align:center"><strong><font color="black"><?php echo $row["m$i"]?></strong></td>
        <?php
        }
        ?>
        </tr><?php
        
      }
      else if($row['status']==6){?>
        <tr>
        <td ></td>
      <td></td>
        <td colspan="9"><?php echo $row['name']?></td>
        <?php
        //$r =0;
        //$stmt = $conn->prepare("SELECT sum(koon) FROM form_$id where kor = $i; select * from total_score"); 
        $stmt = $conn->prepare("select mp$i from total_score 
        where time = '$y' && ep = $ep && type = $t"); 
        $stmt->execute();
        $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
          //$r +=1;?>
        <td colspan="2"></td>
        <td style="text-align:center"><strong><font color="black"><?php echo $row["mp$i"]?></strong></td>
        <?php
        }
        ?>
        </tr><?php
      }
      else if($row['status']==7){?>
        <tr>
        <td ></td>
      <td></td>
        <td colspan="9"><?php echo $row['name']?></td>
        <?php
        $i +=1;
        $r =0;
        //$stmt = $conn->prepare("SELECT sum(koon) FROM form_$id where kor = $i; select * from total_score"); 
        $stmt = $conn->prepare("select m$i from total_score 
        where time = '$y' && ep = $ep && type = $t"); 
        $stmt->execute();
        $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
          $r +=1;?>
        <td colspan="2"></td>
        <td style="text-align:center"><strong><font color="blue"><?php echo $row["m$i"]?></strong></td>
        <?php
        }
        ?>
        </tr><?php
        
      }
      else if($row['status']==8){?>
        <tr>
        <td ></td>
      <td></td>
        <td colspan="9"><?php echo $row['name']?></td>
        <?php
        $r =0;
        //$stmt = $conn->prepare("SELECT sum(koon) FROM form_$id where kor = $i; select * from total_score"); 
        $stmt = $conn->prepare("select mp$i from total_score 
        where time = '$y' && ep = $ep && type = $t"); 
        $stmt->execute();
        $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
          $r +=1;?>
        <td colspan="2"></td>
        <td style="text-align:center"><strong><font color="blue"><?php echo $row["mp$i"]?></strong></td>
        <?php
        }
        ?>
        </tr><?php
      }
}
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>
    </div>
  </tbody>
</table>
<!-- <button onclick="exportTableToCSV('members.csv')">Export HTML Table To CSV File</button> -->
</form>
</body>
<!-- <script>
  $(() => $('table').floatThead());
</script> -->