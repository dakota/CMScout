tinyMCE.init({
	// General options
	mode : "specific_textareas",
	editor_selector : "mceEditor",
	theme : "advanced",
	plugins : 'safari,spellchecker,bbcode,inlinepopups',
	// Theme options
	theme_advanced_buttons1 : "bold,italic,underline,undo,redo,link,unlink,image,forecolor,styleselect,removeformat,cleanup,code",
	theme_advanced_buttons2 : "",
	theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : false,
	theme_advanced_styles : "Code=codeStyle;Quote=quoteStyle",
	entity_encoding : "raw",
	remove_linebreaks : false
});