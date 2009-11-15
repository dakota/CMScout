$(function()
{
	$.metadata.setType("attr", "metadata")

	$(".draggable").draggable({
		helper: 'clone',
		opacity: 0.75,
		connectToSortable: 'ul.menu',
		start: function(e, ui) {
			$('.menu').addClass('dragTo');
		},
		stop: function(e,ui) {
			$('.menu').removeClass('dragTo');
		}
	});

	$(".sidedraggable").draggable({
		helper: 'clone',
		opacity: 0.75,
		connectToSortable: 'ul.sideboxes',
		start: function(e, ui) {
			$('.sideboxes').addClass('dragTo');
		},
		stop: function(e, ui) {
			$('.sideboxes').removeClass('dragTo');
		}
	});

	$(".menu").sortable({
		tolerance: 'pointer',
		connectWith: [".menu"],
		placeholder : "Dropper-Hover",
		opacity: 0.75,
		delay: 200,
		dropOnEmpty: true,
		forcePlaceholderSize: true,
		stop: function(e, ui) {
			$(ui.item).css("opacity", "1").attr("style", "");
		},
		update: function (e, ui) {
			if (ui.sender == null)
			{
				var $uiItem = $(ui.item);
				var $link = $uiItem.children('a');
				var link = $link.attr('href');
				var editLink = $link.metadata().editLink;
				var menuData = $link.metadata();
				menuData.link = link;

				$uiItem.removeClass("draggable").removeClass("ui-draggable").removeClass("sidedraggable").css("opacity", "1").attr("style", "").attr('id', new Date().getTime());

				var title = menuData.itemInfo.title;
				
				if (menuData.isbox == true)
				{
					$uiItem.html('<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">'+
					'<div class="portlet-header ui-widget-header ui-corner-all">'+
					'<span class="portlet-name">' + title + '</span>' +
					'</div>'+
					'</div>');
					//$uiItem.addClass('notSaved');
				}
				else
				{
					//$link.addClass('notSaved');
				}

				if ($uiItem.children("span.hoverAction").length == 0)
				{
					var editArea = $('<span class="hoverAction" style="background-color:#fff;">'+
							'<a href="' + editLink + '"><img src="' + themeDir + 'img/edit.png" alt="Edit" border="0" class="editLink" /></a>'+
							'&nbsp;<a href="#"><img src="' + themeDir + 'img/remove.png" alt="Remove" border="0" class="removeLink" /></a></span>');

					$uiItem.prepend(editArea);
				}

				$uiItem.data('menuData', menuData);
			}
		},
		over: function(e,ui)
		{
			var $uiItem = $(ui.item);
			var menuData = $uiItem.data('menuData');
	
			if(typeof menuData != 'undefined')
			{
				if (menuData.isbox == true && !$(this).hasClass('sideboxes'))
				{
					$(ui.sender).sortable('cancel');
				}
			}
		}
	});

	$(".menu li").live('mouseenter', function(){$(this).find('.hoverAction').fadeIn('fast');});
	$(".menu li").live('mouseleave', function(){$(this).find('.hoverAction').fadeOut('fast');});

	$('a').live('click', function(){return false;});
});

