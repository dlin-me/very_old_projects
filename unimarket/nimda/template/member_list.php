<?php

$memTbl = Mem::getTbl();
$res = $memTbl->getExpRowsSubsetInfo();
$rows = $res['rows'];
 
$ids=RowSet::add('Mem', $rows);

?>
<form action="<?php echo WEB_DIR; ?>/action.php" method="post"  >
<table class="list" cellpadding="3" cellspacing="1">
	<tbody>
		<tr>
			<td class="listtitle" colspan="9"><strong>Search Member</strong></td>
		</tr>
		<tr>
			<td class="list" colspan="9">Create New Member</td>
			 
		</tr>
		
		</tr>
	</tbody>
	<tbody>
		<tr>
			<td colspan="9" align="right">&nbsp;</td>
		</tr>
		<tr>
			<td class="listtitle">Site</td>
			<td class="listtitle">Nick Name</td>
			<td class="listtitle">Email</td>
			<td class="listtitle">Posts</td>
			<td class="listtitle">Status</td>
			<td class="listtitle">Last Login</td>
			<td class="listtitle">Name Changed</td>
			<td class="listtitle">Register Since</td>
			<td class="listtitle"></td>
		</tr>
<?php
	foreach($ids as $id){
		$memObj = RowSet::get('Mem', $id);
?>
		<tr>
			<td class="list"><?php echo $memObj->mem_site; ?></td>
			<td class="list"><a href="<?php echo WEB_DIR.'/member.php?id='.$memObj->getId(); ?>"><?php echo $memObj->mem_nickname; ?></a></td>
			<td class="list"><?php echo $memObj->mem_email; ?></td>
			<td class="list">234</td>
			<td class="list"><?php echo $memObj->mem_status; ?></a></td>
			<td class="list"><?php echo Format::strDate($memObj->mem_last_login); ?></td>
			<td class="list"><?php echo Format::strDate($memObj->mem_last_namechange); ?></td>
			<td class="list"><?php echo Format::strDate($memObj->mem_created); ?></td>
			<td class="list" align="center"><input name="id[]" value="<?php echo $memObj->getId(); ?>" type="checkbox"></td>
		</tr>
<?php
	}
	
	$memObj = RowSet::get('Mem');
?>		
		
		<tr>
			<td class="listtitle" colspan="9" align="right">
			With Selected: &nbsp;&nbsp;
				 &nbsp;&nbsp;
				 			 
				<?php echo $memObj->getFieldName('mem_status'); ?>
			 
				<?php echo $memObj->getFieldHTML('mem_status'); ?>
			 	<input type="hidden" name="_a" value="member_bulk_change" />
				<input name='submit' value="Set Status" type="submit" onClick="return confirm('Are you sure you want to set status?');"> 
&nbsp;&nbsp;or&nbsp;&nbsp;
				<input name='submit' value="Recycle" type="submit" onclick="return confirm('Are you sure you want to recycle selected ?');" >
				</td>
		</tr>
	</tbody>

</table>
</form>

