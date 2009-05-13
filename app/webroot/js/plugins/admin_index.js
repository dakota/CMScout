function pageScript(rootLink)
{
	$("tr").bind('mouseenter', function() {
		$(this).find('.actions').fadeIn('fast');
	});
	$("tr").bind('mouseleave', function() {
		$(this).find('.actions').fadeOut('fast');
	});

	$(".deleteLink").click(function() {
		$.get($(this).attr('href'), function() {
			$.jGrowl('Deleted');
			$("#contentArea").load(rootLink + 'admin/plugins/index');
		});
		return false;
	});
}