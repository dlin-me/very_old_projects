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

// retrieve news list content
$news_content = $connection->query("SELECT * FROM news_e ORDER BY time DESC");

// detect retrival error
if (DB::isError($news_content) || DB::isError($current_news)){
      die($connection->getMessage( ));
}

// refine retrieved news listing contents
$counter=0;
while ($row = $news_content->fetchRow(DB_FETCHMODE_ASSOC)){
    $counter++;
	
    if($language!=null){
	    $news[$counter]=$row['title_c'];
	}else{
	    $news[$counter]= $row['title'];
	}
	
    $ids[$counter]=$row['ID'];
	
	if($currentID==null){
        $currentID=$row['ID'];
    }
	
	$news_list.="<li><a href='news.php?id=".$ids[$counter]."'>".$news[$counter]."</a>&nbsp;({$row['time']})</li>";
} 


// retrieve currentnews content
$current_news = $connection->query("SELECT * FROM news_e WHERE id=$currentID");

// refine current news contents
while ($row = $current_news->fetchRow(DB_FETCHMODE_ASSOC)){
    $news_image=$row['pic'];
	
	if($language!=null){
	    $news_content=$row['content_c'];
		$news_title = $row['title_c']."<br />(".$row['time'].")";
	}else{
	    $news_content=$row['content'];	
		$news_title = $row['title']."<br />(".$row['time'].")";
	}				
		
}

// create, populate and display template
$smarty = new Smarty_goldcoast;

if($language!=null){
    $smarty->assign('header', "header_c.tpl");
    $smarty->assign('footer', "footer_c.tpl");	
	$smarty->assign('title', "&#34892;&#19994;&#26032;&#38395;");
}else{
    $smarty->assign('header', "header.tpl");
    $smarty->assign('footer', "footer.tpl");	
	$smarty->assign('title', "GoldCoast News");	
}


$smarty->assign('news1', $news[1]);
$smarty->assign('news2', $news[2]);
$smarty->assign('news3', $news[3]);

$smarty->assign('news_title', $news_title);
$smarty->assign('news_image', $news_image);
$smarty->assign('news_content', $news_content);


$smarty->assign('latest1', $ids[1]);
$smarty->assign('latest2', $ids[2]);
$smarty->assign('latest3', $ids[3]);


$smarty->assign('newslist', $news_list);


$smarty->display('news.tpl');
?>