function pageScript(rootLink)
{
	function savePosition()
	{
		var jsonData = tree1.getJSON();
		var data = 'items=' + json_encode(jsonData);

		$.blockUI({message: '<img src="' +rootLink + '/img/throbber.gif" /> Saving...'});
		$.post(rootLink + 'admin/forums/saveSort', data, function(returnedText) {
			loading = false;
			$.unblockUI();
			$.jGrowl('Saved');
			tree1.refresh();
		});
	}

	function loadInformation(node)
	{
		var nodeId = node.id;

		if (typeof node.id != 'undefined')
		{
			$("#sideInfo").html('<img src="' +rootLink + '/img/throbber.gif" /> Loading...');
			$("#sideInfo").load(rootLink + 'admin/forums/loadInfo/' + nodeId, function () {});
		}
	}

	$("#save").click(function() {
		savePosition();
	});
	
 	tree1 = new tree_component(); 
 	tree1.init($("#forums"), { data : { 	
 				type : "json",
 				url: rootLink + "admin/forums/loadTree" 
 			},
 			lang : {
 				new_node: "New category/forum"
 			},
 			rules : { 
 				metadata : "metadata", 
 				use_inline : true, 
 				deletable: false,
 				clickable: ['category', 'forum'],
 				draggable : ['category', 'forum'], 
 				dragrules : [ "forum inside forum", "forum inside category","forum after forum", "forum before forum", "category after category", "category before category", 'category inside root'],
 				creatable: ['root', 'category', 'forum'],
 				renameable: ['category', 'forum']
 			}, 
 			callback : { 
 				onmove : function(node,tree_obj) {
 										$("#save").attr('disabled', '');
 									},
 				onchange: function(node, tree_obj) {
 						 				loadInformation(node);
 									},
 				error : function(TEXT, TREE_OBJ) { console.log(TEXT);}
 			}
 		}); 

	$("#addCategory").click(function(e){
		$("#newCatDialog").dialog('open');

		return false;
	});

	$("#addForum").click(function(e){
		$("#newForumDialog").dialog('open');

		return false;
	});
	
	$("#newCatDialog").dialog({
		autoOpen: false,
		bgiframe: true,
		height: 175,
		modal: true,
		title: 'Add new category',
		overlay: {
			backgroundColor: '#000',
			opacity: 0.5
		},
		buttons: {
			'Add': function() {
				$(this).dialog('close');
				

				var postData = 'title=' + $("#catTitle").val();

				$("#catTitle").val('');
				
				$.blockUI({message: '<img src="' +rootLink + '/img/throbber.gif" /> Saving...'});

				$.post(rootLink + 'admin/forums/addCategory', postData, function(data) {
					var data = eval('(' + data + ')');
					tree1.refresh(function(){$.unblockUI(); $.jGrowl('Saved')});
				});
				$(this).dialog('destroy');
			},
			'Cancel': function() {
				$(this).dialog('close');
				$(this).dialog('destroy');
			}
		}
	});	

	
	$("#newForumDialog").dialog({
		autoOpen: false,
		bgiframe: true,
		height: 420,
		modal: true,
		title: 'Add new forum',
		overlay: {
			backgroundColor: '#000',
			opacity: 0.5
		},
		buttons: {
			'Add': function() {
				$(this).dialog('close');

				var selectedId = $(tree1.selected).attr('id').split('_');
				
				if (selectedId[0] == 'cat')
				{
					var postData = 'title=' + $("#forumTitle").val() + '&description=' + $("#forumDescription").val() + '&category_id=' + selectedId[1];
				}
				else
				{
					var postData = 'title=' + $("#forumTitle").val() + '&description=' + $("#forumDescription").val() + '&forum_id=' + selectedId[1];
				}

				$("#forumTitle").val('');
				$("#forumDescription").val('');
				
				$.blockUI({message: '<img src="' +rootLink + '/img/throbber.gif" /> Saving...'});
				$.post(rootLink + 'admin/forums/addForum', postData, function(data) {
					var data = eval('(' + data + ')');
					tree1.refresh(function(){$.unblockUI(); $.jGrowl('Saved')});
				});
			},
			'Cancel': function() {
				$(this).dialog('close');
			}
		}
	});
}