<div id="dataInfo">
	Created: <?php echo $time->niceShort($article['Article']['created']); ?><br />
	Modified: <?php echo $time->niceShort($article['Article']['modified']); ?><br />
	Tags: <?php echo $this->element('tags', array('tags' => $article['Tag'])); ?>
</div>
<h1 class="textInputArea" id="title"><?php echo $article['Article']['title']; ?></h1>
<div class="mceInputArea" id="content" style="margin-top:10px;">
<?php
echo $article['Article']['text'];
?>
</div>
<?php echo $this->element('comments', array('Comments' => $comments, 'itemId' => $article['Article']['id'], 'model' => $model, 'commentAuth' => $commentAuth)); ?>
