// $Id: fckeditor.config.js,v 1.4.4.2 2007/02/07 22:49:52 ontwerpwerk Exp $
FCKConfig.ToolbarSets["DrupalFull"] = [
	['Source'],
	['Cut','Copy','Paste','PasteText','PasteWord'],
	['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
	['Bold','Italic','Underline','StrikeThrough','-','Subscript','Superscript'],
	['OrderedList','UnorderedList','-','Outdent','Indent'],
	['JustifyLeft','JustifyCenter','JustifyRight'],
	['Link','Unlink','Anchor'],
	['Image','Flash','Table','Rule','SpecialChar','PageBreak'],
	'/',
	['FontFormat'],
	['TextColor','BGColor']
] ;

FCKConfig.ToolbarSets["DrupalBasic"] = [
	['FontFormat','-','Bold','Italic','-','OrderedList','UnorderedList','-','Link','Unlink', 'Image']
] ;

// Protect PHP code tags (<?...?>) so FCKeditor will not break them when
// switching from Source to WYSIWYG.
// Uncomment this line doesn't mean the user will not be able to type PHP
// code in the source. This kind of prevention must be done in the server side
// (as does Drupal), so just leave this line as is.
FCKConfig.ProtectedSource.Add( /<\?[\s\S]*?\?>/g ) ;	// PHP style server side code

// the following plugin will be used as soon as it's working
// for now use the excerpt module for teasers
// If it works you can add a 'Teaser' command to the toolbars
//CustomPluginsPath = '../../custom/plugins/' ;
//FCKConfig.Plugins.Add( 'teaserbreak', '', CustomPluginsPath ) ;
