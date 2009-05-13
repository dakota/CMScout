<?php
	$javascript->link('jquery.blockui', false);
	$javascript->link('pages/admin_index', false);
?>
<?php
 	echo $html->link("Back", array('controller' => 'pages', 'action' => 'index', 'prefix' => 'admin') , array('id' => 'backLink'));
?>
<?php if (count($pages) > 0) {?>
<table width="100%">
<tr class="header">
	<th width="25%"><?php echo $paginator->sort('Title', 'title'); ?></th>
	<th width="25%"><?php echo $paginator->sort('Tags', 'tags'); ?></th>
	<th width="25%"><?php echo $paginator->sort('Created', 'created'); ?></th>
	<th width="25%"><?php echo $paginator->sort('Modified', 'modified'); ?></th>
</tr>
<?php $i = 1;foreach ($pages as $page) {
			$class = '';
			if ($i++ % 2 == 0) {
				$class = ' class="altrow hasHoverAction"';
			}
			else
			{
				$class = ' class="hasHoverAction"';
			}?>
<tr<?php echo $class; ?> id="<?php echo $page['Page']['slug']; ?>">
	<td>
		<div class="hoverAction">
			<?php echo $html->image("/img/restore.png", array("alt" => "Restore",
																'border' => '0',
				    											'url' => array('controller' => 'pages', 'action' => 'restore', 'prefix' => 'admin', $page['Page']['id']),
				    											'class' => 'restoreLink')); ?>
			<?php echo $html->image("/img/remove.png", array("alt" => "Permentally remove",
																'border' => '0',
				    											'url' => array('controller' => 'pages', 'action' => 'hardDelete', 'prefix' => 'admin', $page['Page']['id']),
				    											'class' => 'hardDeleteLink')); ?>
		</div>
		<span><?php echo $page['Page']['title']; ?></span>
	</td>
	<td><?php echo $page['Page']['tags']; ?></td>
	<td class="timeago"><?php echo $time->niceShort($page['Page']['created']); ?></td>
	<td class="timeago"><?php echo $time->niceShort($page['Page']['modified']); ?></td>
</tr>
<?php }?>
</table>
<?php echo $paginator->counter(); ?>
<?php
	echo $paginator->prev('« Previous ', null, null, array('class' => 'disabled'));
	echo $paginator->numbers();
	echo $paginator->next(' Next »', null, null, array('class' => 'disabled'));
?>
<?php } ?>