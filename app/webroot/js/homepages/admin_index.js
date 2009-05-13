function saveItems(rootLink) {
	var items = '';
	$.jGrowl('Saving...');
	$(".column").each(function(columnIndex) {
		var column = $(this).attr('id');

		$(this).children().each(function(i) {
			var options = $(this).find('.option').val();
			var id = $(this).attr('id');
			var name = $(this).find('.portlet-name').html();
			
			if (options == 'undefined' || typeof options == "undefined") { options = $(this).find('.option').html(); }
			if (options == 'undefined' || typeof options == "undefined" || options == 'null' || typeof options == "null") { options = ''; }
			
			items += 'items[' + columnIndex + ']['+i+'][name]=' + name + 
					'&items[' + columnIndex + ']['+i+'][menu_link_id]=' + id + 
					'&items[' + columnIndex + ']['+i+'][options]=' + options + '&';
		});
	});
	
	$.post(rootLink + 'admin/homepages/save', items, function() {
		$.unblockUI();
		$.jGrowl('Saved');	
	});
}

function pageScript(rootLink)
{
	function loadItems()
	{
		$(".column").each(function(columnIndex) {
			$(this).children().each(function(i) {
				var urlToLoad = $(this).attr('rel');
				var options = $(this).find('.infoSpan').html();
				
				if (urlToLoad != "/")
					$(this).find('.portlet-content').load(rootLink + 'admin/' + urlToLoad, function()
							{
								$(this).find('.option').val(options);
							});
			});
		});	
	}

	loadItems();
	
	var timeout = 0;
	function saveTimeout()
	{
		clearTimeout(timeout);
		timeout = setTimeout("saveItems(rootLink)", 1000);
	}

	
	$(".column").sortable({
		connectWith: ['.column'],
		containment: "#homepageArea",
		handle: ".portlet-header",
		delay: 150,
		revert: true,
		update: function(e,ui) {
					saveTimeout();
				}
	});

	$(".portlet").addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
		.find(".portlet-header")
			.addClass("ui-widget-header ui-corner-all")
			.prepend('<span class="ui-icon ui-icon-close"></span>')
			.end();

	$(".portlet-header .ui-icon").live('click', function() {
		$(this).parents(".portlet:first").fadeOut('slow', function(){$(this).remove();saveTimeout();});
	});

	$(".portlet-header .ui-icon").live('mouseover', function() {
		$(this).addClass('ui-icon-closethick');
		$(this).removeClass('ui-icon-close');
	});

	$(".portlet-header .ui-icon").live('mouseout', function() {
		$(this).addClass('ui-icon-close');
		$(this).removeClass('ui-icon-closethick');
	});

	var itemIds = 0;

	$(".module").click(function() {
		var title = $(this).children('span').html();
		var rel = $(this).children('span').attr('rel');
		var urlToLoad = 'admin/' + $(this).children('span').attr('rel');
		var itemIds = $(this).children('span').attr('id');
		
		if ($(this).hasClass('noLoad'))
		{
			$("#firstColumn").append(
					'<div id="' + itemIds + '" style="display:none;" class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" rel="' + rel + '">'+
					'<div class="portlet-header ui-widget-header ui-corner-all">'+
					'<span class="ui-icon ui-icon-close"/>'+
					'<span class="portlet-name">' + title + '</span>' +
					'</div>'+
					'<div class="portlet-content">'+
					'No options' +
					'</div>'+
					'</div>'
			);
		
			$('#' + itemIds).fadeIn('slow');
		}
		else
		{
			$("#firstColumn").append(
					'<div id="' + itemIds + '" style="display:none;" class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" rel="' + rel + '">'+
					'<div class="portlet-header ui-widget-header ui-corner-all" rel="' + rel + '">'+
					'<span class="ui-icon ui-icon-close"/>'+
					'<span class="portlet-name">' + title + '</span>' +
					'</div>'+
					'<div class="portlet-content">'+
					'<img src="' +rootLink + '/img/throbber.gif" /> Loading...' +
					'</div>'+
					'</div>'
			);
		
			$('#' + itemIds).fadeIn('slow');
			
			$('#' + itemIds + ' .portlet-content').load(rootLink + urlToLoad);
		}
		
		saveTimeout();
		itemIds++;
	});
	
	$('.option').live('change', function(){saveTimeout();});
}