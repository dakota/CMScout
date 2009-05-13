<?php 
	$javascript->link('/photos/js/swfupload', false);
	$javascript->link('/photos/js/swfupload.queue', false);
	$javascript->link('/photos/js/jquery.lightbox', false);
	
	$html->css('ui.theme/ui.progressbar', null, array(), false);
	$html->css('/photos/css/jquery.lightbox', null, array(), false);
	$html->css('/photos/css/swfupload', null, array(), false);
	$html->css('/photos/css/photoAlbum', null, array(), false);
	?>
<a href="#" id="addPhotos">Add photos</a>

<div id="uploadPhoto" style="position: relative;display: none;margin-bottom: 10px;">
	<div class="button">
		<span id="spanButtonPlaceholder"></span>
		<button id="btnUpload" style="width: 120px; height: 22px;">Select Files</button>
		&nbsp;<button id="startUpload" style="height: 22px;">Upload files</button>
		&nbsp;<button id="cancel" style="height: 22px;">Cancel</button>
	</div>
	<div id="fileProgressContainer" style="display: none;"></div>
	<ul id="fileListContainer"></ul>
</div>

<ul id="photoThumbnails">
<?php
	foreach($album['Photo'] as $photo)
	{
?>
		<li class="photoBlock" id="<?php echo $photo['id']; ?>_block">
			<div id="<?php echo $photo['id']; ?>_edit"  style="position: absolute; z-index:2; color: #fff; padding: 5px;display: none;">
				<?php echo $html->link(
				    $html->image("/img/edit.png", array("alt" => "Edit", 'border' => '0')),
				    "/photos/editPhoto/" . $photo['id'],
				    array(
				    	'class' => 'editLink',
				    	'rel' => $photo['id'] . '_block'), null, false
				);
				?>
			</div>
			<div style="z-index:1;text-align:center;">
				<?php if ($photo['caption'] != '') : ?><span class="caption"><?php echo $photo['caption']; ?></span><br /><?php endif; ?>
				<span class="date"><?php echo date('Y-m-d', strtotime($photo['created'])); ?></span>
				<div class="imageBox">
					<a style="text-align: center;" href="<?php echo $html->url('/photos/' . $photo['filename']); ?>" title="Created: &lt;span class=&quote;timeago&quote; title=&quote;<?php echo $photo['created']; ?>&quote;&gt;<?php echo $photo['created']; ?>&lt;/span&gt;&lt;br /&gt;<?php echo $photo['caption']; ?>">
						<?php echo $image->resize($photo['filename'], 180, 140, 'photos/', true,array('border'=>'0', 'alt'=>$photo['caption'], 'style' => 'text-align: center; vertical-align:middle;')); ?>
					</a>
				</div>
			</div>
		</li>
<?php
	}
?>
</ul>
<br style="clear:both;"/>
<?php echo $this->element('comments', array('Comments' => $comments, 'itemId' => $album['Album']['id'], 'model' => $model, 'commentAuth' => $commentAuth)); ?>


