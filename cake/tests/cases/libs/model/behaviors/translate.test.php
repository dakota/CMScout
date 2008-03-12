<?php
/* SVN FILE: $Id$ */
/**
 * Short description for file.
 *
 * Long description for file
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) Tests <https://trac.cakephp.org/wiki/Developement/TestSuite>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 *  Licensed under The Open Group Test Suite License
 *  Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				https://trac.cakephp.org/wiki/Developement/TestSuite CakePHP(tm) Tests
 * @package			cake.tests
 * @subpackage		cake.tests.cases.libs.model.behaviors
 * @since			CakePHP(tm) v 1.2.0.5669
 * @version			$Revision$
 * @modifiedby		$LastChangedBy$
 * @lastmodified	$Date$
 * @license			http://www.opensource.org/licenses/opengroup.php The Open Group Test Suite License
 */
if (!defined('CAKEPHP_UNIT_TEST_EXECUTION')) {
	define('CAKEPHP_UNIT_TEST_EXECUTION', 1);
}
/**
 * Short description for class.
 *
 * @package		cake.tests
 * @subpackage	cake.tests.cases.libs.model.behaviors
 */
class TranslateTestModel extends CakeTestModel {
	var $name = 'TranslateTestModel';
	var $useTable = 'i18n';
	var $displayField = 'field';
}
/**
 * Short description for class.
 *
 * @package		cake.tests
 * @subpackage	cake.tests.cases.libs.model.behaviors
 */
class TranslatedItem extends CakeTestModel {
	var $name = 'TranslatedItem';
	var $cacheQueries = false;
	var $actsAs = array('Translate' => array('content', 'title'));
	var $translateModel = 'TranslateTestModel';
}
/**
 * Short description for class.
 *
 * @package		cake.tests
 * @subpackage	cake.tests.cases.libs.model.behaviors
 */
class TranslatedItemWithTable extends CakeTestModel {
	var $name = 'TranslatedItemWithTable';
	var $useTable = 'translated_items';
	var $cacheQueries = false;
	var $actsAs = array('Translate' => array('content', 'title'));
	var $translateModel = 'TranslateTestModel';
	var $translateTable = 'another_i18n';
}
/**
 * Short description for class.
 *
 * @package		cake.tests
 * @subpackage	cake.tests.cases.libs.model.behaviors
 */
class TranslateTest extends CakeTestCase {
	var $fixtures = array('core.translated_item', 'core.translate', 'core.translate_table');
	var $Model = null;

	function startCase() {
		$this->Model =& new TranslatedItem();
		$this->I18nModel =& ClassRegistry::getObject('TranslateTestModel');
	}

	function testLocaleFalsePlain() {
		$this->Model->locale = false;

		$result = $this->Model->read(null, 1);
		$expected = array('TranslatedItem' => array('id' => 1, 'slug' => 'first_translated'));
		$this->assertEqual($result, $expected);

		$result = $this->Model->find('all', array('fields' => array('slug')));
		$expected = array(
				array('TranslatedItem' => array('slug' => 'first_translated')),
				array('TranslatedItem' => array('slug' => 'second_translated')),
				array('TranslatedItem' => array('slug' => 'third_translated')));
		$this->assertEqual($result, $expected);
	}

