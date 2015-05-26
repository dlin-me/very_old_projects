		<div class="Panel">
			<div class="Header">Categories</div>	
			<div class="Content">						
				<table class="Categories" width="100%" >
					<tr>
					<?php
						$catTbl = Cat::getTbl();
						$tree = $catTbl->getTreeIds();				 
						$data = Cat::getLevelIds($tree, $tree[0]);
						$counter = -1;
						echo '<td valign="top" width="25%"><ul>';
						foreach($data as $dt){
							if($dt[1] < 2){
								$counter++;
								if($counter%17 ==0 && $counter != 0 ){
									echo '</ul></td><td valign="top" width="25%"><ul>';
								}
								$ctObj = RowSet::get('Cat', $dt[0]);
								echo '<li'. ($dt[1]==0?' class="MainCat" ':'').'><a href="'.$ctObj->getUrl().'">'.$ctObj->cat_name.'</a></li>';
							
							
							}
						}
						echo '</ul></td>';
					?>
					</tr>									
				</table>
				
			</div>		
			<div class="Bottom"><img src="/images/layout/panel_bottom.jpg" alt="" /></div>
		
	</div>