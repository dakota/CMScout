<?php 
	$photo = $this->data['Photo'];
?>
<div id="<?php echo $photo['id']; ?>_edit"  style="position: absolute; z-index:2; color: #fff; padding: 5px;display: none;">
	<?php echo $html->link(
	    $html->image("/img/edit.png", array("alt" => "Edit", 'border' => '0')),
	    "/photos/editPhoto/" . $photo['id'],
	    array(
	    	'class' => 'editLink',
	    	'rel' => $photo['id'] . '_block'), null, false
	);
	?>
</div>
<div style="z-index:1;text-align:center;">
	<?php if ($photo['caption'] != '') : ?><span class="caption"><?php echo $photo['caption']; ?></span><br /><?php endif; ?>
	<span class="date"><?php echo date('Y-m-d', strtotime($photo['created'])); ?></span>
	<div class="imageBox">
		<a style="text-align: center;" href="<?php echo $html->url('/photos/' . $photo['filename']); ?>" title="Created: &lt;span class=&quote;timeago&quote; title=&quote;<?php echo $photo['created']; ?>&quote;&gt;<?php echo $photo['created']; ?>&lt;/span&gt;&lt;br /&gt;<?php echo $photo['caption']; ?>">
			<?php echo $image->resize($photo['filename'], 180, 140, 'photos/', true,array('border'=>'0', 'alt'=>$photo['caption'], 'style' => 'text-align: center; vertical-align:middle;')); ?>
		</a>
	</div>
</div>