<div class="input select">
<label><?php __('Page to show'); ?></label>
<select class="option">
<option value=""><?php __('List of pages'); ?></option>
<?php 
	foreach ($pages as $page)
	{
?>	
<option value="<?php echo $page['Page']['slug']; ?>" title="<?php echo $html->url(array('controller' => 'Pages', 'action' => 'index', 0 => $page['Page']['slug'])); ?>"><?php echo $page['Page']['title']; ?></option>
<?php }?>
</select>
</div>