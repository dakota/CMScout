<?php echo $form->create('Plugin', array('action' => 'install'));?>
<?php foreach($categories as $category => $plugins) : ?>
	<h3><?php echo $category ?></h3>
	<div>
		<table width="100%">
			<tr>
				<th width="5%">Enabled</th>
				<th width="20%">Name</th>
				<th width="15%">Version</th>
				<th>Description</th>
			</tr>
			<?php foreach($plugins as $plugin):?>
				<tr>
					<td><?php echo $form->checkbox($plugin['Plugin']['name'] . ':' . $plugin['Plugin']['id'], array('checked' => (isset($plugin['Plugin']['database']['enabled']) && $plugin['Plugin']['database']['enabled'] ? 'checked' : false )));?></td>
					<td style="text-align:left;">
						<?php echo $plugin['Plugin']['title']?>
					</td>
					<td>
						<?php if(isset($plugin['Plugin']['database'])):?>
							<?php if ($plugin['Plugin']['version'] !== $plugin['Plugin']['database']['version']) : ?>
								Installed: <b><?php echo $plugin['Plugin']['database']['version']?></b><br />
								Available: <b><?php echo $plugin['Plugin']['version']?></b>
							<?php else : ?>
								<?php echo $plugin['Plugin']['version']?>
							<?php endif; ?>
						<?php else: ?>
							<?php echo $plugin['Plugin']['version']?>
						<?php endif; ?>
					</td>
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
					</td>
				</tr>
			<?php endforeach;?>			
		</table>
	</div>
<?php endforeach;?>
<?php echo $form->end('Save Plugins');?>