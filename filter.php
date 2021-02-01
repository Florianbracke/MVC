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