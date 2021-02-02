<?php 

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


?>

<?php require 'view/includes/header.php'?>

<link rel="stylesheet" href="style.css">


<section>
    <h4>Outfit page</h4>

    <p><a href="index.php">Back to homepage</a></p>
    <p><a href="closet.php">Back to closet</a></p>

 </section>

 <form method="post">
    <input type="submit" name="clear_outfit" value="Clear Outfit">
</form>

<?=$alert?> 
 <div class="grid-container"> 
        <?php 
            foreach ($_SESSION['outfit'] as $item) :?>
                <div class="grid-item"> 
                <p> <?= $item['item_type']?> </p>
                    <img src=images/<?= $item['item_image'] ?>>
                    <form method="post">
                        <input type="hidden" name="item_id" value="<?=$item['item_id'] ?>">
                        <input type="submit" name="delete_item" value="DON'T WEAR">
                    </form>
                </div> 
            <?php endforeach; ?>
</div>

<?php require 'view/includes/footer.php'?>