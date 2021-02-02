<?php 
declare(strict_types=1);

ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

session_start();

$alert = '';

        try {
            $database = new PDO("mysql:host=localhost;dbname=my_digital_closet", 'root', 'root');
            // set the PDO error mode to exception
            $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }

$items =  $database->query("SELECT * FROM closet");

if(!empty($_POST['add_to_outfit'])) {
    if (isset($_SESSION['outfit'])) {
        $item_array_id = array_column($_SESSION['outfit'], 'item_id');  

        if (!in_array($_POST['item_id'], $item_array_id)) {
            $count = count($_SESSION['outfit']);
            $item_array = array(
                'item_id' => $_POST['item_id'],
                'item_type' => $_POST['item_type'],
                'item_weather' => $_POST['item_weather'],
                'item_image' => $_POST['item_image'],
                'item_ocassion' => $_POST['item_ocassion'],
                'item_time' => $_POST['item_time'],
                'item_colour' => $_POST['item_colour']
            );
        
            $_SESSION['outfit'][$count] = $item_array;
            $alert = '<p class="alert"> The item is added to your outfit of today! </p>';
        } 
    } else {
        $item_array = array(
            'item_id' => $_POST['item_id'],
            'item_type' => $_POST['item_type'],
            'item_weather' => $_POST['item_weather'],
            'item_image' => $_POST['item_image'],
            'item_ocassion' => $_POST['item_ocassion'],
            'item_time' => $_POST['item_time'],
            'item_colour' => $_POST['item_colour']
        );

        $_SESSION['outfit'][0] = $item_array;
        $alert = '<p class="alert"> The item is added to your outfit of today! </p>';
    }
} 


if (!empty($_POST['clear_outfit'])) {
    $_SESSION['outfit'] = array();
    $alert = ' <p class="alert-delete"> All the items are deleted from your outfit of today!  </p>';
}

if (!empty($_POST['delete_item'])) {
    $key = array_search($_POST['item_id'],$_SESSION['outfit']);
    unset($_SESSION['outfit'][$key]);
    $_SESSION['outfit'] = array_values($_SESSION['outfit']);
    $alert = ' <p class="alert-delete"> The item is deleted from your outfit of today! </p>';
}