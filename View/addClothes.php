


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

    $items =  $database->query("SELECT * FROM images");
     
    if(isset($_POST['submit'])){
    
      // Count total files
      $countfiles = count($_FILES['files']['name']);
     
      // Prepared statement
      $query = "INSERT INTO images (name,image) VALUES(?,?)";
    
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
            $statement->execute(array($filename,$target_file));
            
            }
          echo "<div class='displaytargetFile style='display:flex; flex-direction: column;''> <img src='$target_file' style='height: 200px' alt='upload_image'> </div>";
         
          }
      }
      if (!empty($filename)) {
        echo "<br> <br> File upload successfully";

      }
    }
?>
<p><a href="index.php">Back to homepage</a></p>

<form method='post' action='' enctype='multipart/form-data'>
  <input type='file' name='files[]' multiple />
  <input type='submit' value='Submit' name='submit' />
</form>

