

<?php //require 'includes/navbar.php'?>

<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    // Create connection
  try {
    $database = new PDO("mysql:host=localhost;dbname=my_digital_closet", 'root', 'root');
    // set the PDO error mode to exception
    $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    }

    $uploadConfirm = '';
     
    if(isset($_POST['submit'])){
     
      // Count total files
      $countfiles = count($_FILES['files']['name']);
     
      // Prepared statement
      $query = "INSERT INTO closet (image) VALUES (?)";

      // query for image

      $statement = $database->prepare($query);

      // Loop all files
      for($i=0;$i<$countfiles;$i++){

        // File name
        $filename = $_FILES['files']['name'][$i];

        // Location
        $target_file = 'images/'.$filename;

        // file extension
        $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
        $file_extension = strtolower($file_extension);

        // Valid image extension
        $valid_extension = array("png","jpeg","jpg");

          if(in_array($file_extension, $valid_extension)){
      
            // Upload file
            if(move_uploaded_file($_FILES['files']['tmp_name'][$i],$target_file)){
        
            // Execute query
            $statement->execute(array($filename));
            
            } 
          }
      }
     
      if (!empty($filename)) {
        $uploadConfirm = "<br> <br> <div class='uploadsucces' style='text-align:center; color:green;'> File upload successfully </div><br> <br> <div style='display:flex; flex-direction: column;'> 
        <img src='$target_file' style='max-height: 300px; max-width: 200px' alt='upload_image'>  </div> <br> <br>";

      }

      $new_type = $_POST['item_type'];        
      $new_weather = $_POST['item_weather'];
      $new_ocassion = $_POST['item_ocassion'];
      $new_time = $_POST['item_time'];
      $new_colour = $_POST['item_colour'];
      $statement = $database->query("UPDATE closet SET `type` = '$new_type', weather = '$new_weather', ocassion = '$new_ocassion', time = '$new_time', colour = '$new_colour'  WHERE image = '$filename'");

    }
    
  

?>
<?php require 'includes/header.php'?>
<?php require '../Itemdata.php';?>
<?php require 'includes/undernav.php'?>

<?php 
 // $insert= $database->query("INSERT INTO closet (image) SELECT name FROM images WHERE name = '$filename';"); 
 
?>
</div>

</body>
</html>
