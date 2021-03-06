<?php 
/**
 * BBCode Helper for CakePHP 1.2.x.x
 * @author withoutnick (withoutnick@withoutnick.cz)
 * @version 1.0 stable
 */
    class BbcodeHelper extends AppHelper {
    	// /(\)(.+?)(\[\/size\])/
        var $bbcodes = array(
            'b' => '/\[b\](.+?)\[\/b\]/is',
            'i' => '/\[i\](.+?)\[\/i\]/is',
            'u' => '/\[u\](.+?)\[\/u\]/is',
            's' => '/\[s\](.+?)\[\/s\]/is',
            'size' => '/\[size=(.*?)\](.*?)\[\/size\]/is',
            'color' => '/\[color=(.*?)\](.*?)\[\/color\]/is',
            'url' => '/\[url\](.*?)\[\/url\]/is',
            'url2' => '/\[url=([^\]]+)\](.*?)\[\/url\]/is',
            'img' => '/\[img\](.*?)\[\/img\]/is',
            'quote' => '/\[quote\](.*?)\[\/quote\]/is',
        	'quote2' => '/\[quote=(.*?);(.*?)\](.*?)\[\/quote\]/is',
        	'quote3' => '/\[quote=(.*?)\](.*?)\[\/quote\]/is'
        );
        
        var $htmlcodes = array(
            'b' => '<b>\\2</b>',
            'i' => '<i>\\2</i>',
            'u' => '<u>\\2</u>',
            's' => '<strike>\\2</strike>',
            'size' => '<font size="\\2">\\4</font>',
            'color' => '<font color="\\2">\\4</font>',
            'url' => '<a href="\\2">\\2</a>',
            'url2' => '<a href="\\2">\\4</a>',
            'img' => '<img src="\\2">',
            'quote' => '<blockquote>\\2</blockquote>',
        	'quote3' => ''
        );
        
        var $htmlcodes_valid = array(
            'b' => '<strong>\\1</strong>',
            'i' => '<span style="font-style: italic;">\\1</span>',
            'u' => '<span style="text-decoration: underline;">\\1</span>',
            's' => '<span style="text-decoration: line-through;">\\1</span>',
            'size' => '<span style="font-size: \\1;">\\2</span>',
            'color' => '<span style="color: \\1;">\\2</span>',
            'url' => '<a href="\\1">\\1</a>',
            'url2' => '<a href="\\1">\\2</a>',
            'img' => '<img src="\\1" alt="BBCode image" />',
            'quote' => '<blockquote class="quoteStyle"><p>\\1</p></blockquote>',
            'quote2' => '<blockquote class="quoteStyle"><h4>\\1 wrote<a href="%root%/\\2#\\2">Goto</a>:</h4><p>\\3</p></blockquote>',
            'quote3' => '<blockquote class="quoteStyle"><h4>\\1 wrote:</h4><p>\\2</p></blockquote>'
        );
        
        function parse($text, $rootLink = '') {
            $bbcodes = $this->bbcodes;
            $htmlcodes = $this->htmlcodes_valid;
			$htmlcodes = str_ireplace('%root%', $rootLink, $htmlcodes);
            
            $return = nl2br(preg_replace($bbcodes, $htmlcodes, $text));

            return $this->output($return);
        }
    }
?> 