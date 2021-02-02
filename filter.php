<?php

// Require the correct variable type to be used (no auto-converting)
declare(strict_types = 1);

// Show errors so we get helpful information
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

try {
    $database = new PDO("mysql:host=localhost;port=3307;dbname=closet", 'root', 'root');
    // set the PDO error mode to exception
    $database->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    }

$items =  $database->query("SELECT * FROM closet");  
$typeResult = $database->query("SELECT DISTINCT type FROM closet ORDER BY type ASC");
$weatherResult = $database->query("SELECT DISTINCT weather FROM closet ORDER BY weather ASC");
$colourResult = $database->query("SELECT DISTINCT colour FROM closet ORDER BY colour ASC");
$ocassionResult = $database->query("SELECT DISTINCT ocassion FROM closet ORDER BY ocassion ASC");
$timeResult = $database->query("SELECT DISTINCT time FROM closet ORDER BY time ASC");


?>
<html>
<head>
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