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
$contact_c="<p>
				&#30005;&#35805;: +61 3 9866 6188<br /> 
				&#20256;&#30495;: +61 3 9866 6199<br /> 
				&#21271;&#20140;&#30005;&#35805;: +86 10 6415 8076 - 15<br /> 
				&#30005;&#37038;: info@ausgoldcoast.com <br />
			</p>";
//Englsih Contact;
$contact_e="<p>
				PHONE: +61 3 9866 6188<br /> 
				FACSIMILE: +61 3 9866 6199<br /> 
				PHONE ( BEIJING ): +86 10 6415 8076 - 15<br /> 
				EMAIL: info@ausgoldcoast.com <br />
			</p>";

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
	$smarty->assign('title', "&#32852;&#31995;&#25105;&#20204;");
	$smarty->assign('contact', $contact_c);	
}else{
    $smarty->assign('header', "header.tpl");
    $smarty->assign('footer', "footer.tpl");	
	$smarty->assign('linkid',$currentID);
	$smarty->assign('title', "GoldCoast Contacts");
	$smarty->assign('contact', $contact_e);	
}




$smarty->display('contacts.tpl');
?>