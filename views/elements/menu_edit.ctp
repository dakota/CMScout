<li class="menuTemplate"><a href="{link}">{title}</a></li>
<?php if($hasBoxes === true): ?>
	<li class="menuTemplate boxTemplate">
		<div class="portlet ui-widget ui-widget-content ui-helper-clearfix ui-corner-all">
			<div class="portlet-header ui-widget-header ui-corner-all">
				<span class="portlet-name">{title}</span>
			</div>
		</div>	
	</li>
<?php endif; ?>