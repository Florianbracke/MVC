<?php 


  // foraddClothes.php 
if (isset($_POST['Itemdata'])) {

$new_type = $_POST['item_type'];        
$new_weather = $_POST['item_weather'];
$new_ocassion = $_POST['item_ocassion'];
$new_time = $_POST['item_time'];
$new_colour = $_POST['item_colour'];


$statement = $database->query("INSERT INTO closet (type, weather, colour, ocassion, time) VALUES ('$new_type', '$new_weather', '$new_ocassion', '$new_time', '$new_colour')");

} 