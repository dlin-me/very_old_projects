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

// detect connection error
if (DB::isError($connection))
      die($connection->getMessage( ));
	
// retrieve news content	  
$news_content = $connection->query("SELECT * FROM news_e ORDER BY time DESC");

// retrieve product content	  
$product = $connection->query("SELECT * FROM products_e");

// detect retrival error
if (DB::isError($news_content) || DB::isError($product))
      die($connection->getMessage( ));

// refine retrieved news contents
$counter=0;
while ($row = $news_content->fetchRow(DB_FETCHMODE_ASSOC)){
    $counter++;
	
    if($language!=null){
	    $news[$counter]=$row['title_c'];
	}else{
	    $news[$counter]=$row['title'];
	}
	
    $ids[$counter]=$row['ID'];
	
	if($currentID==null){
        $currentID=$row['ID'];
    }		    
    
} 


// refine retrieved product contents
$counter=0;
$products_list="<ul>";
while ($row = $product->fetchRow(DB_FETCHMODE_ASSOC)){
    $id= $row['ID'];
	
    if($language!=null){
	    $products['name'][$id]= $row['name_c'];
		$products['description'][$id]=$row['description_c'];
		$products['document'][$id]=$row['document_c'];
		$products['nutrition'][$id]=$row['nutrition_c'];
		$lan="lan=c&";
	}else{
	    $products['name'][$id]= $row['name'];
		$products['description'][$id]=$row['description'];
		$products['document'][$id]=$row['document'];
		$products['nutrition'][$id]=$row['nutrition'];
		$lan="";
	}	
	
	$products['pic1'][$id]=$row['pic1'];
	$products['pic2'][$id]=$row['pic2'];
	
	if($currentID==null){
        $currentID=$id;
    }
    $products_list.="<li><a href='products.php?".$lan."id=".$id."'>".$products['name'][$id]."</a></li>";

} 
$products_list.="</ul>";


// create, populate and display template
$smarty = new Smarty_goldcoast;

if($language!=null){
    $smarty->assign('header', "header_c.tpl");
    $smarty->assign('footer', "footer_c.tpl");	
	$smarty->assign('title', "&#20135;&#21697;&#20171;&#32461;");
	$smarty->assign('linkid',$currentID."&lan='c'" );
}else{
    $smarty->assign('header', "header.tpl");
    $smarty->assign('footer', "footer.tpl");	
	$smarty->assign('title', "GoldCoast News");	
	$smarty->assign('linkid',$currentID);
}

$smarty->assign('flashFile', 'product');

$smarty->assign('news1', $news[1]);
$smarty->assign('news2', $news[2]);
$smarty->assign('news3', $news[3]);
$smarty->assign('latest1', $ids[1]);
$smarty->assign('latest2', $ids[2]);
$smarty->assign('latest3', $ids[3]);



$smarty->assign('product_name', $products['name'][$currentID]);
$smarty->assign('product_description', $products['description'][$currentID]);
$smarty->assign('product_document', $products['document'][$currentID]);
$smarty->assign('product_nutrition', $products['nutrition'][$currentID]);

$smarty->assign('product_pic1', $products['pic1'][$currentID]);
$smarty->assign('product_pic2', $products['pic2'][$currentID]);

$smarty->assign('products_list', $products_list);

$smarty->display('products.tpl');


?>