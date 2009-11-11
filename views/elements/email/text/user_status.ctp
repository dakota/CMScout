Dear <?php echo $receipientInfo['username']; ?> 

Your account on the <?php echo Configure::read('CMScout.Core.SiteName');?> website has been <?php echo $receipientInfo['active'] == 1 ? 'activated' : 'deactivated';?>.
<?php if ($receipientInfo['active'] == 1) : ?> 
This means that you will now be able to logon to the website by visiting <?php echo Router::url('/', true); ?>.
<?php else :?>  
This means that you will not be able to logon to the website until your account has been reactivated. If you believe your account was deactivated in error, please contact the webmaster at <?php echo Configure::read('CMScout.Email.SiteEmail');?> 
<?php endif;?> 
	
Regards
	<?php echo Configure::read('CMScout.Core.SiteName');?> 