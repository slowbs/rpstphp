<?php
include 'functions.php';
if (!isAdmin()) {
  $_SESSION['msg'] = "You must log in first";
  header('location: ../login.php');
  exit();
}
$y = isset($_GET['y']) ? $_GET['y'] : '';
$ap = isset($_GET['ap']) ? $_GET['ap'] : '';
$ep = isset($_GET['ep']) ? $_GET['ep'] : '';
$t = isset($_GET['t']) ? $_GET['t'] : '';
$month = $_SESSION['quarter']["$ep"];
//$apname = $_SESSION['name'][$ap];
//$time = $_SESSION['time'][$ap];
$typename = $_SESSION['typename'][$ap];
//echo $id; // ผลลัพธ์คือแสดงข้อความ Hello 
include 'db.php';
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT name,apid,time_format(time, '%d/%m/%Y %H:%i') as time, username FROM log where apid = $ap && year = $y && ep = $ep && type = $t;";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
            $apname = $row['name'];
            //$_SESSION['apname'][$ap] = $apname;
            $time = $row['time'];
            $editname = $row['username'];
    }
  }
    catch(PDOException $e)
        {
        echo $sql . "<br>" . $e->getMessage();
        }
    
    $conn = null;
?>
  <title>Bootstrap 4 Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="fuk.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <script src="https://unpkg.com/floatthead"></script>
  <script src="fuk.js"></script>
    <style type="text/css">
        textarea {display: block !important; padding: 3px 0 0 0 !important; margin: 0 !important; width: 100% !important; height:100% !important;
        border-radius: 0 !important; line-height: 1 !important; border: 0 !important; resize:none !important;}

        td {margin: 0 !important; padding: 0 !important; height:22px !important;}
        #right {border-right-style: none;}
        #left {border-left-style: none;}
        .foo
{
    padding-left: 108px !important;
}
@page {
    size: auto;
}
    </style>
<?php
?>
  <body> 
  <br>
  <div class="container-fluid">
  <div class="page-header" align="center" >
  <?php echo "<h2 align='center'>การประเมินผลการพัฒนางานสาธารณสุข รอบ <strong><span style='color:blue'>$ep</span></strong> เดือน <strong><span style='color:blue'>($month)</span></strong></h2>"?>
<?php echo "<h2 align='center'>ระดับ <strong><span style='color:blue'>$typename</span></strong></strong> อำเภอ <strong><span style='color:blue'>$apname</span></strong> ประจำปีงบประมาณ พ.ศ. <strong><span style='color:blue'>$y</span></strong></h2>";?>
</div>
</div>
<div class="container">
<?php include 'headbutform.php' ?>
</div>
<div class="container-fluid">
<div style="float: right"><p>แก้ไขล่าสุดโดย <?php echo $editname ?> เวลา <?php echo $time ?></p></div>
<br>
  <table class="table table-bordered sticky-header" style="width:100%">
  <thead class="thead-dark" id="thead1">
    <tr>
      <th scope="col" style="font-size:12px; width:6%">PA/สตป.</th>
      <th scope="col" style="font-size:12px">ลำดับ</th>
      <th scope="col" style="font-size:12px; width:100%; text-align:center">ตัวชี้วัดประเมินผล</th>
      <th scope="col" style="font-size:12px">เกณฑ์ ปี 2561</th>
      <th scope="col" style="font-size:12px">แหล่งข้อมูล</th>
      <th scope="col" style="font-size:12px">น้ำหนัก</th>
      <th scope="col" style="font-size:12px">ระดับ1</th>
      <th scope="col" style="font-size:12px">ระดับ2</th>
      <th scope="col" style="font-size:12px">ระดับ3</th>
      <th scope="col" style="font-size:12px">ระดับ4</th>
      <th scope="col" style="font-size:12px">ระดับ5</th>
      <th scope="col" style="font-size:12px">ผลการดำเนินงาน</th>
      <th scope="col" style="font-size:12px">ค่าคะแนนที่ได้</th>
      <th scope="col" style="font-size:12px">คะแนนถ่วงน้ำหนัก</th>
    </tr>
  </thead>
