/*
 * jQuery File Upload Plugin JS Example 8.9.1
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

/* global $, window */

$(function () {
    'use strict';
	
	//reset hidden form
	$('#imageinput').val(";");
    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: 'photoupload.php'
    });

    // Enable iframe cross-domain access via redirect option:
    $('#fileupload').fileupload(
        'option',
        'redirect',
        window.location.href.replace(
            /\/[^\/]*$/,
            '/cors/result.html?%s'
        )
    );
	
	var onSuccess = function (e, data) {
		var files = data.result.files;
		for (var i = 0; i < files.length; ++i) {
			
			$('#imageinput').val( function( index, val ) {
				return val + files[i].id + ";";
			});
			console.log(files[i].id);
		}
	}
	var onDeleted = function (e, data) {
		console.log(data);
	}
	$('#fileupload').bind('fileuploaddone', onSuccess);
	$('#fileupload').bind('fileuploaddestroyed', onDeleted);

	$('#fileupload').fileupload('option', {
		maxFileSize: 5000000,
		acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
	});
	
});
