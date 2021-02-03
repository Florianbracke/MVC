<?php

// Require the correct variable type to be used (no auto-converting)
declare(strict_types = 1);

// Show errors so we get helpful information
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

try {
    $database = new PDO("mysql:host=localhost;dbname=closet", 'root', 'root');
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





require "filteroverview.php";