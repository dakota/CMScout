<p>Your search for <strong><?php echo $searchTerms; ?></strong> returned the following results:<o
<ul>
<?php
	foreach($searchContents as $searchContent) :
?>
	<li>
		<p>
		<?php
			$link = array();
			$link['plugin'] = (isset($searchContent['Plugin']['directory'])) ? $searchContent['Plugin']['directory'] : '';
			$link['controller'] = strtolower(Inflector::pluralize($searchContent['Model']));
			$link['action'] = 'index';
			$link[] = $searchContent['Result']['slug'];
			$link['admin'] = false;

			echo $html->link($searchContent['Result']['title'], $link);
		 ?><br />
		<span class="date">Created: <?php echo $time->niceShort($searchContent['Result']['created']); ?></span><br />
		<span class="summary"><?php echo $text->truncate(strip_tags($searchContent['Result']['text']), 300, '...', false); ?></span>
		</p>
	</li>
<?php endforeach; ?>
</ul>