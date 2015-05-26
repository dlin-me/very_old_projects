<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>	
<?php 
	echo TRADING_NAME;
	if(is_array(Page::$data['title']) && count(Page::$data['title']) > 0){
		foreach(Page::$data['title'] as $nev_url=>$nev_txt){
			echo '&nbsp;&gt;&nbsp;'.$nev_txt;
		}
	}
?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="description" content="<?php echo Page::$data['meta_description']; ?>">
<meta name="keywords" content="<?php echo Page::$data['meta_keyword']; ?>">
<link href="<?php echo CSS_DIR; ?>/tags.css" rel="stylesheet" type="text/css" />
<link href="<?php echo CSS_DIR; ?>/layout.css" rel="stylesheet" type="text/css" />
<link href="<?php echo CSS_DIR; ?>/components.css" rel="stylesheet" type="text/css" />
</head>
<body onload="this.focus();" >
<div id="Page">
<div id="Header">
	<div class="Logo">
        <a href="/"><img src="<?php echo IMG_DIR; ?>/page_logo.gif" align="texttop" alt="UniMarket.com.au - free marketplace "></a>
        <span class="StateTag"><?php echo Env::getSite(); ?></span>
    </div>
	<div class="LinksRow">
		<ul>
			<li><a href="http://www.unimarket.com.au/itype/help/information_list.hts">Online Help</a></li>
			<li><a href="/account/reg.html">Register/Create an Account</a></li>
			<li><a href="/account/signin.html">Sign in</a></li>
			<li><a href="http://www.unimarket.com.au/cart.hts">Post Listing</a></li>
		</ul>
	</div>
	<div class="MainMnu">
		<ul>
		 	<li><a class="<?php if(Page::$data['tag'] == 'home'){ ?>mnuItem_active<?php }else{?>mnuItem<?php } ?>" href="<?php echo WEB_DIR; ?>/"><span class="munItemLink">Home</span></a></li>

			<li><a class="<?php if(Page::$data['tag'] == 'browse'){ ?>mnuItem_active<?php }else{?>mnuItem<?php } ?>" href="<?php echo WEB_DIR; ?>/all-categories_cid0.html"><span class="munItemLink">Browse</span></a></li>
			<li><a class="<?php if(Page::$data['tag'] == 'post'){ ?>mnuItem_active<?php }else{?>mnuItem<?php } ?>" href="<?php echo WEB_DIR; ?>/post.html"><span class="munItemLink">Post</span></a></li>
			<li><a class="<?php if(Page::$data['tag'] == 'account'){ ?>mnuItem_active<?php }else{?>mnuItem<?php } ?>" href="<?php echo WEB_DIR; ?>/search.html"><span class="munItemLink">Search</span></a></li>

			<li><a class="<?php if(Page::$data['tag'] == 'else'){ ?>mnuItem_active<?php }else{?>mnuItem<?php } ?>" href="<?php echo WEB_DIR; ?>/account/"><span class="munItemLink">Account</span></a></li>

		</ul>

		<div class="Slogan" id="Slogan">
            Hello
            <?php  echo '<strong>'.Control::ctrlMemberName().'</strong>'; ?>!
    		 (
    		 <?php if(Auth::isMember()){ ?>
             <a href="<?php echo WEB_DIR; ?>/action.php?action=signout">Sign out</a>
             <?php }else{ ?>
                    <a href="<?php echo WEB_DIR; ?>/account/signin.html">Sign in</a> or <a href="/account/reg.html">Register</a>   )
             <?php } ?>
        </div>
		<div class="Location">
			<form style="padding:0px; margin:0px;" action="<?php echo WEB_DIR; ?>/action.php" method="get">
				Current Site:
				<?php
                    $a = array();
                    $a['name'] = 'site';
                    $a['class'] = 'State';
                    $a['script'] = 'onchange=\'this.form.submit();\'';
                    $a['options'] = array_combine(Env::sites(), Env::sites());
                    $a['value'] = Env::getSite();
                    echo Control::htmlSelect($a);
				?>

				<input class="input" type="hidden" name="_a" value="set_site"/>
				<noscript>
				<input class="input" type="submit" value="change" />
				</noscript>
			</form>
		</div>

	</div>
	<div class="SubMnu">
		<div class="QuickLink" > <a href="#">All Categories</a> <img src="/images/layout/icon_arrow_down.gif" align="absmiddle" height="20" /> <img src="/images/layout/icon_bar.gif" align="absmiddle" height="20" style="margin:0px 5px 0px 5px" /> <a href="#">Security Center</a> </div>
		<div class="Search">
			<input class="input" size="40" type="text" />
 
			<input class="Button"  type="image" src="/images/layout/btn_search.gif" value="Search" />
            <a href="#" >Advanced Search</a>
		</div>
		<div class="Clear" style="clear:both; float:none; "></div>
	</div>
	<div id="Navigation">
		<a href="<?php echo WEB_DIR; ?>/">Home</a>
		<?php 
 
			if(count(Page::$data['nevigation']) > 0){
					foreach(Page::$data['nevigation'] as $nev_url=>$nev_txt){
						echo '<span style="color: rgb(0, 0, 0);">&nbsp;&gt;&nbsp;</span>';
						echo  '<a href="'.$nev_url.'">'.$nev_txt.'</a>';
					}
			}
		?>
	</div>
</div>
<?php
if(Page::getTempData('ERR') != ''){
?>
<div id="PageErr"> <img align="absmiddle" src="/images/layout/icon_warning.gif" /> page error goes here </div>
<?php
}
?>

<!-- End Of Header -->