$(document).ready(function() {
    $("#input-zh").fileinput({
		language: "zh", 
		// uploadUrl: "student/upload", 
		allowedFileExtensions: ["jpg", "png", "gif", "bmp", "doc", "docx", "xls", "xlsx", "ppt", "pptx", "html"], 
		// uploadAsync: true
		overwriteInitial: true,
		initialPreview: [
		$("#posted-path").val(),
		// "https://ss0.bdstatic.com/94oJfD_bAAcT8t7mm9GUKT-xh_/timg?image&quality=100&size=b4000_4000&sec=1510572057&di=81996b519f149515af45bb02a8e95a00&src=http://imgsrc.baidu.com/imgad/pic/item/b21c8701a18b87d6232299000d0828381f30fd48.jpg"
			// $("#posted-path").text(),
	        //"<img src='" + $("#posted-path").text() + "' class='file-preview-image  kv-preview-data' >",
	    ],
	    initialPreviewAsData: true, // 特别重要
	});
});