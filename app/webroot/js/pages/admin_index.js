function pageScript(rootLink)
{
	 $("tr.hasHoverAction").hover(function() {
         $(this).find('.hoverAction').fadeIn('fast');  
     },function(){
    	 $(this).find('.hoverAction').fadeOut('fast');    	 
     });

	$(".deleteLink").click(function() {
		$.get($(this).parent('a').attr('href'), function() {
			$.jGrowl('Deleted');
			$("#contentArea").load(rootLink + 'admin/pages/index');
		});
		return false;
	});
	
	$(".restoreLink").click(function() {
		$.get($(this).parent('a').attr('href'), function() {
			$.jGrowl('Restored');
			$("#contentArea").load(rootLink + 'admin/pages/trash');
		});
		return false;
	});
	
	$(".hardDeleteLink").click(function() {
		var item = $(this).parents('div').siblings('span').text();
		var _this = this;
		
		$.blockUI({message: '<h3>Are you sure you wish to permentally delete <em>' + item + '<em>?</h3>' +
								'<button id="yes">Yes</button>&nbsp;&nbsp;&nbsp;<button id="no">No</button>'});
		$("#yes").click(function(){
			$.get($(_this).parent('a').attr('href'), function() {
				$.unblockUI();
				$.jGrowl('Deleted');
				$("#contentArea").load(rootLink + 'admin/pages/trash');
			});
		});
		$("#no").click(function(){
			$.unblockUI();
		});
		return false;
	});	
}