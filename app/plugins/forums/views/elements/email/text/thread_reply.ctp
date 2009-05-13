Dear <?php echo $receipientInfo['username']; ?>,

<?php echo $receipientData['User']['username']; ?> has just replied to a thread you have subscribed to entitled - <?php echo $receipientData['ForumThread']['title']; ?> - in the <?php echo $receipientData['ForumThread']['ForumForum']['title']; ?> forum of <?php echo Configure::read('CMScout.Core.SiteName');?>.

This reply in the thread is located at:
 <?php echo Router::url(array('controller' => 'forums', 'plugin' => $plugin['Plugin']['directory'], 'action' => 'thread', $receipientData['ForumThread']['slug'], $receipientData['ForumPost']['id'], '#' => $receipientData['ForumPost']['id']), true); ?>


Here is the message that has just been posted:
***************
<?php echo $receipientData['ForumPost']['text']; ?>

***************

There may also be other replies, but you will not receive any more notifications until you visit the thread again.

Regards
	<?php echo Configure::read('CMScout.Core.SiteName');?>