<ul>
<?php foreach ($articles as $article) { ?>
<li>
	<a href="<?php echo $html->url('/articles/index/' . $article['Article']['slug']); ?>"><?php echo $article['Article']['title']; ?></a>
</li>
<?php }?>
</ul>