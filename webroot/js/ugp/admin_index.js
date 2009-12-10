$(function() {
	function compareObject(x, y) {
	   var objectsAreSame = true;
	   for(var propertyName in x) {
		   if(typeof x[propertyName] == 'object' && typeof y[propertyName] == 'object')
		   {
			   if(!compareObject(x[propertyName], y[propertyName]))
			   {
				   objectsAreSame = false;
				   break;
			   }
		   }
		   else if(x[propertyName] !== y[propertyName]) {
	         objectsAreSame = false;
	         break;
	      }
	   }
	   return objectsAreSame;
	}
	
	function loading()
	{
		$("#core_accordion").unblock().block({message: '<img src="' +themeDir + 'img/big-loader.gif" />', css : {background: 'transparent', border: 0}});
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
		
		$('#core_acos').addClass('core_changes');
		$('#core_ugp_save').fadeIn('fast');
		return false;
	});	
	
	$('#core_cancel').click(function(){
		$('#core_acos li').each(function(i) {
			var data = $(this).data('permissions');
			
			if(typeof data.original != 'undefined')
			{
				data.permissions = $.extend(true, {}, data.original);
				$(this).data('permissions', data);
			}
		});
		
		var acoTreeReference = $.tree.reference('#core_acos');
		
		if(typeof acoTreeReference.selected != 'undefined')
			displayPermissions(acoTreeReference.selected, acoTreeReference);		
		
		$('#core_ugp_save').fadeOut('fast');
		return false;
	});
	
	$('#core_save').click(function(){
		var permissions = {};
		
		var aroTreeReference = $.tree.reference('#core_aros');
		
		if(typeof aroTreeReference.selected != 'undefined')
		{
			var aroNode = aroTreeReference.selected.attr('id');
			
			$('#core_acos li').each(function(i) {
				var data = $(this).data('permissions');
				
				if(!compareObject(data.permissions, data.original))
					permissions[this.id] = data.permissions;
			});
			
			var data = {
					'data[aroNode]': aroNode, 
					'data[permissions]': JSON.stringify(permissions)
			}
			
			$.post(rootLink + 'admin/ugp/savePermissions/', data, function (response) {
				console.log(response);
			});			
		}

		return false;
	});
	
	$('#core_accordion').accordion({autoHeight: false}).block({message: false, overlayCSS: {cursor: 'default'}});
	
	$('#core_aros').tree({
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
			beforechange: function(node, tree) {
				if($('#core_acos').hasClass('core_changes'))
				{
					return false;
				}
				
				return true;
			},
			onselect : function(node, tree) {
				var nodeId = node.id.split('_');
				
				loading();
				if(nodeId[0] == 'group')
				{
					$('#core_informationTab').load(rootLink + 'admin/groups/loadInformation/' + nodeId[1]);
				}
				else if(nodeId[0] == 'user')
				{
					$('#core_informationTab').load(rootLink + 'admin/users/loadInformation/' + nodeId[1]);
				}
				
				$.get(rootLink + 'admin/ugp/loadPermissions/' + node.id,
					null,
					function(response) {
						$.each(response, function(index) {
							this.original = $.extend(true, {}, this.permissions);
							$('#' + index).data('permissions', this);
						});
				
						var acoTreeReference = $.tree.reference('#core_acos');
						
						if(typeof acoTreeReference.selected != 'undefined')
							displayPermissions(acoTreeReference.selected, acoTreeReference);
						
						$('#core_accordion').unblock();
					}
				, 'json');
			},
			error : function (text, tree) {
				console.log(text);
			}
		}
	});
	
	$('#core_acos').tree({
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