<!--   <thead class="thead-dark" id="thead2">
    <tr>
      <th scope="col" style="font-size:12px; width:6%">PA/สตป.</th>
      <th scope="col" style="font-size:12px">ลำดับ</th>
      <th scope="col" style="font-size:12px; width:100%; text-align:center">ตัวชี้วัดประเมินผล</th>
      <th scope="col" style="font-size:12px">เกณฑ์ ปี 2561</th>
      <th scope="col" style="font-size:12px">แหล่งข้อมูล</th>
      <th scope="col" style="font-size:12px">น้ำหนัก</th>
      <th scope="col" style="font-size:12px">ระดับ1</th>
      <th scope="col" style="font-size:12px">ระดับ2</th>
      <th scope="col" style="font-size:12px">ระดับ3</th>
      <th scope="col" style="font-size:12px">ระดับ4</th>
      <th scope="col" style="font-size:12px">ระดับ5</th>
      <th scope="col" style="font-size:12px">ผลการดำเนินงาน</th>
      <th scope="col" style="font-size:12px">ค่าคะแนนที่ได้</th>
      <th scope="col" style="font-size:12px">คะแนนถ่วงน้ำหนัก</th>
    </tr>
  </thead> -->
  <tbody style="width:100%">
  <form action="update.php?y=<?php echo $y?>&ap=<?php echo $ap?>&ep=<?php echo $ep?>&t=<?php echo $t?>" method="POST">
