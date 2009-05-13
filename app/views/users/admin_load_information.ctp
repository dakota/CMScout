<?php 
echo $html->image("/img/remove.png", array("alt" => "Delete User", 'class' => 'deleteAjaxLink', 'style' => 'float: right;',
					'url' => array('controller' => 'users', 'action' => 'delete', 'prefix' => 'admin', $this->data['User']['id'])));

echo $html->image("/img/edit.png", array("alt" => "Edit User", 'class' => 'infoAjaxLink', 'style' => 'float: right; margin-right: 5px;',
					'url' => array('controller' => 'users', 'action' => 'edit', 'prefix' => 'admin', $this->data['User']['id'])));
?>
<div class="input text">
	<label><?php __('Username'); ?></label>
	<?php echo $this->data['User']['username']; ?>
</div>

<?php if ($this->data['User']['first_name'] != '') : ?>
	<div class="input text">
		<label><?php __('First Name'); ?></label>
		<?php echo $this->data['User']['first_name']; ?>
	</div>
<?php endif; ?>

<?php if ($this->data['User']['last_name'] != '') : ?>
	<div class="input text">
		<label><?php __('Last Name'); ?></label>
		<?php echo $this->data['User']['last_name']; ?>
	</div>
<?php endif; ?>

<div class="input text">
	<label><?php __('Email Address'); ?></label>
	<?php echo $this->data['User']['email_address']; ?>
</div>

<div class="input text">
	<label><?php __('Status'); ?></label>
	<?php echo $this->data['User']['active'] == '0' ? 
			'Inactive ' . 
				$html->image("/img/activate.png", array("alt" => "Activate", 'class' => 'infoAjaxLink reloadInfo', 
							'url' => array('controller' => 'users', 'action' => 'toggleStatus', 'prefix' => 'admin', $this->data['User']['id'])))
		: 'Active ' . 
				$html->image("/img/deactivate.png", array("alt" => "Deactivate", 'class' => 'infoAjaxLink reloadInfo', 
							'url' => array('controller' => 'users', 'action' => 'toggleStatus', 'prefix' => 'admin', $this->data['User']['id']))); 
				 ?>
</div>

