$(document).ready(function() {
    $("#input-zh").fileinput({
		language: "zh", 
		// uploadUrl: "student/upload", 
		allowedFileExtensions: ["txt", "jpg", "png", "gif", "bmp", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "html", "sb2"], 
		// uploadAsync: true
		overwriteInitial: true,
		initialPreview: [
			$("#posted-path").val(),
			// "http://kartik-v.github.io/bootstrap-fileinput-samples/samples/SampleDOCFile_100kb.doc",
	    ],
	    // initialPreviewConfig: [
	    // 	{type: "gdocs", size: 1002400, caption: $("#file_name").val()},
	    // ],
	    initialPreviewShowDelete: false,
	    initialPreviewAsData: true, // 特别重要
	});
});