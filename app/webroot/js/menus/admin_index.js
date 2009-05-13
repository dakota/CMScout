function saveMenuLayout(rootLink)
{
	var postDataArray = [];
	$.jGrowl('Saving...');
	
	$(".menu").each(function (i) {
		var menuId = $(this).attr("id");
		var i = 1;
		$(this).children("li").each(function (u) {
			var tempPostData = '';
			if ($(this).hasClass('box'))
			{
				var title = $(this).children('.portlet').children('.portlet-header').children('.portlet-name').html();
				var option = $(this).children('.portlet').attr('rel');
				var sidebox_id = $(this).children('.portlet').attr('id').split('_');
				
				tempPostData = "mainMenu[" + menuId + "][" + i + "][name]=" + encodeURIComponent(title);
				tempPostData += "&mainMenu[" + menuId + "][" + i + "][option]=" + encodeURIComponent(option);
				tempPostData += "&mainMenu[" + menuId + "][" + i + "][sidebox_id]=" + sidebox_id[1];
				i++;
				
				postDataArray.push(tempPostData);
			}
			else
			{
				var menuLink_id = $(this).children("a").attr('id').split('_');

				tempPostData = "mainMenu[" + menuId + "][" + i + "][name]=" + encodeURIComponent($(this).children("a").text());
				tempPostData += "&mainMenu[" + menuId + "][" + i + "][option]=" + encodeURIComponent($(this).children("a").attr("rel"));
				tempPostData += "&mainMenu[" + menuId + "][" + i + "][menu_link_id]=" + menuLink_id[1];
				i++;
				
				postDataArray.push(tempPostData);
			}
		});
		
	});	

	var postData = postDataArray.join('&');
	
	$.post(rootLink + "admin/menus/saveMenu", postData, function(data, textstatus) 
		{
			$.unblockUI();	
			$.jGrowl("Saved");
			$(".menu a").unbind('click');
		});
}

