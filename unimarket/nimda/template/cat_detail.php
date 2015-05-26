
<?php

$catObj = RowSet::get('Cat', Request::paramGet('id'));

?>
  
<form action="<?php echo WEB_DIR.'/action.php'; ?>" method="post"> 
<table class="list" cellpadding="3" cellspacing="1">
	<tbody>
		<tr>
			<td class="listtitle">Category Details (ID: <?php echo $catObj->getId(); ?> )</td>
			<td class="listtitle" align="right"><a href="<?php echo WEB_DIR; ?>/action.php?_a=category_recycle&id=<?php echo $catObj->getId(); ?>" >Recycle</a></td>
		</tr>
		<tr>			 
			<td class="list" >
				<?php echo $catObj->getFieldName('cat_id'); ?>
			</td>
			<td class="list" >
				<?php echo $catObj->getFieldHTML('cat_id'); ?>
			</td>
		</tr>
		<tr>			 
			<td class="list" >
				<?php echo $catObj->getFieldName('cat_name'); ?>
			</td>
			<td class="list" >
				<?php echo $catObj->getFieldHTML('cat_name'); ?>
			</td>
		</tr>
		<tr>			 
			<td class="list" >
				<?php echo $catObj->getFieldName('cat_parent'); ?>
			</td>
			<td class="list" >
				<?php echo $catObj->getFieldControl('cat_parent', 'ctrlCatSelector'); ?>
			</td>
		</tr>		
		<tr>			 
			<td class="list" >
				<?php echo $catObj->getFieldName('cat_use_price'); ?>
			</td>
			<td class="list" >
				<?php echo $catObj->getFieldHTML('cat_use_price'); ?>
			</td>
		</tr>
		<tr>			 
			<td class="list" >
				<?php echo $catObj->getFieldName('cat_use_datetime'); ?>
			</td>
			<td class="list" >
				<?php echo $catObj->getFieldHTML('cat_use_datetime'); ?>
			</td>
		</tr>				
		<tr>			 
			<td class="list" >
				<?php echo $catObj->getFieldName('cat_rank'); ?>
			</td>
			<td class="list" >
				<?php echo $catObj->getFieldHTML('cat_rank'); ?>
			</td>
		</tr>
		<tr>			 
			<td class="list" >
				<?php echo $catObj->getFieldName('cat_created'); ?>
			</td>
			<td class="list" >
				<?php echo $catObj->getFieldHTML('cat_created'); ?>
			</td>
		</tr>
		<tr>			 
			<td class="list" >
				<?php echo $catObj->getFieldName('cat_updated'); ?>
			</td>
			<td class="list" >
				<?php echo $catObj->getFieldHTML('cat_updated'); ?>
			</td>
		</tr>	
		<tr>			 
			<td class="list" >
				<?php echo $catObj->getFieldName('cat_recycled'); ?>
			</td>
			<td class="list" >
				<?php echo $catObj->getFieldHTML('cat_recycled'); ?>
			</td>
		</tr>	
		<tr>			 
			<td class="list" >
				<input type="hidden" name="_a" value="category_update" />
				<input type="hidden" name="id" value="<?php echo $catObj->getId(); ?>" />
			</td>
			<td class="list" >
				<input type="submit" value="Update Category" />
				<input type="button" value="Cancel" onClick="location='<?php echo WEB_DIR.'/category.php'; ?>'" />
			</td>
		</tr>									
	</tbody>
</table>
</form>