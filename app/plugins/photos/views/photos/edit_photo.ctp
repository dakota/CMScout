<?php
 echo $form->create('Photo', array('url' => '/photos/editPhoto/' . $this->data['Photo']['id'], 'id'=>'ajaxForm'));
 echo $form->input('caption');
 echo $form->input('id', array('type'=>'hidden'));
 echo $form->end('Save Photo');
 
 echo $javascript->link('/js/jquery.form');
?>

<script type="text/javascript">

    var options = { 
        success: checkResponse
    }; 

	$("#ajaxForm").submit(function(data){
			$(this).ajaxSubmit(options);
			$("#<?php echo $this->data['Photo']['id'] . '_block'; ?>").html('<img src="<?php echo $html->url('/img/throbber.gif'); ?>" alt="" />Saving');
			return false;
		});
		
    	
    function checkResponse(data, status)
    {
			$("#<?php echo $this->data['Photo']['id'] . '_block'; ?>").load("<?php echo $html->url('/photos/photoBlock/' . $this->data['Photo']['id']); ?>", 
				function(){			
					$("#genericDialog").dialog('close');
					lightBox();
					$.jGrowl('Photo updated');					
			});
    }	
</script>