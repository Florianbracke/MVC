<?php

// Require the correct variable type to be used (no auto-converting)
declare(strict_types = 1);

// Show errors so we get helpful information
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

try {
    $database = new PDO("mysql:host=localhost;dbname=my_digital_closet", 'root', 'root');
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


if (! empty($_POST['type']) ) {

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

        if($_POST['type'][$i] === "everything"){
            $selectedAllTypeOption = "not null";
        } else {
            $selectedTypeOption = $selectedTypeOption . "'" . $_POST['type'][$i] . "'";
        }
        if($_POST['weather'][$i] === "everything"){
            $selectedAllWeatherOption = "not null";
        } else {
            $selectedWeatherOption = $selectedWeatherOption . "'" . $_POST['weather'][$i] . "'";
        }
        if($_POST['colour'][$i] === "everything"){
            $selectedAllColourOption = "not null";
        } else {
            $selectedColourOption = $selectedColourOption . "'" . $_POST['colour'][$i] . "'";
        }
        if($_POST['ocassion'][$i] === "everything"){
            $selectedAllOcassionOption = "not null";
        } else {
            $selectedOcassionOption = $selectedOcassionOption . "'" . $_POST['ocassion'][$i] . "'";
        }
        if($_POST['time'][$i] === "everything"){
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
}


