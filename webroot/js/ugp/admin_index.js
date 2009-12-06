$(function() {
	function loading()
	{
		$("#tabs").unblock().block({message: '<img src="' +themeDir + 'img/big-loader.gif" />', css : {background: 'transparent', border: 0}});
	}
	
	function getPermissionName(data, permission)
	{
		var permissionName;
	
		if(data.AROmode == 'Group' && data.ACOmode == 'parent')
		{
			permissionName = (typeof data.permissions[permission] == 'undefined' || data.permissions[permission] == 0) ? 'deny' : 'allow';
		}
		else
		{
			permissionName = (typeof data.permissions[permission] == 'undefined' || data.permissions[permission] == 0) ? 'inherit' : (data.permissions[permission] == -1 ? 'deny' : 'allow');
		}
		
		return permissionName;
	}
	
	function displayPermissions(node, tree)
	{
		var $node = $(node);
		var permissions = $node.data('permissions');
		var permissionBlock = '<div class="core_permissionsBlock">';
	
		$.each(permissions.details, function(index){
			iconClass = getPermissionName(permissions, index);
			permissionBlock += '<div>';
			permissionBlock += '<a href="#" id="'+index+'" class="core_permissionIcon ' + iconClass +'">'+iconClass+'</a>&nbsp;';
			
			permissionBlock += this + '</div>';
		});
		
		permissionBlock += '</div>'
			
		$node.find('.core_permissionsBlock').remove().end().find('a:first').after(permissionBlock);
	}
	
	$('.core_permissionIcon').live('click', function(){
		var $this = $(this);
		var $node = $this.parents('li:first');
		var data = $node.data('permissions');
		var permissionIndex = this.id;
		var current = data.permissions[permissionIndex];
		var newPermission;
		
		if (data.permissions == 0)
		{
			data.permissions = {};
		}
		
		if(data.AROmode == 'Group' && data.ACOmode == 'parent')
		{
			data.permissions[permissionIndex] = (typeof data.permissions[permissionIndex] == 'undefined' || data.permissions[permissionIndex] == 0) ? 1 : 0;
		}
		else
		{
			data.permissions[permissionIndex] = (typeof data.permissions[permissionIndex] == 'undefined' || data.permissions[permissionIndex] == 0) ? 1 : (data.permissions[permissionIndex] == -1 ? 0 : -1);
		}
		
		$node.data('permissions', data);
		displayPermissions($node);
		
		return false;
	});	
	
	$('#tabs').tabs().block({message: false, overlayCSS: {cursor: 'default'}});
	
	$('#aros').tree({
		ui : {
			animation: 100
		},
		plugins : {
			metadata : {
				attribute : 'metadata'
			}
		},
		rules : {
			multiple : false,
			valid_children : ['group']
		},
		types : {
			group : {
				valid_children : ['user'],
				draggable : false
			},
			user : {
				valid_children: []
			}
		},
		callback : {
			onselect : function(node, tree) {
				var nodeId = node.id.split('_');
				
				loading();
				if(nodeId[0] == 'group')
				{
					$('#informationTab').load(rootLink + 'admin/groups/loadInformation/' + nodeId[1]);
				}
				else if(nodeId[0] == 'user')
				{
					$('#informationTab').load(rootLink + 'admin/users/loadInformation/' + nodeId[1]);
				}
				
				$.get(rootLink + 'admin/ugp/loadPermissions/' + node.id,
					null,
					function(response) {
						$.each(response, function(index) {
							$('#' + index).data('permissions', this);
						});
				
						var acoTreeReference = $.tree.reference('#acos');
						
						if(typeof acoTreeReference.selected != 'undefined')
							displayPermissions(acoTreeReference.selected, acoTreeReference);
						
						$('#tabs').unblock();
					}
				, 'json');
			},
			error : function (text, tree) {
				console.log(text);
			}
		}
	});
	
	$('#acos').tree({
		ui : {
			animation: 100
		},
		plugins : {
			metadata : {
				attribute : 'metadata'
			}
		},
		rules : {
			multiple : false,
			valid_children : ['ParentACO']
		},
		types : {
			'default' : {
				deletable : false,
				draggable : false,
				renameable : false
			}
		},
		callback : {
			onselect : displayPermissions,
			ondeselect : function(node, tree) {
				$(node).find('.core_permissionsBlock').remove();
			}
		}
	});
});