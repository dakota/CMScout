Dear <?php echo $receipientInfo['username']; ?> 

You indicated that you would like to be notified when a new user registers at the <?php echo Configure::read('CMScout.Core.SiteName');?> website.
	
A user with the username of <?php echo $receipientData['User']['username']; ?> just registered at the website.
	
Regards
	<?php echo Configure::read('CMScout.Core.SiteName');?> 