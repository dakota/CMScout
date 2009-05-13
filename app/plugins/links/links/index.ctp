<div id="content">
<ul id="externLinks" class="menuList">
	<?php
		foreach($linkList as $link)
		{
			echo '<li id="link-' . $link['Link']['id'] . '"> 
			<p><a href="' . $link['Link']['address'] . '" class="textInputArea" id="nice_name-' . $link['Link']['id'] . '">' . $link['Link']['nice_name'] . '</a>' . 
			'</p><p>&nbsp;&nbsp;&nbsp;<span class="textInputArea" id="address-' . $link['Link']['id'] . '">'.$link['Link']['address'].'</span></p></li>';
		}
	?>
</ul>
</div>