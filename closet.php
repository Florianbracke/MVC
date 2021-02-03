<?php 
require 'closetManager.php';
require 'view/includes/header.php'?>

<section>


<div class="topnav">
  <h3>Your Closet</h3> 
  <ul>
    <li><a href="upload.php"><i class="fas fa-file-upload"></i></a></li>
    <li><a href="outfit.php"><i class="fas fa-calendar-day"></i></a></li>
    <li><a href="favorites.php"><i class="fas fa-heart"></i></a></li>
  </ul>
</div>


<div class="container"> 

<?=$alert?>
<div class="grid-container"> 
    <?php foreach ($items as $item) : ?>
    <div class="grid-item"> 
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
            <div class="inline-buttons">
            <ul>
                <li>
                    <form method="post">
                        <input type="hidden" name="item_type" value="<?=$item['type'] ?>">
                        <input type="hidden" name="item_id" value="<?=$item['id'] ?>">
                        <input type="hidden" name="item_image" value="<?=$item['image'] ?>">
                        <input type="hidden" name="item_weather" value="<?=$item['weather'] ?>">
                        <input type="hidden" name="item_ocassion" value="<?=$item['ocassion'] ?>">
                        <input type="hidden" name="item_colour" value="<?=$item['colour'] ?>">
                        <input type="hidden" name="item_time" value="<?=$item['time'] ?>">
                        <input type="submit" name="add_to_outfit" value="Wear" class="button-closet">
                    </form>
                </li>
                <li>
                    <form action="favorites.php?favorite=<?=$item['id']?>" method="post">
                        <input type="submit" name="add_favorite" value="&#xf004;" class="button-closet">
                    </form>
                </li>
                <li>
                    <form action="inspiration.php?item=<?=$item['id']?>" method="post">
                        <input type="hidden" name="item_type" value="<?=$item['type'] ?>">
                        <input type="hidden" name="item_image" value="<?=$item['image'] ?>">
                        <input type="hidden" name="item_weather" value="<?=$item['weather'] ?>">
                        <input type="hidden" name="item_ocassion" value="<?=$item['ocassion'] ?>">
                        <input type="hidden" name="item_colour" value="<?=$item['colour'] ?>">
                        <input type="hidden" name="item_time" value="<?=$item['time'] ?>">
                        <input type="submit" name="get_inspiration" value="Get inspired" class="button-closet">
                    </form>
                </li>
                <li>
                    <form action="editItem.php?edit=<?=$item['id']?>" method="post">
                        <input type="hidden" name="item_type" value="<?=$item['type'] ?>">
                        <input type="hidden" name="item_id" value="<?=$item['id'] ?>">
                        <input type="hidden" name="item_image" value="<?=$item['image'] ?>">
                        <input type="hidden" name="item_weather" value="<?=$item['weather'] ?>">
                        <input type="hidden" name="item_ocassion" value="<?=$item['ocassion'] ?>">
                        <input type="hidden" name="item_colour" value="<?=$item['colour'] ?>">
                        <input type="hidden" name="item_time" value="<?=$item['time'] ?>">
                        <input type="submit" name="edit_item" value="&#xf044;" class="button-closet">
                    </form>
                </li>
                <li>
                    <form action="deleteItem.php?delete=<?=$item['id']?>" method="post">
                        <input type="submit" name="delete_item" value="&#xf1f8;" class="button-closet trash">
                    </form>
                </li>
            </ul>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

</div>




</section>
<?php require 'view/includes/undernav.php'?>

