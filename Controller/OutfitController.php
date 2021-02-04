<?php

class OutfitController
{

    private $databaseManager;
    public $page_title;

    public function render(array $GET, array $POST)
    {
        $page_title = 'Today\'s outfit';
        $items = $this->databaseManager->database->query("SELECT * FROM closet");    
        $alert = '';

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
        }  else {

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
        }

        if (!empty($_POST['clear_outfit'])) {
            $this->clearOutfit();
        }

        if (!empty($_POST['delete_item_outfit'])) {
            $this->deleteItemFromOutfit();
        }


        require 'View/outfit.php';
    }
  
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
        $this->page_title = 'Today\'s outfit';
    }


    public function clearOutfit()
    {
        $_SESSION['outfit'] = array();
        $alert = ' <p class="alert-delete"> All the items are deleted from your outfit of today!  </p>';
    }
  

    public function deleteItemFromOutfit()
    {
        $key = array_search($_POST['item_id'], array_column($_SESSION['outfit'], 'item_id'));
        unset($_SESSION['outfit'][$key]);
        $_SESSION['outfit'] = array_values($_SESSION['outfit']);
        $alert = ' <p class="alert-delete"> The item is deleted from your outfit of today! </p>';
    }
    
}
