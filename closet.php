<?php 
require 'closetManager.php';
require 'view/includes/header.php'?>

<link rel="stylesheet" href="style.css">
<script src="https://kit.fontawesome.com/749c4bb197.js" crossorigin="anonymous"></script>

<section>
    <h4>Closet page</h4>

    <p><a href="index.php">Back to homepage</a></p>
    <p><a href="outfit.php">Go to selected outfit of today</a></p>

 <?=$alert?>
<div class="grid-container"> 
        <?php foreach ($items as $item) : ?>
        <div class="grid-item"> 
            <button class="accordion">
                <img src=images/<?= $item['image'] ?>>
                <p> <?= ucfirst($item['type']) ?> 
        </p>
            </button>
            <div class="panel">
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
                <form action="">

                </form>
                <form action="">

                </form>
            </div>
        </div>
        <?php endforeach; ?>
</div>

</section>
<?php require 'view/includes/footer.php'?>
<script src="script.js"></script>

