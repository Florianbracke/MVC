<?php 

        try {
            $database = new PDO("mysql:host=localhost;port=3307;dbname=closet", 'root', 'root');
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

<img src="" alt="">
    <ul>
        <?php foreach ($items as $item) : ?>
        <li><img src="images/<?= $item['image']?>" style="height:200px;"><br>
        <?= $item['type'] ?> - <?= $item['weather'] ?> - <?= $item['colour'] ?> - <?= $item['ocassion'] ?> - <?= $item['time'] ?></li>
        <?php endforeach; ?>
    </ul>

    

</section>
<?php require 'view/includes/footer.php'?>