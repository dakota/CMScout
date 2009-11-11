<?php
if ($item['Homepage']['options'] == '') :
?>
<?php else :?>
	<?php
		$tags = $tagcloud->formulateTagCloud($item['Data']);
	?>
	<?php foreach ($tags as $tag):?>
		<?php echo $html->link($tag['tag'], array('controller' => 'tags', 'action' => 'index', $tag['slug']), array('style' => 'font-size:'.$tag['size'].'%;')); ?>
	<?php endforeach;?>
<?php endif;?>