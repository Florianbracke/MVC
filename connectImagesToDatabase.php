<?php  
try {
    $database = new PDO("mysql:host=localhost;dbname=my_digital_closet", 'root', 'root');
    // set the PDO error mode to exception
    $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    }

  if (isset($_POST['submitInfo'])) {
    echo "ale toch al iets";
  
    $type = $_POST['type'];
    $weather = $_POST['weather']; 
    $colour =  $_POST['colour'];
    $ocassion = $_POST['ocassion'];
    $time = $_POST['time'];
    
    

}
// $queryTwo = "INSERT INTO closet VALUES ('1','$type','$weather','$colour','$ocassion','$time')";
//     $database->query($queryTwo);
    
    

 ?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="" method='post'>
        <input name='type' type="text" value='what type of clothing is this?'>
        <input name='weather' type="text" value='In what weather do you want to wear it?'>
        <input name='colour' type="text" value='In what colour would you describe this item?'>
        <input name='ocassion' type="text" value='In what ocassion do you want to wear it?'>
        <input name='time' type="text" value='At what time do you want to wear it?'>

        <input type="submit" name='submitInfo'>
    </form>

</body>
</html>

