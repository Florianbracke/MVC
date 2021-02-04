    <?php 
    require '../controller/closetManager.php';
    require '../controller/filterManager.php';
    require 'includes/header.php'?>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <section>

    <div class="topnav">
    <h3>Search outfit</h3> 
    <ul>
        <li><a href="upload.php"><i class="fas fa-file-upload"></i></a></li>
        <li><a href="outfit.php"><i class="fas fa-calendar-day"></i></a></li>
        <li><a href="favorites.php"><i class="fas fa-heart"></i></a></li>
    </ul>
    </div>

    <div class ="container">

    <form method="POST" name="search" >
        <div id="demo-grid">
        <div class="search-box">
            <select class="form-select form-select-sm" multiple id="type" name="type[]" >
                <option value="0" selected="selected">Select type of clothing</option>
                 <?php
                if (! empty($typeResult)) {
                    echo '<option value="everything">See everything</option>';
                    foreach ($typeResult as $key ) {
                        echo '<option value="' . $key['type'] . '">' . $key['type'] . '</option>';
                    }
                }
                ?>
            </select>
            <select class="form-select form-select-sm" multiple id="weather" name="weather[]" >
                <option value="0" selected="selected">Select which weather</option>
                 <?php
                if (! empty($weatherResult)) {
                    echo '<option value="everything">See everything</option>';
                    foreach ($weatherResult as $key ) {
                        echo '<option value="' . $key['weather'] . '">' . $key['weather'] . '</option>';
                    }
                }
                ?>
            </select>
            <select class="form-select form-select-sm" multiple id="colour" name="colour[]">
                <option value="0" selected="selected">Select colour</option>
                 <?php
                if (! empty($colourResult)) {
                    echo '<option value="everything">See everything</option>';
                    foreach ($colourResult as $key ) {
                        echo '<option value="' . $key['colour'] . '">' . $key['colour'] . '</option>';
                        
                    }
                }
                ?>
            </select>
            <select class="form-select form-select-sm" multiple id="ocassion" name="ocassion[]" >
                <option value="0" selected="selected">Select type of ocassion</option>
                 <?php
                if (! empty($ocassionResult)) {                        
                    echo '<option value="everything">See everything</option>';
                    foreach ($ocassionResult as $key ) {
                        echo '<option value="' . $key['ocassion'] . '">' . $key['ocassion'] . '</option>';
                        
                    }
                }
                ?>
            </select>
            <select class="form-select form-select-sm" multiple id="time" name="time[]" >
                <option value="0" selected="selected">Select time</option>
                 <?php
                if (! empty($timeResult)) {
                    echo '<option value="everything">See everything</option>';
                    foreach ($timeResult as $key ) {
                        echo '<option value="' . $key['time'] . '">' . $key['time'] . '</option>';
                    }
                }
                ?>
            </select>
            <button class="btn btn-secondary" id="Filter">Search</button>
        </div>
        </div>
    </form>     
    
    <div class="masonry">
        <?php if (! empty($result)) {
            foreach ($result as $item ) :?>
            <div class="masonry-item">
                <button class="accordion">
                    <img src="images/<?= $item['image']?>"> 
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
        
         <?php } ?>   
        
    </div>       
    </div>

    
    </section>
    <?php require 'includes/undernav.php'?>