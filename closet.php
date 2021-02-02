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
                <p> <?= ucfirst($item['type']) ?> </p>
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
                <form method="post">
                    <input type="hidden" name="edit_type" value="<?= $item['type'] ?>">
                    <input type="hidden" name="edit_weather" value="<?=$item['weather'] ?>">
                    <input type="hidden" name="edit_ocassion" value="<?=$item['ocassion'] ?>">
                    <input type="hidden" name="edit_colour" value="<?=$item['colour'] ?>">
                    <input type="hidden" name="edit_time" value="<?=$item['time'] ?>">
                    <!-- <input type="submit" name="edit_item" value="EDIT"> -->
                </form>
                <button href="?edit=<?=$item['id']?>" class="edit-item"> EDIT </button>
                <form action="?delete=<?=$item['id']?>" method="post">
                    <input type="submit" name="delete_item" value="DELETE">
                </form>
            </div>
        </div>
        <?php endforeach; ?>
</div>


<div id="myModal" class="modal">

  <div class="modal-content">
    <span class="close">&times;</span>
    <p>Some text in the Modal..</p>
  </div>

</div>

</section>
<script src="script.js"></script>
<?php require 'view/includes/footer.php'?>