	function testLocaleFalseAssociations() {
		$this->Model->locale = false;
		$this->Model->unbindTranslation();
		$translations = array('title' => 'Title', 'content' => 'Content');
		$this->Model->bindTranslation($translations, false);

		$result = $this->Model->read(null, 1);
		$expected = array(
				'TranslatedItem' => array('id' => 1, 'slug' => 'first_translated'),
				'Title' => array(
						array('id' => 1, 'locale' => 'eng', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'title', 'content' => 'Title #1'),
						array('id' => 3, 'locale' => 'deu', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'title', 'content' => 'Titel #1'),
						array('id' => 5, 'locale' => 'cze', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'title', 'content' => 'Titulek #1')),
				'Content' => array(
						array('id' => 2, 'locale' => 'eng', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'content', 'content' => 'Content #1'),
						array('id' => 4, 'locale' => 'deu', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'content', 'content' => 'Inhalt #1'),
						array('id' => 6, 'locale' => 'cze', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'content', 'content' => 'Obsah #1')));
		$this->assertEqual($result, $expected);

		$this->Model->hasMany['Title']['fields'] = $this->Model->hasMany['Content']['fields'] = array('content');
		$this->Model->hasMany['Title']['conditions']['locale'] = $this->Model->hasMany['Content']['conditions']['locale'] = 'eng';

		$result = $this->Model->find('all', array('fields' => array('TranslatedItem.slug')));
		$expected = array(
				array('TranslatedItem' => array('id' => 1, 'slug' => 'first_translated'),
						'Title' => array(array('foreign_key' => 1, 'content' => 'Title #1')),
						'Content' => array(array('foreign_key' => 1, 'content' => 'Content #1'))),
				array('TranslatedItem' => array('id' => 2, 'slug' => 'second_translated'),
						'Title' => array(array('foreign_key' => 2, 'content' => 'Title #2')),
						'Content' => array(array('foreign_key' => 2, 'content' => 'Content #2'))),
				array('TranslatedItem' => array('id' => 3, 'slug' => 'third_translated'),
						'Title' => array(array('foreign_key' => 3, 'content' => 'Title #3')),
						'Content' => array(array('foreign_key' => 3, 'content' => 'Content #3'))));
		$this->assertEqual($result, $expected);

		$this->Model->hasMany['Title']['fields'] = $this->Model->hasMany['Content']['fields'] = '';
		unset($this->Model->hasMany['Title']['conditions']['locale']);
		unset($this->Model->hasMany['Content']['conditions']['locale']);
		$this->Model->unbindTranslation($translations);
		$this->Model->bindTranslation(array('content', 'title'), false);
	}

	function testLocaleSingle() {
		$this->Model->locale = 'eng';

		$result = $this->Model->read(null, 1);
		$expected = array('TranslatedItem' => array(
				'id' => 1,
				'slug' => 'first_translated',
				'locale' => 'eng',
				'title' => 'Title #1',
				'content' => 'Content #1'));
		$this->assertEqual($result, $expected);

		$result = $this->Model->find('all');
		$expected = array(
				array('TranslatedItem' => array(
						'id' => 1,
						'slug' => 'first_translated',
						'locale' => 'eng',
						'title' => 'Title #1',
						'content' => 'Content #1')),
				array('TranslatedItem' => array(
						'id' => 2,
						'slug' => 'second_translated',
						'locale' => 'eng',
						'title' => 'Title #2',
						'content' => 'Content #2')),
				array('TranslatedItem' => array(
						'id' => 3,
						'slug' => 'third_translated',
						'locale' => 'eng',
						'title' => 'Title #3',
						'content' => 'Content #3')));
		$this->assertEqual($result, $expected);
	}

	function testLocaleSingleWithConditions() {
		$this->Model->locale = 'eng';

		$result = $this->Model->find('all', array('conditions' => array('slug' => 'first_translated')));
		$expected = array(
				array('TranslatedItem' => array(
						'id' => 1,
						'slug' => 'first_translated',
						'locale' => 'eng',
						'title' => 'Title #1',
						'content' => 'Content #1')));
		$this->assertEqual($result, $expected);

		$result = $this->Model->find('all', array('conditions' => "TranslatedItem.slug = 'first_translated'"));
		$expected = array(
				array('TranslatedItem' => array(
						'id' => 1,
						'slug' => 'first_translated',
						'locale' => 'eng',
						'title' => 'Title #1',
						'content' => 'Content #1')));
		$this->assertEqual($result, $expected);
	}

