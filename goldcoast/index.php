<?php

// load Smarty library
require('/home/w3cat/smarty_app/goldcoast/setup.php');

// load Pear DB library
require_once "DB.php";

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

// retrieve company description
$company = $connection->query("SELECT * FROM company_e");

// detect retrival error
if (DB::isError($news_content) || DB::isError($company)){
      die($connection->getMessage( ));
}	  

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

// refined retrieved company description
$content=$company->fetchRow(DB_FETCHMODE_ASSOC);
if($language!=null){
	$company = $content['company_c'];
	$product = $content['product_c'];
}else{
	$company = $content['company'];
	$product = $content['product'];
}


// create, populate and display template
$smarty = new Smarty_goldcoast;

$smarty->assign('content1',$company);
$smarty->assign('content2',$product);

$smarty->assign('news1', $news[1]);
$smarty->assign('news2', $news[2]);
$smarty->assign('news3', $news[3]);
$smarty->assign('latest1', $ids[1]);
$smarty->assign('latest2', $ids[2]);
$smarty->assign('latest3', $ids[3]);

if($language!=null){
    $smarty->assign('header', "header_c.tpl");
    $smarty->assign('footer', "footer_c.tpl");	
}else{
    $smarty->assign('header', "header.tpl");
    $smarty->assign('footer', "footer.tpl");		
}

$smarty->display('index.tpl');

?>