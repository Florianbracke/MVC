<?php 
require 'closetManager.php';
require 'view/includes/header.php'?>

<link rel="stylesheet" href="style.css">
<script src="https://kit.fontawesome.com/749c4bb197.js" crossorigin="anonymous"></script>

<section>
<div class="topnav">
    <h3>Get Inspired</h3> 
    <ul>
        <li><a href="upload.php"><i class="fas fa-file-upload"></i></a></li>
        <li><a href="outfit.php"><i class="fas fa-calendar-day"></i></a></li>
        <li><a href="favorites.php"><i class="fas fa-heart"></i></a></li>
    </ul>
</div>

 <?=$alert?>
 <div class="inspiration-item">
<ul>
<img src=images/<?= $image ?>>
    <li> <?= ucfirst($type) ?> | </li>
    <li> <?= ucfirst($weather) ?> weather | </li>
    <li> <?= ucfirst($ocassion) ?> |</li>
    <li> <?= ucfirst($colour) ?>| </li>
    <li> <?= ucfirst($time) ?></li>
</ul>
</div>
<h5>Recommendations: </h5>
<div class="masonry"> 
        <?php foreach ($items as $item) : ?>
        <div class="masonry-item"> 
            <button class="accordion">
                <img src=images/<?= $item['image'] ?>>
            </button>
        <div class="panel">
            <ul>
                <li> <?= ucfirst($item['type']) ?> | </li>
                <li> <?= ucfirst($item['weather']) ?> weather | </li>
                <li> <?= ucfirst($item['ocassion']) ?> |</li>
                <li> <?= ucfirst($item['colour']) ?>| </li>
                <li> <?= ucfirst($item['time']) ?> | </li>
                <li> <?=$item['favorite'] ?> </li>
            </ul>
            <form method="post">
                    <input type="hidden" name="item_type" value="<?= $item['type'] ?>">
                    <input type="hidden" name="item_id" value="<?=$item['id'] ?>">
                    <input type="hidden" name="item_image" value="<?=$item['image'] ?>">
                    <input type="hidden" name="item_weather" value="<?=$item['weather'] ?>">
                    <input type="hidden" name="item_ocassion" value="<?=$item['ocassion'] ?>">
                    <input type="hidden" name="item_colour" value="<?=$item['colour'] ?>">
                    <input type="hidden" name="item_time" value="<?=$item['time'] ?>">
                    <input type="submit" name="add_to_outfit" value="WEAR" class="button-closet">
            </form>
        </div>
        </div>

        <?php endforeach; ?>
</div>




</section>
<script src="script.js"></script>
<?php require 'view/includes/undernav.php'?>

