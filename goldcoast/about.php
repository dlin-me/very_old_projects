<?php

// load Smarty library
require('/home/w3cat/smarty_app/goldcoast/setup.php');

// load Pear DB library
require_once "DB.php";

// ID variable from request
$currentID=$_GET['id'];

//determin language
$language=$_GET['lan'];

//Chinese Contact;
$about_c="&#26412;&#32593;&#31449;&#30001; <a href='mailto:weihaolin@hotmail.com'> David Lin </a> &#26500;&#24314;&#21644;&#32500;&#25252;";
//Englsih Contact;
$about_e="This site is created and maintained by <br /><a href='mailto:weihaolin@hotmail.com'>David Lin</a>";

// database url
$dsn = "mysql://w3cat_absri:absri@localhost/w3cat_goldcoast";

// Open a connection to the DBMS
$connection = DB::connect($dsn);


if (DB::isError($connection))
      die($connection->getMessage( ));

$result = $connection->query("SELECT * FROM news_e ORDER BY time DESC");

if (DB::isError($result))
      die($connection->getMessage( ));


$counter=0;
while ($row = $result->fetchRow(DB_FETCHMODE_ASSOC)){
    $counter++;
    $news[$counter]= $row['title'];
    $ids[$counter]=$row['ID'];
	if($currentID==null){
        $currentID=$row['ID'];
    }
    $news_list.="<li><a href='news.php?id=".$row['ID']."'>".$news[$counter]."</a>&nbsp;({$row['time']})</li>";

} 


$current_news = $connection->query("SELECT * FROM news_e WHERE id=$currentID");
while ($row = $current_news->fetchRow(DB_FETCHMODE_ASSOC)){
    $news_image=$row['pic'];
	$news_content=$row['content'];
	$news_title = $row['title']."<br />(".$row['time'].")";
}



// create, populate and display template
$smarty = new Smarty_goldcoast;


$smarty->assign('news1', $news[1]);
$smarty->assign('news2', $news[2]);
$smarty->assign('news3', $news[3]);

$smarty->assign('latest1', $ids[1]);
$smarty->assign('latest2', $ids[2]);
$smarty->assign('latest3', $ids[3]);



if($language!=null){
    $smarty->assign('header', "header_c.tpl");
    $smarty->assign('footer', "footer_c.tpl");	
	$smarty->assign('linkid',$currentID."&lan='c'" );
	$smarty->assign('title', "&#20851;&#20110;&#26412;&#32593;&#31449;");
	$smarty->assign('about', $about_c);	
}else{
    $smarty->assign('header', "header.tpl");
    $smarty->assign('footer', "footer.tpl");	
	$smarty->assign('linkid',$currentID);
	$smarty->assign('title', "About this website");
	$smarty->assign('about', $about_e);	
}




$smarty->display('about.tpl');
?>