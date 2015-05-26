	<?php
	//get the latest listings
	$listTbl = Listing::getTbl();
	$criteria = array();
	if(Request::cat() > 0){
	 	$criteria['cat_id'] = Request::cat();
	}
	$criteria[$listTbl->tblRecycledCol] = 0;
	$criteria['listing_expiry'] = '> '.time();
	$rows = $listTbl->getRows($criteria, array('listing_created'=>'DESC'), 0 , 5);
	$ids = RowSet::add('Listing', $rows);
	?>
	<div class="Panel">
			<div class="Header">New Listings</div>
			<div class="Content">
					<?php
    					$counter = 0;
    					$loopNum = count($ids);
						foreach ($ids as $id){
    						$counter++;
							$liObj = RowSet::get('Listing', $id);
					?>
					<p style="padding-bottom: 3px; margin:0px;">
						<a href="<?php echo $liObj->getUrl() ?>">
							<img src="<?php echo $liObj->getThumbUrl();?>" alt="" align="absmiddle" width="60" height="60">
						</a>
					<?php
                        if($liObj->listing_price > 0 ){

						echo '<span style="font-weight:bold; color:#d4012a; ">'.Format::strMoney($liObj->listing_price).'</span>';

                        }
                    ?>
					</p>
					<p style="padding-bottom: 3px; margin:0px;">
                    <a class="Title" href="<?php echo $liObj->getUrl(); ?>"><?php echo Format::strTruncate($liObj->listing_title, 30); ?></a></p>
                    <?php if($counter < $loopNum){ ?>
					<div class="Divide"></div>
					<?php
					}
					}//end of foreach
					?>
			</div>
			<div class="Bottom"><img src="/images/layout/panel_bottom_left.jpg" alt=""><img src="/images/layout/panel_bottom_right.jpg" alt=""></div>
	 </div>