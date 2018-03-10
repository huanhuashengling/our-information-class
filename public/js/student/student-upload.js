$(document).ready(function() {
    $("#input-zh").fileinput({
		language: "zh", 
		// uploadUrl: "student/upload", 
		allowedFileExtensions: ["txt", "jpg", "png", "gif", "bmp", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "html"], 
		// uploadAsync: true
		overwriteInitial: true,
		initialPreview: [
			$("#posted-path").val(),
	    ],
	    initialPreviewAsData: true, // 特别重要
	});
});