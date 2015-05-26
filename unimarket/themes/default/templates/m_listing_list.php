<?php	
	$catObj = RowSet::get('Cat',Request::cat());
?>	
		<div class="Panel" id="m_listing_list">
		  <img src="<?php echo IMG_DIR; ?>/layout/bg_m_top.jpg" alt="" />
		  <div class="CatHeader">
		  	<?php if($catObj->cat_name){echo $catObj->cat_name;}else{echo 'All Categories';} ?>
		  </div>
		  <div class="Extra"> 			
					 [ <a href="">Post a listing in this category</a> ] &nbsp;<a href=""><img src="<?php echo IMG_DIR; ?>/layout/icon_rss2.png"  align="absmiddle" /></a>						
		  </div>
		  <!--
		  <div class="ClearDivide"></div>
		  <div id="CatRSS">
		  		<a href=""><img src="/images/layout/add_google.gif"  align="absmiddle" /></a>				
				<a href=""><img src="/images/layout/add_yahoo.gif"  align="absmiddle" /></a>
				<a href=""><img src="/images/layout/add_live.gif"  align="absmiddle" /></a>
				<a href=""><img src="/images/layout/add_msn.gif"  align="absmiddle" /></a>	
				
		  </div>
		  -->
		  <div class="Divide" ></div>
		  <div class="Search">
		  <div style="float:left; ">
		  <form  method="get" action="/search.html"  >
			<input class="input" id="keyword" name="kw" type="text" name="keyword" />
			<?php  echo Control::ctrlCatSelector(array('name'=>'hello', 'value'=>$catObj->getId(), 'style'=>'position:relative; top:-1px;')); ?>
			<input  type="submit"  value="Search" width="100" height="26" style="vertical-align:middle; " />
			 <br />
			<strong>Recent Search:</strong> &nbsp;&nbsp;<a href="">cat</a>&nbsp;&nbsp;<a href="">dog</a>&nbsp;&nbsp;<a href="">pig</a>
		  </form>
		   
		  </div>
		  <div class="TopPager" >
		  <?php
		  	$listingTable = Listing::getTbl();
			$criteria = array();
			if(Request::cat() > 0){
				$criteria['cat_id'] = Request::cat();
			}
			$order = array();
			$processObj = new Process('m_listing_list');
			if(isset($processObj->order)){
				$order = $processObj->order;
			}
			$pagePointer = Request::page();
			
			$pageSize = 30;
			if($processObj->pageSize>0){
				$pageSize = $processObj->pageSize;
			}else{
				$processObj->pageSize = $pageSize;
			}
			
		  	$info = $listingTable->getExpRowsSubsetInfo($criteria, $order, $pagePointer, $pageSize );
		  ?>
		  <strong> Showing <?php echo $info['info']['itemStart']; ?> - <?php echo $info['info']['itemEnd']; ?> of <?php echo $info['info']['itemTotal']; ?> listings with</strong><br />
		  <form action="/action.php" method="post" >
		  	<input type="hidden" name="action" value="listing_set_perpage" />
		  <?php 
		  	$options = array(
							'20'=>'20 listings per page',
							'30'=>'30 listings per page',
							'50'=>'50 listings per page'							
							);
		  	echo Control::htmlSelect(array('options'=>$options,'style'=>'border:1px dotted #cccccc', 'script'=>'onChange="this.form.submit();"', 'value'=>$processObj->pageSize));
		  ?>
		  </form>
		 </div>
		 <div class="ClearDivide"></div>
		  </div>
		  <div class="ClearDivide"></div>
			 
			 <div class="Header">  
				<table width="">
					<tr>
						<td width="60" align="left" >Image</td>
						<td align="left">Title</td>
						<td width="80" align="left"><a href="">Price <img src="<?php echo IMG_DIR; ?>/layout/icon_arrow_down.gif" /></a></td>
						<td width="120" align="left"><a href="">Location/Seller <img src="<?php echo IMG_DIR; ?>/layout/icon_arrow_down.gif" /></a></td>
						<td width="70" align="left"><a href="" style="color:#FFFFFF; ">Listed <img src="<?php echo IMG_DIR; ?>/layout/icon_arrow_down.gif" /></a></td>
					</tr>
				</table>
			</div>	
			<div class="Content" >						
				<table class="Categories" width="100%" >
				 <?php 
				 $ids = RowSet::add('Listing', $info['rows']);
				 RowSet::add('Mem', $info['rows']);
				 $counter = 0;
				 $total = count($ids);
				 if($total > 0 ){
					 foreach ($ids as $id){
					 	$counter++;
					 	$listingObj = RowSet::get('Listing', $id);
				 ?>
					<tr>
						<td width="60" align="left"><a href="<?php echo $listingObj->getUrl(); ?>"><img src="<?php echo $listingObj->getThumbUrl();?>" width="60" height="60" /></a></td>
						<td valign="left"><a href="<?php echo $listingObj->getUrl(); ?>"><?php echo $listingObj->listing_title; ?></a></td>
						<td width="80" align="left"><?php if($listingObj->listing_price > 0) {echo Format::strMoney($listingObj->listing_price);}else{ echo '--';} ?></td>
						<td width="120" align="left"><?php echo $listingObj->listing_location; ?>,<br /><strong><?php echo RowSet::get('Mem', $listingObj->mem_id)->mem_nickname; ?></strong></td>
						<td width="70" align="left"><?php echo Format::strDate($listingObj->listing_created); ?></td>
					</tr>
					<?php if ($counter < $total){ ?>
					<tr><td colspan="5" class="Divide">&nbsp;</td></tr>
					<?php } 
				 	}
				 }else{
				 ?>
					<tr><td colspan="5" align="center">No Listing Found</td></tr>
					<tr><td colspan="5" class="Divide">&nbsp;</td></tr>
				<?php
					}
					?>
				</table>
			</div>		
			<div style=" text-align:center;padding-right:15px; margin-bottom: 5px; ">
					<?php echo Control::ctrlPaginator($info['info']); ?>
			</div>
			
 			 
			<div class="Bottom"><img src="/images/layout/panel_bottom.jpg" alt="" /></div>
		</div>		
		 