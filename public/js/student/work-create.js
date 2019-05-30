$(document).ready(function() {
    $("#cover-upload").fileinput({
		language: "zh", 
		// uploadUrl: "student/upload", 
		allowedFileExtensions: ["jpg", "png", "bmp"], 
		// uploadAsync: true
		// overwriteInitial: true,
		// initialPreview: [
		// 	$("#posted-path").val(),
	 //    ],
	    // dropZoneTitle: "asasasas",
	    // showPreview: "false",
	    showUpload: false,
	    dropZoneEnabled: false,
	    msgPlaceholder: "选择上传作品封面 ...",
	    // initialPreviewConfig: [
	    // 	{type: "gdocs", size: 1002400, caption: $("#file_name").val()},
	    // ],
	    // initialPreviewShowDelete: false,
	    // initialPreviewAsData: true, // 特别重要
	});

	$("#work-upload").fileinput({
		language: "zh", 
		// uploadUrl: "student/upload", 
		allowedFileExtensions: ["txt", "jpg", "png", "gif", "bmp", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "html", "sb2"], 
		// uploadAsync: true
		// overwriteInitial: true,
		// initialPreview: [
		// 	$("#posted-path").val(),
	 //    ],
	    // dropZoneTitle: "asasasas",
	    // showPreview: "false",
	    showUpload: false,
	    dropZoneEnabled: false,
	    msgPlaceholder: "选择上传作品 ...",
	    // initialPreviewConfig: [
	    // 	{type: "gdocs", size: 1002400, caption: $("#file_name").val()},
	    // ],
	    // initialPreviewShowDelete: false,
	    // initialPreviewAsData: true, // 特别重要
	});
});