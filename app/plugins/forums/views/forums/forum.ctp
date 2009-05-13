<?php
	$html->css('/forums/css/forums', null, array(), false);

	$html->addCrumb('Forums', array('controller' => 'forums', 'plugin' => 'forums', 'action' => 'index'));
	foreach ($breadcrumbs as $key => $crumb)
	{
		if ($key == 0)
			$html->addCrumb($crumb['title'], array('controller' => 'forums', 'plugin' => 'forums', 'action' => 'index', $crumb['slug']));
		else
			$html->addCrumb($crumb['title'], array('controller' => 'forums', 'plugin' => 'forums', 'action' => 'forum', $crumb['slug']));
	}

	echo '<div class="breadcumbs">' . $html->getCrumbs(' > ') . '</div>';
	$paginator->options(array('url'=>$this->passedArgs));
?>
<div class="finalBreadcrumb"><?php echo $forum['ForumForum']['title']; ?></div>
<table class="forumTable">
	<tr>
		<th colspan="5">Subforums</th>
	</tr>
	<tr>
		<th width="5%"></th>
		<th>Forum</th>
		<th width="20%">Last post</th>
		<th width="10%">Threads</th>
		<th width="10%">Posts</th>
	</tr>
	<?php $i = 0; foreach ($subForums as $subForum) :?>
		<tr <?php echo $i++ % 2 ? 'class="altrow"':'';?>>
			<td>
				<?php echo $subForum['unreadPost'] ? 'New' : '';?>
			</td>
			<td>
				<?php echo $html->link($subForum['title'], array('controller' => 'forums', 'plugin' => 'forums', 'action' => 'forum', $subForum['slug'])); ?>
				<br />
				<span class="description"><?php echo $subForum['description']; ?></span>
				<?php if (count($subForum['ChildForum'])) :?>
				<br />
				<span class="subforums">Subforums:
					<?php foreach($subForum['ChildForum'] as $key => $ChildForum) : ?>
						<?php echo $html->link($ChildForum['title'],array('controller' => 'forums', 'plugin' => 'forums', 'action' => 'forum', $ChildForum['slug'])); if($key < (count($subForum['ChildForum'])-1)) echo ", ";?>
					<?php endforeach; ?>
				</span>
				<?php endif;?>
			</td>
			<td>
				<?php if (isset($subForum['lastPost']['ForumThread'])) : ?>
					<div class="lastPost"><?php echo $html->link($subForum['lastPost']['ForumThread']['title'], array('action' => 'thread', $subForum['lastPost']['ForumThread']['slug']));?><br>
					by <?php echo $subForum['lastPost']['User']['username']; ?></div>
					<div class="lastPostDate"><?php echo $time->niceShort($subForum['lastPost']['ForumPost']['created']);?>&nbsp;
							<?php echo $html->link('Last', array('action' => 'thread', $subForum['lastPost']['ForumThread']['slug'], $subForum['lastPost']['ForumPost']['id'], '#' => $subForum['lastPost']['ForumPost']['id']));?>
					</div>
				<?php endif;?>
			</td>
			<td class="number"><?php echo $subForum['number_threads']; ?></td>
			<td class="number"><?php echo $subForum['number_posts']; ?></td>
		</tr>
	<?php endforeach;?>
</table>
<?php echo $html->link('New topic', array('action' => 'newTopic', $forum['ForumForum']['slug']), array('id' => 'newTopic')); ?>
<table class="forumTable">
	<tr>
		<th width="5%"></th>
		<th><?php echo $paginator->sort('Thread', 'title'); ?></th>
		<th width="20%"><?php echo $paginator->sort('Last Post', 'lastPost'); ?></th>
		<th width="10%"><?php echo $paginator->sort('Replies', 'number_posts'); ?></th>
		<th width="10%"><?php echo $paginator->sort('Views', 'views'); ?></th>
	</tr>
<?php $i = 0; foreach ($threads as $thread) :?>
	<tr <?php echo $i++ % 2 ? 'class="altrow"':'';?>>
		<td>
			<?php echo $thread['unreadPost'] ? 'New' : '';?>
		</td>
		<td>
			<?php echo $html->link($thread['title'], array('controller' => 'forums', 'plugin' => 'forums', 'action' => 'thread', $thread['slug'])); ?>
			<br />
			<span class="description"><?php echo $thread['description']; ?></span>
			<br />
			<span class="user"><?php echo $thread['userPost']['username']; ?></span>
		</td>
		<td>
			<div class="lastPost"><?php echo $time->niceShort($thread['lastPost']['created']);?></div>
			<div class="lastPostDate">by <?php echo $thread['lastPost']['User']['username']; ?>&nbsp;
			<?php echo $html->link('Last', array('action' => 'thread', $thread['slug'], $thread['lastPost']['id'], '#' => $thread['lastPost']['id']));?></div>
		</td>
		<td class="number"><?php echo $thread['number_posts']; ?></td>
		<td class="number"><?php echo $thread['views']; ?></td>
	</tr>
<?php endforeach; ?>
</table>
<div class="paginate">
	<ul>
		<?php
			echo '<li class="count">'.$paginator->counter('Page %page% of %pages%').'</li> ';
			echo $paginator->first('<< First',array('separator' => null, 'tag' => 'li'));
			echo $paginator->hasPrev() ? '<li>' . $paginator->prev('<', array('tag' => 'li')) . '</li>' : '';
			echo $paginator->numbers(array('separator' => null, 'tag' => 'li'));
			echo $paginator->hasNext() ? '<li>' . $paginator->next('>', array('tag' => 'li')) . '</li>' : '';
			echo $paginator->last('Last >>',array('separator' => null, 'tag' => 'li'));
		?>
	</ul>
</div>