<?php
include 'db.php';
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->prepare("SELECT ap$ap.*, form_{$ep}_$y.* from form_{$ep}_$y inner join ap$ap on 
  form_{$ep}_$y.id = ap$ap.rid
  where ap$ap.year = $y and ap$ap.ep = $ep and ap$ap.type = $t;"); 
  $stmt->execute();
  $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
  $i=0;

    foreach($result as $row){
      if($row['status']==1){?>
        <tr>
        <td colspan="14" style="background-color : #d1d1d1" class="foo"><?php echo $row['name']?></td>
      </tr><?php
    }
    else if($row['status']==2){?>
    <tr>
      <td align="center"><?php echo $row['pa']?></td>
      <td align="center"><?php echo $row['lumdub']?></td>
      <td ><?php echo $row['name']?></td>
      <td align="center"><?php echo $row['gane']?></td>
      <td align="center"><?php echo $row['data']?></td>
      <td align="center" class="cl6" id="koon<?php echo $row['id']?>"><?php echo $row["koon$t"]?></td>
      <td align="center" class="cl1" id="gane1_<?php echo $row['id']?>"><?php echo $row['gane1']?></td>
      <td align="center" class="cl1" id="gane2_<?php echo $row['id']?>"><?php echo $row['gane2']?></td>
      <td align="center" class="cl1" id="gane3_<?php echo $row['id']?>"><?php echo $row['gane3']?></td>
      <td align="center" class="cl1" id="gane4_<?php echo $row['id']?>"><?php echo $row['gane4']?></td>
      <td align="center" class="cl1" id="gane5_<?php echo $row['id']?>"><?php echo $row['gane5']?></td>
      <td><textarea rows="1" class="form-control test <?php echo $row['kor']?>" style="text-align:center"
      id="<?php echo $row['id']?>" name="input[<?php echo $row['id']?>]" tabindex="<?php echo $row['id']?>"><?php echo $row["value"]?></textarea></td>
      <td style="background-color : #e9ecef"><textarea rows="1" class="form-control" style="text-align:center"
      id="box_<?php echo $row['id']?>" name="score[<?php echo $row['id']?>]" readonly="readonly"><?php echo $row["valuegane"]?></textarea></td>
      <td style="background-color : #e9ecef"><textarea rows="1" class="form-control" style="text-align:center" 
      id="box2_<?php echo $row['id']?>" name="score2[<?php echo $row['id']?>]" readonly="readonly"><?php echo $row["valuekoon"]?></textarea></td>
    
    </tr>
    <?php
    } 
else if($row['status']==3){?>
        <tr>
        <td align="center"><?php echo $row['pa']?></td>
      <td align="center"><?php echo $row['lumdub']?></td>
        <td colspan="12"><?php echo $row['name']?></td>
      </tr><?php
    }
    else if($row['status']==4){?>
      <tr>
      <td align="center"><?php echo $row['pa']?></td>
      <td align="center"><?php echo $row['lumdub']?></td>
      <td><?php echo $row['name']?></td>
      <td align="center"><?php echo $row['gane']?></td>
      <td align="center"><?php echo $row['data']?></td>
        <td align="center" class="cl6" id="koon<?php echo $row['id']?>"><?php echo $row["koon$t"]?></td>
        <td align="center" class="cl1"><?php echo $row['gane1']?></td>
        <td style="display:none;" id="gane1_<?php echo $row['id']?>">1</td>
        <td align="center" class="cl1"><?php echo $row['gane2']?></td>
        <td style="display:none;" id="gane2_<?php echo $row['id']?>">2</td>
        <td align="center" class="cl1"><?php echo $row['gane3']?></td>
        <td style="display:none;" id="gane3_<?php echo $row['id']?>">3</td>
        <td align="center" class="cl1"><?php echo $row['gane4']?></td>
        <td style="display:none;" id="gane4_<?php echo $row['id']?>">4</td>
        <td align="center" class="cl1"><?php echo $row['gane5']?></td>
        <td style="display:none;" id="gane5_<?php echo $row['id']?>">5</td>
        <td><textarea rows="1" class="form-control test <?php echo $row['kor']?>" style="text-align:center"
        id="<?php echo $row['id']?>" name="input[<?php echo $row['id']?>]" tabindex="<?php echo $row['id']?>"><?php echo $row["value"]?></textarea></td>
        <td  style="background-color : #e9ecef"><textarea rows="1" class="form-control" style="text-align:center"
        id="box_<?php echo $row['id']?>" name="score[<?php echo $row['id']?>]" readonly="readonly"><?php echo $row["valuegane"]?></textarea></td>
        <td  style="background-color : #e9ecef"><textarea rows="1" class="form-control" style="text-align:center" 
        id="box2_<?php echo $row['id']?>" name="score2[<?php echo $row['id']?>]" readonly="readonly"><?php echo $row["valuekoon"]?></textarea></td>
      
      </tr>
      <?php
      } 
      else if($row['status']==5){?>
        <tr>
        <td ></td>
      <td></td>
        <td colspan="10"><?php echo $row['name']?></td><?php
        $i +=1;
        //$stmt = $conn->prepare("SELECT sum(koon) FROM form_$id where kor = $i; select * from total_score"); 
        $stmt = $conn->prepare("SELECT total_score.*, kor, sum(koon$t) from form_{$ep}_$y inner join total_score 
        where total_score.apid = '$ap' and form_{$ep}_$y.kor = '$i' and total_score.time = $y
        and total_score.ep = $ep and total_score.type = $t;"); 
        $stmt->execute();
        $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){?>
        <?php $maxscore = ($row["sum(koon$t)"]*5)/100;?>
        <input type="hidden" name="input2[<?php echo $i ?>]">
        <td><input type="text" class="form-control" style="text-align:center" id="maxscore_<?php echo $i?>" 
        value="<?php echo $maxscore ?>" name="score3_[<?php echo $i?>]" readonly="readonly"></td>
        <td><input type="text" class="form-control" style="text-align:center" id="box3_<?php echo $i?>"
        name="scorei[<?php echo $i?>]" readonly="readonly" value="<?php echo $row["m$i"]?>"></td></tr><?php
        }
      }
      else if($row['status']==6){?>
        <tr>
        <td></td>
      <td></td>
        <td colspan="10"><?php echo $row['name']?></td>
        <?php
        $stmt = $conn->prepare("SELECT total_score.*, kor, sum(koon$t) from form_{$ep}_$y inner join total_score 
        where total_score.apid = '$ap' and form_{$ep}_$y.kor = '$i' and total_score.time = $y
        and total_score.ep = $ep and total_score.type = $t;"); 
        $stmt->execute();
        $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){?>
        <?php //$newid = $row['max(id)'];?>
        <input type="hidden" name="input2[<?php echo $i?>]">
        <td><input type="text" class="form-control" style="text-align:center" id="percent_<?php echo $row['kor']?>" 
        value="<?php echo $row["sum(koon$t)"]?>" readonly="readonly"></td>
        <td><input type="text" class="form-control" style="text-align:center" id="box4_<?php echo $i?>"
        name="score2i[<?php echo $i?>]" readonly="readonly" value="<?php echo $row["mp$i"]?>"></td></tr><?php
        }
      }
      else if($row['status']==7){?>
        <tr>
        <td></td>
      <td></td>
        <td colspan="10"><?php echo $row['name']?></td><?php
        $i +=1;
        //$stmt = $conn->prepare("SELECT sum(koon) FROM form_$id where kor = $i; select * from total_score"); 
        $stmt = $conn->prepare("SELECT total_score.*, kor, sum(koon$t) from form_{$ep}_$y inner join total_score 
        where total_score.apid = '$ap' and form_{$ep}_$y.kor != '0' and total_score.time = $y
        and total_score.ep = $ep and total_score.type = $t;"); 
        $stmt->execute();
        $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){?>
        <?php $maxscore = ($row["sum(koon$t)"]*5)/100;?>
        <input type="hidden" name="input2[<?php echo $i ?>]">
        <td><input type="text" class="form-control" style="text-align:center" id="maxscore_<?php echo $i?>" 
        value="<?php echo $maxscore ?>" name="score3_[<?php echo $i?>]" readonly="readonly"></td>
        <td><input type="text" class="form-control" style="text-align:center" id="box5"
        name="scorei[<?php echo $i?>]" readonly="readonly" value="<?php echo $row["m$i"]?>"></td></tr><?php
        }
    }
    else if($row['status']==8){?>
      <tr>
      <td></td><td></td>
      <td colspan="10"><?php echo $row['name']?></td>
      <?php
      $stmt = $conn->prepare("SELECT total_score.*, kor, sum(koon$t) from form_{$ep}_$y inner join total_score 
      where total_score.apid = '$ap' and form_{$ep}_$y.kor != '0' and total_score.time = $y
      and total_score.ep = $ep and total_score.type = $t;"); 
      $stmt->execute();
      $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
      foreach($result as $row){?>
      <?php //$newid = $row['max(id)'];?>
      <input type="hidden" name="input2[<?php echo $i?>]">
      <td><input type="text" class="form-control" style="text-align:center" id="percent_<?php echo $row['kor']?>" 
      value="<?php echo $row["sum(koon$t)"]?>" readonly="readonly"></td>
      <td><input type="text" class="form-control" style="text-align:center" id="box6"
      name="score2i[<?php echo $i?>]" readonly="readonly" value="<?php echo $row["mp$i"]?>"></td></tr><?php
      }
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
<div align="right" style="padding-right: 108px">
<button type="submit" class="btn btn-primary" style="width:100px">บันทึก</button>
</div>
</form>
<br>
</body>
<!-- <script>
document.onscroll = function() {
  var scroll = $(window).scrollTop();
  if (scroll >= 120) {
    $("#thead2").css({
      "position": "fixed",
      "top": "0px"
    });
    $("th").css({"margin":"auto"});
  } else {
    $("#thead1").css({
      "display": "none",
    });
  }
};
</script> -->
<script>
  $(() => $('table').floatThead());
</script>