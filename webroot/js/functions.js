$(function()
{
	if (flashMessage != '')
	{
		$.jGrowl(flashMessage);
	}

	if (authMessage != '')
	{
		authMessage = authMessage.replace('<div id="authMessage" class="message">', '');
		authMessage = authMessage.replace('</div>', '');
		$.jGrowl(authMessage);
	}

	$("#genericDialog").dialog({
		autoOpen: false,
		bgiframe: true,
		modal: true,
		title: '',
		width: "350px",
		draggable: false,
		//hide: 'fade',
		//show: 'fade',
		position: 'top',
		overlay: {
			backgroundColor: '#000',
			opacity: 0.7
		},
		resizable: false
	});

	$(".submit input, button").live('mouseover', function() {$(this).addClass('hover');});
	$(".submit input, button").live('mouseout', function() {$(this).removeClass('hover');});

	$('.dialogLink').live('click', function () {
			$("#genericDialog").html('<img src="'+rootlink+'img/ajax-loader.gif" alt="" />Loading...');

			$("#genericDialog").load($(this).attr('href'));

			$("#genericDialog").dialog('option', 'title', $(this).attr('title'));

			$("#genericDialog").dialog('open');
			return false;
		});

	$("#layoutSearch").bind('focus', function() {$(this).val(''); });
	$("#layoutSearch").bind('blur', function() {$(this).val('Search'); });

	if (typeof pageScript != 'undefined')
		pageScript(rootLink);

	$.alerts.okButton = 'Yes';
	$.alerts.cancelButton = 'No'; 
});