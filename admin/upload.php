<?php 
	include('functions.php');
	//$ap = isset($_GET['ap']) ? $_GET['ap'] : '';
    //$ap = $_SESSION['user']['apid'];
    if (!isAdmin()) {
      $_SESSION['msg'] = "You must log in first";
      header('location: ../login.php');
      exit();
  }
    //$ap = $_SESSION['user']['username'];
    $ap = isset($_GET['ap']) ? $_GET['ap'] : '';
    $acode = isset($_GET['acode']) ? $_GET['acode'] : '';
include "dbupload.php";
 
if(empty($_FILES['files1']['name']['0']) && empty($_FILES['files2']['name']['0']) 
&& empty($_FILES['files3']['name']['0']) && empty($_FILES['files4']['name']['0'])){

  echo "<script>
  alert('กรุณาเลือกรูปภาพ');
  window.location.href='edit.php?id=$ap#nav-profile';
  </script>";

}
else{
  //print_r($_FILES);
  // Count total files
  $countarray = count($_FILES);
  for($j=1;$j<=$countarray;$j++){

  $countfiles = count($_FILES["files$j"]['name']);
  //echo $countfiles;
  // Prepared statement
  $query = "INSERT INTO images (name,image,user,time,type) VALUES(?,?,'$ap',NOW(),'$j')";

  $statement = $conn->prepare($query);

  // Loop all files
  for($i=0;$i<$countfiles;$i++){

    // File name
    $filename = $_FILES["files$j"]['name'][$i];

    // Get extension
    $tmp = explode('.', $filename);
    $ext = end($tmp);
    //$ext = end((explode(".", $filename)));
    $ran = rand () ;
    $filename = $ran.".".$ext;

    // Valid image extension
    $valid_ext = array("png","jpeg","jpg");

    if(in_array($ext, $valid_ext)){

      // Upload file
      if(move_uploaded_file($_FILES["files$j"]['tmp_name'][$i],'../user/upload/'.$filename)){

        //$filename = "'upload/'$filename"; /*ADD YOUR FILENAME WITH PATH*/

        //echo "<script>alert('fuck')</script>";

        // Execute query
        $statement->execute(array($filename,'../user/upload/'.$filename));
        correctImageOrientation('../user/upload/'.$filename);

      }

    }

  }
}

  //echo "File upload successfully";
  echo "<script>
    alert('เพิ่มรูปภาพสำเร็จ');
    window.location.href='edit.php?id=$ap&acode=$acode#nav-profile';
    </script>";
  
}
function correctImageOrientation($filename) {
  if (function_exists('exif_read_data')) {
    $exif = exif_read_data($filename);
    if($exif && isset($exif['Orientation'])) {
      $orientation = $exif['Orientation'];
      if($orientation != 1){
        $img = imagecreatefromjpeg($filename);
        $deg = 0;
        switch ($orientation) {
          case 3:
            $deg = 180;
            break;
          case 6:
            $deg = 270;
            break;
          case 8:
            $deg = 90;
            break;
        }
        if ($deg) {
          $img = imagerotate($img, $deg, 0);        
        }
        // then rewrite the rotated image back to the disk as $filename 
        imagejpeg($img, $filename, 95);
      } // if there is some rotation necessary
    } // if have the exif orientation info
  } // if function exists      
}
?>