<?php echo $this->Html->link('New Vocabulary', array('action' => 'add')); ?>
<table>
<?php
	echo $this->Html->tableHeaders(array(
		$this->Paginator->sort('slug'),
		$this->Paginator->sort('title'),
		$this->Paginator->sort('description')
	));
	
	foreach($vocabularies as $vocabulary)
	{
		echo $this->Html->tableCells(array(
			$vocabulary['Vocabulary']['slug'],
			$vocabulary['Vocabulary']['title'],
			$this->Text->truncate($vocabulary['Vocabulary']['description'])
		));
	}
	
?>
</table>
	