<?php
function searchCmp($a, $b)
{
	if ($a['score'] == $b['score'])
	{
		return 0;
	}
	return ($a['score'] > $b['score']) ? -1 : 1;
}

class Search extends AppModel
{
	var $name = "Search";
	var $useTable = false;
	
	function runSearch($searchQuery)
	{		
		$iniSeperator = strpos(PHP_OS, 'WIN') === false ? ':' : ';';
		ini_set('include_path', ini_get('include_path') . $iniSeperator . APP . 'vendors'); 
		App::import('Vendor', 'Lucene', array('file' =>'Zend'.DS.'Search'.DS.'Lucene.php'));
		
		$indexPath = APP .'tmp'.DS.'cache'.DS.'index';
		Zend_Search_Lucene::setResultSetLimit(10);
		$index = Zend_Search_Lucene::open($indexPath);
		
		$results = $index->find($searchQuery);
		return $results;
	}
	
	function rebuildIndex()
	{
		$indexItems = $this->dispatchEvent('getIndex');
		
		$iniSeperator = strpos(PHP_OS, 'WIN') === false ? ':' : ';';
		ini_set('include_path', ini_get('include_path') . $iniSeperator . APP . 'vendors'); 
		App::import('Vendor', 'Lucene', array('file' =>'Zend'.DS.'Search'.DS.'Lucene.php'));
		
		$indexPath = APP .'tmp'.DS.'cache'.DS.'index';
		$index = Zend_Search_Lucene::create($indexPath);
		foreach($indexItems as $indexItem)
		{
			foreach($indexItem['returns'] as $item)
			{
				// Create a new searchable document instance
			    $doc = new Zend_Search_Lucene_Document();
			
			    // Add some information
			    foreach($item as $fieldName => $field)
			    {
			    	if (is_array($field['value']))
			    		$field['value'] = serialize($field['value']);
			    		
			    	if($field['type'] == 'indexed')
			    	{
			    		$doc->addField(Zend_Search_Lucene_Field::Text($fieldName, $field['value']));
			    	}
			    	else
			    	{
			    		$doc->addField(Zend_Search_Lucene_Field::UnIndexed($fieldName, $field['value']));
			    	}
			    }
			    
			    // Add the document to the index
			    $index->addDocument($doc); 
			}
		}
		
		$index->commit(); 
	}
}
?>