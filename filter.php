    <?php 
    require 'closetManager.php';
    require 'filterManager.php';
    require 'view/includes/header.php'?>

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
            <select id="type" name="type[]" multiple="multiple">
                <option value="0" selected="selected">Select type of clothing</option>
                 <?php
                if (! empty($typeResult)) {
                    echo '<option value="all">All</option>';
                    foreach ($typeResult as $key ) {
                        echo '<option value="' . $key['type'] . '">' . $key['type'] . '</option>';
                    }
                }
                ?>
            </select>
            <select id="weather" name="weather[]" multiple="multiple">
                <option value="0" selected="selected">Select which weather</option>
                 <?php
                if (! empty($weatherResult)) {
                    echo '<option value="all">All</option>';
                    foreach ($weatherResult as $key ) {
                        echo '<option value="' . $key['weather'] . '">' . $key['weather'] . '</option>';
                    }
                }
                ?>
            </select>
            <select id="colour" name="colour[]" multiple="multiple">
                <option value="0" selected="selected">Select colour</option>
                 <?php
                if (! empty($colourResult)) {
                    echo '<option value="all">All</option>';
                    foreach ($colourResult as $key ) {
                        echo '<option value="' . $key['colour'] . '">' . $key['colour'] . '</option>';
                        
                    }
                }
                ?>
            </select>
            <select id="ocassion" name="ocassion[]" multiple="multiple">
                <option value="0" selected="selected">Select type of ocassion</option>
                 <?php
                if (! empty($ocassionResult)) {                        
                    echo '<option value="all">All</option>';
                    foreach ($ocassionResult as $key ) {
                        echo '<option value="' . $key['ocassion'] . '">' . $key['ocassion'] . '</option>';
                        
                    }
                }
                ?>
            </select>
            <select id="time" name="time[]" multiple="multiple">
                <option value="0" selected="selected">Select time</option>
                 <?php
                if (! empty($timeResult)) {
                    echo '<option value="all">All</option>';
                    foreach ($timeResult as $key ) {
                        echo '<option value="' . $key['time'] . '">' . $key['time'] . '</option>';
                    }
                }
                ?>
            </select>
            <button id="Filter">Search</button>
        </div>
    </form>
    
    <?php
    if (! empty($_POST['type']) ) {
        ?>
        
    <?php
        $query = "SELECT * from closet";
        $i = 0;
        $selectedOptionCount = count($_POST['type']+$_POST['weather']+$_POST['colour']+$_POST['ocassion']+$_POST['time']);
        $selectedTypeOption = "";
        $selectedWeatherOption = "";
        $selectedColourOption = "";
        $selectedOcassionOption = "";
        $selectedTimeOption = "";
        $selectedAllTypeOption="";
        $selectedAllWeatherption="";
        $selectedAllColourOption="";
        $selectedAllOcassionOption="";
        $selectedAllTimeOption="";


        while ($i < $selectedOptionCount) {

            if($_POST['type'][$i] === "all"){
                $selectedAllTypeOption = "not null";
            } else {
                $selectedTypeOption = $selectedTypeOption . "'" . $_POST['type'][$i] . "'";
            }
            if($_POST['weather'][$i] === "all"){
                $selectedAllWeatherOption = "not null";
            } else {
                $selectedWeatherOption = $selectedWeatherOption . "'" . $_POST['weather'][$i] . "'";
            }
            if($_POST['colour'][$i] === "all"){
                $selectedAllColourOption = "not null";
            } else {
                $selectedColourOption = $selectedColourOption . "'" . $_POST['colour'][$i] . "'";
            }
            if($_POST['ocassion'][$i] === "all"){
                $selectedAllOcassionOption = "not null";
            } else {
                $selectedOcassionOption = $selectedOcassionOption . "'" . $_POST['ocassion'][$i] . "'";
            }
            if($_POST['time'][$i] === "all"){
                $selectedAllTimeOption = "not null";
            } else {
                $selectedTimeOption = $selectedTimeOption . "'" . $_POST['time'][$i] . "'";
            }

            if ($i < $selectedOptionCount - 1) {
                $selectedTypeOption = $selectedTypeOption . ", ";
                $selectedWeatherOption = $selectedWeatherOption . ", ";
                $selectedColourOption = $selectedColourOption . ", ";
                $selectedOcassionOption = $selectedOcassionOption . ", ";
                $selectedTimeOption = $selectedTimeOption . ", ";

            }
            
            $i ++;
        }
      
        
        if (empty($selectedAllTypeOption)){
            $query = $query . " WHERE type in (" . $selectedTypeOption . ")";
        } else {
            $query = $query . " WHERE type is not null";
        }
        if (empty($selectedAllWeatherOption)){
            $query = $query . " AND weather in (" . $selectedWeatherOption . ")";
        } else {
            $query = $query . " AND weather is not null";
        }
        if (empty($selectedAllColourOption)){
            $query = $query . " AND colour in (" . $selectedColourOption . ")";
        } else {
            $query = $query . " AND colour is not null";
        }
        if (empty($selectedAllOcassionOption)){
            $query = $query . " AND ocassion in (" . $selectedOcassionOption . ")";
        } else {
            $query = $query . " AND ocassion is not null";
        }
        if (empty($selectedAllTimeOption)){
            $query = $query . " AND time in (" . $selectedTimeOption . ")";
        } else {
            $query = $query . " AND time is not null";
        }
            
        $result = $database->query($query);
    }?>

    <div class="masonry">
        <?php if (! empty($result)) {
            foreach ($result as $item ) {?>
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
                
    <?php }?>
    </div>
    
        
  
<?php
    }
    ?>  
        </div>
   

    </div>
    
    </section>
    <?php require 'view/includes/undernav.php'?>