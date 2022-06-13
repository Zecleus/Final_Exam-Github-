

<?php
require_once 'IDBFuncs.php';
require_once 'DBLibrary.php';

try {
    $dbSource = new PDO('mysql:host=localhost;dbname=webstrbks','root','');
} catch(PDOException $e) {
    echo $e->getMessage();
}

$db = new DBLibrary($dbSource);

if(isset($_GET['beverage'])){
    $result = $db->select()->from('ConsumableSubType')->where('typeID', '2')->getAll();
    $jsonResult = json_encode($result);
    echo $jsonResult;

    $_GET['beverage'] = false;
}

else if(isset($_GET['food'])){
    $result = $db->select()->from('ConsumableSubType')->where('typeID', '1')->getAll();
    $jsonResult = json_encode($result);
    echo $jsonResult;

    $_GET['food'] = false;
}