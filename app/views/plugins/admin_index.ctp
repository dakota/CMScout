<?php foreach($categories as $category => $plugins) : ?>
	<h3><?php echo $category ?></h3>
	<div>
		<ul>
			<?php foreach($plugins as $plugin):?>
				<li>
					<?php echo $form->input($plugin['Plugin']['folder'], array('type' => 'checkbox', 'label' => $plugin['Plugin']['title']));?>
					<div class="description" style="margin-left: 1.8em;">
						Version: <b><?php echo $plugin['Plugin']['version'];?></b>
						<?php if(isset($plugin['Plugin']['Requires'])):?>
							<br />
							This plugin requires the following: <br />
							<ul>
								<?php foreach($plugin['Plugin']['Requires'] as $require):?>
									<li>
										<?php 
											switch($require['type'])
											{
												case 'plugin' :
													break;
												case 'type' :
													echo 'Any plugin that can';
													break;
											}
										?>
									</li>
								<?php endforeach;?>
							</ul>
						<?php endif;?>
					</div>
					<?php pr($plugin);?>
				</li>
			<?php endforeach;?>
		</ul>
	</div>
<?php endforeach;?>