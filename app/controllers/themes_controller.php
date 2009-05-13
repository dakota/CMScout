<?php
class ThemesController extends AppController
{
	var $name = "Themes";
	/**
	 * @var Theme
	 */
	var $Theme;
	
	
	function admin_index()
	{
		$this->set('themes', $this->Theme->find('all'));
	}
	
	function admin_install()
	{
		if (empty($this->data))
		{
			$notInstalled = array();
			
			$dh = opendir(WWW_ROOT . 'themed/');
			
			if (!$dh) 
				die('Unable to open directory');
				
			App::import('Xml'); 
			
			while (($resource = readdir($dh)) !== false) 
			{
				if (file_exists(WWW_ROOT . 'themed' . DS . $resource . DS . 'settings.xml'))
				{
					$fileName = WWW_ROOT . 'themed' . DS . $resource . DS . 'settings.xml';
					$xml = new Xml ($fileName);
					$xml = Set::reverse($xml);
					
					if ($this->Theme->find('count', array('conditions' => array('unique_id' => $xml['Theme']['uniqueId']))) == 0)
					{
						$notInstalled[$resource] = $xml['Theme']['title'];
					}			
				}
			}
			
			$this->set('notInstalledThemes', $notInstalled);
		}
		else
		{
			if ($this->data['Theme']['install_type'] == 0)
			{
				
			}
			else
			{
				$installTheme = $this->data['Theme']['themes'][0];

				App::import('Xml'); 
				
				$fileName = WWW_ROOT . 'themed/' . $installTheme . '/settings.xml';
				$xml = new Xml ($fileName);
				$xml = Set::reverse($xml);
				
				if ($this->Theme->installTheme($xml))
				{
					$this->Session->setFlash('Theme installed');
					$this->redirect('/admin/themes');
				}
			}
		}
	}
	
	function admin_siteTheme($id = null)
	{
		$this->Theme->updateAll(array('site_theme' => '0'));
		
		$this->Theme->save(array('Theme' => array('id' => $id, 'site_theme' => '1')));
		
		$this->Session->setFlash('Theme changed');
		$this->redirect('/admin/themes');
	}
}
?>