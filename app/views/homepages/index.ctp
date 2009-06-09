<table width="100%">
<?php foreach ($homepage as $item) :
	$firstColumn = isset($item[0]) ? $item[0] : array();
	$secondColumn = isset($item[1]) ? $item[1] : array();	
?>
<tr valign="top">
	<?php 
	if (isset($firstColumn['Homepage']['id']) && $firstColumn['Homepage']['menu_link_id'] != 0) : ?>
		<td width="50%" <?php if (!isset($secondColumn['Homepage']['id']) || $secondColumn['Homepage']['menu_link_id'] == 0) { echo 'colspan="2"'; } ?>>
		<?php
			if ($firstColumn['Homepage']['menu_link_id'] != -1) 
			{ 
					echo $this->element('homepage', array('item' => $firstColumn));
			}
			elseif ($firstColumn['Homepage']['menu_link_id'] == -1)
			{
				echo "&nbsp;";
			} 
		?>
		</td>
	<?php endif; ?>
	
	<?php 
	if (isset($secondColumn['Homepage']['id']) && $secondColumn['Homepage']['menu_link_id'] != 0) : ?>
		<td width="50%" <?php if (!isset($firstColumn['Homepage']['id']) || $firstColumn['Homepage']['menu_link_id'] == 0) { echo 'colspan="2"'; } ?>>
		<?php
			if ($secondColumn['Homepage']['menu_link_id'] != -1) 
			{ 
					echo $this->element('homepage', array('item' => $secondColumn));
			}
			elseif ($secondColumn['Homepage']['menu_link_id'] == -1)
			{
				echo "&nbsp;";
			} 
		?>
		</td>
	<?php endif; ?>
</tr>
<?php endforeach; ?>
</table>