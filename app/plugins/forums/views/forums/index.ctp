<?php
	$html->css('/forums/css/forums', null, array(), false);

	if (isset($category))
	{
		$html->addCrumb('Forums', array('controller' => 'forums', 'plugin' => 'forums', 'action' => 'index'));
		$html->addCrumb($category['ForumCategory']['title'], array('controller' => 'forums', 'plugin' => 'forums', 'action' => 'index', $category['ForumCategory']['slug']));

		echo $html->getCrumbs(' > ');
	}

?>
<table class="forumTable">
	<tr>
		<th width="5%"></th>
		<th>Forum</th>
		<th width="20%">Last post</th>
		<th width="10%">Threads</th>
		<th width="10%">Posts</th>
	</tr>
<?php foreach ($categories as $category) :?>
	<tr>
		<th colspan="5" class="categoryTitle"><?php echo $category['title']; ?></th>
	</tr>
	<?php $i = 0; foreach ($category['forums'] as $forum) :?>
		<tr <?php echo $i++ % 2 ? 'class="altrow"':'';?>>
			<td>
				<?php echo $forum['unreadPost'] ? 'New' : '';?>
			</td>
			<td>
				<?php echo $html->link($forum['title'], array('controller' => 'forums', 'plugin' => 'forums', 'action' => 'forum', $forum['slug'])); ?>
				<br />
				<span class="description"><?php echo $forum['description']; ?></span>
				<?php if (count($forum['ChildForum'])) :?>
				<br />
				<span class="subforums">Subforums:
					<?php foreach($forum['ChildForum'] as $key => $ChildForum) : ?>
						<?php echo $html->link($ChildForum['title'],array('controller' => 'forums', 'plugin' => 'forums', 'action' => 'forum', $ChildForum['slug'])); if($key < (count($forum['ChildForum'])-1)) echo ", ";?>
					<?php endforeach; ?>
				</span>
				<?php endif;?>
			</td>
			<td>
				<?php if (isset($forum['lastPost']['ForumThread'])) : ?>
					<div class="lastPost"><?php echo $html->link($forum['lastPost']['ForumThread']['title'], array('action' => 'thread', $forum['lastPost']['ForumThread']['slug']));?><br>
					by <?php echo $forum['lastPost']['User']['username']; ?></div>
					<div class="lastPostDate"><?php echo $time->niceShort($forum['lastPost']['ForumPost']['created']);?>&nbsp;
												<?php echo $html->link('Last', array('action' => 'thread', $forum['lastPost']['ForumThread']['slug'], $forum['lastPost']['ForumPost']['id'], '#' => $forum['lastPost']['ForumPost']['id']));?>
					</div>
				<?php endif;?>
			</td>
			<td class="number"><?php echo $forum['number_threads']; ?></td>
			<td class="number"><?php echo $forum['number_posts']; ?></td>
		</tr>
	<?php endforeach;?>
<?php endforeach; ?>
</table>
