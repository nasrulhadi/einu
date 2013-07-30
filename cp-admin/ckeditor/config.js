/*
Copyright (c) 2003-2011, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	var weburl = '../cp-admin/kcfinder-2.21/';
	config.filebrowserBrowseUrl = weburl+'browse.php?type=files';
	config.filebrowserImageBrowseUrl = weburl+'browse.php?type=images';
	config.filebrowserFlashBrowseUrl = weburl+'browse.php?type=flash';
	config.filebrowserUploadUrl = weburl+'upload.php?type=files';
	config.filebrowserImageUploadUrl = weburl+'upload.php?type=images';
	config.filebrowserFlashUploadUrl = weburl+'upload.php?type=flash';
};
