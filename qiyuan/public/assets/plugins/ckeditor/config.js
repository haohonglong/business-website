/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	config.toolbar = [
    	['Undo', 'Redo', '-', 'Bold', 'Italic', 'Underline', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
    	['-', 'SImage'],
    	['-', 'FontSize', 'TextColor', 'Source', 'Maximize']
    ];

    config.enterMode = CKEDITOR.ENTER_BR; 
    config.shiftEnterMode = CKEDITOR.ENTER_BR;
    config.removeDialogTabs = 'image:advanced;link:advanced;elementspath';
    config.allowedContent = true;
};
