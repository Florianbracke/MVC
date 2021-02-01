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
            $alert = 'The item is added to your outfit of today!';
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
        $alert = 'The item is added to your outfit of today!';
    }
} ?>

<?php require 'view/includes/header.php'?>

<section>
    <h4>Closet page</h4>

    <p><a href="index.php">Back to homepage</a></p>
    <p><a href="outfit.php">Go to selected outfit of today</a></p>

<p> <?=$alert?> </p>
<div class="grid-container"> 
        <?php foreach ($items as $item) : ?>
        <div class="grid-item"> 
            <img src=images/<?= $item['image'] ?>>
            <p> <?= ucfirst($item['type']) ?> </p>
            <form method="post">
                <input type="hidden" name="item_type" value="<?=$item['type'] ?>">
                <input type="hidden" name="item_id" value="<?=$item['id'] ?>">
                <input type="hidden" name="item_image" value="<?=$item['image'] ?>">
                <input type="hidden" name="item_weather" value="<?=$item['weather'] ?>">
                <input type="hidden" name="item_ocassion" value="<?=$item['ocassion'] ?>">
                <input type="hidden" name="item_colour" value="<?=$item['colour'] ?>">
                <input type="hidden" name="item_time" value="<?=$item['time'] ?>">
                <input type="submit" name="add_to_outfit" value="WEAR">
            </form>
        </div>
        <?php endforeach; ?>
</div>

</section>
<?php require 'view/includes/footer.php'?>

<style> 
img {
    height: 250px;
    width: auto;
}

.grid-container {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-gap: 1rem;
}

.grid-item {
  text-align: center;
  overflow: hidden;
}


@media (min-width: 600px) {
  .grid-container { grid-template-columns: repeat(2, 1fr); }
}

@media (min-width: 900px) {
  .grid-container { grid-template-columns: repeat(3, 1fr); }
}

</style>