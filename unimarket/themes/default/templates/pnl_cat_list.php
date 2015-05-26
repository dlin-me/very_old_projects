	<div class="Panel">
			<div class="Header">Categories</div>	
			<div class="Content">												
				<div class="Navigation">		
					<ul>
						 <?php
						 	$catObj = RowSet::get('Cat', Request::cat());
							
							if ($catObj->getParentId() > 0){
								$pObj = $catObj->getParentObj();
						 
								echo '<li style="font-weight:bold; "><a href="'.$pObj->getUrl().'"><img src="'.IMG_DIR.'/layout/arrow_up.gif" alt="^" />&nbsp; '.$pObj->cat_name.'</a></li>';						
						 		 
							} 
							
							if(Request::cat() > 0){
								$ids = $catObj->getSiblingIds();
							}else{
								$ids = $catObj->getChildrenIds();
							}
							
							foreach($ids as $sid){
								 
								$sObj= RowSet::get('Cat', $sid);
								 
								
								if($sid == Request::cat()){
						 
							            echo '<li style="background-color:#ebebeb;font-weight:bold; "><a href="'.$sObj->getUrl().'">'.$sObj->cat_name.'</a></li>';
										if($sObj->hasChildren()){
											$cids=$sObj->getChildrenIds();
											foreach($cids as $cid){
												$cObj = RowSet::get('Cat', $cid);
								 
												echo '<li style="padding-left:2em; margin:0px; "><a href="'.$cObj->getUrl().'">'.$cObj->cat_name.'</a></li>';					 
								 
											}
										}
								}else{ 
										echo '<li ><a href="'.$sObj->getUrl().'">'.$sObj->cat_name.'</a></li>';
								}	
							}//end of foreach
						?>
					</ul>									
				</div>	
			</div>		
			<div class="Bottom">
				<div style="float:left"><img src="<?php echo IMG_DIR; ?>/layout/panel_bottom_left.jpg" alt=""></div>
				<div style="float:right"><img src="<?php echo IMG_DIR; ?>/layout/panel_bottom_right.jpg" alt=""></div> 
			</div>	
		</div>