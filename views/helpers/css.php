<?php
  class CssHelper extends AppHelper 
  {
/**
 * html tags used by this helper.
 *
 * @var array
 */
	var $tags = array(
		'css' => '<link rel="%s" type="text/css" href="%s" %s/>',
		'style' => '<style type="text/css"%s>%s</style>'
	);  	
  	
  	function link($path, $rel = null, $htmlAttributes = array(), $inline = true) {
		if (is_array($path)) {
			$out = '';
			foreach ($path as $i) {
				$out .= "\n\t" . $this->link($i, $rel, $htmlAttributes, $inline);
			}
			if ($inline)  {
				return $out . "\n";
			}
			return;
		}

		if (strpos($path, '://') !== false) {
			$url = $path;
		} else {
			if ($path[0] !== '/') {
				$path = CSS_URL . $path;
			}

			if (strpos($path, '?') === false) {
				if (strpos($path, '.css') === false) {
					$path .= '.css';
				}
			}

			$path = $this->webroot($path);

			$url = $path;
			if (strpos($path, '?') === false && ((Configure::read('Asset.timestamp') === true && Configure::read() > 0) || Configure::read('Asset.timestamp') === 'force')) {
				$url .= '?' . @filemtime(WWW_ROOT . str_replace('/', DS, $path));
			}

			if (Configure::read('Asset.filter.css')) {
				$url = str_replace(CSS_URL, 'ccss/', $url);
			}
		}

		if ($rel == 'import') {
			$out = sprintf($this->tags['style'], $this->_parseAttributes($htmlAttributes, null, '', ' '), '@import url(' . $url . ');');
		} else {
			if ($rel == null) {
				$rel = 'stylesheet';
			}
			$out = sprintf($this->tags['css'], $rel, $url, $this->_parseAttributes($htmlAttributes, null, '', ' '));
		}
		$out = $this->output($out);

		if ($inline) {
			return $out;
		} else {
			$view =& ClassRegistry::getObject('view');
			$styles_for_layout = $view->getVar('styles_for_layout');
			$view->set('styles_for_layout', $styles_for_layout.$out);
		}
	}
  }
?>