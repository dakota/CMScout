<div class="input select">
<label><?php __('Article to show'); ?></label>
<select class="option">
<option value=""><?php __('List of articles'); ?></option>
<?php 
	foreach ($articles as $article)
	{
?>	
<option value="view/<?php echo $article['Article']['name']; ?>"><?php echo $article['Article']['title']; ?></option>
<?php }?>
</select>
</div>