	function testLocaleSingleAssociations() {
		$this->Model->locale = 'eng';
		$this->Model->unbindTranslation();
		$translations = array('title' => 'Title', 'content' => 'Content');
		$this->Model->bindTranslation($translations, false);

		$result = $this->Model->read(null, 1);
		$expected = array(
				'TranslatedItem' => array(
						'id' => 1,
						'slug' => 'first_translated',
						'locale' => 'eng',
						'title' => 'Title #1',
						'content' => 'Content #1'),
				'Title' => array(
						array('id' => 1, 'locale' => 'eng', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'title', 'content' => 'Title #1'),
						array('id' => 3, 'locale' => 'deu', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'title', 'content' => 'Titel #1'),
						array('id' => 5, 'locale' => 'cze', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'title', 'content' => 'Titulek #1')),
				'Content' => array(
						array('id' => 2, 'locale' => 'eng', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'content', 'content' => 'Content #1'),
						array('id' => 4, 'locale' => 'deu', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'content', 'content' => 'Inhalt #1'),
						array('id' => 6, 'locale' => 'cze', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'content', 'content' => 'Obsah #1')));
		$this->assertEqual($result, $expected);

		$this->Model->hasMany['Title']['fields'] = $this->Model->hasMany['Content']['fields'] = array('content');
		$this->Model->hasMany['Title']['conditions']['locale'] = $this->Model->hasMany['Content']['conditions']['locale'] = 'eng';

		$result = $this->Model->find('all', array('fields' => array('TranslatedItem.title')));
		$expected = array(
				array('TranslatedItem' => array('id' => 1, 'locale' => 'eng', 'title' => 'Title #1'),
						'Title' => array(array('foreign_key' => 1, 'content' => 'Title #1')),
						'Content' => array(array('foreign_key' => 1, 'content' => 'Content #1'))),
				array('TranslatedItem' => array('id' => 2, 'locale' => 'eng', 'title' => 'Title #2'),
						'Title' => array(array('foreign_key' => 2, 'content' => 'Title #2')),
						'Content' => array(array('foreign_key' => 2, 'content' => 'Content #2'))),
				array('TranslatedItem' => array('id' => 3, 'locale' => 'eng', 'title' => 'Title #3'),
						'Title' => array(array('foreign_key' => 3, 'content' => 'Title #3')),
						'Content' => array(array('foreign_key' => 3, 'content' => 'Content #3'))));
		$this->assertEqual($result, $expected);

		$this->Model->hasMany['Title']['fields'] = $this->Model->hasMany['Content']['fields'] = '';
		unset($this->Model->hasMany['Title']['conditions']['locale']);
		unset($this->Model->hasMany['Content']['conditions']['locale']);

		$this->Model->unbindTranslation($translations);
		$this->Model->bindTranslation(array('title', 'content'), false);
	}

	function testLocaleMultiple() {
		$this->Model->locale = array('deu', 'eng', 'cze');

		$delete = array(
				array('locale' => 'deu'),
				array('foreign_key' => 1, 'field' => 'title', 'locale' => 'eng'),
				array('foreign_key' => 1, 'field' => 'content', 'locale' => 'cze'),
				array('foreign_key' => 2, 'field' => 'title', 'locale' => 'cze'),
				array('foreign_key' => 2, 'field' => 'content', 'locale' => 'eng'),
				array('foreign_key' => 3, 'field' => 'title'));
		$this->I18nModel->deleteAll(array('or' => $delete));

		$result = $this->Model->read(null, 1);
		$expected = array(
				'TranslatedItem' => array(
						'id' => 1,
						'slug' => 'first_translated',
						'locale' => 'deu',
						'title' => 'Titulek #1',
						'content' => 'Content #1'));
		$this->assertEqual($result, $expected);

		$result = $this->Model->find('all', array('fields' => array('slug', 'title', 'content')));
		$expected = array(
				array('TranslatedItem' => array(
						'slug' => 'first_translated',
						'locale' => 'deu',
						'title' => 'Titulek #1',
						'content' => 'Content #1')),
				array('TranslatedItem' => array(
						'slug' => 'second_translated',
						'locale' => 'deu',
						'title' => 'Title #2',
						'content' => 'Obsah #2')),
				array('TranslatedItem' => array(
						'slug' => 'third_translated',
						'locale' => 'deu',
						'title' => '',
						'content' => 'Content #3')));
		$this->assertEqual($result, $expected);
	}

	function testTranslatedFindList() {
		$this->Model->displayField = 'title';
		$result = $this->Model->find('list', array('recursive' => 1));
		$expected = array(1 => 'Titel #1', 2 => 'Titel #2', 3 => 'Titel #3');
		$this->assertEqual($result, $expected);
	}

	function testReadSelectedFields() {
		$this->Model->locale = 'eng';

		$result = $this->Model->find('all', array('fields' => array('slug', 'TranslatedItem.content')));
		$expected = array(
				array('TranslatedItem' => array('slug' => 'first_translated', 'locale' => 'eng', 'content' => 'Content #1')),
				array('TranslatedItem' => array('slug' => 'second_translated', 'locale' => 'eng', 'content' => 'Content #2')),
				array('TranslatedItem' => array('slug' => 'third_translated', 'locale' => 'eng', 'content' => 'Content #3')));
		$this->assertEqual($result, $expected);

		$result = $this->Model->find('all', array('fields' => array('TranslatedItem.slug', 'content')));
		$this->assertEqual($result, $expected);

		$this->Model->locale = array('eng', 'deu', 'cze');
		$delete = array(array('locale' => 'deu'), array('field' => 'content', 'locale' => 'eng'));
		$this->I18nModel->deleteAll(array('or' => $delete));

		$result = $this->Model->find('all', array('fields' => array('title', 'content')));
		$expected = array(
				array('TranslatedItem' => array('locale' => 'eng', 'title' => 'Title #1', 'content' => 'Obsah #1')),
				array('TranslatedItem' => array('locale' => 'eng', 'title' => 'Title #2', 'content' => 'Obsah #2')),
				array('TranslatedItem' => array('locale' => 'eng', 'title' => 'Title #3', 'content' => 'Obsah #3')));
		$this->assertEqual($result, $expected);
	}