function pageScript(rootLink)
{
	var counter = 0;
	var selectedItem = null;
	var timeout = 0;
	
	function saveTimeout()
	{
	    $(".menu a").bind('click', function(){
	    	$.jGrowl('Please wait for changes to be saved.');
	    	return false;
	    });	   
	    
		//clearTimeout(timeout);
		saveMenuLayout(rootLink);
	}
	
		$(".menu").sortable({tolerance: 'pointer', 
									connectWith: ["ul.menu"], 
									placeholder : "Dropper-Hover", 
									opacity: 0.75, 
									delay: 200,
									dropOnEmpty: true,
									forcePlaceholderSize: true,
									stop: function(e, ui) {
										$(ui.item).css("opacity", "1");
										$(ui.item).attr("style", "");			
									},
									update: function (e, ui) {
											var link = $(ui.item).children('a').attr('href').split('|');
											var editLink = link[1];
											
											var editArea = $('<span class="hoverAction" style="background-color:#fff;">'+
															'<a href="' + editLink + '"><img src="' + rootLink + '/img/edit.png" alt="Edit" border="0" class="editLink" /></a>'+
															'&nbsp;<a href="#"><img src="' + rootLink + '/img/remove.png" alt="Remove" border="0" class="removeLink" /></a></span>');
											
											$(ui.item).removeClass("draggable");
											$(ui.item).removeClass("ui-draggable");
											$(ui.item).removeClass("sidedraggable");
											$(ui.item).css("opacity", "1");
											$(ui.item).attr("style", "");
											$(ui.item).attr('id', $(ui.item).attr('id') + '_' + Math.random());
											$(ui.item).children('a').attr('href', link[0]);
											
											if ($(ui.item).hasClass('box') && $(ui.item).children('a').length > 0)
											{
												var title = $(ui.item).children('a').html();
												var rel = $(ui.item).children('a').attr('rel');
												var id = $(ui.item).children('a').attr('id');
												
												$(ui.item).html('<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" id="' + id + '" rel="' + rel + '">'+
												'<div class="portlet-header ui-widget-header ui-corner-all" rel="' + rel + '">'+
												'<span class="portlet-name">' + title + '</span>' +
												'</div>'+
												'</div>');				
											}
											$(ui.item).prepend(editArea);
											
											//$(".menu li").unbind('mouseenter').unbind('mouseleave');
											//$('.menu li').hover(showActions, hideActions);
											saveTimeout();
										},
									over: function(e,ui)
									{
										if ($(ui.item).hasClass('box') && !$(this).hasClass('sideboxes'))
										{
											$(ui.sender).sortable('cancel');
										}
									},
									receive: function (e, ui) {
											if (typeof ui.item != "undefined")
											{								
												if ($(ui.item).hasClass("box") && !$(this).hasClass('sideboxes'))
												{
													$(this).sortable('cancel');
												}
											}
									}});  						
		
		$(".draggable").draggable({helper: 'clone', opacity: 0.75, connectToSortable: 'ul.menu',
									start: function(e, ui) {
										$('.menu').addClass('dragTo');
									},
									stop: function(e,ui) {
										$('.menu').removeClass('dragTo');
									}
		});
		
		$(".sidedraggable").draggable({helper: 'clone', opacity: 0.75, connectToSortable: 'ul.sideboxes',
										start: function(e, ui) {
											$('.sideboxes').addClass('dragTo');
										},	
										stop: function(e, ui) {
											$('.sideboxes').removeClass('dragTo');
										}	
		});

		$(".menu").sortable("refresh"); 
		
	    $(".draggable a").bind('click', function(){return false;});
	    
		$("#actions").dialog({
			autoOpen: false,
			bgiframe: true,
			modal: true,
			title: 'Edit menu item',
			overlay: {
				backgroundColor: '#000',
				opacity: 0.5
			},
			resizable: false,
			buttons: {
				'Accept': function() {
					$(this).dialog('close');

					if (selectedId.find('.portlet').length > 0)
					{
						var item = selectedId.find('.portlet');
						var nameArea = item.children('.portlet-header').children('.portlet-name')
					}
					else
					{
						var item = selectedId.children('a');
						var nameArea = item;
					}
					
					nameArea.html($("#title").val());

					var rel = item.attr('rel').split(' ');

					item.attr('rel', rel[0] + ' ' + $(".option").val());
					
					saveTimeout();
				},
				'Cancel': function() {
					$(this).dialog('close');
				}
			}
		});
	    
	    //$('.menu li').hover(showActions, hideActions);

		$(".menu li").live('mouseenter', function(){$(this).find('.hoverAction').fadeIn('fast');});
		$(".menu li").live('mouseleave', function(){$(this).find('.hoverAction').fadeOut('fast');});
			    
	    $('.editLink').live('click', function(){
			selectedId = $(this).parents('li');
			var link = $(this).parent('a');
			var parentLink = selectedId.children('a');
			var portlet = selectedId.find('.portlet');

			if (portlet.length > 0)
			{
				var options = portlet.attr('rel').split(' ');
				var urlToLoad = 'admin/sideboxes/menu/' + options[0];
	
				$("#title").val(portlet.children('.portlet-header').children('.portlet-name').html());
				if (options[1] != '')
				{
					$("#options").show();
					$("#options").html('<img src="' + rootLink + 'img/throbber.gif" /> Loading...');
					$("#options").load(rootLink + urlToLoad, function() {
						$(".option").val(portlet.attr('rel'));
					});
				}
				else
				{
					$("#options").hide();
					$("#options").html('');
				}					
			}
			else
			{
				var loadLink = link.attr('href');

				$("#title").val(parentLink.html());
				if (loadLink != '#')
				{
					$("#options").show();
					$("#options").html('<img src="' + rootLink + 'img/throbber.gif" /> Loading...');
					$("#options").load(loadLink, function() {
						$(".option").val(parentLink.attr('rel'));
					});
				}
				else
				{
					$("#options").hide();
					$("#options").html('');
				}
			}			
						
			$("#actions").dialog('open');
	    	
	    	return false;
	    });
	    
	    $('.removeLink').live('click', function(){
			$(this).parents('li').remove();
			saveTimeout();
	    });    
}