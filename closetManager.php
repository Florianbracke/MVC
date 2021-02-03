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


$favorites = $database->query("SELECT * FROM closet WHERE favorite = '<i class=\"fas fa-heart\"></i>'");


//closet manager
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

if (!empty($_POST['edit_item'])) {

    $id = $_GET['edit'];

    $items = $database->query("SELECT * FROM closet WHERE id=$id");
}


if (!empty($_POST['edit_confirm'])) {

    $id = $_GET['edit'];

    $new_type = $_POST['item_type'];
    $new_weather = $_POST['item_weather'];
    $new_ocassion = $_POST['item_ocassion'];
    $new_time = $_POST['item_time'];
    $new_colour = $_POST['item_colour'];
    
    $statement =  $database->prepare("UPDATE closet SET type = ?, weather = ?, ocassion = ?, time = ?, colour = ? WHERE id=?");
    $statement->execute([$new_type, $new_weather, $new_ocassion, $new_time, $new_colour, $id]);

    $items = $database->query("SELECT * FROM closet WHERE id=$id");
    $alert = 'Your edits have been saved!';
}


if (!empty($_POST['delete_item'])) {
   
    $id = $_GET['delete'];

    $items = $database->query("SELECT * FROM closet WHERE id=$id");
}

if (!empty($_POST['delete_confirm'])) {

    $id = $_GET['delete'];

    $statement =  $database->prepare("DELETE FROM closet WHERE id=?");
    $statement->execute([$id]);

    $items = $database->query("SELECT * FROM closet WHERE id=$id");
    header('location: closet.php');
    $alert = 'Item has been deleted';

}



if (!empty($_POST['get_inspiration'])) {

    $weather = $_POST['item_weather'];
    $ocassion = $_POST['item_ocassion'];
    $time = $_POST['item_time'];
    $type = $_POST['item_type'];
    $image = $_POST['item_image'];
    $colour = $_POST['item_colour'];


 switch ($time) {
    case 'day':
        $time_inspo = "time = 'day'";
        break;
    case 'evening':
        $time_inspo = "time = 'evening'";
        break;
    case 'night':
        $time_inspo = "time = 'night'";
        break;
    default :
        $time_inspo = "time = 'all'";
}

switch ($ocassion) {
    case 'casual':
        $ocassion_inspo = " AND ocassion = 'casual'";
        break;
    case 'classy':
        $ocassion_inspo = " AND ocassion = 'classy'";
        break;
    case 'party':
        $ocassion_inspo = " AND ocassion = 'party'";
        break;
    case 'business':
        $ocassion_inspo = " AND ocassion = 'business'";
        break;
    case 'sporty':
        $ocassion_inspo = " AND ocassion = 'sporty'";
        break;
    default:
        $ocassion_inspo = " AND ocassion = 'all'";
}

 switch ($weather) {
    case 'hot':
        $weather_inspo = " AND weather = 'hot'";
        break;
    case 'cold':
        $weather_inspo = " AND weather = 'cold'";
        break;
    case 'rain':
        $weather_inspo = " AND weather = 'rain'";
        break;
    default :
        $weather_inspo = " AND weather = 'all'";
}

$type_inspo = " AND `type` <> '$type'";

$items = $database->query("SELECT * FROM closet WHERE $time_inspo $weather_inspo $ocassion_inspo $type_inspo");

}

if (!empty($_POST['add_favorite'])) {

    $id = $_GET['favorite'];

    $statement =  $database->prepare("UPDATE closet SET favorite = '<i class=\"fas fa-heart\"></i>' WHERE id=?");
    $statement->execute([$id]);

    header('location: favorites.php');
    
}

if (!empty($_POST['remove_favorite'])) {

    $id = $_GET['favorite'];


    $statement =  $database->prepare("UPDATE closet SET favorite = '<i class=\"far fa-heart\"></i>' WHERE id=?");
    $statement->execute([$id]);

    $favorites = $database->query("SELECT * FROM closet WHERE favorite = '<i class=\"fas fa-heart\"></i>'");

}

// Outfit manager 
if (!empty($_POST['clear_outfit'])) {
    $_SESSION['outfit'] = array();
    $alert = ' <p class="alert-delete"> All the items are deleted from your outfit of today!  </p>';
}

if (!empty($_POST['delete_item_outfit'])) {
    $key = array_search($_POST['item_id'],$_SESSION['outfit']);
    unset($_SESSION['outfit'][$key]);
    $_SESSION['outfit'] = array_values($_SESSION['outfit']);
    $alert = ' <p class="alert-delete"> The item is deleted from your outfit of today! </p>';
}


