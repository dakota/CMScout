<ul>
<?php foreach ($albums as $album) { ?>
<li>
	<?php echo $html->link($album['Album']['title'], '/photos/index/' . $album['Album']['slug']); ?>
</li>
<?php }?>
</ul>