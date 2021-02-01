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

<div class="grid-container"> 
        <?php foreach ($items as $item) : ?>
        <div class="grid-item"> <img src=images/<?= $item['image'] ?>> </div>
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
}


@media (min-width: 600px) {
  .grid-container { grid-template-columns: repeat(2, 1fr); }
}

@media (min-width: 900px) {
  .grid-container { grid-template-columns: repeat(3, 1fr); }
}

</style>