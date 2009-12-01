<h2>Public profile for <?php echo $profileInfo['User']['username'];?></h2>
<div style="float: right;">
	<?php echo $html->image('/avatars/' . $profileInfo['User']['avatar']); ?>
</div>
<div>
	Username: <?php echo $profileInfo['User']['username']; ?>
</div>
<div>
	Real name: <?php echo $profileInfo['User']['first_name']; ?>
</div>
<div>
	Email: <?php echo $profileInfo['User']['email_address']; ?>
</div>
<div>
	Signature: <?php echo $profileInfo['User']['signature']; ?>
</div>
