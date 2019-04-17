<?php
//Include the database configuration file
include 'db.php';

if(!empty($_POST["amphurcode"])){
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM tambon where AMPUR = ".$_POST['amphurcode']." and TAMBON > '00';"); 
          $stmt->execute();
          $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
    
    //State option list
    if(count($result) > 0){
        echo '<option value="">กรุณาเลือกตำบล</option>';
        foreach($result as $row){?>
            <option value="<?php echo $row['TAMBON']?>" ><?php echo $row['TAMBONNAME'];?></option>
            <?php }
    }else{
        echo '<option value="">State not available</option>';
    }
}elseif(!empty($_POST["tambon"])){
    //Fetch all city data
    //$query = $db->query("SELECT * FROM village WHERE ampurcode = ".$_POST['amphurcode']." AND tamboncode = ".$_POST['state_id']."; ");
    
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare("SELECT * FROM village WHERE ampurcode = ".$_POST['amphur']." and tamboncode = ".$_POST['tambon']."; "); 
          $stmt->execute();
          $result = $stmt->FetchAll(PDO::FETCH_ASSOC);
    
    //City option list
    if(count($result) > 0){
        echo '<option value="00">กรุณาเลือกหมู่บ้าน</option>';
        foreach($result as $row){?>
            <option value=<?php echo $row['villagecode']?>><?php echo $row['villagename']?></option>
            <?php }
    }else{
        echo '<option value="">City not available</option>';
    }
}
?>