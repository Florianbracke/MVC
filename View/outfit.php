<?php 
require '../controller/closetManager.php';
require 'includes/header.php'?>

<link rel="stylesheet" href="style.css">


<section>
<div class="topnav">
  <h3>Today's outfit</h3> 
  <ul>
    <li><a href="upload.php"><i class="fas fa-file-upload"></i></a></li>
    <li><a href="outfit.php"><i class="fas fa-calendar-day"></i></a></li>
    <li><a href="favorites.php"><i class="fas fa-heart"></i></a></li>
  </ul>
</div>

<div class="container"> 
 <form method="post">
    <input type="submit" name="clear_outfit" value="Clear Outfit" class="button-closet">
</form>


<?=$alert?> 
 <div class="masonry"> 
        <?php foreach ($_SESSION['outfit'] as $item) :?>
        <div class="masonry-item"> 
            <button class="accordion">
                <img src=images/<?= $item['item_image']?>>
            </button>
            <div class="panel">
                <ul>
                    <li> <?= ucfirst($item['item_type']) ?> | </li>
                    <li> <?= ucfirst($item['item_weather']) ?> weather | </li>
                    <li> <?= ucfirst($item['item_ocassion']) ?> |</li>
                    <li> <?= ucfirst($item['item_colour']) ?>| </li>
                    <li> <?= ucfirst($item['item_time']) ?> time </li>
                </ul>
                <form method="post">
                    <input type="hidden" name="item_id" value="<?=$item['item_id'] ?>">
                    <input type="submit" name="delete_item_outfit" value="DON'T WEAR" class="button-closet">
                </form>
            </div> 
        </div> 
        <?php endforeach; ?>
</div>
</div>
</section>

<?php require 'includes/undernav.php'?>