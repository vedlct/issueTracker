/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	//var ckBaseUrl = '<?php  url("/") ?>';
	 var base_url =window.location.origin+"/issuetracker/public/ck/";
   // config.filebrowserBrowseUrl = 'public/ck/ckeditor/kcfinder/browse.php?opener=ckeditor&type=files';
   // config.filebrowserImageBrowseUrl = 'public/ck/ckeditor/kcfinder/browse.php?opener=ckeditor&type=images';
   // config.filebrowserFlashBrowseUrl = 'public/ck/ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash';
   // config.filebrowserUploadUrl = 'public/ck/ckeditor/kcfinder/upload.php?opener=ckeditor&type=files';
   // config.filebrowserImageUploadUrl = 'public/ck/ckeditor/kcfinder/upload.php?opener=ckeditor&type=images';
   // config.filebrowserFlashUploadUrl = 'public/ck/ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash';
   
    config.filebrowserBrowseUrl = base_url+'ckeditor/kcfinder/browse.php?opener=ckeditor&type=files';
    config.filebrowserImageBrowseUrl = base_url+'ckeditor/kcfinder/browse.php?opener=ckeditor&type=images';
    config.filebrowserFlashBrowseUrl = base_url+'ckeditor/kcfinder/browse.php?opener=ckeditor&type=flash';
    config.filebrowserUploadUrl = base_url+'ckeditor/kcfinder/upload.php?opener=ckeditor&type=files';
    config.filebrowserImageUploadUrl = base_url+'ckeditor/kcfinder/upload.php?opener=ckeditor&type=images';
    config.filebrowserFlashUploadUrl = base_url+'ckeditor/kcfinder/upload.php?opener=ckeditor&type=flash';
};
