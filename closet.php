<?php 

        try {
            $database = new PDO("mysql:host=localhost;dbname=my_digital_closet", 'root', 'root');
            // set the PDO error mode to exception
            $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          } catch(PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
          }

$items =  $database->query("SELECT * FROM closet");    

?>
<?php require 'view/includes/header.php'?>

<section>
    <h4>Closet page</h4>

    <p><a href="index.php">Back to homepage</a></p>


    <ul>
        <?php foreach ($items as $item) : ?>
        <li><?= $item['type'] ?></li>
        <?php endforeach; ?>
    </ul>

</section>
<?php require 'view/includes/footer.php'?>