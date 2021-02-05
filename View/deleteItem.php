<?php 
require '../controller/closetManager.php';
require 'includes/header.php'?>


<section>

<div class="topnav">
  <h3>Delete Item</h3> 
  <ul>
  <li><a href="logout.php"><i class="fas fa-sign-out-alt"></i></a></li>
    <li><a href="upload.php"><i class="fas fa-file-upload"></i></a></li>
    <li><a href="outfit.php"><i class="fas fa-calendar-day"></i></a></li>
    <li><a href="favorites.php"><i class="fas fa-heart"></i></a></li>
  </ul>
</div>

 <?=$alert?>
<div class="container"> 
    <?php foreach ($items as $item) : ?>
            <ul class="delete-list">
                <img src=images/<?= $item['image'] ?>>
                <li> <?= ucfirst($item['type']) ?> | </li>  
                <li> <?= ucfirst($item['weather']) ?> weather | </li>  
                <li> <?= ucfirst($item['ocassion']) ?> | </li>  
                <li> <?= ucfirst($item['colour']) ?> | </li>  
                <li> <?= ucfirst($item['time']) ?> </li>  
            </ul>  
            <div class="form-delete">
                <form method="post">
                    <input type="submit" name="delete_confirm" value="Confirm Delete" class="button-closet editPageButton">
                </form>
                <form action="closet.php" method="post">
                <input type="submit" value="Cancel" class="button-closet editPageButton">
                </form>
            </div>  
    <?php endforeach; ?>
</div>

</section>
<script src="script.js"></script>
<?php require 'includes/undernav.php'?>

