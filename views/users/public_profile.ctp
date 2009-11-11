<h2>Public profile for <?php echo $userInfo['User']['username'];?></h2>
<div style="float: right;">
	<?php echo $html->image('/avatars/' . $userInfo['User']['avatar']); ?>
</div>
<div>
	Username: <?php echo $userInfo['User']['username']; ?>
</div>
<div>
	Real name: <?php echo $userInfo['User']['first_name']; ?>
</div>
<div>
	Email: <?php echo $userInfo['User']['email_address']; ?>
</div>
<div>
	Signature: <?php echo $userInfo['User']['signature']; ?>
</div>
