<?php
	$html->css('ui.theme/ui.tabs', null, array(), false);
	
	//$javascript->link('users/index', false);
?>
<?php  echo $form->create('Configuration', array('action' => 'admin_index'));?>
<div id="tabs">
<ul>
<?php	
	foreach($configs as $key => $configCat)
	{
		echo '<li><a href="#' . str_replace(' ', '', $key) . '">'.$key.'</a>';
	} 
?>
</ul>
<?php	
	foreach($configs as $key => $configCat)
	{
		echo '<div id="' . str_replace(' ', '', $key) . '">';
		foreach ($configCat as $configItem)
		{
			echo '<div class="input '. $configItem['Configuration']['input_type'] .'">';
			
			if ($configItem['Configuration']['input_type'] != 'checkbox')
				echo '<label for="'. $configItem['Configuration']['name'] .'">'. $configItem['Configuration']['label'] .'</label>';
			switch ($configItem['Configuration']['input_type'])
			{
				case "textarea":
					echo '<textarea id="'. $configItem['Configuration']['name'] .'" name="'. $configItem['Configuration']['id'] .'">'.$configItem['Configuration']['value'] .'</textarea>';
					break;
				case "checkbox":
					echo '<input type="checkbox" value="1" id="'. $configItem['Configuration']['name'] .'" name="'. $configItem['Configuration']['id'] .'" ' . ($configItem['Configuration']['value'] == 1 ? 'checked="checked"' : '') . '/>';
					break;
				case "select":
					$options = explode(',', $configItem['Configuration']['options']);
					echo '<select id="' . $configItem['Configuration']['name'] . '" name="'. $configItem['Configuration']['id'] .'">';
					foreach ($options as $key => $option)
					{
						echo '<option value="' . $key . '"' . ($key == $configItem['Configuration']['value'] ? ' selected="selected"' : '') . '>' . $option . '</option>';
					}
					echo '</select>';
					break;
				case "password":
					echo '<input type="password" value="'. $configItem['Configuration']['value'] .'" id="'. $configItem['Configuration']['name'] .'" name="'. $configItem['Configuration']['id'] .'"/>';
					break;
				default:
					echo '<input type="text" value="'. $configItem['Configuration']['value'] .'" id="'. $configItem['Configuration']['name'] .'" name="'. $configItem['Configuration']['id'] .'"/>';
					break;
			}
			if ($configItem['Configuration']['input_type'] == 'checkbox')
				echo '<label for="'. $configItem['Configuration']['name'] .'">'. $configItem['Configuration']['label'] .'</label>';
			
			echo "</div>";
		}
		echo '</div>';
	} 
?>
</div>
<input type="hidden" name="data[test]" />
<?php echo $form->end('Save'); ?>
<script type="text/javascript">
$("#tabs").tabs({
	selected: 0
});
</script>