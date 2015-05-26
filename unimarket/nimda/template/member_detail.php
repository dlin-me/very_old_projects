
<?php

$memObj = RowSet::get('Mem', Request::paramGet('id'));

?>

<form action="<?php echo WEB_DIR.'/action.php'; ?>" method="post">
<table class="list" cellpadding="3" cellspacing="1">
	<tbody>
		<tr>
			<td class="listtitle" colspan="2">Category Details (ID: <?php echo $memObj->getId(); ?> )</td>
		</tr>
		<tr>
			<td class="list" width="30%" >
				<?php echo $memObj->getFieldName('mem_id'); ?>
			</td>
			<td class="list" >
				<?php echo $memObj->getFieldHTML('mem_id'); ?>
			</td>
		</tr>
		<tr>
			<td class="list" >
				<?php echo $memObj->getFieldName('mem_site'); ?>
			</td>
			<td class="list" >
				<?php echo $memObj->getFieldHTML('mem_site'); ?>
			</td>
		</tr>
		<tr>
			<td class="list" >
				<?php echo $memObj->getFieldName('mem_nickname'); ?>
			</td>
			<td class="list" >
				<?php echo $memObj->getFieldHTML('mem_nickname'); ?>
			</td>
		</tr>
		<tr>
			<td class="list" >
				<?php echo $memObj->getFieldName('mem_email'); ?>
			</td>
			<td class="list" >
				<?php echo $memObj->getFieldHTML('mem_email'); ?>
			</td>
		</tr>
		<tr>
			<td class="list" >
				<?php echo $memObj->getFieldName('mem_password'); ?>
			</td>
			<td class="list" >
				<?php echo $memObj->getFieldControl('mem_password', 'htmlTextLabel'); ?>
			</td>
		</tr>
		<tr>
			<td class="list" >
				<?php echo $memObj->getFieldName('mem_status'); ?>
			</td>
			<td class="list" >
				<?php echo $memObj->getFieldHTML('mem_status'); ?>
			</td>
		</tr>
		<tr>
			<td class="list" >
				<?php echo $memObj->getFieldName('mem_token'); ?>
			</td>
			<td class="list" >
				<?php echo $memObj->getFieldControl('mem_token', 'htmlTextLabel'); ?>
			</td>
		</tr>
		<tr>
			<td class="list" >
				<?php echo $memObj->getFieldName('mem_last_login'); ?>
			</td>
			<td class="list" >
				<?php echo $memObj->getFieldControl('mem_last_login', 'htmlDateTimeLabel')?>
			</td>
		</tr>
		<tr>
			<td class="list" >
				<?php echo $memObj->getFieldName('mem_last_namechange'); ?>
			</td>
			<td class="list" >
				<?php echo $memObj->getFieldControl('mem_last_namechange', 'htmlDateTimeTiLabel'); ?>
			</td>
		</tr>
		<tr>
			<td class="list" >
				<?php echo $memObj->getFieldName('mem_updated'); ?>
			</td>
			<td class="list" >
				<?php echo $memObj->getFieldHTML('mem_updated'); ?>
			</td>
		</tr>
				<tr>
			<td class="list" >
				<?php echo $memObj->getFieldName('mem_created'); ?>
			</td>
			<td class="list" >
				<?php echo $memObj->getFieldHTML('mem_created'); ?>
			</td>
		</tr>
		<tr>
			<td class="list" >
				<input type="hidden" name="_a" value="member_update" />
				<input type="hidden" name="id" value="<?php echo $memObj->getId(); ?>" />
			</td>
			<td class="list" >
				<input type="submit" value="Update Member" />
				<input type="button" value="Cancel" onClick="location='<?php echo WEB_DIR.'/member.php'; ?>'" />
			</td>
		</tr>
	</tbody>


</table>
</form>


<form action="<?php echo WEB_DIR.'/action.php'; ?>" method="post">
<table class="list" cellpadding="3" cellspacing="1">
	<tbody>
		<tr>
			<td class="listtitle" colspan="2">Preference Settings </td>
		</tr>
		<tr>
			<td class="list" width="30%">
				<?php echo $memObj->getFieldName('mem_email_subscription'); ?>
			</td>
			<td class="list" >
				<?php echo $memObj->getFieldHTML('mem_email_subscription'); ?>
			</td>
		</tr>
		<tr>
			<td class="list" width="30%">
				<?php echo $memObj->getFieldName('mem_contact_detail'); ?>
			</td>
			<td class="list" >
				<?php echo $memObj->getFieldHTML('mem_contact_detail'); ?>
			</td>
		</tr>
		<tr>
			<td class="list" width="30%">
				<?php echo $memObj->getFieldName('mem_how_contact'); ?>
			</td>
			<td class="list" >
				<?php echo $memObj->getFieldHTML('mem_how_contact'); ?>
			</td>
		</tr>
		<tr>
			<td class="list" >
				<input type="hidden" name="_a" value="member_update" />
				<input type="hidden" name="id" value="<?php echo $memObj->getId(); ?>" />
			</td>
			<td class="list" >
				<input type="submit" value="Update Member" />
				<input type="button" value="Cancel" onClick="location='<?php echo WEB_DIR.'/member.php'; ?>'" />
			</td>
		</tr>
	</tbody>


</table>
</form>
