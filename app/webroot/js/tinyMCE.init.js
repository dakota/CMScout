tinyMCE.init({
	// General options
	mode : "specific_textareas",
	editor_selector : "mceEditor",
	theme : "advanced",
	plugins : 'safari,spellchecker,table,advimage,advlink,'+
				'emotions,inlinepopups,insertdatetime,media,searchreplace,'+
				'paste,xhtmlxtras,template"',
	// Theme options
	theme_advanced_buttons2 : "bold,italic,underline,strikethrough,|," +
								"justifyleft,justifycenter,justifyright,justifyfull,|," +
								"formatselect,fontselect,fontsizeselect,forecolor,backcolor",
	theme_advanced_buttons1 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|," +
								"bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|," +
								"link,unlink,anchor,image,insertdate,inserttime,|," +
								",cleanup,code",
	theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|," +
								"sub,sup,cite,abbr,acronym,del,ins",
	theme_advanced_buttons4 : 	"spellchecker,|,charmap,emotions,media,|," +
								"visualchars,nonbreaking,template",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : false,
	
	extended_valid_elements : "@[style]"
});