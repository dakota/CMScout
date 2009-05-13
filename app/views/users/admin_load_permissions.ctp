<?php if (count($returnVar['details']) > 0) {?>
<?php 
	$putSave = false;
	foreach ($returnVar['details'] as $key => $detail) {?>
	<?php if ($detail != '0') {
			$putSave = true;
		?>
		<label for="<?php echo $key; ?>">
			<select id="<?php echo $key; ?>">
				<option value="1" <?php echo ($returnVar['permissions'][$key] == 1 && $returnVar['permissions'] != 0 ? 'selected="selected"' : ''); ?> >Allow</option>
				<?php if ($returnVar['AROmode'] == 'Group' && $returnVar['ACOmode'] == 'parent')
				{?>
					<option value="0" <?php echo ($returnVar['permissions'][$key] == 0 || $returnVar['permissions'] == 0 ? 'selected="selected"' : ''); ?>>Deny</option>
					</select>
					&nbsp;<?php echo $detail ?>
					</label>	
				<?php }
				else
				{ ?>
					<option value="0" <?php echo ($returnVar['permissions'][$key] == 0 || $returnVar['permissions'] == 0 ? 'selected="selected"' : ''); ?>>Inherit</option>
					<option value="-1" <?php echo ($returnVar['permissions'][$key] == -1 ? 'selected="selected"' : ''); ?>>Deny</option>
					</select>
					&nbsp;<?php echo $detail ?> <?php echo ($returnVar['permissions'][$key] == 0 || $returnVar['permissions'] == 0) ? (' (Inherited: ' . ($returnVar['actualPermissions'][$key] == 1 ? 'Allow)' : 'Deny)')) : ''; ?>
					</label>	
				<?php } ?>
	<?php } ?>
<?php } 
	if ($putSave) {
?>
<button id="saveButton">Save</button>
<?php } else { ?>
Item has no applicaple permissions.
<?php } ?>
<?php } else {?>
	Item has no applicaple permissions.
<?php } ?>
<?php 
/*
		for (key in data['details'])
		{
			if (data['details'][key] != '0')
			{
				html += '<label for="' + key + '"><select id="' + key + '"><option value="1" ' + (data['permissions'][key] == 1 && data['permissions'] != 0 ? 'selected="selected"' : '') + ' >Allow</option>';
				
				if (data['AROmode'] == 'Group' && data['ACOmode'] == 'parent')
				{
					html += '<option value="0" ' + (data['permissions'][key] == 0 || data['permissions'] == 0 ? 'selected="selected"' : '') + ' >Deny</option></select>';
					html += '&nbsp;' + data['details'][key] + '</label>';	
				}
				else
				{ 
					html += '<option value="0" ' + (data['permissions'][key] == 0 || data['permissions'] == 0 ? 'selected="selected"' : '') + ' >Inherit</option><option value="-1" ' + (data['permissions'][key] == -1 ? 'selected="selected"' : '') + ' >Deny</option></select>';
					html += '&nbsp;' + data['details'][key] + ((data['permissions'][key] == 0 || data['permissions'] == 0) ? (' (Inherited: ' + (data['actualPermissions'][key] == 1 ? 'Allow)' : 'Deny)')) : '') +  '</label>';	
				}
				
			}
		}

			html += '<button id="saveButton">Save</button>';
		
			$('#permissions').html(html);
			*/ ?>
			