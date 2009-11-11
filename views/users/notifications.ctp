<?php
	echo $form->create('NotificationUser', array('id' => 'notificationForm', 'url' => '/users/notifications/'));
	foreach ($notifications as $notification) :
?>
<?php echo $form->input($notification['Notification']['id'], array('label' => $notification['Notification']['title'], 'type'=>'checkbox'))?>
<?php endforeach; 
	echo $form->end('Update subscriptions');
	echo $javascript->link('jquery.form');
?>
<script type="text/javascript">
	$("#notificationForm").submit(function () {
		$(this).ajaxSubmit({
			beforeSubmit: function() {
				//$('#profileForm').html('Saving');
				$.jGrowl('Saving');
			},
			success: function(responseText, statusText) {
				$.jGrowl('Saved');
				$('#notificationForm').parent('div').load('<?php echo $html->url("/users/notifications"); ?>');
			}
		});
		
		return false;
	});
</script>