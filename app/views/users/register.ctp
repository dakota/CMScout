<?php
    echo $form->create('User', array('action' => 'register'));
    echo $form->input('username', array('id' => 'username'));
    echo $form->input('clear_password', array('type' => 'password', 'label' => 'Password', 'id' => 'clear_password'));
    echo $form->input('password_confirm', array('type' => 'password', 'id' => 'password_confirm'));
    echo $form->input('email_address', array('id' => 'email_address'));
    echo $form->end('Register');
?>
<?php if (isset($ajaxLoad) && $ajaxLoad == true) {
?>
<?php 
	echo $javascript->link('jquery.form');
	echo $javascript->link('jquery.blockui');
?>
<script type="text/javascript">
	$('#UserRegisterForm').ajaxForm( {dataType: 'json', beforeSubmit: validate, success: successCallback } );

	function validate(formData, jqForm, options)
	{
		$("#genericDialog").block({message: '<h1>Please wait...</h1>'});
		$(".errorMessage").remove();
		$(".errorText").removeClass("errorText");
		$(".successText").removeClass("successText"); 
		return true;
	}

	function successCallback(responseText, statusText)
	{
		$("#genericDialog").unblock();

		if (responseText != "true")
		{
			$.each(responseText, function (i, val) {
				$("#" + i).after('<div class="errorMessage">' + val + '</div>');
				$("#" + i).parent('div').children('label').addClass('errorText');
			});
			$("label:not(.errorText)").addClass("successText");
		} 
		else
		{
			$("#genericDialog").dialog('close');
			$.jGrowl("Your account has been created. You can now login");
		}
	}
</script>
<?php }?>