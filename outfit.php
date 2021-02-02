<?php 
require 'closetManager.php';
require 'view/includes/header.php'?>

<link rel="stylesheet" href="style.css">


<section>
    <h4>Outfit page</h4>

    <p><a href="index.php">Back to homepage</a></p>
    <p><a href="closet.php">Back to closet</a></p>

 </section>

 <form method="post">
    <input type="submit" name="clear_outfit" value="Clear Outfit">
</form>

<?=$alert?> 
 <div class="grid-container"> 
        <?php 
            foreach ($_SESSION['outfit'] as $item) :?>
                <div class="grid-item"> 
                <p> <?= $item['item_type']?> </p>
                    <img src=images/<?= $item['item_image'] ?>>
                    <form method="post">
                        <input type="hidden" name="item_id" value="<?=$item['item_id'] ?>">
                        <input type="submit" name="delete_item" value="DON'T WEAR">
                    </form>
                </div> 
            <?php endforeach; ?>
</div>

<?php require 'view/includes/footer.php'?>