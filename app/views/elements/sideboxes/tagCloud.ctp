<?php
if (isset($item['Data'])) :
	$tags = $tagcloud->formulateTagCloud($item['Data'], false);
?>
<div>
	<?php foreach ($tags as $tag):?>
		<?php echo $html->link($tag['tag'], array('controller' => 'tags', 'action' => 'index', $tag['slug']), array('class' => 'normalLink', 'style' => 'font-size:'.$tag['size'].'%;')); ?>
	<?php endforeach;?>
</div>
<?php endif;?>