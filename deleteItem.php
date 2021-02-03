<?php 
require 'closetManager.php';
require 'view/includes/header.php'?>


<section>
    <h4>Closet page</h4>

    <p><a href="index.php">Back to homepage</a></p>
    <p><a href="closet.php">Go to selected outfit of today</a></p>

 <?=$alert?>
<div class="grid-container"> 
        <?php foreach ($items as $item) : ?>
                <p> 
                <ul>
                <img src=images/<?= $item['image'] ?>>
                <li> Type of Item: <?= ucfirst($item['type']) ?> </li>  
                <li> Weather Type: <?= ucfirst($item['weather']) ?> </li>  
                <li> Occasion: <?= ucfirst($item['ocassion']) ?> </li>  
                <li> Colour: <?= ucfirst($item['colour']) ?> </li>  
                <li> Time of Day: <?= ucfirst($item['time']) ?> </li>  
                <li> <form method="post">
                    <input type="submit" name="delete_confirm" value="DELETE ITEM">
                </form>
            </li>
            <li> <form action="closet.php" method="post">
                    <input type="submit" value="Cancel">
                </form>
            </li>
                </ul>    
            </p>
        <?php endforeach; ?>
</div>

</section>
<script src="script.js"></script>
<?php require 'view/includes/footer.php'?>

