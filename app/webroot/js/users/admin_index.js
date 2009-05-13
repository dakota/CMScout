function pageScript(rootLink)
{
	var selectedARO = 0;
	var selectedACO = 0;
	var loading = false;
	
	tree2 = new tree_component();
 	tree2.init($("#acos"), {
 			rules : { 
 				metadata : "metadata", 
 				use_inline : true, 
 				deletable: 'none',
 				draggable: 'none',
 				clickable: ['ParentACO', 'ChildACO']
 			},
 			callback : { 
 				onchange : function(node,tree_obj) {
 										selectedACO = node.id;
 										if (selectedARO != 0 && selectedACO != 0 && typeof selectedARO != 'undefined' && typeof selectedACO != 'undefined')
 										{
 											var data = 'aco=' + selectedACO + '&aro=' + selectedARO;
 											loading = true;
 											$("#permissionTab").html('<img src="' +rootLink + '/img/throbber.gif" /> Loading...');
 											$.post(rootLink + 'admin/users/loadPermissions', data, function(responseText) {loading = false; drawMiddle(responseText);});
 										}
 									},
 				beforechange: function(NODE,TREE_OBJ) {return !loading;}
 			}
 			});

 	tree1 = new tree_component(); 
 	tree1.init($("#aros"), {
 			lang : {
 				new_node: "New group"
 			},
 			rules : { 
 				metadata : "metadata", 
 				use_inline : true, 
 				draggable: ['user'],
 				dragrules : [ "user inside group"],
 				creatable: ['root'],
 				clickable: ['group', 'user']
 			}, 
 			callback : { 
 				beforemove: function(node,ref_node,type,tree_obj) 
 									{
 										var userId = node.id.split("_");
 										var groupId = ref_node.id.split("_"); 										
 										if ($(ref_node).children('ul').children().is("#group_" + groupId[1] + "_user_" + userId[3]) || loading)
 										{
 											return false;
 										}
 										else
 										{
 											$(node).attr("id", "group_" + groupId[1] + "_user_" + userId[3]);
 											return true;
 										}
 									},
 				onchange : function(node,tree_obj) {
 								
 										selectedARO = node.id;
 										if (selectedARO != 0 && selectedACO != 0 && typeof selectedARO != 'undefined' && typeof selectedACO != 'undefined')
 										{
 											var data = 'aco=' + selectedACO + '&aro=' + selectedARO;
 											loading = true;
 											$("#permissionTab").html('<img src="' +rootLink + '/img/throbber.gif" /> Loading...');
 											$.post(rootLink + 'admin/users/loadPermissions', data, function(returnedText) {loading = false;drawMiddle(returnedText);});
 										}
 										
 										if (selectedARO != 0 && typeof selectedARO != 'undefined') 
 										{
	 										var id = node.id.split("_");
 										
	 										if (typeof id[2] == 'undefined' && id[0] == 'group')
	 										{
	 											$('#renameButton').attr('disabled', '');
	 											$('#deleteButton').attr('disabled', '');
	 											$('#deleteButton').html('Delete group');
	 											//$("#infoButton").html('Group information');
	 											
	 											$("#informationTab").html('<img src="' +rootLink + '/img/throbber.gif" /> Loading...');
	 											$("#informationTab").load(rootLink + 'admin/groups/loadInformation/' + id[1], function(returnedText) {loading = false;});
	 										}
	 										else if (id[0] != 'aro0')
	 										{
	 											$('#renameButton').attr('disabled', 'disabled');
	 											$('#deleteButton').attr('disabled', '');
	 											$('#deleteButton').html('Remove user from group');
	 											//$("#infoButton").html('User information');
	 											
	 											$("#informationTab").html('<img src="' +rootLink + '/img/throbber.gif" /> Loading...');
	 											$("#informationTab").load(rootLink + 'admin/users/loadInformation/' + id[3], function(returnedText) {loading = false;});
	 										}
	 										else
	 										{
	 											$('#renameButton').attr('disabled', 'disabled');
	 											$('#deleteButton').attr('disabled', 'disabled');
	 											//$("#infoButton").html('Information');
	 										}
	 										
	 										if ($(node).metadata()['deletable'] == false)
	 										{
	 											$('#deleteButton').attr('disabled', 'disabled');
	 										}
	
	 										if ($(node).metadata()['renamable'] == false)
	 										{
	 											$('#renameButton').attr('disabled', 'disabled');
	 										} 	
	 										
	 										if ($(node).metadata()['membersDeletable'] == true)
	 										{
	 											$('#deleteButton').attr('disabled', '');
	 										}
	 										
 										}									
 									},
 				beforechange: function(NODE,TREE_OBJ) {return !loading;},
 				onmove : function(NODE, REF_NODE, TYPE, TREE_OBJ) {saveUsers();},
 				oncopy : function(NODE, REF_NODE, TYPE, TREE_OBJ) {saveUsers();},
 				ondelete : function(node, TREE_OBJ) {
 										var id = $(node).attr('id').split("_");
 										if (typeof id[2] == 'undefined' && id[0] == 'group')
 										{
 											deleteGroup(id[1]);
 										}
 										else if (id[0] != 'aro0')
 										{
 											saveUsers();
 										}
 							},
 				onrename : function(NODE, LANG, TREE_OBJ) {renameGroup(NODE);},
 				error : function(TEXT, TREE_OBJ) { console.log(TEXT);}
 			}
 		}); 

	
	$(".infoAjaxLink").live('click', function(){
		$("#informationTab").html('<img src="' +rootLink + '/img/throbber.gif" /> Loading...');

		if ($(this).hasClass('reloadInfo'))
		{
			$.get($(this).parent('a').attr('href'), function(resultText) {
				$('#informationTab').load(resultText);
			});
		}
		else
		{
			$('#informationTab').load($(this).parent('a').attr('href'));
		}
		
		return false;
	});
	
	$(".deleteAjaxLink").live('click', function (){
		$.get($(this).parent('a').attr('href'), function(resultText) {
			//$("#aros").load(rootLink + 'admin/users/admin_loadAroTree');
			$('#informationTab').html('No item loaded');
			$('#permissionTab').html('No item loaded');
			tree1.remove(null, true);
			$.jGrowl('Deleted');
		});
		
		return false;
	});
	
	$("form").live('submit', function (){
		var postData = {};
		$.blockUI({message: '<h1>Please wait...</h1>'});
		
		$(this).find('input[type!=submit]').each(function(i){
			if (!($(this).val() == '' && $(this).attr('id') == 'clear_password'))
				postData[$(this).attr('name')] = $(this).val();
		});
		
		$.post($(this).attr('action'), postData, function (responseText) {
			$.unblockUI();
			console.log(responseText);
			if (responseText['ok'] != "true")
			{
				$.each(responseText, function (i, val) {
					$("#" + i).after('<div class="errorMessage">' + val + '</div>');
					$("#" + i).parent('div').children('label').addClass('errorText');
				});
				$("label:not(.errorText)").addClass("successText");
			} 
			else
			{
				$('#informationTab').load(responseText['url']);
				$.jGrowl("Saved.");
			}
		}, 'json');
		
		return false;
	});
	
	$("#permissions").hide();

	$("#tabs").tabs({
		selected: 0
		//spinner: '<img src="' +rootLink + '/img/throbber.gif" /> loading...'
	});	
	
	function drawMiddle(responseText)
	{		
		$("#permissionTab").html(responseText)
		
		$("#saveButton").click(function() {
				var data = 'aco=' + selectedACO + '&aro=' + selectedARO;
				$("#permissionTab select").each(function(index, domElement){
						data += '&' + domElement.id + '=' + $(domElement).val();
					});
				loading = true;
				
				$.blockUI({message: '<img src="' +rootLink + '/img/throbber.gif" /> Saving...'});
				$.post(rootLink + 'admin/users/updatePermissions', data, function(returnedText) {
					$.post(rootLink + 'admin/users/loadPermissions', data, function(responseText) {
						$.unblockUI();
						loading = false;
						$.jGrowl('Saved');
						drawMiddle(responseText);
					});
				});
				return false;
			});
	}
	
	function saveUsers()
	{
		var data = '';
		loading = true;
		$("#aros li").each(function(index, domElement) {
								data += 'item[]=' + domElement.id + '&';  
							});
		$.post(rootLink + 'admin/users/updateUserGroups', data.substring(0,data.length-1), function(returnedText) {
				loading = false;
				tree1.refresh();

				$.jGrowl('Saved');
			});
	}
	
	function newGroup()
	{
		var groupName = 'name=New Group';
		loading = true;
		$.blockUI({message: '<img src="' +rootLink + '/img/throbber.gif" /> Loading...'});
		$.post(rootLink + 'admin/groups/newGroup', groupName, function(returnedText) {
				loading = false;
				
				$("#aros").load(rootLink + 'admin/users/loadAroTree', function() {
					tree1.refresh();
					tree1.select_branch($('#group_' +  returnedText.replace(/^\s+|\s+$/g, '')).children("a:eq(0)"));
					$.unblockUI();
					$.jGrowl('Saved');
				});
			});
	}

	function deleteGroup(id)
	{
		loading = true;
		$.blockUI({message: '<img src="' +rootLink + '/img/throbber.gif" /> Deleting...'});
		$.post(rootLink + 'admin/groups/deleteGroup', 'id=' + id, function(returnedText) {
			loading = false;
			
			$("#aros").load(rootLink + 'admin/users/loadAroTree', function() {
				tree1.refresh();
				$.unblockUI();
				$.jGrowl('Deleted');
			});			
		});
	}

	function renameGroup(node)
	{
		var id = $(node).attr('id').split("_");
		var groupName = 'name=' + $(node).children('a').html() + '&id=' + id[1];
		loading = true;
		$.blockUI({message: '<img src="' +rootLink + '/img/throbber.gif" /> Renaming...'});
		$.post(rootLink + 'admin/groups/renameGroup', groupName, function(returnedText) {
			loading = false;

			$("#aros").load(rootLink + 'admin/users/loadAroTree', function() {
				tree1.refresh();
				$.unblockUI();
				$.jGrowl('Renamed');
			});	
		});
	} 	
 	
	$("#deleteButton").click(function() {
			tree1.remove();
			return false;
		});

	$("#renameButton").click(function() {
			tree1.rename();
			return false;
		});

	$("#newGroupButton").click(function() {
			newGroup();
			return false;
		});
	

	$('#filterInput').liveUpdate('#aros', '.leaf').focus();
}