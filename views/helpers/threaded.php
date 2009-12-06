<?php
class threadedHelper extends AppHelper 
{
	var $tab = "	";
 
	function show($data, $hasIcons = false)
	{
		$output = $this->list_element($data['children'], $hasIcons);

		return $this->output($output);
	}
	  
	function list_element($data, $hasIcons = 0, $level = 0)
	{
		$tabs = "\n" . str_repeat($this->tab, $level * 2);
		$li_tabs = $tabs . $this->tab;
		
		$output = $tabs . "<ul>";
		foreach ($data as $child)
		{
			$output .= $li_tabs . '<li';
			
			foreach ($child['attributes'] as $attribute => $value)
			{
				$output .= ' ' . $attribute . '="'. $value .'"';
			}

			$output .= ' class="';
			if (isset($child['state']))
			{
				$output .= $child['state'] . ' ';
			}
			
			if (isset($child['class']))
			{
				$output .= $child['class'];
			}
			$output .= '"';

			if (isset($child['metadata']))
			{
				$output .= ' metadata="'.htmlspecialchars(json_encode($child['metadata'])).'"';
				$output .= ' rel="'.$child['metadata']['type'].'"';
			}
			
			$output .= '>';
			
			$output .= '<a href="#"';
			
			if (isset($child['icons']))
			{
				$output .= ' class="file"';
			}

			$output .= '>';
			
			$output .=  $child['data'];
			
			$output .= "</a>";
			
			if($hasIcons == true)
			{
				if(isset($child['metadata']['renamable']) && $child['metadata']['renamable'] == 'true')
					$output .= '&nbsp;<a href="#" class="rename">rename</a>';
				
				if(isset($child['metadata']['deletable']) && $child['metadata']['deletable'] == 'true')
					$output .= '&nbsp;<a href="#" class="remove">remove</a>';
			}
			
			if(isset($child['children'][0]))
			{
				$output .= $this->list_element($child['children'], $hasIcons, $level+1);
				$output .= $li_tabs . "</li>";
			}
			else
			{
				$output .= "</li>";
			}
		}
		
		$output .= $tabs . "</ul>";
		    
		return $output;
	} 
}
?>