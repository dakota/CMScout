<?php
/*
originally from http://code.google.com/p/searchable-behaviour-for-cakephp/

edited by Jamie to fix add 'string' to the array to this line which is what all the mysql varchar columns seem to be reported as:

    if (isset($columns[$key]) && in_array($columns[$key],array('text','varchar','char','string'))) {

have a problem when using this with treebehaviour as ID field seems to get erased by treeBehaviour... still there in beforeSave if TreeBehaviour is last in the behaviour array, but it's not there in afterSave even if treeebehaviour is last.

created a proper defaults and settings array for rebuildOnUpdate which was not being read correctly

this didn't seem to be working properly for when updating records, so I added a few lines in the afterSave to find the correct SearchIndex record that matches the main record being saved, and then update that
*/
class SearchableBehavior extends ModelBehavior {
    var $settings = array();
    var $model = null;

    var $_index = false;
    var $_indexForId = false; // the (foreign) id of the model record we're indexing at the moment
    var $_defaults = array(
        'rebuildOnUpdate' => true
    );

    var $SearchIndex = null;

    function setup(&$model, $settings = array()) {
        $settings = array_merge($this->_defaults, $settings);
        $this->settings[$model->name] = $settings;
        $this->model = &$model;
    }

    function _indexData() {
        if (method_exists($this->model, 'indexData')) {
            return $this->model->indexData();
        } else {
            return $this->_index();
        }
    }

    function beforeSave() {
        if (isset($this->model->data[$this->model->name]['id']) && $this->model->data[$this->model->name]['id']!=0) {
            $this->_indexForId = $this->model->data[$this->model->name]['id'];
        } else {
            $this->_indexForId = 0;
        }
        if ($this->_indexForId == 0 || $this->settings[$this->model->name]['rebuildOnUpdate']) {
            $this->_index = $this->_indexData();
        }
        return true;
    }

    function afterSave() {
        if ($this->_index !== false) {
            if (!$this->SearchIndex) {
                App::import('Model','SearchIndex');
                $this->SearchIndex = new SearchIndex();
            }
            if ($this->_indexForId == 0) {
                $this->_indexForId = $this->model->getLastInsertID();
                $this->SearchIndex->save(
                    array(
                        'SearchIndex' => array(
                            'model' => $this->model->name,
                            'association_key' => $this->_indexForId,
                            'data' => $this->_index,
                    		'plugin_id' => isset($this->model->plugin_id) ? $this->model->plugin_id : ''
                        )
                    )
                );
            } else {
                $searchEntry = $this->SearchIndex->find('first',array('fields'=>array('id'),'conditions'=>array('model'=>$this->model->name,'association_key'=>$this->_indexForId)));
                if(!empty($searchEntry)) {
                    $this->SearchIndex->id = $searchEntry['SearchIndex']['id'];
                    $this->SearchIndex->saveField('data',$this->_index);
                }
                else {
                    // TODO: this is a repetition of above, for recreating a record if the index has got deleted.. .maybe this should be recycleable in a "recreate" method which could also be used in iteration?
                    $this->SearchIndex->save(
                        array(
                            'SearchIndex' => array(
                                'model' => $this->model->name,
                                'association_key' => $this->_indexForId,
                                'data' => $this->_index,
                    			'plugin_id' => isset($this->model->plugin_id) ? $this->model->plugin_id : ''
                            )
                        )
                    );
                }
            }
            $this->_index = false;
            $this->_indexForId = false;
        }
        return true;
    }

    function _index() {
        $index = '';
        $data = $this->model->data[$this->model->name];
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $columns = $this->model->getColumnTypes();
                if (isset($columns[$key]) && in_array($columns[$key],array('text','varchar','char','string'))) {
                    $index = $index . ' ' . strip_tags(html_entity_decode($value,ENT_COMPAT,'UTF-8'));
                }
            }
        }

        $index = iconv('UTF-8', 'ASCII//TRANSLIT', $index);
        $index = preg_replace('/[\ ]+/',' ',$index);
        return $index;
    }



    function search(&$model, $q, $findOptions = array()) {
        if (!$this->SearchIndex) {
            App::import('Model','SearchIndex');
            $this->SearchIndex = new SearchIndex();
        }

        $this->SearchIndex->searchModels($this->model->name);

        if (!isset($findOptions['conditions'])) $findOptions['conditions'] = array();

        $findOptions['conditions'] = array_merge($findOptions['conditions'],array("MATCH(SearchIndex.data) AGAINST('$q' IN BOOLEAN MODE)"));
        return $this->SearchIndex->find('all',$findOptions);
    }
}
?>