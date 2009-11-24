<?php
	$html->css('ui.theme/ui.accordion', null, array('inline' => false));
	
	//$javascript->link('users/index', false);
?>
<?php  echo $this->Form->create('Configuration', array('action' => 'admin_index'));?>
<div id="accordions">
<?php	
	foreach($configs as $key => $configCat)
	{
		echo '<h3><a class="accordionHeader" href="#' . str_replace(' ', '', $key) . '">'.$key.' Settings</a></h3>';
		echo '<div id="' . str_replace(' ', '', $key) . '">';
		foreach ($configCat as $configItem)
		{
			if($configItem['Configuration']['auto_edit'])
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
		}
		echo '</div>';
	} 
?>
	<h3><a class="accordionHeader" href="#coreExtra">Layout Settings</a></h3>
	<div id="coreExtra">
		<?php 
			$homePageOptions = array();
			$homePageParameters = array();
		
			foreach($availableHomePages['getAvailableHomePages'] as $homePages)
			{
				foreach($homePages as $homePage)
				{
					$pluginName = $homePage['plugin']['title'];
					if(!isset($homePageOptions[$pluginName]))
					{
						$homePageOptions[$pluginName] = array();
					}
					
					$homePage['plugin'] = Inflector::underscore($homePage['plugin']['name']);
					//$key = serialize($homePage); 
					
					$key = $homePage['plugin'] . ':' . $homePage['controller'] . ':' . $homePage['action'];
					
					$homePageOptions[$pluginName][htmlspecialchars($key)] = $homePage['title'];

					$urlArray = array();
					$urlArray['plugin'] = $homePage['plugin'];
					$urlArray['controller'] = $homePage['controller'];
					$urlArray['action'] = $homePage['edit_action'];
					$urlArray['admin'] = true;
					
					$homePageParameters[$key] = $this->Html->url($urlArray);
				}
			}

			ksort($homePageOptions, SORT_STRING);
			
			echo $this->Form->input('home_page', array('selected' => Configure::read('CMScout.Core.homePage'), 'name' => $configIds['homePage'], 'label' => 'Default home page for website.', 'empty' => '-- No home page selected --', 'options' => $homePageOptions));
			echo '<div id="homePageOption"></div>';
			echo $this->Form->input('theme_id', array('selected' => Configure::read('CMScout.Core.themeId'), 'name' => $configIds['themeId'], 'label' => 'Default theme for website', 'empty' => '-- No theme selected --'));
		?>
	</div>
</div>
<?php echo $this->Form->end('Save changes'); ?>
<script type="text/javascript">
	var homePages = eval('(<?php echo json_encode($homePageParameters);?>)');
	
	$("#ConfigurationHomePage").change(function() {
		var $this = $(this);
		var value = $this.val();
	
		if (value != '')
		{
			var url = homePages[value];
			
			$('#homePageOption').load(url + '/fieldName:<?php echo $configIds['homePageOption']?>');
		}
		else
		{
			$('#homePageOption').html('');
		}
	});

	if($("#ConfigurationHomePage").val() != '')
	{
		var url = homePages[$("#ConfigurationHomePage").val()];
		
		$('#homePageOption').load(url + '/fieldName:<?php echo $configIds['homePageOption']?>/fieldValue:<?php echo urlencode(serialize(Configure::read('CMScout.Core.homePageOption')));?>');
	}
	
	$("#accordions").accordion({
		autoHeight: false,
		navigation: true
	});	
</script>