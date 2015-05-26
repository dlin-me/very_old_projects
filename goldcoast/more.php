<?php

// load Smarty library
require('/home/w3cat/smarty_app/goldcoast/setup.php');

// load Pear DB library
require_once "DB.php";

// ID variable from request
$currentID=$_GET['id'];

//determin language
$language=$_GET['lan'];

// database url
$dsn = "mysql://w3cat_absri:absri@localhost/w3cat_goldcoast";

// Open a connection to the DBMS
$connection = DB::connect($dsn);


if (DB::isError($connection))
      die($connection->getMessage( ));

$result = $connection->query("SELECT * FROM products_e");

if (DB::isError($result))
      die($connection->getMessage());


$counter=0;
while ($row = $result->fetchRow(DB_FETCHMODE_ASSOC)){
    $id= $row['ID'];
	$products['pic2'][$id]=$row['pic2'];	
	
	if($language!=null){
	    $products['name'][$id]= $row['name_c'];
		$products['action'][$id]=$row['action_c'];
	
		$products['information'][$id]=$row['information_c'];
	}else{
	    $products['name'][$id]= $row['name'];
		$products['action'][$id]=$row['action'];
		$products['information'][$id]=$row['information'];
	}		

	
	if($currentID==null){
        $currentID=$id;
    }

} 

// create, populate and display template
$smarty = new Smarty_goldcoast;


$smarty->assign('product_name', $products['name'][$currentID]);
$smarty->assign('product_action', $products['action'][$currentID]);
$smarty->assign('product_information', $products['information'][$currentID]);
$smarty->assign('product_pic2', $products['pic2'][$currentID]);

$smarty->display('more.tpl');




?>