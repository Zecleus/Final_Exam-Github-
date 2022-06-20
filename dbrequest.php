
<?php
require_once 'IDBFuncs.php';
require_once 'DBLibrary.php';

require_once 'init2.php';

use Sessions\Session;

$customerOrderList = new OrderList;


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

if(isset($_GET['food'])){
    $result = $db->select()->from('ConsumableSubType')->where('typeID', '1')->getAll();
    $jsonResult = json_encode($result);
    echo $jsonResult;

}

if(isset($_GET['product'])){
    
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

if(isset($_GET['getProductRow'])){
    $productID = $_GET['getProductRow'];
    $result = $db->select()->from('ConsumableProduct')->where('productID', $productID)->get();
    $jsonResult = json_encode($result);
    echo $jsonResult;
}   



$data = json_decode(file_get_contents("php://input"), true);

if(isset($data['order'])){
    
    $subtypeID = $data['subtypeID'];

    if($subtypeID === "1"){
        $data['drinkSize'] = null;
        $data['drinkType']= null;
        $data['cakeWarmed']= null;
        $customerOrderList->addOrderWrap($data['productName'], $data['itemPrice'], $data['sirachaQty'], $data['qty']);
    }
    else if($subtypeID === "2"){
        $data['drinkSize'] = null;
        $data['drinkType']= null;
        $data['cakeWarmed']= null;
        $data['sirachaQty'] = null;
        $customerOrderList->addOatmeal($data['productName'], $data['itemPrice'], $data['qty']);
    }
    else if($subtypeID === "3"){
        $data['drinkSize'] = null;
        $data['drinkType']= null;
        $data['sirachaQty'] = null;

       

        $customerOrderList->addCake($data['productName'], $data['itemPrice'], $data['cakeWarmed'], $data['qty']);

        if( $data['cakeWarmed'] === "1"){
            $data['cakeWarmed'] = "Yes";
        }
        else if ( $data['cakeWarmed'] === "2"){
            $data['cakeWarmed'] = "No";
        }
        
    }
    else if($subtypeID === "4"){
        
        $customerOrderList->addCoffee($data['productName'], $data['itemPrice'], $data['drinkSize'],  $data['drinkType'], $data['qty']);

        if($data['drinkSize'] === "1"){
            $data['drinkSize'] = "Tall";
        }
        else if($data['drinkSize'] === "2"){
            $data['drinkSize'] = "Grande";
        }
        else if($data['drinkSize'] === "3"){
            $data['drinkSize'] = "Venti";
        }

        $data['sirachaQty'] = null;
        $data['cakeWarmed'] = null;
        
    }
    else if($subtypeID === "5"){

        $customerOrderList->addTea($data['productName'], $data['itemPrice'], $data['drinkSize'],  $data['drinkType'], $data['qty']);

        if($data['drinkSize'] == "1"){
            $data['drinkSize'] = "Tall";
        }
        else if($data['drinkSize'] == "2"){
            $data['drinkSize'] = "Grande";
        }
        else if($data['drinkSize'] == "3"){
            $data['drinkSize'] = "Venti";
        }

        $data['sirachaQty'] = null;
        $data['cakeWarmed'] = null;

    }
    else if($subtypeID === "6"){

        $customerOrderList->addFrappuccino($data['productName'], $data['itemPrice'], $data['drinkSize'], $data['qty']);

        if($data['drinkSize'] == "1"){
            $data['drinkSize'] = "Tall";
        }
        else if($data['drinkSize'] == "2"){
            $data['drinkSize'] = "Grande";
        }
        else if($data['drinkSize'] == "3"){
            $data['drinkSize'] = "Venti";
        }

        $data['sirachaQty'] = null;
        $data['cakeWarmed'] = null;
        $data['drinkType']= null;
    }

    $noOfItemsInReceipt = count($_SESSION['orderList']);

    $totalPrice = $_SESSION['orderList'][$noOfItemsInReceipt-1]->getTotalPrice();

    $result = $db->table('orders')->insert([$noOfItemsInReceipt, $data['productName'], $data['itemPrice'], $data['qty'], $data['sirachaQty'], $data['drinkType'], $data['drinkSize'], $data['cakeWarmed'], $totalPrice]);
    
}

if(isset($_GET['order'])){
    $result = $db->select()->from('orders')->getAll();
   
    $jsonResult = json_encode($result);
    echo $jsonResult;
}

if(isset($data['delete'])){

//     // $sessionDelete = $data['toBeCanceled']-1;

//     // Session::removeSpecificElement('orderList', $sessionDelete);
    //Session['orderList'] kay history of all orders canceled or not
    $result = $db->table('Orders')->where('orderID', $data['toBeCanceled'])->delete();
    $result = $db->select()->from('orders')->getAll();
    
    $jsonResult = json_encode($result);
    echo $jsonResult;

}

//ang DBLibrary di mugana ug isud ug loop
//bug ni kay kailangan pajud idrop ang orders table para ma fully reset. If maka find mo fix, palihog lang ayo
if(isset($_GET['reset'])){
    Session::stop();

    $result = $db->select()->from('orders')->getAll();
    
    // foreach($result as $x){
    //     $deleteResult = $db->table('orders')->where('orderID', $x[0])->delete();
    // }

    // for($i = 0; $i < count($result); $i++){
    //     $deleteResult = $db->table('orders')->where('orderID', $result[$i][0])->delete();
    // }
    $deleteResult = $db->table('orders')->delete();

    $jsonResult = json_encode($deleteResult);
    echo $db->showQuery();
}
    
    

