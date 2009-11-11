<?php echo $form->create('Theme', array('type' => 'file', 'action' => 'install')); ?>
<?php if (count($notInstalledThemes) > 0) : ?>
<?php echo $form->input('install_type', array('id' => 'install_type', 'options' => array('Upload and install', 'Pre-uploaded'), 'multiple' => false, 'label' => 'Select install type'))?>
<?php endif; ?>

<div id="upload">
<?php echo $form->input('file', array('label' => 'Theme zip file', 'type' => 'file')); ?>
</div>

<?php if (count($notInstalledThemes) > 0) : ?>
<div id="preupload">
	<?php echo $form->input('themes', array('options' => $notInstalledThemes, 'multiple' => false))?>
</div>
<?php endif; ?>
<br />
<?php echo $form->end(array('label' => 'Install')); ?>

<?php if (count($notInstalledThemes) > 0) : ?>
<script type="text/javascript">
	if ($('#install_type').val() == 0)
		$("#preupload").hide();
	else
		$("#upload").hide();		

	$("#install_type").change(function() {
			if ($(this).val() == 0)
			{
				$("#upload").show();
				$("#preupload").hide();
			}
			else
			{
				$("#upload").hide();
				$("#preupload").show();
			}
		});
</script>
<?php endif; ?>