	function testSaveCreate() {
		$this->Model->locale = 'spa';
		$data = array('slug' => 'fourth_translated', 'title' => 'Leyenda #4', 'content' => 'Contenido #4');
		$this->Model->create($data);
		$this->Model->save();
		$result = $this->Model->read();
		$expected = array('TranslatedItem' => array_merge($data, array('id' => $this->Model->id, 'locale' => 'spa')));
		$this->assertEqual($result, $expected);
	}

	function testSaveUpdate() {
		$this->Model->locale = 'spa';
		$oldData = array('slug' => 'fourth_translated', 'title' => 'Leyenda #4');
		$this->Model->create($oldData);
		$this->Model->save();
		$id = $this->Model->id;
		$newData = array('id' => $id, 'content' => 'Contenido #4');
		$this->Model->create($newData);
		$this->Model->save();
		$result = $this->Model->read(null, $id);
		$expected = array('TranslatedItem' => array_merge($oldData, $newData, array('locale' => 'spa')));
		$this->assertEqual($result, $expected);
	}

	function testMultipleCreate() {
		$this->Model->locale = 'deu';
		$data = array(
			'slug' => 'new_translated',
			'title' => array('eng' => 'New title', 'spa' => 'Nuevo leyenda'),
			'content' => array('eng' => 'New content', 'spa' => 'Nuevo contenido')
		);
		$this->Model->create($data);
		$this->Model->save();

		$this->Model->unbindTranslation();
		$translations = array('title' => 'Title', 'content' => 'Content');
		$this->Model->bindTranslation($translations, false);
		$this->Model->locale = array('eng', 'spa');

		$result = $this->Model->read();
		$expected = array(
			'TranslatedItem' => array('id' => 4, 'slug' => 'new_translated', 'locale' => 'eng', 'title' => 'New title', 'content' => 'New content'),
			'Title' => array(
				array('id' => 19, 'locale' => 'eng', 'model' => 'TranslatedItem', 'foreign_key' => 4, 'field' => 'title', 'content' => 'New title'),
				array('id' => 20, 'locale' => 'spa', 'model' => 'TranslatedItem', 'foreign_key' => 4, 'field' => 'title', 'content' => 'Nuevo leyenda')
			),
			'Content' => array(
				array('id' => 21, 'locale' => 'eng', 'model' => 'TranslatedItem', 'foreign_key' => 4, 'field' => 'content', 'content' => 'New content'),
				array('id' => 22, 'locale' => 'spa', 'model' => 'TranslatedItem', 'foreign_key' => 4, 'field' => 'content', 'content' => 'Nuevo contenido')
			)
		);
		$this->assertEqual($result, $expected);

		$this->Model->unbindTranslation($translations);
		$this->Model->bindTranslation(array('title', 'content'), false);
	}

	function testMultipleUpdate() {
		$this->Model->locale = 'eng';
		$data = array('TranslatedItem' => array(
			'id' => 1,
			'title' => array('eng' => 'New Title #1', 'deu' => 'Neue Titel #1', 'cze' => 'Novy Titulek #1'),
			'content' => array('eng' => 'New Content #1', 'deu' => 'Neue Inhalt #1', 'cze' => 'Novy Obsah #1')
		));
		$this->Model->create();
		$this->Model->save($data);

		$this->Model->unbindTranslation();
		$translations = array('title' => 'Title', 'content' => 'Content');
		$this->Model->bindTranslation($translations, false);
		$result = $this->Model->read(null, 1);
		$expected = array(
			'TranslatedItem' => array('id' => '1', 'slug' => 'first_translated', 'locale' => 'eng', 'title' => 'New Title #1', 'content' => 'New Content #1'),
			'Title' => array(
				array('id' => 1, 'locale' => 'eng', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'title', 'content' => 'New Title #1'),
				array('id' => 3, 'locale' => 'deu', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'title', 'content' => 'Neue Titel #1'),
				array('id' => 5, 'locale' => 'cze', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'title', 'content' => 'Novy Titulek #1')
			),
			'Content' => array(
				array('id' => 2, 'locale' => 'eng', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'content', 'content' => 'New Content #1'),
				array('id' => 4, 'locale' => 'deu', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'content', 'content' => 'Neue Inhalt #1'),
				array('id' => 6, 'locale' => 'cze', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'content', 'content' => 'Novy Obsah #1')
			)
		);
		$this->assertEqual($result, $expected);

		$this->Model->unbindTranslation($translations);
		$this->Model->bindTranslation(array('title', 'content'), false);
	}

