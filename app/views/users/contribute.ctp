<div id="contributeAccordion">
	<?php 
	foreach ($contributions as $contribution) :
	?>
		<h3><a href="<?php echo $html->url("/" . $contribution['Plugin']['directory'] . '/' . $contribution['Contribution']['controller'] . '/contributeIndex/' . $contribution['Contribution']['id']); ?>"><?php echo $contribution['Contribution']['title']; ?></a></h3>
		<div></div>
	<?php 
	endforeach;
	?>
</div>

<script type="text/javascript">
	var firstDiv = $("#contributeAccordion").find('div:first');
	firstDiv.html('Loading').load($("#contributeAccordion").find('a:first').attr('href'));
	$("#contributeAccordion").accordion({
											autoHeight: false,
											change: function(event, ui) {
												ui.newHeader.next().html('Loading').load(ui.newHeader.find('a').attr('href'));
												ui.oldHeader.next().html('');
											}
										});


	$(".deleteLink").live('click', function() {
		$.get($(this).attr('href'), function() {
			$.jGrowl('Deleted');
			$(".ui-accordion-content-active").load($(".ui-accordion-content-active").prev().children('a').attr('href'));
		});
		return false;
	});
		
	$("#addLink").live('click', function() {
		//$(".ui-tabs-panel:visible").load($(this).attr('href'));
		//return false;
	});

	$("#ajaxForm").live('submit', function() {
		return false;
	});
</script>