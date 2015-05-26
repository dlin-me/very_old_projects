
<?php

$catTbl = Cat::getTbl();
$tree = $catTbl->getTreeIds();
$data = $catTbl->getLevelIds($tree, $tree[0]);

?>
<table class="list" cellpadding="3" cellspacing="1">
	<tbody>
		<tr>
			<td class="listtitle"><b><a class="listtitle" href="http://www.directadmin.com:2222/CMD_FILE_MANAGER?sort1=-1">ID</a></b></td>
			<td class="listtitle" style="width:100%; "><a class="listtitle" href="http://www.directadmin.com:2222/CMD_FILE_MANAGER?sort1=2">Name</a></td>
			<td class="listtitle">Total</td>
			<td class="listtitle">Today</td>			
		</tr>
<?php foreach($data as $dt){ 
		$level = $dt[1];
		$id = $dt[0];
		$catObj = RowSet::get('Cat', $id);
?>
		<tr title="<?php echo $catObj->cat_name; ?>">
			<td class="list"><a href="<?php echo WEB_DIR.'/category.php?id='.$catObj->getId(); ?>"><?php echo $catObj->getId(); ?></a></td>
			<td class="list"><?php echo str_pad('', $level*54, '&nbsp;'); ?><a href="<?php echo WEB_DIR.'/category.php?id='.$catObj->getId(); ?>"><?php echo $catObj->cat_name; ?></a></td>
			<td class="list">5</td>
			<td class="list">43</td>			 
		</tr>
<?php } ?>
		<tr>
			<td class="list2"  colspan="4"></td>
		</tr>
 
	</tbody>
</table>
<?php
	$catObj = RowSet::get('Cat');
?> 
<form action="<?php echo WEB_DIR; ?>/action.php" method="post"> 
<table class="list" cellpadding="3" cellspacing="1">
	<tbody>
		<tr>
			<td class="listtitle" colspan="4">Create New Category</td>
		</tr>
		<tr>			 
			<td class="list" colspan="4">
				<?php echo $catObj->getFieldName('cat_name'); ?>
				<?php echo $catObj->getFieldHTML('cat_name'); ?>
				<?php echo $catObj->getFieldName('cat_parent'); ?>
				<?php echo $catObj->getFieldControl('cat_parent', 'ctrlCatSelector'); ?> 
				<input type="hidden" name="_a" value="category_create" />	
				<input  value="Create" type="submit">				 
			</td>
		</tr> 
	</tbody>
</table>
</form>