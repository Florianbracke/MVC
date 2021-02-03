<?php 
require 'closetManager.php';
require 'view/includes/header.php'?>

<link rel="stylesheet" href="style.css">
<script src="https://kit.fontawesome.com/749c4bb197.js" crossorigin="anonymous"></script>

<section>

<p><a href="index.php">Back to homepage</a></p>
    <p><a href="outfit.php">Go to outfit of today</a></p>
    <p><a href="favorites.php">Go to favorites</a></p>
    <p><a href="closet.php">Go to closet</a></p>


<h2> Get inspired</h2>


 <?=$alert?>
<img src=images/<?= $image ?>>
<p> Type of Item: <?= ucfirst($type) ?> </p>
<p> Weather Type: <?= ucfirst($weather) ?> </p>
<p> Occasion: <?= ucfirst($ocassion) ?> </p>
<p> Colour: <?= ucfirst($colour) ?> </p>
<p> Time of Day: <?= ucfirst($time) ?> </p>
<div class="grid-container"> 
        <?php foreach ($items as $item) : ?>
        <div class="grid-item"> 
            <button class="accordion">
                <img src=images/<?= $item['image'] ?>>
            </button>
        <div class="panel">
            <p> Type of Item: <?= ucfirst($item['type']) ?> </p>
            <p> Weather Type: <?= ucfirst($item['weather']) ?> </p>
            <p> Occasion: <?= ucfirst($item['ocassion']) ?> </p>
            <p> Colour: <?= ucfirst($item['colour']) ?> </p>
            <p> Time of Day: <?= ucfirst($item['time']) ?> </p>
            <form method="post">
                    <input type="hidden" name="item_type" value="<?= $item['type'] ?>">
                    <input type="hidden" name="item_id" value="<?=$item['id'] ?>">
                    <input type="hidden" name="item_image" value="<?=$item['image'] ?>">
                    <input type="hidden" name="item_weather" value="<?=$item['weather'] ?>">
                    <input type="hidden" name="item_ocassion" value="<?=$item['ocassion'] ?>">
                    <input type="hidden" name="item_colour" value="<?=$item['colour'] ?>">
                    <input type="hidden" name="item_time" value="<?=$item['time'] ?>">
                    <input type="submit" name="add_to_outfit" value="WEAR">
            </form>
        </div>
        </div>

        <?php endforeach; ?>
</div>




</section>
<script src="script.js"></script>
<?php require 'view/includes/footer.php'?>