/*$(function()
{
	var saveQueue = function(item) {
	    var that = this;
	    $item = item[1];
	   
	    switch(item[0])
	    {
	    	case "move" : 
			    $item.children('a').bind('click.saving', function(){return false;});
			    
			    var menuId = $item.parent('ul').attr('id');
			    var previousId = $item.prev('li').attr('id');
			    var currentId = $item.attr('id');
			    
				$.post(controllerLink + 'move/menuId:'+menuId+'/previousId:'+previousId+'/currentId:'+currentId, $item.data('menuData'), function(response) {
					if (response != '' && !isNaN(response))
					{
						$item.attr('id', response);
					}
					$.qqNext(that.id);
				});	
			    
	    		break;
	    	case "delete" :
	    		var id = $item.attr('id');
	    		
	    		$.get(controllerLink + 'remove/id:' + id, function() {
	    			$.qqNext(that.id);
	    		});
	    		break;
	    	case "change":
	    		var id = $item.attr('id');
	    		$.post(controllerLink + 'update/id:' + id, $item.data('menuData'), function(response) {
					if (response != '')
					{
						$item.children('a').attr('href', response);
					}
	    			$.qqNext(that.id);
	    		});
	    		break;
	    }
	  };
	var doneQueue = function() {
		$.jGrowl('Saved');
		$('a').unbind('.saving');
	};	
	
	var queue_id = $.qq({ oneach: saveQueue, ondone: doneQueue, delay: null });	
	var counter = 0;
	var selectedItem = null;
	var timeout = 0;
	
	$(".menu").sortable({tolerance: 'pointer', 
								connectWith: ["ul.menu"], 
								placeholder : "Dropper-Hover", 
								opacity: 0.75, 
								delay: 200,
								dropOnEmpty: true,
								forcePlaceholderSize: true,
								stop: function(e, ui) {
									$(ui.item).css("opacity", "1").attr("style", "");			
								},
								update: function (e, ui) {
										if (ui.sender == null)
										{
											var $uiItem = $(ui.item);
											var link = $uiItem.children('a').attr('href').split('|');
											var editLink = link[1];
											var menuData = {};
								
											$uiItem.removeClass("draggable");
											$uiItem.removeClass("ui-draggable");
											$uiItem.removeClass("sidedraggable");
											$uiItem.css("opacity", "1");
											$uiItem.attr("style", "");
											$uiItem.attr('id', $(ui.item).attr('id') + '_' + Math.random());
											$uiItem.children('a').attr('href', link[0]);
	
											var title = $uiItem.children('a').text();
											var id = $uiItem.children('a').attr('id').split('_');
											var rel = $uiItem.children('a').attr('rel');
											
											if ($uiItem.hasClass('box') && $uiItem.children('a').length > 0)
											{
												
												menuData['isBox'] = true;
												menuData['boxId'] = id[1];
												menuData['option'] = rel;											
												menuData['name'] = title;											
												
												$uiItem.html('<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">'+
												'<div class="portlet-header ui-widget-header ui-corner-all">'+
												'<span class="portlet-name">' + title + '</span>' +
												'</div>'+
												'</div>');				
											}
											else
											{
												menuData['isBox'] = false;
												menuData['name'] = title;
												menuData['linkId'] = id[1];
												menuData['option'] = rel;
											}
											
											if ($uiItem.children("span.hoverAction").length == 0)
											{
												var editArea = $('<span class="hoverAction" style="background-color:#fff;">'+
														'<a href="' + editLink + '"><img src="' + themeDir + 'img/edit.png" alt="Edit" border="0" class="editLink" /></a>'+
														'&nbsp;<a href="#"><img src="' + themeDir + 'img/remove.png" alt="Remove" border="0" class="removeLink" /></a></span>');
		
												$uiItem.prepend(editArea);
											}
											
											$uiItem.data('menuData', menuData);
											
											$.qqAdd(queue_id, ['move', $uiItem]);
										}
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
					var newName = $("#title").val();
					
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
					
					nameArea.html(newName);
					var menuData = selectedId.data('menuData');
					menuData['name'] = newName;
					menuData['option'] = $(".option", this).val();
					
					$.qqAdd(queue_id, ['change', selectedId]);
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
			var $options = $("#options");
			var itemOptions = selectedId.data('menuData');
			console.log(selectedId);
			if (typeof itemOptions == 'undefined')
			{
				itemOptions = selectedId.metadata({type: 'attr',name: 'data'});
				selectedId.data('menuData', itemOptions);
			}
			
			if (portlet.length > 0)
			{
				var urlToLoad = '#';
			}
			else
			{
				var urlToLoad = link.attr('href');
			}			
						
			$("#title").val(itemOptions['name']);
			if (urlToLoad != '#')
			{
				$options.show();
				$options.html('<img src="' + themeDir + 'img/throbber.gif" /> Loading...');
				$options.load(urlToLoad, function() {
					$(".option").val(itemOptions['option']);
				});
			}
			else
			{
				$options.hide();
				$options.html('');
			}

			$("#actions").dialog('open');
	    	
	    	return false;
	    });
	    
	    $('.removeLink').live('click', function(){
			$(this).parents('li').fadeOut('fast', function(){$(this).remove()});
			$.qqAdd(queue_id, ['delete', $(this).parents('li')]);
	    });    
});*/