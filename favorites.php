<?php 
require 'closetManager.php';
require 'view/includes/header.php'?>

<link rel="stylesheet" href="style.css">
<script src="https://kit.fontawesome.com/749c4bb197.js" crossorigin="anonymous"></script>

<section>

<h2> Your favorite items</h2>

 <?=$alert?>
<div class="grid-container"> 
        <?php foreach ($inspiration as $item) : ?>
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
                <form action="?favorite=<?=$item['id']?>" method="post">
                <input type="submit" name="remove_favorite" value="Remove Favorite">
                </form>
        </div>
        </div>

        <?php endforeach; ?>
</div>




</section>
<script src="script.js"></script>
<?php require 'view/includes/footer.php'?>

