

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
          
          }
      }
      if (!empty($filename)) {
        echo "<br> <br> <div class='uploadsucces' style='text-align:center; color:green;'> File upload successfully </div><br> <br>";

        echo "<div style='display:flex; flex-direction: column;'> 
        <img src='$target_file' style='max-height: 300px; max-width: 200px' alt='upload_image'>  </div> <br> <br>";

      }
    }

    
    // $favorites = $database->query("SELECT name FROM TABLE images WHERE;");


 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<style>
  .form {
    text-align:center;
  }
  .targetfile{
    text-align:center;
    

  }
</style>

<body>

<div class="form">
  <form method='post' action='' enctype='multipart/form-data'>
    <input type='file' name='files[]' multiple /> <br>
    <input type='submit' value='Submit' name='submit' />
  </form>



  <div class="container"> 
 
        <?php foreach ($items as $item) : ?>
                <img src=images/<?= $item['image'] ?>>
                <div class="edit-text"> 
                <form method="post">
                    <label for="item_type"> Type of item: </label>
                    <select name="item_type" class="custom-select">
                   
                        <option value="outer wear">Outer Wear</option>
                        <option value="pants">Pants</option>
                        <option value="skirts">Skirts</option>
                        <option value="jeans">Jeans</option>
                        <option value="dress">Dress</option>
                        <option value="shorts">Shorts</option>
                        <option value="blouse">Blouse</option>
                        <option value="knits">Knits</option>
                        <option value="tshirt">T-shirt</option>
                        <option value="jewelry">Jewelry</option>
                        <option value="glasses">Glasses</option>
                        <option value="accessory">Accessory</option>
                        <option value="sneakers">Sneakers</option>
                        <option value="heels">Heels</option>
                        <option value="shoes">Shoes</option>
                        <option value="hat">Hats</option>
                    </select> <br>
                    <label for="item_weather"> Weather type: </label>
                    <select name="item_weather" class="custom-select">
                    
                        <option value="hot">Hot</option>
                        <option value="cold">Cold</option>
                        <option value="rain">Rain</option>
                        <option value="all">All</option>
                    </select> <br>
                    <label for="item_ocassion"> Ocassion: </label>
                    <select name="item_ocassion" class="custom-select">
                 
                        <option value="casual">Casual</option>
                        <option value="classy">Classy</option>
                        <option value="party">Party</option>
                        <option value="sporty">Sporty</option>
                        <option value="business">Business</option>
                        <option value="beach">Beach</option>
                    </select>   <br>                 
                    <label for="item_colour"> Colour: </label>
                    <select name="item_colour" class="custom-select">
         
                        <option value="red">Red</option>
                        <option value="orange">Orange</option>
                        <option value="yellow">Yellow</option>
                        <option value="green">Green</option>
                        <option value="blue">Blue</option>
                        <option value="purple">Purple</option>
                        <option value="black">Black</option>
                        <option value="white">White</option>
                        <option value="pink">Pink</option>
                        <option value="off white">Off White</option>
                        <option value="grey">Grey</option>
                        <option value="print">Print</option>
                    </select>   <br>                  
                    <label for="item_time"> Time of Day: </label>
                    <select name="item_time" class="custom-select">
                       
                        <option value="day">Day</option>
                        <option value="evening">Evening</option>
                        <option value="night">Night</option>
                    </select>   
                    <br> 
                    <br> 
                    <input type="submit" name="edit_confirm" value="Edit" class="button-closet editPageButton">
                </form>
                <form action="closet.php" method="post">
                    <input type="submit" value="Cancel" class="button-closet editPageButton">
                </form>
        </div>
        <?php endforeach; ?>
</div>



</div>

<div class="targetfile">

</div>
</body>
</html>
<?php require 'includes/footer.php'?>