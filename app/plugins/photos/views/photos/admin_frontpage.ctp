<div class="input select">
<label><?php __('Album to show'); ?></label>
<select class="option">
<option value=""><?php __('List of albums'); ?></option>
<?php 
	foreach ($albums as $album)
	{
?>	
<option value="view/<?php echo $album['Album']['name']; ?>"><?php echo $album['Album']['title']; ?></option>
<?php }?>
</select>
</div>