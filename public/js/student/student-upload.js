$(document).ready(function() {
    $("#input-zh").fileinput({
		language: "zh", 
		// uploadUrl: "student/upload", 
		allowedFileExtensions: ["jpg", "png", "gif"], 
		// uploadAsync: true
		initialPreview: [
		$("#posted-path").text(),
	        //"<img src='" + $("#posted-path").val() + "' class='file-preview-image  kv-preview-data' >",
	    ],
	    initialPreviewAsData: true, // 特别重要
	});
});