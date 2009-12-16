<?php
	echo $this->Form->create('Vocabulary');
	echo $this->Form->input('title');
	echo $this->Form->input('description');
	echo $this->Form->input('flat');
	echo $this->Form->input('type', array(
		'options' => array(
			'Select one term',
			'Select many terms',
			'Textbox'
		)
	));
	echo $this->Form->end('Create');