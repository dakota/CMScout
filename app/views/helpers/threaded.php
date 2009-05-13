<?php
class threadedHelper extends AppHelper 
{
	var $tab = "	";
 
	function show($data)
	{
		$output = $this->list_element($data['children']);

		return $this->output($output);
	}
	  
	function list_element($data, $level = 0)
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
				$output .= ' metadata="{';
				
				$metadata = array();
				foreach ($child['metadata'] as $key => $value)
				{
					$metadata[] = $key . ': ' . $value; 
				}
				$output .= implode(',', $metadata);
				
				$output .= '}"';
			}
			
			$output .= '>';
			
			$output .= '<a href="#"';
			
			if (isset($child['icons']))
			{
				$output .= ' style="background-image:url(\''. $child['icons'] .'\');"';
			}

			$output .= '>';
			
			/*if (isset($child['active']) && $child['active'] == 0)
			{
				$output .= '<span class="inactive">Inactive</span> ';
			}*/
			
			$output .=  $child['data']. "</a>";
			
			if(isset($child['children'][0]))
			{
				$output .= $this->list_element($child['children'], $level+1);
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