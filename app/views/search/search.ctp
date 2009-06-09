<p>Your search for <strong><?php echo $searchTerms; ?></strong> returned the following results:</p>
<ul class="searchResults">
<?php
	foreach($searchResults as $result) :
?>
	<li>
		<p>
		<?php
			$link = array();
			$link['plugin'] = (isset($result->plugin)) ? $result->plugin : '';
			$link['controller'] = $result->controller;
			$link['action'] = $result->action;
			$link[] = $result->slug;
			$link['admin'] = false;
			if (isset($result->params))
			{
				$link = am($link, unserialize($result->params));
			}
			echo $html->link($result->title, $link);
		 ?><br />
		<span class="date">Created: <?php echo $time->niceShort($result->created); ?></span><br />
		<span class="summary"><?php echo $text->truncate(strip_tags($result->text), 300, '...', false); ?></span>
		</p>
	</li>
<?php endforeach; ?>
</ul>