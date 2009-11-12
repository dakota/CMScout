<?php echo $form->create('Plugin', array('action' => 'install'));?>
<?php foreach($categories as $category => $plugins) : ?>
	<h3><?php echo $category ?></h3>
	<div>
		<table width="100%">
			<tr>
				<th>Enabled</th>
				<th>Name</th>
				<th>Version</th>
				<th>Description</th>
			</tr>
			<?php foreach($plugins as $plugin):?>
				<tr>
					<td><?php echo $form->checkbox($plugin['Plugin']['name'] . ':' . $plugin['Plugin']['id']);?></td>
					<td><?php echo $plugin['Plugin']['title']?></td>
					<td><?php echo $plugin['Plugin']['version']?></td>
					<td style="text-align:left;">
						<div class="pluginAuthor"><?php echo $plugin['Plugin']['description']?></div>
						<div class="pluginAuthor">Author: <b><?php echo $plugin['Plugin']['author']?></b></div>				
						<?php if(isset($plugin['Plugin']['Requires'])):?>
							<div class="pluginRequirements">
								Depends on: <b>
									<?php 
										$requires = array();
										foreach($plugin['Plugin']['Requires'] as $require)
										{
											switch($require['type'])
											{
												case 'plugin' :
													break;
												case 'type' :
													$requires[] = 'Any plugin that can';
													break;
											}
										}
										
										echo implode(', ', $requires);
									?>
									</b>
							</div>
						<?php endif;?>
						<?php pr($plugin);?>
					</td>
				</tr>
			<?php endforeach;?>			
		</table>
	</div>
<?php endforeach;?>
<?php echo $form->end('Save Plugins');?>