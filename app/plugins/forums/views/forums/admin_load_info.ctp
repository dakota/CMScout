<?php 
if ($type == 'cat') 
{
	 echo $form->create('ForumCategory', array('id' => 'ajaxForm', 'default' => false, 'url' => '/admin/forums/saveCategory/' . $this->data['ForumCategory']['id']));
	 echo $form->input('title', array('label' => __('Category title', true)));
	 echo $form->end(__('Save', true));
	 $id = 'cat_' . $this->data['ForumCategory']['id'];
} 
else 
{
	 echo $form->create('ForumForum', array('id' => 'ajaxForm', 'default' => false, 'url' => '/admin/forums/saveForum/' . $this->data['ForumForum']['id']));
	 echo $form->input('title', array('label' => __('Forum title', true)));
	 echo $form->input('description', array('label' => __('Forum description', true)));
	 echo $form->end(__('Save', true));	
	 $id = 'forum_' . $this->data['ForumForum']['id'];
} ?>
<script type="text/javascript">  
	$("#ajaxForm").submit(function(data){
			$(this).ajaxSubmit({success: checkResponse});
			$.blockUI({message: '<img src="<?php echo Router::url('/img/throbber.gif'); ?>" alt="" /><?php __('Saving'); ?>'});

			return false;
		});
		
    	
    function checkResponse(data, status)
    {
    	tree1.refresh(function() {$.unblockUI();$.jGrowl('<?php __('Saved'); ?>');}); 
		$.jGrowl('<?php __('Saved'); ?>');
    }
</script>