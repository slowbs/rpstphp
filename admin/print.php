<?php
//include 'db.php';
include '../functions.php';
//$ap = isset($_GET['ap']) ? $_GET['ap'] : '';
//$ap = $_SESSION['user']['apid'];
if (!isAdmin()) {
    $_SESSION['msg'] = "You must log in first";
    header('location: ../login.php');
}
$y = isset($_GET['y']) ? $_GET['y'] : '';
$t = isset($_GET['t']) ? $_GET['t'] : '';
$ep = isset($_GET['ep']) ? $_GET['ep'] : '';
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
  <link rel="stylesheet" href="fuk.css">
  <script src="fuk.js"></script>
<style>
@media print {
    table {page-break-after: always;}
}
.table th, .table td{
    border: black solid 1px !important;
}
</style>
<?php
?>
  <body onload="window.print()">
  <div class="container-fluid">
  <div class="page-header" align="center">
  <br>
<h1 align="center">การประเมินผลการพัฒนางานสาธารณสุข </h1>
  <?php echo "<h2 align='center'>รอบ <strong><span>$ep</span></strong> เดือน <strong><span>($month)</span></strong> ประจำปีงบประมาณ พ.ศ. <strong><span>$y</span></strong></h2>"?>

</div>
</div>
<div class="container">
<?php include 'headbuta.php'?>
</div>
<div class="container-fluid">
<br>
<?php
include 'db.php';
$apnstart = 0;
$apnend = 3;
$i = 0;
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT form_{$ep}_$y.*,
    GROUP_CONCAT(ap1.valuekoon ORDER by ap1.type) as ap1,
    GROUP_CONCAT(ap2.valuekoon ORDER by ap3.type) as ap2,
    GROUP_CONCAT(ap3.valuekoon ORDER by ap3.type) as ap3
    from form_{$ep}_$y, ap1, ap2, ap3
    where ap1.rid = form_{$ep}_$y.id
    and ap1.year = $y and ap1.ep = $ep
    and ap1.id = ap2.id and ap1.id = ap3.id
    GROUP by form_{$ep}_$y.id
    UNION ALL
    select form_{$ep}_$y.*,
    GROUP_CONCAT(ap4.valuekoon ORDER by ap4.type) as ap1,
    GROUP_CONCAT(ap5.valuekoon ORDER by ap5.type) as ap2,
    GROUP_CONCAT(ap6.valuekoon ORDER by ap6.type) as ap3
    from form_{$ep}_$y, ap4, ap5, ap6
    where ap4.rid = form_{$ep}_$y.id
    and ap4.year = $y and ap4.ep = $ep
    and ap4.id = ap5.id and ap4.id = ap6.id
    GROUP by form_{$ep}_$y.id
    UNION ALL
    select form_{$ep}_$y.*,
    GROUP_CONCAT(ap7.valuekoon ORDER by ap7.type) as ap1,
    GROUP_CONCAT(ap8.valuekoon ORDER by ap8.type) as ap2,
    GROUP_CONCAT(ap9.valuekoon ORDER by ap9.type) as ap3
    from form_{$ep}_$y, ap7, ap8, ap9
    where ap7.rid = form_{$ep}_$y.id
    and ap7.year = $y and ap7.ep = $ep
    and ap7.id = ap8.id and ap7.id = ap9.id
    GROUP by form_{$ep}_$y.id
    UNION ALL
    select form_{$ep}_$y.*,
    GROUP_CONCAT(ap10.valuekoon ORDER by ap10.type) as ap1,
    GROUP_CONCAT(ap11.valuekoon ORDER by ap11.type) as ap2,
    GROUP_CONCAT(ap12.valuekoon ORDER by ap12.type) as ap3
    from form_{$ep}_$y, ap10, ap11, ap12
    where ap10.rid = form_{$ep}_$y.id
    and ap10.year = $y and ap10.ep = $ep
    and ap10.id = ap11.id and ap10.id = ap12.id
    GROUP by form_{$ep}_$y.id
    UNION ALL
    select form_{$ep}_$y.*,
    GROUP_CONCAT(ap13.valuekoon ORDER by ap13.type) as ap1,
    GROUP_CONCAT(ap14.valuekoon ORDER by ap14.type) as ap2,
    GROUP_CONCAT(ap15.valuekoon ORDER by ap15.type) as ap3
    from form_{$ep}_$y, ap13, ap14, ap15
    where ap13.rid = form_{$ep}_$y.id
    and ap13.year = $y and ap13.ep = $ep
    and ap13.id = ap14.id and ap13.id = ap15.id
    GROUP by form_{$ep}_$y.id
    UNION ALL
    select form_{$ep}_$y.*,
    GROUP_CONCAT(ap16.valuekoon ORDER by ap16.type) as ap1,
    GROUP_CONCAT(ap17.valuekoon ORDER by ap17.type) as ap2,
    GROUP_CONCAT(ap18.valuekoon ORDER by ap18.type) as ap3
    from form_{$ep}_$y, ap16, ap17, ap18
    where ap16.rid = form_{$ep}_$y.id
    and ap16.year = $y and ap16.ep = $ep
    and ap16.id = ap17.id and ap16.id = ap18.id
    GROUP by form_{$ep}_$y.id
    UNION ALL
    select form_{$ep}_$y.*,
    GROUP_CONCAT(ap19.valuekoon ORDER by ap19.type) as ap1,
    GROUP_CONCAT(ap20.valuekoon ORDER by ap20.type) as ap2,
    GROUP_CONCAT(ap21.valuekoon ORDER by ap21.type) as ap3
    from form_{$ep}_$y, ap19, ap20, ap21
    where ap19.rid = form_{$ep}_$y.id
    and ap19.year = $y and ap19.ep = $ep
    and ap19.id = ap20.id and ap19.id = ap21.id
    GROUP by form_{$ep}_$y.id
    UNION ALL
    select form_{$ep}_$y.*,
    GROUP_CONCAT(ap22.valuekoon ORDER by ap22.type) as ap1,
    GROUP_CONCAT(ap23.valuekoon ORDER by ap23.type) as ap2,
    '' as ap3
    from form_{$ep}_$y, ap22, ap23
    where ap22.rid = form_{$ep}_$y.id
    and ap22.year = $y and ap22.ep = $ep
    and ap22.id = ap23.id
    GROUP by form_{$ep}_$y.id");
    $stmt->execute();
    $result = $stmt->FetchAll(PDO::FETCH_BOTH);
    //$i=0;
    foreach ($result as $row) {
        if ($row['id'] == 1) {
            ?>
  <table class="table table-bordered">
  <thead class="thead-light">
  <tr>
      <th scope="col" rowspan="2" style="font-size:12px">PA/สตป.</th>
      <th scope="col" rowspan="2" style="font-size:12px">ลำดับ</th>
      <th rowspan="2" style="font-size:12px; min-width:500px; text-align:center">ตัวชี้วัดประเมินผล</th>
      <th scope="col" rowspan="2" style="font-size:12px">เกณฑ์ ปี 2561</th>
      <th scope="col" rowspan="2" style="font-size:12px">แหล่งข้อมูล</th>
      <th scope="col" rowspan="2" style="font-size:12px">รพ.</th>
      <th scope="col" rowspan="2" style="font-size:12px">สสอ.</th>
      <th scope="col" rowspan="2" style="font-size:12px">คพสอ.</th>
      <th scope="col" colspan="5"style="text-align:center">เกณฑ์การให้คะแนน</th>
      <?php
$conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "SELECT * FROM ampher where id > $apnstart and id <= $apnend;";
/*         $apnstart +=3;
$apnend +=3; */
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
            $apnum = 0;
            foreach ($result as $ampher) {?>
           <?php $apnum += 1;?>
            <th scope="col" colspan="3"style="text-align:center"><?php echo $ampher['name'] ?></th><?php
}

            ?>
</tr>
    <tr>
      <th scope="col" style="font-size:12px">ระดับ1</th>
      <th scope="col" style="font-size:12px">ระดับ2</th>
      <th scope="col" style="font-size:12px">ระดับ3</th>
      <th scope="col" style="font-size:12px">ระดับ4</th>
      <th scope="col" style="font-size:12px">ระดับ5</th>
      <?php for ($r = 1; $r <= $apnum; $r++) {
                ?>
        <th scope="col" style="font-size:12px">รพ.</th>
      <th scope="col" style="font-size:12px">สสอ.</th>
      <th scope="col" style="font-size:12px">คปสอ.</th>
      <?php

            }
            ?>

    </tr>

  </thead>
  <tbody>
  <tr>
      <td colspan="13" class="foo"><?php echo $row['name'] ?></td>
      <?php for ($r = 1; $r <= $apnum; $r++) {?>
      <td class="cl<?php echo $r ?>"></td>
      <td class="cl<?php echo $r ?>"></td>
      <td class="cl<?php echo $r ?>"></td>
      <?php }
            ?>
      </tr>
      <?php

        } else if ($row['status'] == 1) {?>
      <tr>
      <td colspan="13" class="foo"><?php echo $row['name'] ?></td>
      <?php for ($r = 1; $r <= $apnum; $r++) {?>
      <td class="cl<?php echo $r ?>"></td>
      <td class="cl<?php echo $r ?>"></td>
      <td class="cl<?php echo $r ?>"></td>
      <?php }
            ?>
      </tr>
      <?php
} else if ($row['status'] == 2) {?>
    <td align="center"><?php echo $row['pa'] ?></td>
    <td align="center"><?php echo $row['lumdub'] ?></td>
    <td><?php echo $row['name'] ?></td>
    <td align="center"><?php echo $row['gane'] ?></td>
    <td align="center"><?php echo $row['data'] ?></td>
    <td align="center" id="koon<?php echo $row['id'] ?>"><?php echo $row["koon1"] ?></td>
    <td align="center" id="koon<?php echo $row['id'] ?>"><?php echo $row["koon2"] ?></td>
    <td align="center" id="koon<?php echo $row['id'] ?>"><?php echo $row["koon3"] ?></td>
    <td align="center" id="gane1<?php echo $row['id'] ?>"><?php echo $row['gane1'] ?></td>
    <td align="center" id="gane2<?php echo $row['id'] ?>"><?php echo $row['gane2'] ?></td>
    <td align="center" id="gane3<?php echo $row['id'] ?>"><?php echo $row['gane3'] ?></td>
    <td align="center" id="gane4<?php echo $row['id'] ?>"><?php echo $row['gane4'] ?></td>
    <td align="center" id="gane5<?php echo $row['id'] ?>"><?php echo $row['gane5'] ?></td>
    <?php for ($r = 1; $r <= $apnum; $r++) {
            $vk = explode(",", $row["ap$r"]);
            ?>
    <td style="text-align:center" class="cl<?php echo $r ?>"><?php echo $vk[0] ?></td>
    <td style="text-align:center" class="cl<?php echo $r ?>"><?php echo $vk[1] ?></td>
    <td style="text-align:center" class="cl<?php echo $r ?>"><?php echo $vk[2] ?></td>

    <?php }
            ?>
  </tr>
  <?php
} else if ($row['status'] == 3) {?>
        <tr>
        <td align="center"><?php echo $row['pa'] ?></td>
      <td align="center"><?php echo $row['lumdub'] ?></td>
        <td colspan="11" ><?php echo $row['name'] ?></td>
        <td colspan="69" style="background-color : #666f6394"></td>
      </tr><?php
} else if ($row['status'] == 4) {?>
    <tr>
    <td align="center"><?php echo $row['pa'] ?></td>
    <td align="center"><?php echo $row['lumdub'] ?></td>
    <td><?php echo $row['name'] ?></td>
    <td align="center"><?php echo $row['gane'] ?></td>
    <td align="center"><?php echo $row['data'] ?></td>
      <td align="center" id="koon<?php echo $row['id'] ?>"><?php echo $row["koon1"] ?></td>
      <td align="center" id="koon<?php echo $row['id'] ?>"><?php echo $row["koon2"] ?></td>
      <td align="center" id="koon<?php echo $row['id'] ?>"><?php echo $row["koon3"] ?></td>
      <td align="center"><?php echo $row['gane1'] ?></td>
      <td style="display:none;" id="gane1<?php echo $row['id'] ?>">1</td>
      <td align="center"><?php echo $row['gane2'] ?></td>
      <td style="display:none;" id="gane2<?php echo $row['id'] ?>">2</td>
      <td align="center"><?php echo $row['gane3'] ?></td>
      <td style="display:none;" id="gane3<?php echo $row['id'] ?>">3</td>
      <td align="center"><?php echo $row['gane4'] ?></td>
      <td style="display:none;" id="gane4<?php echo $row['id'] ?>">4</td>
      <td align="center"><?php echo $row['gane5'] ?></td>
      <td style="display:none;" id="gane5<?php echo $row['id'] ?>">5</td>
      <?php for ($r = 1; $r <= $apnum; $r++) {
            $vk = explode(",", $row["ap$r"]);
            ?>
    <td style="text-align:center" class="cl<?php echo $r ?>"><?php echo $vk[0] ?></td>
    <td style="text-align:center" class="cl<?php echo $r ?>"><?php echo $vk[1] ?></td>
    <td style="text-align:center" class="cl<?php echo $r ?>"><?php echo $vk[2] ?></td>
    <?php }?>

    </tr>
    <?php
} else if ($row['status'] == 5) {
            ?>
      <tr>
      <td ></td>
    <td></td>
      <td colspan="11" style="background-color : #e2eae0 !important;" ><?php echo $row['name'] ?></td>
      <?php
$i += 1;
            //$r =0;
            //$stmt = $conn->prepare("SELECT sum(koon) FROM form_$id where kor = $i; select * from total_score");
      $stmt = $conn->prepare("SELECT GROUP_CONCAT(total_score.m$i ORDER by type) as ap$i
      FROM total_score WHERE total_score.time = $y and ep = $ep and apid > $apnstart and apid <= $apnend
      GROUP by apid ORDER by apid");
            $stmt->execute();
            $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $vk = explode(",", $row["ap$i"]);
                //$r +=1;?>
      <td style="text-align:center; background-color : #e2eae0 !important;"><?php echo $vk[0] ?></td>
      <td style="text-align:center; background-color : #e2eae0 !important;"><?php echo $vk[1] ?></td>
      <td style="text-align:center; background-color : #e2eae0 !important;"><?php echo $vk[2] ?></td>
      <?php
}
            ?>
      </tr><?php
} else if ($row['status'] == 6) {
            ?>
      <tr>
      <td ></td>
    <td></td>
      <td colspan="11" style="background-color : #e2eae0 !important;"><?php echo $row['name'] ?></td>
      <?php
//$r =0;
            //$stmt = $conn->prepare("SELECT sum(koon) FROM form_$id where kor = $i; select * from total_score");
            $stmt = $conn->prepare("SELECT GROUP_CONCAT(total_score.m$i ORDER by type) as ap$i
      FROM total_score WHERE total_score.time = $y and ep = $ep and apid > $apnstart and apid <= $apnend
      GROUP by apid ORDER by apid");
            $stmt->execute();
            $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
            foreach ($result as $row) {
                $vk = explode(",", $row["ap$i"]);
                //$r +=1;?>
      <td style="text-align:center; background-color : #e2eae0 !important;"><?php echo $vk[0] ?></td>
      <td style="text-align:center; background-color : #e2eae0 !important;"><?php echo $vk[1] ?></td>
      <td style="text-align:center; background-color : #e2eae0 !important;"><?php echo $vk[2] ?></td>
      <?php
}
            ?>
      </tr><?php
} 
else if($row['status']==7){?>
      <tr>
      <td ></td>
    <td></td>
      <td colspan="11"><?php echo $row['name']?></td>
      <?php
      $i +=1;
      $r =0;
      //$stmt = $conn->prepare("SELECT sum(koon) FROM form_$id where kor = $i; select * from total_score"); 
      $stmt = $conn->prepare("SELECT GROUP_CONCAT(total_score.m$i ORDER by type) as ap$i 
      FROM total_score WHERE total_score.time = $y and ep = $ep and apid > $apnstart and apid <= $apnend
      GROUP by apid ORDER by apid"); 
      $stmt->execute();
      $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
      foreach($result as $row){
        $vk = explode(",", $row["ap$i"]);
        $r +=1;?>
      <td style="text-align:center" class="cl<?php echo $r?>"><font color="blue"><?php echo $vk[0]?></td>
      <td style="text-align:center" class="cl<?php echo $r?>"><font color="blue"><?php echo $vk[1]?></td>
      <td style="text-align:center" class="cl<?php echo $r?>"><font color="blue"><?php echo $vk[2]?></td> 
      <?php
      }
      ?>
      </tr><?php
      
    }
    else if($row['status']==8){?>
      <tr>
      <td ></td>
    <td></td>
      <td colspan="11"><?php echo $row['name']?></td>
      <?php
      $r =0;
      //$stmt = $conn->prepare("SELECT sum(koon) FROM form_$id where kor = $i; select * from total_score"); 
      $stmt = $conn->prepare("SELECT GROUP_CONCAT(total_score.mp$i ORDER by type) as ap$i 
      FROM total_score WHERE total_score.time = $y and ep = $ep and apid > $apnstart and apid <= $apnend
      GROUP by apid ORDER by apid"); 
      $stmt->execute();
      $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
      foreach($result as $row){
        $vk = explode(",", $row["ap$i"]);
        $r +=1;?>
      <td style="text-align:center" class="cl<?php echo $r?>"><strong><font color="blue"><?php echo $vk[0]?></strong></td>
      <td style="text-align:center" class="cl<?php echo $r?>"><strong><font color="blue"><?php echo $vk[1]?></strong></td>
      <td style="text-align:center" class="cl<?php echo $r?>"><strong><font color="blue"><?php echo $vk[2]?></strong></td> 
      <?php
}
            $apnstart += 3;
            $apnend += 3;
            $i = 0;
            ?>
      </tr><?php

        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
?>

  </tbody></table>
</body>