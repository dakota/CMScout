tinyMCE.init({
	// General options
	mode : "specific_textareas",
	editor_selector : "mceEditor",
	theme : "advanced",
	plugins : 'safari,spellchecker,'+
				'emotions,inlinepopups,insertdatetime,media,searchreplace,'+
				'paste,xhtmlxtras"',
	// Theme options
	theme_advanced_buttons2 : "spellchecker,|,bold,italic,underline,strikethrough,|," +
								"justifyleft,justifycenter,justifyright,|," +
								"fontsizeselect,forecolor,backcolor,|," +
								"link,unlink",
	theme_advanced_buttons1 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|," +
								"bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|," +
								"emotions,media,image,insertdate,inserttime",
	theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : false,
	
	extended_valid_elements : "@[style]"
});