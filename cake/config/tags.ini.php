;<?php die(); ?>
; SVN FILE: $Id$
;/**
; * Short description for file.
; *
; * In this file, you can set up 'templates' for every tag generated by the tag
; * generator.
; *
; * PHP versions 4 and 5
; *
; * CakePHP :  Rapid Development Framework <http://www.cakephp.org/>
; * Copyright (c)	2006, Cake Software Foundation, Inc.
; *							1785 E. Sahara Avenue, Suite 490-204
; *							Las Vegas, Nevada 89104
; *
; *  Licensed under The MIT License
; *  Redistributions of files must retain the above copyright notice.
; *
; * @filesource
; * @copyright		Copyright (c) 2006, Cake Software Foundation, Inc.
; * @link			http://www.cakefoundation.org/projects/info/cakephp CakePHP Project
; * @package		cake
; * @subpackage	cake.cake.app.config
; * @since			CakePHP v 0.10.0.1076
; * @version		$Revision$
; * @modifiedby	$LastChangedBy$
; * @lastmodified	$Date$
; * @license		http://www.opensource.org/licenses/mit-license.php The MIT License
; */

; Tag template for a link.
link = "<a href="%s" %s>%s</a>"

; Tag template for a mailto: link.
mailto = "<a href="mailto:%s" %s>%s</a>"

; Tag template for opening form tag.
form = "<form %s>"

; Tag template for an input type='text' tag.
input = "<input name="data[%s][%s]" %s/>"

; Tag template for an input type='textarea' tag
textarea = "<textarea name="data[%s][%s]" %s>%s</textarea>"

; Tag template for an input type='hidden' tag.
hidden = "<input type="hidden" name="data[%s][%s]" %s/>"

; Tag template for a textarea tag.
textarea = "<textarea name="data[%s][%s]" %s>%s</textarea>"

; Tag template for a input type='checkbox ' tag.
checkbox = "<input type="checkbox" name="data[%s][%s]" %s/>"

; Tag template for a input type='radio' tag.
radio = "<input type="radio" name="data[%s][%s]" id="%s" %s />%s"

; Tag template for a select opening tag.
selectstart = "<select name="data[%s][%s]" %s>"

; Tag template for a select opening tag.
selectmultiplestart = "<select name="data[%s][%s][]" %s>"

; Tag template for an empty select option tag.
selectempty = "<option value="" %s>&nbsp;</option>"

; Tag template for a select option tag.
selectoption = "<option value="%s" %s>%s</option>"

; Tag template for a closing select tag.
selectend = "</select>"

; Tag template for a option group tag.
optiongroup = "<optgroup label="%s"%s>"
optiongroupend = "</optgroup>"

; Tag template for a password tag.
password = "<input type="password" name="data[%s][%s]" %s/>"

; Tag template for a file input tag.
file = "<input type="file" name="data[%s][%s]" %s/>"

; Tag template for a file input tag with no associated model.
file_no_model = "<input type="file" name="%s" %s/>"

; Tag template for a submit button tag.
submit = "<input type="submit" %s/>"

; Tag template for a image input tag.
submitimage = "<input type="image" src="%s" %s/>"

; Tag template for an image tag.
image ="<img src="%s" %s/>"

; Tag template for a table header tag.
tableheader = "<th%s>%s</th>"

; Tag template for table headers row tag.
tableheaderrow = "<tr%s>%s</tr>"

; Tag template for a table cell tag.
tablecell = "<td%s>%s</td>"

; Tag template for a table row tag.
tablerow = "<tr%s>%s</tr>"

; Tag templates for a block-level element (DIV).
block = "<div%s>%s</div>"
blockstart = "<div%s>"
blockend = "</div>"

; Tag templates for a paragraph element.
para = "<p%s>%s</p>"
parastart = "<p%s>"

; Tag templates for a label element.
label = "<label for="%s"%s>%s</label>"

; Tag templates for fieldset and legend element.
fieldset = "<fieldset><legend>%s</legend>%s</fieldset>"
fieldsetstart = "<fieldset><legend>%s</legend>"
fieldsetend = "</fieldset>"
legend = "<legend>%s</legend>"

; Tag template for a CSS link tag.
css = "<link rel="%s" type="text/css" href="%s" %s/>"

; Tag template for a CSS tag block.
style = "<style type="text/css"%s>%s</style>"

; Tag template for a charset meta-tag.
charset = "<meta http-equiv="Content-Type" content="text/html; charset=%s" />"

; Tag template for inline JavaScript.
javascriptblock = "<script type="text/javascript">%s</script>"
javascriptstart = "<script type="text/javascript">"

; Tag template for included JavaScript.
javascriptlink = "<script type="text/javascript" src="%s"></script>"