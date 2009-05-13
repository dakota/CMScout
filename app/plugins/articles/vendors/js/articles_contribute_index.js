$(".actions").hide();

$("tr").bind('mouseenter', function() {
	$(this).find('.actions').fadeIn('fast');
});
$("tr").bind('mouseleave', function() {
	$(this).find('.actions').fadeOut('fast');
});