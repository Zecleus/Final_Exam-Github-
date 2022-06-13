
<?php
require_once 'IDBFuncs.php';
require_once 'DBLibrary.php';

require_once 'init2.php';

use Sessions\Session;

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


}

else if(isset($_GET['food'])){
    $result = $db->select()->from('ConsumableSubType')->where('typeID', '1')->getAll();
    $jsonResult = json_encode($result);
    echo $jsonResult;

}

else if(isset($_GET['product'])){
    
    $product = $_GET['product'];

        if($product === "1"){
            $result = $db->select()->from('ConsumableProduct')->where('subtypeID', '1')->getAll();
        }
        else if($product === "2"){
            $result = $db->select()->from('ConsumableProduct')->where('subtypeID', '2')->getAll();
        }
        else if($product === "3"){
            $result = $db->select()->from('ConsumableProduct')->where('subtypeID', '3')->getAll();
        }
        else if($product === "4"){
            $result = $db->select()->from('ConsumableProduct')->where('subtypeID', '4')->getAll();
        }
        else if($product === "5"){
            $result = $db->select()->from('ConsumableProduct')->where('subtypeID', '5')->getAll();
        }
        else if($product === "6"){
            $result = $db->select()->from('ConsumableProduct')->where('subtypeID', '6')->getAll();
        }


    $jsonResult = json_encode($result);
    echo $jsonResult;

}


    
    

