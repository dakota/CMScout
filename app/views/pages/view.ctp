<?php if (isset($pageToShow)) {?>
<div>
<div id="dataInfo" style="width: 30%">
	Created: <span class="timeago" title="<?php echo $pageToShow['Page']['created']; ?>"><?php echo $time->niceShort($pageToShow['Page']['created']); ?></span><br />
	Modified: <span class="timeago" title="<?php echo $pageToShow['Page']['modified']; ?>"><?php echo $time->niceShort($pageToShow['Page']['modified']); ?></span><br />
	Tags: <?php echo $this->element('tags', array('tags' => $pageToShow['Tag'])); ?>
</div>
<h1 id="nice_name"><?php echo $pageToShow['Page']['title']; ?></h1>
<div id="content" style="margin-top:10px; text-align:left;">
<?php
echo $pageToShow['Page']['text'];
?>
</div>
</div>
<?php } else { ?>
Error 404: The page you tried to access could not be found, please contant the website administrator.
<?php } ?>