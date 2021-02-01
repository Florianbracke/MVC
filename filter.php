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




?>
<html>
<head>
<link href="style.css" type="text/css" rel="stylesheet" />
<title>Multiselect Dropdown Filter</title>
</head>
<body>
    <h2>Multiselect Dropdown Filter</h2>
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
            <button id="Filter">Search</button>
        </div>
            
    <?php
    if (! empty($_POST['type'])) {
        ?>
        <table cellpadding="10" cellspacing="1">

    <thead>
        <tr>
            <th><strong>Image</strong></th>
            <th><strong>Type</strong></th>
            <th><strong>Weather</strong></th>
            <th><strong>Colour</strong></th>
            <th><strong>Ocassion</strong></th>
            <th><strong>Time</strong></th>
        </tr>
    </thead>
    <tbody>
    <?php
        $query = "SELECT * from closet";
        $i = 0;
        $selectedOptionCount = count($_POST['type']);
        $selectedOption = "";
        while ($i < $selectedOptionCount) {
            $selectedOption = $selectedOption . "'" . $_POST['type'][$i] . "'";
            if ($i < $selectedOptionCount - 1) {
                $selectedOption = $selectedOption . ", ";
            }
            
            $i ++;
        }
        $query = $query . " WHERE type in (" . $selectedOption . ")";
        
        $result = $database->query($query);
    }
    if (! empty($result)) {
        foreach ($result as $key ) {
            ?>
    <tr>
            <td><div class="col" id="user_data_1"><img src="images/<?= $key['image']?>" style="height:200px;"></div></td>
            <td><div class="col" id="user_data_1"><?php echo $key['type']; ?></div></td>
            <td><div class="col" id="user_data_2"><?php echo $key['weather']; ?> </div></td>
            <td><div class="col" id="user_data_3"><?php echo $key['colour']; ?> </div></td>
            <td><div class="col" id="user_data_3"><?php echo $key['ocassion']; ?> </div></td>
            <td><div class="col" id="user_data_3"><?php echo $key['time']; ?> </div></td>
        </tr>
    <?php
        }
        ?>
        
    </tbody>
</table>
<?php
    }
    ?>  
        </div>
    </form>
</body>
</html>