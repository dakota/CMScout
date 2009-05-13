<div class="input select">
<label><?php __('Forum to show'); ?></label>
<select class="option">
<option value=""><?php __('All forums'); ?></option>
<?php 
	foreach ($forums as $forum)
	{
?>	
<option value="forum/<?php echo $forum['ForumForum']['slug']; ?>"><?php echo $forum['ForumForum']['title']; ?></option>
<?php }?>
</select>
</div>