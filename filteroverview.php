<!doctype html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="style.css" type="text/css" rel="stylesheet" />
<title>Digital closet</title>
</head>
<body>
    <h2>Search your outfit</h2>
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
            
    <?php
    if (! empty($_POST['type'])) {
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
        while ($i < $selectedOptionCount) {
            $selectedTypeOption = $selectedTypeOption . "'" . $_POST['type'][$i] . "'";
            $selectedWeatherOption = $selectedWeatherOption . "'" . $_POST['weather'][$i] . "'";
            $selectedColourOption = $selectedColourOption . "'" . $_POST['colour'][$i] . "'";
            $selectedOcassionOption = $selectedOcassionOption . "'" . $_POST['ocassion'][$i] . "'";
            $selectedTimeOption = $selectedTimeOption . "'" . $_POST['time'][$i] . "'";

            if ($i < $selectedOptionCount - 1) {
                $selectedTypeOption = $selectedTypeOption . ", ";
                $selectedWeatherOption = $selectedWeatherOption . ", ";
                $selectedColourOption = $selectedColourOption . ", ";
                $selectedOcassionOption = $selectedOcassionOption . ", ";
                $selectedTimeOption = $selectedTimeOption . ", ";

            }
            
            $i ++;
        }

        $query = $query . " WHERE type in (" . $selectedTypeOption . ") AND weather in (". $selectedWeatherOption. ") AND colour in (". $selectedColourOption. ") AND ocassion in (". $selectedOcassionOption. ") AND time in (". $selectedTimeOption. ")";
        $result = $database->query($query);
    }
    if (! empty($result)) {
        foreach ($result as $key ) {
            ?>
    
            <ul>
            <li><img src="images/<?= $key['image']?>" style="height:200px;"> <br>
            <?php echo $key['type']; ?> - <?php echo $key['weather']; ?> - <?php echo $key['colour']; ?> - <?php echo $key['ocassion']; ?> - <?php echo $key['time']; ?>
            </li>
            </ul>
    <?php
        }
        ?>
        
  
<?php
    }
    ?>  
        </div>
    </form>
    
</body>
</html>