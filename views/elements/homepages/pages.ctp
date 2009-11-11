<?php $pageToShow = $item['Data']; ?>
<?php if (isset($pageToShow)) : ?>
	<div>
		<h1 id="nice_name"><?php echo $pageToShow['Page']['title']; ?></h1>
		<div id="content" style="margin-top:10px; text-align:left;">
			<?php
			echo $pageToShow['Page']['text'];
			?>
		</div>
	</div>
<?php else : ?>
No page
<?php endif; ?>
