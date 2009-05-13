<?php
	echo $form->create('User', array('id' => 'profileForm', 'action' => 'profileEdit', 'type' => 'file'));
	echo '<fieldset class="pretty"><legend><h2>Personal details</h2></legend>';
	echo $form->input('first_name', array('id' => 'first_name'));
	echo $form->input('last_name', array('id' => 'last_name'));
	echo $form->input('email_address', array('id' => 'email_address'));
	echo "</fieldset>";
	 
	echo '<fieldset class="pretty"><legend><h2>Profile customisation</h2></legend>';
	 
	if (isset($this->data['User']['avatar']) && file_exists(WWW_ROOT . 'avatars' . DS . $this->data['User']['avatar'])):
?>
	 	<div class="input text">
	 		<label>You current avatar: </label>
	 		<span class="avatar"><?php echo $html->image('/avatars/' . $this->data['User']['avatar']); ?></span>
	 	</div>
<?php	
	endif;

	echo $form->input('avatar', array('type' => 'file', 'id' => 'avatar'));
	echo $form->input('signature', array('id' => 'signature'));
	echo "</fieldset>";
	 
	echo '<fieldset class="pretty"><legend><h2>Privacy</h2></legend>';
	echo $form->input('public_profile', array('label' => 'Enable public profile'));
	echo $form->input('show_name', array('label' => 'Show your real name on your public profile'));
	echo $form->input('show_email', array('label' => 'Show your email address on your public profile'));
	echo "</fieldset>";

	echo '<fieldset class="pretty"><legend><h2>Change password</h2></legend>';
	echo $form->input('oldpassword', array('label' => 'Old password', 'type' => 'password', 'value' => '', 'id' => 'oldpassword'));
	echo $form->input('clear_password', array('label' => 'New password', 'type' => 'password', 'value' => '', 'id' => 'clear_password'));
	echo $form->input('password_confirm', array('label' => 'Retype password', 'type' => 'password', 'value' => '', 'id' => 'password_confirm'));	 
	echo "</fieldset>";
	
	echo $form->end('Update');
	echo $javascript->link('jquery.form');
?>
<script type="text/javascript">
	$("#profileForm").submit(function () {
		$(this).ajaxSubmit({
			beforeSubmit: function() {
				//$('#profileForm').html('Saving');
				$(".error").remove();
				$.jGrowl('Saving');
			},
			success: function(responseText, statusText) {
				console.log(responseText);
				if (responseText['allOk'] == true)
				{
					$.jGrowl('Saved');
					$('#profileForm').parent('div').load('<?php echo $html->url("/users/profileEdit"); ?>');
				}
				else
				{
					$.jGrowl('Errors found');
					$.each(responseText, function (id, value) {
						$("#" + id).after('<div class="error">' + value + '</div>');
					});
				}
			},
			dataType:  'json'
		});

		
		return false;
	});
</script>