	function testMixedCreateUpdateWithArrayLocale() {
		$this->Model->locale = array('cze', 'deu');
		$data = array('TranslatedItem' => array(
			'id' => 1,
			'title' => array('eng' => 'Updated Title #1', 'spa' => 'Nuevo leyenda #1'),
			'content' => 'Upraveny obsah #1'
		));
		$this->Model->create();
		$this->Model->save($data);

		$this->Model->unbindTranslation();
		$translations = array('title' => 'Title', 'content' => 'Content');
		$this->Model->bindTranslation($translations, false);
		$result = $this->Model->read(null, 1);
		$expected = array(
			'TranslatedItem' => array('id' => 1, 'slug' => 'first_translated', 'locale' => 'cze', 'title' => 'Titulek #1', 'content' => 'Upraveny obsah #1'),
			'Title' => array(
				array('id' => 1, 'locale' => 'eng', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'title', 'content' => 'Updated Title #1'),
				array('id' => 3, 'locale' => 'deu', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'title', 'content' => 'Titel #1'),
				array('id' => 5, 'locale' => 'cze', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'title', 'content' => 'Titulek #1'),
				array('id' => 19, 'locale' => 'spa', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'title', 'content' => 'Nuevo leyenda #1')
			),
			'Content' => array(
				array('id' => 2, 'locale' => 'eng', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'content', 'content' => 'Content #1'),
				array('id' => 4, 'locale' => 'deu', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'content', 'content' => 'Inhalt #1'),
				array('id' => 6, 'locale' => 'cze', 'model' => 'TranslatedItem', 'foreign_key' => 1, 'field' => 'content', 'content' => 'Upraveny obsah #1')
			)
		);

		$this->assertEqual($result, $expected);

		$this->Model->unbindTranslation($translations);
		$this->Model->bindTranslation(array('title', 'content'), false);
	}

	function testAttachDetach() {
		$Behavior =& $this->Model->Behaviors->Translate;

		$this->Model->unbindTranslation();
		$translations = array('title' => 'Title', 'content' => 'Content');
		$this->Model->bindTranslation($translations, false);

		$result = array_keys($this->Model->hasMany);
		$expected = array('Title', 'Content');
		$this->assertEqual($result, $expected);

		$this->Model->Behaviors->detach('Translate');

		$result = array_keys($this->Model->hasMany);
		$expected = array();
		$this->assertEqual($result, $expected);

		$result = isset($this->Model->Behaviors->Translate);
		$this->assertFalse($result);

		$result = isset($Behavior->settings[$this->Model->alias]);
		$this->assertFalse($result);

		$result = isset($Behavior->runtime[$this->Model->alias]);
		$this->assertFalse($result);

		$this->Model->Behaviors->attach('Translate', array('title' => 'Title', 'content' => 'Content'));
		$result = array_keys($this->Model->hasMany);
		$expected = array('Title', 'Content');
		$this->assertEqual($result, $expected);

		$result = isset($this->Model->Behaviors->Translate);
		$this->assertTrue($result);

		$result = isset($Behavior->settings[$this->Model->alias]);
		$this->assertTrue($result);

		$result = isset($Behavior->runtime[$this->Model->alias]);
		$this->assertTrue($result);

		$this->Model->unbindTranslation($translations);
		$this->Model->bindTranslation(array('title', 'content'), false);
	}

	function testAnotherTranslateTable() {
		$Model =& new TranslatedItemWithTable();
		$Model->locale = 'eng';
		$result = $Model->read(null, 1);
		$expected = array('TranslatedItemWithTable' => array(
				'id' => 1,
				'slug' => 'first_translated',
				'locale' => 'eng',
				'title' => 'Another Title #1',
				'content' => 'Another Content #1'));
		$this->assertEqual($result, $expected);
	}
}
?>