<script type="text/javascript">
	var swfu;
	var totalSize = 0;
	var uploadedSize = 0;
	var numberFiles = 0;
			
	$("#addPhotos").click(function(){
		$("#uploadPhoto").fadeIn(); 
		$(this).hide();
	});

	$("#cancel").click(function(){
			$("#uploadPhoto").fadeOut(); 
			$('#addPhotos').show();	
			$("#fileListContainer").find('li').remove();
			swfu.cancelQueue();		
		});

	$("#startUpload").click(function() {
		$("#fileListContainer").find('div.input').fadeOut();

		$("#fileProgressContainer").html('<span id="totalStatus"><span class="fileName">Uploading ' + numberFiles + ' photos</span> <span class="fileSize">(' + Math.ceil(totalSize/1024) + ' kB)</span></span>' + 
											'<div id="progressBar"></div>' +
											'<span class="status" id="status">Pending...</span>');
		$("#progressBar").progressbar();
		$("#fileProgressContainer").fadeIn();
		swfu.startUpload();
	});

	$(".editLink").live('click', function() {
		$("#genericDialog").html('Loading');
		$("#genericDialog").load($(this).attr('href'));
		$("#genericDialog").dialog('open');
		return false;
	});
	
	function lightBox()
	{
		$('#photoThumbnails a:not(.editLink)').lightBox();	
	}
		
	function refreshMouseover()
	{
		$(".photoBlock").unbind('mouseenter');
		$(".photoBlock").unbind('mouseleave');
		$(".photoBlock").bind('mouseenter', function(){
				var id = this.id.split('_');
				$("#" + id[0] + '_edit').fadeIn('fast'); 
			});
	
		$(".photoBlock").bind('mouseleave', function() {
				var id = this.id.split('_');
				$("#" + id[0] + '_edit').fadeOut('fast'); 
			});
	}
		
	function fileQueued(file) {
		numberFiles++;
		totalSize += file['size'];
		if (file['size']/1024 > 1024)
			fileSize = Math.round((file['size']/1024/1024)*Math.pow(10,2))/Math.pow(10,2) + ' MB';
		else
			fileSize = Math.ceil(file['size']/1024) + ' KB';
		 
		var fileItem = $('<li style="display: none;" class="fileDiv">' +
							'<span class="fileName">' + file['name'] + ' (' + fileSize + ')</span>' +
							'<a href="#" class="cancelFile">Cancel</a>' + 
							'<?php echo $form->input('caption'); ?>' +
						'</li>');
		
		fileItem.attr('id', file['id']);
		fileItem.find('label').attr('for', 'input_' + file['id']);
		fileItem.find('input').attr('id', 'input_' + file['id']);
		fileItem.find('a.cancelFile').click(function() {
				numberFiles--;
				totalSize -= file['size'];
				
				swfu.cancelUpload(file['id']);
				fileItem.fadeOut('slow', function(){fileItem.remove()});
				
				return false;
			});

		$("#fileListContainer").append(fileItem);
		fileItem.fadeIn();
	}

	function fileQueueError(file, error, message)
	{
		console.log(message);
	}
	
	function uploadStart(file) 
	{
		swfu.addPostParam('caption', $("#input_" + file['id']).val());
		$('#status').html('Uploading ' + file['name']);
		return true;
	}
	
	function uploadProgress(file, bytesLoaded, bytesTotal) 
	{
		uploadedSize += bytesLoaded;
		var percent = Math.ceil((uploadedSize / totalSize) * 100);
	
		$("#progressBar").progressbar( 'value' , percent ); 
		$("#progressBar .ui-progressbar-text-back").hide();
		
		$('#status').html('Uploading  ' + file['name'] + ' <span class="bytesUploaded">(' + Math.ceil(bytesLoaded/1024) + ' kB of ' + Math.ceil(bytesTotal/1024) + ' kB)</span>');
		$('#totalStatus').html('<span class="fileName">Uploading ' + numberFiles + ' photos</span> <span class="fileSize">(' + Math.ceil(uploadedSize/1024) + ' kB of ' + Math.ceil(totalSize/1024) + ' kB)</span>');
	}
	
	function uploadSuccess(file, serverData) 
	{
		$("#" + file['id']).addClass('success');
		$("#" + file['id']).find('a').remove();
		setTimeout(function(){$("#" + file['id']).fadeOut('slow', function() {$("#" + file['id']).remove();});}, 1000);
	}

	function uploadError(file, error, message)
	{
		console.log(message);
	}	

	function uploadComplete(file)
	{
	}
	
	function queueComplete() 
	{
		numberFiles = 0;
		totalSize = 0;
		uploadedSize = 0;
		$("#fileProgressContainer").html('');
		$.jGrowl('Updating thumbnails');
		updateThumbnails();
	}
	
	function fileDialogComplete(numFilesSelected, numFilesQueued) 
	{
		//swfu.startUpload();
	}
	
	function updateThumbnails()
	{
		$("#photoThumbnails").load('<?php echo $html->url('/photos/thumbnails/' . $album['Album']['slug']);?>', function() {refreshMouseover();lightBox();});
	}
	
	refreshMouseover();
	lightBox();

	var settings = {
			flash_url : "<?php echo $html->url('/photos/js/swfuploadswf.js'); ?>",
			upload_url: "<?php echo $html->url('/photos/upload/'.$session->id() .'/' . $album['Album']['id']);?>",	// Relative to the SWF file
			post_params: {"PHPSESSID" : ""},
			file_size_limit : "10 MB",
			file_types : "*.jpg",
			file_types_description : "Image files",
			file_upload_limit : 100,
			file_queue_limit : 100,
			custom_settings : {
				progressTarget : "uploadProgress",
				cancelButtonId : "cancelUpload"
			},
			debug: false,

			// Button settings
			button_placeholder_id : "spanButtonPlaceholder",
			button_width: 120,
			button_height: 22,
			button_window_mode: SWFUpload.WINDOW_MODE.TRANSPARENT,
			button_cursor: SWFUpload.CURSOR.HAND,
			
			// The event handler functions are defined in handlers.js
			file_queued_handler : fileQueued,
			file_queue_error_handler : fileQueueError,
			file_dialog_complete_handler : fileDialogComplete,
			upload_start_handler : uploadStart,
			upload_progress_handler : uploadProgress,
			upload_error_handler : uploadError,
			upload_success_handler : uploadSuccess,
			upload_complete_handler : uploadComplete,
			queue_complete_handler : queueComplete	// Queue plugin event
		};

		swfu = new SWFUpload(settings);
	
</script>
