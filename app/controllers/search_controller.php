<?php
 class SearchController extends AppController
 {
 	var $name = "Search";
 	var $uses = array("SearchIndex");

 	function index()
 	{

 	}

 	function search()
 	{
 		if (!empty($this->data))
 		{
 			$searchResults = $this->SearchIndex->find('all', array('fields' => array('*', "MATCH (SearchIndex.data) AGAINST ('".$this->data['Search']['q']."' IN boolean MODE) AS score"),
 																	'conditions' =>  "MATCH(SearchIndex.data) AGAINST('".$this->data['Search']['q']."' IN boolean MODE) HAVING score >= 1",
 																	'order' => 'score DESC'));

 			$searchContents = array();

 			foreach ($searchResults as $key => $searchResult)
 			{
 				if ($searchResult['SearchIndex']['plugin_id'] != '')
 				{
	 				App::import('Model', 'Plugin');

	 				$plugin = new Plugin();

	 				$plugin = $plugin->find('first', array('conditions' => array('Plugin.unique_id' => $searchResult['SearchIndex']['plugin_id'])));
 				}
 				else
 				{
 					$plugin = null;
 				}

 				$modelName = ((isset($plugin['Plugin']['directory'])) ? Inflector::camelize($plugin['Plugin']['directory']) . '.' : '') . Inflector::classify($searchResult['SearchIndex']['model']);

 				App::import('Model', $modelName);

 				$modelName = $searchResult['SearchIndex']['model'];

 				$model = new $modelName();

 				$content = $model->find('first', array('fields' => array('id', 'slug', 'title', 'text', 'created'), 'conditions' => array($modelName . '.id' => $searchResult['SearchIndex']['association_key']), 'contain' => false));

 				$temp = array();
 				$temp['Result'] = $content[$modelName];
 				$temp['Plugin'] = $plugin['Plugin'];
 				$temp['Model'] = $modelName;
 				$searchContents[] = $temp;
 			}

 			$this->set(compact('searchContents'));
 			$this->set('searchTerms', $this->data['Search']['q']);
 		}
 	}

 }
?>