<?php

$listingTbl = Listing::getTbl();
$res = $listingTbl->getExpRowsSubsetInfo();
$rows = $res['rows'];
RowSet::add('Mem', $rows);
RowSet::add('Cat', $rows);
$ids=RowSet::add('Listing', $rows);

?>
 
<table class="list" cellpadding="3" cellspacing="1">
	<tbody>
		<tr>
			<td class="listtitle" colspan="9"><strong>Search Listing</strong></td>
		</tr>
		<tr>
			<td class="list" colspan="9">Create New Folder</td>
			 
		</tr>
		
		</tr>
	</tbody>
	<tbody>
		<tr>
			<td colspan="9" align="right"><a class="toptext" href="/url?view=advanced">Advanced Search</a></td>
		</tr>
		<tr>
			<td class="listtitle">ID</td>
			<td class="listtitle">Title</td>
			<td class="listtitle">Member</td>
			<td class="listtitle">Site</td>
			<td class="listtitle">Status</td>
			<td class="listtitle">Updated</td>
			<td class="listtitle">Listed</td>
			<td class="listtitle">Category</td>
			<td class="listtitle" align="center"><a class="listtitle" href="javascript:selectAll('select');">Select</a></td>
		</tr>
<?php
	foreach($ids as $id){
		$liObj = RowSet::get('Listing', $id);
?>
		<tr>
			<td class="list" title="<?php echo htmlentities($liObj->listing_desc); ?>"><a href="<?php echo WEB_DIR; ?>/listing.php?id=<?php echo $id; ?>"><?php echo $id; ?></a></td>
			<td class="list" title="<?php echo htmlentities($liObj->listing_title); ?>"><a href="<?php echo WEB_DIR; ?>/listing.php?id=<?php echo $id; ?>"><?php echo Format::strTruncate($liObj->listing_title, 30); ?></a></td>
			<td class="list" ><a href="<?php echo WEB_DIR; ?>/member.php?id=<?php echo $liObj->mem_id; ?>"><?php echo RowSet::get('Mem', $liObj->mem_id)->mem_nickname; ?></a></td>
			<td class="list"><?php echo $liObj->listing_site; ?></td>
			<td class="list"><?php echo $liObj->listing_status; ?></td>
			<td class="list" title="<?php echo Format::strDateTime($liObj->listing_updated); ?>"><?php echo Format::strDate($liObj->listing_updated); ?></td>
			<td class="list"title="<?php echo Format::strDateTime($liObj->listing_created); ?>"><?php echo Format::strDate($liObj->listing_created); ?></td>
			<td class="list"><?php echo RowSet::get('Cat', $liObj->cat_id)->cat_name; ?></td>
			<td class="list" align="center"><input name="select0" value="/images" type="checkbox"></td>
		</tr>
<?php
	}
?>		
		
		<tr>
			<td class="listtitle" colspan="9" align="right">With Selected &nbsp;&nbsp;
				<input value="Set Status" type="submit">
				 
&nbsp;&nbsp;or&nbsp;&nbsp;
				<input name="add" value="Add to Clipboard" type="submit">
&nbsp;&nbsp;or&nbsp;&nbsp;
				<input value="Delete" onclick="if (confirm('Are you sure you want to delete these files?')){document.tableform.button.value = 'delete';document.tableform.submit();	}" type="button">
				</td>
		</tr>
	</tbody>
</table>
 

